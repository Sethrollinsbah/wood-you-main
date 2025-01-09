<?php
/**
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

function upgrade_module_0_9_6($module_obj)
{
    if (!defined('_PS_VERSION_')) {
        exit;
    }

    // make sure all new tables are installed
    $module_obj->prepareDatabase();

    $new_tables = array_keys($module_obj->getTables());
    $table_names_correlation = array(
        'a_blog_post'          => 'blog_posts',
        'a_blog_post_stats'    => 'blog_posts_stats',
        'a_blog_post_lang'     => 'blog_posts_lang',
        'a_blog_category'      => 'blog_categories',
        'a_blog_category_lang' => 'blog_categories_lang',
        'a_blog_post_category' => 'blog_posts_categories',
        'a_blog_block'         => 'blog_blocks',
        'a_blog_block_lang'    => 'blog_blocks_lang',
        'a_blog_comment'       => 'blog_comments',
        'a_blog_user'          => 'blog_users',
        'a_blog_settings'      => 'blog_settings',
    );
    $sql = array();
    foreach ($new_tables as $new_name) {
        if (empty($table_names_correlation[$new_name])) {
            continue;
        } else {
            $prev_name = $table_names_correlation[$new_name];
        }
        $prev_name = _DB_PREFIX_.$prev_name;
        $new_name = _DB_PREFIX_.$new_name;

        $new_columns = $module_obj->db->executeS('SHOW COLUMNS FROM '.pSQL($new_name));
        $new_column_names = array();
        foreach ($new_columns as $col) {
            $new_column_names[$col['Field']] = $col['Field'];
        }

        if (count($module_obj->db->executeS('SHOW TABLES LIKE \''.pSQL($prev_name).'\''))) {
            $prev_rows = $module_obj->db->executeS('SELECT * FROM '.pSQL($prev_name));
            $new_rows = $column_names = $upd_segment = array();
            foreach ($prev_rows as $row) {
                if (!$column_names) {
                    $prev_column_names = array_keys($row);
                    foreach ($new_column_names as $ncn) {
                        if (in_array($ncn, $prev_column_names)) {
                            $column_names[$ncn] = $ncn;
                            $upd_segment[] = pSQL($ncn).' = VALUES('.pSQL($ncn).')';
                        }
                    }
                }
                $new_row = array();
                foreach ($row as $name => $value) {
                    if (isset($column_names[$name])) {
                        $new_row[] = '\''.pSQL($value).'\'';
                    }
                }
                $new_rows[] = '('.implode(', ', $new_row).')';
            }
            if ($new_rows && $column_names) {
                $query = '
                    INSERT INTO '.pSQL($new_name).'
                    ('.pSQL(implode(', ', $column_names)).')
                    VALUES '.implode(', ', $new_rows).'
                    ON DUPLICATE KEY UPDATE
                    '.implode(', ', $upd_segment);
                $sql[] = $query;
                $sql[] = 'DROP TABLE IF EXISTS '.pSQL($prev_name);
            }
        }
    }
    if ($sql) {
        $module_obj->runSql($sql);
    }

    // update possible duplicating URLs in posts
    $urls_data = $module_obj->db->executeS('
        SELECT id_post, id_lang, link_rewrite FROM '._DB_PREFIX_.'a_blog_post_lang
    ');
    foreach ($urls_data as $row) {
        $has_duplicate = $module_obj->db->getValue('
            SELECT id_post FROM '._DB_PREFIX_.'a_blog_post_lang
            WHERE link_rewrite = \''.pSQL($row['link_rewrite']).'\'
            AND id_post <> '.(int)$row['id_post'].'
            AND id_lang = '.(int)$row['id_lang'].'
        ');
        if ($has_duplicate) {
            $new_link_rewrite = $row['id_post'].'-'.$row['link_rewrite'];
            $module_obj->db->execute('
                UPDATE '._DB_PREFIX_.'a_blog_post_lang
                SET link_rewrite = \''.pSQL($new_link_rewrite).'\'
                WHERE id_post = '.(int)$row['id_post'].'
                AND id_lang = '.(int)$row['id_lang'].'
            ');
        }
    }

    return true;
}
