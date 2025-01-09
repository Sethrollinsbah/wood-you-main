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

$sql = [];

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lgcookieslaw_lang` (
    `id_lang` int(11) NOT NULL,
    `button1` text NOT NULL,
    `button2` text NOT NULL,
    `content` text NOT NULL,
    UNIQUE KEY `id_lang` (`id_lang`)
    ) ENGINE='.(defined('ENGINE_TYPE') ? ENGINE_TYPE : 'Innodb').' CHARSET=utf8';

// main langs, english by default
$languages = Language::getLanguages();

foreach ($languages as $language) {
    switch ($language['iso_code']) {
        case 'en':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('I accept') . '",
                "' . pSQL('More information') . '",
                "' . pSQL(
                    'This website uses its own and third-party cookies to improve our services and show you advertising 
                    related to your preferences by analyzing your browsing habits. To give your consent to its use, 
                    press the Accept button.',
                    'html'
                ) . '"
                )';
            break;

        case 'es':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('Acepto') . '",
                "' . pSQL('Más información') . '",
                "' . pSQL(
                    'Este sitio web utiliza cookies propias y de terceros para mejorar nuestros servicios 
                    y mostrarle publicidad relacionada con sus preferencias mediante el análisis de sus hábitos 
                    de navegación. Para dar su consentimiento sobre su uso pulse el botón Acepto.',
                    'html'
                ) . '"
                )';
            break;

        case 'fr':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('J\'accepte') . '",
                "' . pSQL('Plus d\'informations') . '",
                "' . pSQL(
                    'Ce site Web utilise ses propres cookies et ceux de tiers pour 
                    améliorer nos services et vous montrer des publicités liées à vos 
                    préférences en analysant vos habitudes de navigation. 
                    Pour donner votre consentement à son utilisation, appuyez sur le bouton Accepter.',
                    'html'
                ) . '"
                )';
            break;

        case 'it':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('Accetto') . '",
                "' . pSQL('Piú info') . '",
                "' . pSQL(
                    'Questo sito web utilizza cookie propri e di terze parti per migliorare i 
                    nostri servizi e mostrarti pubblicità relativa alle tue preferenze analizzando 
                    le tue abitudini di navigazione. Per dare il tuo consenso al suo utilizzo, 
                    premi il pulsante Accetta.',
                    'html'
                ) . '"
                )';
            break;

        case 'de':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('Ich akzeptiere') . '",
                "' . pSQL('Weitere Informationen') . '",
                "' . pSQL(
                    'Diese Website verwendet eigene Cookies und Cookies von Drittanbietern, um unsere Dienste zu 
                    verbessern. Und zeigen Sie Werbung in Bezug auf Ihre Vorlieben, indem Sie Ihre Gewohnheiten 
                    analysieren navigation. Um Ihre Zustimmung zu seiner Verwendung zu geben, klicken Sie auf die 
                    Schaltfläche Akzeptieren.',
                    'html'
                ) . '"
                )';
            break;

        case 'pt':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('Aceito') . '",
                "' . pSQL('Mais informações') . '",
                "' . pSQL(
                    'Este site usa cookies próprios e de terceiros para melhorar nossos serviços 
                    e mostrar a publicidade relacionada às suas preferências, analisando seus hábitos 
                    navegação. Para dar seu consentimento ao seu uso, pressione o botão Aceito.',
                    'html'
                ) . '"
                )';
            break;

        case 'pl':
            $sql[] = 'INSERT INTO `' . _DB_PREFIX_ . 'lgcookieslaw_lang` VALUES (' .
                (int)$language['id_lang'] . ',
                "' . pSQL('Akceptuję') . '",
                "' . pSQL('Więcej informacji') . '",
                "' . pSQL(
                    'Ta witryna korzysta z własnych plików cookie i plików cookie stron trzecich w celu ulepszenia 
                    naszych usług i pokazywać Ci reklamy związane z Twoimi preferencjami, analizując Twoje nawyki 
                    nawigacja. Aby wyrazić zgodę na jego użycie, naciśnij przycisk Akceptuj.',
                    'html'
                ) . '"
                )';
            break;
    }
}

foreach ($sql as $q) {
    Db::getInstance()->Execute($q);
}

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
';

if (!empty($query)) {
    Db::getInstance()->execute('START TRANSACTION');

    if (!Db::getInstance()->execute($query)) {
        Db::getInstance()->execute('ROLLBACK');

        return false;
    }

    Db::getInstance()->execute('COMMIT');
}

return true;
