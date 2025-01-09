<?php
/**
 * 2007-2013 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2013 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

class Hook extends HookCore
{
    public static function getHookModuleExecList($hook_name = null)
    {

        $context = Context::getContext();
        $cache_id  = 'hook_module_exec_list_';
        $cache_id .= isset($context->shop->id) ? '_'.$context->shop->id : '';
        $cache_id .= isset($context->customer) ? '_'.$context->customer->id : '';
        if (!Cache::isStored($cache_id) || $hook_name == 'displayPayment') {
            $frontend = true;
            $groups = array();
            if (isset($context->employee)) {
                $shop_list = array((int)$context->shop->id);
                $frontend = false;
            } else {
                // Get shops and groups list
                $shop_list = Shop::getContextListShopID();
                if (isset($context->customer) && $context->customer->isLogged()) {
                    $groups = $context->customer->getGroups();
                } elseif (isset($context->customer) && $context->customer->isLogged(true)) {
                    $groups = array((int)Configuration::get('PS_GUEST_GROUP'));
                } else {
                    $groups = array((int)Configuration::get('PS_UNIDENTIFIED_GROUP'));
                }
            }

            $cookieslaw = null;

            if (Module::isInstalled('lgcookieslaw') && Module::isEnabled('lgcookieslaw') && $frontend) {
                include_once(_PS_MODULE_DIR_ . 'lgcookieslaw/lgcookieslaw.php');

                $lgcookies_name = Configuration::get('PS_LGCOOKIES_NAME');

                $lgcookieslaw_enabled_purposes = !empty($_COOKIE[$lgcookies_name]) ?
                    $_COOKIE[$lgcookies_name] : null;

                $lgcookieslaw_purposes_locked_modules =
                    LGCookiesLawPurpose::getLockedModules($lgcookieslaw_enabled_purposes);

                if (!empty($lgcookieslaw_purposes_locked_modules)) {
                    $modules = [];

                    foreach ($lgcookieslaw_purposes_locked_modules as $lgcookieslaw_purpose_locked_modules) {
                        $locked_modules =
                            Tools::jsonDecode($lgcookieslaw_purpose_locked_modules['locked_modules']);

                        $modules = array_unique(
                            array_merge($modules, $locked_modules)
                        );
                    }

                    $cookieslaw = $modules;

                    unset($modules);
                }
            }

            // SQL Request
            $sql = new DbQuery();
            $sql->select('h.`name` as hook, m.`id_module`, h.`id_hook`, m.`name` as module, h.`live_edit`');
            $sql->from('module', 'm');
            if ($hook_name != 'displayBackOfficeHeader') {
                $sql->join(
                    Shop::addSqlAssociation(
                        'module',
                        'm',
                        true,
                        'module_shop.enable_device & '.(int)Context::getContext()->getDevice()
                    )
                );
                $sql->innerJoin('module_shop', 'ms', 'ms.`id_module` = m.`id_module`');
            }
            $sql->innerJoin('hook_module', 'hm', 'hm.`id_module` = m.`id_module`');
            $sql->innerJoin('hook', 'h', 'hm.`id_hook` = h.`id_hook`');
            $sql->where(
                '(SELECT COUNT(*) '.
                'FROM '._DB_PREFIX_.'module_shop ms '.
                'WHERE ms.id_module = m.id_module'.
                ' AND ms.id_shop IN ('.implode(', ', $shop_list).')) = '.count($shop_list)
            );
            if ($hook_name != 'displayPayment') {
                $sql->where('h.name != "displayPayment"');
            } elseif ($frontend) { // For payment modules, we check that they are available in the contextual country
                $sql->where(Module::getPaypalIgnore());
                if (Validate::isLoadedObject($context->country)) {
                    $sql->where(
                        '(h.name = "displayPayment" AND ('.
                        'SELECT id_country '.
                        'FROM '._DB_PREFIX_.'module_country mc '.
                        'WHERE mc.id_module = m.id_module'.
                        ' AND id_country = '.(int)$context->country->id.
                        ' AND id_shop = '.(int)$context->shop->id.
                        ' LIMIT 1) = '.(int)$context->country->id.')'
                    );
                }
                if (Validate::isLoadedObject($context->currency)) {
                    $sql->where(
                        '(h.name = "displayPayment" AND ('.
                        'SELECT id_currency '.
                        'FROM '._DB_PREFIX_.'module_currency mcr '.
                        'WHERE mcr.id_module = m.id_module'.
                        ' AND id_currency IN ('.(int)$context->currency->id.', -1, -2)'.
                        ' LIMIT 1) IN ('.(int)$context->currency->id.', -1, -2))'
                    );
                }
            }
            if (Validate::isLoadedObject($context->shop)) {
                $sql->where('hm.id_shop = '.(int)$context->shop->id);
            }

            if ($frontend) {
                $sql->leftJoin('module_group', 'mg', 'mg.`id_module` = m.`id_module`');
                $sql->where('mg.`id_group` IN ('.implode(', ', $groups).')');
                $sql->groupBy('hm.id_hook, hm.id_module');
            }

            $sql->orderBy('hm.`position`');

            $list = array();
            if ($result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql)) {
                foreach ($result as $row) {
                    $row['hook'] = Tools::strtolower($row['hook']);
                    if (!isset($list[$row['hook']])) {
                        $list[$row['hook']] = array();
                    }
                    // lgcookieslaw START

                    if (Module::isInstalled('lgcookieslaw') && Module::isEnabled('lgcookieslaw')) {
                        $cms_page =
                            Tools::getValue('controller') == 'cms' &&
                            Tools::getValue('id_cms', 0) == (int)Configuration::get('PS_LGCOOKIES_CMS');

                        if (!Configuration::get('PS_LGCOOKIES_TESTMODE') == 1 || $cms_page) {
                            $lgcookies_name = Configuration::get('PS_LGCOOKIES_NAME');

                            if (!isset($_COOKIE[$lgcookies_name]) ||
                                empty($_COOKIE[$lgcookies_name]) ||
                                !$cms_page ||
                                strpos($_SERVER['REQUEST_URI'], 'disallow') !== false
                            ) {
                                if (!isset($cookieslaw)
                                    || is_null($cookieslaw)
                                    || empty($cookieslaw)
                                    || !in_array($row['module'], $cookieslaw)
                                ) {
                                    $list[$row['hook']][] = array(
                                        'id_hook' => $row['id_hook'],
                                        'module' => $row['module'],
                                        'id_module' => $row['id_module'],
                                        'live_edit' => $row['live_edit'],
                                    );
                                }
                            } else {
                                $list[$row['hook']][] = array(
                                    'id_hook' => $row['id_hook'],
                                    'module' => $row['module'],
                                    'id_module' => $row['id_module'],
                                    'live_edit' => $row['live_edit'],
                                );
                            }
                        } else {
                            $list[$row['hook']][] = array(
                                'id_hook' => $row['id_hook'],
                                'module' => $row['module'],
                                'id_module' => $row['id_module'],
                                'live_edit' => $row['live_edit'],
                            );
                        }
                    } else {
                        $list[$row['hook']][] = array(
                            'id_hook' => $row['id_hook'],
                            'module' => $row['module'],
                            'id_module' => $row['id_module'],
                            'live_edit' => $row['live_edit'],
                        );
                    }
                    // lgcookieslaw END
                }
            }
            if ($hook_name != 'displayPayment') {
                Cache::store($cache_id, $list);
                // @todo remove this in 1.6, we keep it in 1.5 for retrocompatibility
                self::$_hook_modules_cache_exec = $list;
            }
        } else {
            $list = Cache::retrieve($cache_id);
        }

        // If hook_name is given, just get list of modules for this hook
        if ($hook_name) {
            $retro_hook_name = Hook::getRetroHookName($hook_name);
            $hook_name = Tools::strtolower($hook_name);

            $return = array();
            $inserted_modules = array();
            if (isset($list[$hook_name])) {
                $return = $list[$hook_name];
            }
            foreach ($return as $module) {
                $inserted_modules[] = $module['id_module'];
            }
            if (isset($list[$retro_hook_name])) {
                foreach ($list[$retro_hook_name] as $retro_module_call) {
                    if (!in_array($retro_module_call['id_module'], $inserted_modules)) {
                        $return[] = $retro_module_call;
                    }
                }
            }

            return (count($return) > 0 ? $return : false);
        } else {
            return $list;
        }
    }
}
