{*

* 2007-2012 PrestaShop

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

*  @copyright  2007-2012 PrestaShop SA

*  @version  Release: $Revision: 16684 $

*  @license  http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)

*  International Registered Trademark & Property of PrestaShop SA

*}
{extends file='page.tpl'}
{block name="page_content"}
<link rel="shortcut icon" type="image/x-icon" href="{$module_dir}secure.png" />

<p class="payment_module" >



  {if $isFailed == 1}

    <p style="color: red;">

      {if !empty($smarty.get.message)}

        {l s='Error detail from PlugnpayAPI : ' mod='plugnpayapi'}{$smarty.get.message|htmlentities}

      {else}

        {l s='Error, please verify the card information' mod='plugnpayapi'}

      {/if}

    </p>

  {/if}



  <form name="plugnpayapi_form" id="plugnpayapi_form" action="{$module_dir}validation.php" method="post">

    <span style="border: 1px solid #595A5E; display: block; padding: 0.6em; text-decoration: none; margin-left: 0.7em;">

      <a id="click_plugnpayapi" href="#" title="{l s='Pay with PlugnpayAPI' mod='plugnpayapi'}" style="display: block;text-decoration: none; font-weight: bold;">
                <img src="{$module_dir}logoa.gif" alt="secure payment" />


        {if $cards.visa == 1}<img src="{$module_dir}cards/visa.png" alt="{l s='Visa' mod='plugnpayapi'}" style="vertical-align: middle;" />{/if}

        {if $cards.mastercard == 1}<img src="{$module_dir}cards/mastercard.png" alt="{l s='Mastercard' mod='plugnpayapi'}" style="vertical-align: middle;" />{/if}

        {if $cards.discover == 1}<img src="{$module_dir}cards/discover.png" alt="{l s='Discover' mod='plugnpayapi'}" style="vertical-align: middle;" />{/if}

        {if $cards.ax == 1}<img src="{$module_dir}cards/ax.png" alt="{l s='American Express' mod='plugnpayapi'}" style="vertical-align: middle;" />{/if}

        &nbsp;&nbsp;{l s='Secured credit card payment with PlugnPay.com' mod='plugnpayapi'}

      </a>



        {if $isFailed == 0}

            <div id="aut2" >

        {else}

            <div id="aut2">

        {/if}







        <div>
            <br/>
  <div class="form-group">
  <input class="form-control"  type="hidden" name="pnp_orderid" value="{$pnp_orderid}" />
    <input class="form-control"  type="hidden" name="publisher-password" value="a4MQPYV3LS6qzstV" />

  <label for="name" style="margin-top: 4px; margin-left: 35px;display: block;width: 90px;float: left;">{l s='Full Name' mod='plugnpayapi'}</label>
  
  
   <input type="text" name="name" id="fullname" size="30" maxlength="25S" required/>
          

        </div>




  <div class="form-group">
          <label for="cardType" style="margin-top: 4px; margin-left: 35px; display: block;width: 90px;float: left;">{l s='Card Type' mod='plugnpayapi'}</label>

          <select class="form-control"  id="cardType" style="width:50%">

            {if $cards.visa == 1}<option value="Visa">Visa</option>{/if}

            {if $cards.mastercard == 1}<option value="MasterCard">MasterCard</option>{/if}

            {if $cards.discover == 1}<option value="Discover">Discover</option>{/if}

            {if $cards.ax == 1}<option value="AmEx">American Express</option>{/if}

          </select>

          </div>

  <div class="form-group">

          <label for="pnp_card_num" >{l s='Card Number' mod='plugnpayapi'}</label> 
          <input type="text" name="pnp_card_num" id="cardnum" size="30" maxlength="16" autocomplete="Off" required/>
</div>
        <div class="form-group">


          <label for="pnp_exp_date_m" style="position:relative;float:left">{l s='Exp Date' mod='plugnpayapi'}</label>

          <select class="form-control"  id="pnp_exp_date_m" name="pnp_exp_date_m" style="width:83px;position:relative;float:left">{section name=date_m start=01 loop=13}

            <option value="{$smarty.section.date_m.index}">{$smarty.section.date_m.index}</option>{/section}

          </select>

          <span style="position:relative;float:left"> /</span>

          <select class="form-control"  name="pnp_exp_date_y" style="width:203px;position:relative;float:left">{section name=date_y start=23 loop=50}

            <option value="{$smarty.section.date_y.index}">20{$smarty.section.date_y.index}</option>{/section}

          </select>

       </div>

  <div class="form-group">

          <label for="pnp_card_code" >{l s='CVV' mod='plugnpayapi'}</label> <input type="text" name="pnp_card_code" id="pnp_card_code" size="4" maxlength="4" required/> <img src="{$module_dir}help.png" id="cvv_help" title="{l s='the 3 last digits on the back of your credit card' mod='plugnpayapi'}" alt="" />

          &nbsp; <img src="{$module_dir}cvv.png" id="cvv_help_img" alt=""style="display: none;margin-left: 211px;" />

       <br/>  

<br/>

          <input class="form-control"  type="button" id="asubmit" value="{l s='Validate order' mod='plugnpayapi'}" class="button" />

           </div>

        </div>

        <br class="clear" />

      </div>

    </span>
</div>
  </form>

</p>


	{literal}
		<script>
			(function(){"use strict";var c=[],f={},a,e,d,b;if(!window.jQuery){a=function(g){c.push(g)};f.ready=function(g)
				{a(g)};e=window.jQuery=window.$=function(g)
				{if(typeof g=="function"){a(g)}return f};window.checkJQ=function()
					{if(!d()){b=setTimeout(checkJQ,100)}};b=setTimeout(checkJQ,100);d=function()
						{if(window.jQuery!==e){clearTimeout(b);var g=c.shift();while(g){jQuery(g);g=c.shift()}b=f=a=e=d=window.checkJQ=null;return true}return false}}})();
						</script>
					{/literal}
          

<script type="text/javascript">

  var mess_error = "{l s='Please check your credit card information (Credit card type, number and expiration date)' mod='plugnpayapi' js=1}";

  var mess_error2 = "{l s='Please specify your Full Name' mod='plugnpayapi' js=1}";

  {literal}

    $(document).ready(function() {

      $('#pnp_exp_date_m').children('option').each(function() {

        if ($(this).val() < 10) {

          $(this).val('0' + $(this).val());

          $(this).html($(this).val())

        }

      });

      $('#click_plugnpayapi').click(function(e) {

        e.preventDefault();

        $('#click_plugnpayapi').fadeOut("fast",function() {

          $("#aut2").show();

          $('#click_plugnpayapi').fadeIn('fast');

        });

        $('#click_plugnpayapi').unbind();

        $('#click_plugnpayapi').click(function(e) {

          e.preventDefault();

        });

      });



      $('#cvv_help').click(function() {

        $("#cvv_help_img").show();

        $('#cvv_help').unbind();

      });



      $('#asubmit').click(function() {

        if ($('#fullname').val() == '') {

          alert(mess_error2);

        }

        else if (!validateCC($('#cardnum').val(), $('#cardType').val()) || $('#pnp_card_code').val() == '') {

          alert(mess_error);

        }

        else {

          $('#plugnpayapi_form').submit();

        }

        return false;

      });

    });

  {/literal}

</script>

{/block}