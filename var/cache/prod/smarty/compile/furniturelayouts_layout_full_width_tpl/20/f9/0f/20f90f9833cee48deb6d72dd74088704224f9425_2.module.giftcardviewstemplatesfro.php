<?php
/* Smarty version 3.1.48, created on 2025-01-07 08:03:01
  from 'module:giftcardviewstemplatesfro' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d2605ac1637_13913518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20f90f9833cee48deb6d72dd74088704224f9425' => 
    array (
      0 => 'module:giftcardviewstemplatesfro',
      1 => 1735772756,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d2605ac1637_13913518 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1170306984677d2605a8bb97_77278203', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content'} */
class Block_1170306984677d2605a8bb97_77278203 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_1170306984677d2605a8bb97_77278203',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div id="choicegiftcard" data-link-controller="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkcgc']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
		<div class="ui-loader-background"> </div>
	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Gift card','mod'=>'giftcard'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
	
	<?php echo $_smarty_tpl->tpl_vars['front_content']->value;?>
	
	<?php if (!(isset($_smarty_tpl->tpl_vars['templates']->value)) || count($_smarty_tpl->tpl_vars['templates']->value) == 0) {?>
		<p class="warning">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No model available','mod'=>'giftcard'),$_smarty_tpl ) );?>

		</p>
	<?php } elseif (!(isset($_smarty_tpl->tpl_vars['cards']->value)) || count($_smarty_tpl->tpl_vars['cards']->value) == 0) {?>
		<p class="warning">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No card available','mod'=>'giftcard'),$_smarty_tpl ) );?>

		</p>
	<?php } else { ?>
       <form class="form" id="formgiftcard" action="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkcgc']->value,'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" method="POST" target="_blank">
                <section  id= "gc-step-receptmode" class="js-current-step" data-gcstep-enable="1" data-gcstep-valid="0">
        <h2 class="step-title">
		    <i class="icon-ta-check done"></i>
		    <span class="step-number">1</span>
		    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select the reception mode','mod'=>'giftcard'),$_smarty_tpl ) );?>

		    <span class="step-edit text-muted"><i class="icon-ta-pencil"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'edit','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
  		</h2>
  		<div class="gc-section-content">
	    <div class="gc-receptmode-options">
	    <?php if ($_smarty_tpl->tpl_vars['virtual_cards_available']->value) {?>
	     <div class="gc-receptmode-option clearfix">
		     <span class="custom-radio pull-xs-left">
              <input
                class="ps-shown-by-js"
                id="receptmode_printathome"
                name="receptmode"
                type="radio"
                value="0"
              >
              <span></span>
            </span>
            <label for="receptmode_printathome">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Print at home','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
            </label>
           </div>
           <div class="gc-receptmode-option clearfix">
            <div>
            <span class="custom-radio pull-xs-left">
              <input
                class="ps-shown-by-js"
                id="receptmode_mail"
                name="receptmode"
                type="radio"
                value="1"
              >
              <span></span>
            </span>
            <label for="receptmode_mail">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send by e-mail','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
            </label>
            </div>
            <div id="recepmode-mail-additional-information">
	            <p class="email datesendcard">
			      <input name="mailto" type="text" class="input email" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To : Email','mod'=>'giftcard'),$_smarty_tpl ) );?>
" />
		        </p>
		        <p class="description datesendcard">
			         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The gift card will be sent by email to the recipient as soon as your payment is confirmed. You can also choose to send at a later date by selecting that date below.','mod'=>'giftcard'),$_smarty_tpl ) );?>
	
		        </p>
				<p class="select datesendcard">
										<select name="days" id="days">
						<option value="">-</option>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['days']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
							<option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['v']->value), ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_day']->value == $_smarty_tpl->tpl_vars['v']->value)) {?>selected="selected"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
					<select id="months" name="months">
						<option value="">-</option>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['months']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
							<option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['k']->value), ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_month']->value == $_smarty_tpl->tpl_vars['k']->value)) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['v']->value,'mod'=>'giftcard'),$_smarty_tpl ) );?>
&nbsp;</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
					<select id="years" name="years">
						<option value="">-</option>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['years']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
							<option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['v']->value), ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_year']->value == $_smarty_tpl->tpl_vars['v']->value)) {?>selected="selected"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['v']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;</option>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
				</p>
	        </div>
	       
           </div>
	     <?php }?>
	     <?php if ($_smarty_tpl->tpl_vars['physical_cards_available']->value) {?>
	     	<div class="gc-receptmode-option clearfix">
            <span class="custom-radio pull-xs-left">
              <input
                class="ps-shown-by-js"
                id="receptmode_post"
                name="receptmode"
                type="radio"
                value="2"
                <?php if (!$_smarty_tpl->tpl_vars['virtual_cards_available']->value) {?>checked<?php }?>
              >
              <span></span>
            </span>
            <label for="receptmode_post">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send by post','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
            </label>
           </div>
	     <?php }?>
	</div>
	
	<div class="clearfix gc-actions">
          <button class="btn btn-primary" type="button"  disabled="disabled" data-rel-gcstep="gc-step-template">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue','mod'=>'giftcard'),$_smarty_tpl ) );?>

          </button>
    </div>
	
		
	
	</div>
	</section>
		    <section  id= "gc-step-template" data-gcstep-enable="0" data-gcstep-valid="0">
    <h2 class="step-title">
	  <i class="icon-ta-check done"></i>
	  <span class="step-number">2</span>
	  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Select a template','mod'=>'giftcard'),$_smarty_tpl ) );?>

	  <span class="step-edit text-muted"><i class="icon-ta-pencil"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'edit','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
 	</h2>
 	<div class="gc-section-content">
	<div id="templates_block">
		<ul  class="gctabs clearfix">
			<li><a id="tab_template_all"  href="javascript:;" class="selected tab_template" data-tab="block_templates_all"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All','mod'=>'giftcard'),$_smarty_tpl ) );?>
&nbsp;(<span class="ta-gc-number"><?php echo htmlspecialchars(intval(count($_smarty_tpl->tpl_vars['templates']->value)), ENT_QUOTES, 'UTF-8');?>
</span>)</a></li>										
			<?php if ((isset($_smarty_tpl->tpl_vars['gc_tags']->value)) && $_smarty_tpl->tpl_vars['gc_tags']->value && count($_smarty_tpl->tpl_vars['gc_tags']->value) > 0) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gc_tags']->value, 'tag');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?> 
					<?php if (((isset($_smarty_tpl->tpl_vars['templatesGroupTag']->value[$_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']])) && count($_smarty_tpl->tpl_vars['templatesGroupTag']->value[$_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']]) > 0)) {?>
						<li>
							<a id="tab_template_tag<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']), ENT_QUOTES, 'UTF-8');?>
" href="javascript:;"  data-tab="block_templates_in_tags<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']), ENT_QUOTES, 'UTF-8');?>
"  class="tab_template"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['tag']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&nbsp;(<span class="ta-gc-number"><?php echo htmlspecialchars(count($_smarty_tpl->tpl_vars['templatesGroupTag']->value[$_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']]), ENT_QUOTES, 'UTF-8');?>
</span>)</a>
						</li>
					<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>
		</ul>
		<div>
						<div id="block_templates_all" class="gctab_content selected">
				<?php if ((isset($_smarty_tpl->tpl_vars['templates']->value)) && count($_smarty_tpl->tpl_vars['templates']->value) > 0) {?>
				<div class="jcarousel-wrapper" id="jcarouselcardtemplates-all">
	                <div class="jcarousel" >
	                    <ul>
	                    	
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['templates']->value, 'template', false, NULL, 'thumbnails', array (
));
$_smarty_tpl->tpl_vars['template']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['template']->value) {
$_smarty_tpl->tpl_vars['template']->do_else = false;
?>
									<?php if ($_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'] > 0) {?>
			                        <li class="template_item template_item<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['id_gift_card_template']), ENT_QUOTES, 'UTF-8');?>
 <?php if ((isset($_smarty_tpl->tpl_vars['template_default']->value)) && $_smarty_tpl->tpl_vars['template_default']->value->id == $_smarty_tpl->tpl_vars['template']->value['id_gift_card_template']) {?>js-template-default selected<?php }?>"  data-physicaluse="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['physicaluse']), ENT_QUOTES, 'UTF-8');?>
" data-virtualuse="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['virtualuse']), ENT_QUOTES, 'UTF-8');?>
">
			                        		<a href="javascript:;"  class="link_template" rel="link_template<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['id_gift_card_template']), ENT_QUOTES, 'UTF-8');?>
">

			                        			
			                        			<img src="<?php ob_start();
if ($_smarty_tpl->tpl_vars['template']->value['issvg']) {
echo "-";
echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_lang']->value), ENT_QUOTES, 'UTF-8');
}
$_prefixVariable1=ob_get_clean();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['giftcard_templates_dir']->value).((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."/".((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."-front".$_prefixVariable1.".jpg"),'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="
			                        			<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['template']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['template']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
			                        			
			                        			
			                        		</a>
			                        		
			                        		<a href="<?php ob_start();
if ($_smarty_tpl->tpl_vars['template']->value['issvg']) {
echo "-";
echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_lang']->value), ENT_QUOTES, 'UTF-8');
}
$_prefixVariable2=ob_get_clean();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['giftcard_templates_dir']->value).((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."/".((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."-thickbox".$_prefixVariable2),'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
.jpg" data-fancybox-group="other-views" class="thickbox-giftcard shown" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['template']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">	
			                        			<span class="zoom_link"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View larger','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
			                        		</a>
			                        		<span class="check"></span>
			                        </li>
									<?php }?>
			                	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		            	</ul>
	        		</div>
	       			<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
	        		<a href="#" class="jcarousel-control-next">&rsaquo;</a>
	        		<div class="jcarousel-pagination-container">
						<p class="jcarousel-pagination"></p>
					</div>
	            </div>
            	<?php }?>
			</div>
									<?php if ((isset($_smarty_tpl->tpl_vars['gc_tags']->value)) && $_smarty_tpl->tpl_vars['gc_tags']->value && count($_smarty_tpl->tpl_vars['gc_tags']->value) > 0) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gc_tags']->value, 'tag');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?> 
					<div id="block_templates_in_tags<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']), ENT_QUOTES, 'UTF-8');?>
" class="rte gctab_content">
					<?php if ((isset($_smarty_tpl->tpl_vars['templatesGroupTag']->value[$_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']])) && count($_smarty_tpl->tpl_vars['templatesGroupTag']->value[$_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']]) > 0) {?>
					<div class="jcarousel-wrapper" id="jcarouselcardtemplates-tag<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']), ENT_QUOTES, 'UTF-8');?>
">
		                <div class="jcarousel" >
		                <ul>
		                			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['templatesGroupTag']->value[$_smarty_tpl->tpl_vars['tag']->value['id_gift_card_tag']], 'template');
$_smarty_tpl->tpl_vars['template']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['template']->value) {
$_smarty_tpl->tpl_vars['template']->do_else = false;
?>
			                        <li class="template_item template_item<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['id_gift_card_template']), ENT_QUOTES, 'UTF-8');?>
 <?php if ((isset($_smarty_tpl->tpl_vars['template_default']->value)) && $_smarty_tpl->tpl_vars['template_default']->value->id == $_smarty_tpl->tpl_vars['template']->value['id_gift_card_template']) {?>selected<?php }?>"  data-physicaluse="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['physicaluse']), ENT_QUOTES, 'UTF-8');?>
" data-virtualuse="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['virtualuse']), ENT_QUOTES, 'UTF-8');?>
">

			                        		<a href="javascript:;"  class="link_template" rel="link_template<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template']->value['id_gift_card_template']), ENT_QUOTES, 'UTF-8');?>
">
			                        		
			                        		<img src="<?php ob_start();
if ($_smarty_tpl->tpl_vars['template']->value['issvg']) {
echo "-";
echo (string)$_smarty_tpl->tpl_vars['id_lang']->value;
}
$_prefixVariable3=ob_get_clean();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['giftcard_templates_dir']->value).((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."/".((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."-front".$_prefixVariable3.".jpg"),'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="
			                        			<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['template']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['template']->value['name'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
			                        		</a>
			                        		
			                        		<a href="<?php ob_start();
if ($_smarty_tpl->tpl_vars['template']->value['issvg']) {
echo "-";
echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_lang']->value), ENT_QUOTES, 'UTF-8');
}
$_prefixVariable4=ob_get_clean();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getMediaLink(((string)$_smarty_tpl->tpl_vars['giftcard_templates_dir']->value).((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."/".((string)$_smarty_tpl->tpl_vars['template']->value['id_gift_card_template'])."-thickbox".$_prefixVariable4),'quotes','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
.jpg" data-fancybox-group="other-views" class="thickbox-giftcard shown" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['template']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">	
			                        			<span class="zoom_link"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View larger','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
			                        		</a>
			                        		<span class="check"></span>
			                        	
			                        </li>

			                		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				        </ul>
		        		</div>
		        		<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
	        			<a href="#" class="jcarousel-control-next">&rsaquo;</a>
						<div class="jcarousel-pagination-container">
	        				<p class="jcarousel-pagination"></p>
						</div>
		        	</div>
					<?php }?>
					</div>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php }?>
					</div>
	</div>
	<div class="clearfix gc-actions">
          <button class="btn btn-primary" type="button"  disabled="disabled" data-rel-gcstep="gc-step-information">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Continue','mod'=>'giftcard'),$_smarty_tpl ) );?>

          </button>
    </div>
	</div>
	</section>
			<section  id= "gc-step-information" data-gcstep-enable="0" data-gcstep-valid="0">
	
    <h2 class="step-title">
	  <i class="icon-ta-check done"></i>
	  <span class="step-number">3</span>
	  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Gift card information','mod'=>'giftcard'),$_smarty_tpl ) );?>

	  <span class="step-edit text-muted"><i class="icon-ta-pencil"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'edit','mod'=>'giftcard'),$_smarty_tpl ) );?>
</span>
 	</h2>
 	<div class="gc-section-content">
	<input type="hidden" name="action" value="" />
	<input type="hidden" name="id_lang" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['id_lang']->value), ENT_QUOTES, 'UTF-8');?>
" />
	<input type="hidden" name="token" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['token_page']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
	<input type="hidden" name="id_gift_card_template" id="id_gift_card_template" value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['template_default']->value->id), ENT_QUOTES, 'UTF-8');?>
"/>
	<p> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Amount','mod'=>'giftcard'),$_smarty_tpl ) );?>
&nbsp;
		<select name="id_product_virtual" id="ta_gc_products_virtual">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cards']->value, 'carditem', false, NULL, 'foo', array (
));
$_smarty_tpl->tpl_vars['carditem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['carditem']->value) {
$_smarty_tpl->tpl_vars['carditem']->do_else = false;
?>
			<?php if ($_smarty_tpl->tpl_vars['carditem']->value['virtualcard'] == 1) {?>
	           	<option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['carditem']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
" <?php if (((!(isset($_smarty_tpl->tpl_vars['card']->value)) && $_smarty_tpl->tpl_vars['carditem']->value['isdefaultgiftcard']) || ((isset($_smarty_tpl->tpl_vars['card']->value)) && $_smarty_tpl->tpl_vars['card']->value->id == $_smarty_tpl->tpl_vars['carditem']->value['id_product']))) {?>selected<?php }?>>
	           	<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['carditem']->value['price_dp'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	           	</option>
	        <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       	</select>
	    <select name="id_product_physical" id="ta_gc_products_physical">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cards']->value, 'carditem', false, NULL, 'foo', array (
));
$_smarty_tpl->tpl_vars['carditem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['carditem']->value) {
$_smarty_tpl->tpl_vars['carditem']->do_else = false;
?>
			<?php if ($_smarty_tpl->tpl_vars['carditem']->value['virtualcard'] == 0) {?>
	           	<option value="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['carditem']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
" <?php if (((!(isset($_smarty_tpl->tpl_vars['card']->value)) && $_smarty_tpl->tpl_vars['carditem']->value['isdefaultgiftcard']) || ((isset($_smarty_tpl->tpl_vars['card']->value)) && $_smarty_tpl->tpl_vars['card']->value->id == $_smarty_tpl->tpl_vars['carditem']->value['id_product']))) {?>selected<?php }?>>
	           	<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['carditem']->value['price_dp'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

	           	</option>
	        <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       	</select>
		</p>
		<p class="from">
       		 <input name="from" type="text" class="input input_user_from" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'From : your lastname','mod'=>'giftcard'),$_smarty_tpl ) );?>
"  />
     	 </p>
      	<p class="name">
       		 <input name="lastname" type="text" class="input input_user_to" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To : Lastname','mod'=>'giftcard'),$_smarty_tpl ) );?>
"  />
     	</p>
      <p class="text">
        <textarea name="message" class="input textarea_comment"  placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Indicate your message','mod'=>'giftcard'),$_smarty_tpl ) );?>
" onkeyup="countChar(this)"></textarea>
        <div id="remaining characters">(<span id="charNum">200</span>&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'remaining characters','mod'=>'giftcard'),$_smarty_tpl ) );?>
)</div>
      </p>
            <div class="row ta-gc-submit">
      	<div class="col-sm-6">
      	   <button class="btn pull-xs-left" type="button"  disabled="disabled"  data-ta-action="preview">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Preview','mod'=>'giftcard'),$_smarty_tpl ) );?>

          </button>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-primary pull-xs-right" type="button"  disabled="disabled"  data-ta-action="add_to_cart">
              <i class="icon-ta-shopping-cart"></i>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add to cart','mod'=>'giftcard'),$_smarty_tpl ) );?>

          </button>
        </div>
    </div>
		</div>
	</section>
		<br/>
		<div class="messages"></div>
	
	</form>
	<?php }?>
</div>
<?php
}
}
/* {/block 'page_content'} */
}
