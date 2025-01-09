{**
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 Chimon Sultan
*  @license	  All right reserved
*}

<!-- start contactboxplus module -->
<!-- Fancybox -->
<div style="display: none;">
    <div id="cbp_message_form">
         <form id="ajax-contact" class="ajax-contact" enctype="multipart/form-data">
            <h1 class="page-subheading h1">
                {l s='Send a message' mod='contactboxplus'}
            </h1>
            <hr>
            <div class="row">
                {if isset($product) && $product}
                    <div class="product clearfix  col-xs-12 col-sm-3">

                        <img src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'medium_default')|escape:'html':'UTF-8'}"
                             width="{$mediumSize.width|escape:'html':'UTF-8'}"
                             alt="{$product->name|escape:'html':'UTF-8'}" title="image"/>

                        <div class="product_desc">
                            <p class="product_name">
                                <strong>{$product->name|escape:'html':'UTF-8'}</strong>
                            </p>
                        </div>
                    </div>
                {/if}
                <div class="message_form_content col-xs-12 col-sm-9">

                    <div id="message_form_error" class="error alert alert-danger"
                         style="display: none; padding: 15px 25px">
                        <ul></ul>
                    </div>

                    <div class="row">
                        {foreach $cbp_fields as $nbkey => $cbp_field}
                            {$key = $cbp_field['id_cbp_field']}
                            {$type = $cbp_field['type']}
                            {$width = $cbp_field['width']}
                            {$validate = $cbp_field['validation']}
                            {$description = $cbp_field['description']}
                            {assign var="options" value="\r\n"|explode:$cbp_field['options']}
                            {$required = ''}
                            {$minimaldate = $cbp_field['minimaldate']}
                            {$maximaldate = $cbp_field['maximaldate']}
                            {$displaydatehint = $cbp_field['displaydatehint']}
                            {$allowedextensions = $cbp_field['allowedextensions']}
                            <div class=" form-group col-sm-{$width|escape:'htmlall':'UTF-8'}">
                                <label for="field_{$key|escape:'htmlall':'UTF-8'}">
                                    {$cbp_field['label']|escape:'htmlall':'UTF-8'}
                                    {if $cbp_field['required'] == 1}{$required = "required"}
                                        <sup class="required">*</sup>
                                    {/if}
                                </label>

                                {if $type == 'text'}
                                    <input type="text" name="field_{$key|escape:'htmlall':'UTF-8'}"
                                           data-validate="{$validate|escape:'htmlall':'UTF-8'}"
                                           class="form-control grey validate"  {$required|escape:'htmlall':'UTF-8'}/>
                               {elseif $type == 'file'}
                                   <input type="file" name="field_{$key|escape:'htmlall':'UTF-8'}"
                                          class="form-control grey"  {$required|escape:'htmlall':'UTF-8'}/>
                                   <p class="help-block">{l s='Max size' mod='contactboxplus'}: <b>{$max_filesize|escape:'htmlall':'UTF-8'}{l s='Mb' mod='contactboxplus'}</b>
                                       {if $allowedextensions != ''}
                                         <br>{l s='Allowed extensions' mod='contactboxplus'}: <b>{$allowedextensions|escape:'htmlall':'UTF-8'}</b>
                                       {/if}
                                   </p>
                                {elseif $type == 'date'}
                                    <input type="date" name="field_{$key|escape:'htmlall':'UTF-8'}"
                                           data-validate="{$validate|escape:'htmlall':'UTF-8'}"
                                           class="form-control grey validate"  {$required|escape:'htmlall':'UTF-8'}
                                           min="{$minimaldate|escape:'htmlall':'UTF-8'}"
                                           max="{$maximaldate|escape:'htmlall':'UTF-8'}"/>
                                           <!--<p class="help-block">{l s='Between' mod='contactboxplus'} {$minimaldate|escape:'htmlall':'UTF-8'} {l s='and' mod='contactboxplus'} {$maximaldate|escape:'htmlall':'UTF-8'}</p>-->
                                            {if $displaydatehint == 1}
                                              <p class="help-block">
                                                {l s='Choose a date' mod='contactboxplus'}

                                                {if $maximaldate != '0000-00-00' AND $minimaldate != '0000-00-00'}
                                                    {l s='between' mod='contactboxplus'} <b>{$minimaldate|date_format:$js_custom_vars.prestashop.language.date_format_lite|escape:'htmlall':'UTF-8'}</b>
                                                    {l s='and' mod='contactboxplus'} <b>{$maximaldate|date_format:$js_custom_vars.prestashop.language.date_format_lite|escape:'htmlall':'UTF-8'}</b>
                                                 {elseif $minimaldate != '0000-00-00'}
                                                    {l s='after' mod='contactboxplus'} <b>{$minimaldate|date_format:$js_custom_vars.prestashop.language.date_format_lite|escape:'htmlall':'UTF-8'}</b>
                                                  {elseif $maximaldate != '0000-00-00'}
                                                    {l s='before' mod='contactboxplus'} <b>{$maximaldate|date_format:$js_custom_vars.prestashop.language.date_format_lite|escape:'htmlall':'UTF-8'}</b>
                                                  {/if}
                                            </p>
                                            {/if}
                                {elseif $type == 'textarea'}
                                    <textarea name="field_{$key|escape:'htmlall':'UTF-8'}"
                                              data-validate="{$validate|escape:'htmlall':'UTF-8'}"
                                              class="form-control grey validate"  {$required|escape:'htmlall':'UTF-8'}></textarea>
                                {elseif $type == 'password'}
                                    <input type="password" name="field_{$key|escape:'htmlall':'UTF-8'}"
                                           data-validate="{$validate|escape:'htmlall':'UTF-8'}"
                                           class="form-control grey validate"   {$required|escape:'htmlall':'UTF-8'}/>
                                {elseif $type == 'select'}
                                    <select name="field_{$key|escape:'htmlall':'UTF-8'}"
                                            class="form-control grey" {$required|escape:'htmlall':'UTF-8'}>
                                        {if $cbp_field['required'] == 0}
                                            <option></option>
                                        {/if}

                                        {foreach $options as $key => $option}
                                            <option value="{$option|strip|escape:'htmlall':'UTF-8'}">{$option|escape:'htmlall':'UTF-8'}</option>
                                        {/foreach}
                                    </select>
                                {elseif $type == 'radio'}
                                    <div class="radio_options">
                                        {foreach $options as $rkey => $option}
                                            <label>
                                                <input type="radio" name="field_{$key|escape:'htmlall':'UTF-8'}"
                                                       value="{$option|strip|replace:' ':''|escape:'htmlall':'UTF-8'}">{$option|escape:'htmlall':'UTF-8'}
                                            </label>
                                        {/foreach}
                                    </div>
                                {elseif $type == 'checkbox'}
                                    <div class="radio_options">

                                        {foreach $options as $ckey => $option}
                                            <label>
                                                <input type="checkbox" name="field_{$key|escape:'htmlall':'UTF-8'}[]"
                                                       value="{$option|escape:'htmlall':'UTF-8'}">
                                                {$option|escape:'htmlall':'UTF-8'}
                                            </label>
                                        {/foreach}
                                    </div>
                                {/if}

                                <p class="help-block">{if $description}{$description|escape:'htmlall':'UTF-8'}{/if}</p>

                            </div>
                        {/foreach}



                    </div>

                    <div id="new_message_form_footer">
                        <input id="name_product_message_send" name="product_name" type="hidden"
                               value='{if isset($product) && $product}{$product->name|escape:'html':'UTF-8'}{/if}'/>
                        <input id="id_product_message_send" name="id_product" type="hidden"
                               value='{if isset($product) && $product}{$product->id|escape:'html':'UTF-8'}{/if}'/>
                        <input id="ref_product_message_send" name="cbp_ref_product" type="hidden"
                               value='{if isset($product) && $product}{$product->reference|escape:'html':'UTF-8'}{/if}'/>
                        <input id="url_product_message_send" name="product_url" type="hidden"
                               value='{if isset($cbp_url) && $cbp_url}{$cbp_url|escape:'html':'UTF-8'}{/if}'/>

                        <hr>
                        {if isset($gdpr_enabled) && $gdpr_enabled}
                        <div class="radio_options">


                                <label>
                                    <input type="checkbox" name="gdpr_consent"
                                           value="consented">

                                    {l s='I have read and accept the' mod='contactboxplus'}
                                    <a href="{$privacy_policy_url|escape:'html':'UTF-8'}" target="_blank">
                                    {l s='Privacy Policy' mod='contactboxplus'} <sup>*</sup>
                                  </a>
                                </label>

                        </div>
                        <hr>

                        {/if}

                        <p class="required"><sup>*</sup> {l s='Required fields' mod='contactboxplus'}</p>

                         {if isset($recaptcha_enabled) && $recaptcha_enabled}
                        <div class="g-recaptcha" data-sitekey="{$recaptcha_site_key|escape:'html':'UTF-8'}"></div>

                        {/if}

                        <p class="">
                            <button id="submitMessage" name="submitMessage" type="submit"
                                    class="btn button btn-primary button-small">
                                <span>{l s='Send' mod='contactboxplus'}</span>
                            </button>
                            &nbsp;
                            {l s='or' mod='contactboxplus'}&nbsp;
                            <a class="closefb" href="#">
                                {l s='Cancel' mod='contactboxplus'}
                            </a>
                        </p>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- End fancybox -->


<!-- end contactboxplus module -->
