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

{extends file="helpers/form/form.tpl"}

{block name="input"}
    {if $input.type == 'alert-info'}
        <div class="alert alert-info">
            <p class="text text-info">
                {$input.value nofilter}{* HTML CONTENT *}
            </p>
        </div>
    {elseif $input.type == 'alert-warning'}
        <div class="alert alert-warning">
            <p class="text text-warning">
                {$input.value nofilter}{* HTML CONTENT *}
            </p>
        </div>
    {elseif $input.type == 'alert-danger'}
        <div class="alert alert-danger">
            <p class="text text-danger">
                {$input.value nofilter}{* HTML CONTENT *}
            </p>
        </div>
    {elseif $input.type == 'alert-success'}
        <div class="alert alert-success">
            <p class="text text-success">
                {$input.value nofilter}{* HTML CONTENT *}
            </p>
        </div>
    {elseif $input.type == 'text-info'}
        <p class="text text-info">
            {$input.value nofilter}{* HTML CONTENT *}
        </p>
    {elseif $input.type == 'text-warning'}
        <p class="text text-warning">
            {$input.value nofilter}{* HTML CONTENT *}
        </p>
    {elseif $input.type == 'text-danger'}
        <p class="text text-danger">
            {$input.value nofilter}{* HTML CONTENT *}
        </p>
    {elseif $input.type == 'text-success'}
        <p class="text text-success">
            {$input.value nofilter}{* HTML CONTENT *}
        </p>
    {else}
        {$smarty.block.parent}{* HTML CONTENT *}
    {/if}
{/block}
