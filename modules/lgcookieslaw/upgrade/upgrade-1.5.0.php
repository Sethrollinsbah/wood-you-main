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

function upgrade_module_1_5_0($module)
{
    $query = '
        CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LGCookiesLawPurpose::$definition['table'] . '` (
            `' . LGCookiesLawPurpose::$definition['primary'] . '` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `id_shop` int(11) unsigned NOT NULL,
            `technical` tinyint(1) UNSIGNED NOT NULL DEFAULT \'0\',
            `locked_modules` text NOT NULL DEFAULT \'\',
            `js_code` text NULL,
            `active` tinyint(1) UNSIGNED NOT NULL DEFAULT \'1\',
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`' . LGCookiesLawPurpose::$definition['primary'] . '`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LGCookiesLawPurpose::$definition['table'] . '_lang` (
            `' . LGCookiesLawPurpose::$definition['primary'] . '` int(11) unsigned NOT NULL,
            `id_lang` int(11) NOT NULL,
            `name` varchar(64) NOT NULL,
            `description` text NULL,
            PRIMARY KEY (`' . LGCookiesLawPurpose::$definition['primary'] . '`,`id_lang`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LGCookiesLawCookie::$definition['table'] . '` (
            `' . LGCookiesLawCookie::$definition['primary'] . '` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `id_shop` int(11) unsigned NOT NULL,
            `' . LGCookiesLawPurpose::$definition['primary'] . '` int(11) unsigned NOT NULL,
            `name` varchar(64) NOT NULL,
            `provider` TEXT NULL,
            `provider_url` TEXT NULL,
            `active` tinyint(1) UNSIGNED NOT NULL DEFAULT \'1\',
            `date_add` datetime NOT NULL,
            `date_upd` datetime NOT NULL,
            PRIMARY KEY (`' . LGCookiesLawCookie::$definition['primary'] . '`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LGCookiesLawCookie::$definition['table'] . '_lang` (
            `' . LGCookiesLawCookie::$definition['primary'] . '` int(11) unsigned NOT NULL,
            `id_lang` int(11) NOT NULL,
            `cookie_purpose` text NULL,
            `expiry_time` text NULL,
            PRIMARY KEY (`' . LGCookiesLawCookie::$definition['primary'] . '`,`id_lang`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;

        DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'lgcookieslaw`;
    ';

    Db::getInstance()->execute($query);

    $module->installationDefaults();

    if ($module->uninstallOverrides()) {
        $module->installOverrides();
    }

    $module->saveCss();

    return true;
}
