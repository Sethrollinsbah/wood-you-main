<?php
/**
 * 2007-2014 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 Chimon Sultan
 * @license   All right reserved
 */

/**
 * Class ContactBoxPlusModel
 */
class ContactBoxPlusModel extends ObjectModel
{
    const LEFT_COLUMN = 0;
    const RIGHT_COLUMN = 1;
    const FOOTER = 2;
    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'cbp_field',
        'primary' => 'id_cbp_field',
        'multilang' => true,
        'fields' => array(
            'id_cbp_field' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'validation' => array('type' => self::TYPE_STRING),
            'type' => array('type' => self::TYPE_STRING),
            'position' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'width' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt', 'required' => true),
            'enabled' => array('type' => self::TYPE_BOOL, 'validate' => 'isUnsignedInt', 'required' => true),
            'iscustomername' => array('type' => self::TYPE_BOOL, 'validate' => 'isUnsignedInt', 'required' => true),
            'iscustomeremail' => array('type' => self::TYPE_BOOL, 'validate' => 'isUnsignedInt', 'required' => true),
            'displaydatehint' => array('type' => self::TYPE_BOOL, 'validate' => 'isUnsignedInt'),
            'maximaldate' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'minimaldate' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'allowedextensions' => array('type' => self::TYPE_STRING),
            // Language fields
            'label' =>
                array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 50),
            'description' =>
                array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 255)
        )
    );
    public $idField;
    public $id_cms_category;
    public $location;
    public $position;
    public $display_store;

    public static function createTables()
    {
        return (
            ContactBoxPlusModel::createCBPFieldsTable() &&
            ContactBoxPlusModel::createCBPFieldsLangTable()
        );
    }

    public static function createCBPFieldsTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'cbp_field`(
			`id_cbp_field` int(10) unsigned NOT NULL auto_increment,
    		`validation` varchar(255) NOT NULL,
			`type` varchar(255) NOT NULL,
			`position` int(10) unsigned NOT NULL default 0,
			`width` int(10) unsigned NOT NULL default 12,
    		`enabled` bool NOT NULL DEFAULT 1,
    		`iscustomername` bool NOT NULL DEFAULT 0,
    		`iscustomeremail` bool NOT NULL DEFAULT 0,
    		`required` bool NOT NULL DEFAULT 0,
    		`displaydatehint` bool NOT NULL DEFAULT 0,
    		`minimaldate` date,
    		`maximaldate` date,
        `allowedextensions` varchar(500) DEFAULT NULL,
			PRIMARY KEY (`id_cbp_field`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';

        return Db::getInstance()->execute($sql);
    }

    public static function createCBPFieldsLangTable()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'cbp_field_lang`(
			`id_cbp_field` int(10) unsigned NOT NULL,
			`id_lang` int(10) unsigned NOT NULL,
			`label` varchar(60) NOT NULL default \'\',
        	`description` varchar(255) NOT NULL default \'\',
        	`options` varchar(2000) NOT NULL default \'\',
			PRIMARY KEY (`id_cbp_field`, `id_lang`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';

        return Db::getInstance()->execute($sql);
    }

    public static function dropTables()
    {
        $sql = 'DROP TABLE IF EXISTS
			`'._DB_PREFIX_.'cbp_field`,
			`'._DB_PREFIX_.'cbp_field_lang`';

        return Db::getInstance()->execute($sql);
    }

    public static function insertCBPField(
        $type,
        $validation,
        $position,
        $enabled,
        $required,
        $width,
        $iscustomername,
        $iscustomeremail,
        $minimaldate = null,
        $maximaldate = null,
        $displaydatehint = 0,
        $allowedextensions = null
    ) {

        $sql = 'INSERT INTO `'._DB_PREFIX_.'cbp_field` (`validation`,
          `type`, `position`, `enabled`, `required`, `width`,
          `iscustomername`, `iscustomeremail` ';

        if ("date" === $type) {
            $sql .= ", `minimaldate`";
            $sql .= ", `maximaldate`";
            $sql .= ", `displaydatehint`";
        }

        $sql .= ', `allowedextensions` )
        VALUES("'.$validation.'", "'.$type.'"
			, '.$position.', '.(int)$enabled.',
			'.(int)$required.', '.(int)$width.',
			'.(int)$iscustomername.', '.(int)$iscustomeremail;

        if ("date" === $type) {
            $sql .= ', "'.$minimaldate.'" ';
            $sql .= ', "'.$maximaldate.'" ';
            $sql .= ', "'.(int)$displaydatehint.'" ';
        }

        $sql .=', "'.$allowedextensions.'"  )';

        if (Db::getInstance()->execute($sql)) {
            return Db::getInstance()->Insert_ID();
        }

        return false;
    }

    public static function insertCBPFieldLang($id_cbp_field, $id_lang, $label, $description, $options)
    {
        //$label = pSQL(Tools::getValue('label_'.$id_lang));
        //$description = pSQL(Tools::getValue('description_'.$id_lang));
        $sql = 'INSERT INTO `'._DB_PREFIX_.'cbp_field_lang` (
		`id_cbp_field`, `id_lang`, `label`, `description`, `options`)
			VALUES('.(int)$id_cbp_field.', '.(int)$id_lang.',
			 "'.$label.'", "'.$description.'", "'.$options.'")';
        if (Db::getInstance()->execute($sql)) {
            return true;
        }

        return false;//Db::getInstance()->Insert_ID();
    }


    public static function updateCBPField(
        $id_cbp_field,
        $type,
        $validation,
        $position,
        $enabled,
        $required,
        $width,
        $iscustomername,
        $iscustomeremail,
        $minimaldate = null,
        $maximaldate = null,
        $displaydatehint = 0,
        $allowedextensions = null
    ) {
        $sql = 'UPDATE `'._DB_PREFIX_.'cbp_field`
			SET `type` = "'.pSQL($type).'",
			`validation` = "'.pSQL($validation).'",

			`enabled` = '.(int)$enabled.',
			`width` = '.(int)$width.',
			`iscustomername` = '.(int)$iscustomername.',
			`iscustomeremail` = '.(int)$iscustomeremail.',
			`required` = '.(int)$required;

        if ("date" === $type) {
              $sql .= ', `minimaldate` = "'.$minimaldate.'" ';
              $sql .= ', `maximaldate` = "'.$maximaldate.'" ';
              $sql .= ', `displaydatehint` = "'.(int)$displaydatehint.'" ';
        }
        $sql .= ', `allowedextensions` = "'.pSQL($allowedextensions).'"
            WHERE `id_cbp_field` = '.(int)$id_cbp_field;

        return Db::getInstance()->execute($sql);
    }

    public static function updateCBPFieldLang(
        $id_cbp_field,
        $field_label,
        $field_description,
        $id_lang,
        $options
    ) {
        $sql = 'UPDATE `'._DB_PREFIX_.'cbp_field_lang`
			SET `label` = "'.pSQL($field_label).'",
			 `description` = "'.pSQL($field_description).'",
			 `options`= "'.pSQL($options).'"
			WHERE `id_cbp_field` = '.(int)$id_cbp_field.'
			AND `id_lang`= '.(int)$id_lang;
        return Db::getInstance()->execute($sql);
    }

    public static function updateCBPFieldPositions(
        $id_cbp_field,
        $position,
        $new_position,
        $location
    ) {
        $query = 'UPDATE `'._DB_PREFIX_.'cbp_field`
			SET `position` = '.(int)$new_position.'
			WHERE `position` = '.(int)$position;

        $sub_query = 'UPDATE `'._DB_PREFIX_.'cbp_field`
			SET `position` = '.(int)$position.'
			WHERE `id_cbp_field` = '.(int)$id_cbp_field;

        if (Db::getInstance()->execute($query)) {
            Db::getInstance()->execute($sub_query);
        }
    }

    public static function updateCBPFieldPosition($id_cbp_field, $position)
    {
        $query = 'UPDATE `'._DB_PREFIX_.'cbp_field`
			SET `position` = '.(int)$position.'
			WHERE `id_cbp_field` = '.(int)$id_cbp_field;

        Db::getInstance()->execute($query);
    }


    public static function deleteCBPField($id_cbp_field)
    {
        $sql = 'DELETE FROM `'._DB_PREFIX_.'cbp_field`
				WHERE `id_cbp_field` = '.(int)$id_cbp_field;

        Db::getInstance()->execute($sql);
    }

    public static function deleteCBPFieldLang($id_cbp_field)
    {
        $sql = 'DELETE FROM `'._DB_PREFIX_.'cbp_field`
				WHERE `id_cbp_field` = '.(int)$id_cbp_field;

        Db::getInstance()->execute($sql);
    }


    /* Get a single CMS block by its ID */
    public static function getField($id_cbp_field)
    {
        $sql = 'SELECT bc.`id_cbp_field`,bc.`iscustomeremail`,
		bc.`iscustomername`, bcl.`label` label, bcl.`description` description,
		bc.`position`, bc.`width`, bc.`enabled`, bc.`required`, bc.`type`,
		bcl.`options` options, bc.`validation`, bcl.`id_lang`,
    bc.`minimaldate`, bc.`maximaldate`, bc.`displaydatehint`, bc.`allowedextensions`
			FROM `'._DB_PREFIX_.'cbp_field` bc
			INNER JOIN `'._DB_PREFIX_.'cbp_field_lang` bcl
			ON (bc.`id_cbp_field` = bcl.`id_cbp_field`)
			AND bc.`id_cbp_field` = '.(int)$id_cbp_field;
        $CBPFields = Db::getInstance()->executeS($sql);
        //ddd($sql);
        $results = array();
        foreach ($CBPFields as $CBPField) {
            $results[(int)$CBPField['id_lang']] = $CBPField;
            $results[(int)$CBPField['id_lang']]['label'] = $CBPField['label'];
            $results[(int)$CBPField['id_lang']]['description'] = $CBPField['description'];
            $results[(int)$CBPField['id_lang']]['options'] = $CBPField['options'];
        }
        return $results;
    }

    public static function getCategoriesId()
    {
         $sql = 'SELECT bc.`id_category`
			FROM `'._DB_PREFIX_.'category` bc';
        return Db::getInstance()->executeS($sql);
    }



    public static function getMaxPosition()
    {
        $sql = 'SELECT COUNT(*)
			FROM `'._DB_PREFIX_.'cbp_field`';

        return Db::getInstance()->getValue($sql);
    }

    /* Get all CMS blocks */
    public static function getCBPFields($onlyEnabled = false)
    {
        $onlyEnabledSql = $onlyEnabled == true ? " AND bc.`enabled` = 1 " : "";
        $sql = 'SELECT bc.`id_cbp_field`, bc.`iscustomeremail`,bc.`iscustomername`,
		bcl.`label` label, bcl.`description` description, bc.`position`,  bc.`width`,
		bc.`enabled`,  bc.`required`, bcl.`options` options, bc.`type`, bc.`validation`,
    bc.`minimaldate`, bc.`maximaldate`, bc.`displaydatehint`, bc.`allowedextensions`
			FROM `'._DB_PREFIX_.'cbp_field` bc
			INNER JOIN `'._DB_PREFIX_.'cbp_field_lang` bcl
			ON (bc.`id_cbp_field` = bcl.`id_cbp_field`)
			WHERE bcl.`id_lang` = '.(int)Context::getContext()->language->id.
            $onlyEnabledSql.
            ' ORDER BY bc.`position`';

        return Db::getInstance()->executeS($sql);
    }
}
