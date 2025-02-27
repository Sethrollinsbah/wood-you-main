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
 *
 * Class AdminMailchimpProCampaignsController
 *
 * @property Mailchimppro $module
 */
if (!defined('_PS_VERSION_')) {
    exit;
}
class AdminMailchimpProCampaignsController extends \PrestaChamps\MailchimpPro\Controllers\BaseMCObjectController
{
	public $entityPlural   = 'campaigns';
    public $entitySingular = 'campaign';
	protected $fields_form;
	protected $listId;
	
	/**
     * AdminMailchimpProCampaignsController constructor.
     *
     * @throws \PrestaShopException
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
		$this->listId = $this->getListIdFromStore();
		$segmentList = $this->getSegmentList();
		$templateList = $this->getTemplateList();
		/* $this->queryParameters['type'] = "user"; */
		$this->queryParameters['sort_field'] = "create_time";
		$this->queryParameters['sort_dir'] = "DESC";
        $this->fields_form = [
			'tinymce' => false,
			'legend' => [
				'title' => $this->l('Create new campaign'),
				'icon' => 'icon-pencil'
			],
			'input' => [
				[
					'type' => 'text',
					'label' => $this->l('The title of the campaign'),
					'name' => 'campaignTitle',
					'lang' => false,
					'col' => 12,
					'required' => true,
                ],
				[
					'type' => 'select',
					'name' => 'campaignType',
					'label' => $this->l('Campaign type'),					
					'default_value' => 'regular',
					'options' => [
						'query' => [
							['id' => 'regular', 'name' => 'Regular'],
							/* ['id' => 'email_client', 'name' => 'Email client'],
							['id' => 'language', 'name' => 'Language'],							
							['id' => 'gmonkey', 'name' => 'VIP status'] */
						],
						'id' => 'id',
						'name' => 'name',
					],
					'col' => 12,
					'required' => true,
				],
				[
					'type' => 'text',
					'label' => $this->l("The 'from' name on the campaign (not an email address)"),
					'name' => 'campaignFromName',
					'lang' => false,
					'col' => 12,
					'required' => true,
                ],
				[
					'type' => 'text',
					'label' => $this->l('Campaign subject'),
					'name' => 'campaignSubject',
					'lang' => false,
					'col' => 12,
					'required' => true,
                ],				
				[
					'type' => 'select',
					'name' => 'campaignRecipients',
					'label' => $this->l('Recipients'),					
					/* 'default_value' => 'regular', */
					'options' => [
						'query' => $segmentList,
						'id' => 'id',
						'name' => 'name',
					],
					'col' => 12,
					'required' => true,
				],
				[
					'type' => 'select',
					'name' => 'campaignTemplate',
					'label' => $this->l('Template to use'),					
					/* 'default_value' => 'regular', */
					'options' => [
						'query' => $templateList,
						'id' => 'id',
						'name' => 'name',
					],
					'col' => 12,
					'required' => true,
				]
			],
			'submit' => [
				'title' => $this->l('Save'),
				'name' => 'createCampaign'
			],
		];        
    }
	
	protected function getListApiEndpointUrl()
    {
        return '/campaigns';
    }

    protected function getSingleApiEndpointUrl($entityId)
    {
        return "/campaigns/{$entityId}";
    }
	
	private function getSegmentList() {
		if (!$this->mailchimp) {
            return [];
        }
		
		/* $this->queryParameters['fields'] = 'segments.id'; */
		/* $this->queryParameters['type'] = 'static'; */
		$this->queryParameters['count'] = 1000;
		
		$result = $this->mailchimp->get(
            "/lists/" . $this->listId . "/segments",
            $this->queryParameters,
            999
        );
		
		unset($this->queryParameters['fields']);
		unset($this->queryParameters['type']);
		unset($this->queryParameters['count']);
		
		if ($this->mailchimp->success()) {
            //return $result;
			return $result['segments'];
        }

        throw new \PrestaChamps\MailchimpPro\Exceptions\MailChimpException($this->mailchimp->getLastError());
	}
	
	private function getTemplateList() {
		if (!$this->mailchimp) {
            return [];
        }
		
		/* $this->queryParameters['fields'] = 'segments.id'; */
		/* $this->queryParameters['type'] = 'static'; */
		$this->queryParameters['type'] = "user";
		$this->queryParameters['sort_dir'] = "DESC";
		$this->queryParameters['count'] = 1000;
		
		$result = $this->mailchimp->get(
            "/templates",
            $this->queryParameters,
            999
        );
		
		unset($this->queryParameters['type']);
		unset($this->queryParameters['sort_dir']);
		unset($this->queryParameters['count']);
		
		if ($this->mailchimp->success()) {
            //return $result;
			return $result['templates'];
        }

        throw new \PrestaChamps\MailchimpPro\Exceptions\MailChimpException($this->mailchimp->getLastError());
	}
	
	/**
     * @return mixed
     * @throws \PrestaChamps\MailchimpPro\Exceptions\MailChimpException
     * @throws \Exception
     */
	protected function getEntities()
    {
        if (!$this->mailchimp) {
            return [];
        }
		
		$this->queryParameters['count'] = $this->entitiesPerPage;
		$this->queryParameters['offset'] = ($this->currentPage - 1) * $this->entitiesPerPage;

		
        $result = $this->mailchimp->get(
            $this->getListApiEndpointUrl(),
            $this->queryParameters,
            999
        );
		//dump($result);die();
		unset($this->queryParameters['count']);
		unset($this->queryParameters['offset']);

        if ($this->mailchimp->success()) {
            $this->totalEntities = $result['total_items'];

            $this->totalPageNumber = ceil($this->totalEntities / $this->entitiesPerPage);
			
			foreach ($result['campaigns'] as &$segment) {				
				$segment['editable'] = true;
			}
			
            return $result['campaigns'];
        }

        throw new \PrestaChamps\MailchimpPro\Exceptions\MailChimpException($this->mailchimp->getLastError());
    }
	
	protected function deleteEntity($id)
    {
        $this->mailchimp->delete($this->getSingleApiEndpointUrl($id));

        if ($this->mailchimp->success()) {
            return true;
        }

        return false;
    }
	
	protected function sendEntity($id)
    {
        $result = $this->mailchimp->post(
			"/campaigns/{$id}/actions/send"
		);
		
		//dump($this->mailchimp->success());die();
		if ($result) {
			return true;
		}

        if ($this->mailchimp->success()) {
            return true;
        }

        return false;
    }
	
	/**
     * @throws \SmartyException
     */
    /* public function processEntityAdd()
    {
		//dump($this->renderForm());
        // $this->content .= $this->renderForm();
		//$result = $this->mailchimp->post('/templates', ['name'=>'import', 'html'=>'']);
    } */
	
	/**
     * Object creation.
     *
     * @return ObjectModel|false
     *
     * @throws PrestaShopException
     */
    public function processAdd()
    {
		$campaignType = \Tools::getValue('campaignType');
		if (\Tools::strlen($campaignType) == 0) {
			$this->errors[] = $this->l('The campaign type is required');
		}
		
		$campaignSubject = \Tools::getValue('campaignSubject');
		if (\Tools::strlen($campaignSubject) == 0) {
			$this->errors[] = $this->l('The campaign subject is required');
		}
		
		$campaignTitle = \Tools::getValue('campaignTitle');
		if (\Tools::strlen($campaignTitle) == 0) {
			$this->errors[] = $this->l('The campaign title is required');
		}
		
		$campaignFromName = \Tools::getValue('campaignFromName');
		if (\Tools::strlen($campaignFromName) == 0) {
			$this->errors[] = $this->l("The campaign 'From name' is required");
		}
		
		$campaignRecipients = \Tools::getValue('campaignRecipients');
		if (\Tools::strlen($campaignRecipients) == 0) {
			$this->errors[] = $this->l('The campaign recipients are required');
		}

		$campaignTemplate = \Tools::getValue('campaignTemplate');
		if (\Tools::strlen($campaignTemplate) == 0) {
			$this->errors[] = $this->l('The campaign template is required');
		}
		
		$editing = \Tools::getValue('editing');
		
        if ($campaignType && $campaignSubject && $campaignTitle && $campaignFromName && $campaignRecipients && $campaignTemplate) {
            if ($response = $this->createMailchimpCampaign($campaignType, $campaignSubject, $campaignTitle, $campaignFromName, $campaignRecipients, $campaignTemplate, $editing)) {
				if ($editing) {
					$this->confirmations[] = $this->l('Campaign updated successfully');
					$this->redirect_after = self::$currentIndex . '&conf=4&token=' . $this->token;
				}
				else {
					$this->confirmations[] = $this->l('Campaign created successfully');
					$this->redirect_after = self::$currentIndex . '&conf=3&token=' . $this->token;
				}
            } else {
                $this->errors[] = $this->l('Oups! Failed to create campaign');
            }

        }
		
		$this->action = null;
	}
	
	/**
     * @throws \SmartyException
     */
    public function processEntityEdit()
    {
		//dump($this->renderForm());
        $this->content .= $this->renderForm();
		//$result = $this->mailchimp->post('/templates', ['name'=>'import', 'html'=>'']);
    }
	
	/**
     * @param $templateName
	 * @param $templateContent
     *
     * @return array|false
     * @throws Exception
     */
    private function createMailchimpCampaign($campaignType, $campaignSubject, $campaignTitle, $campaignFromName, $campaignRecipients, $campaignTemplate, $editing)
    {
        $this->queryParameters['type'] = $campaignType;
		$this->queryParameters['recipients'] = (object)[			
			'segment_opts' => (object)[
				'saved_segment_id' => (int)$campaignRecipients
			],
			'list_id' => $this->listId
		];
		$this->queryParameters['settings'] = (object)[
			'subject_line' => $campaignSubject,			
			'title' => $campaignTitle,
			'from_name' => $campaignFromName,
			'template_id' => (int)$campaignTemplate,
			'auto_footer' => false,
			'reply_to' => 'mazsola@wedis.ro'
		];		
		//dump($this->queryParameters);die();
		$result = $this->mailchimp->post(
			$this->getListApiEndpointUrl(),
            $this->queryParameters,
		);
		
		unset($this->queryParameters['type']);
		unset($this->queryParameters['recipients']);
		unset($this->queryParameters['settings']);
		
		//dump($result);die();
		
		if ($this->mailchimp->success()) {
            return $result;
        }

        throw new \PrestaChamps\MailchimpPro\Exceptions\MailChimpException($this->mailchimp->getLastError());
    }
	
	public function processEntitySend()
    {
        $entityId = \Tools::getValue('entity_id', false);

        if ($entityId) {
            if ($this->sendEntity($entityId)) {
                $this->confirmations[] = $this->module->l('Campaign sent');
				$this->redirect_after = self::$currentIndex . '&conf=10&token=' . $this->token;
            } else {
                $this->errors[] = $this->module->l('Could not send the campaign');
            }
        }
    }
	
	
	protected function renderEntityList()
    {
		if ($this->fields_form && is_array($this->fields_form)) {			
			$this->context->smarty->assign(['add_form' => $this->renderForm()]);			
		}
		
        parent::renderEntityList();
    }
    
}