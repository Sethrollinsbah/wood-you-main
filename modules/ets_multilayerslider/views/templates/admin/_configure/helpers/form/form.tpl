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
{extends file="helpers/form/form.tpl"}
{block name="input"}
    {if $input.type == 'checkbox'}
            {if isset($input.values.query) && $input.values.query}
                {foreach $input.values.query as $value}
    				{assign var=id_checkbox value=$input.name|cat:'_'|cat:$value[$input.values.id]|escape:'html':'UTF-8'}
    				<div class="checkbox{if isset($input.expand) && strtolower($input.expand.default) == 'show'} hidden{/if}">
    					{strip}
    						<label for="{$id_checkbox|escape:'html':'UTF-8'}">                                
    							<input type="checkbox" name="{$input.name|escape:'html':'UTF-8'}[]" id="{$id_checkbox|escape:'html':'UTF-8'}" {if isset($value.value)} value="{$value.value|escape:'html':'UTF-8'}"{/if}{if isset($fields_value[$input.name]) && is_array($fields_value[$input.name]) && $fields_value[$input.name] && in_array($value.value,$fields_value[$input.name])} checked="checked"{/if} />
    							{$value[$input.values.name]|escape:'html':'UTF-8'}
    						</label>
    					{/strip}
    				</div>
    			{/foreach} 
            {/if} 
    {else}
        {$smarty.block.parent}   
        {if $input.name=='animation_in' || $input.name=='animation_out'}
            <div class="mls_sample_effect">{l s='Sample animation effect' mod='ets_multilayerslider'}</div>
        {/if}         
    {/if}            
{/block}
{block name="field"}
    {if $input.name}
        {$smarty.block.parent}
    	{if $input.type == 'file' &&  isset($input.display_img) && $input.display_img}
            <label class="control-label col-lg-3 uploaded_image_label" style="font-style: italic;">{l s='Uploaded image: ' mod='ets_multilayerslider'}</label>
            <div class="col-lg-9 uploaded_img_wrapper">
        		<img title="{l s='Click to see full size image' mod='ets_multilayerslider'}" style="display: inline-block; max-width: 200px;" src="{$input.display_img|escape:'html':'UTF-8'}" />
                {if (!isset($input.hide_delete) || isset($input.hide_delete) && !$input.hide_delete) && isset($input.img_del_link) && $input.img_del_link && !(isset($input.required) && $input.required)}
                    <a class="delete_url" style="display: inline-block; text-decoration: none!important;" href="{$input.img_del_link|escape:'html':'UTF-8'}"><span style="color: #666"><i style="font-size: 20px;" class="process-icon-delete" data-title="&#xE872;"></i></span></a>
                {/if}
            </div>        
        {/if}    
    {/if}
{/block}

{block name="footer"}
    {capture name='form_submit_btn'}{counter name='form_submit_btn'}{/capture}      
	{if isset($fieldset['form']['submit']) || isset($fieldset['form']['buttons'])}
		<div class="panel-footer">
            {if isset($cancel_url) && $cancel_url}
                <a class="btn btn-default" href="{$cancel_url|escape:'html':'UTF-8'}"><i class="process-icon-cancel"></i>{l s='Back'  mod='ets_multilayerslider'}</a>
            {/if}
            {if isset($fieldset['form']['submit']) && !empty($fieldset['form']['submit'])}
            <div class="img_loading_wrapper hidden">
                <img src="{$image_baseurl|escape:'html':'UTF-8'}ajax-loader.gif" title="{l s='Loading' mod='ets_multilayerslider'}" class="ybc_blog_loading" />
            </div>
            <input type="hidden" name="mls_object" value="{$mls_object|escape:'html':'UTF-8'}" />
            {if isset($list_item) && $list_item}
                <input type="hidden" name="itemId" value="{$item_id|intval}" />
                <input type="hidden" name="mls_form_submitted" value="1" />
            {else}
                <input type="hidden" name="mls_config_submitted" value="1" />
            {/if}
            <div class="mls_save_wrapper">
    			<button type="submit" value="1"	class="{if isset($list_item) && $list_item}mls_save{else}mls_config_save{/if} {if isset($fieldset['form']['submit']['class'])}{$fieldset['form']['submit']['class']|escape:'html':'UTF-8'}{else}btn btn-default pull-right{/if}">
    				<i class="{if isset($fieldset['form']['submit']['icon'])}{$fieldset['form']['submit']['icon']|escape:'html':'UTF-8'}{else}process-icon-save{/if}"></i> {$fieldset['form']['submit']['title']|escape:'html':'UTF-8'}
    			</button>
                <div class="mls_saving">
                    <img src="{$image_baseurl|escape:'html':'UTF-8'}loader.gif"/>
                    <span>{l s='Saving' mod='ets_multilayerslider'}</span>
                </div>
            </div>
			{/if}
            
		</div>
	{/if}    
{/block}
{block name="input_row"}
    {if isset($mls_object) && $mls_object=='MLS_Layer' && $input.name=='layer_type'}
        <div class="mls_layer_form_tab_div">
            <ul class="mls_layer_form_tab">
                <li class="layer_content active">{l s='Content' mod='ets_multilayerslider'}</li>
                <li class="layer_position">{l s='Position' mod='ets_multilayerslider'}</li>
                <li class="layer_transition">{l s='Transition' mod='ets_multilayerslider'}</li>
            </ul>
        </div>
        <div class="mls_layer_edit_form">
            <div class="layer_content_form">
    {/if}
    {if isset($mls_object) && $mls_object=='MLS_Layer' && $input.name=='top'}
        </div><div class="layer_position_form active">
    {/if}
    {if isset($mls_object) && $mls_object=='MLS_Layer' && $input.name=='animation_in'}
        </div><div class="layer_transition_form">
    {/if}    
    <div class="form-group-wrapper row_{strtolower($input.name)|escape:'html':'UTF-8'}">{$smarty.block.parent}</div>
    {if isset($mls_object) && $mls_object=='MLS_Layer' && $input.name=='move_out'}
        </div></div>
    {/if}
{/block}
{block name="label"}
    {if isset($input.showRequired) && $input.showRequired}
        <label class="control-label col-lg-3 required">{$input.label|escape:'html':'UTF-8'}</label>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}