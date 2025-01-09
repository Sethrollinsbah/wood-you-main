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
function upgrade_module_1_1_0()
{
    $sql = array();

    if (!Db::getInstance()->executeS('SHOW TABLES LIKE 
            \'' . _DB_PREFIX_ . LggoogleanalyticsLog::$definition['table'] .'\'')) {
        $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LggoogleanalyticsLog::$definition['table'].'` (
            `' . LggoogleanalyticsEvent::$definition['primary'] . '` int(11) NOT NULL AUTO_INCREMENT,
            `controller` varchar(128) NOT NULL,
            `event` varchar(128) NOT NULL,
            `params` text NOT NULL,
            `date_add` datetime NOT NULL,
            PRIMARY KEY  (`' . LggoogleanalyticsEvent::$definition['primary'] . '`)
        ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';
    }

    if (!Db::getInstance()->ExecuteS(
        "SHOW COLUMNS FROM `" . _DB_PREFIX_ . LggoogleanalyticsEvent::$definition['table'] . "` LIKE 'params'"
    )) {
        $sql[] = 'ALTER TABLE `' . _DB_PREFIX_ . LggoogleanalyticsEvent::$definition['table'] . '`  
            ADD COLUMN `params` TEXT NOT NULL AFTER `event_id`';
    }

    foreach ($sql as $query) {
        Db::getInstance()->execute($query);
    }

    return true;
}
