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

$query = '
    DROP TABLE IF EXISTS `' . _DB_PREFIX_ . LGCookiesLawPurpose::$definition['table'] . '`;
    DROP TABLE IF EXISTS `' . _DB_PREFIX_ . LGCookiesLawPurpose::$definition['table'] . '_lang`;
    DROP TABLE IF EXISTS `' . _DB_PREFIX_ . LGCookiesLawCookie::$definition['table'] . '`;
    DROP TABLE IF EXISTS `' . _DB_PREFIX_ . LGCookiesLawCookie::$definition['table'] . '_lang`;

    DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'lgcookieslaw_lang`;
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
