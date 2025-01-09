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

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LggoogleanalyticsEvent::$definition['table'] . '` (
    `' . LggoogleanalyticsEvent::$definition['primary'] . '` int(11) NOT NULL AUTO_INCREMENT,
	`event` varchar(128) NOT NULL,
	`event_id` int(11) NOT NULL,
	`params` TEXT NOT NULL, 
	`date_add` datetime NOT NULL,
    PRIMARY KEY  (`' . LggoogleanalyticsEvent::$definition['primary'] . '`,`event`,`event_id`),
    INDEX `date_add` (`date_add`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . LggoogleanalyticsLog::$definition['table'] . '` (
	`' . LggoogleanalyticsLog::$definition['primary'] . '` int(11) NOT NULL AUTO_INCREMENT,
    `controller` varchar(128) NOT NULL,
    `event` varchar(128) NOT NULL,
    `params` text NOT NULL,
	`date_add` datetime NOT NULL,
    PRIMARY KEY  (`' . LggoogleanalyticsLog::$definition['primary'] . '`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    Db::getInstance()->execute($query);
}
