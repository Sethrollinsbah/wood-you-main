<?php
/**
* 2017-2027 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2017-2027 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class Colorconfigurator extends Module
{
    protected $config_form = false;
    public $css_path = '';
    public $labels = array();

    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }
        $this->name = 'colorconfigurator';
        $this->tab = 'front_office_features';
        $this->version = '2.0.2';
        $this->author = 'Prestapro';
        $this->need_instance = 1;
        $this->is_17 = Tools::substr(_PS_VERSION_, 0, 3) === '1.7';
        $this->labels = array(
            'color' => $this->l('text'),
            'backcolor' => $this->l('background'),
            'border' => $this->l('border'),
            'box' => $this->l('shadow'),
            'svg' => $this->l('svg'),
            'textshadow' => $this->l('text-shadow'),
        );

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Theme color configurator');
        $this->description = $this->l('Theme color configurator');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->css_path = $this->local_path.'views/css/';
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('COLORCONFIGURATOR_DEMO', true);
        Configuration::updateGlobalValue('COLORCONFIGURATOR_FILE', 'colors.css');

        $uniq_id = uniqid();
        Configuration::updateValue('COLORCONFIGURATOR_UNIQID', $uniq_id);
        $cookie = new Cookie('colorconfigurator');
        $cookie->uniq_id = $uniq_id;

        Configuration::updateGlobalValue('COLORCONFIGURATOR_FRONT_DATA', serialize(array()));
        $data =  Tools::file_get_contents($this->local_path.'config.dat');
        if ($data) {
            Configuration::updateGlobalValue('COLORCONFIGURATOR_BACK_DATA', $data);
            $this->createCss(unserialize($data));
        } else {
            $this->setDefaults();
        }
        return parent::install() &&
        $this->registerHook('header') &&
        $this->registerHook('displayFooter') &&
        $this->registerHook('backOfficeHeader');
    }

    public function setDefaults()
    {
        $props = array(
            'type'=>'backcolor',
            'title'=>'background',
            'class'=>'#header',
            'description'=>'',
            'color'=>'black',
            'prop'=>'black'
        );
        Configuration::updateGlobalValue('COLORCONFIGURATOR_FRONT_DATA', serialize(array()));
        Configuration::updateGlobalValue('COLORCONFIGURATOR_BACK_DATA', serialize(array(
        'colors' => array(
            array(
                'name' => 'header',
                'lines' => array(
                   $props,
                 ),
            ),
        ),
        'settings' => array(
            'frontpanel' => 1,
            'demo' => 1,
            'width' => 'wide',
            'fixedmenu' => 1,
            'borderradius' => 1,
            'boxshadow' => 1,
            'menu_class' => '.header-container',
            'shadow_classes' => '',
            'radius_classes' => '',
            'container_class' => '#page',
            'google_fonts_key' => '',//AIzaSyC1llvNIdtoIPKl7Z91ksJ9yOAwdPvU6dY
        )
        )));
    }

    public function uninstall()
    {
        Configuration::deleteByName('COLORCONFIGURATOR_BACK_DATA');
        Configuration::deleteByName('COLORCONFIGURATOR_FRONT_DATA');
        Configuration::deleteByName('COLORCONFIGURATOR_DEMO');
        Configuration::deleteByName('COLORCONFIGURATOR_UNIQID');
        Configuration::deleteByName('COLORCONFIGURATOR_FILE');
        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {

        $uniq_id = Configuration::get('COLORCONFIGURATOR_UNIQID');
        $cookie = new Cookie('colorconfigurator');
        $cookie->uniq_id = $uniq_id;
        $export_link = $this->context->link->getAdminLink('AdminModules').'&configure='.$this->name;
        $live_link = $this->context->shop->getBaseURL(true);
        $this->context->smarty->assign(array(
          'export_link' => $export_link,
          'import_link' => $this->_path.'config.dat',
          'live_link' => $live_link,
        ));
        $vue_templates = $this->context->smarty->fetch($this->local_path.'views/templates/admin/vue-templates.tpl');
        return $vue_templates.$this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
    }


    public function ajaxProcessSave()
    {
        $data = Tools::getValue('data');
        $success = false;
        if ($data) {
            Configuration::updateGlobalValue('COLORCONFIGURATOR_DEMO', $data['settings']['demo']);
            if (Configuration::updateGlobalValue('COLORCONFIGURATOR_BACK_DATA', serialize($data))) {
                $success = true;
                $this->createCss($this->getData());
                file_put_contents($this->local_path.'config.dat', serialize($data));
            }
        }
        $res = array('success' => $success, 'data'=>$data);
        $json = Tools::jsonEncode($res);
        echo $json;
    }


    public function processExport()
    {
        $uploaded_file = $_FILES['colors_data'];
        $data_file = $this->local_path.'config.dat';
        if (move_uploaded_file($uploaded_file['tmp_name'], $data_file)) {
            $data =  Tools::file_get_contents($data_file);
            if ($data) {
                file_put_contents($this->local_path.'config.dat', $data);
                Configuration::updateGlobalValue('COLORCONFIGURATOR_BACK_DATA', $data);
            }
        }
    }

    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('configure') == $this->name) {
            if (isset($_FILES['colors_data'])) {
                $this->processExport();
            }
            // $this->setDefaults();
            $front_controllers = Dispatcher::getControllers(_PS_FRONT_CONTROLLER_DIR_);
            $front_controllers = array_keys($front_controllers);
            $front_controllers[] = 'everywhere';
            sort($front_controllers);
            $config_data = unserialize(Configuration::get('COLORCONFIGURATOR_BACK_DATA'));
            $token = Tools::getAdminTokenLite('AdminModules');
            $save_link = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name;
            $save_link .= '&tab_module='.$this->tab.'&module_name='.$this->name.'&token='.$token.'&ajax=1&action=save';
            Media::addJSDef(array(
                'configData' => $config_data,
                'saveLink' => $save_link,
                'configLabels' => $this->labels,
                'frontControllers' => $front_controllers,
            ));
            $this->context->controller->addJquery();
            $this->addJS('tinycolor-min.js');
            $this->addJS('vue.min.js');
            $this->addJS('sortable.min.js');
            $this->addJS('lodash.min.js');
            $this->addJS('vuedraggable.min.js');
            $this->addJS('vue-color.min.js');
            $this->addJS('vue-back.js');
            $this->addCSS('back.css');

            $this->context->smarty->assign(
                array(
                   'documentation_link' => $this->_path.'readme_en.pdf',
                )
            );
        }
    }

    public function hookDisplayFooter()
    {
        $data = $this->getData();
        $frontpanel = $data['settings']['frontpanel'];
        $demo = Configuration::get('COLORCONFIGURATOR_DEMO');
        if (!$frontpanel || !($demo || $this->checkID())) {
            return '';
        }
        $vue_templates = $this->context->smarty->fetch($this->local_path.'views/templates/front/vue-templates.tpl');
        return $vue_templates.$this->context->smarty->fetch($this->local_path.'views/templates/front/footer.tpl');
    }

    public function searchFrontValue($props)
    {
        $front_data = unserialize(Configuration::get('COLORCONFIGURATOR_FRONT_DATA'));
        $result = array();
        foreach ($front_data['colors'] as $group) {
            $result = $this->searchFrontValueRecursive($group, $props);
            if (!empty($result)) {
                break;
            }
        }
        return $result;
    }

    public function searchFrontValueRecursive($group, $props)
    {
        if (isset($group['lines'])) {
            foreach ($group['lines'] as $line) {
                if ($line['type'] == $props['type'] && $line['class'] == $props['class']) {
                    $return = array();
                    switch ($line['type']) {
                        case 'width':
                            $return['width'] = $line['width'];
                            break;
                        case 'font':
                            $return['fontfamily'] = $line['fontfamily'];
                            $return['fontsize'] = $line['fontsize'];
                            break;
                        default:
                            $return['color'] = $line['color'];
                            $return['prop'] = $line['prop'];
                    }
                    return $return;
                }
            }
        }
        if (isset($group['sub'])) {
            foreach ($group['sub'] as $group) {
                $result = $this->searchFrontValueRecursive($group, $props);
                if (!empty($result)) {
                    return $result;
                }
            }
        }
        return array();
    }

    public function getData()
    {
        $front_data = unserialize(Configuration::get('COLORCONFIGURATOR_FRONT_DATA'));
        $back_data = unserialize(Configuration::get('COLORCONFIGURATOR_BACK_DATA'));
        if (empty($front_data)) {
            return $back_data;
        }

        foreach ($back_data['colors'] as &$group) {
            $this->assignRecursive($group);
        }
        $gfonts = array();
        if (isset($back_data['settings']['google_fonts'])) {
            $gfonts = $back_data['settings']['google_fonts'];
        }
        if (isset($front_data['settings']['google_fonts'])) {
            $gfonts_front = $front_data['settings']['google_fonts'];
            foreach (array_keys($gfonts) as $class) {
                if (isset($gfonts_front[$class])) {
                    $gfonts[$class] = $gfonts_front[$class];
                }
            }
        }
        $settings = $back_data['settings'];
        $settings['google_fonts'] = $gfonts;
        foreach (array('width','fixedmenu', 'borderradius', 'boxshadow') as $key) {
            $settings[$key] = $front_data['settings'][$key];
        }

        $data = array(
          'colors' => $back_data['colors'],
          'settings' => $settings
        );
        return $data;
    }

    public function assignRecursive(&$group)
    {
        if (isset($group['lines'])) {
            foreach ($group['lines'] as &$line) {
                $names = array('type' => '', 'class' => '', 'title' => '', 'description' => '');
                $props = array_intersect_key($line, $names);
                $values = $this->searchFrontValue($props);
                if (!empty($values)) {
                    $line = array_replace($line, $values);
                }
            }
        }
        if (isset($group['sub'])) {
            foreach ($group['sub'] as &$group) {
                $this->assignRecursive($group);
            }
        }
    }

    public function hookHeader()
    {
        $back_data = unserialize(Configuration::get('COLORCONFIGURATOR_BACK_DATA'));
        $data = $this->getData();
        $data['settings']['php_self'] = $this->context->controller->php_self;
        $demo = Configuration::get('COLORCONFIGURATOR_DEMO');
        $frontpanel = $data['settings']['frontpanel'];
        $colors_file = Configuration::get('COLORCONFIGURATOR_FILE');
        $gfonts = '';
        if (isset($data['settings']['google_fonts'])) {
            $gfonts = join('|', array_values($data['settings']['google_fonts']));
            $gfonts = str_replace(' ', '+', $gfonts);
        }

        if ($gfonts != '') {
            if ($this->is_17) {
                $this->context->controller->registerStylesheet(
                    'modules-colorconfigurator',
                    'https://fonts.googleapis.com/css?family='.$gfonts,
                    array('media' => 'all', 'server' => 'remote')
                );
            } else {
                $this->context->controller->addCSS('https://fonts.googleapis.com/css?family='.$gfonts);
            }
        }
        $params = array('ajax' => '1', 'action' => 'save');
        $url = $this->context->link->getModuleLink($this->name, 'tools', $params);

        $this->addCSS($colors_file);
        if ($frontpanel && ($demo || $this->checkID())) {
            Media::addJSDef(array(
                'colorConfigData' => $data,
                'backColorConfigData' => $back_data,
                'colorSave' => $url,
            ));
            $this->context->controller->addJquery();
            $this->addJS('tinycolor-min.js');
            $this->addCSS('front.css');
            $this->addJS('vue.min.js');
            $this->addJS('webfont.js');
            $this->addJS('vue-color.min.js');
            $this->addJS('vue-front.js');
            $this->addJS('front.js');
        }
    }

    public function createCss($data)
    {
        $old_file = $this->css_path.Configuration::get('COLORCONFIGURATOR_FILE');
        if (file_exists($old_file)) {
            unlink($old_file);
        }

        $file_name = 'colors'.uniqid(rand(), true) . '.css';
        Configuration::updateGlobalValue('COLORCONFIGURATOR_FILE', $file_name);
        $this->css = '';

        foreach ($data['colors'] as $group) {
            $this->walkRecursive($group);
        }

        $settings = $data['settings'];

        $menu_class = $settings['menu_class'];
        if ($menu_class != '') {
            if ($data['settings']['fixedmenu']) {
                $this->css.= $menu_class.'{ position: -webkit-sticky; position: -moz-sticky; ';
                $this->css.= 'position: -ms-sticky; position: -o-sticky; position: sticky; } ';
            } else {
                $this->css.= $menu_class.'{ position: relative; } ';
            }
        }

        if ($settings['radius_classes'] != '' && $data['settings']['borderradius'] == '0') {
            $this->css.= $settings['radius_classes'].'{ border-radius: 0px; } ';
        }

        if ($settings['shadow_classes'] != '' && $data['settings']['boxshadow'] == '0') {
            $this->css.= $settings['shadow_classes'].'{ box-shadow: none; } ';
        }

        if ($settings['width'] == 'wide') {
            $this->css.= $settings['container_class'].'{ max-width: 100%; } ';
        } else {
            $this->css.= $settings['container_class'].'{ max-width: 1200px; margin: auto; } ';
        }
        file_put_contents($this->css_path.$file_name, $this->css);
    }

    public function walkRecursive($group)
    {
        $props = array(
            'color' => 'color',
            'backcolor' => 'background-color',
            'border' => 'border-color',
            'box' => 'box-shadow',
            'svg' => 'fill',
            'textshadow' => 'text-shadow'
        );
        if (isset($group['lines'])) {
            foreach ($group['lines'] as $line) {
                if (in_array($line['type'], array_keys($props))) {
                    $prop = $line['prop'];
                    if ($prop != '') {
                        $add_prop = '';

                        //add alex
                        if ($line['type'] == 'textshadow') {
                            $add_prop = $line['h_shadow'].' '.$line['v_shadow'].' '.$line['blur_radius'].' ';
                        }
                        // ! add alex
                        $this->css.= $line['class'].'{'.$props[$line['type']].': '.$add_prop.$prop.'} ';
                    }
                }
                if ($line['type'] == 'width') {
                    $this->css.= $line['class'].'{padding-right: 15px; padding-left: 15px; margin-right: auto;';
                    $this->css.= $line['class'].' margin-left: auto;} ';
                    $this->css.= $line['class'].':after{clear:both} ';
                    if ($line['width'] == 'container') {
                        $this->css.= '@media (min-width: 768px) {'.$line['class'].'{width: 750px;}} ';
                        $this->css.= '@media (min-width: 992px) {'.$line['class'].'{width: 970px;}} ';
                        $this->css.= '@media (min-width: 1200px) {'.$line['class'].'{width: 1170px;}} ';
                        $this->css.= $line['class'].':before'.$line['class'].':after{display: table; content: " ";} ';
                        $this->css.= $line['class'].':after{display: table; content: " ";} ';
                    }
                }
                if ($line['type'] == 'font') {
                    $font = $line['fontfamily'];
                    $size = $line['fontsize'];
                    if ($font != '') {
                        $this->css.= $line['class'].'{ font-family: '.$font.'} ';
                    }
                    if ($size != '') {
                        $this->css.= $line['class'].'{ font-size: '.$size.'} ';
                    }
                }
            }
        }
        if (isset($group['sub'])) {
            foreach ($group['sub'] as $sub) {
                $this->walkRecursive($sub);
            }
        }
    }

    protected function checkID()
    {
        $uniq_id = Configuration::get('COLORCONFIGURATOR_UNIQID');
        $cookie = new Cookie('colorconfigurator');
        $cookie_id = $cookie->uniq_id;
        return ($cookie_id && $uniq_id == $cookie_id);
    }

    public function addJS($file)
    {
        $path = 'modules/'.$this->name.'/views/js/'.$file;
        $path =  __PS_BASE_URI__.$path;
        $this->context->controller->addJS($path);
    }

    public function addCSS($file, $media = 'all')
    {
        $path = 'modules/'.$this->name.'/views/css/'.$file;
        $path = __PS_BASE_URI__.$path;
        $this->context->controller->addCSS($path, $media);
    }
}
