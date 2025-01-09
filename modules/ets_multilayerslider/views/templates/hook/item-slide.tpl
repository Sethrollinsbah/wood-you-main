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
{if isset($slide) && $slide}    
    <li class="mls_slides_li item{$slide.id_slide|intval} {if !$slide.enabled}mls_disabled{/if}" data-id-slide="{$slide.id_slide|intval}" data-obj="slide">
         <span class="title-silde" ><span>{if $slide.title}{$slide.title|escape:'html':'UTF-8'}{else}{$slide.id_slide|intval}{/if}</span></span>
         <div class="slide-content">
             <div class="left-block col-lg-9" >
                <div class="left-content">
                  {Module::getInstanceByName('ets_multilayerslider')->hookDisplayMLSSlideInner(['slide' => $slide, 'layout' => $mls_layout]) nofilter}
                </div>
             </div>
             <div class="right-block col-lg-3">
                <h2 data-title="&#xE3C4;">{l s='Layers' mod='ets_multilayerslider'}</h2>
                <div data-title="&#xE145;" class="mls_add_layer btn btn-default" data-id-slide="{$slide.id_slide|intval}">{l s='Add new layer' mod='ets_multilayerslider'}</div>
                <ul id="layers_slide{$slide.id_slide|intval}" class="mls_layers_ul">
                    {if isset($slide.layers) && $slide.layers}
                        {foreach from=$slide.layers item='layer'}
                          {Module::getInstanceByName('ets_multilayerslider')->hookDisplayMLSLayerSort(['layer' => $layer]) nofilter}
                        {/foreach}
                    {/if}
                </ul>
             </div>
         </div>
    </li>
{/if}