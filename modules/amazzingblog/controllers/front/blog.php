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

class AmazzingBlogBlogModuleFrontController extends ModuleFrontControllerCore
{
    public $breadcrumb_items = array();

    public function init()
    {
        $this->display_column_left = true;
        $this->display_column_right = true;
        parent::init();
    }

    public function initContent()
    {
        $this->context = Context::getContext();
        $this->id_lang = $this->context->language->id;
        $this->id_shop = $this->context->shop->id;
        if (Tools::isSubmit('ajax') && Tools::isSubmit('action')) {
            $action_method = 'ajax'.Tools::getValue('action');
            $this->$action_method();
        }
        $this->defineCurrentPage();
        parent::initContent();
    }

    public function defineCurrentPage()
    {
        $id_post = Tools::getValue('id_post');
        $id_category = Tools::getValue('id_category');
        $page = Tools::getValue('page', 1);
        if ($this->module->friendly_url) {
            $link_rewrite = $request_uri = '';
            if (isset($_SERVER['REQUEST_URI'])) {
                $request_uri = $_SERVER['REQUEST_URI'];
            } elseif (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
                $request_uri = $_SERVER['HTTP_X_REWRITE_URL'];
            }
            $request_uri = parse_url($request_uri);
            $request_params = !empty($request_uri['query']) ? $request_uri['query'] : '';
            $request_uri = rawurldecode($request_uri['path']);
            $exploded_request = explode('/'.$this->module->slug.'/', $request_uri);
            if (count($exploded_request) > 1) {
                $link_rewrite = rtrim(array_pop($exploded_request), '/');
                $link_rewrite = explode('/', $link_rewrite);
                $possible_page = array_pop($link_rewrite);
                if ((int)$possible_page) {
                    $page = $possible_page;
                } else {
                    $link_rewrite[] = $possible_page;
                }
                $link_rewrite = implode('/', $link_rewrite);
            }
            if (!$link_rewrite) {
                // redirect to canonical url
                if ($id_category) {
                    if ($link_rewrite = $this->module->getLinkRewriteById('category', $id_category)) {
                        Tools::redirect($this->module->getCategoryLink($id_category, $link_rewrite, $page));
                    } else {
                        $this->displayCategory($id_category, $page);
                    }
                } elseif ($id_post) {
                    if ($link_rewrite = $this->module->getLinkRewriteById('post', $id_post)) {
                        Tools::redirect($this->module->getPostLink($id_post, $link_rewrite));
                    } else {
                        $this->displayPost($id_post);
                    }
                } elseif (strpos($request_params, 'module='.$this->module->name) !== false || Tools::getValue('page')) {
                    Tools::redirect($this->module->getCategoryLink($this->module->root_id, '', $page));
                } else {
                    $this->displayCategory($this->module->root_id, $page);
                }
            } elseif (Tools::substr($link_rewrite, 0, 5) === 'tags/') {
                $tag_urls = explode('+', str_replace('tags/', '', $link_rewrite));
                $this->displayCategory($this->module->root_id, $page, array('tag_urls' => $tag_urls));
            } elseif ($id_category = $this->module->getIdByLinkRewrite('category', $link_rewrite)) {
                $this->displayCategory($id_category, $page);
            } elseif ($id_post = $this->module->getIdByLinkRewrite('post', $link_rewrite)) {
                $this->displayPost($id_post);
            } else {
                Tools::redirect('page-not-found');
            }
        } elseif ($id_post) {
            $this->displayPost($id_post);
        } elseif ($tag_urls = Tools::getValue('tags')) {
            $tag_urls = explode(' ', $tag_urls);
            $this->displayCategory($this->module->root_id, $page, array('tag_urls' => $tag_urls));
        } else {
            $id_category = $id_category ? $id_category : $this->module->root_id;
            $this->displayCategory($id_category, $page);
        }
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();
        foreach ($this->breadcrumb_items as $item) {
            $breadcrumb['links'][] = $item;
        }
        return $breadcrumb;
    }

    public function getChildCategories($id_category)
    {
        $children = $this->module->db->executeS('
            SELECT id_category FROM '._DB_PREFIX_.'a_blog_category
            WHERE id_parent = '.(int)$id_category.'
        ');
        $cat_ids = array();
        foreach ($children as $child) {
            $cat_ids[$child['id_category']] = $child['id_category'];
            if ($sub_children = $this->getChildCategories($child['id_category'])) {
                foreach ($sub_children as $cat_id) {
                    $cat_ids[$cat_id] = $cat_id;
                }
            }
        }
        return array_values($cat_ids);
    }

    public function getCategoryData($id_category, $id_lang, $id_shop)
    {
        $category = $this->module->db->getRow('
            SELECT * FROM '._DB_PREFIX_.'a_blog_category c
            LEFT JOIN '._DB_PREFIX_.'a_blog_category_lang cl
                ON c.id_category = cl.id_category AND cl.id_lang = '.(int)$id_lang.'
            WHERE c.id_category = '.(int)$id_category.' AND cl.id_shop = '.(int)$id_shop.'
        ');
        return $category;
    }

    public function displayCategory($id_category, $page = 1, $additional_params = array())
    {
        $category = $this->getCategoryData($id_category, $this->id_lang, $this->id_shop);
        $category_settings = $this->module->getSettings('category');
        $post_list_settings = $this->module->getSettings('postlist');
        $additional_filters = array('active' => 1);
        if (!empty($additional_params['tag_urls'])) {
            $tag_ids = $tag_names = array();
            foreach ($additional_params['tag_urls'] as $tag_url) {
                $tag_data = $this->module->db->getRow('
                    SELECT id_tag, tag_name FROM '._DB_PREFIX_.'a_blog_tag WHERE tag_url = \''.pSQL($tag_url).'\'
                ');
                if ($tag_data) {
                    $tag_ids[$tag_data['id_tag']] = $tag_data['id_tag'];
                }
                $tag_names[] = $tag_data ? $tag_data['tag_name'] : $tag_url;
            }
            $additional_filters['id_tag'] = !empty($tag_ids) ? $tag_ids : array(0);
            $category['title'] = $this->module->l('Search by tags').': '.
            implode(', ', $tag_names);
            $category_settings['show_subcategories'] = false;
            $category_settings['ignore_category'] = true;
            $first_page_url = $this->module->getTagLink($additional_params['tag_urls']);
        } else {
            $this->id_category = $id_category;
            $first_page_url = $this->module->getCategoryLink($id_category, $category['link_rewrite']);
        }

        if (!empty($category_settings['show_subcategories'])) {
            $subcategories = $this->module->db->executeS('
                SELECT * FROM '._DB_PREFIX_.'a_blog_category c
                LEFT JOIN '._DB_PREFIX_.'a_blog_category_lang cl
                    ON c.id_category = cl.id_category AND cl.id_lang = '.(int)$this->id_lang.'
                WHERE c.id_parent = '.(int)$id_category.' AND cl.id_shop = '.(int)$this->context->shop->id.'
            ');
            foreach ($subcategories as $i => &$s) {
                $cat_ids = array($s['id_category']);
                if (!empty($category_settings['include_all'])) {
                    $cat_ids = array_merge($cat_ids, $this->getChildCategories($s['id_category']));
                }
                $subcat_additional_filters = array('id_category' => $cat_ids, 'active' => 1);
                $posts_num = $this->module->getTotal('post', $subcat_additional_filters);
                if (!$posts_num && $category_settings['show_subcategories'] == 1) {
                    unset($subcategories[$i]);
                }
                $s['posts_num'] = $posts_num;
                $s['url'] = $this->module->getCategoryLink($s['id_category'], $s['link_rewrite']);
            }
        } else {
            $subcategories = array();
        }

        if (empty($category_settings['ignore_category'])) {
            $cat_ids = array($id_category);
            if (!empty($category_settings['include_all'])) {
                $cat_ids = array_merge($cat_ids, $this->getChildCategories($id_category));
            }
            $additional_filters['id_category'] = $cat_ids;
            $parent_categories = $this->getCategoryParents($id_category, array(), true);
        } else {
            $parent_categories = $this->getCategoryParents($id_category);
        }
        $this->breadcrumb_items[] = array('title' => $category['title'], 'url' => '');

        $pagination_settings = $this->module->getPaginationSettings('post', $additional_filters, $page);
        if (!Tools::getValue('npp') && empty($this->context->cookie->ab_user_npp) &&
            !empty($post_list_settings['posts_per_page'])) {
            $pagination_settings['npp'] = $post_list_settings['posts_per_page'];
        }
        $posts = $this->module->getPostListInfos(
            $pagination_settings,
            $post_list_settings['order_by'],
            'DESC',
            $additional_filters
        );
        if (!$posts && $page > 1) {
            Tools::redirect($first_page_url);
        } else {
            $this->module->prepareHeaderData('category', $id_category);
            Media::addJsDef(array('ab_first_page_url' => $first_page_url));
            $meta_title = !empty($category['meta_title']) ? $category['meta_title'] : $category['title'];
            $this->context->smarty->assign(array(
                // ab_prefix is required to avoid possible var name interference
                'ab_category' => $category,
                'ab_category_settings' => $category_settings,
                'ab_post_list_settings' => $post_list_settings,
                'ab_additional_filters' => $additional_filters,
                'ab_cat_parents' => $parent_categories,
                'ab_subcategories' => $subcategories,
                'ab_posts' => $posts,
                'ab_pagination_settings' => $pagination_settings,
                'ab_first_page_url' => $first_page_url,
                'blog' => $this->module,
                'hide_left_column' => !$category_settings['display_column_left'],
                'hide_right_column' => !$category_settings['display_column_right'],
                'meta_title' => Configuration::get('PS_SHOP_NAME').' | '.$meta_title,
                'meta_description' => $category['meta_description'],
                'meta_keywords' => $category['meta_keywords'],
            ));
            $this->setCurrentTemplate('category.tpl', $category_settings);
        }
    }

    public function setCurrentTemplate($tpl_name, $settings)
    {
        if ($this->module->is_17) {
            $this->context->smarty->assign(array(
                'html' => $this->displayTemplate($tpl_name),
            ));
            $page = 'module-'.$this->module->name.'-blog';
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
            $this->setTemplate('module:amazzingblog/views/templates/front/content-17.tpl');
        } else {
            $this->setTemplate($tpl_name);
        }
    }

    public function displayTemplate($tpl_name)
    {
        $local_path = _PS_MODULE_DIR_.$this->module->name.'/'.$this->module->name.'.php';
        return $this->module->display($local_path, 'views/templates/front/'.$tpl_name);
    }

    public function getCategoryParents($id_category, $parents = array(), $current = false)
    {
        $parent = $this->module->db->getRow('
            SELECT c.id_category, c.id_parent, cl.title, cl.link_rewrite FROM '._DB_PREFIX_.'a_blog_category c
            LEFT JOIN '._DB_PREFIX_.'a_blog_category_lang cl
                ON c.id_category = cl.id_category
            WHERE c.id_category ='.(int)$id_category.'
            AND cl.id_lang = '.$this->context->language->id.'
        ');
        if ($parent) {
            if (!$current) {
                $parents[] = $parent;
            }
            return $this->getCategoryParents($parent['id_parent'], $parents);
        } else {
            $parents = array_reverse($parents);
            if ($this->module->is_17) {
                foreach ($parents as $p) {
                    $this->breadcrumb_items[] = array(
                        'title' => $p['title'],
                        'url' => $this->module->getCategoryLink($p['id_category'], $p['link_rewrite']),
                    );
                }
            }
            return $parents;
        }
    }

    public function displayPost($id_post)
    {
        $query = new DbQuery();
        $query->select('p.*, pl.*, s.views, s.comments, s.likes');
        $query->from('a_blog_post', 'p');
        $lang_join_on = 'pl.id_post = p.id_post AND pl.id_lang = '.(int)$this->id_lang.
        ' AND pl.id_shop = '.(int)$this->id_shop;
        $query->innerJoin('a_blog_post_lang', 'pl', $lang_join_on);
        $query->leftJoin('a_blog_post_stats', 's', 's.id_post = p.id_post');
        $query->where('p.id_post = '.(int)$id_post);
        $query->where('p.active = 1');
        $this->module->onlyPublishedAssociation($query);
        $post = $this->module->db->getRow($query);

        $settings = $this->module->getSettings('post');
        $comment_settings = $this->module->getSettings('comment');

        $comments = $this->module->db->executeS('
            SELECT * FROM '._DB_PREFIX_.'a_blog_comment c
            LEFT JOIN '._DB_PREFIX_.'a_blog_user bu ON bu.id_user = c.id_user
            WHERE c.id_post = '.(int)$id_post.' AND id_shop = '.(int)$this->context->shop->id.' AND c.active = 1
            '.(empty($comment_settings['instant_publish']) ? ' AND approved_by <> 0' : '').'
            ORDER BY date_add ASC
        ');

        $id_category_default = $this->module->root_id;

        if ($post) {
            $this->id_post = $id_post;
            $this->module->addPostStats($id_post, 'views');
            $post['views'] += 1;
            $this->module->prepareHeaderData('post', $id_post);

            $img_type = $settings['main_img_type'];
            $main_path = 'posts/'.$post['id_post'].'/'.$img_type.'/'.$post['main_img'];
            if (is_file($this->module->img_dir_local.$main_path)) {
                $post['main_img'] = $this->module->img_dir.$main_path;
                $this->og_image = Tools::getHttpHost(true).$post['main_img'];
            } else {
                $post['main_img'] = '';
            }
            $id_category_default = $post['id_category_default'];
            if (!empty($settings['show_tags'])) {
                $post['tags'] = $this->module->getPostTags($id_post, $this->id_lang, false);
            }
            $category_parents = $this->getCategoryParents($id_category_default);
            // some breadcrumb items are defined in getCategoryParents()
            $this->breadcrumb_items[] = array('title' => $post['title'], 'url' => '');
        }
        $meta_title = !empty($post['meta_title']) ? $post['meta_title'] : $post['title'];
        $this->context->smarty->assign(array(
            'ab_post' => $post,
            'ab_post_settings' => $settings,
            'ab_cat_parents' => $category_parents,
            'ab_user_data' => $this->module->getUserData($this->context->customer->id_guest),
            'ab_comments' => $comments,
            'avatars_dir' => $this->module->img_dir.'avatars/',
            'blog' => $this->module,
            'hide_left_column' => !$settings['display_column_left'],
            'hide_right_column' => !$settings['display_column_right'],
            'meta_title' => Configuration::get('PS_SHOP_NAME').' | '.$meta_title,
            'meta_description' => $post['meta_description'],
            'meta_keywords' => $post['meta_keywords'],
        ));
        $this->setCurrentTemplate('post.tpl', $settings);
    }

    public function ajaxSubmitComment()
    {
        $this->module->ajaxSubmitComment();
    }

    public function ajaxSendNotification()
    {
        $this->module->ajaxSendNotification();
    }

    public function ajaxLoadPosts()
    {
        $post_list_settings = $this->module->getSettings('postlist');
        $additional_filters = $this->module->unserialize(Tools::getValue('additional_filters'));
        foreach ($additional_filters as &$f) {
            $f = explode(',', $f);
        }
        $additional_filters['active'] = 1;
        $pagination_settings = $this->module->getPaginationSettings('post', $additional_filters);
        $posts = $this->module->getPostListInfos(
            $pagination_settings,
            $post_list_settings['order_by'],
            'DESC',
            $additional_filters
        );
        $this->context->smarty->assign(array(
            'settings' => $post_list_settings,
            'ab_pagination_settings' => $pagination_settings,
            'ab_first_page_url' => Tools::getValue('ab_first_page_url'),
            'posts' => $posts,
            'blog' => $this->module,
        ));
        $ret = array(
            'html' => utf8_encode($this->displayTemplate('post-list.tpl')),
        );
        exit(Tools::jsonEncode($ret));
    }
}
