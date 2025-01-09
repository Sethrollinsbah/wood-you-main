{*
* 2007-2023 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2023 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{capture name=path}
  <a href="{$link->getPageLink('order', true, NULL, "step=3")|escape:'html':'UTF-8'}"
    title="{l s='Go back to the Checkout' mod='decidir'}">{l s='Checkout' mod='decidir'}</a><span
    class="navigation-pipe"></span>{l s='Payment form' mod='decidir'}
{/capture}
{literal}
  <script type="text/javascript">
    (function(){"use strict";var c=[],f={},a,e,d,b;if(!window.jQuery){a=function(g){c.push(g)};f.ready=function(g)
      {a(g)};e=window.jQuery=window.$=function(g)
      {if(typeof g=="function"){a(g)}return f};window.checkJQ=function()
        {if(!d()){b=setTimeout(checkJQ,100)}};b=setTimeout(checkJQ,100);d=function()
          {if(window.jQuery!==e){clearTimeout(b);var g=c.shift();while(g){jQuery(g);g=c.shift()}b=f=a=e=d=window.checkJQ=null;return true}return false}}})();




            $(document).ready(function() {
              $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/visa.png)');
              $('#payment_method_select').css('background-position', 'right');
              $('#payment_method_select').css('background-repeat', 'no-repeat');
              $('#payment_method_select').css('background-origin', 'content-box');
              $('#payment_method_select').change(function() {
                if ($(this).find("option:selected").attr('value') == 1) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/visa.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 104) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/master.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 65) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/american.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 23) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/shopping.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 24) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/naranja.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 63) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/cabal.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 105) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/masterdebito.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else if ($(this).find("option:selected").attr('value') == 31) {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/visadebito.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                } else {
                  $('#payment_method_select').css('background-image','url({/literal}{$url_base}{literal}modules/decidir/views/img/none.png)');
                  $('#payment_method_select').css('background-position', 'right');
                  $('#payment_method_select').css('background-repeat', 'no-repeat');
                  $('#payment_method_select').css('background-origin', 'content-box');
                }
              });


            getState(1,{/literal}
            {Tools::getValue('id_product')}{literal})


            });
          </script>
        {/literal}
        <script type="text/javascript">
          function getXMLHTTP() { //fuction to return the xml http object
            var xmlhttp = false;
            try {
              xmlhttp = new XMLHttpRequest();
            } catch (e) {
              try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              } catch (e) {
                try {
                  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e1) {
                  xmlhttp = false;
                }
              }
            }

            return xmlhttp;
          }
          {literal}
            function getState(id_medio, id_product) {

              var strURL="{/literal}{$url_base}{literal}index.php?fc=module&module=decidir&controller=ajax&id_medio="+id_medio+"&id_product="+{/literal}{$idprod}{literal};
              var req = getXMLHTTP();

              if (req) {

                req.onreadystatechange = function() {
                  if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                      document.getElementById('statediv').innerHTML = req.responseText;
                      $('#statediv option').each(function() {
                        $(this).prependTo($(this).parent());
                      });
                      $("#statediv").val($("#statediv option:first").val());
                    } else {
                      alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                  }
                }
                req.open("GET", strURL, true);
                req.send(null);
              }
            }

          {/literal}
        </script>

        <body>
          <div id="formbox">
            <div id="plan_selection">
              <fieldset>
                <h4>{l s='Quote your payment with credit card' mod='decidir'}</h4>
                <ul class="formboxul">
                  <li>
                    <label class="">{l s='Cards' mod='decidir'}</label>
                    <div id="select_one">
                      <select name="paymethod" id="payment_method_select" class="selectpicker fixed-width-lg form-control"
                        onchange="getState(this.value)">

                        {foreach $entid as $ent}
                          <option value="{$ent.id_decidir}">{$ent.name}</option>
                        {/foreach}

                        {if $smarty.now|date_format:"%a" eq "jue" or $smarty.now|date_format:"%a" eq "vie" or $smarty.now|date_format:"%a" eq "sab" or $smarty.now|date_format:"%a" eq "dom"}

                          <option value="1000">Ahora 12 (Visa / Cabal / Amex)</option>
                        {/if}
                      </select>
                    </div>
                  </li>
                  <br />
                  <li>
                    <label class="">{l s='Installments' mod='decidir'}</label>
                    <div id="statediv">
                      <select name="installment_select" id="installment_select"
                        class="selectpicker fixed-width-lg form-control">
                        <option value=''>{l s='Select an option' mod='decidir'} </option>
                      </select>
                    </div>
                    <input type="hidden" id="instype" name="installment_type" value="0" />
                  </li>
                </ul>
              </fieldset>
        </div>