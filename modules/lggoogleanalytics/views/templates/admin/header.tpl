{**
 * Copyright 2022 LÍNEA GRÁFICA E.C.E S.L.
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *}

<div class="lg-block">
    <div class="pull-left">
        {if $lg_readme}
        <div class="lg-block-icon">
            <a class="readme" href="{$lg_readme|escape:'htmlall':'UTF-8'}" target="_blank">
                <img src="{$lg_base_url|escape:'htmlall':'UTF-8'}views/img/publi/ico_readme.png"/>
                <span class="text">{l s='Readme' mod='lggoogleanalytics'}</span>
            </a>
        </div>
        {/if}
        {if !empty($lg_id_product)}
        <div class="lg-block-icon">
            <a class="support"
               href="https://addons.prestashop.com/es/Write-to-developper?id_product={$lg_id_product|intval}"
               target="_blank">
                <img src="{$lg_base_url|escape:'htmlall':'UTF-8'}views/img/publi/ico_support.png">
                <span class="text">{l s='Support' mod='lggoogleanalytics'}</span>
            </a>
        </div>
        {/if}
        <div class="lg-block-icon">
            <a class="opinion" href="https://addons.prestashop.com/en/ratings.php" target="_blank">
                <img src="{$lg_base_url|escape:'htmlall':'UTF-8'}views/img/publi/ico_opinion.png">
                <span class="text">{l s='Leave a comment' mod='lggoogleanalytics'}</span>
            </a>
        </div>
    </div>
    <div class="pull-right">
        <img src="{$lg_base_url|escape:'htmlall':'UTF-8'}views/img/publi/logo_lgaddons.png"/>
        <div class="lg-block-icon right">
            <a class="see-modules" href="https://addons.prestashop.com/es/22_linea-grafica" target="_blank">
                <img src="{$lg_base_url|escape:'htmlall':'UTF-8'}views/img/publi/ico_see_modules.png">
                <span class="text">{l s='See modules' mod='lggoogleanalytics'}</span>
            </a>
        </div>
    </div>
</div>
{if isset($show_errors) && count($show_errors)}
<div class="alert alert-danger lgmodule-success">
    {foreach from=$show_errors item='error'}
        {$error|escape:'html':'UTF-8'}
    {/foreach}
</div>
{else}
    {if isset($show_message) && $show_message}
    <div class="alert alert-success lgmodule-success">
        {l s='Your configuration have been saved successfully!' mod='lggoogleanalytics'}
    </div>
    {/if}
{/if}
<div class="lgmodule_wrapper">
  <ul class="lgmodule_menu">
    {foreach $lg_menu as $tab}    
    <li>
      <a href="{$tab.link|escape:'html':'UTF-8'}" {if $tab.active}class="active"{/if}>
          {$tab.label|escape:'html':'UTF-8'}
      </a>
    </li>
    {/foreach}
  </ul>
