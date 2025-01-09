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

include_once(dirname(dirname(dirname(__FILE__))).'/sql/ContactBoxPlusModel.php');
class ContactBoxPlusContactModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function displayAjaxContactForm()
    {
        $result = true;
        $errors = array();


        $product_name = Tools::getValue('product_name');
        $id_product = Tools::getValue('id_product');
        $ref_product = Tools::getValue('cbp_ref_product');
        $product_url = Tools::getValue('product_url');

        $customer_name = $this->module->l("Customer", 'contact');
        $customer_mail = null;

        $fields = ContactBoxPlusModel::getCBPFields(true);

        $file_attachments = array();

        foreach ($fields as $field) {
            if ($field['type'] == 'file') {
                $submittedField = Tools::fileAttachment('field_'.$field['id_cbp_field']);
                if ($submittedField) {
                    $max_filesize = $this->fileUploadMaxSize();

                    if ($submittedField['size'] > $max_filesize) {
                        $errors[] = $this->module->l('The file is too large', 'contact');
                    }

                    $allowed_extensions = array_map('strtolower', array_map('trim', explode(' ', $field['allowedextensions'])));

                    $file_ext = Tools::strtolower(pathinfo($submittedField['name'], PATHINFO_EXTENSION));
                    if (empty($allowed_extensions[0]) || in_array($file_ext, $allowed_extensions)) {
                        array_push($file_attachments, $submittedField);
                    } else {
                        $errors[] = $this->module->l('The extension ', 'contact').
                        ' <b>'.$file_ext.
                        '</b> '.$this->module->l(' is not allowed', 'contact').
                        '. '.$this->module->l('Allowed extensions are', 'contact').': <b>'. $field['allowedextensions'].'</b>';
                    }
                }
            } else {
                $submittedField = Tools::getValue('field_'.$field['id_cbp_field']);
                if (is_array($submittedField)) {
                    $submittedField = implode('; ', $submittedField);
                }
            }

            if ($field['required'] == 1 && !$submittedField) {
                $errors[] = $this->module->l('The field ', 'contact').
                    ' <b>'.$field['label'].
                    '</b> '.$this->module->l(' cannot be blank', 'contact');
            }

            $v = $field['validation'];
            if (($submittedField && ($field['type'] == 'text' || $field['type'] == 'textarea')) && (
                    ($v == 'isName' && !Validate::isName($submittedField)) ||
                    ($v == 'isGenericName' && !Validate::isGenericName($submittedField)) ||
                    ($v == 'isEmail' && !Validate::isEmail($submittedField)) ||
                    ($v == 'isPhoneNumber' && !Validate::isPhoneNumber($submittedField)) ||
                    ($v == 'isMessage' && !Validate::isMessage($submittedField)) ||
                    ($v == 'isPostCode' && !Validate::isPostCode($submittedField)) ||
                    ($v == 'isCityName' && !Validate::isCityName($submittedField)) ||
                    ($v == 'isPasswd' && !Validate::isPasswd($submittedField)) ||
                    ($v == 'isAddress' && !Validate::isAddress($submittedField)))
            ) {
                $errors[] = $this->module->l('The field ', 'contact').
                    ' <b>'.$field['label'].'</b> '.$this->module->l(' is not valid', 'contact');
            }

            if ($submittedField && $field['iscustomername'] == 1) {
                $customer_name = $submittedField;
            } else {
                if ($submittedField && $field['iscustomeremail'] == 1 && Validate::isEmail($submittedField)) {
                    $customer_mail = $submittedField;
                }
            }
        }

        $recaptcha_enabled = (int)Configuration::get('CBOXPLUS_RECAPTCHA_ENABLED');


        if (!count($errors) && $recaptcha_enabled) {
            $captcha=Tools::getValue('g-recaptcha-response');
            if (!$captcha) {
                $errors[] = $this->module->l('Please fill in the captcha', 'contact');
            } else {
                $secretKey = Configuration::get('CBOXPLUS_RECAPTCHA_SECRET_KEY');

                $ip = $_SERVER['REMOTE_ADDR'];
                // for dev only : place here your public IP
                //$ip = '';
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip;
                $response=Tools::file_get_contents($url);
                $responseKeys = Tools::jsonDecode($response, true);
                if ((int)$responseKeys["success"] !== 1) {
                    $errors[] = $this->module->l('Sorry, the captcha verification failed. Please contact the site owner.', 'contact');
                }
            }
        }

        $gdpr_enabled = (int)Configuration::get('CBOXPLUS_DISPLAY_GDPR_CONSENT');
        if ($gdpr_enabled) {
            $consent=Tools::getValue('gdpr_consent');
            if (!$consent=="consented") {
                $errors[] = $this->module->l('Please accept the privacy policy', 'contact');
            }
        }


        if (!count($errors)) {
            $fields_txt = "";
            $fields_html = "";
            foreach ($fields as $field) {
                if ($field['type'] != 'file') {
                    $label = $field['label'];
                    $value = Tools::getValue('field_'.$field['id_cbp_field']);
                    if (is_array($value)) {
                        $value = implode('; ', $value);
                    }

                    if ($value) {
                        $fields_html .= '<span style="color:#333"><strong>'.$label.': </strong></span>'.$value.'<br />';
                    }
                    $fields_txt .= $label.': '.$value.'\r';
                }
            }


            $var_list = array(
                '{product_name}' => Tools::nl2br(Tools::stripslashes($product_name)),
                '{product_url}' => Tools::nl2br(Tools::stripslashes($product_url)),
                '{id_product}' => Tools::nl2br(Tools::stripslashes($id_product)),
                '{ref_product}' => Tools::nl2br(Tools::stripslashes($ref_product)),
                '{custom_fields}' => Tools::nl2br(Tools::stripslashes($fields_html)),
                '{custom_fields_txt}' => Tools::nl2br(Tools::stripslashes($fields_txt))
            );


            $recipients = Configuration::get('CBOXPLUS_SELLER_EMAIL');
            $recipients = array_map('trim', (explode(",", $recipients)));

            $shop_name = Configuration::get('PS_SHOP_NAME');
            $shop_email = Configuration::get('PS_SHOP_EMAIL');
            $send_confirmation = (int)Configuration::get('CBOXPLUS_SEND_CONFIRMATION');

            $impersonate_client_email = (int)Configuration::get('CBOXPLUS_IMPERSONATE_CLIENT_EMAIL');
            if ($impersonate_client_email) {
                $sender_address_from = $customer_mail;
                $customer_name_from = $customer_name;
            } else {
                $sender_address_from = $shop_email;
                $customer_name_from = $customer_name.' ['.$customer_mail.']';
            }
              $mail_sent_to_seller = Mail::Send(
                  $this->context->language->id,
                  'message_contactbox',
                  sprintf($this->module->l('Message from product page', 'contact')),
                  $var_list,
                  $recipients,
                  null,
                  $sender_address_from,
                  $customer_name_from,
                  $file_attachments,
                  null,
                  $this->module->getLocalPath().'mails/'
              );

            if ($send_confirmation && Validate::isEmail($customer_mail)) {
                $mail_sent_to_customer = Mail::Send(
                    $this->context->language->id,
                    'message_sent_confirmation',
                    sprintf($this->module->l('Your message has been correctly sent', 'contact')),
                    $var_list,
                    $customer_mail,
                    $customer_name,
                    $shop_email,
                    $shop_name,
                    null,
                    null,
                    $this->module->getLocalPath().'mails/'
                );
            }


            if (!$mail_sent_to_seller) {
                $errors[] = $this->module->l('An error occurred while sending the message.', 'contact');
                $result = false;
            } else {
                $result = true;
            }
        } else {
            $result = false;
        }

        die(Tools::jsonEncode(array(
            'result' => $result,
            'errors' => $errors
        )));
    }

    // Returns a file size limit in bytes based on the PHP upload_max_filesize
    // and post_max_size
    private function fileUploadMaxSize()
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = $this->parseSize(ini_get('post_max_size'));
            if ($post_max_size > 0) {
                $max_size = $post_max_size;
            }

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = $this->parseSize(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        return $max_size;
    }

    private function parseSize($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else {
            return round($size);
        }
    }
}
