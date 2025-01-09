<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'prefac_order` (
    `id_prefac_order` int(11) NOT NULL AUTO_INCREMENT,
    `id_order` INT( 11 ) UNSIGNED,
    `order_number` TEXT NULL,
    `reference_number` TEXT NULL,
    `padded_card_no` TEXT NULL,
    `auth_code` TEXT NULL,
    `cavvv_value` TEXT NULL,
    `eci_indicator` TEXT NULL,
    `transaction_stain` TEXT NULL,
    PRIMARY KEY  (`id_prefac_order`)
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
