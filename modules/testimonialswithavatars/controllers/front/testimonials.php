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

class TestimonialsWithAvatarsTestimonialsModuleFrontController extends ModuleFrontControllerCore
{
    public function init()
    {
        $this->settings = $this->module->getSettings('controller');
        $this->page_header = $this->module->getLangValue($this->settings, 'title', $this->module->l('Testimonials'));
        $this->display_column_left = true;
        $this->display_column_right = true;
        parent::init();
    }

    public function initContent()
    {
        $this->context = Context::getContext();
        $this->displayPosts();
        parent::initContent();
    }

    public function displayPosts()
    {
        $posts = $this->module->getPosts(true, 0, $this->settings['num'] + 1, $this->settings['orderby']);
        $show_load_more = false;
        if (count($posts) == $this->settings['num'] + 1) {
            $show_load_more = true;
            array_pop($posts);
        }
        $avatar = $this->module->getAvatarName();
        $this->context->smarty->assign(array(
            'twa_posts' => $posts,
            'twa_settings' => $this->settings,
            'customer_name' => trim($this->getAuthorName($avatar)),
            'avatar' => $avatar,
            'twa' => $this->module,
            'restrictions_warning' => $this->module->isPostingRestricted(),
            'allow_html' => $this->module->general_settings['allow_html'],
            'show_load_more' => $show_load_more,
            'general_settings' => $this->module->general_settings,
            'hide_left_column' => !$this->settings['display_column_left'],
            'hide_right_column' => !$this->settings['display_column_right'],
            'page_header' => $this->page_header,
            'is_17' => $this->module->is_17,
        ));
        $this->setCurrentTemplate('twa.tpl', $this->settings);
    }

    public function setCurrentTemplate($tpl_name, $settings)
    {
        if ($this->module->is_17) {
            $this->context->smarty->assign(array(
                'html' => $this->displayTemplate($tpl_name),
            ));
            $page = 'module-'.$this->module->name.'-testimonials';
            $this->context->controller->php_self = $page;
            if (!empty($settings['display_column_left']) && !empty($settings['display_column_right'])) {
                $layout = 'both-columns';
            } elseif (!empty($settings['display_column_left'])) {
                $layout = 'left-column';
            } elseif (!empty($settings['display_column_right'])) {
                $layout = 'right-column';
            } else {
                $layout = 'full-width';
            }
            $this->context->shop->theme->setPageLayouts(array($page => 'layout-'.$layout));
            $this->setTemplate('module:testimonialswithavatars/views/templates/front/content-17.tpl');
        } else {
            // remove trailing shop name from meta_title
            if ($meta_title = $this->getMetaTitle()) {
                $this->context->smarty->assign('meta_title', $meta_title);
            }
            $this->setTemplate($tpl_name);
        }
    }

    public function getMetaTitle()
    {
        return $this->module->db->getValue('
            SELECT title FROM '._DB_PREFIX_.'meta m
            LEFT JOIN '._DB_PREFIX_.'meta_lang ml
                ON ml.id_meta = m.id_meta
                AND ml.id_lang = '.(int)$this->context->language->id.'
                AND ml.id_shop = '.(int)$this->context->shop->id.'
            WHERE m.page = \''.pSQL($this->module->controller_page).'\'
        ');
    }

    public function displayTemplate($tpl_name)
    {
        $local_path = _PS_MODULE_DIR_.$this->module->name.'/'.$this->module->name.'.php';
        return $this->module->display($local_path, 'views/templates/front/'.$tpl_name);
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();
        $breadcrumb['links'][] = array('title' => $this->page_header, 'url' => '');
        return $breadcrumb;
    }


    public function getAuthorName($avatar)
    {
        $name = Db::getInstance()->getValue('
            SELECT customer_name FROM '._DB_PREFIX_.$this->module->name.' WHERE avatar = \''.pSQL($avatar).'\'
        ');
        return $name;
    }
}
