<?php
/**
 * Copyright 2022 LÍNEA GRÁFICA E.C.E S.L.
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * This function updates your module from previous versions to the version 1.1,
 * usefull when you modify your database, or register a new hook ...
 * Don't forget to create one file per version.
 */
function upgrade_module_1_1_5()
{
    Configuration::deleteByName('LGGOOGLEANALYTICS_CONSENT');
    Configuration::deleteByName('LGGOOGLEANALYTICS_COOKIE');
    Configuration::deleteByName('LGGOOGLEANALYTICS_BUTTON_ID');
    Configuration::deleteByName('LGGOOGLEANALYTICS_BUTTON_CLASS');

    $sql = [];

    $sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'lggoogleanalytics_consent`;';

    foreach ($sql as $query) {
        if (Db::getInstance()->execute($query) == false) {
            return false;
        }
    }

    return true;
}
