<?php
/**
 * 2007-2014 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * No redistribute in other sites, or copy.
 *
 * @author    RSI <rsi_2004@>
 * @copyright 2007-2017 RSI
 * @license   RSI
 */

class Colorchange extends Module
{
    public function __construct()
    {
        $this->name       = 'colorchange';
        $this->module_key = '87ff021027afb6fca84abb85f8b875a1';
        if (_PS_VERSION_ > "1.4.0.0") {
            $this->tab           = 'administration';
            $this->author        = 'RSI';
            $this->need_instance = 1;
        }
        if (_PS_VERSION_ < "1.4.0.0") {
            $this->tab           = 'Tools';
            $this->author        = 'RSI';
            $this->need_instance = 1;
        }
        if (_PS_VERSION_ > '1.6.0.0') {
            $this->tab       = 'administration';
            $this->author    = 'RSI';
            $this->bootstrap = true;
        }
        $this->version = '4.3.0';
 
        parent::__construct();
        
        $this->displayName = $this->l('Template Color change');
        $this->description = $this->l('Change color of the theme  - www.catalogo-onlinersi.net');
        $path              = dirname(__FILE__);
        if (strpos(__FILE__, 'Module.php') !== false) {
            $path .= '/../modules/' . $this->name;
        }
    }
    
    public function install()
    {
        if (!parent::install() || !$this->registerHook('displayHeader')) {
            return false;
        }
        
        if (!Configuration::updateValue('CHANGECOLOR_B', '') && Configuration::updateValue('CHANGECOLOR_B', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_FONT', '') && Configuration::updateValue('CHANGECOLOR_FONT', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_SOCIAL', '') && Configuration::updateValue('CHANGECOLOR_SOCIAL', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_EBC', false) && Configuration::updateValue('CHANGECOLOR_EBC', false)) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_B1', '') && Configuration::updateValue('CHANGECOLOR_B1', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_SOCIALPAGE', '') && Configuration::updateValue('CHANGECOLOR_SOCIALPAGE', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_B2', '') && Configuration::updateValue('CHANGECOLOR_B2', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_B3', '') && Configuration::updateValue('CHANGECOLOR_B3', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_BORDERIMG', '') && Configuration::updateValue('CHANGECOLOR_BORDERIMG', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_H1', '') && Configuration::updateValue('CHANGECOLOR_H1', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_H2', '') && Configuration::updateValue('CHANGECOLOR_H2', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_H3H4', '') && Configuration::updateValue('CHANGECOLOR_H3H4', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_INFO', '') && Configuration::updateValue('CHANGECOLOR_INFO', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_PAR', '') && Configuration::updateValue('CHANGECOLOR_PAR', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_SEARCH', '') && Configuration::updateValue('CHANGECOLOR_SEARCH', '')) {
            return false;
        }
        if (!Configuration::updateValue('CHANGECOLOR_SEARCHT', '') && Configuration::updateValue('CHANGECOLOR_SEARCHT', '')) {
            return false;
        }
        return true;
    }
    
    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }
        $deleteall = Db::getInstance()->ExecuteS('SELECT * FROM `' . _DB_PREFIX_ . 'configuration` WHERE name LIKE \'%CHANGECOLOR%\'');
        while ($reg = mysql_fetch_array($deleteall)) {
            Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'configuration` WHERE id_configuration = ' . $reg['id_configuration']);
        }
        return true;
    }
    
    public function getContent()
    {
        if (((bool)Tools::isSubmit('submitUpdate')) == true) {
            $postp = $this->postProcess();
        }
        if (@Tools::getIsset($_GET['section'])) {
            $index_section = Tools::getValue('section');
        } else {
            $index_section = 1;
        }
        $this->context->smarty->assign(
            array(
                'section_adminpage' => $index_section,
                'id_shop' => $this->context->shop->id,
                'renderForm' => $this->renderForm(),
                'displayinfo' => $this->_displayInfo(),
                'displayinfo2' => $this->renderFont(),
                'displayadds' => $this->_displayAdds(),
                'psversion' => _PS_VERSION_,
                'baseurl' => _PS_BASE_URL_._MODULE_DIR_,
                'idshop' => $this->context->shop->id,
                'server' => $_SERVER['REQUEST_URI'],
                'module_dir'=> $this->_path,
            )
        );
        $output = $this->context->smarty->fetch($this->local_path.'views/templates/hook/configure.tpl');
        return (isset($postp) ? $postp : '').$output;
    }
    
    
    private function _displayInfo()
    {
        return $this->display(__FILE__, 'views/templates/hook/infos.tpl');
    }
    
    public function postProcess()
    {
        $errors = '';
        $output = '';
        if (Tools::isSubmit('submitform')) {
            Configuration::updateValue('CHANGECOLOR_FONT', Tools::getValue('font2'));
            $fff = Tools::getValue('font2');
            if ($fff == null) {
                $fff = 'Noto Sans,sans-serif';
            }
            Configuration::updateValue('CHANGECOLOR_FONTSIZE', Tools::getValue('fontsize'));
            $fsize = Tools::getValue('fontsize');
            if ($fsize == null) {
                $fsize = 1;
            }
            @chmod('../modules/colorchange/views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'chf.css', 0777);
            $xml2 = fopen('../modules/colorchange/views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'chf.css', 'w');
            $ff2  = str_replace('+', ' ', $fff);
            fwrite($xml2, '
@import url(\'//fonts.googleapis.com/css?family=' . $fff . '\');
body{font-family:' . $ff2 . '; font-size:' . $fsize . 'rem}
    ');
            
            $output .= $this->displayConfirmation($this->l('Settings updated') . '<br/>');
            return $output;
        }
        if (Tools::isSubmit('submitUpdate')) {
            Configuration::updateValue('CHANGECOLOR_B', Tools::getValue('b'));
            Configuration::updateValue('CHANGECOLOR_MENUL', Tools::getValue('menul'));
            Configuration::updateValue('CHANGECOLOR_SMENU', Tools::getValue('smenu'));
            Configuration::updateValue('CHANGECOLOR_CBLOCK', Tools::getValue('cblock'));
            Configuration::updateValue('CHANGECOLOR_CTEXT', Tools::getValue('ctext'));
            Configuration::updateValue('CHANGECOLOR_CTITLE', Tools::getValue('ctitle'));

            Configuration::updateValue('CHANGECOLOR_B1', Tools::getValue('b1'));
            Configuration::updateValue('CHANGECOLOR_B2', Tools::getValue('b2'));
            Configuration::updateValue('CHANGECOLOR_H1', Tools::getValue('h1'));
            Configuration::updateValue('CHANGECOLOR_H2', Tools::getValue('h2'));
            Configuration::updateValue('CHANGECOLOR_H3H4', Tools::getValue('h3H4'));
            Configuration::updateValue('CHANGECOLOR_INFO', Tools::getValue('info'));
            Configuration::updateValue('CHANGECOLOR_PAR', Tools::getValue('par'));
            Configuration::updateValue('CHANGECOLOR_LP', Tools::getValue('lp'));
            Configuration::updateValue('CHANGECOLOR_NAV', Tools::getValue('nav'));
            Configuration::updateValue('CHANGECOLOR_NAVC', Tools::getValue('navc'));
            Configuration::updateValue('CHANGECOLOR_SEARCH', Tools::getValue('search'));
            Configuration::updateValue('CHANGECOLOR_SEARCHT', Tools::getValue('searcht'));

            Configuration::updateValue('CHANGECOLOR_B3', Tools::getValue('b3'));
            Configuration::updateValue('CHANGECOLOR_L', Tools::getValue('l'));
            Configuration::updateValue('CHANGECOLOR_C', Tools::getValue('c'));
            Configuration::updateValue('CHANGECOLOR_W', Tools::getValue('w'));
            Configuration::updateValue('CHANGECOLOR_F', Tools::getValue('f'));
            Configuration::updateValue('CHANGECOLOR_FC', Tools::getValue('fc'));
            Configuration::updateValue('CHANGECOLOR_FCL', Tools::getValue('fcl'));
            Configuration::updateValue('CHANGECOLOR_BORDERIMG', Tools::getValue('borderimg'));
            Configuration::updateValue('CHANGECOLOR_H', Tools::getValue('h'));
            Configuration::updateValue('CHANGECOLOR_P', Tools::getValue('p'));
            Configuration::updateValue('CHANGECOLOR_PP', Tools::getValue('pp'));
            Configuration::updateValue('CHANGECOLOR_CA', Tools::getValue('ca'));
            Configuration::updateValue('CHANGECOLOR_N', Tools::getValue('n'));
            Configuration::updateValue('CHANGECOLOR_EBC', Tools::getValue('ebc'));
            Configuration::updateValue('CHANGECOLOR_REPEAT', Tools::getValue('repeat'));
            Configuration::updateValue('CHANGECOLOR_SOCIAL', Tools::getValue('social'));
            Configuration::updateValue('CHANGECOLOR_CCC', Tools::getValue('ccc'));
            Configuration::updateValue('CHANGECOLOR_TABS', Tools::getValue('tabs'));

            Configuration::updateValue('CHANGECOLOR_SOCIALPAGE', Tools::getValue('socialpage'));
            Configuration::updateValue('CHANGECOLOR_BACK', Tools::getValue('backoption'));
            
            if (isset($_FILES['backi']) && isset($_FILES['backi']['tmp_name']) && !empty($_FILES['backi']['tmp_name'])) {
                if ($error = ImageManager::validateUpload($_FILES['backi'], Tools::convertBytes(ini_get('upload_max_filesize')))) {
                    $errors .= $error;
                } else {
                    // Set the image name with a name contextual to the shop context
                    $this->adv_imgname = 'back';
                    if (Shop::getContext() == Shop::CONTEXT_GROUP) {
                        $this->adv_imgname = 'back.jpg';
                    } elseif (Shop::getContext() == Shop::CONTEXT_SHOP) {
                        $this->adv_imgname = 'back.jpg';
                    }
                    // Copy the image in the module directory with its new name
                    if (!move_uploaded_file($_FILES['backi']['tmp_name'], _PS_MODULE_DIR_ . $this->name . '/views/img/' . $this->adv_imgname)) {
                        $errors .= $this->l('File upload error.');
                    }
                }
            }
            $bimagee = '';
            if (Tools::getValue('ebc') == true) {
                $bimagee = 'background-image: url(../img/back.jpg);';
            } else {
                $bimagee = '';
                
            }
            //$this->Writecss($textsize2, $shadow, $color3, $color1);
            $output .= $this->displayConfirmation($this->l('Settings updated') . '<br/>');
            @chmod('../modules/colorchange/views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'ch.css', 0777);
            $xml2 = fopen('../modules/colorchange/views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'ch.css', 'w');
            
            fwrite($xml2, '
            .block-categories{
                background:' . Tools::getValue('cblock') . '!important;
                color:' . Tools::getValue('ctext') . '!important;   
            }
            .block-categories a, .facets-title {
                color:' . Tools::getValue('ctext') . '!important;
            }
                .popover{background:' . Tools::getValue('smenu') . '!important}
.product-images>li.thumb-container>.thumb.selected, .product-images>li.thumb-container>.thumb:hover{border: 3px solid ' . Tools::getValue('b') . '!important;}
.dropdown .expand-more, #header .header-nav .currency-selector{color: ' . Tools::getValue('navc') . '!important}
#products .thumbnail-container .product-thumbnail img, .featured-products .thumbnail-container .product-thumbnail img, .product-accessories .thumbnail-container .product-thumbnail img, .product-miniature .thumbnail-container .product-thumbnail img{
    border:' . Tools::getValue('borderimg') . '!important
}
.blockreassurance_product{
    padding:6px;
}
.blockreassurance_product, #product .tabs{
    background-color:' . Tools::getValue('tabs') . '!important;

/*buton*/

#header .header-nav{background:' . Tools::getValue('nav') . '!important}
#header .header-nav a,#header .header-nav span{color:' . Tools::getValue('navc') . '!important}
h1, .h1{    color: ' . Tools::getValue('h1') . '!important;
}
h3 a{    color: ' . Tools::getValue('lp') . '!important;
}
.dropdown-item{    color: ' . Tools::getValue('menul') . '!important;
}
h2, .h2{    color: ' . Tools::getValue('h2') . '!important;
}
p{    color: ' . Tools::getValue('par') . '!important;
}
h3,h4,.h3, .h4{    color: ' . Tools::getValue('h3h4') . '!important;
}
.product-customization, .blockreassurance_product p {color: ' . Tools::getValue('info') . '!important;}
#search_widget form input{
    background-color: ' . Tools::getValue('search') . '!important;
}
#search_widget form i, .header-top .search-widgets form input[type=text]{    color: ' . Tools::getValue('searcht') . '!important;
}
.btn-primary {
    color: ' . Tools::getValue('b2') . '!important;
    background-color: ' . Tools::getValue('b') . '!important;
}
.btn-primary.disabled.focus, .btn-primary.disabled:focus, .btn-primary.disabled:hover, .btn-primary:disabled.focus, .btn-primary:disabled:focus, .btn-primary:disabled:hover {
    background-color: ' . Tools::getValue('b') . '!important;
    border-color: transparent;
}
.btn-primary.focus, .btn-primary:focus, .btn-primary:hover,.tag-primary[href]:focus, .tag-primary[href]:hover  { background-color: ' . Tools::getValue('b1') . '!important;}

.btn-outline-primary.active, .btn-outline-primary.focus, .btn-outline-primary:active, .btn-outline-primary:focus, .btn-outline-primary:hover, .open>.btn-outline-primary.dropdown-toggle {
    color: ' . Tools::getValue('b2') . '!important;
    background-color: ' . Tools::getValue('b') . '!important;
    border-color: #2fb5d2;
}
.dropdown-item.active, .dropdown-item.active:focus, .dropdown-item.active:hover {
    color: ' . Tools::getValue('b2') . '!important;
    text-decoration: none;
    background-color: ' . Tools::getValue('b') . '!important;
    outline: 0;
}
.nav-pills .nav-item.open .nav-link, .nav-pills .nav-item.open .nav-link:focus, .nav-pills .nav-item.open .nav-link:hover, .nav-pills .nav-link.active, .nav-pills .nav-link.active:focus, .nav-pills .nav-link.active:hover {
    color: ' . Tools::getValue('b2') . '!important;
    cursor: default;
    background-color: ' . Tools::getValue('b') . '!important;
}
.card-primary {
    background-color: ' . Tools::getValue('b') . '!important;
    border-color: #2fb5d2;
}
.page-item.active .page-link, .page-item.active .page-link:focus, .page-item.active .page-link:hover {
    z-index: 2;
    color: ' . Tools::getValue('b2') . '!important;
    cursor: default;
    background-color: ' . Tools::getValue('b') . '!important;
    border-color: #2fb5d2;
}
.tag-primary {
    background-color: ' . Tools::getValue('b') . '!important;
}
.list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
    z-index: 2;
    color: ' . Tools::getValue('b2') . '!important;
    text-decoration: none;
    background-color: ' . Tools::getValue('b') . '!important;
    border-color: #2fb5d2;
}
.custom-radio input[type=radio]:checked+span {
    background-color: ' . Tools::getValue('b') . '!important;

}
.block-social li:hover {
    background-color: ' . Tools::getValue('b') . '!important;
}
.tabs .nav-tabs .nav-link.active, .tabs .nav-tabs .nav-link:hover {
    border: none;
    border-bottom: 3px solid ' . Tools::getValue('b') . '!important;
}
.tabs .nav-tabs .nav-link.active {
    color: ' . Tools::getValue('b') . '!important;
}
a {
    color: ' . Tools::getValue('l') . '!important;
    text-decoration: none;
}
.footer-container li a,.block-contact a, #footer a{
    color: ' . Tools::getValue('fcl') . '!important;
    text-decoration: none;
}
#footer .h1,#footer .h2,#footer .h3, .block-contact .h4, #block_myaccount_infos .myaccount-title a,#block_myaccount_infos .h3, #block-newsletter-label, .block_newsletter p{
    color: ' . Tools::getValue('fc') . '!important;
    text-decoration: none;
}

#header .header-nav .cart-preview.active {
    background: ' . Tools::getValue('c') . '!important;
}
#header .header-nav .blockcart{
    background: ' . Tools::getValue('c') . '!important;

}
/*prices*/
.product-price, .cart-summary-line .value,#products .product-price-and-shipping, .featured-products .product-price-and-shipping, .product-accessories .product-price-and-shipping, .product-miniature .product-price-and-shipping{
 color: ' . Tools::getValue('p') . '!important;
    }
/*wrapper*/
#wrapper,.product-customization .product-message,.search-widget form input[type=text], .block_newsletter form input[type=text] {
    background-color: ' . Tools::getValue('w') . '!important;

}
#wrapper{
    background-color: ' . Tools::getValue('w') . '!important;
    ' . $bimagee . '

    background-repeat:' . Tools::getValue('backoption') . '!important;
}
.tag-default {
    background: ' . Tools::getValue('w') . '!important;
}
.bootstrap-touchspin .btn-touchspin:hover {
    background-color: ' . Tools::getValue('w') . '!important;
}
body#checkout .modal-content {
    background-color: ' . Tools::getValue('w') . '!important;
}
.block-social li:hover {
    background-color: ' . Tools::getValue('w') . '!important;
}
#footer, .block_newsletter {
    background-color: ' . Tools::getValue('f') . '!important;
}
#header {
    background: ' . Tools::getValue('h') . '!important;
}
/*blocks*/
#search_filters, #search_filters_brands, #search_filters_suppliers, .block-categories, .card{
      background: ' . Tools::getValue('b3') . '!important;
    }
#products .product-description, .featured-products .product-description, .product-accessories .product-description, .product-miniature .product-description, #products .thumbnail-container, .featured-products .thumbnail-container, .product-accessories .thumbnail-container, .product-miniature .thumbnail-container
{
        background: ' . Tools::getValue('pp') . '!important;
}
#header .header-nav .cart-preview.active i, #header .header-nav .cart-preview.active a{color:' . Tools::getValue('ca') . '!important}
.block-social  li{background:' . Tools::getValue('social') . '!important;}
.facebook.icon-gray,.twitter.icon-gray,.googleplus.icon-gray,.pinterest.icon-gray {
    background-color:  ' . Tools::getValue('socialpage') . '!important;
}
.header-top .search-widget form input[type=text] {
    min-width: inherit;
    width: 100%;background:white!important;
}
#wrapper .container{background-color: ' . Tools::getValue('ccc') . '}
@media (max-width: 767px){
#header.is-open, #header.is-open .header-top {
    background: ' . Tools::getValue('c') . '!important;
}
}

    ');
            Tools::clearSmartyCache();
            Tools::clearXMLCache();
            Media::clearCache();
            return $output;
        }
    }
    
    public function getConfigFieldsValues()
    {
        
        $fields_values = array(
            'b' => Tools::getValue('b', Configuration::get('CHANGECOLOR_B')),
            'search' => Tools::getValue('search', Configuration::get('CHANGECOLOR_SEARCH')),
            'searcht' => Tools::getValue('searcht', Configuration::get('CHANGECOLOR_SEARCHT')),
            'h1' => Tools::getValue('h1', Configuration::get('CHANGECOLOR_H1')),
            'h2' => Tools::getValue('h2', Configuration::get('CHANGECOLOR_H2')),
            'info' => Tools::getValue('info', Configuration::get('CHANGECOLOR_INFO')),
            'par' => Tools::getValue('par', Configuration::get('CHANGECOLOR_PAR')),
            'lp' => Tools::getValue('lp', Configuration::get('CHANGECOLOR_LP')),
            'menul' => Tools::getValue('menul', Configuration::get('CHANGECOLOR_MENUL')),
            'nav' => Tools::getValue('nav', Configuration::get('CHANGECOLOR_NAV')),
            'smenu' => Tools::getValue('smenu', Configuration::get('CHANGECOLOR_SMENU')),
            'tabs' => Tools::getValue('tabs', Configuration::get('CHANGECOLOR_TABS')),
            'borderimg' => Tools::getValue('borderimg', Configuration::get('CHANGECOLOR_BORDERIMG')),
            'navc' => Tools::getValue('navc', Configuration::get('CHANGECOLOR_NAVC')),
            'h3h4' => Tools::getValue('h3h4', Configuration::get('CHANGECOLOR_H3H4')),
            'b1' => Tools::getValue('b1', Configuration::get('CHANGECOLOR_B1')),
            'b2' => Tools::getValue('b2', Configuration::get('CHANGECOLOR_B2')),
            'b3' => Tools::getValue('b3', Configuration::get('CHANGECOLOR_B3')),
            'l' => Tools::getValue('l', Configuration::get('CHANGECOLOR_L')),
            'c' => Tools::getValue('c', Configuration::get('CHANGECOLOR_C')),
            'ccc' => Tools::getValue('ccc', Configuration::get('CHANGECOLOR_CCC')),
            'w' => Tools::getValue('w', Configuration::get('CHANGECOLOR_W')),
            'f' => Tools::getValue('f', Configuration::get('CHANGECOLOR_F')),
            'h' => Tools::getValue('h', Configuration::get('CHANGECOLOR_H')),
            'fc' => Tools::getValue('fc', Configuration::get('CHANGECOLOR_FC')),
            'fcl' => Tools::getValue('fcl', Configuration::get('CHANGECOLOR_FCL')),
            'p' => Tools::getValue('p', Configuration::get('CHANGECOLOR_P')),
            'pp' => Tools::getValue('pp', Configuration::get('CHANGECOLOR_PP')),
            'ca' => Tools::getValue('ca', Configuration::get('CHANGECOLOR_CA')),
            'ccc' => Tools::getValue('ccc', Configuration::get('CHANGECOLOR_CCC')),
            'ctext' => Tools::getValue('ctext', Configuration::get('CHANGECOLOR_CTEXT')),
            'cblock' => Tools::getValue('cblock', Configuration::get('CHANGECOLOR_CBLOCK')),

            'n' => Tools::getValue('n', Configuration::get('CHANGECOLOR_N')),
            'ebc' => Tools::getValue('ebc', Configuration::get('CHANGECOLOR_EBC')),
            'backoption' => Tools::getValue('backoption', Configuration::get('CHANGECOLOR_BACK')),
            'social' => Tools::getValue('social', Configuration::get('CHANGECOLOR_SOCIAL')),
            'socialpage' => Tools::getValue('socialpage', Configuration::get('CHANGECOLOR_SOCIALPAGE'))
        );
        return $fields_values;
    }
    
    public function renderForm()
    {
        
        ToolsCore::clearCache();
        $options1                         = array(
            array(
                'id_option' => 'repeat',
                // The value of the 'value' attribute of the <option> tag.
                'name' => $this->l('repeat')
                // The value of the text content of the  <option> tag.
            ),
            array(
                'id_option' => 'repeat-x',
                'name' => $this->l('repeat-x')
            ),
            array(
                'id_option' => 'repeat-y',
                'name' => $this->l('repeat-y')
            ),
            array(
                'id_option' => 'no-repeat',
                'name' => $this->l('no-repeat')
            )
        );
        $options2                         = array(
            array(
                'id_option' => true,
                // The value of the 'value' attribute of the <option> tag.
                'name' => $this->l('yes')
                // The value of the text content of the  <option> tag.
            ),
            array(
                'id_option' => false,
                'name' => $this->l('no')
            )
        );
        $this->bacimage                   = Tools::getMediaServer($this->name) . _MODULE_DIR_ . $this->name . '/views/img/back.jpg';
        $token                            = Tools::getAdminTokenLite('AdminModules');
        $back                             = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name . '&token=' . $token;
        $fields_form                      = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configuration'),
                    'icon' => 'icon-image'
                ),
                'input' => array(
                    array(
                        'type' => 'html',
                        'label' => $this->l('BUTTONS'),
                        'name' => ''
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Buttons color / tabs'),
                        'name' => 'b'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button hover color'),
                        'name' => 'b1'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button text color'),
                        'name' => 'b2'
                        
                    ),
                    array(
                        'type' => 'html',
                        'label' => $this->l('FOOTER'),
                        'name' => ''
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Footer color'),
                        'name' => 'f'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Footer text color'),
                        'name' => 'fc'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Footer link color'),
                        'name' => 'fcl'
                        
                    ),
                    array(
                        'type' => 'html',
                        'label' => $this->l('HEADER'),
                        'name' => ''
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Header color'),
                        'name' => 'h'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Search background color'),
                        'name' => 'search'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Search text color'),
                        'name' => 'searcht'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Top nav links color'),
                        'name' => 'n'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Header nav background'),
                        'name' => 'nav'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Header nav text color'),
                        'name' => 'navc'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Menu font color'),
                        'name' => 'menul'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('SubMenu background color'),
                        'name' => 'smenu'
                        
                    ),
                    array(
                        'type' => 'html',
                        'label' => $this->l('OTHER'),
                        'name' => ''
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Category block background color'),
                        'name' => 'cblock'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Category font color'),
                        'name' => 'ctext'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Blocks background color'),
                        'name' => 'b3'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Center column color'),
                        'name' => 'ccc'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link color'),
                        'name' => 'l'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product litle color'),
                        'name' => 'lp'
                        
                    ),
                    
                    array(
                        'type' => 'color',
                        'label' => $this->l('Social icons color'),
                        'name' => 'social'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Social icons product page'),
                        'name' => 'socialpage'
                        
                    ),
                    
                    array(
                        'type' => 'color',
                        'label' => $this->l('Cart color'),
                        'name' => 'c'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Cart text/icon color'),
                        'name' => 'ca'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Wrappers / page background color'),
                        'name' => 'w'
                        
                    ),
                    
                    
                    array(
                        'type' => 'color',
                        'label' => $this->l('Prices color'),
                        'name' => 'p'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Products block color'),
                        'name' => 'pp'
                        
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Image border'),
                        'name' => 'borderimg',
                        'desc' => $this->l('Set a image border,ex: 1px solid #ccc'),
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('H1 color'),
                        'name' => 'h1'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('H2 color'),
                        'name' => 'h2'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('H3 and H4 color'),
                        'name' => 'h3h4'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product description color and reasurance block'),
                        'name' => 'info'
                        
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product reasurance and tabs background'),
                        'name' => 'tabs'
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('General paragraph color'),
                        'name' => 'par'
                        
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Enable Background image'),
                        'name' => 'ebc',
                        'options' => array(
                            'query' => $options2,
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'file',
                        'label' => $this->l('Body Background image'),
                        'name' => 'backi',
                        'desc' => $this->l('upload a background image (jpg format)'),
                        'thumb' => $this->context->link->protocol_content . $this->bacimage,
                        'size' => 100
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Background image repeat'),
                        'name' => 'backoption',
                        'options' => array(
                            'query' => $options1,
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    )
                    
                ),
                
                'buttons' => array(
                    'cancelBlock' => array(
                        'title' => $this->l('Cancel'),
                        'href' => $back,
                        'icon' => 'process-icon-cancel'
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save')
                )
                
            )
        );
        $helper                           = new HelperForm();
        $helper->show_toolbar             = true;
        $helper->table                    = $this->table;
        $lang                             = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language    = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form                = array();
        $helper->module                   = $this;
        $helper->identifier               = $this->identifier;
        $helper->submit_action            = 'submitUpdate';
        $helper->currentIndex             = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token                    = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars                 = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );
        return $helper->generateForm(array(
            $fields_form
        ));
    }
    
    private function _displayAdds()
    {
        $this->context->smarty->assign(array(
            'psversion' => _PS_VERSION_
        ));
        return $this->display(__FILE__, 'views/templates/hook/adds.tpl');
    }
    private function renderFont()
    {
        $this->context->smarty->assign(array(
            'psversion' => _PS_VERSION_,
            'server' => $_SERVER['REQUEST_URI'],
            'fonts' => Configuration::get('CHANGECOLOR_FONT'),
            'fsize' => Configuration::get('CHANGECOLOR_FONTSIZE')
            
        ));
        return $this->display(__FILE__, 'views/templates/hook/font.tpl');
    }
    public function hookDisplayHeader()
    {
        if (_PS_VERSION_ < '8.0.0') {
            $this->context->controller->registerStylesheet('modules-color', 'modules/' . $this->name . '/views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'chf.css', array(
                'position' => 'top',
                'priority' => 159
            ));
            $this->context->controller->registerStylesheet('modules-color2', 'modules/' . $this->name . '/views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'ch.css', array(
                'position' => 'top',
                'priority' => 160
            ));
        } else {
            $this->context->controller->addCSS(
                ($this->_path).'views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'chf.css',
                'all'
            );
            $this->context->controller->addCSS(
                ($this->_path).'views/css/' . ((_PS_VERSION_ > '1.5.0.0') ? $this->context->shop->id : '') . 'ch.css',
                'all'
            );
        }
        return $this->display(__FILE__, 'views/templates/front/header.tpl');
    }
}