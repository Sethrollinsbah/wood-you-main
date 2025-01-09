{*
    *  Please read the terms of the CLUF license attached to this module(cf "licences" folder)
    *
    * @author    Línea Gráfica E.C.E. S.L.
    * @copyright Lineagrafica.es - Línea Gráfica E.C.E. S.L. all rights reserved.
    * @license   https://www.lineagrafica.es/licenses/license_en.pdf https://www.lineagrafica.es/licenses/license_es.pdf https://www.lineagrafica.es/licenses/license_fr.pdf
*}

<div class="check-module-list">
    {foreach $cookie_purposes as $id_lgcookieslaw_purpose => $cookie_purpose}
        <h4 class="h4">{$cookie_purpose|escape:'html':'UTF-8'}</h4>

        <table class="table table-locked-modules" style="margin-bottom: 25px;">
            {foreach from=$module_list item=module name=list}
                {if (($smarty.foreach.list.index +1) mod 4) eq 0}
                    <tr>
                {/if}

                <td style="width:10px;">
                    <img src="../modules/{$module.name|escape:'html':'UTF-8'}/logo.{if version_compare($smarty.const._PS_VERSION_,'1.7.0','>=')}png{else}gif{/if}" style="width:20px;">
                </td>

                {if ($module.name == 'lgcookieslaw')}
                    <td style="width:20px;"><input type="checkbox" disabled name="lgcookieslaw"></td>
                {else}
                    <td style="width:20px;"><input type="checkbox" {if in_array($module.name, $purpose_locked_modules[(int)$id_lgcookieslaw_purpose])} checked="checked" {/if} id="locked_modules_{$id_lgcookieslaw_purpose|intval}_{$module.name|escape:'html':'UTF-8'}" name="{$module.name|escape:'html':'UTF-8'}"></td>
                {/if}

                <td style="width:100px;"><label for="locked_modules_{$id_lgcookieslaw_purpose|intval}_{$module.name|escape:'html':'UTF-8'}">{$module.name|escape:'html':'UTF-8'}</label></td>

                {if ($smarty.foreach.list.index +1 mod 4) eq 0}
                    </tr>
                {/if}
            {/foreach}

            <input type="hidden" name="locked_modules_{$id_lgcookieslaw_purpose|intval}" value="">
        </table>
    {/foreach}

    <script type="text/javascript">
        window.addEventListener("load", function() {
            $(document).on("click", "button[name=submitForm]", function(e) {
                e.preventDefault();

                $(".table-locked-modules").each(function() {
                    var locked_modules = [];

                    $(this).find("input[type=checkbox]:checked").each(function() {
                        locked_modules.push($(this).attr("name"));
                    });

                    $(this).find("input[name^=locked_modules_]").val(locked_modules);
                });

                $("form#configuration_form").submit();
            });
        });
    </script>
</div>
