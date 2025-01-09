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

<div class="panel">
    <div class="panel-body lgmodule-container-help">
        <section class="tabs-container">
            <label for="tab-first-steps">{l s='After Installing' mod='lggoogleanalytics'}</label>
            <label for="troubleshooting">{l s='Troubleshooting' mod='lggoogleanalytics'}</label>
            {*<label for="google-ads" class="new-function">{l s='Google Ads' mod='lggoogleanalytics'}</label>*}
            {*<label for="dinamic-remarketing" class="new-function">{l s='Dinamic remarketing' mod='lggoogleanalytics'}</label>*}
            <label for="debug-mode-content">{l s='Debug Mode' mod='lggoogleanalytics'}</label>
        </section>

        <input name="tab" id="tab-first-steps" type="radio" checked />
        <section class="tab-content">
            <h2>{l s='After Installing' mod='lggoogleanalytics'}</h2>
            <div class="alert alert-warning">
                <p>{l s='This module is designed to users wich currenly are using [1]Universal Analytics[/1] and want to migrate to [1]Google Analytics 4[/1]. So before to follow these instrucción ensure you currently have your [1]Universal Analytics[/1] account.' tags=['<strong>'] mod='lggoogleanalytics'}</p>
            </div>
            <h3>{l s='Add a Google Analytics 4 property' mod='lggoogleanalytics'}</h3>
            <p>{l s='Follow the instructions below to create your Google Analytics 4 property.' mod='lggoogleanalytics'}</p>            
            <ol>
                <li>{l s='In Google Analytics, click [1]Admin[/1]' mod='lggoogleanalytics' tags=['<strong>']}</li>
                <li>{l s='In the Account column, make sure that your desired account is selected.' mod='lggoogleanalytics'}</li>
                <li>{l s='In the Property column, select the Universal Analytics property that currently collects data for your website.' mod='lggoogleanalytics'}</li>
                <li>{l s='In the Property column, click GA4 Setup Assistant. It is the first option in the Property column.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Get started under "I want to create a new Google Analytics 4 property".' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Create Property.' mod='lggoogleanalytics'}</li>
            </ol>
            <p>{l s='Analytics now creates your new Google Analytics 4 property, copying basic data such as the property name, URL, timezone, and currency from your Universal Analytics property.' mod='lggoogleanalytics'}</p>
            <img src="{$lg_help_url|escape:'htmlall':'UTF-8'}create_property.png">
            <img src="{$lg_help_url|escape:'htmlall':'UTF-8'}create_property_2.png">
        </section>

        <input name="tab" id="troubleshooting" type="radio" />
        <section class="tab-content">
            <h2>{l s='Troubleshooting' mod='lggoogleanalytics'}</h2>
            <h3>{l s='I don\'t know how to ghet the Google Alaytics 4 ID' mod='lggoogleanalytics'}</h3>
            <p>{l s='Go to tab [1]After Installing[/1] and follow the steps to enable on Google Analytics 4' tags=['<strong>'] mod='lggoogleanalytics'}</p>

            <h3>{l s='I have insert my Google Analytics ID but in my Analytics Panel there is not measuring.' mod='lggoogleanalytics'}</h3>
            <p>{l s='Revise your public site html source code and ensure that the gtag script code is inserted. A code like below must be present, the ID is an example must be the yours.' tags=['<strong>'] mod='lggoogleanalytics'}</p>
            <div style="color:blue; margin: 20px 10px">
            {literal}
            &lt;script type=&quot;text/javascript&quot;&gt;<br>
            &emsp;window.dataLayer = window.dataLayer || [];<br>
            &emsp;function gtag(){dataLayer.push(arguments);}<br>
            &emsp;gtag('js', new Date());<br>
            &emsp;gtag('config', 'G-YOURSITEID');<br>
            &lt;/script&gt;<br>
            {/literal}
            </div>
            <p>{l s='If can\'t find this javascript code, ensure that you cache was cleared after installing the module and save configuration. Clean your cache manually if necessary.' tags=['<strong>'] mod='lggoogleanalytics'}</p>

            <h3>{l s='There are certain events that are not being measuring.' mod='lggoogleanalytics'}</h3>
            <p>{l s='The module register automatic Analytics events and specific e-commerce events. To ensure that the e-commerse events are registering correctly, revise your module configuration enable all desired events.' tags=['<strong>'] mod='lggoogleanalytics'}</p>
            <p>{l s='Only e-commerce events listed in module configuration will be registered:' tags=['<strong>'] mod='lggoogleanalytics'}</p>
            <strong>purchase</strong><br>
            <strong>begin_checkout</strong><br>
            <strong>view_item</strong><br>
            <strong>view_item_list</strong><br>
            <strong>view_cart</strong><br>
            <strong>add_to_cart</strong><br>
            <p>{l s='Also any others automatics events (revise Analytics documentation for full list)' mod='lggoogleanalytics'}</p>
            <strong>first_visit</strong><br>
            <strong>session_start</strong><br>
            <strong>page_view</strong><br>
            <strong>scroll</strong><br>
            <strong>...</strong><br>
        </section>

        {*<input name="tab" id="google-ads" type="radio" />
        <section class="tab-content">
            <h2 class="new-function">{l s='Google Ads' mod='lggoogleanalytics'}</h2>
            <p>{l s='With this function you can implement the native Google Ads conversion ticket for the optimization of Google Ads campaigns. In this way we will know which ads, keywords and campaigns improve the success of the store. This enables you to invest smarter in your highest performing ads and increase your return on investment (ROI).' tags=['<strong>'] mod='lggoogleanalytics'}</p>
            <h3>{l s='In Google Ads, click [1]Tools[/1] and follow next steps:' mod='lggoogleanalytics' tags=['<strong>']}</h3>
            <ol>
                <li>{l s='Under the measurements section click on Conversions.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click on the icon to create a new conversion.' mod='lggoogleanalytics'}</li>
                <li>{l s='Select the option Website' mod='lggoogleanalytics'}</li>
                <li>{l s='Enter a name for the conversion.' mod='lggoogleanalytics'}</li>
                <li>{l s='Select the Buy / Sell category.' mod='lggoogleanalytics'}</li>
                <li>{l s='Select Use different values for each conversion, define as default value 1 and select the standard currency type of your website.' mod='lggoogleanalytics'}</li>
                <li>{l s='Select All The standard conversion window is 30 days.' mod='lggoogleanalytics'}</li>
                <li>{l s='Leave the default value of 1 day for the Post-Print Conversion Window.' mod='lggoogleanalytics'}</li>
                <li>{l s='Select Yes for Include in conversions.' mod='lggoogleanalytics'}</li>
                <li>{l s='For the Attribution Model select Last Click.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Create and Continue.' mod='lggoogleanalytics'}</li>
            </ol>
            <h3>{l s='In your prestashop module, click [1]Google Ads[/1] and follow next steps:' mod='lggoogleanalytics' tags=['<strong>']}</h3>
            <ol>
                <li>{l s='Enter AW Code and paste the Google Ads ID code.' mod='lggoogleanalytics'}</li>
                <li>{l s='Paste the conversion tag code.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Save.' mod='lggoogleanalytics'}</li>
            </ol>
            <img src="{$lg_help_url|escape:'htmlall':'UTF-8'}google-ads.png">
        </section>*}

        {*<input name="tab" id="dinamic-remarketing" type="radio" />
        <section class="tab-content">
            <h2 class="new-function">{l s='Dinamic remarketing' mod='lggoogleanalytics'}</h2>
            <p>{l s='With this function you can implement tags for the creation of remarketing audiences according to the interaction of customers with the web (purchase, add to cart, search for products, etc.)' mod='lggoogleanalytics'}</p>
            <h3>{l s='Enter the Google Analytics management panel and follow next steps:' mod='lggoogleanalytics' tags=['<strong>']}</h3>
            <ol>
                <li>{l s='Click on Administrator.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Property Settings.' mod='lggoogleanalytics'}</li>
                <li>{l s='Scroll all the way down and activate the demographic and interest reporting.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Save.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click on Data collection.' mod='lggoogleanalytics'}</li>
                <li>{l s='Activate the Remarketing option.' mod='lggoogleanalytics'}</li>
                <li>{l s='Activate Advertising Reporting Features.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Save.' mod='lggoogleanalytics'}</li>
                <li>{l s='Open the Custom Settings menu.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click on Custom Dimensions.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click on New Custom Dimension.' mod='lggoogleanalytics'}</li>
                <li>{l s='Define the name of the Customized Dimension.' mod='lggoogleanalytics'}</li>
                <li>{l s='Confirm that the scope type is Hit.' mod='lggoogleanalytics'}</li>
                <li>{l s='Verify that it is active.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Create.' mod='lggoogleanalytics'}</li>
            </ol>
            <h3>{l s='In your prestashop module, click [1]Dinamic remarketing[/1] and follow next steps:' mod='lggoogleanalytics' tags=['<strong>']}</h3>
            <ol>
                <li>{l s='Active option "Remarketing"' mod='lggoogleanalytics'}</li>
                <li>{l s='Enter your Universal Analytics ID. (UA-XXXXX)' mod='lggoogleanalytics'}</li>
                <li>{l s='Select the indices that match your GA.' mod='lggoogleanalytics'}</li>
                <li>{l s='Click Save.' mod='lggoogleanalytics'}</li>
            </ol>
            <img src="{$lg_help_url|escape:'htmlall':'UTF-8'}encryptation_key.png">
        </section>*}

        <input name="tab" id="debug-mode-content" type="radio" />
        <section class="tab-content">
            <h2>{l s='Enable the Debug Mode' mod='lggoogleanalytics'}</h2>
            <div class="alert alert-warning">
                <p>{l s='Only use debug mode, [1]in case you find discrepancies[/1] between the actions in your store and your records in Google Analytics.' tags=['<strong>'] mod='lggoogleanalytics'}</p>
            </div>
            <p>{l s='This option allows you to record the events that are taking place in your store and how they are sent to Google Analytics.' mod='lggoogleanalytics'}</p>
            <p>{l s='With this information, you can contrast the steps that the module follows with the information received on your web analytics platform.' mod='lggoogleanalytics'}</p>
            <p>{l s='The logs are limited to the last actions carried out, however it is recommended that you deactivate the debug mode once you have verified that all the functions are correct.' mod='lggoogleanalytics'}</p>
        </section>
        <div class="clearfix"></div>
    </div>
</div>