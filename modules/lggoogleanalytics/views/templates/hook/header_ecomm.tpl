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

<!-- Global site tag (gtag.js) - Google Analytics -->
{*<script async src="https://www.googletagmanager.com/gtag/js?id={$ecomm_id|escape:'javascript':'UTF-8'}" data-keepinline></script>*}

<script data-keepinline>
    {literal}
        window.dataLayer = window.dataLayer || [];
        gtag('js', new Date());
    {/literal}
</script>

<script data-keepinline>
    var trackingFeatures = {$lggtag_tracking_features|json_encode nofilter}; {* JSON CONTENT *}

    {literal}
        var configElement = trackingFeatures['analyticsId'];
        var configFeatures = trackingFeatures.config;
        var configParams = {};

        var ecomm_prodid_index = {/literal}{$ecomm_prodid_index|escape:'javascript':'UTF-8'}{literal};
        var ecomm_pagetype_index = {/literal}{$ecomm_pagetype_index|escape:'javascript':'UTF-8'}{literal};
        var ecomm_totalvalue_index = {/literal}{$ecomm_totalvalue_index|escape:'javascript':'UTF-8'}{literal};
        var ecomm_category_index = {/literal}{$ecomm_category_index|escape:'javascript':'UTF-8'}{literal};

        configParams['custom_map'] = {};

        // set ecomm index dimensions
        if (configFeatures.remarketing) {
            configParams.custom_map['dimension' + ecomm_prodid_index]= 'ecomm_prodid';
            configParams.custom_map['dimension' + ecomm_pagetype_index] = 'ecomm_pagetype';
            configParams.custom_map['dimension' + ecomm_totalvalue_index] = 'ecomm_totalvalue';
            configParams.custom_map['dimension' + ecomm_category_index] = 'ecomm_category';
        }

        configParams['allow_display_features'] = 1;

        if (configElement) {
            gtag('config', configElement, configParams);
        }
    {/literal}
</script>
