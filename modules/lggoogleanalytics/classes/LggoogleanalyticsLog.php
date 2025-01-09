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

class LggoogleanalyticsLog extends ObjectModel
{

    public static $definition = array(
        'table' => 'lggoogleanalytics_log',
        'primary' => 'id_lggoogleanalytics_log',
        'fields' => array(
            'controller' => array('type' => self::TYPE_STRING, 'required' => true),
            'event' => array('type' => self::TYPE_STRING, 'required' => true),
            'params' => array('type' => self::TYPE_STRING, 'required' => true),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        ),
    );

    public static function register($controller = null, $event = null, $params = array())
    {
        if (Configuration::get('LGGOOGLEANALYTICS_LOGGING')) {
            $sql =
                'DELETE FROM `' .
                _DB_PREFIX_ . self::$definition['table'] .
                '` WHERE date_add < CURRENT_DATE() - INTERVAL 1 DAY';

            Db::getInstance()->execute($sql);

            if (!empty($controller) && !empty($params)) {
                if ($controller != 'pagenotfound') {
                    $sql = 'INSERT INTO `' . _DB_PREFIX_ . self::$definition['table'] . '`
                (
                    `controller`,
                    `event`, 
                    `params`,
                    `date_add`
                )
                VALUES (
                    "' . pSQL($controller) . '",
                    "' . pSQL($event) . '",
                    "' . pSQL(json_encode($params)) . '",
                    NOW()
                )';
                    return Db::getInstance()->execute($sql);
                }
            }
            return false;
        }
        return false;
    }

    public static function getlist($assign = true, $limit = 25)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . self::$definition['table'] . '`
            WHERE';
        if ($assign) {
            $sql .= ' event NOT LIKE ""';
        } else {
            $sql .= ' event LIKE ""';
        }
        $sql .= ' 
            ORDER BY date_add DESC
            LIMIT 0,'.$limit;
        return Db::getInstance()->executeS($sql);
    }
}
