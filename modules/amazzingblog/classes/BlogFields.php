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

class BlogFields extends AmazzingBlog
{
    public function getPostFields($only_multilang = false)
    {
        $fields = array(
            'title' => array(
                'tab' => 'content',
                'display_name' => $this->l('Title'),
                'input_name' => 'multilang[title]',
                'multilang' => 1,
                'value' => array(
                    $this->context->language->id => '',
                ),
                'required' => 1,
            ),
            'meta_title' => array(
                'tab' => 'seo',
                'display_name' => $this->l('Meta title'),
                'input_name' => 'multilang[meta_title]',
                'multilang' => 1,
                'class' => 'meta-field autofill',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'validate' => 'isGenericName',
            ),
            'link_rewrite' => array(
                'tab' => 'seo',
                'display_name' => $this->l('Friendly URL'),
                'input_name' => 'multilang[link_rewrite]',
                'multilang' => 1,
                'class' => 'autofill',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'required' => 1,
                'validate' => 'isLinkRewrite',
            ),
            'meta_description' => array(
                'tab' => 'seo',
                'display_name' => $this->l('Meta description'),
                'input_name' => 'multilang[meta_description]',
                'multilang' => 1,
                'class' => 'meta-field',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'validate' => 'isGenericName',
            ),
            'meta_keywords' => array(
                'tab' => 'seo',
                'display_name' => $this->l('Meta keywords'),
                'input_name' => 'multilang[meta_keywords]',
                'multilang' => 1,
                'class' => 'meta-field',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'validate' => 'isGenericName',
            ),
            'categories' => array(
                'tab' => 'categories',
                'display_name' => $this->l('Selected categories'),
                'input_name' => 'cat_ids[]',
                'value' => '',
            ),
            'images' => array(
                'tab' => 'content',
                'display_name' => $this->l('Images'),
                'value' => array(),
            ),
            'content' => array(
                'tab' => 'content',
                'display_name' => $this->l('Text'),
                'input_name' => 'multilang[content]',
                'multilang' => 1,
                'type' => 'mce',
                'value' => array(
                    $this->context->language->id => '',
                ),
            ),
            'tags' => array(
                'tab' => 'content',
                'display_name' => $this->l('Tags'),
                'input_name' => 'multilang[tags]',
                'input_class' => 'tagify',
                'multilang' => 1,
                'value' => array(
                    $this->context->language->id => '',
                ),
            ),
            'author' => array(
                'tab' => 'publishing',
                'display_name' => $this->l('Author'),
                'input_name' => 'author',
                'type' => 'select',
                'options' => $this->getAuthorOptions(),
                'value' => $this->context->employee->id,
                'required' => 1,
            ),
            'publish_from' => array(
                'tab' => 'publishing',
                'display_name' => $this->l('Start publication on'),
                'input_name' => 'publish_from',
                'type' => 'datepicker',
                'value' => '',
                'required' => 1,
            ),
            'publish_to' => array(
                'tab' => 'publishing',
                'display_name' => $this->l('End publication on'),
                'tooltip' => $this->l('You can leave it empty'),
                'input_name' => 'publish_to',
                'type' => 'datepicker',
                'value' => '',
                'required' => 1,
            ),
            'date_add' => array(
                'tab' => 'publishing',
                'display_name' => $this->l('Created on'),
                'input_name' => 'date_add',
                'readonly' => 1,
                'value' => '',
                'required' => 1,
            ),
            'date_upd' => array(
                'tab' => 'publishing',
                'display_name' => $this->l('Last updated on'),
                'input_name' => 'date_upd',
                'readonly' => 1,
                'value' => '',
                'required' => 1,
            ),
            'related_products' => array(
                'tab' => 'related',
                'display_name' => $this->l('Start typing...'),
                'value' => '',
            ),
        );
        if ($only_multilang) {
            // tags are processed separately
            unset($fields['tags']);
            foreach ($fields as $k => $n) {
                if (empty($n['multilang'])) {
                    unset($fields[$k]);
                }
            }
        }
        return $fields;
    }

    public function getPostTabs()
    {
        $tabs = array(
            'content' => $this->l('Content'),
            'categories' => $this->l('Categories'),
            'seo' => $this->l('SEO'),
            'publishing' => $this->l('Publishing options'),
            'related' => $this->l('Related products'),
        );
        return $tabs;
    }


    public function getImgOptions()
    {
        if (empty($this->img_options)) {
            $img_fields = $this->getImgSettingsFields();
            $saved_img_settings = $this->getSettings('img');
            $this->img_options = array('0' => $this->l('None'));
            foreach ($img_fields as $k => $f) {
                $value = isset($saved_img_settings[$k]) ? $saved_img_settings[$k] : $f['value'];
                $this->img_options[$k] = $f['display_name'].' ('.$value.')';
            }
        }
        return $this->img_options;
    }

    public function getPostSettingsFields()
    {
        $fields = array(
            'display_column_left' => array(
                'display_name' => $this->l('Left column'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'display_column_right' => array(
                'display_name' => $this->l('Right column'),
                'type' => 'switcher',
                'value' => 0,
            ),
            'main_img_type' => array(
                'display_name' => $this->l('Main image type'),
                'options' => $this->getImgOptions(),
                'value' => 'l',
            ),
            'show_author' =>  array(
                'display_name' => $this->l('Show author'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_date' =>  array(
                'display_name' => $this->l('Publication date'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_views' =>  array(
                'display_name' => $this->l('Number of views'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_tags' =>  array(
                'display_name' => $this->l('Tags'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_footer_hook' =>  array(
                'display_name' => $this->l('displayPostFooter'),
                'tooltip' => $this->l('Show hook displayPostFooter'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_aftercomments_hook' =>  array(
                'display_name' => $this->l('displayPostAfterComments'),
                'tooltip' => $this->l('Show hook displayPostAfterComments'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'social_sharing' => array(
                'display_name' => $this->l('Social sharing'),
                'type' => 'checkbox',
                'input_name' => 'social_sharing[]',
                'boxes' => array(
                    'facebook' => 'Facebook',
                    'vk' => 'VK',
                    'odnoklassniki' => 'Odnoklassniki',
                    'twitter' => 'Twitter',
                    'google-plus' => 'Google+',
                    'linkedin' => 'LinkedIn',
                    'pinterest' => 'Pinterest',
                ),
                'value' => array(),
            ),
        );
        return $fields;
    }

    public function getPostlistSettingsFields()
    {
        $fields = array(
            'display_type' => array(
                'display_name' => $this->l('Display posts as'),
                'options' => array(
                    'grid' => $this->l('Grid'),
                    'list' => $this->l('List'),
                ),
                'value' => 'list',
            ),
            'col_num' => array(
                'display_name' => $this->l('Columns'),
                'class' => 'display-type-option grid hidden related-option',
                'options' => array(
                    2 => 2,
                    3 => 3,
                    4 => 4,
                ),
                'value' => 3,
            ),
            'p_type' => array(
                'display_name' => $this->l('Pagination type'),
                'options' => array(
                    'regular' => $this->l('Regular'),
                    'ajax' => $this->l('Ajax'),
                    // 'load_more' => $this->l('Load more button'),
                    // 'scroll' => $this->l('Load posts on page scroll'),
                ),
                'value' => 'regular',
            ),
            'posts_per_page' => array(
                'display_name' => $this->l('Posts per page'),
                'options' => $this->getNppOptions(),
                'value' => 10,
            ),
            'order_by' => array(
                'display_name' => $this->l('Order by'),
                'options' => $this->getSortingOptions(),
                'value' => 'publish_from',
            ),
            'cover_type' => array(
                'display_name' => $this->l('Cover image'),
                'options' => $this->getImgOptions(),
                'value' => 'xl',
            ),
            'link_cover' => array(
                'display_name' => $this->l('Cover link'),
                'type' => 'switcher',
                'class' => 'related-option',
                'value' => 1,
            ),
            'title_truncate' => array(
                'display_name' => $this->l('Title max length'),
                'tooltip' => $this->l('Set 0 to hide title'),
                'value' => 100,
            ),
            'link_title' =>  array(
                'display_name' => $this->l('Title link'),
                'type' => 'switcher',
                'class' => 'related-option',
                'value' => 1,
            ),
            'truncate' =>  array(
                'display_name' => $this->l('Intro text length'),
                'tooltip' => $this->l('Set 0 to hide intro text'),
                'value' => 100,
            ),
            'show_readmore' =>  array(
                'display_name' => $this->l('Read more'),
                'type' => 'switcher',
                'class' => 'related-option',
                'value' => 1,
            ),
            'show_author' =>  array(
                'display_name' => $this->l('Show author'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_date' =>  array(
                'display_name' => $this->l('Publication date'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_tags' =>  array(
                'display_name' => $this->l('Tags'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_views' =>  array(
                'display_name' => $this->l('Views num'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'show_comments' =>  array(
                'display_name' => $this->l('Comments num'),
                'type' => 'switcher',
                'value' => 1,
            ),
        );
        return $fields;
    }

    public function getCategoryFields($id_parent = false, $only_multilang = false)
    {
        $fields = array(
            'id_parent' => array(
                'display_name' => $this->l('Parent category'),
                'input_name' => 'id_parent',
                'value' => $id_parent ? $id_parent : $this->root_id,
            ),
            'title' => array(
                'display_name' => $this->l('Title'),
                'input_name' => 'multilang[title]',
                'multilang' => 1,
                'value' => array(
                    $this->context->language->id => '',
                ),
                'required' => 1,
                'validate' => 'isGenericName',
            ),
            'link_rewrite' => array(
                'display_name' => $this->l('Friendly URL'),
                'input_name' => 'multilang[link_rewrite]',
                'multilang' => 1,
                'class' => 'autofill',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'required' => 1,
                'validate' => 'isLinkRewrite',
            ),
            'meta_title' => array(
                'display_name' => $this->l('Meta title'),
                'input_name' => 'multilang[meta_title]',
                'multilang' => 1,
                'class' => 'meta-field autofill hidden',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'validate' => 'isGenericName',
            ),
            'meta_description' => array(
                'display_name' => $this->l('Meta description'),
                'input_name' => 'multilang[meta_description]',
                'multilang' => 1,
                'class' => 'meta-field hidden',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'validate' => 'isGenericName',
            ),
            'meta_keywords' => array(
                'display_name' => $this->l('Meta keywords'),
                'input_name' => 'multilang[meta_keywords]',
                'multilang' => 1,
                'class' => 'meta-field hidden',
                'value' => array(
                    $this->context->language->id => '',
                ),
                'validate' => 'isGenericName',
            ),
            'description' => array(
                'display_name' => $this->l('Description'),
                'input_name' => 'multilang[description]',
                'multilang' => 1,
                'type' => 'mce',
                'value' => array(
                    $this->context->language->id => '',
                ),
            ),
        );
        if ($only_multilang) {
            foreach ($fields as $k => $n) {
                if (empty($n['multilang'])) {
                    unset($fields[$k]);
                }
            }
        }
        return $fields;
    }

    public function getCategorySettingsFields()
    {
        $fields = array(
            'display_column_left' => array(
                'display_name' => $this->l('Show left column'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'display_column_right' => array(
                'display_name' => $this->l('Show right column'),
                'type' => 'switcher',
                'value' => 0,
            ),
            'show_subcategories' => array(
                'display_name' => $this->l('Display subcategories'),
                'options' => array(
                    0 => $this->l('None'),
                    1 => $this->l('Only having posts'),
                    2 => $this->l('All available'),
                ),
                'value' => 2,
            ),
            'include_all' => array(
                'display_name' => $this->l('Include all posts from subcategories'),
                'type' => 'switcher',
                'value' => 1,
            ),
        );
        return $fields;
    }

    public function getBlockFields()
    {
        $carousel_items_num_array = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6);
        $product_manufacturer_options = array(
            '0' => $this->l('Don\'t display'),
            '1' => $this->l('Display title'),
        );
        $product_image_options = array();
        foreach (ImageType::getImagesTypes() as $t) {
            $type = $t['name'];
            $opt_name = $type.' ('.$t['width'].'*'.$t['height'].')';
            if ($t['manufacturers']) {
                $product_manufacturer_options[$type] = $this->l('Logo').': '.$opt_name;
            }
            if ($t['products']) {
                $product_image_options[$type] = $opt_name;
            }
        }
        $post_list_settings_fields = $this->getPostlistSettingsFields();
        $fields = array(
            'title' => array(
                'display_name' => $this->l('Block Title'),
                'input_name' => 'multilang[title]',
                'multilang' => 1,
                'value' => array($this->context->language->id => ''),
                'required' => 1,
            ),
            'type' => array(
                'display_name' => $this->l('Block type'),
                'input_name' => 'settings[type]',
                'options' => array(
                    'post_latest' => $this->l('Latest posts'),
                    'post_selected' => $this->l('Selected posts'),
                    'post_mostviewed' => $this->l('Most viewed posts'),
                    'post_random' => $this->l('Random posts'),
                    'post_relatedtopost' => $this->l('Other posts, related to current post'),
                    'post_relatedtoproduct' => $this->l('Posts, related to current product'),
                    'product_relatedtopost' => $this->l('Products, related to current post'),
                    'category_selected' => $this->l('Selected blog categories'),
                    'category_children' => $this->l('Blog subcategories'),
                    // 'p_categories' => $this->l('Posts from selected categories'),
                    // 'p_authors' => $this->l('Posts by selected authors'),
                    // 'p_featured' => $this->l('Featured posts'),
                    // 'c_tree' => $this->l('Blog category tree'),
                    // 't_cloud' => $this->l('Tag cloud'),
                    // 'cm_latest' => $this->l('Latest comments'),
                ),
                'value' => 'post_latest',
                'input_class' => 'has-additional-settings',
            ),
            'related_category' => array(
                'display_name' => $this->l('By category'),
                'input_name' => 'settings[related][category]',
                'class' => 'type-option post_relatedtopost hidden related-option',
                'type' => 'switcher',
                'value' => 1,
            ),
            'related_tag' => array(
                'display_name' => $this->l('By tags'),
                'input_name' => 'settings[related][tag]',
                'class' => 'type-option post_relatedtopost hidden related-option',
                'type' => 'switcher',
                'value' => 1,
            ),
            'post_ids' => array(
                'display_name' => $this->l('Post ids'),
                'input_name' => 'settings[post_ids]',
                'class' => 'type-option post_selected hidden related-option',
                'value' => '',
            ),
            'cat_ids' => array(
                'display_name' => $this->l('Category IDs'),
                'tooltip' => $this->l('Leave it empty to display all available categories'),
                'input_name' => 'settings[cat_ids]',
                'class' => 'type-option category_selected hidden related-option',
                'value' => '',
            ),
            'parent_ids' => array(
                'display_name' => $this->l('Parent IDs'),
                'tooltip' => $this->l('Leave it empty to display subcategories of root category'),
                'input_name' => 'settings[parent_ids]',
                'class' => 'type-option category_children hidden related-option',
                'value' => '',
            ),
            'display_type' => array(
                'display_name' => $this->l('Display as'),
                'input_name' => 'settings[display_type]',
                'options' => array(
                    // 'presentation' => $this->l('Presentation'),
                    'carousel' => $this->l('Carousel'),
                    'grid' => $this->l('Grid'),
                    'list' => $this->l('List'),
                ),
                'value' => 'carousel',
                'input_class' => 'has-additional-settings',
            ),
            'col_num' => array(
                'display_name' => $this->l('Columns'),
                'input_name' => 'settings[col_num]',
                'class' => 'display-type-option grid hidden related-option',
                'options' => array(
                    2 => 2,
                    3 => 3,
                    4 => 4,
                ),
                'value' => 3,
            ),
            // carousel fields
            'carousel_i' => array(
                'display_name' => $this->l('Visible items'),
                'input_name' => 'settings[carousel][i]',
                'options' => $carousel_items_num_array,
                'value' => 3,
                'class' => 'i-option',
                'group_begin' => 'carousel hidden related-to-display_type',
            ),
            'carousel_i_1200' => array(
                'display_name' => $this->l('< 1200px'),
                'input_name' => 'settings[carousel][i_1200]',
                'options' => $carousel_items_num_array,
                'value' => 3,
                'class' => 'i-option related-option',
            ),
            'carousel_i_992' => array(
                'display_name' => $this->l('< 992px'),
                'input_name' => 'settings[carousel][i_992]',
                'options' => $carousel_items_num_array,
                'value' => 2,
                'class' => 'i-option related-option',
            ),
            'carousel_i_768' => array(
                'display_name' => $this->l('< 768px'),
                'input_name' => 'settings[carousel][i_768]',
                'options' => $carousel_items_num_array,
                'value' => 1,
                'class' => 'i-option related-option',
            ),
            'carousel_i_480' => array(
                'display_name' => $this->l('< 480px'),
                'input_name' => 'settings[carousel][i_480]',
                'options' => $carousel_items_num_array,
                'value' => 1,
                'class' => 'i-option related-option',
            ),
            'carousel_n' => array(
                'display_name' => $this->l('Navigation'),
                'input_name' => 'settings[carousel][n]',
                'options' => array(
                    '0' => $this->l('Hide'),
                    '1' => $this->l('Show'),
                    '2' => $this->l('Show on hover'),
                ),
                'value' => 2,
            ),
            'carousel_p' => array(
                'display_name' => $this->l('Pagination'),
                'input_name' => 'settings[carousel][p]',
                'type' => 'switcher',
                'value' => 0,
            ),
            'carousel_a' => array(
                'display_name' => $this->l('Autoplay'),
                'input_name' => 'settings[carousel][a]',
                'type' => 'switcher',
                'value' => 1,
            ),
            'carousel_l' => array(
                'display_name' => $this->l('Loop'),
                'input_name' => 'settings[carousel][l]',
                'type' => 'switcher',
                'value' => 0,
            ),
            'carousel_s' => array(
                'display_name' => $this->l('Speed'),
                'tooltip' => $this->l('Animation speend (ms)'),
                'input_name' => 'settings[carousel][s]',
                'value' => 100,
                'required' => 1,
                'group_end' => 'carousel hidden related-to-display_type',
            ),
            'class' => array(
                'display_name' => $this->l('Container class'),
                'input_name' => 'settings[class]',
                'value' => '',
            ),
            'num' =>  array(
                'display_name' => $this->l('Total items'),
                'input_name' => 'settings[num]',
                'value' => 10,
            ),
            'main_item_img_type' => array(
                'display_name' => $this->l('Main item image type'),
                'input_name' => 'settings[main_item_img_type]',
                'class' => 'display-type-option presentation hidden',
                'options' => $post_list_settings_fields['cover_type']['options'],
                'value' => 'l',
            ),
            'main_item_truncate' => array(
                'display_name' => $this->l('Main item intro text length'),
                'input_name' => 'settings[main_item_truncate]',
                'class' => 'display-type-option presentation hidden',
                'value' => 150,
            ),
            // product fields
            'product_order_by' => array(
                'display_name' => $this->l('Order by'),
                'input_name' => 'settings[product_order_by]',
                'class' => 'resource-type-option product hidden',
                'options' => array(
                    'initial' => $this->l('As specified'),
                    'random' => $this->l('Random'),
                    'date_add' => $this->l('Date added'),
                    'date_upd' => $this->l('Date updated'),
                ),
                'value' => 'initial',
                // 'group_begin' => 'product_relatedtopost hidden related-to-type',
            ),
            'product_img_type' => array(
                'display_name' => $this->l('Image type'),
                'input_name' => 'settings[product_img_type]',
                'class' => 'resource-type-option product hidden',
                'options' => $product_image_options,
                'value' => $this->is_17 ? ImageType::getFormattedName('home') : ImageType::getFormatedName('home'),
            ),
            'second_image' => array(
                'display_name'   => $this->l('Second image on hover'),
                'input_name' => 'settings[second_image]',
                'value' => 0,
                'type'  => 'switcher',
                'class' => 'resource-type-option product hidden',
            ),
            'product_title' => array(
                'display_name'  => $this->l('Max title length'),
                'tooltip' => $this->l('Set 0 to hide title'),
                'input_name' => 'settings[product_title]',
                'value' => 45,
                'class' => 'resource-type-option product hidden',
            ),
            // 'reference' => array(
            //     'display_name'  => $this->l('Reference'),
            //     'input_name' => 'settings[reference]',
            //     'value' => 0,
            //     'type'  => 'switcher',
            //     'class' => 'resource-type-option product hidden',
            // ),
            // 'product_cat' => array(
            //     'display_name'  => $this->l('Category'),
            //     'input_name' => 'settings[product_cat]',
            //     'value' => 0,
            //     'type'  => 'switcher',
            //     'class' => 'resource-type-option product hidden',
            // ),
            // 'product_man' => array(
            //     'display_name'  => $this->l('Manufacturer'),
            //     'input_name' => 'settings[product_man]',
            //     'value' => 0,
            //     'class' => 'resource-type-option product hidden',
            //     'options' => $product_manufacturer_options,
            // ),
            'price' => array(
                'display_name'  => $this->l('Price'),
                'input_name' => 'settings[price]',
                'value' => 1,
                'type'  => 'switcher',
                'class' => 'resource-type-option product hidden',
            ),
            'add_to_cart' => array(
                'display_name'  => $this->l('Add to cart button'),
                'input_name' => 'settings[add_to_cart]',
                'value' => 1,
                'type'  => 'switcher',
                'class' => 'resource-type-option product hidden',
            ),
            // 'view_more' => array(
            //     'display_name'  => $this->l('View more button'),
            //     'input_name' => 'settings[view_more]',
            //     'value' => 0,
            //     'type'  => 'switcher',
            //     'class' => 'resource-type-option product hidden',
            // ),
            // 'quick_view' => array(
            //     'display_name'  => $this->l('Quick view'),
            //     'input_name' => 'settings[quick_view]',
            //     'value' => 0,
            //     'type'  => 'switcher',
            //     'class' => 'resource-type-option product hidden',
            // ),
            'stickers' => array(
                'display_name'  => $this->l('Stickers'),
                'input_name' => 'settings[stickers]',
                'value' => 1,
                'type'  => 'switcher',
                'class' => 'resource-type-option product hidden',
                // 'group_end' => 'product_relatedtopost hidden related-to-type',
            ),
        );

        // add post list fields
        $post_list_fields = array('cover_type', 'link_cover', 'title_truncate',
        'link_title', 'truncate', 'show_readmore', 'show_author', 'show_date', 'show_views',
        'show_comments', 'show_tags');
        foreach ($post_list_fields as $field_name) {
            if (!isset($post_list_settings_fields[$field_name])) {
                continue;
            }
            $field = $post_list_settings_fields[$field_name];
            if ($field_name == 'cover_type') {
                $field['value'] = 's';
            } elseif ($field_name == 'show_author' || $field_name == 'show_tags') {
                $field['value'] = 0;
            }
            $cls = 'resource-type-option post hidden';
            $field['class'] = isset($field['class']) ? $field['class'].' '.$cls : $cls;
            $field['input_name'] = 'settings['.$field_name.']';
            $fields[$field_name] = $field;
        }

        $fields['all_link'] = array(
            'display_name' => $this->l('Link to all posts'),
            'input_name' => 'settings[all_link]',
            'type' => 'switcher',
            'value' => 1,
            'class' => 'resource-type-option post hidden type-exc exc-post_relatedtopost exc-post_relatedtoproduct',
        );
        $fields['compact'] = array(
            'display_name' => $this->l('Compact layout'),
            'input_name' => 'settings[compact]',
            'type' => 'switcher',
            'value' => 0,
            'class' => 'resource-type-option post hidden',
        );
        $fields['exceptions_page_type'] = array(
            'display_name' => $this->l('Display this block'),
            'input_name' => 'settings[exceptions][page][type]',
            'value' => '0',
            'options' => $this->getPageExceptionsOptions(),
        );
        $fields['exceptions_page_ids'] = array(
            'display_name' => $this->l('Selected IDs'),
            'input_name' => 'settings[exceptions][page][ids]',
            'value' => '',
            'class' => 'related-option exc-option page',
        );
         $fields['exceptions_customer_type'] = array(
            'display_name' => '',
            'input_name' => 'settings[exceptions][customer][type]',
            'value' => '0',
            'options' => $this->getCustomerExceptionsOptions(),
        );
        $fields['exceptions_customer_ids'] = array(
            'display_name' => $this->l('Selected IDs'),
            'input_name' => 'settings[exceptions][customer][ids]',
            'value' => '',
            'class' => 'related-option exc-option customer',
        );
        return $fields;
    }

    public function getPageExceptionsOptions()
    {
        $pages = array(
            'product' => $this->l('product'),
            'category' => $this->l('category'),
            'manufacturer' => $this->l('manufacturer'),
            'supplier' => $this->l('supplier'),
            'cms' => $this->l('cms'),
            'ab_post' => $this->l('blog post'),
            'ab_category' => $this->l('blog category'),
        );
        $options = array('0' => $this->l('On all available pages'));
        foreach ($pages as $k => $page) {
            $options[$k.'_all'] = sprintf($this->l('Only on %s pages'), $page);
            $options[$k] = sprintf($this->l('Only on selected %s pages'), $page);
        }
        return $options;
    }

    public function getCustomerExceptionsOptions()
    {
        $options = array(
            '0' => $this->l('For all customers'),
            'group' => $this->l('Only for selected customer groups'),
            'customer' => $this->l('Only for selected customers'),
        );
        return $options;
    }

    public function getCommentSettingsFields()
    {
        $fields = array(
            'avatar' => array(
                'display_name' => $this->l('Avatar dimentions'),
                'tooltip' => $this->l('For example: 55*55'),
                'value' => '55*55',
                'class' => 'user-comments',
            ),
            'max_chars' => array(
                'display_name' => $this->l('Characters limit'),
                'value' => '512',
                'class' => 'user-comments',
            ),
            'max_comments' => array(
                'display_name' => $this->l('Max comments within 1 hour'),
                'value' => '10',
                'class' => 'user-comments',
            ),
            'notif_email' => array(
                'display_name' => $this->l('Email for notifications'),
                'tooltip' => $this->l('Leave it empty if you want to disable notifications'),
                'type' => 'text',
                'value' => Configuration::get('PS_SHOP_EMAIL'),
                'class' => 'user-comments',
            ),
            'instant_publish' => array(
                'display_name' => $this->l('Publish comments'),
                'value' => 1,
                'options' => array(
                    '0' => $this->l('After moderation'),
                    '1' => $this->l('Instantly'),
                ),
                'class' => 'user-comments',
            ),
        );
        return $fields;
    }

    public function getGeneralSettingsFields()
    {
        $fields = array(
            'user_comments' => array(
                'display_name' => $this->l('Enable comments'),
                'type' => 'switcher',
                'value' => 1,
            ),
            'load_icon_fonts' => array(
                'display_name' => $this->l('Load icon fonts'),
                'help_box' => array(
                    $this->l('You can turn it off, if your theme supports \'icon-xx\' classes'),
                    $this->l('Pay attention on  \'icon-google-plus\' and \'icon-odnoklassniki\''),
                ),
                'type' => 'switcher',
                'value' => 0,
            ),
        );
        return $fields;
    }

    public function getImgSettingsFields()
    {
        $fields = array(
            'xs' => array(
                'display_name' => $this->l('Extra small'),
                'value' => '55*55',
                'regenerate' => 1,
            ),
            's' => array(
                'display_name' => $this->l('Small'),
                'value' => '375*125',
                'regenerate' => 1,
            ),
            'm' => array(
                'display_name' => $this->l('Medium'),
                'value' => '450*450',
                'regenerate' => 1,
            ),
            'l' => array(
                'display_name' => $this->l('Large'),
                'value' => '800*350',
                'regenerate' => 1,
            ),
            'xl' => array(
                'display_name' => $this->l('Extra large'),
                'value' => '1280*520',
                'regenerate' => 1,
            ),
        );
        return $fields;
    }
}
