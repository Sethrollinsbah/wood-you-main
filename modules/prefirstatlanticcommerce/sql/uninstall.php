<?php
/**
 *  2014-2020 Prestashoppe
 *
 *  @author    Prestashoppe
 *  @copyright 2014-2020 Prestashoppe
 *  @license   Prestashoppe Commercial License
 */

$sql = array();

$sql[] = 'DROP TABLE `'._DB_PREFIX_.'prefac_order`';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
