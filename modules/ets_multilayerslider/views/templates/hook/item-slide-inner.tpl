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
<div class="action">
    <span data-title="&#xE14C;" class="mls_slide_delete" title="{l s='Delete this item' mod='ets_multilayerslider'}">{l s='Delete' mod='ets_multilayerslider'}</span>
    <span data-title="&#xE14D;" class="mls_slide_duplicated" title="{l s='Duplicate this slide' mod='ets_multilayerslider'}">{l s='Duplicate' mod='ets_multilayerslider'}</span>    
    <span data-title="&#xE150;" class="mls_slide_edit">{l s='Edit' mod='ets_multilayerslider'}</span>
</div>
<div class="msl_layer_wrapper" data-width="{$sliderWidth|intval}" data-height="{$sliderHeight|intval}" style="position: relative;width:{$sliderWidth|intval}px;height:{$sliderHeight|intval}px;{if $slide.link_img} background-image: url('{$slide.link_img|escape:'html':'UTF-8'}');background-repeat: {if $slide.repeat_x&&$slide.repeat_y}repeat{elseif $slide.repeat_x}repeat-x{elseif $slide.repeat_y}repeat-y{else}no-repeat{/if};{/if}{if $slide.backgroud_color} background-color:{$slide.backgroud_color|escape:'html':'UTF-8'}; {/if}">
    {if isset($slide.layers) && $slide.layers}
        {foreach from=$slide.layers item='layer'}
            {Module::getInstanceByName('ets_multilayerslider')->hookDisplayMLSLayer(['layout' => $mls_layout, 'layer' => $layer]) nofilter}
        {/foreach}
    {/if}
</div>     