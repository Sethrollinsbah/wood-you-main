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

<script data-keepinline>
    {if isset($lgGaOrder)}
        {literal}
            var adWordsConversionParams = {
                'transaction_id': {/literal}{$lgGaOrder['transaction_id']|escape:'javascript':'UTF-8'}{literal},
                'value': {/literal}{$lgGaOrder['value']|escape:'javascript':'UTF-8'}{literal},
                'currency': '{/literal}{$lgGaOrder['currency']|escape:'javascript':'UTF-8'}{literal}'
            };

            adWordsConversionParams['send_to'] = '{/literal}{$adwordsId|escape:'javascript':'UTF-8'}{literal}' + '/' + '{/literal}{$adwordsCl|escape:'javascript':'UTF-8'}{literal}';
            gtag('conversion', adWordsConversionParams);
        {/literal}
    {else}
        {literal}
            gtag('config',  '{/literal}{$adwordsId|escape:'javascript':'UTF-8'}{literal}', {});
        {/literal}
    {/if}
</script>
