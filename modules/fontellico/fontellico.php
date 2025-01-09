<?php
/**
* 2007-2018 Andrey & co
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author    Andrey <byalonovich@bk.ru>
*  @copyright 2015-2020 Andrey & co
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

class Fontellico extends Module
{
    public $errors;
    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit;
        }
        $this->name = 'fontellico';
        $this->tab = 'front_office_features';
        $this->version = '1.1.0';
        $this->author = 'Andrey';
        $this->bootstrap = true;
        $this->ajax = true;
        parent::__construct();
        $this->errors = array();
        $this->displayName = $this->l('Fontellico');
        $this->description = $this->l('Fontello icons');
    }

    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('backOfficeHeader')
        ) {
            return false;
        }
        if (!file_exists(dirname(__FILE__).'/views/font')) {
            mkdir(dirname(__FILE__).'/views/font', 0777, true);
        }

        $this->setDefaults();

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()
        ) {
            return false;
        }
        Configuration::deleteByName('FONTELLICO_CUSTOM_CLASSES');
        return true;
    }

    public function getContent()
    {
        if (Tools::isSubmit('upload_file_request') && !empty($_FILES)) {
            $this->uploadProcess();
        }
        if (Tools::isSubmit('saveconfig')) {
            $this->downloadProcess();
        }
        if (Tools::getValue('reset_request')) {
            $current = dirname(__FILE__).'/config.json';
            $backup =  dirname(__FILE__).'/configback.json';
            Tools::copy($backup, $current);
            $this->fontelloProcess();
            $this->setCssFont();
        }
        return $this->renderForm();
    }

    public function setDefaults()
    {
        if (file_exists($this->local_path.'config.zip')) {
            if (!file_exists($this->local_path.'tmp')) {
                mkdir($this->local_path.'tmp', 0777, true);
            }
            $zip_file = $this->local_path.'config.zip';
            $exctracted_contents_dir = $this->local_path.'tmp/';
            if (!Tools::ZipExtract($zip_file, $exctracted_contents_dir)) {
                $this->errors[] = $this->displayError($this->l('An error occured while unzipping archive'));
                return;
            }
            $custom_classes_file = Tools::file_get_contents($exctracted_contents_dir.'custom_classes.bin');
            $custom_classes = unserialize($custom_classes_file);
            $config_path = $exctracted_contents_dir.'config.json';
            Configuration::updateValue('FONTELLICO_CUSTOM_CLASSES', $custom_classes);
            Tools::copy($config_path, dirname(__FILE__).'/config.json');

            $this->fontelloProcess();
            if (empty($this->errors)) {
                $this->setCssFont();
                $this->updateCustomCss();
                return;
            }
        }
    }

    public function uploadProcess()
    {
        if (!file_exists($this->local_path.'tmp')) {
            mkdir($this->local_path.'tmp', 0777, true);
        }
        $tmp_zip_file = $this->local_path.'tmp/uploaded.zip';
        $tmp_config_file = $this->local_path.'tmp/config.json';

        if (!isset($_FILES['zipped_config_data'])) {
            $this->errors[] = $this->displayError($this->l('File not uploaded'));
            return;
        }
        $uploaded_file = $_FILES['zipped_config_data'];

        /* $type = $uploaded_file['type'];
        $accepted_types = array(
            'application/zip',
            'application/x-zip-compressed',
            'multipart/x-zip',
            'application/x-compressed'); */

        if (!move_uploaded_file($uploaded_file['tmp_name'], $tmp_zip_file)) {
            $this->errors[] = $this->displayError($this->l('File not uploaded'));
            return;
        }

        if (!Tools::ZipTest($tmp_zip_file)) {
            if (!move_uploaded_file($uploaded_file['tmp_name'], $tmp_config_file)) {
                $this->errors[] = $this->displayError($this->l('File not uploaded'));
                return;
            }
            $new_json =  Tools::file_get_contents($tmp_config_file);
            $new_data = Tools::jsonDecode($new_json, true);
            if (!empty($new_data) && !empty($new_data['glyphs']) && !empty($new_data['css_prefix_text'])) {
                if (Tools::isSubmit('add-to-config')) {
                    $old_json = Tools::file_get_contents(dirname(__FILE__).'/config.json');
                    $old_data = Tools::jsonDecode($old_json, true);
                    /* Add icons that different. If code same increase until different */
                    $old_uid = array();
                    $old_code = array();
                    foreach ($old_data['glyphs'] as $old_glyphs) {
                        $old_uid[] = $old_glyphs['uid'];
                        $old_code[] = $old_glyphs['code'];
                    }
                    foreach ($new_data['glyphs'] as $new_glyphs) {
                        while (in_array($new_glyphs['code'], $old_code)) {
                            $new_glyphs['code']++;
                        }
                        $old_code[] = $new_glyphs['code'];
                        if (!in_array($new_glyphs['uid'], $old_uid)) {
                            $old_data['glyphs'][] = $new_glyphs;
                        }
                    }
                    $json = Tools::jsonEncode($old_data);
                    file_put_contents(dirname(__FILE__).'/config.json', $json);
                } else {
                    Tools::copy($tmp_config_file, dirname(__FILE__).'/config.json');
                }
                $this->fontelloProcess();
                if (empty($this->errors)) {
                    $this->setCssFont();
                    return;
                }
            } else {
                $this->errors[] = $this->l('Error in uploaded config file');
                return;
            }
        } else {
              $exctracted_contents_dir = $this->local_path.'tmp/uploaded_extracted/';
            if (!Tools::ZipExtract($tmp_zip_file, $exctracted_contents_dir)) {
                  $this->errors[] = $this->displayError($this->l('An error occured while unzipping archive'));
                  return;
            }

              $custom_classes = Tools::file_get_contents($exctracted_contents_dir.'custom_classes.bin');

            if (Tools::isSubmit('add-to-config')) {
                $custom_classes_old = unserialize(Configuration::get('FONTELLICO_CUSTOM_CLASSES'));
                $custom_classes_new = unserialize(unserialize($custom_classes));
                if (is_array($custom_classes_new)) {
                    Configuration::updateValue(
                        'FONTELLICO_CUSTOM_CLASSES',
                        serialize(array_merge($custom_classes_old, $custom_classes_new))
                    );
                }
            } else {
                Configuration::updateValue('FONTELLICO_CUSTOM_CLASSES', unserialize($custom_classes));
            }

              $config_path = $exctracted_contents_dir.'config.json';
              $new_json =  Tools::file_get_contents($config_path);
              $new_data = Tools::jsonDecode($new_json, true);
            if (!empty($new_data) && !empty($new_data['glyphs']) && !empty($new_data['css_prefix_text'])) {
                if (Tools::isSubmit('add-to-config')) {
                    $old_json = Tools::file_get_contents(dirname(__FILE__).'/config.json');
                    $old_data = Tools::jsonDecode($old_json, true);
                    /* Add icons that different */
                    foreach ($new_data['glyphs'] as $new_glyphs) {
                        $in_array = false;
                        foreach ($old_data['glyphs'] as $old_glyphs) {
                            if ($old_glyphs['uid'] == $new_glyphs['uid']) {
                                $in_array = true;
                            }
                        }
                        if (!$in_array) {
                            $old_data['glyphs'][] = $new_glyphs;
                        }
                    }
                    $json = Tools::jsonEncode($old_data);
                    file_put_contents(dirname(__FILE__).'/config.json', $json);
                } else {
                    Tools::copy($config_path, dirname(__FILE__).'/config.json');
                }

                $this->fontelloProcess();
                if (empty($this->errors)) {
                    $this->setCssFont();
                    $this->updateCustomCss();
                    return;
                }
            } else {
                $this->errors[] = $this->l('Error in uploaded config file');
                return;
            }
        }
    }

    public function downloadProcess()
    {
        $custom_classes = Configuration::get('FONTELLICO_CUSTOM_CLASSES');
        $zip = new ZipArchive();
        $zip->open($this->local_path.'config.zip', ZipArchive::OVERWRITE);
        $zip->addFromString('custom_classes.bin', serialize($custom_classes));
        $zip->addFile(dirname(__FILE__).'/config.json', 'config.json');
        $zip->close();
    }

    public function setCssFont()
    {
        Tools::ZipExtract(dirname(__FILE__)."/fontello.zip", dirname(__FILE__).'/tmp');

        foreach (glob(dirname(__FILE__) . '/tmp/fontello-*/*', GLOB_NOSORT) as $file) {
            if (Tools::substr($file, -Tools::strlen('config.json')) === 'config.json') {
                rename($file, dirname(__FILE__) . '/config.json');
            }
            if (Tools::substr($file, -Tools::strlen('font')) === 'font') {
                rename($file.'/fontello.eot', dirname(__FILE__) . '/views/font/fontello.eot');
                rename($file.'/fontello.svg', dirname(__FILE__) . '/views/font/fontello.svg');
                rename($file.'/fontello.woff', dirname(__FILE__) . '/views/font/fontello.woff');
                rename($file.'/fontello.woff2', dirname(__FILE__) . '/views/font/fontello.woff2');
                rename($file.'/fontello.ttf', dirname(__FILE__) . '/views/font/fontello.ttf');
            }
            if (Tools::substr($file, -Tools::strlen('css')) === 'css') {
                rename($file.'/fontello.css', dirname(__FILE__) . '/views/css/fontello.css');
            }
        }

        Tools::deleteDirectory(dirname(__FILE__) . '/tmp');
    }

    public function fontelloProcess()
    {
        $filename =  _PS_ROOT_DIR_.'/modules/'. Tools::safeOutput($this->name).'/config.json';
        $type = 'text/json';
        $postname = 'config.json';
        if (function_exists('curl_file_create')) {
            $config = new CURLFile($filename, $type, $postname);
        } else {
            $config = "@{$filename};filename=" . $postname . ';type=' . $type;
        }
        $curlRequest = curl_init();

        curl_setopt($curlRequest, CURLOPT_URL, 'http://fontello.com/');
        curl_setopt($curlRequest, CURLOPT_POST, true);
        curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlRequest, CURLOPT_POSTFIELDS, array(
            'config' => $config,
        ));
        $response = curl_exec($curlRequest);
        file_put_contents(
            dirname(__FILE__)."/fontello.zip",
            Tools::file_get_contents("http://fontello.com/".$response."/get", false, null, 100)
        );
        //Tools::copy("http://fontello.com/".$response."/get", dirname(__FILE__)."/fontello.zip");
        if (filesize(dirname(__FILE__)."/fontello.zip") == 0) {
            $this->errors[] = $this->l("Error ").$response;
        }
    }

    public function ajaxProcessSave()
    {
        $custom_classes = Tools::getValue('custom_classes');
        Configuration::updateValue('FONTELLICO_CUSTOM_CLASSES', serialize($custom_classes));
        $data = Tools::jsonDecode(Tools::getValue('data'), true);
        if ($data) {
            if (empty($data['glyphs'])) {
                $this->errors[]  = $this->l("You have to add icons before save");
            } else {
                $data['css_use_suffix'] = false;
                $data['hinting'] = true;
                $string = Tools::jsonEncode($data);
                $pattern = '/"(\d+\.*\d*)"/i';
                $replacement = '$1';
                $json = preg_replace($pattern, $replacement, $string);
                $json = preg_replace('/"true"/i', 'true', $json);

                file_put_contents(dirname(__FILE__).'/config.json', $json);
                $this->fontelloProcess();
            }
            $response = '';

            if (empty($this->errors)) {
                $this->setCssFont();
                $response = $this->displayConfirmation($this->l("Icons saved")).$this->renderForm();
                echo $response;
            } else {
                echo $this->renderForm();
            }
        }
        $this->downloadProcess();
        $this->updateCustomCss();
    }

    public function renderForm()
    {
        $error_html = '';
        if (!empty($this->errors)) {
            foreach ($this->errors as $error) {
                $error_html.= $this->displayError($error);
            }
        }
        $fontello_config = Tools::jsonDecode(Tools::file_get_contents(dirname(__FILE__).'/config.json'), true);
        $fontello_config_all = Tools::jsonDecode(Tools::file_get_contents(dirname(__FILE__).'/configall.json'), true);
        $prefix = $fontello_config['css_prefix_text'];
        $icons = $fontello_config['glyphs'];
        $iconsall = $fontello_config_all['glyphs'];
        foreach ($icons as $key => $icon) {
            $icons[$key]['code'] = dechex($icon['code']);
        }
        // $admin_url = $_SERVER['REQUEST_URI'];
        // $admin_url = Tools::substr($admin_url, 0, strpos($admin_url, 'index.php'));
        // $admin_url = Tools::getHttpHost(true).$admin_url;
        $admin_url = $this->context->link->getAdminLink('AdminModules').'&configure='.$this->name;
        $ajax_url = $admin_url.'&ajax=true&action=save';
        $download_url = Tools::getProtocol(Tools::usingSecureMode()).$_SERVER['HTTP_HOST'];
        $download_url.= $this->getPathUri().'config.zip';
        $custom_classes = unserialize(Configuration::get('FONTELLICO_CUSTOM_CLASSES'));
        $this->smarty->assign(array(
            'custom_classes' => $custom_classes,
            'prefix'    => $prefix,
            'icons'     => $icons,
            'iconsall'  => $iconsall,
            'module_url' => $admin_url,
            'ajax_url'  => $ajax_url,
            'upload_form_url' => $this->context->link->getAdminLink('AdminModules').'&configure='.$this->name,
            'download_url' => $download_url,
        ));

        $this->context->controller->modals[] = array(
            'modal_id' => 'modal_available_icons',
            'modal_class' => 'modal-lg',
            'modal_title' => $this->l('Available icons'),
            'modal_content' => $this->display(__FILE__, 'views/templates/admin/popup.tpl'),
        );

        $this->context->controller->modals[] = array(
            'modal_id' => 'modal_custom_classes_select',
            'modal_class' => 'modal-lg',
            'modal_title' => $this->l('Select icon to change class'),
            'modal_content' => $this->display(__FILE__, 'views/templates/admin/custom_classes_select.tpl'),
        );

        return $error_html.$this->display(__FILE__, 'views/templates/admin/admin.tpl');
    }

    public function updateCustomCss()
    {
        $fontello_config = Tools::jsonDecode(Tools::file_get_contents(dirname(__FILE__).'/config.json'), true);
        $icons = $fontello_config['glyphs'];
        $custom_classes = unserialize(Configuration::get('FONTELLICO_CUSTOM_CLASSES'));
        $css = '';
        if (!empty($custom_classes)) {
            foreach ($icons as $icon) {
                foreach ($custom_classes as $class) {
                    if ($icon['uid'] == $class['uid']) {
                        if (!empty($class['custom_class'])) {
                            $css.=$class['custom_class'].'{ font-family: "';
                            $css.=$fontello_config['name'].'"; content:"\\'.dechex($icon['code']).'";} ';
                        }
                    }
                }
            }
        }
        file_put_contents(dirname(__FILE__).'/views/css/fontello-custom.css', $css);
    }

    public function hookDisplayHeader($params)
    {
        $this->context->controller->addCSS(($this->_path).'views/css/fontello.css', 'all');
        $this->context->controller->addCSS(($this->_path).'views/css/fontello-custom.css', 'all');
    }
    public function hookBackOfficeHeader($params)
    {
        if (Tools::getValue('configure') == $this->name) {
            $this->context->controller->addJquery();
            $this->context->controller->addJS($this->_path.'views/js/admin.js');
            $this->context->controller->addCSS(($this->_path).'views/css/fontelloall.css', 'all');
            $this->context->controller->addCSS(($this->_path).'views/css/icon.css', 'all');
        }
        $this->context->controller->addCSS(($this->_path).'views/css/fontello.css', 'all');
    }
}
