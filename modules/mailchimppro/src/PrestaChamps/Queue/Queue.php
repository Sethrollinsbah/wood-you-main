<?php
/**
 * PrestaChamps
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Commercial License
 * you can't distribute, modify or sell this code
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file
 * If you need help please contact leo@prestachamps.com
 *
 * @author    Mailchimp
 * @copyright Mailchimp
 * @license   commercial
 */

namespace PrestaChamps\Queue;
if (!defined('_PS_VERSION_')) {
    exit;
}
use Db;
use DbQuery;
use PrestaChamps\Queue\Exceptions\InvalidJobException;

use PrestaChamps\Queue\Jobs\CartRuleSyncJob;
use PrestaChamps\Queue\Jobs\CartSyncJob;
use PrestaChamps\Queue\Jobs\CustomerSyncJob;
use PrestaChamps\Queue\Jobs\NewsletterSubscriberSyncJob;
use PrestaChamps\Queue\Jobs\OrderSyncJob;
use PrestaChamps\Queue\Jobs\ProductSyncJob;

class Queue
{
    //protected $table = "ps_mailchimppro_jobs";
	protected $table = _DB_PREFIX_ . "mailchimppro_jobs";
	protected $max_try;
	protected $max_jobs;

    const STATUS_AVAILABLE = 0;
    const STATUS_PROCESSED = 100;
    const STATUS_PROCESSING = 10;
    const STATUS_FAILED = -1;
    const PRIORITIES_BY_TYPE = array (
        "product"                => 1,
        "customer"               => 2,
        "cartRule"               => 3,
        "order"                  => 4,
        "cart"                   => 5,
        "newsletterSubscriber"   => 6
	);
	
	public function __construct()
	{
		$this->max_try = ($max = (int)\Configuration::get(\MailchimpProConfig::QUEUE_ATTEMPT)) && $max > 0 && \Validate::isUnsignedInt($max) ? $max : 2;
		$this->max_jobs = ($limit = (int)\Configuration::get(\MailchimpProConfig::QUEUE_STEP)) && $limit > 0 && \Validate::isUnsignedInt($limit) ? $limit : 10;
	}

    public function push(JobInterface $job, $channel, $id_shop)
    {
        $class = $this->escape($job->getJobType());

        $bodyJson = $job->convertToArrayJson();

        if (!$entityId = $job->getJobId()) {
            $entityId = 0;
        }
		if (!$priority = self::PRIORITIES_BY_TYPE[$class]) {
			$priority = 1;
		}

		// Use PrestaShop's insert method with INSERT_IGNORE option
		Db::getInstance()->insert('mailchimppro_jobs', [
							    'channel'   => pSQL($channel),
							    'body'      => Db::getInstance()->escape($bodyJson),
							    'type'      => pSQL($class),
							    'id_entity' => (int)$entityId,
							    'priority'  => (int)$priority,
							    'id_shop'   => (int)$id_shop
							], 
							false, 
							true, 
							Db::INSERT_IGNORE
						);
    }

    protected function escape($value)
    {
        $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
        $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $value);
    }

    public function getNumberOfAvailableJobs($channel = "%%")
    {
    	$idShop = \Context::getContext()->shop->id;

		// Create a new DbQuery object
		$query = new DbQuery();
		$query->select('COUNT(*)');
		$query->from('mailchimppro_jobs');
		$query->where('`status` = ' . (int)self::STATUS_AVAILABLE);
		$query->where('`id_shop` = ' . (int)$idShop);

		// Execute the query and get the count
		return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($query);;
    }
	
	public function getNumberOfTotalJobs($channel = "%%")
    {
    	$idShop = \Context::getContext()->shop->id;

    	// Create a new DbQuery object
		$query = new DbQuery();
		$query->select('COUNT(*)');
		$query->from('mailchimppro_jobs');
		$query->where('`id_shop` = ' . (int)$idShop);

		// Execute the query and get the count
		return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($query);
    }

    public function getNumberOfAvailableJobsPerType($channel = "%%")
    {
    	$idShop = \Context::getContext()->shop->id;

    	$query = new DbQuery();
		$query->select('`type`, COUNT(*) as count');
		$query->from('mailchimppro_jobs');
		$query->where('`status` = ' . (int)self::STATUS_AVAILABLE);
		$query->where('`id_shop` = ' . (int)$idShop);
		$query->groupBy('`type`');

		// Execute the query and fetch the results
		$results = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);

		// Convert the results into a key-value pair array
		$keyValuePair = [];
		foreach ($results as $row) {
		    $keyValuePair[$row['type']] = $row['count'];
		}

		return $keyValuePair;
	}

    public function getNumberOfJobsInFlight($channel = "%%")
    {
    	$idShop = \Context::getContext()->shop->id;

    	$query = new DbQuery();
		$query->select('COUNT(*)');
		$query->from('mailchimppro_jobs');
		$query->where('`status` = ' . (int)self::STATUS_PROCESSING);
		$query->where('`id_shop` = ' . (int)$idShop);

		return (int)Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($query);
	}

    protected function reserveJob($jobId)
    {
    	// Prepare the data to be updated
		$data = [
		    'status'    => (int)self::STATUS_PROCESSING,
		    'locked_at' => ['type' => 'sql', 'value' => 'CURRENT_TIMESTAMP']  // Using SQL function directly
		];

		// Define the where condition
		$where = 'id_job = ' . (int)$jobId;

		// Execute the update query
		return Db::getInstance()->update('mailchimppro_jobs', $data, $where);
    }

    protected function unReserveJob($jobId, $message = "Unknown error")
    {
    	// Prepare the data to be updated
		$data = [
		    'status' => (int)self::STATUS_AVAILABLE,
		    'error'  => pSQL($message)
		];

		// Define the where condition
		$where = 'id_job = ' . (int)$jobId;

		// Execute the update query
		return Db::getInstance()->update('mailchimppro_jobs', $data, $where);
    }

    protected function deleteJob($jobId)
    {
    	// Define the where condition
		$where = 'id_job = ' . (int)$jobId;

		// Execute the delete query
		return Db::getInstance()->delete('mailchimppro_jobs', $where);
    }

    protected function deleteUnsuccessfulJobs()
    {
    	// Define the where condition
		$where = 'attempts >= ' . (int)$this->max_try;

		// Execute the delete query
		return Db::getInstance()->delete('mailchimppro_jobs', $where);
    }

    public function clearChannel($channel = "%%")
    {
    	$idShop = \Context::getContext()->shop->id;

		// Prepare the where condition
		$where = "`id_shop` = " . (int)$idShop;

		// Execute the delete query
		return Db::getInstance()->delete('mailchimppro_jobs', $where);
    }

    protected function increaseAttemptsCounter($jobId)
    {
        // Prepare the data to be updated
		$data = [
		    'attempts' => ['type' => 'sql', 'value' => '`attempts` + 1']  // SQL expression to increment attempts
		];

		// Define the where condition
		$where = 'id_job = ' . (int)$jobId;

		// Execute the update query
		return Db::getInstance()->update('mailchimppro_jobs', $data, $where);
    }
	
	protected function getAttemptsCounter($jobId)
    {
        $query = new DbQuery();
		$query->select('`attempts`');
		$query->from('mailchimppro_jobs');
		$query->where('`id_job` = ' . (int)$jobId);

		// Execute the query and get the result
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($query);
    }

    public function pop($channel = "%%", $limit = false)
    {
    	$idShop = \Context::getContext()->shop->id;
		$max_try = pSQL($this->max_try);

		if(!$limit) {
			$query = new DbQuery();
			$query->select('*');
			$query->from('mailchimppro_jobs');
			$query->where('(`status` = ' . (int)self::STATUS_AVAILABLE . ' AND `attempts` < ' . (int)Db::getInstance()->escape(pSQL($max_try)) . ') 
			              OR (`status` = ' . (int)self::STATUS_PROCESSING . ' AND TIMESTAMPDIFF(SECOND, `locked_at`, CURRENT_TIMESTAMP) > 60)');
			$query->where('`id_shop` = ' . (int)$idShop);
			$query->orderBy('`priority` ASC, `id_entity` ASC');

			// Execute the query and fetch the result
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($query);
		}
		else {
			$query = new DbQuery();
			$query->select('*');
			$query->from('mailchimppro_jobs');
			$query->where('(`status` = ' . (int)self::STATUS_AVAILABLE . ' AND `attempts` < ' . (int)Db::getInstance()->escape(pSQL($max_try)) . ') 
			              OR (`status` = ' . (int)self::STATUS_PROCESSING . ' AND TIMESTAMPDIFF(SECOND, `locked_at`, CURRENT_TIMESTAMP) > 60)');
			$query->where('`id_shop` = ' . (int)$idShop);
			$query->orderBy('`priority` ASC, `id_entity` ASC');
			$query->limit((int)Db::getInstance()->escape(pSQL($limit)));

			// Execute the query and fetch all results
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
		}

        if (empty($result)) {
            return null;
        }
		
		if (!$limit) {
			$this->increaseAttemptsCounter($result['id_job']);
		}
		else {
			foreach ($result as $queue) {
				$this->increaseAttemptsCounter($queue['id_job']);
			}
		}

        return $result;
    }

    /**
     * @throws InvalidJobException
     */
    public function runJob($channel = "%%")
    {
        $errorMessage = '';
        $requestSuccess = true;
		$jobType = '';

        $jobData = $this->pop($channel);

        if (empty($jobData)) {
            $this->deleteUnsuccessfulJobs();
			return [
				'success' => true,
				'message' => 'No job to sync!',
				'type' => null,
				'data' => null
			];
        }

        try {

        	$job = $this->getJobObject($jobData["type"], $jobData["body"]);

            $this->reserveJob($jobData['id_job']);

            if (!($job instanceof JobInterface)) {
                $resp = "Deserialized object is not an instance of " . JobInterface::class;
                $this->unReserveJob($jobData['id_job'], $resp);
                throw new InvalidJobException($resp);
            }

            // $response = $job->execute();
            $response = $job->execute($jobData['id_shop']);
            
            if (isset($response['requestSuccess']) && $response['requestSuccess'] == true) {
                $this->deleteJob($jobData['id_job']);
                $requestSuccess = true;
				$jobType = $job->getJobType();
            }
            else {
                $requestSuccess = false;
				if (isset($response['requestLastErrors'])) {
                    if (is_array($response['requestLastErrors'])) {
                        $errorMessage = implode(";", array_values($response['requestLastErrors']));
                    }
                    else {
                        $errorMessage = $response['requestLastErrors'];
                    }
					if ($attempsCount = $this->getAttemptsCounter($jobData['id_job'])) {
						$errorMessage .= ' (' . $attempsCount . '. attemp(s))';
					}
					$this->unReserveJob($jobData['id_job'], $errorMessage);
                }
				else {
					$this->unReserveJob($jobData['id_job']);
				}
			}
			$this->deleteUnsuccessfulJobs();
        } catch (\Exception $exception) {
            $this->unReserveJob($jobData['id_job'], $exception->getMessage());
            return [
                'success' => false,
                'message' => $exception->getMessage(),
                'type' => null,
                'data' => null,
            ];
        }

        return [
            'success' => $requestSuccess,
            'message' => $errorMessage,
            'type' => get_class($job),
            'data' => $jobData,
			'jobType' => $jobType
        ];
    }
	
	public function addSpecificPriceProductJobs(){

		$current_date = new \DateTime('now', new \DateTimeZone(@date_default_timezone_get()));

		$query = new DbQuery();
		$query->select('*');
		$query->from('mailchimppro_specific_price');
		$query->where('(`needToRun` = 2 AND `start_date` < \'' . Db::getInstance()->escape(pSQL($current_date->format('Y-m-d H:i:s'))) . '\') 
		              OR (`needToRun` = 1 AND `end_date` < \'' . Db::getInstance()->escape(pSQL($current_date->format('Y-m-d H:i:s'))) . '\')');

		// Execute the query and fetch the results
		$specific_prices = Db::getInstance()->executeS($query);

		if(count($specific_prices) > 0){
			foreach($specific_prices as $specific_price){

				$queue = new Queue();
                $job = new Jobs\ProductSyncJob();
                $job->productId = $specific_price["id_product"];
                $queue->push($job, 'setup-wizard', $specific_price["id_shop"]);

				if ($specific_price["needToRun"] == 1) {
                    // Define the where condition
					$where = 'id_specific_price = ' . (int)$specific_price['id_specific_price'];

					// Execute the delete query
					$delete = Db::getInstance()->delete('mailchimppro_specific_price', $where);
                }

				if ($specific_price["needToRun"] == 2) {
					// Prepare the data to be updated
					$data = [
					    'needToRun' => 1
					];

					// Define the where condition
					$where = 'id_specific_price = ' . (int)$specific_price['id_specific_price'];

					// Execute the update query
					$update = Db::getInstance()->update('mailchimppro_specific_price', $data, $where);
                }

			}
		}

	}
	
	
	public function runCronjob($channel = "%%")
    {
		\Configuration::updateValue(\MailchimpProConfig::LAST_CRONJOB, date('Y-m-d H:i:s'), true);
		\Configuration::updateGlobalValue('MAILCHIMPPRO_IS_CRONJOB_RUNNING', true, true);
		
		$startTime = new \DateTime();

		if (!($token = trim(\Tools::getValue('secure'))) || !\Validate::isCleanHtml($token) || $token != \Configuration::get(\MailchimpProConfig::CRONJOB_SECURE_TOKEN)) {
			if (\Tools::isSubmit('ajax')) {
				die(json_encode(array(
					'errors' => 'Access denied',
					'result' => ''
				)));
			}
			die('Access denied');
		}

		$this->addSpecificPriceProductJobs();
		
		$count = 0;
		$errors = array();
		
		$max_try = $this->max_try ? $this->max_try : 2;
		$max_jobs = $this->max_jobs? $this->max_jobs : 10;			
		$status = self::STATUS_AVAILABLE;

		if ($queues = $this->pop($channel, $max_jobs)) {
			// reserve all the selected jobs
			foreach ($queues as $queue) {
				$this->reserveJob($queue['id_job']);
			}
			
			foreach ($queues as $queue) {
				$errorMessage = '';
				$requestSuccess = true;

    			$job = $this->getJobObject($queue["type"], $queue["body"]);

				if (!($job instanceof JobInterface)) {
					//throw new InvalidJobException("Deserialized object is not an instance of " . JobInterface::class);
					$resp = "Deserialized object is not an instance of " . JobInterface::class;
					$this->unReserveJob($queue['id_job'], $resp);
				}
				
				$response = $job->execute($queue['id_shop']); // parameter is store ID from PS multi store configuration
				
				
				if (isset($response['requestSuccess']) && $response['requestSuccess'] == true) {
					$count++;
					$this->deleteJob($queue['id_job']);
				}
				else {
					$requestSuccess = false;
					if (isset($response['requestLastErrors'])) {
						if (is_array($response['requestLastErrors'])) {
							$errorMessage = implode(";", array_values($response['requestLastErrors']));
						}
						else {
							$errorMessage = $response['requestLastErrors'];
						}
						if ($attempsCount = $this->getAttemptsCounter($queue['id_job'])) {
							$errorMessage .= ' (' . $attempsCount . '. attemp(s))';
						}
						
						if (!empty($response['requestLastResponse']['body'])) {
							$responseBody = json_decode($response['requestLastResponse']['body'], true);
							if (!empty($responseBody['errors']) && is_array($responseBody['errors'])) {
								$additionalErrors = array();
								foreach ($responseBody['errors'] as $bodyErrors) {
									if (!empty($bodyErrors['message'])) {
										$additionalErrors[] = $bodyErrors['message'];
									}
								}
								if (!empty($additionalErrors)) {
									$errorMessage .= "\n";
									$errorMessage .= "**********";
									$errorMessage .= "\n • " . implode("\n • ", $additionalErrors) . "\n";
									$errorMessage .= "**********";
									$errorMessage .= "\n";
								}
							}
						}
						
						$this->unReserveJob($queue['id_job'], $errorMessage);
						$errors[] = '− Job type: ' . $job->getJobType() . ' | Id: ' . $queue['id_entity'] . ' | Message: ' . $errorMessage;
					}
					else {
						$this->unReserveJob($queue['id_job']);
					}
				}
			}
		}

		$this->deleteUnsuccessfulJobs();

		if ((int)\Configuration::get(\MailchimpProConfig::LOG_CRONJOB)) {
			$log = "================================================================\n";
			$log .= date(\Context::getContext()->language->date_format_full);
			$msg = 'There were %s job(s) successfully synced to the MailChimp!';
			if ($count)
				$log .= '  ' . sprintf($msg, $count);
			else
				$log .= '  ' . 'No job has been synced';
			
			if ($errors) {
				$log .= "\n";
				$log .= 'Errors: ';
				foreach ($errors as $error) {
					$log .= " \n " . $error;
				}
			}
			$log .= "\n";

			// Define the destination directory
		    $dest = _PS_MODULE_DIR_ . 'mailchimppro/logs';

		    // Resolve the destination path
		    $resolvedDest = realpath($dest) ?: $dest; // Use the original path if realpath fails

		    // Ensure the directory exists, create it if it doesn't
		    if (!is_dir($resolvedDest)) {
		        if (!mkdir($resolvedDest, 0755, true)) {
		            // Handle error if directory creation fails
		            throw new \Exception('Failed to create log directory.');
		        }

		        $resolvedDest = realpath($resolvedDest) ?: $dest; // Use the original path if realpath fails
		    }

		    // Ensure the resolved path is within the intended directory
		    if (strpos(realpath($resolvedDest), realpath(_PS_MODULE_DIR_ . 'mailchimppro')) === 0) {
		        if ($count || $errors) {
		            // Safely append the log to the file
		            $logFilePath = $resolvedDest . '/cronjob.log';
		            if (file_put_contents($logFilePath, $log . PHP_EOL, FILE_APPEND) === false) {
		                // Handle error if writing to the log file fails
		                throw new \Exception('Failed to write to log file.');
		            }
		        }
		    } else {
		        // Handle error if the path is not valid
		        throw new \Exception('Invalid log directory path.');
		    }
		}
	
		\Configuration::updateGlobalValue('MAILCHIMPPRO_IS_CRONJOB_RUNNING', false, true);
		
		$endTime = new \DateTime();
		\Configuration::updateValue(\MailchimpProConfig::LAST_CRONJOB_EXECUTION_TIME, $startTime->diff($endTime)->format('%Y-%m-%d %H:%i:%s'), true);
		
		$jsonArr = array(
			'result' => 'Cronjob ran successfully:' . ' ' . ($count <= 0 ? 'No job has been synced!' : sprintf('%s job(s) was synced to the MailChimp!', $count)),
		);

        die(json_encode($jsonArr));
    }

    public function getJobObject($type,$body)
    {
    	$job = null;

    	switch($type){
			case CartRuleSyncJob::JOB_TYPE:{
				$job = new CartRuleSyncJob($body);
				break;
			}
			case CartSyncJob::JOB_TYPE:{
				$job = new CartSyncJob($body);
				break;
			}
			case CustomerSyncJob::JOB_TYPE:{
				$job = new CustomerSyncJob($body);
				break;
			}
			case NewsletterSubscriberSyncJob::JOB_TYPE:{
				$job = new NewsletterSubscriberSyncJob($body);
				break;
			}
			case OrderSyncJob::JOB_TYPE:{
				$job = new OrderSyncJob($body);
				break;
			}
			case ProductSyncJob::JOB_TYPE:{
				$job = new ProductSyncJob($body);
				break;
			}
		}

		return $job;
    }
}
