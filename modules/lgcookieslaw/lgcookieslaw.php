<?php
/**
 *  Please read the terms of the CLUF license attached to this module(cf "licences" folder)
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.lineagrafica.es/licenses/license_en.pdf
 *            https://www.lineagrafica.es/licenses/license_es.pdf
 *            https://www.lineagrafica.es/licenses/license_fr.pdf
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

require realpath(dirname(__FILE__)) . '/config/config.inc.php';

class LGCookiesLaw extends Module
{
    public $bootstrap;

    protected $configurations;
    protected $configurations_list;
    protected $hooks_list;

    public function __construct()
    {
        $this->name = 'lgcookieslaw';
        $this->tab = 'front_office_features';
        $this->version = '1.5.1';
        $this->author = 'Línea Gráfica';
        $this->need_instance = 0;
        $this->module_key = '56c109696b8e3185bc40d38d855f7332';
        $this->author_address = '0x30052019eD7528f284fd035BdA14B6eC3A4a1ffB';

        $this->bootstrap = substr_count(_PS_VERSION_, '1.6') > 0;

        parent::__construct();

        $this->displayName = $this->l('EU Cookie Law (Notification Banner + Cookie Blocker)');
        $this->description = $this->l('Display a cookie banner and block cookies before getting the user consent.');

        /* Backward compatibility */
        if (_PS_VERSION_ < '1.5') {
            require(_PS_MODULE_DIR_ . $this->name . '/backward_compatibility/backward.php');
        }

        $this->configurations_list = [
            'PS_LGCOOKIES_TIMELIFE' => [
                'default_value'   => '31536000',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_NAME' => [
                'default_value'   => '__lglaw',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_DIVCOLOR' => [
                'default_value'   => '#707070',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_POSITION' => [
                'default_value'   => '3',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_OPACITY' => [
                'default_value'   => '0.7',
                'auto_proccess'   => false,
                'add_field_value' => false,
                'html'            => false,
            ],
            'PS_LGCOOKIES_TESTMODE' => [
                'default_value'   => true,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_RELOAD' => [
                'default_value'   => false,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_BLOCK' => [
                'default_value'   => false,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_HIDDEN' => [
                'default_value'   => false,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_SHOW_REJECT_ALL_BTN' => [
                'default_value'   => true,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_SHADOWCOLOR' => [
                'default_value'   => '#707070',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_FONTCOLOR' => [
                'default_value'   => '#FFFFFF',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_CMS' => [
                'default_value'   => true,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_CMS_TARGET' => [
                'default_value'   => true,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_CMS_SHOW_BANNER' => [
                'default_value'   => false,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_BTN1_FONT_COLOR' => [
                'default_value'   => '#FFFFFF',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_BTN1_BG_COLOR' => [
                'default_value'   => '#8BC954',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_THIRD_PARTIES' => [
                'default_value'   => false,
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_HOOK' => [
                'default_value'   => 'footer',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_IPTESTMODE' => [
                'default_value'   => '' . $_SERVER['REMOTE_ADDR'] . '',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
            'PS_LGCOOKIES_BOTS' => [
                'default_value' =>
                    'Teoma,alexa,froogle,Gigabot,inktomi,looksmart,URL_Spider_SQL,Firefly,NationalDirectory,' .
                    'AskJeeves,TECNOSEEK,InfoSeek,WebFindBot,girafabot,crawler,www.galaxy.com,Googlebot,Scooter,' .
                    'TechnoratiSnoop,Rankivabot,Mediapartners-Google, Sogouwebspider,WebAltaCrawler,TweetmemeBot,' .
                    'Butterfly,Twitturls,Me.dium,Twiceler',
                'auto_proccess'   => true,
                'add_field_value' => true,
                'html'            => false,
            ],
        ];

        $this->hooks_list = [
            'top',
            'displayMobileTop',
            'header',
            'backofficeHeader',
            'displayCustomerAccount',
            'footer',
        ];
    }

    public function install()
    {
        return parent::install() &&
            $this->installConfigurations() &&
            $this->installHooks() &&
            $this->installSQL() &&
            $this->installationDefaults() &&
            $this->saveCss();
    }

    public function uninstall()
    {
        return parent::uninstall() &&
            $this->uninstallConfigurations() &&
            $this->uninstallSQL();
    }

    protected function installConfigurations()
    {
        $success = true;

        $id_shop = $this->context->shop->id;
        $id_shop_group = Shop::getGroupFromShop((int)$id_shop);

        foreach ($this->configurations_list as $configuration_name => $configuration) {
            $success &= Configuration::updateValue(
                $configuration_name,
                $configuration['default_value'],
                $configuration['html'],
                (int)$id_shop_group,
                (int)$id_shop
            );

            if (!$success) {
                break;
            }
        }

        return $success;
    }

    protected function uninstallConfigurations()
    {
        $success = true;

        foreach ($this->configurations_list as $configuration_name => $configuration) {
            $success &= Configuration::deleteByName($configuration_name);

            if (!$success) {
                break;
            }
        }

        unset($configuration_name);
        unset($configuration);

        return $success;
    }

    protected function installHooks()
    {
        $success = true;

        foreach ($this->hooks_list as $hook_name) {
            $success &= $this->registerHook($hook_name);

            if (!$success) {
                break;
            }
        }

        return $success;
    }

    public function installSQL()
    {
        return include($this->getLocalPath() . '/sql/install.php');
    }

    public function installationDefaults($default_iso_code = 'en')
    {
        $result = true;

        $id_shop = (int)$this->context->shop->id;

        foreach (LGCookiesLawPurpose::getInstallationDefaults() as $installation_default) {
            $lgcookieslaw_purpose = new LGCookiesLawPurpose();

            foreach (Language::getLanguages() as $lang) {
                $name = isset($installation_default['name'][($lang['iso_code'])]) ?
                    $installation_default['name'][$lang['iso_code']] :
                    $installation_default['name'][$default_iso_code];
                $description = isset($installation_default['description'][($lang['iso_code'])]) ?
                    $installation_default['description'][$lang['iso_code']] :
                    $installation_default['description'][$default_iso_code];

                $lgcookieslaw_purpose->name[(int)$lang['id_lang']] = $name;
                $lgcookieslaw_purpose->description[(int)$lang['id_lang']] = $description;
            }

            $lgcookieslaw_purpose->id_shop = (int)$id_shop;
            $lgcookieslaw_purpose->technical = (bool)$installation_default['technical'];
            $lgcookieslaw_purpose->locked_modules = Tools::jsonEncode($installation_default['locked_modules']);
            $lgcookieslaw_purpose->js_code = '';
            $lgcookieslaw_purpose->active = (bool)$installation_default['active'];

            $result &= $lgcookieslaw_purpose->save();

            unset($lgcookieslaw_purpose);
        }

        foreach (LGCookiesLawCookie::getInstallationDefaults() as $id_lgcookieslaw_purpose => $cookies) {
            foreach ($cookies as $installation_default) {
                $lgcookieslaw_cookie = new LGCookiesLawCookie();

                foreach (Language::getLanguages() as $lang) {
                    $cookie_purpose = isset($installation_default['cookie_purpose'][($lang['iso_code'])]) ?
                        $installation_default['cookie_purpose'][$lang['iso_code']] :
                        $installation_default['cookie_purpose'][$default_iso_code];
                    $expiry_time = isset($installation_default['expiry_time'][($lang['iso_code'])]) ?
                        $installation_default['expiry_time'][$lang['iso_code']] :
                        $installation_default['expiry_time'][$default_iso_code];

                    $lgcookieslaw_cookie->cookie_purpose[(int)$lang['id_lang']] = $cookie_purpose;
                    $lgcookieslaw_cookie->expiry_time[(int)$lang['id_lang']] = $expiry_time;
                }

                $lgcookieslaw_cookie->id_shop = (int)$id_shop;
                $lgcookieslaw_cookie->id_lgcookieslaw_purpose = (int)$id_lgcookieslaw_purpose;
                $lgcookieslaw_cookie->name = $installation_default['name'];
                $lgcookieslaw_cookie->provider = $installation_default['provider'];
                $lgcookieslaw_cookie->provider_url = $installation_default['provider_url'];
                $lgcookieslaw_cookie->active = (bool)$installation_default['active'];

                $result &= $lgcookieslaw_cookie->save();

                unset($lgcookieslaw_cookie);
            }
        }

        return $result;
    }

    public function uninstallSQL()
    {
        return include($this->getLocalPath() . '/sql/uninstall.php');
    }

    private function cleanBots($bots)
    {
        $bots = str_replace(' ', '', $bots);

        return $bots;
    }

    private function getCMSList()
    {
        $cms = Db::getInstance()->ExecuteS(
            'SELECT * '.
            'FROM '._DB_PREFIX_.'cms_lang '.
            'WHERE id_lang = '.(int)(Configuration::get('PS_LANG_DEFAULT'))
        );

        return $cms;
    }

    private function isBot($agente)
    {
        $bots = Configuration::get('PS_LGCOOKIES_BOTS');
        $botlist = explode(',', $bots);

        foreach ($botlist as $bot) {
            if (strpos($agente, $bot) !== false) {
                return true;
            }
        }

        return false;
    }

    private function getModuleList()
    {
        $modules = Db::getInstance()->ExecuteS('SELECT * FROM ' . _DB_PREFIX_ . 'module');

        return $modules;
    }

    private function getContentLang($id_lang, $field)
    {
        $content = Db::getInstance()->getValue(
            'SELECT '.$field.' '.
            'FROM '._DB_PREFIX_.'lgcookieslaw_lang '.
            'WHERE id_lang = '.(int)$id_lang
        );
        return $content;
    }

    private function formatBootstrap($text)
    {
        $text = str_replace('<fieldset>', '<div class="panel">', $text);
        $text = str_replace(
            '<fieldset style="background:#DFF2BF;color:#4F8A10;border:1px solid #4F8A10;">',
            '<div class="panel"  style="background:#DFF2BF;color:#4F8A10;border:1px solid #4F8A10;">',
            $text
        );
        $text = str_replace('</fieldset>', '</div>', $text);
        $text = str_replace('<legend>', '<h3>', $text);
        $text = str_replace('</legend>', '</h3>', $text);
        return $text;
    }

    public function installOverrides()
    {
        $path = _PS_MODULE_DIR_.$this->name.
            DIRECTORY_SEPARATOR.'override'.
            DIRECTORY_SEPARATOR.'classes'.
            DIRECTORY_SEPARATOR;

        if (version_compare(_PS_VERSION_, '1.7.7.0', '>=')) {
            copy($path.'Hook1770.php', $path.'Hook.php');
        } elseif (version_compare(_PS_VERSION_, '1.7.0', '>=')) {
            copy($path.'Hook1700.php', $path.'Hook.php');
        } elseif (version_compare(_PS_VERSION_, '1.6.0.10', '>')) {
            copy($path.'Hook16011.php', $path.'Hook.php');
        } elseif (version_compare(_PS_VERSION_, '1.6.0.5', '>')) {
            copy($path.'Hook16010.php', $path.'Hook.php');
        } else {
            copy($path.'Hook15.php', $path.'Hook.php');
        }

        return parent::installOverrides();
    }

    private function getP($template)
    {
        $iso_langs = array('es', 'en', 'fr', 'it', 'de');
        $current_iso_lang = $this->context->language->iso_code;
        $iso = (in_array($current_iso_lang, $iso_langs)) ? $current_iso_lang : 'en';

        $this->context->smarty->assign(
            array(
                'lgcookieslaw_iso' => $iso,
                'base_url' => _MODULE_DIR_. $this->name . DIRECTORY_SEPARATOR,
            )
        );

        return $this->context->smarty->fetch(
            _PS_MODULE_DIR_ . $this->name
            . DIRECTORY_SEPARATOR . 'views'
            . DIRECTORY_SEPARATOR . 'templates'
            . DIRECTORY_SEPARATOR . 'admin'
            . DIRECTORY_SEPARATOR . '_p_' . $template . '.tpl'
        );
    }


    private function warningA()
    {
        if (!file_exists(_PS_ROOT_DIR_.'/override/classes/Hook.php')) {
            $warningA = $this->displayError(
                $this->l('The Hook.php override is missing.').
                '&nbsp;'.$this->l('Please reset the module or copy the override manually on your FTP.')
            );
            return $warningA;
        }
    }

    private function warningB()
    {
        if ((int)Configuration::get('PS_DISABLE_OVERRIDES') > 0) {
            $tokenP = Tools::getAdminTokenLite('AdminPerformance');

            $w = $this->getLinkTag(
                'index.php?tab=AdminPerformance&token='.$tokenP,
                'here',
                '_blank'
            );

            $warningB = $this->displayError(
                $this->l('The overrides are currently disabled on your store.').
                '&nbsp;'.$this->l('Please change the configuration').
                '&nbsp;'.$w
            );
            return $warningB;
        }
    }

    private function warningC()
    {
        if ((int)Configuration::get('PS_DISABLE_NON_NATIVE_MODULE') > 0) {
            $tokenP = Tools::getAdminTokenLite('AdminPerformance');

            $w = $this->getLinkTag(
                'index.php?tab=AdminPerformance&token='.$tokenP,
                'here',
                '_blank'
            );

            $warningC = $this->displayError(
                $this->l('Non PrestaShop modules are currently disabled on your store.').
                '&nbsp;'.$this->l('Please change the configuration').
                '&nbsp;'.$w
            );
            return $warningC;
        }
    }

    private function warningD()
    {
        if ((int)Configuration::get('PS_LGCOOKIES_TESTMODE') > 0) {
            $warningD = $this->displayError(
                $this->l('The preview mode of the module is enabled.').
                '&nbsp;'.$this->l('Don\'t forget to disable it once you have finished configuring the banner.')
            );
            return $warningD;
        }
    }

    public function getLinkTag($href, $message, $target = null, $title = null)
    {
        $this->context->smarty->assign(
            array(
                'href'    => $href,
                'target'  => $target,
                'title'   => $title,
                'message' => $message,
            )
        );

        return $this->context->smarty->fetch(
            _PS_MODULE_DIR_.$this->name.
            DIRECTORY_SEPARATOR.'views'.
            DIRECTORY_SEPARATOR.'templates'.
            DIRECTORY_SEPARATOR.'admin'.
            DIRECTORY_SEPARATOR.'message_link.tpl'
        );
    }

    public function getContent()
    {
        $this->postProcess();

        $this->context->controller->addJqueryPlugin('ui.tooltip', null, true);

        $this->fields_form = array();

        $this->fields_form[0]['form']['tabs'] = array(
            'config' => $this->l('General settings'),
            'banner' => $this->l('Banner settings'),
            'buttons' => $this->l('Button settings'),
            'modules' => $this->l('Modules blocked'),
        );

        $urll = $this->context->link->getModuleLink(
            $this->name,
            'disallow',
            array(
                'token' => md5(_COOKIE_KEY_.$this->name)
            ),
            true
        );

        $this->context->smarty->assign(
            array(
                'href'   => $urll,
                'target' => '_blank',
                'title'  => 'European Union General Data Protection Rules law',
                'message'  => $urll,
            )
        );

        $w = $this->context->smarty->fetch(
            _PS_MODULE_DIR_.$this->name.
            DIRECTORY_SEPARATOR.'views'.
            DIRECTORY_SEPARATOR.'templates'.
            DIRECTORY_SEPARATOR.'admin'.
            DIRECTORY_SEPARATOR.'message_link.tpl'
        );

        $t1 = $this->l('With this option your banner styles set initially as disabled:none then show by javascript. ');

        $banner_images = array(
            1 => $this->_path . 'views/img/en_banner_top.jpg',
            2 => $this->_path . 'views/img/en_banner_bottom.jpg',
            3 => $this->_path . 'views/img/en_banner_float.jpg',
        );

        $iso_code = $this->context->language->iso_code;

        if (file_exists(_PS_MODULE_DIR_ . $this->name . '/views/img/' . $iso_code . '_banner_top.jpg')) {
            $banner_images[1] = $this->_path . 'views/img/' . $iso_code . '_banner_top.jpg';
        }

        if (file_exists(_PS_MODULE_DIR_ . $this->name . '/views/img/' . $iso_code . '_banner_bottom.jpg')) {
            $banner_images[2] = $this->_path . 'views/img/' . $iso_code . '_banner_bottom.jpg';
        }

        if (file_exists(_PS_MODULE_DIR_ . $this->name . '/views/img/' . $iso_code . '_banner_float.jpg')) {
            $banner_images[3] = $this->_path . 'views/img/' . $iso_code . '_banner_float.jpg';
        }

        $this->fields_form[0]['form']['input'] = array(
            array(
                'label' => $this->l('IMPORTANT:'),
                'tab' => 'config',
                'desc' =>
                    $this->l('Don´t forget to disable the preview mode once you have finished configuring the banner.'),
                'type' => 'free',
                'name' => 'important',
            ),
            array(
                'label' => $this->l('Disallow url'),
                'tab' => 'config',
                'desc' => $w.'&nbsp;'.
                    $this->l('This link will grant the right of revoke their consent to your customers.').
                    $this->l('You can paste this url on your CMS.').
                    $this->l('Ypur users will be able to clean all cookies except Prestashop ones.'),
                'type' => 'free',
                'name' => 'important',
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Enable by default third parties cookies'),
                'name' => 'PS_LGCOOKIES_THIRD_PARTIES',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('If this option is enabled, third parties cookies checkbox will be enabled by default.'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_THIRD_PARTIES_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_THIRD_PARTIES_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Add revoke consent button'),
                'name' => 'PS_LGCOOKIES_DISALLOW',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Enable this option to add a button on customers acount to revoke cookie consent.').
                    '&nbsp;'.$this->l('It will lcean all cookies except Prestashop ones,'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_DISALLOW_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_DISALLOW_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Reload the page after accepting cookies'),
                'name' => 'PS_LGCOOKIES_RELOAD',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Enable this option if you wish reload the page after a customer accepts cookies.'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_RELOAD_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_RELOAD_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Block site navigation'),
                'name' => 'PS_LGCOOKIES_BLOCK',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Enable this option if you wish to block your site navigation').'&nbsp;'.
                    ('until the customers push the accept button on the banner.'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_BLOCK_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_BLOCK_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Preview mode:'),
                'name' => 'PS_LGCOOKIES_TESTMODE',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Enable this option to preview the cookie banner in your front-office').'&nbsp;'.
                    $this->l('without bothering your customers (when the preview mode is enabled,').'&nbsp;'.
                    $this->l('the banner doesn´t disappear, the module doesn´t block cookies').'&nbsp;'.
                    $this->l('and only the person using the IP below is able to see the cookie banner).'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_TESTMODE_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_TESTMODE_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Cache modules compatibility'),
                'name' => 'PS_LGCOOKIES_HIDDEN',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $t1.
                    $this->l('This can be usefull if your site use some cache module. ').
                    $this->l('Do not active this option if your accept button hide the banner, ').
                    $this->l('this option may not comply with the law.'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_HIDDEN_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_HIDDEN_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'ip',
                'label' => $this->l('IP  for the preview mode:'),
                'name' => 'PS_LGCOOKIES_IPTESTMODE',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Click on the button "Add IP" to be the only person').'&nbsp;'.
                    $this->l('able to see the banner (if the preview mode is enabled).'),
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Cookie lifetime (seconds):'),
                'name' => 'PS_LGCOOKIES_TIMELIFE',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Set the duration during which the user consent will be saved (1 year = 31536000s).'),
            ),
            array(
                'type' => 'text',
                'label' => $this->l('Cookie name:'),
                'name' => 'PS_LGCOOKIES_NAME',
                'tab' => 'config',
                'required' => false,
                'desc' =>
                    $this->l('Choose the name of the cookie used by our module to remember user consent').
                    '&nbsp;'.$this->l('(don´t use any space).'),
            ),
            array(
                'type' => 'select',
                'label' => $this->l('Hook position:'),
                'name' => 'PS_LGCOOKIES_HOOK',
                'tab' => 'config',
                'required' => false,
                'desc' => $this->l('Choose a different hook if you need.').'&nbsp;'.
                    ('Useful for some themes where hook "top" not present.'),
                'options' => array(
                    'query' => array(
                        array('id' => 'top', 'name' => 'top'),
                        array('id' => 'footer', 'name' => 'footer'),
                    ),
                    'id' => 'id',
                    'name' => 'name',
                ),
            ),
            array(
                'type' => 'textarea',
                'label' => $this->l('SEO protection:'),
                'name' => 'PS_LGCOOKIES_BOTS',
                'tab' => 'config',
                'required' => false,
                'cols' => '10',
                'rows' => '5',
                'desc' =>
                    $this->l('The module will prevent the search engine bots above').'&nbsp;'.
                    $this->l('from seeing the cookie warning banner when they crawl your website.'),
            ),
            array(
                'type' => 'free',
                'tab' => 'config',
                'label' => ' ',
                'name' => 'help1',
            ),
            array(
                'type' => 'free',
                'tab' => 'config',
                'label' => ' ',
                'name' => 'help5',
            ),
            array(
                'type' => 'select',
                'label' => $this->l('Banner position:'),
                'name' => 'PS_LGCOOKIES_POSITION',
                'tab' => 'banner',
                'required' => false,
                'desc' => $this->l('Choose the position of the warning banner (top or bottom of the page).'),
                'options' => array(
                    'query' => array(
                        array('id' => '1', 'name' => $this->l('Top')),
                        array('id' => '2', 'name' => $this->l('Bottom')),
                        array('id' => '3', 'name' => $this->l('Floating / Centered')),
                    ),
                    'id' => 'id',
                    'name' => 'name',
                ),
            ),
            array(
                'type' => 'banner_type',
                'tab' => 'banner',
                'label' => ' ',
                'name' => 'PS_LGCOOKIES_BANNER_TYPE',
                'selected' => (int) Configuration::get('PS_LGCOOKIES_POSITION', 3),
                'images' => $banner_images
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show Reject All button'),
                'name' => 'PS_LGCOOKIES_SHOW_REJECT_ALL_BTN',
                'tab' => 'banner',
                'required' => false,
                'desc' =>
                    $this->l('Enable this option to Show the Reject All button.'),
                'class' => 't',
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_SHOW_REJECT_ALL_BTN_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_SHOW_REJECT_ALL_BTN_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'color',
                'label' => $this->l('Background color:'),
                'name' => 'PS_LGCOOKIES_DIVCOLOR',
                'tab' => 'banner',
                'required' => false,
            ),
            array(
                'type' => 'select',
                'label' => $this->l('Background opacity:'),
                'name' => 'PS_LGCOOKIES_OPACITY',
                'tab' => 'banner',
                'required' => false,
                'desc' => $this->l('Choose the opacity of the background color (1 is opaque, 0 is transparent).'),
                'options' => array(
                    'query' => array(
                        array('id' => '1', 'name' => '1'),
                        array('id' => '0.9', 'name' => '0.9'),
                        array('id' => '0.8', 'name' => '0.8'),
                        array('id' => '0.7', 'name' => '0.7'),
                        array('id' => '0.6', 'name' => '0.6'),
                        array('id' => '0.5', 'name' => '0.5'),
                        array('id' => '0.4', 'name' => '0.4'),
                        array('id' => '0.3', 'name' => '0.3'),
                        array('id' => '0.2', 'name' => '0.2'),
                        array('id' => '0.1', 'name' => '0.1'),
                        array('id' => '0', 'name' => '0'),
                    ),
                    'id' => 'id',
                    'name' => 'name',
                ),
            ),
            array(
                'type' => 'color',
                'label' => $this->l('Shadow color:'),
                'name' => 'PS_LGCOOKIES_SHADOWCOLOR',
                'tab' => 'banner',
                'required' => false,
            ),
            array(
                'type' => 'color',
                'label' => $this->l('Font color:'),
                'name' => 'PS_LGCOOKIES_FONTCOLOR',
                'tab' => 'banner',
                'required' => false,
            ),
            array(
                'type' => 'textarea',
                'label' => $this->l('Banner message:'),
                'name' => 'content',
                'autoload_rte' => 'true',
                'lang' => 'true',
                'tab' => 'banner',
                'required' => false,
                'cols' => '10',
                'rows' => '5',
                'desc' =>
                    $this->l('Example: "Our webstore uses cookies to offer a better user experience').'&nbsp;'.
                    $this->l('and we recommend you to accept their use to fully enjoy your navigation."'),
            ),
            array(
                'type' => 'free',
                'tab' => 'banner',
                'label' => ' ',
                'name' => 'help2',
            ),
            array(
                'type' => 'free',
                'tab' => 'banner',
                'label' => ' ',
                'name' => 'help5',
            ),
            array(
                'type' => 'text',
                'lang' => 'true',
                'label' => $this->l('Title of the button 1 "I accept":'),
                'name' => 'button1',
                'tab' => 'buttons',
                'required' => false,
            ),
            array(
                'type' => 'color',
                'label' => $this->l('Button 1 background color:'),
                'name' => 'PS_LGCOOKIES_BTN1_BG_COLOR',
                'tab' => 'buttons',
                'required' => false,
            ),
            array(
                'type' => 'color',
                'label' => $this->l('Button 1 font color:'),
                'name' => 'PS_LGCOOKIES_BTN1_FONT_COLOR',
                'tab' => 'buttons',
                'required' => false,
            ),
            array(
                'type' => 'text',
                'lang' => 'true',
                'label' => $this->l('Title of the button 2 "More information":'),
                'name' => 'button2',
                'tab' => 'buttons',
                'required' => false,
            ),
            array(
                'type' => 'select',
                'label' => $this->l('Link of the button 2 "More information":'),
                'name' => 'PS_LGCOOKIES_CMS',
                'tab' => 'buttons',
                'required' => false,
                'desc' =>
                    $this->l('When you click on the "More information" button,').'&nbsp;'.
                    $this->l('it will take you to CMS page you have selected.'),
                'options' => array(
                    'query' => CMSCore::getCMSPages((int)$this->context->language->id),
                    'id' => 'id_cms',
                    'name' => 'meta_title',
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Open the link in a new window:'),
                'name' => 'PS_LGCOOKIES_CMS_TARGET',
                'tab' => 'buttons',
                'required' => false,
                'desc' =>
                    $this->l('When you click on the "More information" button,').'&nbsp;'.
                    $this->l('the CMS page will be opened in a new or the same window of your browser.'),
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_CMS_TARGET_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_CMS_TARGET_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'switch',
                'label' => $this->l('Show the banner the Cookies Policy CMS:'),
                'name' => 'PS_LGCOOKIES_CMS_SHOW_BANNER',
                'tab' => 'buttons',
                'required' => false,
                'desc' =>
                    $this->l('This option indicates if you want to hide the banner within').'&nbsp;'.
                    $this->l('the Cookies Policy page in order to read it without having the banner in front.'),
                'is_bool' => true,
                'values' => array(
                    array(
                        'id' => 'PS_LGCOOKIES_CMS_SHOW_BANNER_on',
                        'value' => 1,
                        'label' => $this->l('Yes'),
                    ),
                    array(
                        'id' => 'PS_LGCOOKIES_CMS_SHOW_BANNER_off',
                        'value' => 0,
                        'label' => $this->l('No'),
                    ),
                ),
            ),
            array(
                'type' => 'free',
                'tab' => 'buttons',
                'name' => 'help3',
                'label' => ' ',
            ),
            array(
                'type' => 'free',
                'tab' => 'buttons',
                'label' => ' ',
                'name' => 'help5',
            ),
            array(
                'type' => 'free',
                'label' => $this->l('Block cookies:'),
                'name' => 'PS_BANNER_LIST',
                'tab' => 'modules',
                'desc' =>
                    $this->l('Here is the list of all the modules installed on your store.').'&nbsp;'.
                    $this->l('Tick the modules that you want to disable until users give their consent.'),
            ),
            array(
                'type' => 'free',
                'tab' => 'modules',
                'label' => ' ',
                'name' => 'help4',
            ),
            array(
                'type' => 'free',
                'tab' => 'modules',
                'label' => ' ',
                'name' => 'help5',
            ),
        );

        $lgcookieslaw_purposes = LGCookiesLawPurpose::getPurposes();

        $cookie_purposes = [
            LGCookiesLawPurpose::FUNCTIONAL_PURPOSE => $this->l('Functional Purpose'),
            LGCookiesLawPurpose::MARKETING_PURPOSE => $this->l('Marketing Purpose'),
            LGCookiesLawPurpose::ANALYTICS_PURPOSE => $this->l('Analytics Purpose'),
            LGCookiesLawPurpose::PERFORMANCE_PURPOSE => $this->l('Performance Purpose'),
            LGCookiesLawPurpose::OTHER_PURPOSE => $this->l('Other Purpose'),
        ];

        $temporal_fields = [];

        foreach ($lgcookieslaw_purposes as $lgcookieslaw_purpose) {
            $temporal_fields[] = [
                'type' => 'text',
                'label' =>
                    $this->l('Name') .
                    ' (' . $cookie_purposes[(int)$lgcookieslaw_purpose[LGCookiesLawPurpose::$definition['primary']]] .
                    ')',
                'name' =>
                    'purpose_name_' . $lgcookieslaw_purpose[LGCookiesLawPurpose::$definition['primary']],
                'lang' => 'true',
                'tab' => 'banner',
                'required' => false,
                'cols' => '10',
                'rows' => '5',
                'desc' => $lgcookieslaw_purpose['technical'] ? $this->l('(Cookie technical)') : '',
            ];

            $temporal_fields[] = [
                'type' => 'textarea',
                'label' =>
                    $this->l('Description') .
                    ' (' . $cookie_purposes[(int)$lgcookieslaw_purpose[LGCookiesLawPurpose::$definition['primary']]] .
                    ')',
                'name' =>
                    'purpose_description_' . $lgcookieslaw_purpose[LGCookiesLawPurpose::$definition['primary']],
                'autoload_rte' => 'true',
                'lang' => 'true',
                'tab' => 'banner',
                'required' => false,
                'cols' => '10',
                'rows' => '5',
                'desc' => $lgcookieslaw_purpose['technical'] ? $this->l('(Cookie technical)') : '',
            ];
        }

        $this->fields_form[0]['form']['input'] =
            array_merge($this->fields_form[0]['form']['input'], $temporal_fields);

        $this->fields_form[0]['form']['submit'] = [
            'title' => $this->l('Save'),
            'name' => 'submitForm',
        ];

        $config_params = [];

        $config_params['tabs'] = $this->fields_form[0]['form']['tabs'];

        $form = new HelperForm($this);

        if (version_compare(_PS_VERSION_, '1.6.0', '<')) {
            $this->context->controller->addJS(_MODULE_DIR_ . $this->name . '/views/js/bootstrap.js');
            $this->context->controller->addJS(_MODULE_DIR_ . $this->name . '/views/js/admin15.js');
            $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/admin15.css');

            $ps15 = true;
        } else {
            $ps15 = false;
        }

        $form->tpl_vars = $config_params;
        $form->show_toolbar = true;
        $form->module = $this;
        $form->fields_value = $this->getConfigFormValues();
        $form->name_controller = 'lgcookieslaw';
        $form->identifier = $this->identifier;
        $form->token = Tools::getAdminTokenLite('AdminModules');
        $form->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
        $form->allow_employee_form_lang = $this->context->language->id;

        $languages = Language::getLanguages();
        $language_exists = false;

        foreach ($languages as &$lang) {
            $lang['is_default'] = ($lang['id_lang'] == $this->context->language->id);

            if ($lang['is_default']) {
                $language_exists = true;
            }
        }

        $form->default_form_language = $language_exists
            ? $this->context->language->id
            : (int)Configuration::get('PS_LANG_DEFAULT');

        $form->languages = $languages;
        $form->toolbar_scroll = true;
        $form->title = $this->displayName;
        $form->submit_action = 'submitForm';
        $form->toolbar_btn = array(
            'back' =>
                array(
                    'href' =>
                        AdminController::$currentIndex.'&configure='.$this->name.
                        '&token='.Tools::getAdminTokenLite('AdminModules'),
                    'desc' => $this->l('Back to the list')
                )
        );

        $params = [];

        $params['link'] = $this->context->link;
        $params['current_id_lang'] = $this->context->language->id;
        $params['ps15'] = $ps15;
        $params['ssl'] = (int)Configuration::get('PS_SSL_ENABLED_EVERYWHERE');

        $this->context->smarty->assign($params);

        $content =
            $this->context->smarty->fetch(
                _PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.
                'templates'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'configure.tpl'
            );

        $advise = $this->context->smarty->fetch(
            _PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.
            'templates'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'advise.tpl'
        );

        return
            $this->getP('top') .
            $advise.
            $this->warningA().
            $this->warningB().
            $this->warningC().
            $this->warningD().
            $content.
            $form->generateForm($this->fields_form).
            $this->getP('bottom');
    }

    public function postProcess()
    {
        if (Tools::getIsset('submitForm')) {
            $fields = array(
                'PS_LGCOOKIES_TESTMODE',
                'PS_LGCOOKIES_IPTESTMODE',
                'PS_LGCOOKIES_TIMELIFE',
                'PS_LGCOOKIES_NAME',
                'PS_LGCOOKIES_BOTS',
                'PS_LGCOOKIES_CMS',
                'PS_LGCOOKIES_OPACITY',
                'PS_LGCOOKIES_DIVCOLOR',
                'PS_LGCOOKIES_SHADOWCOLOR',
                'PS_LGCOOKIES_FONTCOLOR',
                'PS_LGCOOKIES_CMS_TARGET',
                'PS_LGCOOKIES_CMS_SHOW_BANNER',
                'PS_LGCOOKIES_POSITION',
                'PS_LGCOOKIES_SHOW_REJECT_ALL_BTN',
                'PS_LGCOOKIES_BTN1_FONT_COLOR',
                'PS_LGCOOKIES_BTN1_BG_COLOR',
                'PS_LGCOOKIES_HIDDEN',
                'PS_LGCOOKIES_THIRD_PARTIES',
                'PS_LGCOOKIES_HOOK',
                'PS_LGCOOKIES_DISALLOW',
                'PS_LGCOOKIES_RELOAD',
                'PS_LGCOOKIES_BLOCK',
            );

            $res = true;

            foreach ($fields as $field) {
                $value = Tools::getValue($field, '');

                if (strpos($field, 'COLOR') !== false) {
                    $value = Tools::substr($value, 0, 1) == '#'
                        ? $value
                        : '#' . $value;
                }

                $res &= Configuration::updateValue($field, $value);
            }

            foreach (Language::getLanguages() as $lang) {
                Db::getInstance()->Execute(
                    'REPLACE INTO '._DB_PREFIX_.'lgcookieslaw_lang VALUES '.
                    '('.(int)$lang['id_lang'].', \''.pSQL(Tools::getValue('button1_'.(int)$lang['id_lang'])).'\', '.
                    '"'.pSQL(Tools::getValue('button2_'.(int)$lang['id_lang'])).'", '.
                    '"'.pSQL(Tools::getValue('content_'.(int)$lang['id_lang']), 'html').'")'
                );
            }

            $lgcookieslaw_purposes = LGCookiesLawPurpose::getPurposes();

            foreach ($lgcookieslaw_purposes as $lgcookieslaw_purpose) {
                $id_lgcookieslaw_purpose = (int)$lgcookieslaw_purpose['id_lgcookieslaw_purpose'];

                $lgcookieslaw_purpose_object =
                    new LGCookiesLawPurpose((int)$id_lgcookieslaw_purpose);

                foreach (Language::getLanguages() as $lang) {
                    $lgcookieslaw_purpose_object->name[(int)$lang['id_lang']] =
                        Tools::getValue('purpose_name_' . $id_lgcookieslaw_purpose . '_' . $lang['id_lang']);
                    $lgcookieslaw_purpose_object->description[(int)$lang['id_lang']] =
                        Tools::getValue('purpose_description_' . $id_lgcookieslaw_purpose . '_' . $lang['id_lang']);
                }

                $locked_modules = Tools::getValue('locked_modules_' . $id_lgcookieslaw_purpose);
                $locked_modules = empty($locked_modules) ? [] : explode(',', $locked_modules);

                $lgcookieslaw_purpose_object->locked_modules = Tools::jsonEncode($locked_modules);

                $lgcookieslaw_purpose_object->save();

                unset($lgcookieslaw_purpose_object);
            }

            unset($lgcookieslaw_purposes);

            $this->saveCss();
        }
    }

    public function saveCss()
    {
        $position = null;

        if (Configuration::get('PS_LGCOOKIES_POSITION') == 1) {
            $position = 'top:0';
        } elseif (Configuration::get('PS_LGCOOKIES_POSITION') == 2) {
            $position = 'bottom:0';
        }

        list($r, $g, $b) = sscanf(Configuration::get('PS_LGCOOKIES_DIVCOLOR'), '#%02x%02x%02x');
        $bgcolor = $r.','.$g.','.$b.','.Configuration::get('PS_LGCOOKIES_OPACITY');

        $this->context->smarty->assign(array(
            'bgcolor'             => $bgcolor,
            'fontcolor'           => Configuration::get('PS_LGCOOKIES_FONTCOLOR'),
            'btn1_bgcolor'        => Configuration::get('PS_LGCOOKIES_BTN1_BG_COLOR'),
            'btn1_fontcolor'      => Configuration::get('PS_LGCOOKIES_BTN1_FONT_COLOR'),
            'shadowcolor'         => Configuration::get('PS_LGCOOKIES_SHADOWCOLOR'),
            'opacity'             => 'opacity:' . Configuration::get('PS_LGCOOKIES_OPACITY'),
            'path_module'         => _MODULE_DIR_ . $this->name,
            'nombre_cookie'       => Configuration::get('PS_LGCOOKIES_NAME'),
            'tiempo_cookie'       => Configuration::get('PS_LGCOOKIES_TIMELIFE'),
            'lgcookieslaw_reload' => Configuration::get('PS_LGCOOKIES_RELOAD'),
            'hidden'              => Configuration::get('PS_LGCOOKIES_HIDDEN'),
            'position'            => $position,
        ));

        $rendered_template = $this->display(__FILE__, '/views/templates/hook/style.tpl');

        $path = _PS_MODULE_DIR_ .
            $this->name . DIRECTORY_SEPARATOR .
            'views' . DIRECTORY_SEPARATOR.
            'css' . DIRECTORY_SEPARATOR .
            'lgcookieslaw.css';

        $fp = fopen($path, 'w');

        fwrite($fp, $rendered_template);
        fclose($fp);

        return true;
    }

    public function getConfigFormValues()
    {
        $fields = array(
            'PS_LGCOOKIES_TESTMODE',
            'PS_LGCOOKIES_IPTESTMODE',
            'PS_LGCOOKIES_TIMELIFE',
            'PS_LGCOOKIES_NAME',
            'PS_LGCOOKIES_BOTS',
            'PS_LGCOOKIES_CMS',
            'PS_LGCOOKIES_OPACITY',
            'PS_LGCOOKIES_DIVCOLOR',
            'PS_LGCOOKIES_SHADOWCOLOR',
            'PS_LGCOOKIES_FONTCOLOR',
            'PS_LGCOOKIES_CMS_TARGET',
            'PS_LGCOOKIES_CMS_SHOW_BANNER',
            'PS_LGCOOKIES_POSITION',
            'PS_LGCOOKIES_SHOW_REJECT_ALL_BTN',
            'PS_LGCOOKIES_BTN1_FONT_COLOR',
            'PS_LGCOOKIES_BTN1_BG_COLOR',
            'PS_LGCOOKIES_HIDDEN',
            'PS_LGCOOKIES_THIRD_PARTIES',
            'PS_LGCOOKIES_HOOK',
            'PS_LGCOOKIES_DISALLOW',
            'PS_LGCOOKIES_RELOAD',
            'PS_LGCOOKIES_BLOCK',
        );

        $out = Configuration::getMultiple($fields);

        $fields_lang = array('button1', 'button2', 'content');

        foreach ($fields_lang as $field) {
            foreach (Language::getLanguages() as $lang) {
                $out[$field][$lang['id_lang']] = $this->getContentLang($lang['id_lang'], $field);
            }
        }

        $out['PS_LGCOOKIES_BANNER_TYPE'] = (int)Configuration::get('PS_LGCOOKIES_POSITION');

        $out['help1'] =
            '<img src="../modules/' . $this->name . '/views/img/info.png"> ' .
            '<a href="../modules/' . $this->name . '/readme/readme_' . $this->l('en') .
            '.pdf#page=5" target="_blank">' .
                $this->l('Read this page for more information') .
            '</a>';

        $out['help2'] =
            '<img src="../modules/' . $this->name . '/views/img/info.png"> ' .
            '<a href="../modules/' . $this->name . '/readme/readme_' . $this->l('en') .
            '.pdf#page=7" target="_blank">' .
                $this->l('Read this page for more information') .
            '</a>';

        $out['help3'] =
            '<img src="../modules/' . $this->name . '/views/img/info.png"> ' .
            '<a href="../modules/' . $this->name . '/readme/readme_' . $this->l('en') .
            '.pdf#page=10" target="_blank">' .
                $this->l('Read this page for more information') .
            '</a>';

        $out['help4'] =
            '<img src="../modules/' . $this->name . '/views/img/info.png"> ' .
            '<a href="../modules/' . $this->name . '/readme/readme_' . $this->l('en') .
            '.pdf#page=14" target="_blank">' .
                $this->l('Read this page for more information') .
            '</a>';

        $out['help5'] =
            '<img src="../modules/' . $this->name . '/views/img/info.png"> ' .
            '<a href="../modules/' . $this->name . '/readme/readme_' . $this->l('en') .
            '.pdf#page=19" target="_blank">' .
                $this->l('FAQ: SEE THE COMMON ERRORS') .
            '</a>';

        $out['important'] = '';

        $lgcookieslaw_purposes = LGCookiesLawPurpose::getPurposes();

        $purpose_locked_modules = [];

        foreach ($lgcookieslaw_purposes as $lgcookieslaw_purpose) {
            $id_lgcookieslaw_purpose = (int)$lgcookieslaw_purpose['id_lgcookieslaw_purpose'];

            $lgcookieslaw_purpose_object =
                new LGCookiesLawPurpose((int)$id_lgcookieslaw_purpose);

            foreach (Language::getLanguages() as $lang) {
                $out['purpose_name_' . $id_lgcookieslaw_purpose][(int)$lang['id_lang']] =
                    $lgcookieslaw_purpose_object->name[(int)$lang['id_lang']];
                $out['purpose_description_' . $id_lgcookieslaw_purpose][(int)$lang['id_lang']] =
                    $lgcookieslaw_purpose_object->description[(int)$lang['id_lang']];
            }

            if ($id_lgcookieslaw_purpose != LGCookiesLawPurpose::FUNCTIONAL_PURPOSE) {
                $purpose_locked_modules[(int)$id_lgcookieslaw_purpose] =
                    Tools::jsonDecode($lgcookieslaw_purpose_object->locked_modules);
            }

            unset($lgcookieslaw_purpose_object);
        }

        unset($lgcookieslaw_purposes);

        $cookie_purposes = [
            LGCookiesLawPurpose::MARKETING_PURPOSE => $this->l('Marketing Purpose'),
            LGCookiesLawPurpose::ANALYTICS_PURPOSE => $this->l('Analytics Purpose'),
            LGCookiesLawPurpose::PERFORMANCE_PURPOSE => $this->l('Performance Purpose'),
            LGCookiesLawPurpose::OTHER_PURPOSE => $this->l('Other Purpose'),
        ];

        $this->context->smarty->assign([
            'purpose_locked_modules' => $purpose_locked_modules,
            'module_list' => $this->getModuleList(),
            'cookie_purposes' => $cookie_purposes,
        ]);

        $out['PS_BANNER_LIST'] = $this->context->smarty->fetch(
            _PS_MODULE_DIR_ . $this->name . DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'admin' .
            DIRECTORY_SEPARATOR . '_configure' . DIRECTORY_SEPARATOR . 'helpers' .
            DIRECTORY_SEPARATOR . 'form' . DIRECTORY_SEPARATOR . 'check_module_list.tpl'
        );

        return $out;
    }

    public function hookTop($params)
    {
        if (Configuration::get('PS_LGCOOKIES_HOOK') == 'top') {
            return $this->renderHook();
        }
    }

    public function hookdisplayMobileTop($params)
    {
        return $this->hookTop($params);
    }

    public function hookFooter($params)
    {
        if (Configuration::get('PS_LGCOOKIES_HOOK') == 'footer') {
            return $this->renderHook();
        }
    }

    public function hookDisplayFooterAfter($params)
    {
        return $this->hookFooter($params);
    }

    public function hookDisplayFooterBefore($params)
    {
        return $this->hookFooter($params);
    }

    public function renderHook()
    {
        if (!$this->showBanner()) {
            return;
        }

        $link = new Link();

        $id_lang = (int)$this->context->language->id;
        $id_shop = (int)$this->context->shop->id;

        $third_paries = Configuration::get('PS_LGCOOKIES_THIRD_PARTIES');
        $lgcookieslaw_purpose_analitycs = new LGCookiesLawPurpose((int)LGCookiesLawPurpose::ANALYTICS_PURPOSE);

        $enable_class_lggoogleanalytics_accept =
            (bool)$third_paries || (bool)$lgcookieslaw_purpose_analitycs->technical;

        unset($lgcookieslaw_purpose_analitycs);

        $this->context->smarty->assign([
            'cookie_message' => $this->getContentLang($this->context->cookie->id_lang, 'content'),
            'button1' => $this->getContentLang($this->context->cookie->id_lang, 'button1'),
            'button2' => $this->getContentLang($this->context->cookie->id_lang, 'button2'),
            'cms_link' => $link->getCMSLink(Configuration::get('PS_LGCOOKIES_CMS')),
            'cms_target' => Configuration::get('PS_LGCOOKIES_CMS_TARGET'),
            'target' => Configuration::get('PS_LGCOOKIES_CMS'),
            'hidden' => Configuration::get('PS_LGCOOKIES_HIDDEN'),
            'path_module' => _MODULE_DIR_ . $this->name,
            'third_paries' => $third_paries,
            'lgcookieslaw_position' => Configuration::get('PS_LGCOOKIES_POSITION'),
            'lgcookieslaw_show_reject_all_button' => Configuration::get('PS_LGCOOKIES_SHOW_REJECT_ALL_BTN'),
            'lgcookieslaw_purposes' => LGCookiesLawPurpose::getPurposes((int)$id_lang, (int)$id_shop, true),
            'lgcookieslaw_enable_lggoogleanalytics_accept' => (bool)$enable_class_lggoogleanalytics_accept,
        ]);

        if (Configuration::get('PS_LGCOOKIES_TESTMODE') == 1) {
            if (Configuration::get('PS_LGCOOKIES_IPTESTMODE') == $_SERVER['REMOTE_ADDR']) {
                return $this->display(__FILE__, 'views/templates/hook/cookieslaw.tpl');
            }
        } else {
            if (!$this->isBot($_SERVER['HTTP_USER_AGENT'])) {
                if (Tools::isSubmit('aceptocookies')) {
                    setcookie(
                        Configuration::get('PS_LGCOOKIES_NAME'),
                        '1',
                        time() + (int)Configuration::get('PS_LGCOOKIES_TIMELIFE'),
                        '/'
                    );

                    echo '<meta http-equiv="refresh" content="0; url=' . $_SERVER['REQUEST_URI'] . '" />';

                    die();
                }
                
                if (!isset($_COOKIE[Configuration::get('PS_LGCOOKIES_NAME')])) {
                    return $this->display(__FILE__, 'views/templates/hook/cookieslaw.tpl');
                }
            }
        }
    }

    public function showBanner()
    {
        $id_shop = $this->context->shop->id;
        $id_shop_group = Shop::getGroupFromShop((int)$id_shop);

        $configuration = Configuration::getMultiple(
            [
                'PS_LGCOOKIES_CMS',
                'PS_LGCOOKIES_CMS_SHOW_BANNER',
            ],
            null,
            (int)$id_shop_group,
            (int)$id_shop
        );

        // No se muestra si se encuentra en el CMS de Política de Cookies
        $result =
            !$configuration['PS_LGCOOKIES_CMS_SHOW_BANNER'] &&
            $this->context->controller instanceof CmsController &&
            (int)Tools::getValue('id_cms', 0) == $configuration['PS_LGCOOKIES_CMS'];

        return !$result;
    }

    public function hookBackOfficeHeader()
    {
        if ($this->context->controller instanceof AdminController
            && pSQL(Tools::getValue('configure')) == $this->name
        ) {
            $this->context->controller->addCSS($this->_path . '/views/css/publi/lgpubli.css');
        }
    }

    public function hookDisplayHeader($params)
    {
        if (!$this->showBanner()) {
            return;
        }

        $this->context->controller->addJqueryPlugin('fancybox');

        $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/front.css');
        $this->context->controller->addCSS(_MODULE_DIR_ . $this->name . '/views/css/lgcookieslaw.css');
        $this->context->controller->addJS(_MODULE_DIR_ . $this->name . '/views/js/front.js');

        if (version_compare(_PS_VERSION_, '1.6.1.0', '>=')) {
            Media::addJsDef(array(
                'lgcookieslaw_cookie_name' => Configuration::get('PS_LGCOOKIES_NAME'),
                'lgcookieslaw_session_time' => Configuration::get('PS_LGCOOKIES_TIMELIFE'),
                'lgcookieslaw_reload' => (int)Configuration::get('PS_LGCOOKIES_RELOAD') == 1 ? true : false,
                'lgcookieslaw_block' => (int)Configuration::get('PS_LGCOOKIES_BLOCK') == 1 ? true : false,
                'lgcookieslaw_position'=> Configuration::get('PS_LGCOOKIES_POSITION'),
            ));
        } else {
            $this->context->smarty->assign(array(
                'lgcookieslaw_cookie_name' => Configuration::get('PS_LGCOOKIES_NAME'),
                'lgcookieslaw_session_time' => Configuration::get('PS_LGCOOKIES_TIMELIFE'),
                'lgcookieslaw_reload' => Configuration::get('PS_LGCOOKIES_RELOAD'),
                'lgcookieslaw_block' => Configuration::get('PS_LGCOOKIES_BLOCK'),
                'lgcookieslaw_position' => Configuration::get('PS_LGCOOKIES_POSITION'),
            ));

            return $this->context->smarty->fetch(
                _PS_MODULE_DIR_ . $this->name .
                DIRECTORY_SEPARATOR . 'views' .
                DIRECTORY_SEPARATOR . 'templates' .
                DIRECTORY_SEPARATOR . 'front' .
                DIRECTORY_SEPARATOR . 'javascript.tpl'
            );
        }
    }

    public function hookDisplayCustomerAccount($params)
    {
        if (Configuration::get('PS_LGCOOKIES_DISALLOW')) {
            $version = '15';

            if (version_compare(_PS_VERSION_, '1.6.0', '>=') && version_compare(_PS_VERSION_, '1.7.0', '<')) {
                $version = '16';
            } elseif (version_compare(_PS_VERSION_, '1.7.0', '>=')) {
                $version = '17';
            }

            $lgcookieslaw_image_path = $this->getPathUri();
            $lgcookieslaw_disallow_url = $this->context->link->getModuleLink(
                $this->name,
                'disallow',
                [
                    'token' => md5(_COOKIE_KEY_ . $this->name),
                ],
                true
            );

            $this->context->smarty->assign([
                'lgcookieslaw_disallow_url' => $lgcookieslaw_disallow_url,
                'lgcookieslaw_image_path'   => $lgcookieslaw_image_path .
                    '/views/img/account_button_icon_' . $version . '.png',
            ]);

            return $this->display(__FILE__, 'views/templates/front/account_button_' . $version . '.tpl');
        }
    }
}
