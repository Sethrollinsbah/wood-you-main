<?php
if (!defined('_PS_VERSION_')) { exit; }
class Cart extends CartCore
{
    /*
    * module: ets_onepagecheckout
    * date: 2024-01-20 07:06:13
    * version: 2.7.3
    */
    public function getPackageList($flush = false)
    {
        if(($address_type =  Tools::getValue('address_type')) && $address_type=='shipping_address')
            $this->id_address_delivery = (int)Tools::getValue('id_address',$this->id_address_delivery);
        return parent::getPackageList($flush);
    }
    /*
    * module: ets_onepagecheckout
    * date: 2024-01-20 07:06:13
    * version: 2.7.3
    */
    public function getPackageShippingCost($id_carrier = null, $use_tax = true, Country $default_country = null, $product_list = null, $id_zone = null, bool $keepOrderPrices = false)
    {
        if($IDzone = (int)Hook::exec('actionGetIDZoneByAddressID'))
        {
            $id_zone = $IDzone;
        }
        
        return parent::getPackageShippingCost($id_carrier,$use_tax,$default_country,$product_list,$id_zone, $keepOrderPrices);
    }
}