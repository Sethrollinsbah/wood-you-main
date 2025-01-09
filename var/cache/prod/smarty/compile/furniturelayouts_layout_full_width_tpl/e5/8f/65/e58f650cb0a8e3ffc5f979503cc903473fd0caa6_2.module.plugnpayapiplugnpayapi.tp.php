<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:42:29
  from 'module:plugnpayapiplugnpayapi.tp' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d5975e8cc06_99549558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e58f650cb0a8e3ffc5f979503cc903473fd0caa6' => 
    array (
      0 => 'module:plugnpayapiplugnpayapi.tp',
      1 => 1709033582,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d5975e8cc06_99549558 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1017741033677d5975e698b3_39875366', "page_content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block "page_content"} */
class Block_1017741033677d5975e698b3_39875366 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_1017741033677d5975e698b3_39875366',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
secure.png" />

<p class="payment_module" >



  <?php if ($_smarty_tpl->tpl_vars['isFailed']->value == 1) {?>

    <p style="color: red;">

      <?php if (!empty($_GET['message'])) {?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error detail from PlugnpayAPI : ','mod'=>'plugnpayapi'),$_smarty_tpl ) );
echo htmlspecialchars(htmlentities($_GET['message']), ENT_QUOTES, 'UTF-8');?>


      <?php } else { ?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Error, please verify the card information','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>


      <?php }?>

    </p>

  <?php }?>



  <form name="plugnpayapi_form" id="plugnpayapi_form" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
validation.php" method="post">

    <span style="border: 1px solid #595A5E; display: block; padding: 0.6em; text-decoration: none; margin-left: 0.7em;">

      <a id="click_plugnpayapi" href="#" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pay with PlugnpayAPI','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" style="display: block;text-decoration: none; font-weight: bold;">
                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
logoa.gif" alt="secure payment" />


        <?php if ($_smarty_tpl->tpl_vars['cards']->value['visa'] == 1) {?><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
cards/visa.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Visa','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" style="vertical-align: middle;" /><?php }?>

        <?php if ($_smarty_tpl->tpl_vars['cards']->value['mastercard'] == 1) {?><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
cards/mastercard.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Mastercard','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" style="vertical-align: middle;" /><?php }?>

        <?php if ($_smarty_tpl->tpl_vars['cards']->value['discover'] == 1) {?><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
cards/discover.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Discover','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" style="vertical-align: middle;" /><?php }?>

        <?php if ($_smarty_tpl->tpl_vars['cards']->value['ax'] == 1) {?><img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
cards/ax.png" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'American Express','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" style="vertical-align: middle;" /><?php }?>

        &nbsp;&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Secured credit card payment with PlugnPay.com','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>


      </a>



        <?php if ($_smarty_tpl->tpl_vars['isFailed']->value == 0) {?>

            <div id="aut2" >

        <?php } else { ?>

            <div id="aut2">

        <?php }?>







        <div>
            <br/>
  <div class="form-group">
  <input class="form-control"  type="hidden" name="pnp_orderid" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pnp_orderid']->value, ENT_QUOTES, 'UTF-8');?>
" />
    <input class="form-control"  type="hidden" name="publisher-password" value="a4MQPYV3LS6qzstV" />

  <label for="name" style="margin-top: 4px; margin-left: 35px;display: block;width: 90px;float: left;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Full Name','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</label>
  
  
   <input type="text" name="name" id="fullname" size="30" maxlength="25S" required/>
          

        </div>




  <div class="form-group">
          <label for="cardType" style="margin-top: 4px; margin-left: 35px; display: block;width: 90px;float: left;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Card Type','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</label>

          <select class="form-control"  id="cardType" style="width:50%">

            <?php if ($_smarty_tpl->tpl_vars['cards']->value['visa'] == 1) {?><option value="Visa">Visa</option><?php }?>

            <?php if ($_smarty_tpl->tpl_vars['cards']->value['mastercard'] == 1) {?><option value="MasterCard">MasterCard</option><?php }?>

            <?php if ($_smarty_tpl->tpl_vars['cards']->value['discover'] == 1) {?><option value="Discover">Discover</option><?php }?>

            <?php if ($_smarty_tpl->tpl_vars['cards']->value['ax'] == 1) {?><option value="AmEx">American Express</option><?php }?>

          </select>

          </div>

  <div class="form-group">

          <label for="pnp_card_num" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Card Number','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</label> 
          <input type="text" name="pnp_card_num" id="cardnum" size="30" maxlength="16" autocomplete="Off" required/>
</div>
        <div class="form-group">


          <label for="pnp_exp_date_m" style="position:relative;float:left"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Exp Date','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</label>

          <select class="form-control"  id="pnp_exp_date_m" name="pnp_exp_date_m" style="width:83px;position:relative;float:left"><?php
$_smarty_tpl->tpl_vars['__smarty_section_date_m'] = new Smarty_Variable(array());
if (true) {
for ($__section_date_m_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_date_m']->value['index'] = 1; $__section_date_m_0_iteration <= 12; $__section_date_m_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_date_m']->value['index']++){
?>

            <option value="<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_section_date_m']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_date_m']->value['index'] : null), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_section_date_m']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_date_m']->value['index'] : null), ENT_QUOTES, 'UTF-8');?>
</option><?php
}
}
?>

          </select>

          <span style="position:relative;float:left"> /</span>

          <select class="form-control"  name="pnp_exp_date_y" style="width:203px;position:relative;float:left"><?php
$_smarty_tpl->tpl_vars['__smarty_section_date_y'] = new Smarty_Variable(array());
if (true) {
for ($__section_date_y_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_date_y']->value['index'] = 23; $__section_date_y_1_iteration <= 27; $__section_date_y_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_date_y']->value['index']++){
?>

            <option value="<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_section_date_y']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_date_y']->value['index'] : null), ENT_QUOTES, 'UTF-8');?>
">20<?php echo htmlspecialchars((isset($_smarty_tpl->tpl_vars['__smarty_section_date_y']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_date_y']->value['index'] : null), ENT_QUOTES, 'UTF-8');?>
</option><?php
}
}
?>

          </select>

       </div>

  <div class="form-group">

          <label for="pnp_card_code" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'CVV','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
</label> <input type="text" name="pnp_card_code" id="pnp_card_code" size="4" maxlength="4" required/> <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
help.png" id="cvv_help" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'the 3 last digits on the back of your credit card','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" alt="" />

          &nbsp; <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8');?>
cvv.png" id="cvv_help_img" alt=""style="display: none;margin-left: 211px;" />

       <br/>  

<br/>

          <input class="form-control"  type="button" id="asubmit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Validate order','mod'=>'plugnpayapi'),$_smarty_tpl ) );?>
" class="button" />

           </div>

        </div>

        <br class="clear" />

      </div>

    </span>
</div>
  </form>

</p>


	
		<?php echo '<script'; ?>
>
			(function(){"use strict";var c=[],f={},a,e,d,b;if(!window.jQuery){a=function(g){c.push(g)};f.ready=function(g)
				{a(g)};e=window.jQuery=window.$=function(g)
				{if(typeof g=="function"){a(g)}return f};window.checkJQ=function()
					{if(!d()){b=setTimeout(checkJQ,100)}};b=setTimeout(checkJQ,100);d=function()
						{if(window.jQuery!==e){clearTimeout(b);var g=c.shift();while(g){jQuery(g);g=c.shift()}b=f=a=e=d=window.checkJQ=null;return true}return false}}})();
						<?php echo '</script'; ?>
>
					
          

<?php echo '<script'; ?>
 type="text/javascript">

  var mess_error = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please check your credit card information (Credit card type, number and expiration date)','mod'=>'plugnpayapi','js'=>1),$_smarty_tpl ) );?>
";

  var mess_error2 = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please specify your Full Name','mod'=>'plugnpayapi','js'=>1),$_smarty_tpl ) );?>
";

  

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

  

<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "page_content"} */
}
