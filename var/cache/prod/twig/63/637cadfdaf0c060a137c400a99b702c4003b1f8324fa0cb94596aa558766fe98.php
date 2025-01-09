<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__6803786e2e5169e21c25faafdfae611180d8fff6322f4f29ca31b29f9a012062 */
class __TwigTemplate_b963de8fdfa5885596b7dfac6706e26092fcefb9275abd299857da7b66ae5d23 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/img/app_icon.png\" />

<title>Marketplace • Wood You Furniture | Nassau, Bahamas</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminPsMboModule';
    var iso_user = 'en';
    var lang_is_rtl = '0';
    var full_language_code = 'en-us';
    var full_cldr_language_code = 'en-US';
    var country_iso_code = 'BS';
    var _PS_VERSION_ = '1.7.8.11';
    var roundMode = 4;
    var youEditFieldFor = '';
        var new_order_msg = 'A new order has been placed on your shop.';
    var order_number_msg = 'Order number: ';
    var total_msg = 'Total: ';
    var from_msg = 'From: ';
    var see_order_msg = 'View this order';
    var new_customer_msg = 'A new customer registered on your shop.';
    var customer_name_msg = 'Customer name: ';
    var new_msg = 'A new message was posted on your shop.';
    var see_msg = 'Read this message';
    var token = '9337d402def2c26c67992440f2e110c8';
    var token_admin_orders = tokenAdminOrders = 'dcaef108761e64359e3a473601833f65';
    var token_admin_customers = '8152d55c3e1b42f603f0fdb241219478';
    var token_admin_customer_threads = tokenAdminCustomerThreads = 'ca036b0eb7b4cbd62748757dafc364ea';
    var currentIndex = 'index.php?controller=AdminPsMboModule';
    var employee_token = '67f3ace94faedf468681a44789067317';
    var choose_language_translate = 'Choose language:';
    var default_language = '1';
    var admin_modules_link = '/gettadmin/index.php/improve/modules/catalog/recommended?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8';
    var admin_notification_get_link = '/gettadmin/index.php/common/notifications?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8';
   ";
        // line 43
        echo " var admin_notification_push_link = adminNotificationPushLink = '/gettadmin/index.php/common/notifications/ack?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8';
    var tab_modules_list = '';
    var update_success_msg = 'Update successful';
    var errorLogin = 'PrestaShop was unable to log in to Addons. Please check your credentials and your Internet connection.';
    var search_product_msg = 'Search for a product';
  </script>

      <link href=\"/gettadmin/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/gettadmin/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/gamification/views/css/gamification.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ps_mbo/views/css/catalog.css?v=3.2.0\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ps_mbo/views/css/module-catalog.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ps_mbo/views/css/connection-toolbar.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/fontellico/views/css/fontello.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ets_abandonedcart/views/css/icon-admin.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/gettadmin\\/\";
var baseDir = \"\\/\";
var changeFormLanguageUrl = \"\\/gettadmin\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\";
var contextPsAccounts = {\"currentContext\":{\"type\":1,\"id\":1},\"psxName\":\"ps_mbo\",\"psIs17\":true,\"psAccountsVersion\":\"7.0.8\",\"psAccountsIsInstalled\":true,\"psAccountsInstallLink\":null,\"psAccountsIsEnabled\":true,\"psAccountsEnableLink\":\"https:\\/\\/woodyoubahamas.com\\/gettadmin\\/index.php\\/improve\\/modules\\/ma";
        // line 65
        echo "nage\\/action\\/enable\\/ps_accounts?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"psAccountsIsUptodate\":true,\"psAccountsUpdateLink\":null,\"user\":{\"uuid\":\"T3xXGrQ4eSfQsR5fMHbaS0vXTya2\",\"email\":\"patrick@woodyoubahamas.com\",\"emailIsValidated\":true,\"isSuperAdmin\":true},\"backendUser\":{\"email\":\"sethryanrollins@gmail.com\",\"employeeId\":7,\"isSuperAdmin\":true},\"currentShop\":{\"id\":\"1\",\"name\":\"Wood You\",\"domain\":\"woodyoubahamas.com\",\"domainSsl\":\"woodyoubahamas.com\",\"physicalUri\":\"\\/\",\"virtualUri\":\"\",\"frontUrl\":\"https:\\/\\/woodyoubahamas.com\\/\",\"uuid\":\"4b728a71-c135-41c3-b002-cee3885faeeb\",\"publicKey\":\"-----BEGIN RSA PUBLIC KEY-----\\r\\nMIGJAoGBAMZ5YkWK9iUMmbBdSO0xWkoMRPH97fPAMJSpOFenZl7sTq9ygZRk3KNF\\r\\nSmnUaKMZ7IEaWG29cdlJGoX24BfB5edUbtZgGqZYw1fOhrOKo8nwfLsr4g5\\/BCcV\\r\\nZxbcswjBQeM5LRfNTOCT\\/AtLySAgqGumz6WdQKmzQmmgE\\/P\\/0CnpAgMBAAE=\\r\\n-----END RSA PUBLIC KEY-----\",\"employeeId\":2,\"user\":{\"email\":\"patrick@woodyoubahamas.com\",\"emailIsValidated\":true,\"uuid\":\"T3xXGrQ4eSfQsR5fMHbaS0vXTya2\"},\"url\":\"https:\\/\\/woodyoubahamas.com\\/gettadmin\\/index.php?controller=AdminModules&configure=ps_mbo&setShopContext=s-1&token=aab9225dd6c68efee14e98981ca8897c\",\"isLinkedV4\":false,\"unlinkedAuto\":false,\"multishop\":false,\"moduleName\":\"ps_mbo\",\"psVersion\":\"1.7.8.11\"},\"isShopContext\":true,\"superAdminEmail\":null,\"onboardingLink\":\"https:\\/\\/accounts.distribution.prestashop.net?shops=W10=\",\"ssoResendVerificationEmail\":\"https:\\/\\/auth.prestashop.com\\/account\\/send-verification-email\",\"manageAccountLink\":\"https:\\/\\/auth.prestashop.com\\/login?lang=en\",\"isOnboardedV4\":false,\"shops\":[{\"id\":\"1\",\"name\":\"Default\",\"shops\":[{\"id\":\"1\",\"name\":\"Wood You\",\"domain\":\"woodyoubahamas.com\",\"domainSsl\":\"woodyoubahamas.com\",\"physicalUri\":\"\\/\",\"virtualUri\":\"\",\"frontUrl\":\"https:\\/\\/woodyoubahamas.com\\/\",\"uuid\":\"4b728a71-c135-41c3-b002-cee3885faeeb\",\"publicKey\":\"-----BEGIN RSA PUBLIC KEY-----\\r\\nMIGJAoGBAMZ5YkWK9iUMmbBdSO0xWkoMRPH97fPAMJSpOFenZl7sTq9ygZRk3KNF\\r\\nSmnUaKMZ7IEaWG29cdlJGoX24BfB5edUbtZgGqZYw1fOhrOKo8nwfLsr4g5\\/BCcV\\";
        echo "r\\nZxbcswjBQeM5LRfNTOCT\\/AtLySAgqGumz6WdQKmzQmmgE\\/P\\/0CnpAgMBAAE=\\r\\n-----END RSA PUBLIC KEY-----\",\"employeeId\":2,\"user\":{\"email\":\"patrick@woodyoubahamas.com\",\"emailIsValidated\":true,\"uuid\":\"T3xXGrQ4eSfQsR5fMHbaS0vXTya2\"},\"url\":\"https:\\/\\/woodyoubahamas.com\\/gettadmin\\/index.php?controller=AdminModules&configure=ps_mbo&setShopContext=s-1&token=aab9225dd6c68efee14e98981ca8897c\",\"isLinkedV4\":false,\"unlinkedAuto\":false,\"multishop\":false,\"moduleName\":\"ps_mbo\",\"psVersion\":\"1.7.8.11\",\"moduleVersion\":\"7.0.8\"}],\"multishop\":false,\"moduleName\":\"ps_mbo\",\"psVersion\":\"1.7.8.11\"}],\"adminAjaxLink\":\"https:\\/\\/woodyoubahamas.com\\/gettadmin\\/index.php?controller=AdminAjaxPsAccounts&ajax=1&token=80987391b66d76760843f6dbfc86bac5\",\"accountsUiUrl\":\"https:\\/\\/accounts.distribution.prestashop.net\",\"dependencies\":{\"ps_eventbus\":{\"isInstalled\":true,\"installLink\":\"https:\\/\\/woodyoubahamas.com\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/install\\/ps_eventbus?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"isEnabled\":true,\"enableLink\":\"https:\\/\\/woodyoubahamas.com\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/enable\\/ps_eventbus?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"}}};
var currency = {\"iso_code\":\"USD\",\"sign\":\"\$\",\"name\":\"US Dollar\",\"format\":null};
var currency_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"USD\",\"currencySymbol\":\"\$\",\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"\\u00a4#,##0.00\",\"negativePattern\":\"-\\u00a4#,##0.00\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"grou";
        // line 69
        echo "pingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":false};
var show_new_customers = \"1\";
var show_new_messages = \"1\";
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/gettadmin/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/js/admin.js?v=1.7.8.11\"></script>
<script type=\"text/javascript\" src=\"/gettadmin/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/tools.js?v=1.7.8.11\"></script>
<script type=\"text/javascript\" src=\"/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/gettadmin/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/modules/gamification/views/js/gamification_bt.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_emailalerts/js/admin/ps_emailalerts.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ets_abandonedcart/views/js/admin_all.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_mbo/views/js/recommended-modules.js?v=3.2.0\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_mbo/views/js/upload_module_with_cdc.js?v=3.2.0\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/growl/jquery.growl.js?v=3.2.0\"></script>
<script type=\"text/javascript\" src=\"https://assets.prestashop3.com/dst/mbo/v1/mbo-cdc.umd.js\"></script>

  <script type=\"text/javascript\">
    var ETS_AC_LINK_REMINDER_ADMIN = \"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderEmail&token=1d862f689cd1aca8ba0c3e3182589be7\";
    var ETS_AC_LINK_CAMPAIGN_TRACKING = \"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACTracking&token=e09c7dc8a039bb5b14bb720d2b05fec3\";
    var ETS_AC_LOGO_LINK = \"https://woodyoubahamas.com/img/wood-you-logo-1";
        // line 94
        echo "616423577.jpg\";
    var ETS_AC_IMG_MODULE_LINK = \"https://woodyoubahamas.com/modules/ets_abandonedcart/views/img/origin/\";
    var ETS_AC_FULL_BASE_URL = \"https://woodyoubahamas.com/\";
    var ETS_AC_ADMIN_CONTROLLER= \"AdminPsMboModule\";
    var ETS_AC_TRANS = {};
    ETS_AC_TRANS['clear_tracking'] = \"Clear tracking\";
    ETS_AC_TRANS['email_temp_setting'] = \"Email template settings\";
    ETS_AC_TRANS['confirm_clear_tracking'] = \"Clear tracking will also delete all data of Campaign tracking table and statistic data of Dashboard. Do you want to clear tracking?\";
    ETS_AC_TRANS['confirm_delete_lead_field'] = \"Do you want to delete this field?\";
    ETS_AC_TRANS['lead_form_not_found'] = \"Lead form does not exist\";
    ETS_AC_TRANS['lead_form_disabled'] = \"Lead form is disabled\";
</script>


";
        // line 108
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>";
        echo "

<body
  class=\"lang-en adminpsmbomodule\"
  data-base-url=\"/gettadmin/index.php\"  data-token=\"nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminDashboard&amp;token=e0fa26e028a1c05889381c7f3007d5a5\"></a>
      <span id=\"shop_version\">1.7.8.11</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=db81b32759521b703a54b67ad3a92d39\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php/improve/modules/manage?token=a8b17675f0dcfe2d84cc771207ac92f9\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php/sell/catalog/categories/new?token=a8b17675f0dcfe2d84cc771207ac92f9\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php/sell/catalog/products/new?token=a8b17675f0dcfe2d84cc771207ac92f9\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item quick-row-link\"
 ";
        // line 146
        echo "        href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=19ebb2866da36846ab7c0129bef227d2\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminOrders&amp;token=dcaef108761e64359e3a473601833f65\"
                 data-item=\"Orders\"
      >Orders</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-add-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"105\"
        data-icon=\"icon-AdminParentModulesCatalog\"
        data-method=\"add\"
        data-url=\"index.php/modules/addons/modules/catalog\"
        data-post-link=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminQuickAccesses&token=0181c678225ad9a44138d0a050a80d46\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"Marketplace - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminQuickAccesses&token=0181c678225ad9a44138d0a050a80d46\">
      <i class=\"material-icons\">settings</i>
      Manage your quick accesses
    </a>
  </div>
</div>
      </div>
      <div class=\"component\" id=\"header-search-container\">
        <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/gettadmin/index.php?controller=AdminSearch&amp;token=1759e7c99adce0a00e474165df063eca\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Search (e.g.: product reference, customer name…)\" aria-label=\"Searchbar\">
   ";
        // line 184
        echo " <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        Everywhere
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"Everywhere\" href=\"#\" data-value=\"0\" data-placeholder=\"What are you looking for?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> Everywhere</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Catalog\" href=\"#\" data-value=\"1\" data-placeholder=\"Product name, reference, etc.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Catalog</a>
        <a class=\"dropdown-item\" data-item=\"Customers by name\" href=\"#\" data-value=\"2\" data-placeholder=\"Name\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Customers by name</a>
        <a class=\"dropdown-item\" data-item=\"Customers by ip address\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Customers by IP address</a>
        <a class=\"dropdown-item\" data-item=\"Orders\" href=\"#\" data-value=\"3\" data-placeholder=\"Order ID\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Orders</a>
        <a class=\"dropdown-item\" data-item=\"Invoices\" href=\"#\" data-value=\"4\" data-placeholder=\"Invoice number\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Invoices</a>
        <a class=\"dropdown-item\" data-item=\"Carts\" href=\"#\" data-value=\"5\" data-placeholder=\"Cart ID\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopping_cart</i> Carts</a>
        <a class=\"dropdown-item\" data-item=\"Modules\" href=\"#\" data-value=\"7\" data-placeholder=\"Module name\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Modules</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">SEARCH</span><i";
        // line 199
        echo " class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
      </div>

      
      
              <div class=\"component\" id=\"header-shop-list-container\">
            <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"https://woodyoubahamas.com/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      <span>View my store</span>
    </a>
  </div>
        </div>
                    <div class=\"component header-right-component\" id=\"header-notifications-container\">
          <div id=\"notif\" class=\"notification-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Orders<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Customers<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link";
        // line 258
        echo " \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Messages<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new order for now :(<br>
              Have you checked your <strong><a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=ba8774d9bd5f93c517354798fd648758\">abandoned carts</a></strong>?<br>Your next order could be hiding there!
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new customer for now :(<br>
              Are you active on social media these days?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No new message for now.<br>
              Seems like all your customers are happy :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      from <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"noti";
        // line 307
        echo "f\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - registered <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
        </div>
      
      <div class=\"component\" id=\"header-employee-container\">
        <div class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">

      <span class=\"employee-avatar\"><img class=\"avatar rounded-circle\" src=\"https://woodyoubahamas.com/img/pr/default.jpg\" /></span>
      <span class=\"employee_profile\">Welcome back Seth</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/gettadmin/index.php/configure/advanced/employees/7/edit?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\">
      <i class=\"material-icons\">edit</i>
      <span>Your profile</span>
    </a>
    </div>

    <p class=\"divider\"></p>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/resources/documentations?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">book</i> Resources</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/training?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=training-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">school</i> Training</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/experts?utm_source=back-office&amp;utm_medium=";
        // line 341
        echo "profile&amp;utm_campaign=expert-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">person_pin_circle</i> Find an Expert</a>
    <a class=\"dropdown-item\" href=\"https://addons.prestashop.com?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=addons-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">extension</i> PrestaShop Marketplace</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/contact?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=help-center-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">help</i> Help Center</a>
    <p class=\"divider\"></p>
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminLogin&amp;logout=1&amp;token=73854ea29733bf1f200331ab31bb0835\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/gettadmin/index.php/configure/advanced/employees/toggle-navigation?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
      <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone\" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminDashboard&amp;token=e0fa26e028a1c05889381c7f3007d5a5\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
  ";
        // line 377
        echo "        
            <li class=\"category-title\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/gettadmin/index.php/sell/orders/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Orders
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/gettadmin/index.php/sell/orders/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/gettadmin/index.php/sell/orders/invoices/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Invoices
                          ";
        // line 410
        echo "      </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/gettadmin/index.php/sell/orders/credit-slips/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Credit Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/gettadmin/index.php/sell/orders/delivery-slips/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarts&amp;token=ba8774d9bd5f93c517354798fd648758\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"152\" id=\"subtab-AdminGiftCardOrder\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminG";
        // line 441
        echo "iftCardOrder&amp;token=41a7c4e52487bbd5dab0bb5a384df320\" class=\"link\"> Gift Cards
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/gettadmin/index.php/sell/catalog/products?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catalog
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/gettadmin/index.php/sell/catalog/products?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                            ";
        // line 474
        echo "    <a href=\"/gettadmin/index.php/sell/catalog/categories?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/gettadmin/index.php/sell/catalog/monitoring/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminAttributesGroups&amp;token=e00193634251f208b196f8afa2b2f5af\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/gettadmin/index.php/sell/catalog/brands/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                              
                                                            
";
        // line 505
        echo "                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/gettadmin/index.php/sell/attachments/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCartRules&amp;token=19ebb2866da36846ab7c0129bef227d2\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/gettadmin/index.php/sell/stocks/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"150\" id=\"subtab-AdminGiftCardTemplate\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminGiftCardTemplate&amp;token=1b8d52ed079dcf76f84e30af5ceee939\" class=\"link\"> Templates Gift Cards
                                </a>
                              </li>

                                                                   ";
        // line 534
        echo "               
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"151\" id=\"subtab-AdminGiftCard\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminGiftCard&amp;token=94fd5e4fcdd2a55e0683f0ce37367527\" class=\"link\"> Gift Cards
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/gettadmin/index.php/sell/customers/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Customers
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                                <a href=\"/gettadmin/index.php/sell/customers/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Customers
                                </a>
              ";
        // line 565
        echo "                </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/gettadmin/index.php/sell/addresses/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCustomerThreads&amp;token=ca036b0eb7b4cbd62748757dafc364ea\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
                      <span>
                      Customer Service
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"https://woodyo";
        // line 596
        echo "ubahamas.com/gettadmin/index.php?controller=AdminCustomerThreads&amp;token=ca036b0eb7b4cbd62748757dafc364ea\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/gettadmin/index.php/sell/customer-service/order-messages/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminReturn&amp;token=91b6952198b53f73488ceb365544e498\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"/gettadmin/index.php/modules/metrics/legacy/stats?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Stats
                      </span>
                                     ";
        // line 628
        echo "               <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-32\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"232\" id=\"subtab-AdminMetricsLegacyStatsController\">
                                <a href=\"/gettadmin/index.php/modules/metrics/legacy/stats?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Stats
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"233\" id=\"subtab-AdminMetricsController\">
                                <a href=\"/gettadmin/index.php/modules/metrics?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> PrestaShop Metrics
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title link-active\" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                                                          
                  <li ";
        // line 665
        echo "class=\"link-levelone has_submenu link-active open ul-open\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/gettadmin/index.php/modules/addons/modules/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Modules
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo link-active\" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/gettadmin/index.php/modules/addons/modules/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Marketplace
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"44\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/gettadmin/index.php/improve/modules/manage?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                                                                    </ul>
             ";
        // line 693
        echo "                           </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/gettadmin/index.php/modules/addons/themes/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Design
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-52\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"230\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/gettadmin/index.php/modules/addons/themes/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"126\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/gettadmin/index.php/improve/design/themes/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Theme &amp; Logo
                                </a>
                              <";
        // line 723
        echo "/li>

                                                                                                                                        
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/gettadmin/index.php/improve/design/mail_theme/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/gettadmin/index.php/improve/design/cms-pages/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/gettadmin/index.php/improve/design/modules/positions/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=A";
        // line 753
        echo "dminImages&amp;token=f3bb9440c38c68a6c3678c95743599d1\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/gettadmin/index.php/modules/link-widget/list?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarriers&amp;token=a7fc59b996c369e2f6f839da3bbf3765\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Shipping
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-60\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6";
        // line 785
        echo "1\" id=\"subtab-AdminCarriers\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarriers&amp;token=a7fc59b996c369e2f6f839da3bbf3765\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/gettadmin/index.php/improve/shipping/preferences/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/gettadmin/index.php/improve/payment/payment_methods?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Payment
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-63\" class=\"submenu panel-collapse\">
                                                      
                              
                               ";
        // line 817
        echo "                             
                              <li class=\"link-leveltwo\" data-submenu=\"64\" id=\"subtab-AdminPayment\">
                                <a href=\"/gettadmin/index.php/improve/payment/payment_methods?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/gettadmin/index.php/improve/payment/preferences?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/gettadmin/index.php/improve/international/localization/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-language\">language</i>
                      <span>
                      International
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-66\" class=\"submenu panel-collapse\">
 ";
        // line 848
        echo "                                                     
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"67\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/gettadmin/index.php/improve/international/localization/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"/gettadmin/index.php/improve/international/zones/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/gettadmin/index.php/improve/international/taxes/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Taxes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/gettadmin/index.php/improve/international/translations/settings?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> ";
        // line 876
        echo "Translations
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"170\" id=\"subtab-Marketing\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=Marketing&amp;token=987b76d154d762bd6a0c62102c5de9d8\" class=\"link\">
                      <i class=\"material-icons mi-campaign\">campaign</i>
                      <span>
                      Marketing
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"80\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configure</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"81\" id=\"subtab-ShopParameters\">
                    <a href=\"/gettadmin/index.php/configure/shop/preferences/preferences?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Shop Parameters
                      </span>
                                                    <i c";
        // line 917
        echo "lass=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/preferences/preferences?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/order-preferences/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/product-preferences/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                               ";
        // line 946
        echo "   
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/customer-preferences/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/gettadmin/index.php/configure/shop/contacts/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Contact
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/gettadmin/index.php/configure/shop/seo-urls/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminSearchConf&amp;token=6beab34f3492b584ae6046571fffc652\" class=\"link\"> Search
                          ";
        // line 975
        echo "      </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"130\" id=\"subtab-AdminGamification\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminGamification&amp;token=26cb269f0a491201362670f2d096619b\" class=\"link\"> Merchant Expertise
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/gettadmin/index.php/configure/advanced/system-information/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Advanced Parameters
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-103\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"104\" id=\"subtab-AdminInformation\">
                  ";
        // line 1007
        echo "              <a href=\"/gettadmin/index.php/configure/advanced/system-information/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/gettadmin/index.php/configure/advanced/performance/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/gettadmin/index.php/configure/advanced/administration/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/gettadmin/index.php/configure/advanced/emails/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                ";
        // line 1038
        echo "              <li class=\"link-leveltwo\" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/gettadmin/index.php/configure/advanced/import/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/gettadmin/index.php/configure/advanced/employees/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/gettadmin/index.php/configure/advanced/sql-requests/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/gettadmin/index.php/configure/advanced/logs/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
           ";
        // line 1069
        echo "                                                 
                              <li class=\"link-leveltwo\" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/gettadmin/index.php/configure/advanced/webservice-keys/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Webservice
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"221\" id=\"subtab-AdminFeatureFlag\">
                                <a href=\"/gettadmin/index.php/configure/advanced/feature-flags/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Experimental Feature
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"121\" id=\"tab-DEFAULT\">
                <span class=\"title\">More</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"185\" id=\"subtab-AdminSelfUpgrade\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminSelfUpgrade&amp;token=ef90f7b240d9f8f029c30c86c81dcd5c\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      1-Click Upgrade
                  ";
        // line 1104
        echo "    </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"154\" id=\"tab-mailchimppro\">
                <span class=\"title\">Mailchimp Config</span>
            </li>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"174\" id=\"subtab-AdminMailchimpProConfiguration\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminMailchimpProConfiguration&amp;token=18d94a0de767513691776341022a405d\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Mailchimp Configuration
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
             ";
        // line 1134
        echo "                           </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"175\" id=\"subtab-AdminMailchimpProQueue\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminMailchimpProQueue&amp;token=150d0abd71ea340002d5b7e920e06ac3\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Queue Work
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                                                            
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"177\" id=\"subtab-AdminMailchimpProTags\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminMailchimpProTags&amp;token=b0419930e7f143a380f188bf254dd9a9\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Tags
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                                                                                                 ";
        // line 1165
        echo "       
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"186\" id=\"tab-AdminEtsAC\">
                <span class=\"title\">Customer reminders</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"187\" id=\"subtab-AdminEtsACDashboard\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDashboard&amp;token=12b4ce2e92c348d26431593bfe8c5553\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Dashboard
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"188\" id=\"subtab-AdminEtsACCampaign\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderEmail&amp;token=1d862f689cd1aca8ba0c3e3182589be7\" class=\"link\">
                      <i class=\"material-icons mi-\"></i>
                      <span>
                      Reminder campaigns
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
          ";
        // line 1203
        echo "                                  </a>
                                              <ul id=\"collapse-188\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"189\" id=\"subtab-AdminEtsACReminderEmail\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderEmail&amp;token=1d862f689cd1aca8ba0c3e3182589be7\" class=\"link\"> Automated abandoned cart emails
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"190\" id=\"subtab-AdminEtsACReminderCustomer\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderCustomer&amp;token=d21d11c4a6add6857e6d7d59f8de2989\" class=\"link\"> Custom emails and newsletter
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"191\" id=\"subtab-AdminEtsACReminderPopup\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderPopup&amp;token=2fea951563c1c60633c83a789733fead\" class=\"link\"> Popup reminder
                                </a>
                              </li>

                                                                                  
                              
                                                            
      ";
        // line 1232
        echo "                        <li class=\"link-leveltwo\" data-submenu=\"192\" id=\"subtab-AdminEtsACReminderBar\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBar&amp;token=f9d2958c3a4fb55db377de963221f194\" class=\"link\"> Highlight bar reminder
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"193\" id=\"subtab-AdminEtsACReminderBrowser\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBrowser&amp;token=3a5b6c18aa22f52a6f121e401c88a3ea\" class=\"link\"> Web push notification
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"194\" id=\"subtab-AdminEtsACReminderLeave\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderLeave&amp;token=b96cc98366f927afc2d962d4fa3b0310\" class=\"link\"> Leaving website reminder
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"195\" id=\"subtab-AdminEtsACReminderBrowserTab\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBrowserTab&amp;token=9e3914126f540d7855c1606e397db836\" class=\"link\"> Browser";
        // line 1257
        echo " tab notification
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"196\" id=\"subtab-AdminEtsACCart\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACCart&amp;token=e38d6639ba0ff569d543dccc8a26f869\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Abandoned carts
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"197\" id=\"subtab-AdminEtsACConvertedCarts\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACConvertedCarts&amp;token=105495c467ed290db6de2f8298938cff\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Recovered carts
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                           ";
        // line 1291
        echo " </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"198\" id=\"subtab-AdminEtsACEmailTemplate\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACEmailTemplate&amp;token=cdeae0a66bbd5eb3e71c46164c3ca6ac\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Email templates
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"199\" id=\"subtab-AdminEtsACTracking\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACEmailTracking&amp;token=e35790a8120390ecb896154bdd2e73af\" class=\"link\">
                      <i class=\"material-icons mi-\"></i>
                      <span>
                      Campaign tracking
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-199\" class=\"submenu panel-collapse\">
                                                      
  ";
        // line 1324
        echo "                            
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"200\" id=\"subtab-AdminEtsACEmailTracking\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACEmailTracking&amp;token=e35790a8120390ecb896154bdd2e73af\" class=\"link\"> Email tracking
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"201\" id=\"subtab-AdminEtsACDisplayTracking\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDisplayTracking&amp;token=fc03bae797efeec2b4ad3836765df3f3\" class=\"link\"> Display tracking
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"202\" id=\"subtab-AdminEtsACDiscounts\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDiscounts&amp;token=3b514f5318d4c0e00bc15f220f4fb954\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"203\" id=\"subtab-AdminEtsACDisplayLog\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDisplayLog&amp;token=b7166b2";
        // line 1351
        echo "09045308dffa53d23ad9728e4\" class=\"link\"> Display log
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"204\" id=\"subtab-AdminEtsACMailConfigs\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailServices&amp;token=f6636b3eeed002f7821a75ab9b96abc8\" class=\"link\">
                      <i class=\"material-icons mi-\"></i>
                      <span>
                      Mail configuration
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-204\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"205\" id=\"subtab-AdminEtsACMailServices\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailServices&amp;token=f6636b3eeed002f7821a75ab9b96abc8\" class=\"link\"> Mail service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20";
        // line 1383
        echo "6\" id=\"subtab-AdminEtsACMailQueue\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailQueue&amp;token=1f5be043ea818ad8d5b443afdfda76dd\" class=\"link\"> Mail queue
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"207\" id=\"subtab-AdminEtsACIndexedCarts\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACIndexedCarts&amp;token=05db7ebb828cf21041ab46dff06caa38\" class=\"link\"> Indexed carts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"208\" id=\"subtab-AdminEtsACIndexedCustomers\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACIndexedCustomers&amp;token=4fde00c699f179e40b029b1675bbb065\" class=\"link\"> Indexed customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"209\" id=\"subtab-AdminEtsACUnsubscribed\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACUnsubscribed&amp;token=f75e01d59a0498c91695d94b33f8c1d0\" class=\"link\"> Unsubscribed list
                                </a>
                              </li>

                        ";
        // line 1412
        echo "                                                          
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"210\" id=\"subtab-AdminEtsACMailLog\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailLog&amp;token=d5baa501f4683cb0cc23ecc12a76435a\" class=\"link\"> Mail log
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"211\" id=\"subtab-AdminEtsACLeads\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACLeads&amp;token=bf5aa1f829bf2125a7d40768ad97e26d\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Leads
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"212\" id=\"subtab-AdminEtsACConfigs\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACConfigs&amp;token=249f9d6b9312176fdfd55817318d7674\" class=\"link\">
                      <i class=\"material-icons mi-extension\">";
        // line 1443
        echo "extension</i>
                      <span>
                      Automation
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"213\" id=\"subtab-AdminEtsACOtherConfigs\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACOtherConfigs&amp;token=de45bf4fde29304f7dbca716679e2d0f\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Other settings
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>


<div class=\"header-toolbar d-print-none\">
    
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
                      <li class=\"breadcrumb-item\">Marketplace</li>
          
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Marketplace          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
           ";
        // line 1499
        echo "       class=\"btn btn-primary pointer\"                  id=\"page-header-desc-configuration-add_module\"
                  href=\"#\"                  title=\"Upload a module\"                  data-toggle=\"pstooltip\"
                  data-placement=\"bottom\"                >
                  <i class=\"material-icons\">cloud_upload</i>                  Upload a module
                </a>
                                                                        <a
                  class=\"btn btn-primary pointer\"                  id=\"page-header-desc-configuration-addons_logout\"
                  href=\"#\"                  title=\"Synchronized with Addons marketplace!\"                  data-toggle=\"pstooltip\"
                  data-placement=\"bottom\"                >
                  <i class=\"material-icons\">exit_to_app</i>                  
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/gettadmin/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fen%252Fdoc%252FAdminModules%253Fversion%253D1.7.8.11%2526country%253Den/Help?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"
                   id=\"product_form_open_help\"
                >
                  Help
                </a>
                                    </div>
        </div>

      
    </div>
  </div>

  
      <div class=\"page-head-tabs\" id=\"head_tabs\">
      <ul class=\"nav nav-pills\">
                                                                                                                                                                                                                                                                                                                                                       ";
        // line 1531
        echo "                                                                                                                                                                                                                                                                                                                                                                                                   <li class=\"nav-item\">
                    <a href=\"/gettadmin/index.php/modules/addons/modules/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" id=\"subtab-AdminPsMboModule\" class=\"nav-link tab active current\" data-submenu=\"227\">
                      Marketplace
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"/gettadmin/index.php/modules/addons/modules/catalog/selection?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" id=\"subtab-AdminPsMboAddons\" class=\"nav-link tab \" data-submenu=\"228\">
                      Modules in the spotlight
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ";
        // line 1547
        echo "                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  </ul>
    </div>
  
  <div class=\"btn-floating\">
    <button class=\"btn btn-primary collapsed\" data-toggle=\"collapse\" data-target=\".btn-floating-container\" aria-expanded=\"false\">
      <i class=\"material-icons\">add</i>
    </button>
    <div class=\"btn-floating-container collapse\">
      <div class=\"btn-floating-menu\">
        
                              <a
              class=\"btn btn-floating-item  pointer\"              id=\"page-header-desc-floating-con";
        // line 1558
        echo "figuration-add_module\"
              href=\"#\"              title=\"Upload a module\"              data-toggle=\"pstooltip\"
              data-placement=\"bottom\"            >
              Upload a module
              <i class=\"material-icons\">cloud_upload</i>            </a>
                                        <a
              class=\"btn btn-floating-item  pointer\"              id=\"page-header-desc-floating-configuration-addons_logout\"
              href=\"#\"              title=\"Synchronized with Addons marketplace!\"              data-toggle=\"pstooltip\"
              data-placement=\"bottom\"            >
              
              <i class=\"material-icons\">exit_to_app</i>            </a>
                  
                              <a class=\"btn btn-floating-item btn-help btn-sidebar\" href=\"#\"
               title=\"Help\"
               data-toggle=\"sidebar\"
               data-target=\"#right-sidebar\"
               data-url=\"/gettadmin/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fen%252Fdoc%252FAdminModules%253Fversion%253D1.7.8.11%2526country%253Den/Help?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"
            >
              Help
            </a>
                        </div>
    </div>
  </div>
  <script>
  if (undefined !== mbo) {
    mbo.initialize({
      translations: {
        'Recommended Modules and Services': 'Recommended modules',
        'description': \"Here\\'s a selection of modules,<\\strong> compatible with your store<\\/strong>, to help you achieve your goals\",
        'Close': 'Close',
      },
      recommendedModulesUrl: '/gettadmin/index.php/modules/addons/modules/recommended?tabClassName=AdminPsMboModule&_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 0,
      shouldUseLegacyTheme: 0,
    });
  }
</script>


</div>

<div id=\"main-div\">
          
      <div class=\"content-div  with-tabs\">

        

         ";
        // line 1606
        echo "                                               
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1612
        $this->displayBlock('content_header', $context, $blocks);
        $this->displayBlock('content', $context, $blocks);
        $this->displayBlock('content_footer', $context, $blocks);
        $this->displayBlock('sidebar_right', $context, $blocks);
        echo "

            
          </div>
        </div>

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>Oh no!</h1>
  <p class=\"mt-3\">
    The mobile version of this page is not available yet.
  </p>
  <p class=\"mt-2\">
    Please use a desktop computer to access this page, until is adapted to mobile.
  </p>
  <p class=\"mt-2\">
    Thank you.
  </p>
  <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminDashboard&amp;token=e0fa26e028a1c05889381c7f3007d5a5\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons\">arrow_back</i>
    Back
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    
</div>
  

      <div class=\"bootstrap\">
      <div class=\"modal fade\" id=\"modal_addons_connect\" tabindex=\"-1\">
\t<div class=\"modal-dialog modal-md\">
\t\t<div class=\"modal-content\">
\t\t\t\t\t\t<div class=\"modal-header\">
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
\t\t\t\t<h4 class=\"modal-title\"><i class=\"icon-puzzle-piece\"></i> <a target=\"_blank\" href=\"https://addons.prestashop.com/?utm_source=back-office&utm_medium=modules&utm_campaign=back-office-EN&utm_content=download\">PrestaShop Addons</a></h4>
\t\t\t</div>
\t\t\t
\t\t\t<div class=\"modal-body\">
\t\t\t\t\t\t<!--start addons login-->
\t\t\t<form id=\"addons_login_form\" method=\"post\" >
\t\t\t\t<div>
\t\t\t\t\t<a href=\"https://addons.prestashop.com/en/login?email=sethryanrollins%40gmail.com&amp;firstname=Seth&amp;lastname=Rollins&amp;website=http%3A%2F%2Fwoodyoubahamas.com%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-EN&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/gettadmin/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
\t\t\t\t\t<h3 class=\"text-center\">Connect your shop to PrestaShop's marketplace in order to automatically import all your Addons purchases.</h3>
\t\t\t\t\t<hr />
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-m";
        // line 1662
        echo "d-6\">
\t\t\t\t\t\t<h4>Don't have an account?</h4>
\t\t\t\t\t\t<p class='text-justify'>Discover the Power of PrestaShop Addons! Explore the PrestaShop Official Marketplace and find over 3 500 innovative modules and themes that optimize conversion rates, increase traffic, build customer loyalty and maximize your productivity</p>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<h4>Connect to PrestaShop Addons</h4>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-user\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"username_addons\" name=\"username_addons\" type=\"text\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t<div class=\"input-group-prepend\">
\t\t\t\t\t\t\t\t\t<span class=\"input-group-text\"><i class=\"icon-key\"></i></span>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<input id=\"password_addons\" name=\"password_addons\" type=\"password\" value=\"\" autocomplete=\"off\" class=\"form-control ac_input\">
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<a class=\"btn btn-link float-right _blank\" href=\"//addons.prestashop.com/en/forgot-your-password\">I forgot my password</a>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div class=\"row row-padding-top\">
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/en/login?email=sethryanrollins%40gmail.com&amp;firstname=Seth&amp;lastname=Rollins&amp;website=http%3A%2F%2Fwoodyoubahamas.com%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-EN&amp;utm_content=download#createnow\">
\t\t\t\t\t\t\t\tCreate an Account
\t\t\t\t\t\t\t\t<i class=\"icon-external-link\"></i>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<button id=\"addons_login_button\" class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
\t\t\t\t\t\t\t\t<i class=";
        // line 1701
        echo "\"icon-unlock\"></i> Sign in
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>

\t\t\t\t<div id=\"addons_loading\" class=\"help-block\"></div>

\t\t\t</form>
\t\t\t<!--end addons login-->
\t\t\t</div>


\t\t\t\t\t</div>
\t</div>
</div>

    </div>
  
";
        // line 1720
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>";
        echo "
</html>";
    }

    // line 108
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1612
    public function block_content_header($context, array $blocks = [])
    {
    }

    public function block_content($context, array $blocks = [])
    {
    }

    public function block_content_footer($context, array $blocks = [])
    {
    }

    public function block_sidebar_right($context, array $blocks = [])
    {
    }

    // line 1720
    public function block_javascripts($context, array $blocks = [])
    {
    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "__string_template__6803786e2e5169e21c25faafdfae611180d8fff6322f4f29ca31b29f9a012062";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1911 => 1720,  1894 => 1612,  1885 => 108,  1876 => 1720,  1855 => 1701,  1814 => 1662,  1758 => 1612,  1750 => 1606,  1700 => 1558,  1687 => 1547,  1669 => 1531,  1635 => 1499,  1577 => 1443,  1544 => 1412,  1513 => 1383,  1479 => 1351,  1450 => 1324,  1415 => 1291,  1379 => 1257,  1352 => 1232,  1321 => 1203,  1281 => 1165,  1248 => 1134,  1216 => 1104,  1179 => 1069,  1146 => 1038,  1113 => 1007,  1079 => 975,  1048 => 946,  1017 => 917,  974 => 876,  944 => 848,  911 => 817,  877 => 785,  843 => 753,  811 => 723,  779 => 693,  749 => 665,  710 => 628,  676 => 596,  643 => 565,  610 => 534,  579 => 505,  546 => 474,  511 => 441,  478 => 410,  443 => 377,  405 => 341,  369 => 307,  318 => 258,  257 => 199,  240 => 184,  200 => 146,  157 => 108,  141 => 94,  114 => 69,  107 => 65,  83 => 43,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__6803786e2e5169e21c25faafdfae611180d8fff6322f4f29ca31b29f9a012062", "");
    }
}
