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

/* __string_template__e405e61db56b8e61ec7cf361f3dd29b018d2e57409d2925f1765c7821b9175e6 */
class __TwigTemplate_b7dc6cbef15e5696c8fcec4e78693da49f7bf03f066bd070147bfe571d26ff33 extends \Twig\Template
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

<title>Module manager • Wood You Furniture | Nassau, Bahamas</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminModulesManage';
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
    var token = 'be131f041287ba00c9db13bd6222ed7c';
    var token_admin_orders = tokenAdminOrders = 'dcaef108761e64359e3a473601833f65';
    var token_admin_customers = '8152d55c3e1b42f603f0fdb241219478';
    var token_admin_customer_threads = tokenAdminCustomerThreads = 'ca036b0eb7b4cbd62748757dafc364ea';
    var currentIndex = 'index.php?controller=AdminModulesManage';
    var employee_token = '67f3ace94faedf468681a44789067317';
    var choose_language_translate = 'Choose language:';
    var default_language = '1';
    var admin_modules_link = '/gettadmin/index.php/improve/modules/catalog/recommended?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8';
    var admin_notification_get_link = '/gettadmin/index.php/common/notifications?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI";
        // line 42
        echo "8';
    var admin_notification_push_link = adminNotificationPushLink = '/gettadmin/index.php/common/notifications/ack?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8';
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
var currency = {\"iso_code\":\"USD\",\"sign\":\"\$\",\"name\":\"US Dollar\",\"format\":null};
var currency_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"USD\",\"currencySymbol\":\"\$\",\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\"";
        // line 66
        echo ",\"NaN\"],\"positivePattern\":\"\\u00a4#,##0.00\",\"negativePattern\":\"-\\u00a4#,##0.00\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var host_mode = false;
var number_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
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
<script type=\"text/javascript\" src=\"/js/jquery/plugins/growl/jquery.growl.js?v=3.2.0\"></script>
<script type=\"text/javascript\" src=\"https://assets.prestashop3.com/dst/mbo/v1/mbo-cdc.umd.js\"></script>

  <script type=\"text/javascript\"";
        // line 89
        echo ">
    var ETS_AC_LINK_REMINDER_ADMIN = \"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderEmail&token=1d862f689cd1aca8ba0c3e3182589be7\";
    var ETS_AC_LINK_CAMPAIGN_TRACKING = \"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACTracking&token=e09c7dc8a039bb5b14bb720d2b05fec3\";
    var ETS_AC_LOGO_LINK = \"https://woodyoubahamas.com/img/wood-you-logo-1616423577.jpg\";
    var ETS_AC_IMG_MODULE_LINK = \"https://woodyoubahamas.com/modules/ets_abandonedcart/views/img/origin/\";
    var ETS_AC_FULL_BASE_URL = \"https://woodyoubahamas.com/\";
    var ETS_AC_ADMIN_CONTROLLER= \"AdminModulesManage\";
    var ETS_AC_TRANS = {};
    ETS_AC_TRANS['clear_tracking'] = \"Clear tracking\";
    ETS_AC_TRANS['email_temp_setting'] = \"Email template settings\";
    ETS_AC_TRANS['confirm_clear_tracking'] = \"Clear tracking will also delete all data of Campaign tracking table and statistic data of Dashboard. Do you want to clear tracking?\";
    ETS_AC_TRANS['confirm_delete_lead_field'] = \"Do you want to delete this field?\";
    ETS_AC_TRANS['lead_form_not_found'] = \"Lead form does not exist\";
    ETS_AC_TRANS['lead_form_disabled'] = \"Lead form is disabled\";
</script>


";
        // line 106
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>";
        echo "

<body
  class=\"lang-en adminmodulesmanage\"
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
          <a class=\"dropdown-item quick-row-link active\"
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
          <a class=\"dropdown-item quick-ro";
        // line 143
        echo "w-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=19ebb2866da36846ab7c0129bef227d2\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminOrders&amp;token=dcaef108761e64359e3a473601833f65\"
                 data-item=\"Orders\"
      >Orders</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-remove-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-method=\"remove\"
        data-quicklink-id=\"5\"
        data-rand=\"186\"
        data-icon=\"icon-AdminModulesSf\"
        data-url=\"index.php/improve/modules/manage\"
        data-post-link=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminQuickAccesses&token=0181c678225ad9a44138d0a050a80d46\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"Modules - List\"
      >
        <i class=\"material-icons\">remove_circle_outline</i>
        Remove from Quick Acess
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
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Search (e.g.: product reference, customer name…)\" ari";
        // line 182
        echo "a-label=\"Searchbar\">
    <div class=\"input-group-append\">
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
      <button class=\"btn btn-primary\" type=\"submit\"><span class=";
        // line 198
        echo "\"d-none\">SEARCH</span><i class=\"material-icons\">search</i></button>
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
     ";
        // line 257
        echo "         class=\"nav-link \"
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

  <script type=\"text/html\" id=\"customer-notification-templ";
        // line 305
        echo "ate\">
    <a class=\"notif\" href='customer_url'>
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
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/experts?utm_source=bac";
        // line 340
        echo "k-office&amp;utm_medium=profile&amp;utm_campaign=expert-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">person_pin_circle</i> Find an Expert</a>
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
        // line 374
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
        // line 409
        echo "                              </a>
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
                                <a href=\"https://woodyoubahamas.com/gettadmin/ind";
        // line 440
        echo "ex.php?controller=AdminGiftCardOrder&amp;token=41a7c4e52487bbd5dab0bb5a384df320\" class=\"link\"> Gift Cards
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
        // line 473
        echo "                            <a href=\"/gettadmin/index.php/sell/catalog/categories?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Categories
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
        // line 503
        echo "                       
                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
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
        // line 533
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
                           ";
        // line 563
        echo "     </a>
                              </li>

                                                                                  
                              
                                                            
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
                               ";
        // line 595
        echo " <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCustomerThreads&amp;token=ca036b0eb7b4cbd62748757dafc364ea\" class=\"link\"> Customer Service
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
        // line 627
        echo "                                       <i class=\"material-icons sub-tabs-arrow\">
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

                              
                  
                                                      
                                                         ";
        // line 663
        echo " 
                  <li class=\"link-levelone has_submenu link-active open ul-open\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
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
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/gettadmin/index.php/modules/addons/modules/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Marketplace
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo link-active\" data-submenu=\"44\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/gettadmin/index.php/improve/modules/manage?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                                                               ";
        // line 691
        echo "     </ul>
                                        </li>
                                              
                  
                                                      
                  
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
       ";
        // line 722
        echo "                       </li>

                                                                                                                                        
                              
                                                            
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
                                <a href=\"https://woodyoubahamas.com/gettadmi";
        // line 752
        echo "n/index.php?controller=AdminImages&amp;token=f3bb9440c38c68a6c3678c95743599d1\" class=\"link\"> Image Settings
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
                                                      
                              
                                                            
                              <li class=\"link-l";
        // line 784
        echo "eveltwo\" data-submenu=\"61\" id=\"subtab-AdminCarriers\">
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
        // line 816
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
                                              <ul id=\"collapse-66\" class=\"su";
        // line 846
        echo "bmenu panel-collapse\">
                                                      
                              
                                                            
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
                                <a href=\"/gettadmin/index.php/improve/international/translations/settings?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatm";
        // line 875
        echo "YksWyhI8\" class=\"link\"> Translations
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
                                ";
        // line 916
        echo "                    <i class=\"material-icons sub-tabs-arrow\">
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
        // line 945
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
        // line 974
        echo "                              </a>
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
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"104\" id=\"subtab-AdminInformat";
        // line 1005
        echo "ion\">
                                <a href=\"/gettadmin/index.php/configure/advanced/system-information/?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" class=\"link\"> Information
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
        // line 1036
        echo "       
                              <li class=\"link-leveltwo\" data-submenu=\"108\" id=\"subtab-AdminImport\">
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
        // line 1067
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
                      1-Click Up";
        // line 1102
        echo "grade
                      </span>
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
                                      ";
        // line 1132
        echo "      </a>
                                        </li>
                                              
                  
                                                      
                  
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
        // line 1164
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
                                                   ";
        // line 1201
        echo "         </i>
                                            </a>
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
        // line 1230
        echo "                 
                              <li class=\"link-leveltwo\" data-submenu=\"192\" id=\"subtab-AdminEtsACReminderBar\">
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
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBrowserTab&amp;token=9e3914126f540d7855c1606e397db83";
        // line 1256
        echo "6\" class=\"link\"> Browser tab notification
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
        // line 1290
        echo "                         </a>
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
        // line 1322
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
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDisp";
        // line 1350
        echo "layLog&amp;token=b7166b209045308dffa53d23ad9728e4\" class=\"link\"> Display log
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

                                                                                  
                              
                                                            
                              <li class=\"link-le";
        // line 1382
        echo "veltwo\" data-submenu=\"206\" id=\"subtab-AdminEtsACMailQueue\">
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
        // line 1411
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
                      <i class=\"mater";
        // line 1442
        echo "ial-icons mi-extension\">extension</i>
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
                      <li class=\"breadcrumb-item\">Module Manager</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/gettadmin/index.php/improve/modules/manage?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" aria-current=\"page\">Modules</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"t";
        // line 1490
        echo "itle-row\">
      
          <h1 class=\"title\">
            Module manager          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary pointer\"                  id=\"page-header-desc-configuration-add_module\"
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
        // line 1533
        echo "                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <li class=\"nav-item\">
                    <a href=\"/gettadmin/index.php/improve/modules/manage?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" id=\"subtab-AdminModulesManage\" class=\"nav-link tab active current\" data-submenu=\"45\">
                      Modules
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"/gettadmin/index.php/modules/addons/modules/uninstalled?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" id=\"subtab-AdminPsMboUninstalledModules\" class=\"nav-link tab \" data-submenu=\"231\">
                      Uninstalled modules
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"/gettadmin/index.php/improve/modules/alerts?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" id=\"subtab-AdminModulesNotifications\" class=\"nav-link tab \" data-submenu=\"46\">
                     ";
        // line 1551
        echo " Alerts
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                <li class=\"nav-item\">
                    <a href=\"/gettadmin/index.php/improve/modules/updates?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\" id=\"subtab-AdminModulesUpdates\" class=\"nav-link tab \" data-submenu=\"47\">
                      Updates
                      <span class=\"notification-container\">
                        <span class=\"notification-counter\"></span>
                      </span>
                    </a>
                  </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ";
        // line 1565
        echo "                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   </ul>
    </div>
  
  <div class=\"btn-floating\">
    <button class=\"btn btn-primary collapsed\" data-toggle=\"collapse\" data-target=\".btn-floating-container\" aria-expanded=\"false\">
      <i class=\"material-icons\">add</i>
    </button>
    <div class=\"btn-floating-container collapse\">
      <div class=\"btn-floating-menu\">
        
                              <a
              class=\"btn btn-floating-item  pointer\"              id=\"page-header-desc-floating-configuration-add_module\"
              href=\"#\"              title=\"Upload a module\"              data-toggle=\"pstooltip\"
              data-placement=\"bottom\"            >
              Upload a module
              <i class=\"material-icons\">cloud_upload</i>            </a>
                                        <a
              class=\"btn btn-floating-item  pointer\"              id=\"page-header-desc-floating-configuration-addons_logout\"
              href=\"#\"              title=\"Synchronized with Addons marketplace!\"              data-toggle=\"pstooltip\"
              data-placement=\"bottom\"            >
              
              <i class=\"material-icons\">exit_to_app</i>            </a>
                  
                              <a class=\"btn btn-f";
        // line 1588
        echo "loating-item btn-help btn-sidebar\" href=\"#\"
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
      recommendedModulesUrl: '/gettadmin/index.php/modules/addons/modules/recommended?tabClassName=AdminModulesManage&_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 0,
      shouldUseLegacyTheme: 0,
    });
  }
</script>

<script>
\$(document).ready( function () {
  if (typeof window.mboCdc !== undefined && typeof window.mboCdc !== \"undefined\") {
    const targetDiv = \$('#main-div .content-div').first()

    const divModuleManagerMessage = document.createElement(\"div\");
    divModuleManagerMessage.setAttribute(\"id\", \"module-manager-message-cdc-container\");

    divModuleManagerMessage.classList.add('module-manager-message-wrapper');
    divModuleManagerMessage.classList.add('cdc-container');

    targetDiv.prepend(divModuleManagerMessage)
    const renderModulesManagerMessage = window.mboCdc.renderModulesManagerMessage

    const context = {\"currency\":\"EUR\",\"iso_lang\":\"en\",\"iso_code\":\"bs\",\"shop_version\":\"1.7.8.11\",\"shop_url\":\"https:\\/\\/woodyoubahamas.com\",\"shop_uuid\":\"2150936f-b101-4a65-9ca7-df19749ed205\",\"mbo_token\":\"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzaG9wX3VybCI6Imh0";
        // line 1629
        echo "dHBzOlwvXC93b29keW91YmFoYW1hcy5jb20iLCJzaG9wX3V1aWQiOiIyMTUwOTM2Zi1iMTAxLTRhNjUtOWNhNy1kZjE5NzQ5ZWQyMDUifQ.yD_8REsYAp0y7IFBZbtrJ7oqAwvvEgU6JobDkkNF9iA\",\"mbo_version\":\"3.2.0\",\"mbo_reset_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/reset\\/ps_mbo?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"user_id\":\"7\",\"admin_token\":\"nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"refresh_url\":\"\\/gettadmin\\/index.php\\/modules\\/mbo\\/me?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"installed_modules\":[{\"id\":0,\"name\":\"stripe_official\",\"status\":\"disabled__mobile_disabled\",\"version\":\"2.5.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/stripe_official?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15277,\"name\":\"statsnewsletter\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config_url\":null},{\"id\":15280,\"name\":\"statsproduct\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.3\",\"config_url\":null},{\"id\":29944,\"name\":\"ets_abandonedcart\",\"status\":\"enabled__mobile_enabled\",\"version\":\"4.8.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ets_abandonedcart?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15275,\"name\":\"statsforecast\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.4\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/statsforecast?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23869,\"name\":\"ps_searchbar\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.3\",\"config_url\":null},{\"id\":22315,\"name\":\"ps_contactinfo\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.3.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_contactinfo?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":5496,\"name\":\"autoupgrade\",\"status\":\"enabled__mobile_enabled\",\"version\":\"5.0.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/autoupgrade?_token=nbDBCeSYQ0";
        echo "ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22322,\"name\":\"ps_sharebuttons\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_sharebuttons?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"colorconfigurator\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/colorconfigurator?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22323,\"name\":\"ps_socialfollow\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.3.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_socialfollow?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15271,\"name\":\"statscatalog\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.4\",\"config_url\":null},{\"id\":22318,\"name\":\"ps_emailsubscription\",\"status\":\"disabled__mobile_disabled\",\"version\":\"2.8.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_emailsubscription?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":42674,\"name\":\"ps_buybuttonlite\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.0.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_buybuttonlite?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":8734,\"name\":\"lgcookieslaw\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.5.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/lgcookieslaw?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23868,\"name\":\"ps_languageselector\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.3\",\"config_url\":null},{\"id\":0,\"name\":\"amazzingblog\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.3.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/amazzingblog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"testimonialswithavatars\",\"status\":\"ena";
        echo "bled__mobile_enabled\",\"version\":\"2.5.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/testimonialswithavatars?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":48891,\"name\":\"ets_onepagecheckout\",\"status\":\"enabled__mobile_disabled\",\"version\":\"2.8.5\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ets_onepagecheckout?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23870,\"name\":\"ps_shoppingcart\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.0.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_shoppingcart?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23867,\"name\":\"ps_facetedsearch\",\"status\":\"enabled__mobile_enabled\",\"version\":\"4.0.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_facetedsearch?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"sekeywords\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.0\",\"config_url\":null},{\"id\":0,\"name\":\"googlemybusinessreviews\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.2.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/googlemybusinessreviews?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15265,\"name\":\"statsbestcustomers\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.4\",\"config_url\":null},{\"id\":15267,\"name\":\"statsbestproducts\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.1\",\"config_url\":null},{\"id\":26957,\"name\":\"mailchimppro\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.0.22\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/mailchimppro?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15282,\"name\":\"statssales\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.0\",\"config_url\":null},{\"id\":0,\"name\":\"rc_pgtagmanager\",\"status\":\"disabled__mobile_disabled\",\"version\":\"2.5.4\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/m";
        echo "anage\\/action\\/configure\\/rc_pgtagmanager?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"fontellico\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.1.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/fontellico?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"psaddonsconnect\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.2\",\"config_url\":null},{\"id\":24696,\"name\":\"ps_crossselling\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_crossselling?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15255,\"name\":\"gridhtml\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config_url\":null},{\"id\":0,\"name\":\"comparewishlistpro\",\"status\":\"disabled__mobile_disabled\",\"version\":\"1.4.8\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/comparewishlistpro?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15269,\"name\":\"statsbestvouchers\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.1\",\"config_url\":null},{\"id\":23866,\"name\":\"ps_customeraccountlinks\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.2.0\",\"config_url\":null},{\"id\":24672,\"name\":\"ps_specials\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.0.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_specials?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":50756,\"name\":\"ps_eventbus\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.0.13\",\"config_url\":null},{\"id\":15284,\"name\":\"statsstock\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.1\",\"config_url\":null},{\"id\":15268,\"name\":\"statsbestsuppliers\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.2\",\"config_url\":null},{\"id\":15253,\"name\":\"dashtrends\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.3\",\"config_url\":null},{\"id\":15272,\"name\":\"statscheckup\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config";
        echo "_url\":null},{\"id\":20242,\"name\":\"bridgeconnector\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.1.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/bridgeconnector?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15254,\"name\":\"graphnvd3\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config_url\":null},{\"id\":0,\"name\":\"signupreminder\",\"status\":\"disabled__mobile_disabled\",\"version\":\"1.2.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/signupreminder?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"simpletabs\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/simpletabs?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":7501,\"name\":\"gsitemap\",\"status\":\"enabled__mobile_enabled\",\"version\":\"4.4.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/gsitemap?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"custombanners\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.9.3\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/custombanners?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22319,\"name\":\"ps_featuredproducts\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.5\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_featuredproducts?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22313,\"name\":\"ps_banner\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_banner?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15273,\"name\":\"statsdata\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/statsdata?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":";
        echo "26873,\"name\":\"ets_multilayerslider\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.1.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ets_multilayerslider?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":16680,\"name\":\"giftcard\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.70\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/giftcard?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15252,\"name\":\"dashproducts\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.4\",\"config_url\":null},{\"id\":32577,\"name\":\"ps_themecusto\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.2.4\",\"config_url\":null},{\"id\":22317,\"name\":\"ps_customtext\",\"status\":\"enabled__mobile_enabled\",\"version\":\"4.2.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_customtext?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":1748,\"name\":\"paypal\",\"status\":\"disabled__mobile_disabled\",\"version\":\"6.4.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/paypal?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23864,\"name\":\"ps_checkpayment\",\"status\":\"disabled__mobile_disabled\",\"version\":\"2.1.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_checkpayment?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"statsequipment\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.0\",\"config_url\":null},{\"id\":49648,\"name\":\"ps_accounts\",\"status\":\"enabled__mobile_enabled\",\"version\":\"7.0.8\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_accounts?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22314,\"name\":\"ps_categorytree\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_categorytree?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":24360,\"name\":\"ps_li";
        echo "nklist\",\"status\":\"enabled__mobile_enabled\",\"version\":\"5.0.5\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_linklist?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15281,\"name\":\"statsregistrations\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.1\",\"config_url\":null},{\"id\":0,\"name\":\"statsorigin\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.2\",\"config_url\":null},{\"id\":24697,\"name\":\"ps_dataprivacy\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_dataprivacy?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15279,\"name\":\"statspersonalinfos\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.4\",\"config_url\":null},{\"id\":24547,\"name\":\"ps_emailalerts\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.0.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_emailalerts?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":26395,\"name\":\"whatsappchat\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.9.7\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/whatsappchat?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"contactboxplus\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.8.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/contactboxplus?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"lggoogleanalytics\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.1.7\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/lggoogleanalytics?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15258,\"name\":\"pagesnotfound\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config_url\":null},{\"id\":41965,\"name\":\"ps_faviconnotificationbo\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.3\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/ac";
        echo "tion\\/configure\\/ps_faviconnotificationbo?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22312,\"name\":\"blockreassurance\",\"status\":\"enabled__mobile_enabled\",\"version\":\"5.1.4\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/blockreassurance?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22321,\"name\":\"ps_mainmenu\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.3.4\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_mainmenu?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15276,\"name\":\"statslive\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.0\",\"config_url\":null},{\"id\":39574,\"name\":\"ps_mbo\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.2.0\",\"config_url\":null},{\"id\":15250,\"name\":\"dashactivity\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.0\",\"config_url\":null},{\"id\":15283,\"name\":\"statssearch\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.2\",\"config_url\":null},{\"id\":15270,\"name\":\"statscarrier\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.1\",\"config_url\":null},{\"id\":0,\"name\":\"easycarousels\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.5.4\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/easycarousels?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23865,\"name\":\"ps_currencyselector\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.1.1\",\"config_url\":null},{\"id\":0,\"name\":\"boninstagramcarousel\",\"status\":\"enabled__mobile_enabled\",\"version\":\"5.2.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/boninstagramcarousel?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":39324,\"name\":\"psgdpr\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.4.3\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/psgdpr?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"gamification\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.5.1\",\"conf";
        echo "ig_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/gamification?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"prefirstatlanticcommerce\",\"status\":\"disabled__mobile_disabled\",\"version\":\"1.1.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/prefirstatlanticcommerce?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23835,\"name\":\"contactform\",\"status\":\"enabled__mobile_enabled\",\"version\":\"4.4.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/contactform?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"plugnpayapi\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.6.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/plugnpayapi?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":23871,\"name\":\"ps_wirepayment\",\"status\":\"disabled__mobile_disabled\",\"version\":\"2.2.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_wirepayment?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"statsvisits\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.3\",\"config_url\":null},{\"id\":0,\"name\":\"ets_megamenu\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.3.4\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ets_megamenu?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15264,\"name\":\"statsbestcategories\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.1\",\"config_url\":null},{\"id\":0,\"name\":\"alltranslate\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.0.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/alltranslate?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":0,\"name\":\"colorchange\",\"status\":\"disabled__mobile_disabled\",\"version\":\"4.3.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/colorchange?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euT";
        echo "nZuHatmYksWyhI8\"},{\"id\":9144,\"name\":\"productcomments\",\"status\":\"enabled__mobile_enabled\",\"version\":\"6.0.2\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/productcomments?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":15251,\"name\":\"dashgoals\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.4\",\"config_url\":null},{\"id\":49583,\"name\":\"ps_metrics\",\"status\":\"enabled__mobile_enabled\",\"version\":\"4.0.10\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_metrics?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22320,\"name\":\"ps_imageslider\",\"status\":\"enabled__mobile_enabled\",\"version\":\"3.2.1\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/ps_imageslider?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"},{\"id\":22316,\"name\":\"ps_customersignin\",\"status\":\"enabled__mobile_enabled\",\"version\":\"2.0.5\",\"config_url\":null},{\"id\":0,\"name\":\"seowebmasterverification\",\"status\":\"enabled__mobile_enabled\",\"version\":\"1.0.0\",\"config_url\":\"\\/gettadmin\\/index.php\\/improve\\/modules\\/manage\\/action\\/configure\\/seowebmasterverification?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\"}],\"accounts_user_id\":\"T3xXGrQ4eSfQsR5fMHbaS0vXTya2\",\"accounts_shop_id\":\"4b728a71-c135-41c3-b002-cee3885faeeb\",\"accounts_token\":\"eyJhbGciOiJSUzI1NiIsImtpZCI6IjQwZDg4ZGQ1NWQxYjAwZDg0ZWU4MWQwYjk2M2RlNGNkOGM0ZmFjM2UiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiUGF0cmljayBSb2xsaW5zIiwicGljdHVyZSI6Imh0dHBzOi8vbGg2Lmdvb2dsZXVzZXJjb250ZW50LmNvbS8tVDhJMGRoVlN2czAvQUFBQUFBQUFBQUkvQUFBQUFBQUFBQUEvQU1adXVja211c3UzVy04b0o0TEtmOUpmQWx5d0FmUW84US9waG90by5qcGciLCJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vcHJlc3Rhc2hvcC1uZXdzc28tcHJvZHVjdGlvbiIsImF1ZCI6InByZXN0YXNob3AtbmV3c3NvLXByb2R1Y3Rpb24iLCJhdXRoX3RpbWUiOjE3MzY0NTc4ODEsInVzZXJfaWQiOiJUM3hYR3JRNGVTZlFzUjVmTUhiYVMwdlhUeWEyIiwic3ViIjoiVDN4WEdyUTRlU2ZRc1I1Zk1IYmFTMHZYVHlhMiIsImlhdCI6MTczNjQ1Nzg4MSwiZXhwIjoxNzM2NDYxNDgxLCJlbWFpbCI6InBhdHJpY2tAd29vZHlvdWJhaGFtYXMu";
        echo "Y29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImZpcmViYXNlIjp7ImlkZW50aXRpZXMiOnsiZW1haWwiOlsicGF0cmlja0B3b29keW91YmFoYW1hcy5jb20iXX0sInNpZ25faW5fcHJvdmlkZXIiOiJjdXN0b20ifX0.ksOxea25KI0Usv37DZFSctIh_k1uxghAl9rxvpUYwxbqh8TjkvYn-GpzFsvW9kWLodUwKo4vGGJXjHuY5Ybr7H_PePag-gy4BesV2TmFj5sriiLAGfhkCuq_E9yeg_61BA1UDHfd031jcXoDOb6D9U769MFECfuEaie-HYuOMNUiyfLcMM-_BLw_eAtcGhQDfb7RrgnhgA8NsyTzSWp3U3ITHNRmsh71iQ5OgqXUPK0ca1-kZjSYoBHjzI2afdDZPAe16YPtbX2J2qlJjGbavjZfNud8QsOpaBa15H4kJYZZRo0WcnnU6LyaqVIVv2bjF-FrgxLqtihU429tBCVWoA\",\"accounts_component_loaded\":false,\"module_catalog_url\":\"\\/gettadmin\\/index.php\\/modules\\/addons\\/modules\\/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"theme_catalog_url\":\"\\/gettadmin\\/index.php\\/modules\\/addons\\/themes\\/catalog?_token=nbDBCeSYQ0ftCgPvbCCOPKoR3euTnZuHatmYksWyhI8\",\"php_version\":\"7.2.34\",\"shop_creation_date\":\"2021-03-22\",\"shop_business_sector_id\":14,\"shop_business_sector\":\"Home Appliances\",\"prestaShop_controller_class_name\":\"AdminModulesManage\"};

    renderModulesManagerMessage(context, '#module-manager-message-cdc-container')
  }
})
</script>

</div>

<div id=\"main-div\">
          
      <div class=\"content-div  with-tabs\">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1650
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
        // line 1700
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
        // line 1739
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
        // line 1758
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>";
        echo "
</html>";
    }

    // line 106
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1650
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

    // line 1758
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
        return "__string_template__e405e61db56b8e61ec7cf361f3dd29b018d2e57409d2925f1765c7821b9175e6";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1958 => 1758,  1941 => 1650,  1932 => 106,  1923 => 1758,  1902 => 1739,  1861 => 1700,  1805 => 1650,  1772 => 1629,  1729 => 1588,  1704 => 1565,  1688 => 1551,  1668 => 1533,  1623 => 1490,  1573 => 1442,  1540 => 1411,  1509 => 1382,  1475 => 1350,  1445 => 1322,  1411 => 1290,  1375 => 1256,  1347 => 1230,  1316 => 1201,  1277 => 1164,  1243 => 1132,  1211 => 1102,  1174 => 1067,  1141 => 1036,  1108 => 1005,  1075 => 974,  1044 => 945,  1013 => 916,  970 => 875,  939 => 846,  907 => 816,  873 => 784,  839 => 752,  807 => 722,  774 => 691,  744 => 663,  706 => 627,  672 => 595,  638 => 563,  606 => 533,  574 => 503,  542 => 473,  507 => 440,  474 => 409,  437 => 374,  401 => 340,  364 => 305,  314 => 257,  253 => 198,  235 => 182,  194 => 143,  152 => 106,  133 => 89,  108 => 66,  82 => 42,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__e405e61db56b8e61ec7cf361f3dd29b018d2e57409d2925f1765c7821b9175e6", "");
    }
}
