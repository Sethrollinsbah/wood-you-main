<?php
/**
 * GIFT CARD
 *
 *    @author    EIRL Timactive De Véra
 *    @copyright Copyright (c) TIMACTIVE 2015 -EIRL Timactive De Véra
 *    @license   Commercial license
 *    @category pricing_promotion
 *    @version 1.1.0
 *
 *************************************
 **         GIFT CARD                *
 **          V 1.0.0                 *
 *************************************
 * +
 * + Languages: EN, FR, ES
 * + PS version: 1.5,1.6,1.7
 */

$sql = array();
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardproduct`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardorder`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardtemplate`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardtemplate_shop`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardtemplate_lang`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardtag`;';
$sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'giftcardtemplate_tag`;';
