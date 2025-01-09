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

class LggoogleanalyticsEvent extends ObjectModel
{

    public static $definition = array(
        'table' => 'lggoogleanalytics_events',
        'primary' => 'id_lggoogleanalytics_events',
        'fields' => array(
            'event' => array('type' => self::TYPE_STRING, 'required' => true),
            'event_id' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        ),
    );

    public static function exists($event = null, $event_id = null)
    {
        if (!empty($event) && !empty($event_id)) {
            $sql = 'SELECT 1 FROM `' . _DB_PREFIX_ . self::$definition['table'] . '`
                WHERE `event` = "' . pSQL($event) . '" AND `event_id` = ' . (int) $event_id;
            return Db::getInstance()->getValue($sql);
        }
        return false;
    }

    public static function register($event = null, $event_id = null, $params = array())
    {
        if (Configuration::get('LGGOOGLEANALYTICS_LOGGING') || $event=='Purchase') {
            $sql = 'DELETE FROM `' . _DB_PREFIX_ . self::$definition['table'] . '` WHERE 
                date_add < CURRENT_DATE() - INTERVAL 1 DAY AND `event`!="Purchase"';
            Db::getInstance()->execute($sql);

            if (!empty($event) && ($event != 'Purchase' || !empty($event_id))) {
                $sql = 'INSERT IGNORE INTO `' . _DB_PREFIX_ . self::$definition['table'] . '`
                (
                    `event`,
                    `event_id`,
                    `params`,
                    `date_add`
                ) VALUES (
                    "' . pSQL($event) . '",
                    ' . (int)$event_id . ',
                    "' . pSQL(json_encode($params)) . '",
                    NOW()
                )';

                return Db::getInstance()->execute($sql);
            }
            return false;
        }
        return false;
    }

    public static function getlist($limit = 25)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . self::$definition['table'] . '`
            WHERE true
            ORDER BY date_add DESC
            LIMIT 0,'.$limit;
        return Db::getInstance()->executeS($sql);
    }
}
