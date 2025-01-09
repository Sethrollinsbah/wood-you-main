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

/* __string_template__06684e6416be2a15773304c0ace5c4ab04d3aab702ef06d79a435743b247119b */
class __TwigTemplate_ffd560fe0c0694fe6f87cdec7a1bfc7820bc203f4bd3074ed350bec6ce7b3237 extends \Twig\Template
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

<title>Products • Wood You Furniture | Nassau, Bahamas</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminProducts';
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
    var token = '09175a1916ed4f4dfca4877d4ed8e3e5';
    var token_admin_orders = tokenAdminOrders = '605989550270389f92d275c2a933b00f';
    var token_admin_customers = '1a3f91272ab76d4f498d560b2b11fa54';
    var token_admin_customer_threads = tokenAdminCustomerThreads = '4ec2a287a1e39ef7648230c60f3bcc29';
    var currentIndex = 'index.php?controller=AdminProducts';
    var employee_token = 'c6961cfa72510eed1dd3e99e66809929';
    var choose_language_translate = 'Choose language:';
    var default_language = '1';
    var admin_modules_link = '/gettadmin/index.php/improve/modules/catalog/recommended?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU';
    var admin_notification_get_link = '/gettadmin/index.php/common/notifications?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU';
    var admi";
        // line 43
        echo "n_notification_push_link = adminNotificationPushLink = '/gettadmin/index.php/common/notifications/ack?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU';
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
      <link href=\"/modules/ps_mbo/views/css/recommended-modules-since-1.7.8.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ps_mbo/views/css/connection-toolbar.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/fontellico/views/css/fontello.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/simpletabs/views/css/back.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ets_abandonedcart/views/css/icon-admin.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/gettadmin\\/\";
var baseDir = \"\\/\";
var changeFormLanguageUrl = \"\\/gettadmin\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\";
var currency = {\"iso_code\":\"USD\",\"sign\":\"\$\",\"name\":\"US Dollar\",\"format\":null};
var currency_specifications = {\"symbol\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"USD";
        // line 67
        echo "\",\"currencySymbol\":\"\$\",\"numberSymbols\":[\".\",\",\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"\\u00a4#,##0.00\",\"negativePattern\":\"-\\u00a4#,##0.00\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
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

  <script type=\"text/javascript\">
    var ETS_AC_LINK_REMINDER_ADMIN = \"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEts";
        // line 89
        echo "ACReminderEmail&token=25b904a618b2cb8967de3174e8d53023\";
    var ETS_AC_LINK_CAMPAIGN_TRACKING = \"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACTracking&token=04d20d2de2727ac58aa8dc4c5edfc9a6\";
    var ETS_AC_LOGO_LINK = \"https://woodyoubahamas.com/img/wood-you-logo-1616423577.jpg\";
    var ETS_AC_IMG_MODULE_LINK = \"https://woodyoubahamas.com/modules/ets_abandonedcart/views/img/origin/\";
    var ETS_AC_FULL_BASE_URL = \"https://woodyoubahamas.com/\";
    var ETS_AC_ADMIN_CONTROLLER= \"AdminProducts\";
    var ETS_AC_TRANS = {};
    ETS_AC_TRANS['clear_tracking'] = \"Clear tracking\";
    ETS_AC_TRANS['email_temp_setting'] = \"Email template settings\";
    ETS_AC_TRANS['confirm_clear_tracking'] = \"Clear tracking will also delete all data of Campaign tracking table and statistic data of Dashboard. Do you want to clear tracking?\";
    ETS_AC_TRANS['confirm_delete_lead_field'] = \"Do you want to delete this field?\";
    ETS_AC_TRANS['lead_form_not_found'] = \"Lead form does not exist\";
    ETS_AC_TRANS['lead_form_disabled'] = \"Lead form is disabled\";
</script>


";
        // line 105
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>";
        echo "

<body
  class=\"lang-en adminproducts\"
  data-base-url=\"/gettadmin/index.php\"  data-token=\"UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminDashboard&amp;token=8076d93ad2caa067132dba1de91f9cf6\"></a>
      <span id=\"shop_version\">1.7.8.11</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Quick Access
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=c5cdc83171f422633a2aa9b401afaa7b\"
                 data-item=\"Catalog evaluation\"
      >Catalog evaluation</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php/improve/modules/manage?token=22d312494e51f8a8e2cffc899f10ce18\"
                 data-item=\"Installed modules\"
      >Installed modules</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php/sell/catalog/categories/new?token=22d312494e51f8a8e2cffc899f10ce18\"
                 data-item=\"New category\"
      >New category</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php/sell/catalog/products/new?token=22d312494e51f8a8e2cffc899f10ce18\"
                 data-item=\"New product\"
      >New product</a>
          <a class=\"dropdown-item quick-row-link\"
    ";
        // line 143
        echo "     href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=0b2f575fd95b221bca6f9651cc4d9a70\"
                 data-item=\"New voucher\"
      >New voucher</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminOrders&amp;token=605989550270389f92d275c2a933b00f\"
                 data-item=\"Orders\"
      >Orders</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-add-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"21\"
        data-icon=\"icon-AdminCatalog\"
        data-method=\"add\"
        data-url=\"index.php/sell/catalog/products/0/100/name/asc\"
        data-post-link=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminQuickAccesses&token=641657bdde0da092eeba5dbfd6f7a308\"
        data-prompt-text=\"Please name this shortcut:\"
        data-link=\"Products - List\"
      >
        <i class=\"material-icons\">add_circle</i>
        Add current page to Quick Access
      </a>
        <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminQuickAccesses&token=641657bdde0da092eeba5dbfd6f7a308\">
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
      action=\"/gettadmin/index.php?controller=AdminSearch&amp;token=e0a4433bac9e2117986a3a7f6cbdc584\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Search (e.g.: product reference, customer name…)\" aria-label=\"Searchbar\">
    <div class=\"i";
        // line 181
        echo "nput-group-append\">
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
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">SEARCH</span><i class=\"materi";
        // line 196
        echo "al-icons\">search</i></button>
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
              class=\"nav-link \"
           ";
        // line 256
        echo "   id=\"messages-tab\"
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
              Have you checked your <strong><a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarts&action=filterOnlyAbandonedCarts&token=4373d810c84046cb3df85398a4140236\">abandoned carts</a></strong>?<br>Your next order could be hiding there!
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
    <a class=\"notif\" href='custo";
        // line 304
        echo "mer_url'>
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
      <span class=\"employee_profile\">Welcome back woodyou</span>
      <a class=\"dropdown-item employee-link profile-link\" href=\"/gettadmin/index.php/configure/advanced/employees/2/edit?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\">
      <i class=\"material-icons\">edit</i>
      <span>Your profile</span>
    </a>
    </div>

    <p class=\"divider\"></p>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/resources/documentations?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=resources-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">book</i> Resources</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/training?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=training-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">school</i> Training</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/experts?utm_source=back-office&amp;utm_medium=profile&amp";
        // line 338
        echo ";utm_campaign=expert-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">person_pin_circle</i> Find an Expert</a>
    <a class=\"dropdown-item\" href=\"https://addons.prestashop.com?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=addons-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">extension</i> PrestaShop Marketplace</a>
    <a class=\"dropdown-item\" href=\"https://www.prestashop.com/en/contact?utm_source=back-office&amp;utm_medium=profile&amp;utm_campaign=help-center-en&amp;utm_content=download17\" target=\"_blank\" rel=\"noreferrer\"><i class=\"material-icons\">help</i> Help Center</a>
    <p class=\"divider\"></p>
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminLogin&amp;logout=1&amp;token=e6f06fdbc80e0a9c56afff979b529509\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Sign out</span>
    </a>
  </div>
</div>
      </div>
          </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/gettadmin/index.php/configure/advanced/employees/toggle-navigation?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\">
    <i class=\"material-icons\">chevron_left</i>
    <i class=\"material-icons\">chevron_left</i>
  </span>

  <div class=\"nav-bar-overflow\">
      <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone\" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminDashboard&amp;token=8076d93ad2caa067132dba1de91f9cf6\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Dashboard</span>
              </a>
            </li>

          
                      
                                          
                    
          
  ";
        // line 375
        echo "          <li class=\"category-title link-active\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Sell</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/gettadmin/index.php/sell/orders/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
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
                                <a href=\"/gettadmin/index.php/sell/orders/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Orders
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/gettadmin/index.php/sell/orders/invoices/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Invoices
                         ";
        // line 407
        echo "       </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/gettadmin/index.php/sell/orders/credit-slips/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Credit Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/gettadmin/index.php/sell/orders/delivery-slips/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Delivery Slips
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarts&amp;token=4373d810c84046cb3df85398a4140236\" class=\"link\"> Shopping Carts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"152\" id=\"subtab-AdminGiftCardOrder\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=Admin";
        // line 438
        echo "GiftCardOrder&amp;token=693c70abab5be10c04f70373cf55a053\" class=\"link\"> Gift Cards
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu link-active open ul-open\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/gettadmin/index.php/sell/catalog/products?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catalog
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo link-active\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/gettadmin/index.php/sell/catalog/products?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Products
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\"";
        // line 470
        echo " data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/gettadmin/index.php/sell/catalog/categories?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Categories
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/gettadmin/index.php/sell/catalog/monitoring/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Monitoring
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminAttributesGroups&amp;token=51da974425f80b49960bc048dd105558\" class=\"link\"> Attributes &amp; Features
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/gettadmin/index.php/sell/catalog/brands/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Brands &amp; Suppliers
                                </a>
                              </li>

                                                                                  
                ";
        // line 500
        echo "              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/gettadmin/index.php/sell/attachments/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Files
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCartRules&amp;token=0b2f575fd95b221bca6f9651cc4d9a70\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/gettadmin/index.php/sell/stocks/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Stocks
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"150\" id=\"subtab-AdminGiftCardTemplate\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminGiftCardTemplate&amp;token=b454c3f8f74d5fb6961b17949a66bd23\" class=\"link\"> Templates Gift Cards
                                </a>
                            ";
        // line 529
        echo "  </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"151\" id=\"subtab-AdminGiftCard\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminGiftCard&amp;token=101b35b70485ae7642a276bdfbb8ed0c\" class=\"link\"> Gift Cards
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/gettadmin/index.php/sell/customers/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
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
                                <a href=\"/gettadmin/index.php/sell/customers/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\"";
        // line 560
        echo " class=\"link\"> Customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/gettadmin/index.php/sell/addresses/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Addresses
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCustomerThreads&amp;token=4ec2a287a1e39ef7648230c60f3bcc29\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
                      <span>
                      Customer Service
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"29\" id=\"subtab-Ad";
        // line 592
        echo "minCustomerThreads\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCustomerThreads&amp;token=4ec2a287a1e39ef7648230c60f3bcc29\" class=\"link\"> Customer Service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/gettadmin/index.php/sell/customer-service/order-messages/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Order Messages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminReturn&amp;token=ead3bfd8b64514aaf894016dec90b20e\" class=\"link\"> Merchandise Returns
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"/gettadmin/index.php/modules/metrics/legacy/stats?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                   ";
        // line 623
        echo "   Stats
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-32\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"232\" id=\"subtab-AdminMetricsLegacyStatsController\">
                                <a href=\"/gettadmin/index.php/modules/metrics/legacy/stats?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Stats
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"233\" id=\"subtab-AdminMetricsController\">
                                <a href=\"/gettadmin/index.php/modules/metrics?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> PrestaShop Metrics
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"42\" id=\"tab-IMPROVE\">
                <span class=\"title\">Improve</span>
            </li>

                              
                  
                                                      
                 ";
        // line 661
        echo " 
                  <li class=\"link-levelone has_submenu\" data-submenu=\"43\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/gettadmin/index.php/modules/addons/modules/catalog?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Modules
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"48\" id=\"subtab-AdminParentModulesCatalog\">
                                <a href=\"/gettadmin/index.php/modules/addons/modules/catalog?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Marketplace
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"44\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/gettadmin/index.php/improve/modules/manage?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Module Manager
                                </a>
                              </li>

                                                                                                                                    </ul>
                        ";
        // line 690
        echo "                </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"52\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/gettadmin/index.php/modules/addons/themes/catalog?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
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
                                <a href=\"/gettadmin/index.php/modules/addons/themes/catalog?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Theme Catalog
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"126\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/gettadmin/index.php/improve/design/themes/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Theme &amp; Logo
                                </a>
                              </li>

     ";
        // line 722
        echo "                                                                                                                                   
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"55\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/gettadmin/index.php/improve/design/mail_theme/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Email Theme
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"57\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/gettadmin/index.php/improve/design/cms-pages/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Pages
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"58\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/gettadmin/index.php/improve/design/modules/positions/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Positions
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"59\" id=\"subtab-AdminImages\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminImages&";
        // line 750
        echo "amp;token=0aec336d67cd0d98d9d11a234257aae0\" class=\"link\"> Image Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"125\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/gettadmin/index.php/modules/link-widget/list?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Link Widget
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"60\" id=\"subtab-AdminParentShipping\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarriers&amp;token=420bfcb0a5fd8c6feb5103d4beb23fca\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Shipping
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-60\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"61\" id=\"subt";
        // line 782
        echo "ab-AdminCarriers\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminCarriers&amp;token=420bfcb0a5fd8c6feb5103d4beb23fca\" class=\"link\"> Carriers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"62\" id=\"subtab-AdminShipping\">
                                <a href=\"/gettadmin/index.php/improve/shipping/preferences/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"63\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/gettadmin/index.php/improve/payment/payment_methods?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
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
        // line 814
        echo "                  
                              <li class=\"link-leveltwo\" data-submenu=\"64\" id=\"subtab-AdminPayment\">
                                <a href=\"/gettadmin/index.php/improve/payment/payment_methods?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Payment Methods
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"65\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/gettadmin/index.php/improve/payment/preferences?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Preferences
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"66\" id=\"subtab-AdminInternational\">
                    <a href=\"/gettadmin/index.php/improve/international/localization/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
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
        // line 845
        echo "                                          
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"67\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/gettadmin/index.php/improve/international/localization/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Localization
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"72\" id=\"subtab-AdminParentCountries\">
                                <a href=\"/gettadmin/index.php/improve/international/zones/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Locations
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"76\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/gettadmin/index.php/improve/international/taxes/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Taxes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"79\" id=\"subtab-AdminTranslations\">
                                <a href=\"/gettadmin/index.php/improve/international/translations/settings?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Translation";
        // line 873
        echo "s
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"170\" id=\"subtab-Marketing\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=Marketing&amp;token=817065e15f6945df53fc460d056f7ad1\" class=\"link\">
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
                    <a href=\"/gettadmin/index.php/configure/shop/preferences/preferences?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Shop Parameters
                      </span>
                                                    <i class=\"mater";
        // line 914
        echo "ial-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-81\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"82\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/preferences/preferences?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> General
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"85\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/order-preferences/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Order Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"88\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/product-preferences/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Product Settings
                                </a>
                              </li>

                                                                                  
       ";
        // line 944
        echo "                       
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"89\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/gettadmin/index.php/configure/shop/customer-preferences/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Customer Settings
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"93\" id=\"subtab-AdminParentStores\">
                                <a href=\"/gettadmin/index.php/configure/shop/contacts/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Contact
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"96\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/gettadmin/index.php/configure/shop/seo-urls/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Traffic &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"100\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminSearchConf&amp;token=8e70eaa05040c4832c41cb6c4a19b721\" class=\"link\"> Search
                                </a>
";
        // line 973
        echo "                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"130\" id=\"subtab-AdminGamification\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminGamification&amp;token=39154ee5cb01f7fee148aa6ee90ef568\" class=\"link\"> Merchant Expertise
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"103\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/gettadmin/index.php/configure/advanced/system-information/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\">
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
        // line 1004
        echo "   <a href=\"/gettadmin/index.php/configure/advanced/system-information/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Information
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"105\" id=\"subtab-AdminPerformance\">
                                <a href=\"/gettadmin/index.php/configure/advanced/performance/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Performance
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"106\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/gettadmin/index.php/configure/advanced/administration/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Administration
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"107\" id=\"subtab-AdminEmails\">
                                <a href=\"/gettadmin/index.php/configure/advanced/emails/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                           ";
        // line 1035
        echo "   <li class=\"link-leveltwo\" data-submenu=\"108\" id=\"subtab-AdminImport\">
                                <a href=\"/gettadmin/index.php/configure/advanced/import/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Import
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"109\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/gettadmin/index.php/configure/advanced/employees/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Team
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"113\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/gettadmin/index.php/configure/advanced/sql-requests/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Database
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"116\" id=\"subtab-AdminLogs\">
                                <a href=\"/gettadmin/index.php/configure/advanced/logs/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Logs
                                </a>
                              </li>

                                                                                  
                              
                      ";
        // line 1066
        echo "                                      
                              <li class=\"link-leveltwo\" data-submenu=\"117\" id=\"subtab-AdminWebservice\">
                                <a href=\"/gettadmin/index.php/configure/advanced/webservice-keys/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Webservice
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"221\" id=\"subtab-AdminFeatureFlag\">
                                <a href=\"/gettadmin/index.php/configure/advanced/feature-flags/?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" class=\"link\"> Experimental Feature
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"121\" id=\"tab-DEFAULT\">
                <span class=\"title\">More</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"185\" id=\"subtab-AdminSelfUpgrade\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminSelfUpgrade&amp;token=be6fc769f1fa79ddbe14ff1ff56ccd03\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      1-Click Upgrade
                      </span>";
        // line 1101
        echo "
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"154\" id=\"tab-mailchimppro\">
                <span class=\"title\">Mailchimp Config</span>
            </li>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"174\" id=\"subtab-AdminMailchimpProConfiguration\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminMailchimpProConfiguration&amp;token=5bce43124f162621f20031fcc2da7b10\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Mailchimp Configuration
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                        ";
        // line 1131
        echo "                </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"175\" id=\"subtab-AdminMailchimpProQueue\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminMailchimpProQueue&amp;token=eb02c9b0aae35619145d375d7767c867\" class=\"link\">
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
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminMailchimpProTags&amp;token=cebe778e9a73113558d5061ac9dbcdf9\" class=\"link\">
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
        // line 1163
        echo "       
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"186\" id=\"tab-AdminEtsAC\">
                <span class=\"title\">Customer reminders</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"187\" id=\"subtab-AdminEtsACDashboard\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDashboard&amp;token=49c53105b10d2ab674d09979f56375d1\" class=\"link\">
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
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderEmail&amp;token=25b904a618b2cb8967de3174e8d53023\" class=\"link\">
                      <i class=\"material-icons mi-\"></i>
                      <span>
                      Reminder campaigns
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                     ";
        // line 1200
        echo "                       </a>
                                              <ul id=\"collapse-188\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"189\" id=\"subtab-AdminEtsACReminderEmail\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderEmail&amp;token=25b904a618b2cb8967de3174e8d53023\" class=\"link\"> Automated abandoned cart emails
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"190\" id=\"subtab-AdminEtsACReminderCustomer\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderCustomer&amp;token=0481afb970b6c714f8ae06c39cf7f78f\" class=\"link\"> Custom emails and newsletter
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"191\" id=\"subtab-AdminEtsACReminderPopup\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderPopup&amp;token=706f8a25f6c5a89f37d8ce6266a45967\" class=\"link\"> Popup reminder
                                </a>
                              </li>

                                                                                  
                              
                                                            
                 ";
        // line 1229
        echo "             <li class=\"link-leveltwo\" data-submenu=\"192\" id=\"subtab-AdminEtsACReminderBar\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBar&amp;token=08426f81b8a6743fef83e2b13d1a4c6d\" class=\"link\"> Highlight bar reminder
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"193\" id=\"subtab-AdminEtsACReminderBrowser\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBrowser&amp;token=da280b90a1e415575373bfd8abf5e8a0\" class=\"link\"> Web push notification
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"194\" id=\"subtab-AdminEtsACReminderLeave\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderLeave&amp;token=558dae1ae288cf14d823464396741d59\" class=\"link\"> Leaving website reminder
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"195\" id=\"subtab-AdminEtsACReminderBrowserTab\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACReminderBrowserTab&amp;token=a7d030fdc999afe207a96135c361e437\" class=\"link\"> Browser tab notifi";
        // line 1254
        echo "cation
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"196\" id=\"subtab-AdminEtsACCart\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACCart&amp;token=b8c1c1933d5381b7ca9c1aa993423f17\" class=\"link\">
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
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACConvertedCarts&amp;token=f29e0c02dd04c821ab6cf9002cfa2d4b\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
                      Recovered carts
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
     ";
        // line 1289
        echo "                                   </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"198\" id=\"subtab-AdminEtsACEmailTemplate\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACEmailTemplate&amp;token=ee8c1cc5e10d659985839c1a8ba745d4\" class=\"link\">
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
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACEmailTracking&amp;token=b812c3b6df256e8c3146fbaaf720beb6\" class=\"link\">
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
        // line 1321
        echo "                 
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"200\" id=\"subtab-AdminEtsACEmailTracking\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACEmailTracking&amp;token=b812c3b6df256e8c3146fbaaf720beb6\" class=\"link\"> Email tracking
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"201\" id=\"subtab-AdminEtsACDisplayTracking\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDisplayTracking&amp;token=13e54359a0d818cda8f8a7e69b57f6bf\" class=\"link\"> Display tracking
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"202\" id=\"subtab-AdminEtsACDiscounts\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDiscounts&amp;token=a47af7b4fd89c93d3120f3cc6b97e851\" class=\"link\"> Discounts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"203\" id=\"subtab-AdminEtsACDisplayLog\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACDisplayLog&amp;token=80d7260958bb5df038";
        // line 1348
        echo "5ddc7713f2bf6b\" class=\"link\"> Display log
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"204\" id=\"subtab-AdminEtsACMailConfigs\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailServices&amp;token=41d45183eaa6eb6f8a8fc1cde46c3054\" class=\"link\">
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
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailServices&amp;token=41d45183eaa6eb6f8a8fc1cde46c3054\" class=\"link\"> Mail service
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"206\" id=\"subt";
        // line 1380
        echo "ab-AdminEtsACMailQueue\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailQueue&amp;token=824867d3af9f61245b36f78bcd0fe625\" class=\"link\"> Mail queue
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"207\" id=\"subtab-AdminEtsACIndexedCarts\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACIndexedCarts&amp;token=cd82c89f140f9b5e84fc9dcae05fadf4\" class=\"link\"> Indexed carts
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"208\" id=\"subtab-AdminEtsACIndexedCustomers\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACIndexedCustomers&amp;token=f6456135090b6baf5c61ca1d4a1f9afe\" class=\"link\"> Indexed customers
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"209\" id=\"subtab-AdminEtsACUnsubscribed\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACUnsubscribed&amp;token=f8135a405b8df0453027772e5d515834\" class=\"link\"> Unsubscribed list
                                </a>
                              </li>

                                   ";
        // line 1409
        echo "                                               
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"210\" id=\"subtab-AdminEtsACMailLog\">
                                <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACMailLog&amp;token=4ece9dd338cb3d7b494b0abc20f452e4\" class=\"link\"> Mail log
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"211\" id=\"subtab-AdminEtsACLeads\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACLeads&amp;token=65c88e1644e66ffa60144fb2a4b103bb\" class=\"link\">
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
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACConfigs&amp;token=daa0a3dac8bf9665dce5fbb3b65610bc\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</";
        // line 1440
        echo "i>
                      <span>
                      Automation
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone\" data-submenu=\"213\" id=\"subtab-AdminEtsACOtherConfigs\">
                    <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminEtsACOtherConfigs&amp;token=4309978b1e82ef30377169691fb179bb\" class=\"link\">
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
                      <li class=\"breadcrumb-item\">Catalog</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/gettadmin/index.php/sell/catalog/products?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\" aria-current=\"page\">Products</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"tit";
        // line 1490
        echo "le\">
            Products          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary pointer\"                  id=\"page-header-desc-configuration-add\"
                  href=\"/gettadmin/index.php/sell/catalog/products/new?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\"                  title=\"Create a new product: CTRL+P\"                  data-toggle=\"pstooltip\"
                  data-placement=\"bottom\"                >
                  <i class=\"material-icons\">add_circle_outline</i>                  New product
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Help\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/gettadmin/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fen%252Fdoc%252FAdminProducts%253Fversion%253D1.7.8.11%2526country%253Den/Help?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\"
                   id=\"product_form_open_help\"
                >
                  Help
                </a>
                                    </div>
        </div>

      
    </div>
  </div>

  
  
  <div class=\"btn-floating\">
    <button class=\"btn btn-primary collapsed\" data-toggle=\"collapse\" data-target=\".btn-floating-container\" aria-expanded=\"false\">
      <i class=\"material-icons\">add</i>
    </button>
    <div class=\"btn-floating-container collapse\">
      <div class=\"btn-floating-menu\">
        
                              <a
              class=\"btn btn-floating-item  pointer\"              id=\"page-header-desc-floating-configuration-add\"
              href=\"/gettadmin/index.php/sell/catalog/products/new?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\"              ";
        // line 1533
        echo "title=\"Create a new product: CTRL+P\"              data-toggle=\"pstooltip\"
              data-placement=\"bottom\"            >
              New product
              <i class=\"material-icons\">add_circle_outline</i>            </a>
                  
                              <a class=\"btn btn-floating-item btn-help btn-sidebar\" href=\"#\"
               title=\"Help\"
               data-toggle=\"sidebar\"
               data-target=\"#right-sidebar\"
               data-url=\"/gettadmin/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop.com%252Fen%252Fdoc%252FAdminProducts%253Fversion%253D1.7.8.11%2526country%253Den/Help?_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU\"
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
        'Recommended Modules and Services': 'Optimize product catalog',
        'description': \"Make your products more visible and create product pages that convert.<br>\\n                Here\\'s a selection of modules, <\\strong>compatible with your store<\\/strong>, to help you achieve your goals.\",
        'Close': 'Close',
      },
      recommendedModulesUrl: '/gettadmin/index.php/modules/addons/modules/recommended?tabClassName=AdminProducts&_token=UDGluhY_z4pN0gk7aoOzJteZVugrtgFRnNWB5ichENU',
      shouldAttachRecommendedModulesAfterContent: 0,
      shouldAttachRecommendedModulesButton: 1,
      shouldUseLegacyTheme: 0,
    });
  }
</script>


</div>

<div id=\"main-div\">
          
      <div class=\"content-div  \">

        

                                                        
        <div class=\"row \">
          <div class=\"col-sm-12\">
            <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>


  ";
        // line 1580
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
  <a href=\"https://woodyoubahamas.com/gettadmin/index.php?controller=AdminDashboard&amp;token=8076d93ad2caa067132dba1de91f9cf6\" class=\"btn btn-primary py-1 mt-3\">
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
\t\t\t\t\t<a href=\"https://addons.prestashop.com/en/login?email=info%40woodyoubahamas.com&amp;firstname=woodyou&amp;lastname=bahamas&amp;website=http%3A%2F%2Fwoodyoubahamas.com%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-EN&amp;utm_content=download#createnow\"><img class=\"img-responsive center-block\" src=\"/gettadmin/themes/default/img/prestashop-addons-logo.png\" alt=\"Logo PrestaShop Addons\"/></a>
\t\t\t\t\t<h3 class=\"text-center\">Connect your shop to PrestaShop's marketplace in order to automatically import all your Addons purchases.</h3>
\t\t\t\t\t<hr />
\t\t\t\t</div>
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"col-";
        // line 1630
        echo "md-6\">
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
\t\t\t\t\t\t\t<a class=\"btn btn-default btn-block btn-lg _blank\" href=\"https://addons.prestashop.com/en/login?email=info%40woodyoubahamas.com&amp;firstname=woodyou&amp;lastname=bahamas&amp;website=http%3A%2F%2Fwoodyoubahamas.com%2F&amp;utm_source=back-office&amp;utm_medium=connect-to-addons&amp;utm_campaign=back-office-EN&amp;utm_content=download#createnow\">
\t\t\t\t\t\t\t\tCreate an Account
\t\t\t\t\t\t\t\t<i class=\"icon-external-link\"></i>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t<div class=\"form-group\">
\t\t\t\t\t\t\t<button id=\"addons_login_button\" class=\"btn btn-primary btn-block btn-lg\" type=\"submit\">
\t\t\t\t\t\t\t\t<i clas";
        // line 1669
        echo "s=\"icon-unlock\"></i> Sign in
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
        // line 1688
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>";
        echo "
</html>";
    }

    // line 105
    public function block_stylesheets($context, array $blocks = [])
    {
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
    }

    // line 1580
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

    // line 1688
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
        return "__string_template__06684e6416be2a15773304c0ace5c4ab04d3aab702ef06d79a435743b247119b";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1870 => 1688,  1853 => 1580,  1844 => 105,  1835 => 1688,  1814 => 1669,  1773 => 1630,  1717 => 1580,  1668 => 1533,  1623 => 1490,  1571 => 1440,  1538 => 1409,  1507 => 1380,  1473 => 1348,  1444 => 1321,  1410 => 1289,  1373 => 1254,  1346 => 1229,  1315 => 1200,  1276 => 1163,  1242 => 1131,  1210 => 1101,  1173 => 1066,  1140 => 1035,  1107 => 1004,  1074 => 973,  1043 => 944,  1011 => 914,  968 => 873,  938 => 845,  905 => 814,  871 => 782,  837 => 750,  807 => 722,  773 => 690,  742 => 661,  702 => 623,  669 => 592,  635 => 560,  602 => 529,  571 => 500,  539 => 470,  505 => 438,  472 => 407,  438 => 375,  399 => 338,  363 => 304,  313 => 256,  251 => 196,  234 => 181,  194 => 143,  151 => 105,  133 => 89,  109 => 67,  83 => 43,  39 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__06684e6416be2a15773304c0ace5c4ab04d3aab702ef06d79a435743b247119b", "");
    }
}
