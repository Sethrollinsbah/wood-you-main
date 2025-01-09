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
if (!defined('_PS_VERSION_')) {
    exit;
}
use PrestaChamps\Queue\Jobs\CartRuleSyncJob;
use PrestaChamps\Queue\Jobs\CustomerSyncJob;
use PrestaChamps\Queue\Jobs\ProductSyncJob;
use PrestaChamps\Queue\Jobs\OrderSyncJob;
use PrestaChamps\Queue\Jobs\NewsletterSubscriberSyncJob;
use PrestaChamps\PrestaShop\Traits\ShopIdTrait;
use PrestaChamps\MailchimpPro\Commands\StoreSyncCommand;
use PrestaChamps\MailchimpPro\Commands\SiteVerifyCommand;

class AdminMailchimpProConfigurationController extends ModuleAdminController
{
    use ShopIdTrait;

    static $Account_Info = null;
    
    public $bootstrap = true;

    private function getApiLogs()
    {
        $query = new DbQuery();
        $query->select('*');
        $query->from('mailchimppro_api_log');
        $query->orderBy('id DESC');

        // Execute the query and fetch the results
        return Db::getInstance()->executeS($query);
    }

    public function initContent()
    {
        $logs = $this->getApiLogs();

        if((\Shop::isFeatureActive() && \Shop::getContextShopID(true) != null) || !\Shop::isFeatureActive()){
            $multistore_on_store = true;
        }elseif(\Shop::getContextShopID(true) == null){
            $multistore_on_store = false;
        }

        $multistore_php_command = false;
        if (Configuration::get(MailchimpProConfig::CRONJOB_BASED_SYNC_FOR_MULTI_STORE) == true) {
            $multistore_php_command = true;
        }

        $jobs_deleted_message_show = true;
        $jobs_deleted_message_employee = Configuration::get(MailchimpProConfig::DELETED_JOBS_ON_UPGRADE_ACCEPTED_MESSAGE_EMPLOYEE);
        $jobs_deleted_message_date = Configuration::get(MailchimpProConfig::DELETED_JOBS_ON_UPGRADE_ACCEPTED_MESSAGE_DATE);

        $jobs_deleted_message_count = Configuration::hasKey(MailchimpProConfig::DELETED_JOBS_ON_UPGRADE_COUNT);


        if(($jobs_deleted_message_employee != null && $jobs_deleted_message_date != null) || empty($this->getAccountInfo()) || !$jobs_deleted_message_count){
            $jobs_deleted_message_show = false;
        }

        $syncAutoConfirm = false;
        $syncAutoConfirmListName = "";

        if(!Configuration::hasKey(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC) || 
            (Configuration::hasKey(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC) && (boolean)Configuration::get(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC))) {

            // automatic list_id selection and synchronization 
            if(!empty($this->getAccountInfo()) && (!Configuration::hasKey(MailchimpProConfig::MAILCHIMP_STORE_SYNCED) || Configuration::get(MailchimpProConfig::MAILCHIMP_STORE_SYNCED) == null)){
                try {

                    $lists = $this->module->getApiClient()->get('lists', ['fields' => 'lists.name,lists.id', 'count'=> 1000])['lists'];

                    if(count($lists) == 1){

                        $command = new StoreSyncCommand(
                            $this->context,
                            $this->module->getApiClient(),
                            [$this->context->shop->id]
                        );

                        $storeExists = $command->getStoreExists($this->getShopId(), true);

                        
                        $syncAutoConfirm = true;
                        $syncAutoConfirmListName = $lists[0]['name'];

                        if (isset($storeExists['domain']) && $storeExists['domain'] !== $this->context->shop->getBaseURL(true)) {
                            // dump("same shop ID other domain sync - NO multi instance");
                            MailchimpProConfig::saveValue(MailchimpProConfig::MULTI_INSTANCE_MODE, true);

                            $command = new StoreSyncCommand(
                                $this->context,
                                $this->module->getApiClient(),
                                [$this->context->shop->id]
                            );

                            $storeExists = $command->getStoreExists($this->getShopId(), true);

                            if (isset($storeExists['domain']) && $storeExists['domain'] === $this->context->shop->getBaseURL(true)) {
                                // dump("same domain sync");
                                $syncAutoConfirm = false;
                                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, true);
                            }else{
                                // dump("same shop ID other domain sync - multi instance");
                                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_ID, $lists[0]['id']);
                                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_NAME, $lists[0]['name']);

                                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC, 1);

                                $resp = $this->autoSyncStore();
                            }

                        }elseif (isset($storeExists['domain']) && $storeExists['domain'] === $this->context->shop->getBaseURL(true)) {
                            // dump("same domain sync");
                            $syncAutoConfirm = false;
                            MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, true);

                        }else{
                            // dump("no other domain, can be synched");

                            MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_ID, $lists[0]['id']);
                            MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_NAME, $lists[0]['name']);

                            MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC, 1);

                            $resp = $this->autoSyncStore();                        
                        }
                    }else{
                        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC, 0);
                    }

                } catch (Exception $exception) {
                    $this->errors[] = $exception->getMessage();
                }
            }
            // END automatic list_id selection and auto synchronization
        }

        if(Configuration::hasKey(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC) && (boolean)Configuration::get(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC)) {
            $syncAutoConfirm = (boolean)Configuration::get(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC);
            $syncAutoConfirmListName = Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_NAME);
        }

        $this->initMainConfigValues($multistore_on_store);

        $this->initDefaultOrderStatuses();

        if (!empty(Configuration::get(MailchimpProConfig::MAILCHIMP_API_KEY))) {
            $this->module->assignStatisticsVariables();
        }

        $this->context->controller->addCSS($this->module->getLocalPath() . 'views/css/configuration.css');
        Media::addJsDef([
            'queueUrl' => $this->context->link->getAdminLink('AdminMailchimpProQueue'),
            'middlewareUrl' => Mailchimppro::MC_MIDDLEWARE,
            'middlewareUrlUpgraded' => Mailchimppro::MC_MIDDLEWARE_NEW_TO_CONNECT,
            'configurationUrl' => $this->context->link->getAdminLink($this->controller_name),
            'mailchimp' => $this->getConfigValues(),
            'cronjobSecureToken' => Configuration::get(MailchimpProConfig::CRONJOB_SECURE_TOKEN),
        ]);
        $this->context->smarty->assign([
            'multistore_on_store' => $multistore_on_store,
            'multistore_php_command' => $multistore_php_command,
            'cronjob_multiStore' => \Shop::isFeatureActive(),
            'jobs_deleted_message_show' => $jobs_deleted_message_show,
            'validApiKey' => !empty($this->getAccountInfo()),
            'mainJsPath' =>
                Media::getJSPath(
                    $this->module->getLocalPath() . 'views/js/configuration/main.js'
                ),
            'configurationUrl' => $this->context->link->getAdminLink($this->controller_name),
            'listId' => Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_ID),
            'imageSizes' => $this->getImageSizes(),
            'cronjobLog' => $this->getCronjobLogContent(),
            'cronjobUrlLink' => $this->context->link->getModuleLink($this->module->name, 'cronjob') . '?secure=' . Configuration::get(MailchimpProConfig::CRONJOB_SECURE_TOKEN),
            'cronjobUrlLinkWget' => '* * * * * wget -O - ' . $this->context->link->getModuleLink($this->module->name, 'cronjob') . '?secure=' . Configuration::get(MailchimpProConfig::CRONJOB_SECURE_TOKEN),
            'cronjobUrlPath' => '* * * * * '.(defined('PHP_BINDIR') && PHP_BINDIR && is_string(PHP_BINDIR) ? PHP_BINDIR.'/' : '').'php ' . _PS_MODULE_DIR_ . $this->module->name . '/cronjob.php secure=' . Configuration::get(MailchimpProConfig::CRONJOB_SECURE_TOKEN),
            'lastCronjob' => Configuration::get(MailchimpProConfig::LAST_CRONJOB),
            'lastCronjobExecutionTime' => Configuration::get(MailchimpProConfig::LAST_CRONJOB_EXECUTION_TIME),
            'totalJobs' => $this->getNumberOfTotalJobs(),
            'autoSyncPopup' => $syncAutoConfirm,
            'autoSyncPopupListName' => $syncAutoConfirmListName,
            'logs' => $logs,
        ]);
        $this->content = $this->context->smarty->fetch(
            $this->module->getLocalPath() . 'views/templates/admin/configuration/main.tpl'
        );
        parent::initContent();
    }

    public function getDefinedPresets() {
        return [
            'advanced' => [
                'title' => $this->l('Advanced', 'AdminMailchimpProConfigurationController'),
                'description' => $this->l('This preset automatically synchronizes data for both abandoned cart recovery and newsletter signups. It includes extensive data synchronization to ensure marketing and cart recovery campaigns have full context.', 'AdminMailchimpProConfigurationController'),
                'sync-type' => $this->l('Cronjob based', 'AdminMailchimpProConfigurationController'),
                'data-sync' => [
                    $this->l('All active products', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active customers (last 6 months)', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active cart rules', 'AdminMailchimpProConfigurationController'),
                    $this->l('All orders (last 6 months)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Carts (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Newsletter signups (lifetime)', 'AdminMailchimpProConfigurationController'),
                ],
                'config-values' => [
                    'cronjobBasedSync' => true,
                    'syncProducts' => true,
                    'productSyncFilterActive' => [1], // [1] - Only active, [0, 1] - All
                    'productSyncFilterVisibility' => ['both', 'catalog', 'search', 'none'], // ['both', 'catalog', 'search', 'none'] - All, ['both'] - Both, ['catalog'] - Catalog, ['search'] - Search
                    'syncCustomers' => true,
                    'customerSyncFilterEnabled' => [1], // [1] - Only active, [0,1] - All
                    'customerSyncFilterNewsletter' => [0, 1], // [1] - Only opted-in, [0, 1] - All (transactional + opted-in)
                    'customerSyncFilterPeriod' => '-6 months',  // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCartRules' => true,
                    'cartRuleSyncFilterStatus' => [1], // [1] - Only active with available quantity, [0,1] - All
                    'cartRuleSyncFilterExpiration' => [1], // [1] - Only active, [0,1] - All
                    'syncOrders' => true,
                    'existingOrderSyncStrategy' => '-6 months',  // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCarts' => true,
                    'syncNewsletterSubscribers' => true,
                    'newsletterSubscriberSyncFilterPeriod' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                ],
                'use-case' => $this->l('Suitable for businesses wanting to ensure comprehensive data coverage, focusing on both email marketing and recovering abandoned carts.', 'AdminMailchimpProConfigurationController'),
            ],
            'basic' => [
                'title' => $this->l('Basic', 'AdminMailchimpProConfigurationController'),
                'description' => $this->l('This preset is designed to only manage basic email subscribers. It does not synchronize any cart, order, or cart rule data from your system.', 'AdminMailchimpProConfigurationController'),
                'sync-type' => $this->l('Cronjob based', 'AdminMailchimpProConfigurationController'),
                'data-sync' => [
                    $this->l('All active products', 'AdminMailchimpProConfigurationController'),
                    $this->l('Newsletter signups only (including subscribed customers)', 'AdminMailchimpProConfigurationController'),
                ],
                'config-values' => [
                    'cronjobBasedSync' => true,
                    'syncProducts' => true,
                    'productSyncFilterActive' => [1], // [1] - Only active, [0, 1] - All
                    'productSyncFilterVisibility' => ['both', 'catalog', 'search', 'none'], // ['both', 'catalog', 'search', 'none'] - All, ['both'] - Both, ['catalog'] - Catalog, ['search'] - Search
                    'syncCustomers' => true,
                    'customerSyncFilterEnabled' => [1], // [1] - Only active, [0,1] - All
                    'customerSyncFilterNewsletter' => [1], // [1] - Only opted-in, [0, 1] - All (transactional + opted-in)
                    'customerSyncFilterPeriod' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCartRules' => false,
                    'syncOrders' => false,
                    'syncCarts' => false,
                    'syncNewsletterSubscribers' => true,
                    'newsletterSubscriberSyncFilterPeriod' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                ],
                'use-case' => $this->l('Ideal for businesses that want to use Mailchimp solely for managing subscribers and sending newsletters, without integrating complex eCommerce data.', 'AdminMailchimpProConfigurationController'),
            ],
            'free' => [
                'title' => $this->l('Free (testing purposes)', 'AdminMailchimpProConfigurationController'),
                'description' => $this->l('This preset is designed to synchronize data to test the free Mailchimp plan for email sending. It syncs relevant information like customers, products, and orders. Allows the use of a single list.', 'AdminMailchimpProConfigurationController'),
                'sync-type' => $this->l('Cronjob based', 'AdminMailchimpProConfigurationController'),
                'data-sync' => [
                    $this->l('All active products', 'AdminMailchimpProConfigurationController'),
                    $this->l('Customers (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active cart rules', 'AdminMailchimpProConfigurationController'),
                    $this->l('Orders (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Carts (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Newsletter signups (from now on)', 'AdminMailchimpProConfigurationController'),
                ],
                'config-values' => [
                    'cronjobBasedSync' => true,
                    'syncProducts' => true,
                    'productSyncFilterActive' => [1], // [1] - Only active, [0, 1] - All
                    'productSyncFilterVisibility' => ['both', 'catalog', 'search', 'none'], // ['both', 'catalog', 'search', 'none'] - All, ['both'] - Both, ['catalog'] - Catalog, ['search'] - Search
                    'syncCustomers' => true,
                    'customerSyncFilterEnabled' => [1], // [1] - Only active, [0,1] - All
                    'customerSyncFilterNewsletter' => [0, 1], // [1] - Only opted-in, [0, 1] - All (transactional + opted-in)
                    'customerSyncFilterPeriod' => 'onlyNew', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCartRules' => true,
                    'cartRuleSyncFilterStatus' => [1], // [1] - Only active with available quantity, [0,1] - All
                    'cartRuleSyncFilterExpiration' => [1], // [1] - Only active, [0,1] - All
                    'syncOrders' => true,
                    'existingOrderSyncStrategy' => 'onlyNew', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCarts' => true,
                    'syncNewsletterSubscribers' => true,
                    'newsletterSubscriberSyncFilterPeriod' => 'onlyNew', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                ],
                'use-case' => $this->l('This is for new marketers with big ideas who want to get online, build an audience, and start growing on day one.', 'AdminMailchimpProConfigurationController'),
                'list-member-limit' => 500,
            ],
            'abandoned-cart' => [
                'title' => $this->l('Abandoned Cart', 'AdminMailchimpProConfigurationController'),
                'description' => $this->l('This preset is designed to synchronize data for abandoned cart emails. It syncs relevant information like customers, products, and orders.', 'AdminMailchimpProConfigurationController'),
                'sync-type' => $this->l('Cronjob based', 'AdminMailchimpProConfigurationController'),
                'data-sync' => [
                    $this->l('All active products', 'AdminMailchimpProConfigurationController'),
                    $this->l('Customers (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active cart rules', 'AdminMailchimpProConfigurationController'),
                    $this->l('Orders (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Carts (from now on)', 'AdminMailchimpProConfigurationController'),
                ],
                'config-values' => [
                    'cronjobBasedSync' => true,
                    'syncProducts' => true,
                    'productSyncFilterActive' => [1], // [1] - Only active, [0, 1] - All
                    'productSyncFilterVisibility' => ['both', 'catalog', 'search', 'none'], // ['both', 'catalog', 'search', 'none'] - All, ['both'] - Both, ['catalog'] - Catalog, ['search'] - Search
                    'syncCustomers' => true,
                    'customerSyncFilterEnabled' => [1], // [1] - Only active, [0,1] - All
                    'customerSyncFilterNewsletter' => [0, 1], // [1] - Only opted-in, [0, 1] - All (transactional + opted-in)
                    'customerSyncFilterPeriod' => 'onlyNew', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCartRules' => true,
                    'cartRuleSyncFilterStatus' => [1], // [1] - Only active with available quantity, [0,1] - All
                    'cartRuleSyncFilterExpiration' => [1], // [1] - Only active, [0,1] - All
                    'syncOrders' => true,
                    'existingOrderSyncStrategy' => 'onlyNew', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCarts' => true,
                    'syncNewsletterSubscribers' => false,
                ],
                'use-case' => $this->l('Suitable for stores focused on recovering abandoned carts and optimizing revenue through reminder emails within a 90-day window.', 'AdminMailchimpProConfigurationController'),
            ],
            'custom' => [
                'title' => $this->l('Custom', 'AdminMailchimpProConfigurationController'),
                'description' => sprintf($this->l('This preset offers all features available in the %s"Advanced Package"%s with some additional options, but it is manually operated from the back office and is triggered by specific events or hooks.', 'AdminMailchimpProConfigurationController'), 
                                    '<b>',
                                    '</b>'
                                ),
                'sync-type' => $this->l('Cronjob based', 'AdminMailchimpProConfigurationController'),
                'data-sync' => [
                    $this->l('All active products', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active customers (last 12 months)', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active cart rules', 'AdminMailchimpProConfigurationController'),
                    $this->l('All orders (last 12 months)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Carts (from now on)', 'AdminMailchimpProConfigurationController'),
                    $this->l('Newsletter signups (lifetime)', 'AdminMailchimpProConfigurationController'),
                ],
                'config-values' => [
                    'cronjobBasedSync' => true,
                    'syncProducts' => true,
                    'productSyncFilterActive' => [1], // [1] - Only active, [0, 1] - All
                    'productSyncFilterVisibility' => ['both', 'catalog', 'search', 'none'], // ['both', 'catalog', 'search', 'none'] - All, ['both'] - Both, ['catalog'] - Catalog, ['search'] - Search
                    'syncCustomers' => true,
                    'customerSyncFilterEnabled' => [1], // [1] - Only active, [0,1] - All
                    'customerSyncFilterNewsletter' => [0, 1], // [1] - Only opted-in, [0, 1] - All (transactional + opted-in)
                    'customerSyncFilterPeriod' => '-1 year', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCartRules' => true,
                    'cartRuleSyncFilterStatus' => [1], // [1] - Only active with available quantity, [0,1] - All
                    'cartRuleSyncFilterExpiration' => [1], // [1] - Only active, [0,1] - All
                    'syncOrders' => true,
                    'existingOrderSyncStrategy' => '-1 year', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCarts' => true,
                    'syncNewsletterSubscribers' => true,
                    'newsletterSubscriberSyncFilterPeriod' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                ],
                'use-case' => $this->l('Ideal for users who prefer manual control over data syncs, triggering updates via specific hooks or direct operations.', 'AdminMailchimpProConfigurationController'),
            ],
            'full' => [
                'title' => $this->l('Full', 'AdminMailchimpProConfigurationController'),
                'description' => $this->l('This preset synchronizes all available data. It includes everything from customer interactions to orders, products, carts, and newsletters without any time restriction.', 'AdminMailchimpProConfigurationController'),
                'sync-type' => $this->l('Cronjob based', 'AdminMailchimpProConfigurationController'),
                'data-sync' => [
                    $this->l('All active products', 'AdminMailchimpProConfigurationController'),
                    $this->l('All customers (no time restriction)', 'AdminMailchimpProConfigurationController'),
                    $this->l('All active cart rules', 'AdminMailchimpProConfigurationController'),
                    $this->l('All orders (no time restriction)', 'AdminMailchimpProConfigurationController'),
                    $this->l('All carts', 'AdminMailchimpProConfigurationController'),
                    $this->l('Newsletter signups (lifetime)', 'AdminMailchimpProConfigurationController'),
                ],
                'config-values' => [
                    'cronjobBasedSync' => true,
                    'syncProducts' => true,
                    'productSyncFilterActive' => [1], // [1] - Only active, [0, 1] - All
                    'productSyncFilterVisibility' => ['both', 'catalog', 'search', 'none'], // ['both', 'catalog', 'search', 'none'] - All, ['both'] - Both, ['catalog'] - Catalog, ['search'] - Search
                    'syncCustomers' => true,
                    'customerSyncFilterEnabled' => [1], // [1] - Only active, [0,1] - All
                    'customerSyncFilterNewsletter' => [0, 1], // [1] - Only opted-in, [0, 1] - All (transactional + opted-in)
                    'customerSyncFilterPeriod' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCartRules' => true,
                    'cartRuleSyncFilterStatus' => [1], // [1] - Only active with available quantity, [0,1] - All
                    'cartRuleSyncFilterExpiration' => [1], // [1] - Only active, [0,1] - All
                    'syncOrders' => true,
                    'existingOrderSyncStrategy' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                    'syncCarts' => true,
                    'syncNewsletterSubscribers' => true,
                    'newsletterSubscriberSyncFilterPeriod' => 'all', // 'onlyNew', '-1 months', '-3 months', '-6 months', '-1 year', 'all'
                ],
                'use-case' => $this->l('Ideal for businesses seeking full synchronization with Mailchimp, ensuring complete data availability for marketing and sales campaigns with no omissions.', 'AdminMailchimpProConfigurationController'),
            ],
        ];
    }

    protected function initMainConfigValues($multistore_on_store)
    {
        if (!Configuration::get(MailchimpProConfig::CRONJOB_SECURE_TOKEN)) {
            MailchimpProConfig::saveValue(MailchimpProConfig::CRONJOB_SECURE_TOKEN, bin2hex(openssl_random_pseudo_bytes(32)));
        }

        if($multistore_on_store){
            if (!Configuration::get(MailchimpProConfig::MAILCHIMP_API_KEY)) {
                $this->informations[] = $this->l('Please log in to Mailchimp...', 'AdminMailchimpProConfigurationController');
            } elseif (!Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_ID) || !Configuration::get(MailchimpProConfig::MAILCHIMP_STORE_SYNCED)) {
                try {
                    $command = new StoreSyncCommand(
                        $this->context,
                        $this->module->getApiClient(),
                        [$this->context->shop->id]
                    );
                    if ($storeExists = $command->getStoreExists($this->getShopId(), true)) {
                        if (isset($storeExists['list_id']) && $storeExists['list_id']) {
                            // MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_ID, $storeExists['list_id']);
                            if (isset($storeExists['domain']) && $storeExists['domain'] === $this->context->shop->getBaseURL(true)) {
                                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_ID, $storeExists['list_id']);
                                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, true);
                                Media::addJsDef([
                                    'storeAlreadySynced' => true,
                                ]);
                            }
                            elseif (isset($storeExists['domain']) && $storeExists['domain'] !== $this->context->shop->getBaseURL(true)) {
                                MailchimpProConfig::saveValue(MailchimpProConfig::MULTI_INSTANCE_MODE, true);
                                $storeExists = $command->getStoreExists($this->getShopId(), true);
                                if (isset($storeExists['domain']) && $storeExists['domain'] === $this->context->shop->getBaseURL(true)) {
                                    MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_ID, $storeExists['list_id']);
                                    MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, true);
                                    Media::addJsDef([
                                        'storeAlreadySynced' => true,
                                    ]);
                                }
                                // else {
                                //     // Media::addJsDef([
                                //     //     'storeAlreadySynced' => true,
                                //     // ]);
                                //     $this->context->smarty->assign([
                                //         'storeSyncWarningMessage' => '<p>' . sprintf(
                                //             $this->l('It appears that you have a separate store with the same Id (%s) in your Mailchimp account as the current store, but on a different domain (%s) which is assigned to the same audience list (%s).', 'AdminMailchimpProConfigurationController'),
                                //             '<b>' . $this->context->shop->id . '</b>',
                                //             '<b>' . $storeExists['domain'] . '</b>',
                                //             '<b>' . ((isset($storeExists['list_id']) && $storeExists['list_id']) ? $this->module->getApiClient()->get("lists/{$storeExists['list_id']}")['name'] : '') . '</b>'
                                //         ) . '</p><p>' . sprintf(
                                //             $this->l('Because this is a different store on a different domain, it is advised to enable the %s Multi instance mode %s on the %s Advanced settings %s tab in order to obtain a unique identifier for the current store and to prevent overwriting the store information and messing up all the e-commerce data in your Mailchimp account. On your Mailchimp account, you can also create a different audience list for this distinct store. After the %s Multi instance mode %s is activated, you can choose that list and attach it to the current store by clicking the %s Initialize connection %s button. ', 'AdminMailchimpProConfigurationController'),
                                //             '<b>',
                                //             '</b>',
                                //             '<b><a href="' . $this->context->link->getAdminLink($this->controller_name) . '#advanced-settings">',
                                //             '</a></b>',
                                //             '<b>',
                                //             '</b>',
                                //             '<b>',
                                //             '</b>'
                                //         ) . '</p>'
                                //     ]);
                                // }
                            }
                        }
                    }
                } catch (Exception $exception) {
                    $this->errors[] = $exception->getMessage();
                }
            }
        }
    }

    protected function initDefaultOrderStatuses()
    {
        if (!Configuration::get(MailchimpProConfig::STATUSES_FOR_PENDING) || Configuration::get(MailchimpProConfig::STATUSES_FOR_PENDING) == '[]' ||
            !Configuration::get(MailchimpProConfig::STATUSES_FOR_REFUNDED) || Configuration::get(MailchimpProConfig::STATUSES_FOR_REFUNDED) == '[]' ||
            !Configuration::get(MailchimpProConfig::STATUSES_FOR_CANCELLED) || Configuration::get(MailchimpProConfig::STATUSES_FOR_CANCELLED) == '[]' ||
            !Configuration::get(MailchimpProConfig::STATUSES_FOR_SHIPPED) || Configuration::get(MailchimpProConfig::STATUSES_FOR_SHIPPED) == '[]' ||
            !Configuration::get(MailchimpProConfig::STATUSES_FOR_PAID) || Configuration::get(MailchimpProConfig::STATUSES_FOR_PAID) == '[]') {

            $orderStatuses = [];
            $orderStates = OrderState::getOrderStates($this->context->language->id);
            foreach ($orderStates as $orderState) {
                switch (true) {
                    case ($orderState['template'] == "bankwire" || $orderState['template'] == "cashondelivery" || $orderState['template'] == "cheque"):
                        $orderStatuses['pending'][] = $orderState['id_order_state'];
                        break;
                    case $orderState['template'] == "refund":
                        $orderStatuses['refunded'][] = $orderState['id_order_state'];
                        break;
                    case $orderState['template'] == "order_canceled":
                        $orderStatuses['cancelled'][] = $orderState['id_order_state'];
                        break;
                    case $orderState['template'] == "shipped":
                        $orderStatuses['shipped'][] = $orderState['id_order_state'];
                        break;
                    case $orderState['template'] == "payment":
                        $orderStatuses['paid'][] = $orderState['id_order_state'];
                        break;
                }
            }

            if (!Configuration::get(MailchimpProConfig::STATUSES_FOR_PENDING) || Configuration::get(MailchimpProConfig::STATUSES_FOR_PENDING) == '[]') {
                if (isset($orderStatuses['pending'])) {
                    MailchimpProConfig::saveValue(MailchimpProConfig::STATUSES_FOR_PENDING, json_encode($orderStatuses['pending']));
                }
            }
            if (!Configuration::get(MailchimpProConfig::STATUSES_FOR_REFUNDED) || Configuration::get(MailchimpProConfig::STATUSES_FOR_REFUNDED) == '[]') {
                if (isset($orderStatuses['refunded'])) {
                    MailchimpProConfig::saveValue(MailchimpProConfig::STATUSES_FOR_REFUNDED, json_encode($orderStatuses['refunded']));
                }
            }
            if (!Configuration::get(MailchimpProConfig::STATUSES_FOR_CANCELLED) || Configuration::get(MailchimpProConfig::STATUSES_FOR_CANCELLED) == '[]') {
                if (isset($orderStatuses['cancelled'])) {
                    MailchimpProConfig::saveValue(MailchimpProConfig::STATUSES_FOR_CANCELLED, json_encode($orderStatuses['cancelled']));
                }
            }
            if (!Configuration::get(MailchimpProConfig::STATUSES_FOR_SHIPPED) || Configuration::get(MailchimpProConfig::STATUSES_FOR_SHIPPED) == '[]') {
                if (isset($orderStatuses['shipped'])) {
                    MailchimpProConfig::saveValue(MailchimpProConfig::STATUSES_FOR_SHIPPED, json_encode($orderStatuses['shipped']));
                }
            }
            if (!Configuration::get(MailchimpProConfig::STATUSES_FOR_PAID) || Configuration::get(MailchimpProConfig::STATUSES_FOR_PAID) == '[]') {
                if (isset($orderStatuses['paid'])) {
                    MailchimpProConfig::saveValue(MailchimpProConfig::STATUSES_FOR_PAID, json_encode($orderStatuses['paid']));
                }
            }
        }
    }

    protected function getOrderStates()
    {
        $orderStates = [];
        foreach (OrderState::getOrderStates($this->context->language->id) as $orderState) {
            $orderStates[] = [
                'label' => $orderState['name'],
                'value' => $orderState['id_order_state'],
                'color' => $orderState['color'],
            ];
        }
        return $orderStates;
    }

    /**
     * Get the available image sizes
     *
     * @return array
     */
    private function getImageSizes()
    {
        $query = new DbQuery();
        $query->select('name, width, height');
        $query->from('image_type');
        $query->where('products = 1');

        try {
            $results = Db::getInstance()->executeS($query);
        } catch (Exception $exception) {
            $this->errors[] = $exception->getMessage();
            return [];
        }

        // init default product image size
        if (!Configuration::get(MailchimpProConfig::PRODUCT_IMAGE_SIZE) || Configuration::get(MailchimpProConfig::PRODUCT_IMAGE_SIZE) == 'null') {
            $resultNames = array_column($results, 'name');

            $large_name = '';
            if ((bool)version_compare(_PS_VERSION_, '1.7', '>=')) {
                $large_name = ImageType::getFormattedName('large'); // from PS 1.7
            }

            $key = array_search($large_name, $resultNames);
            if ($key !== false) {
                MailchimpProConfig::saveValue(MailchimpProConfig::PRODUCT_IMAGE_SIZE, $large_name);
            }
            else {
                if (!empty($resultNames)) {
                    MailchimpProConfig::saveValue(MailchimpProConfig::PRODUCT_IMAGE_SIZE, $resultNames[0]);
                }
            }
        }

        return $results;
    }

    /**
     * @return array
     */
    private function getAccountInfo()
    {
        try {
            if (!Configuration::get(MailchimpProConfig::MAILCHIMP_API_KEY)) {
                return [];
            }

            if(static::$Account_Info == null){
                $info = $this->module->getApiClient()->get('');
                if (!$this->module->getApiClient()->success()) {
                    return [];
                }
                static::$Account_Info = $info;

                return static::$Account_Info;
            }else{
                return static::$Account_Info;
            }
            
        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * @param null $value
     * @param null $controller
     * @param null $method
     * @param int $statusCode
     */
    public function ajaxDie($value = null, $controller = null, $method = null, $statusCode = 200)
    {
        header('Content-Type: application/json');
        if (!is_scalar($value)) {
            $value = json_encode($value);
        }

        http_response_code($statusCode);
        parent::ajaxDie($value, $controller, $method);
    }

    public function ajaxProcessDisconnect()
    {
        $accountInfo = $this->getAccountInfo();
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_ACCOUNT_ID_LOGGED_OUT, $accountInfo['account_id']);

        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_API_KEY, false);
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_ID, false);
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_LIST_NAME, false);
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, false);

        $accountInfo = $this->getAccountInfo();

        $this->ajaxDie([
            'accountInfo' => $accountInfo,
            'validApiKey' => !empty($accountInfo)
        ]);
    }

    public function ajaxProcessConnect()
    {
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_API_KEY, $this->getJsonPayloadValue('token'));
        $accountInfo = $this->getAccountInfo();

        if(Configuration::hasKey(MailchimpProConfig::MAILCHIMP_ACCOUNT_ID_LOGGED_OUT) && Configuration::get(MailchimpProConfig::MAILCHIMP_ACCOUNT_ID_LOGGED_OUT) != ""){
            if(Configuration::get(MailchimpProConfig::MAILCHIMP_ACCOUNT_ID_LOGGED_OUT) !== $accountInfo['account_id']){
                // reset the config variables to start again the setup process
                MailchimpProConfig::resetConfigForNewAccount();                
            }
        }

        $this->ajaxDie([
            'accountInfo' => $accountInfo,
            'validApiKey' => !empty($accountInfo)
        ]);
    }

    protected function ajaxProcessExecuteCronjob()
    {
        $queue = new PrestaChamps\Queue\Queue();
        $queue->runCronjob();
    }

    protected function ajaxProcessClearCronjobLog()
    {
        $hasError = false;
        $errorResponse = '';

        // Define the expected log file path
        $logFilePath = _PS_MODULE_DIR_ . $this->module->name . '/logs/cronjob.log';

        // Resolve the real path to avoid path traversal issues
        $resolvedFilePath = realpath($logFilePath);

        // Ensure the resolved file path is valid and within the expected directory
        if ($resolvedFilePath && strpos($resolvedFilePath, _PS_MODULE_DIR_ . $this->module->name . '/logs/') === 0) {
            if (file_exists($resolvedFilePath)) {
                if (!unlink($resolvedFilePath)) {
                    $errorResponse = $this->l('Cannot clear cronjob log. Please check the file permissions.', 'AdminMailchimpProConfigurationController');
                    $hasError = true;
                }
            } else {
                $errorResponse = $this->l('Cronjob log is already cleaned.', 'AdminMailchimpProConfigurationController');
                $hasError = true;
            }
        } else {
            $errorResponse = $this->l('Invalid file path.', 'AdminMailchimpProConfigurationController');
            $hasError = true;
        }

        $this->ajaxDie([
            'hasError' => $hasError,
            'errorMessage' => $hasError ? $errorResponse : null,
            'successMessage' => $hasError ? null : $this->l('Cleared cronjob log successfully.', 'AdminMailchimpProConfigurationController'),
        ]);
    }

    public function getNumberOfTotalJobs()
    {
        $queue = new PrestaChamps\Queue\Queue();

        return $queue->getNumberOfTotalJobs();
    }

    public function getJsonPayloadValue($key, $defaultValue = null)
    {
        $body = json_decode(Tools::file_get_contents('php://input'), true);

        return isset($body[$key]) ? $body[$key] : $defaultValue;
    }

    public function getConfigValues()
    {
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $accountInfo = $this->getAccountInfo();
        $configValues = MailchimpProConfig::getConfigurationValues();
        $lists = [];
        try {
            if (!Configuration::get(MailchimpProConfig::MAILCHIMP_API_KEY)) {
                $lists = [];
            }
            else {

                if(!empty(Configuration::get(MailchimpProConfig::MAILCHIMP_STORE_SYNCED)) && !empty(Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_ID)) && !empty(Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_NAME))){

                    $lists[] = [
                        'label' => Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_NAME),
                        'value' => Configuration::get(MailchimpProConfig::MAILCHIMP_LIST_ID)
                    ];                    
                    
                }else{
                    $lists = $this->module->getApiClient()->get('lists', ['fields' => 'lists.name,lists.id', 'count'=> 1000])['lists'];

                    if($lists){
                        $lists = array_map(function ($list) {
                            return [
                                'label' => $list['name'],
                                'value' => $list['id']
                            ];
                        }, $lists);
                    }
                    else{
                        $response = json_decode(($this->module->getApiClient()->getLastResponse())['body'], true);
                        $this->errors[] = $response['title'] . ': ' . $response['detail'];
                    }
                }
            }

        } catch (Exception $exception) {
            $this->errors[] = $exception->getMessage();
            $lists = [];
        }

        return [
            'definedPresets' => $this->getDefinedPresets(),
            'selectedPreset' => $configValues[MailchimpProConfig::SELECTED_PRESET], //null, //advanced, basic, abandoned-cart, custom, full
            'multiInstanceMode' => (bool)$configValues[MailchimpProConfig::MULTI_INSTANCE_MODE],
            'cronjobBasedSync' => (bool)$configValues[MailchimpProConfig::CRONJOB_BASED_SYNC],
            'syncProducts' => (bool)$configValues[MailchimpProConfig::SYNC_PRODUCTS],
            'syncCustomers' => (bool)$configValues[MailchimpProConfig::SYNC_CUSTOMERS],
            'syncCartRules' => (bool)$configValues[MailchimpProConfig::SYNC_CART_RULES],
            'syncOrders' => (bool)$configValues[MailchimpProConfig::SYNC_ORDERS],
            'syncCarts' => (bool)$configValues[MailchimpProConfig::SYNC_CARTS],
            'syncCartsPassw' => (bool)$configValues[MailchimpProConfig::SYNC_CARTS_PASSW],
            'syncNewsletterSubscribers' => (bool)$configValues[MailchimpProConfig::SYNC_NEWSLETTER_SUBSCRIBERS],
            'statusForPending' => $configValues[MailchimpProConfig::STATUSES_FOR_PENDING],
            'statusForRefunded' => $configValues[MailchimpProConfig::STATUSES_FOR_REFUNDED],
            'statusForCancelled' => $configValues[MailchimpProConfig::STATUSES_FOR_CANCELLED],
            'statusForShipped' => $configValues[MailchimpProConfig::STATUSES_FOR_SHIPPED],
            'statusForPaid' => $configValues[MailchimpProConfig::STATUSES_FOR_PAID],
            'orderStates' => $this->getOrderStates(),
            'productDescriptionField' => $configValues[MailchimpProConfig::PRODUCT_DESCRIPTION_FIELD],
            'existingOrderSyncStrategy' => $configValues[MailchimpProConfig::EXISTING_ORDER_SYNC_STRATEGY],
            'productSyncFilterActive' => $configValues[MailchimpProConfig::PRODUCT_SYNC_FILTER_ACTIVE],
            'productSyncFilterVisibility' => $configValues[MailchimpProConfig::PRODUCT_SYNC_FILTER_VISIBILITY],
            'customerSyncFilterEnabled' => $configValues[MailchimpProConfig::CUSTOMER_SYNC_FILTER_ENABLED],
            'customerSyncFilterNewsletter' => $configValues[MailchimpProConfig::CUSTOMER_SYNC_FILTER_NEWSLETTER],
            'customerSyncFilterPeriod' => $configValues[MailchimpProConfig::CUSTOMER_SYNC_FILTER_PERIOD],
            'customerSyncTagDefaultGroup' => $configValues[MailchimpProConfig::CUSTOMER_SYNC_TAG_DEFAULT_GROUP],
            'customerSyncTagGender' => (bool)$configValues[MailchimpProConfig::CUSTOMER_SYNC_TAG_GENDER],
            'cartRuleSyncFilterStatus' => $configValues[MailchimpProConfig::CART_RULE_SYNC_FILTER_STATUS],
            'cartRuleSyncFilterExpiration' => $configValues[MailchimpProConfig::CART_RULE_SYNC_FILTER_EXPIRATION],
            'newsletterSubscriberSyncFilterPeriod' => $configValues[MailchimpProConfig::NEWSLETTER_SUBSCRIBER_SYNC_FILTER_PERIOD],
            'productImageSize' => $configValues[MailchimpProConfig::PRODUCT_IMAGE_SIZE],
            'token' => $configValues[MailchimpProConfig::MAILCHIMP_API_KEY],
            'listId' => $configValues[MailchimpProConfig::MAILCHIMP_LIST_ID],
            'lists' => $lists,
            'storeSynced' => (bool)$configValues[MailchimpProConfig::MAILCHIMP_STORE_SYNCED],
            'validApiKey' => !empty($accountInfo),
            'accountInfo' => $accountInfo,
            'numberOfCartRulesToSync' => $repository->getCartRulesCount(),
            'numberOfCustomersToSync' => $repository->getCustomersCount(),
            'numberOfProductsToSync' => $repository->getProductsCount(),
            'numberOfOrdersToSync' => $repository->getOrdersCount(),
            'numberOfNewsletterSubscribersToSync' => $repository->getNewsletterSubscribersCount(),
            'logQueue' => $configValues[MailchimpProConfig::LOG_QUEUE],
            'queueStep' => $configValues[MailchimpProConfig::QUEUE_STEP],
            'queueAttempt' => $configValues[MailchimpProConfig::QUEUE_ATTEMPT],
            'logCronjob' => $configValues[MailchimpProConfig::LOG_CRONJOB],
            'cronjobLogContent' => $this->getCronjobLogContent(),
            'lastSyncedProductId' => $configValues[MailchimpProConfig::LAST_SYNCED_PRODUCT_ID],
            'lastSyncedCustomerId' => $configValues[MailchimpProConfig::LAST_SYNCED_CUSTOMER_ID],
            'lastSyncedCartRuleId' => $configValues[MailchimpProConfig::LAST_SYNCED_PROMO_ID],
            'lastSyncedOrderId' => $configValues[MailchimpProConfig::LAST_SYNCED_ORDER_ID],
            'lastSyncedCartId' => $configValues[MailchimpProConfig::LAST_SYNCED_CART_ID],
            'lastSyncedNewsletterSubscriberId' => $configValues[MailchimpProConfig::LAST_SYNCED_NEWSLETTER_SUBSCRIBER_ID],
            'lastCronjob' => $configValues[MailchimpProConfig::LAST_CRONJOB],
            'lastCronjobExecutionTime' => $configValues[MailchimpProConfig::LAST_CRONJOB_EXECUTION_TIME],
            'totalJobs' => $this->getNumberOfTotalJobs(),
            'showDashboardStats' => $configValues[MailchimpProConfig::SHOW_DASHBOARD_STATS],
        ];
    }

    public function ajaxProcessSaveSettings()
    {
        foreach (MailchimpProConfig::$keyMap as $index => $item) {
            $value = $this->getJsonPayloadValue($index);
            $value = is_scalar($value) ? $value : json_encode($value);
            if (is_bool($value)) {
                $value = (int)$value;
            }
            MailchimpProConfig::saveValue($item, $value);
        }
        die();
    }

    public function ajaxProcessMarkReadJsonJobs()
    {
        Configuration::updateGlobalValue(MailchimpProConfig::DELETED_JOBS_ON_UPGRADE_ACCEPTED_MESSAGE_DATE, date('Y-m-d H:i:s'));
        Configuration::updateGlobalValue(MailchimpProConfig::DELETED_JOBS_ON_UPGRADE_ACCEPTED_MESSAGE_EMPLOYEE, Context::getContext()->employee->id);
        die();
    }

    public function ajaxProcessMarkReadAutoList()
    {
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC_ACCEPTED_MESSAGE_DATE, date('Y-m-d H:i:s'));
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC_ACCEPTED_MESSAGE_EMPLOYEE, Context::getContext()->employee->id);
        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC, 0);
        die();
    }

    public function ajaxProcessGetEntityCount()
    {
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $this->ajaxDie([
            'products' => $repository->getProductsCount(),
            'orders' => $repository->getOrdersCount(),
            'customers' => $repository->getCustomersCount(),
            'cartRules' => $repository->getCartRulesCount(),
            'newsletterSubscribers' => $repository->getNewsletterSubscribersCount(),
            'totalJobs' => $this->getNumberOfTotalJobs(),
        ]);
    }

    public function ajaxProcessUpdateStaticContent()
    {
        $configValues = MailchimpProConfig::getConfigurationValues();
        $this->ajaxDie([
            'cronjobLogContent' => $this->getCronjobLogContent(),
            'lastSyncedProductId' => $configValues[MailchimpProConfig::LAST_SYNCED_PRODUCT_ID],
            'lastSyncedCustomerId' => $configValues[MailchimpProConfig::LAST_SYNCED_CUSTOMER_ID],
            'lastSyncedCartRuleId' => $configValues[MailchimpProConfig::LAST_SYNCED_PROMO_ID],
            'lastSyncedOrderId' => $configValues[MailchimpProConfig::LAST_SYNCED_ORDER_ID],
            'lastSyncedCartId' => $configValues[MailchimpProConfig::LAST_SYNCED_CART_ID],
            'lastSyncedNewsletterSubscriberId' => $configValues[MailchimpProConfig::LAST_SYNCED_NEWSLETTER_SUBSCRIBER_ID],
            'lastCronjob' => $configValues[MailchimpProConfig::LAST_CRONJOB],
            'lastCronjobExecutionTime' => $configValues[MailchimpProConfig::LAST_CRONJOB_EXECUTION_TIME],
            'totalJobs' => $this->getNumberOfTotalJobs(),
        ]);
    }

    public function getCronjobLogContent()
    {
        $configValues = MailchimpProConfig::getConfigurationValues();
    
        // Define the allowed directory
        $allowedDirectory = _PS_MODULE_DIR_ . $this->module->name . '/logs/';
        
        // Resolve the file path and sanitize it
        $filePath = realpath($allowedDirectory . 'cronjob.log');
        
        // Check if the file exists and is within the allowed directory
        if ($filePath && strpos($filePath, $allowedDirectory) === 0 && file_exists($filePath)) {
            $cronjobLogContent = Tools::file_get_contents($filePath);
        } else {
            $cronjobLogContent = ''; // Fallback to an empty string if the file doesn't exist or is invalid
        }

        return $cronjobLogContent;
    }

    public function autoSyncStore(){
        try {
            $command = new StoreSyncCommand(
                $this->context,
                $this->module->getApiClient(),
                [$this->context->shop->id]
            );
            $command->setSyncMode($command::SYNC_MODE_REGULAR);
            $command->setMethod($command::SYNC_METHOD_POST);
            
            $response = $command->execute();

            if (isset($response['requestSuccess']) && $response['requestSuccess'] == true) {
                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, true);

                $resp = $this->scriptVerify();
            }

            return $response;
            
        } catch (Exception $exception) {
            //$this->responses[$entityId] = $this->mailchimp->getLastResponse();
            // \PrestaShopLogger::addLog("[MAILCHIMP]: {$exception->getMessage()}");
        }
    }

    public function scriptVerify(){
        try {
            // store script verified command
            if (!Configuration::get(MailchimpProConfig::MAILCHIMP_SCRIPT_VERIFIED)) {
               $command = new SiteVerifyCommand(
                    $this->module->getApiClient(),
                    $this->context->shop
                );

                $response = $command->execute();

                Configuration::updateValue(MailchimpProConfig::MAILCHIMP_SCRIPT_VERIFIED, true);
            }            
        } catch (Exception $exception) {
            //$this->responses[$entityId] = $this->mailchimp->getLastResponse();
            // \PrestaShopLogger::addLog("[MAILCHIMP]: {$exception->getMessage()}");
        }
    }

    public function ajaxProcessSyncStoresScript()
    {
        try {
            $command = new StoreSyncCommand(
                $this->context,
                $this->module->getApiClient(),
                [$this->context->shop->id]
            );

            $response = $command->getStoreExists($this->getShopId(), true);

            if (isset($response['connected_site'])) {
                $footer = $response['connected_site']['site_script']['fragment'];
                Configuration::updateValue(MailchimpProConfig::MAILCHIMP_SCRIPT_CACHED, $footer, true);
                Configuration::updateValue(MailchimpProConfig::MAILCHIMP_SCRIPT_CACHED_DATE, date('Y-m-d'));

                $resp = $this->scriptVerify();

                $this->ajaxDie([
                    'hasError' => false,
                    'errorMessage' => null,
                    'result' => $response,
                    'successMessage' => $this->l('Store script has been fetched successfully!'),
                ]);
            }
            else{
                $errorMessage = $this->l('Error during syncing store script...');
                
                $this->ajaxDie([
                    'hasError' => true,
                    'errorMessage' => $errorMessage,
                ]);
            }
        } catch (Exception $exception) {
            $this->ajaxDie([
                'hasError' => true,
                'errorMessage' => $this->l('Error during syncing store script...'),
            ]);
        }
    }

    public function ajaxProcessSyncStores()
    {
        try {
            $command = new StoreSyncCommand(
                $this->context,
                $this->module->getApiClient(),
                [$this->context->shop->id]
            );
            $command->setSyncMode($command::SYNC_MODE_REGULAR);
            $command->setMethod($command::SYNC_METHOD_POST);
            $response = $command->execute();

            if (isset($response['requestSuccess']) && $response['requestSuccess'] == true) {
                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, true);

                $resp = $this->scriptVerify();

                $this->ajaxDie([
                    'hasError' => false,
                    'errorMessage' => null,
                    'result' => $response,
                    'successMessage' => $this->l('Store has been synced!'),
                ]);
            }
            else {
                if (isset($response['requestLastErrors'])) {
                    if (is_array($response['requestLastErrors'])) {
                        $errorMessage = implode(";", array_values($response['requestLastErrors']));
                    }
                    else {
                        $errorMessage = $response['requestLastErrors'];
                    }
                }
                else {
                    $errorMessage = $this->l('Error during syncing store...');
                }
                $this->ajaxDie([
                    'hasError' => true,
                    'errorMessage' => $errorMessage,
                ]);
            }
        } catch (Exception $exception) {
            $this->ajaxDie([
                'hasError' => true,
                'errorMessage' => $this->l('Error during syncing store...'),
            ]);
        }
    }

    public function ajaxProcessAddProductsToQueue()
    {
        //$products = \ProductCore::getSimpleProducts(\Context::getContext()->language->id);
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $products = array_column($repository->getProducts(), 'id_product');
        $queue = new PrestaChamps\Queue\Queue();
        foreach ($products as $product) {
            $job = new ProductSyncJob();
            $job->productId = $product;
            $queue->push($job, 'setup-wizard', $this->context->shop->id);
        }

        $this->ajaxDie(['ok']);
    }

public function ajaxProcessInitializeSpecificPrices()
    {
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $specific_prices = $repository->getSpecificPrices();

        $current_date = new DateTime('now', new DateTimeZone(@date_default_timezone_get()));

        foreach($specific_prices as $specific_price){
            $from_date = new DateTime($specific_price['from'], new DateTimeZone(@date_default_timezone_get()));
            $to_date = new DateTime($specific_price['to'], new DateTimeZone(@date_default_timezone_get()));

            if($from_date > $current_date){

                // Insert the data using the insert method, with INSERT_IGNORE option
                Db::getInstance()->insert('mailchimppro_specific_price', [
                                        'id_specific_price' => (int)$specific_price['id_specific_price'],
                                        'id_product'        => (int)$specific_price['id_product'],
                                        'start_date'        => pSQL($specific_price['from']),
                                        'end_date'          => pSQL($specific_price['to']),
                                        'needToRun'         => 2, // Direct value since it's static
                                        'id_shop'           => (int)$specific_price['id_shop']
                                        ], 
                                        false, 
                                        true, 
                                        Db::INSERT_IGNORE
                                    );

            }elseif($to_date > $current_date){

                // Insert the data using the insert method, with INSERT_IGNORE option
                Db::getInstance()->insert('mailchimppro_specific_price', [
                                        'id_specific_price' => (int)$specific_price['id_specific_price'],
                                        'id_product'        => (int)$specific_price['id_product'],
                                        'start_date'        => pSQL($specific_price['from']),
                                        'end_date'          => pSQL($specific_price['to']),
                                        'needToRun'         => 1, // Direct value since it's static
                                        'id_shop'           => (int)$specific_price['id_shop']
                                        ], 
                                        false, 
                                        true, 
                                        Db::INSERT_IGNORE
                                    );
            }
        }

        $this->ajaxDie(['ok']);
    }

    public function ajaxProcessAddCustomersToQueue()
    {
        //$customers = array_column(Customer::getCustomers(true), 'id_customer');
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $customers = array_column($repository->getCustomers(), 'id_customer');
        $queue = new PrestaChamps\Queue\Queue();
        foreach ($customers as $customer) {
            $job = new CustomerSyncJob();
            $job->customerId = $customer;
            $queue->push($job, 'setup-wizard', $this->context->shop->id);
        }

        $this->ajaxDie(['ok']);
    }

    public function ajaxProcessAddOrdersToQueue()
    {
        //$orders = $this->getOrderIds();
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $orders = array_column($repository->getOrders(), 'id_order');
        $queue = new PrestaChamps\Queue\Queue();
        foreach ($orders as $order) {
            $job = new OrderSyncJob();
            $job->orderId = $order;
            $queue->push($job, 'setup-wizard', $this->context->shop->id);
        }

        $this->ajaxDie(['ok']);
    }

    public function ajaxProcessAddCartRulesToQueue()
    {
        //$cartRules = $this->getCartRules();
        $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
        $cartRules = array_column($repository->getCartRules(), 'id_cart_rule');
        $queue = new PrestaChamps\Queue\Queue();
        foreach ($cartRules as $cartRule) {
            $job = new CartRuleSyncJob();
            $job->cartRuleId = $cartRule;
            $queue->push($job, 'setup-wizard', $this->context->shop->id);
        }

        $this->ajaxDie(['ok']);
    }

    public function ajaxProcessAddNewsletterSubscribersToQueue()
    {
        if (\Module::isEnabled('Ps_Emailsubscription') || \Module::isEnabled('blocknewsletter')) {
            $repository = new \PrestaChamps\MailchimpPro\EntitySyncRepository();
            $newsletterSubscribers = $repository->getNewsletterSubscribers();
            $queue = new PrestaChamps\Queue\Queue();
            foreach ($newsletterSubscribers as $newsletterSubscriber) {
                $job = new NewsletterSubscriberSyncJob();
                $job->newsletterSubscriber = $newsletterSubscriber;
                $queue->push($job, 'setup-wizard', $this->context->shop->id);
            }
        }

        $this->ajaxDie(['ok']);
    }

    /* protected function getOrderIds()
    {
        $shopId = Shop::getContextShopID();
        $query = new DbQuery();
        $query->from('orders');
        $query->select('id_order');
        if ($shopId) {
            $query->where("id_shop = {$shopId}");
        }

        return array_column(Db::getInstance()->executeS($query), 'id_order');
    } */

    /* protected function getCartRules()
    {
        $query = new DbQuery();
        $query->from('cart_rule');
        $query->select('id_cart_rule');
        $query->where('shop_restriction = 0');
        $ids = array_column(Db::getInstance()->executeS($query), 'id_cart_rule');

        $query = new DbQuery();
        $query->from('cart_rule_shop');
        $query->select('id_cart_rule');
        $query->where('id_shop = ' . pSQL($this->context->shop->id));
        $result = array_column(Db::getInstance()->executeS($query), 'id_cart_rule');
        $result = array_unique(array_merge($ids, $result));
        sort($result, SORT_NUMERIC);

        return $result;
    } */

    public function ajaxProcessDeleteEcommerceData()
    {
        try {
            /* $shops = array_column(Shop::getShops(true), 'id_shop');
            $command = new StoreSyncCommand(
                $this->context,
                $this->module->getApiClient(),
                $shops
            ); */
            $command = new StoreSyncCommand(
                $this->context,
                $this->module->getApiClient(),
                [$this->context->shop->id]
            );
            $command->setSyncMode($command::SYNC_MODE_REGULAR);
            $command->setMethod($command::SYNC_METHOD_DELETE);
            $response = $command->execute();

            if (isset($response['requestSuccess']) && $response['requestSuccess'] == true) {
                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, false);
                MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC, 0);
                $this->ajaxDie([
                    'hasError' => false,
                    'errorMessage' => null,
                    'result' => $response,
                    'successMessage' => $this->l('E-commerce data has been deleted'),
                ]);
            }
            else {
                if (isset($response['requestLastErrors'])) {
                    if($response['requestLastResponse']['headers']['http_code'] == 404){
                        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_STORE_SYNCED, false);
                        MailchimpProConfig::saveValue(MailchimpProConfig::MAILCHIMP_AUTO_AUDIENCE_SYNC, 0);
                    }
                    if (is_array($response['requestLastErrors'])) {
                        $errorMessage = implode(";", array_values($response['requestLastErrors']));
                    }
                    else {
                        $errorMessage = $response['requestLastErrors'];
                    }
                }
                else {
                    $errorMessage = $this->l('Error during deleting e-commerce data');
                }
                $this->ajaxDie([
                    'hasError' => true,
                    'errorMessage' => $errorMessage,
                ]);
            }
        } catch (Exception $exception) {
            $this->ajaxDie([
                'hasError' => true,
                'errorMessage' => $this->l('Error during deleting e-commerce data'),
            ]);
        }
    }

    public function processSyncProduct()
    {
        if (Configuration::get(MailchimpProConfig::MAILCHIMP_API_KEY) && Configuration::get(MailchimpProConfig::MAILCHIMP_STORE_SYNCED) && Configuration::get(MailchimpProConfig::SYNC_PRODUCTS)) {
            try {
                if ($productId = Tools::getValue('productId')) {
                    if (!Configuration::get(MailchimpProConfig::CRONJOB_BASED_SYNC)) {
                        $command = new \PrestaChamps\MailchimpPro\Commands\ProductSyncCommand(
                            $this->context,
                            $this->module->getApiClient(),
                            [$productId]
                        );
                        $command->setSyncMode($command::SYNC_MODE_REGULAR);
                        $command->setMethod($command::SYNC_METHOD_PATCH);
                        $result = $command->execute();

                        if (isset($result["requestSuccess"]) && $result["requestSuccess"] == false) {
                            $command->setMethod($command::SYNC_METHOD_POST);
                            $result = $command->execute();                            
                        }

                        $this->ajaxDie([
                            'hasError' => false,
                            'error' => null,
                            'command_result' => $result,
                            'result' => $this->l('Product synced'),
                        ]);
                    } else {
                        $job = new ProductSyncJob();
                        $job->productId = $productId;
                        $job->setSyncMode(\PrestaChamps\MailchimpPro\Commands\ProductSyncCommand::SYNC_MODE_REGULAR);
                        $queue = new PrestaChamps\Queue\Queue();
                        $queue->push($job, 'hook-product-extra', $this->context->shop->id);
                        $this->ajaxDie([
                            'hasError' => false,
                            'error' => null,
                            'result' => $this->l('Product job has been successfully added.'),
                        ]);
                    }
                }
            } catch (Exception $exception) {
                $this->ajaxDie(
                    [
                        'hasError' => true,
                        'error' => $exception->getMessage(),
                    ],
                    null,
                    null,
                    400
                );
            }
        }
    }

    public function ajaxProcessRefreshReports()
    {
        $this->module->assignStatisticsVariables(['refresh' => true]);
        $this->ajaxDie([
            'statistics' => $this->context->smarty->fetch(
                $this->module->getLocalPath() . 'views/templates/admin/configuration/_statistics-data.tpl'
            ),
        ]);
    }
}
