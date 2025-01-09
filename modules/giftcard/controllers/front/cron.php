<?php
/**
 * Google Merchant Center
 *
 * @author    BusinessTech.fr - https://www.businesstech.fr
 * @copyright Business Tech - https://www.businesstech.fr
 * @license   Commercial
 *
 *           ____    _______
 *          |  _ \  |__   __|
 *          | |_) |    | |
 *          |  _ <     | |
 *          | |_) |    | |
 *          |____/     |_|
 */

class GiftCardCronModuleFrontController extends ModuleFrontController
{
    /**
     * method manage post data
     *
     * @throws Exception
     * @return bool
     */
    public function postProcess()
    {
        // get the token
        $this->module->accesslog = $this->module->accessLogsDirectory();
        if ($token = Tools::getValue('token')) {
            if (trim($token) == trim(Configuration::get('GIFTCARD_TOKEN'))) {
                if (((int) date('Ymd') > (int) Configuration::get('GIFTCARD_BATCHLASTDATE'))) {
                    Configuration::updateValue('GIFTCARD_BATCHLASTDATE', (int) date('Ymd'));
                    $this->module->sendPendingMailRecipient();
                    if ((int) Configuration::get('GIFTCARD_TRIGGERWEB') == 0) {
                        die('Gift card launched');
                    }
                } else {
                    $this->module->loglongline('The date ' . (int) date('Ymd') . ' is every worked');
                    if ((int) Configuration::get('GIFTCARD_TRIGGERWEB') == 0) {
                        die('The date ' . (int) date('Ymd') . ' is every worked');
                    }
                }
            } else {
                die($this->module->l('Internal server error! (security error)', 'cron'));
            }
        } else {
            $this->module->loglongline('Token is required');
            if ((int) Configuration::get('GIFTCARD_TRIGGERWEB') == 0) {
                die('Token is required');
            }
        }
        /* generate empty picture http://www.nexen.net/articles/dossier/16997-une_image_vide_sans_gd.php */
        if ((int) Configuration::get('GIFTCARD_TRIGGERWEB') == 1) {
            $hex = '47494638396101000100800000ffffff00000021f90401000000002c00000000010001000002024401003b';
            $img = '';
            $t = Tools::strlen($hex) / 2;
            for ($i = 0; $i < $t; $i ++) {
                $img .= chr(hexdec(Tools::substr($hex, $i * 2, 2)));
            }
            header('Last-Modified: Fri, 01 Jan 1999 00:00 GMT', true, 200);
            header('Content-Length: ' . Tools::strlen($img));
            header('Content-Type: image/gif');
            echo $img;
        } else {
            die('OK');
        }
    }
}
