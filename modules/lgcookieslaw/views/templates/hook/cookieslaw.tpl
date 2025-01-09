{*
 *  Please read the terms of the CLUF license attached to this module(cf "licences" folder)
 *
 * @author    Línea Gráfica E.C.E. S.L.
 * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
 * @license   https://www.lineagrafica.es/licenses/license_en.pdf
 *            https://www.lineagrafica.es/licenses/license_es.pdf
 *            https://www.lineagrafica.es/licenses/license_fr.pdf
 *}

<div id="lgcookieslaw_banner" class="lgcookieslaw-banner{if $lgcookieslaw_position == 3} lgcookieslaw-message-floating{/if}{if isset($lgcookieslaw_show_reject_all_button) && $lgcookieslaw_show_reject_all_button} lgcookieslaw-reject-all-button-enabled{/if}">
    <div class="container">
        <div class="lgcookieslaw-message">
            {$cookie_message nofilter} {* HTML CONTENT *}

            <div class="lgcookieslaw-link-container">
                <a id="lgcookieslaw_info" class="lgcookieslaw-info lgcookieslaw-link-button" {if isset($cms_target) && $cms_target} target="_blank" {/if} href="{$cms_link|escape:'quotes':'UTF-8'}" >
                    {stripslashes($button2|escape:'quotes':'UTF-8')}
                </a>

                <a id="lgcookieslaw_customize_cookies" class="lgcookieslaw-customize-cookies lgcookieslaw-link-button" onclick="customizeCookies()">
                    {l s='Customize Cookies' mod='lgcookieslaw'}
                </a>
            </div>
        </div>
        <div class="lgcookieslaw-button-container">
            {if isset($lgcookieslaw_show_reject_all_button) && $lgcookieslaw_show_reject_all_button}
                <button id="lgcookieslaw_reject_all" class="lgcookieslaw-btn lgcookieslaw-reject-all lgcookieslaw-link-button" onclick="closeinfo(true, 0)">
                    {l s='Reject All' mod='lgcookieslaw'}
                </button>
            {/if}

            <button id="lgcookieslaw_accept" class="lgcookieslaw-btn lgcookieslaw-accept lggoogleanalytics-accept" onclick="closeinfo(true, 1)">{stripslashes($button1|escape:'quotes':'UTF-8')}</button>
        </div>
    </div>
</div>

<div id="lgcookieslaw_modal" class="lgcookieslaw-modal">
    <div class="lgcookieslaw-modal-body">
        <h2>{l s='Cookies configuration' mod='lgcookieslaw'}</h2>

        {if isset($lgcookieslaw_purposes) && !empty($lgcookieslaw_purposes)}
            {foreach $lgcookieslaw_purposes as $lgcookieslaw_purpose}
                <div class="lgcookieslaw-section">
                    <div class="lgcookieslaw-section-name">
                        {$lgcookieslaw_purpose.name|escape:'html':'UTF-8'}{if $lgcookieslaw_purpose.technical} <small>{l s='(technical)' mod='lgcookieslaw'}</small>{/if}
                    </div>
                    <div class="lgcookieslaw-section-checkbox">
                        <label class="lgcookieslaw-switch">
                            <div class="lgcookieslaw-slider-option-left">{l s='No' mod='lgcookieslaw'}</div>
                            <input type="checkbox" id="lgcookieslaw_purpose_enabled_{$lgcookieslaw_purpose.id_lgcookieslaw_purpose|intval}" class="lgcookieslaw-purpose-enabled{if $lgcookieslaw_purpose.id_lgcookieslaw_purpose == LGCookiesLawPurpose::ANALYTICS_PURPOSE} lgcookieslaw-analytics-purpose{/if}" data-id-lgcookieslaw-purpose="{$lgcookieslaw_purpose.id_lgcookieslaw_purpose|intval}"{if $lgcookieslaw_purpose.technical} checked="checked" disabled="disabled"{else}{if $third_paries} checked="checked"{/if}{/if}>
                            <span class="lgcookieslaw-slider{if $lgcookieslaw_purpose.technical} lgcookieslaw-slider-checked{else}{if $third_paries} lgcookieslaw-slider-checked{/if}{/if}"></span>
                            <div class="lgcookieslaw-slider-option-right">{l s='Yes' mod='lgcookieslaw'}</div>
                        </label>
                    </div>
                    <div class="lgcookieslaw-section-description">
                        <div class="lgcookieslaw-section-description-button card-header collapsed" data-toggle="collapse" href="#multi_collapse_lgwhatsapp_purpose_{$lgcookieslaw_purpose.id_lgcookieslaw_purpose|intval}" role="button" aria-expanded="false" aria-controls="multi_collapse_lgwhatsapp_purpose_{$lgcookieslaw_purpose.id_lgcookieslaw_purpose|intval}">
                            <a class="card-title-cookies">{l s='Description' mod='lgcookieslaw'}</a>
                        </div>
                        <div class="lgcookieslaw-section-description-content collapse multi-collapse" id="multi_collapse_lgwhatsapp_purpose_{$lgcookieslaw_purpose.id_lgcookieslaw_purpose|intval}">
                            {$lgcookieslaw_purpose.description nofilter} {* HTML CONTENT *}
                        </div>
                    </div>
                </div>
            {/foreach}
        {/if}
    </div>
    <div class="lgcookieslaw-modal-footer">
        <div class="lgcookieslaw-modal-footer-left">
            <button id="lgcookieslaw_cancel" class="btn lgcookieslaw-cancel"> > {l s='Cancel' mod='lgcookieslaw'}</button>
        </div>
        <div class="lgcookieslaw-modal-footer-right">
            {if isset($lgcookieslaw_show_reject_all_button) && $lgcookieslaw_show_reject_all_button}
                <button id="lgcookieslaw_reject_all" class="btn lgcookieslaw-reject-all" onclick="closeinfo(true, 0)">{l s='Reject All' mod='lgcookieslaw'}</button>
            {/if}

            <button id="lgcookieslaw_save" class="btn lgcookieslaw-save{if isset($lgcookieslaw_enable_lggoogleanalytics_accept) && $lgcookieslaw_enable_lggoogleanalytics_accept} lggoogleanalytics-accept{/if}" onclick="closeinfo(true, 2)">{l s='Accept Selection' mod='lgcookieslaw'}</button>
            <button id="lgcookieslaw_accept_all" class="btn lgcookieslaw-accept-all lggoogleanalytics-accept" onclick="closeinfo(true, 1)">{l s='Accept All' mod='lgcookieslaw'}</button>
        </div>
    </div>
</div>

<div class="lgcookieslaw-overlay"></div>
