{*
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
*}
<ul class="mls_slides_ul"> 
    {if isset($slides)&&$slides}           
        {foreach from=$slides item='slide'}
            {Module::getInstanceByName('ets_multilayerslider')->hookDisplayMLSSlide(['slide' => $slide, 'layout' => $mls_layout]) nofilter}
        {/foreach}        
    {/if}
</ul> 
<div class="alert alert-warning msl_no_slides {if $slides}hidden{/if}">{l s='No slide available. Click "Add slide" to add new slides!' mod='ets_multilayerslider'}</div>       