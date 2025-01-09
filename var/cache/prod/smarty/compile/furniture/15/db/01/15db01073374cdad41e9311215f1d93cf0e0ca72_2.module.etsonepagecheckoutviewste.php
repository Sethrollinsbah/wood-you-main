<?php
/* Smarty version 3.1.48, created on 2025-01-07 11:40:02
  from 'module:etsonepagecheckoutviewste' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677d58e2a9bae6_93588742',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15db01073374cdad41e9311215f1d93cf0e0ca72' => 
    array (
      0 => 'module:etsonepagecheckoutviewste',
      1 => 1736189423,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677d58e2a9bae6_93588742 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="product-line-grid">
  <!--  product left content: image-->
  <div class="product-line-grid-left col-md-3 col-xs-4">
    <span class="product-image media-middle">
      <?php if ($_smarty_tpl->tpl_vars['product']->value['default_image']) {?>
          <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['default_image']['bySize']['cart_default']['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'quotes' )), ENT_QUOTES, 'UTF-8');?>
" loading="lazy">
      <?php } else { ?>
        <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['urls']->value['no_picture_image']['bySize']['cart_default']['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" loading="lazy" />
      <?php }?>
    </span>
  </div>

  <!--  product left body: description -->
  <div class="product-line-grid-body col-md-4 col-xs-8">
    <div class="product-line-info product_info_name">
      <a class="label" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-id_customization="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_customization']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a>
    </div>
      <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['attributes'])) && $_smarty_tpl->tpl_vars['product']->value['attributes']) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['attributes'], 'value', false, 'attribute');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
          <div class="product-line-info attribute">
            <span class="label"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['attribute']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
:</span>
            <span class="value"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['value']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
          </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php }?>
    <div class="hidden_mobile product-line-info product-price h5 <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>has-discount<?php }?>">
      <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
        <div class="product-discount">
          <span class="regular-price"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['regular_price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
          <?php if ($_smarty_tpl->tpl_vars['product']->value['discount_type'] === 'percentage') {?>
            <span class="discount discount-percentage">
                -<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['discount_percentage_absolute'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

              </span>
          <?php } else { ?>
            <span class="discount discount-amount">
                -<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['discount_to_display'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

              </span>
          <?php }?>
        </div>
      <?php }?>
      <div class="current-price">
        <span class="price"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['unit_price_full']) {?>
          <div class="unit-price-cart"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['unit_price_full'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
        <?php }?>
      </div>
    </div>


    <?php if (is_array($_smarty_tpl->tpl_vars['product']->value['customizations']) && Ets_onepagecheckout::validateArray($_smarty_tpl->tpl_vars['product']->value['customizations']) && count($_smarty_tpl->tpl_vars['product']->value['customizations'])) {?>
      <br>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['customizations'], 'customization');
$_smarty_tpl->tpl_vars['customization']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->do_else = false;
?>
          <a href="#" data-toggle="modal" data-target="#product-customizations-modal-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['customization']->value['id_customization']), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</a>
          <div class="modal fade customization-modal" id="product-customizations-modal-<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['customization']->value['id_customization']), ENT_QUOTES, 'UTF-8');?>
" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product customization','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</h4>
                </div>
                <div class="modal-body">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customization']->value['fields'], 'field');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>
                    <div class="product-customization-line row">
                      <div class="col-sm-3 col-xs-4 label">
                            <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['label'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                      </div>
                      <div class="col-sm-9 col-xs-8 value">
                        <?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'text') {?>
                          <?php if ((int)$_smarty_tpl->tpl_vars['field']->value['id_module']) {?>
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['text'];?>

                          <?php } else { ?>
                            <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['text'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                          <?php }?>
                        <?php } elseif ($_smarty_tpl->tpl_vars['field']->value['type'] == 'image') {?>
                          <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['field']->value['image']['small']['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                        <?php }?>
                      </div>
                    </div>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
              </div>
            </div>
          </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
  </div>

  <!--  product left body: description -->
  <div class="product-line-grid-right product-line-actions col-md-5 col-xs-12">
    <div class="row">
      <div class="col-md-10 col-xs-12 form_info_price_mobile">
        <div class="row">
          <div class="col-xs-4 form_price hidden_desktop" data-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
">
            <div class="product-line-info product-price h5 <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>has-discount<?php }?>">
              <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>
                <div class="product-discount">
                  <span class="regular-price"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['regular_price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                  <?php if ($_smarty_tpl->tpl_vars['product']->value['discount_type'] === 'percentage') {?>
                    <span class="discount discount-percentage">
                -<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['discount_percentage_absolute'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

              </span>
                  <?php } else { ?>
                    <span class="discount discount-amount">
                -<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['discount_to_display'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

              </span>
                  <?php }?>
                </div>
              <?php }?>
              <div class="current-price">
                <span class="price"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['price'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['unit_price_full']) {?>
                  <div class="unit-price-cart"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['unit_price_full'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                <?php }?>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-4 qty" data-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Qty','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
">
            <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['is_gift'])) && $_smarty_tpl->tpl_vars['product']->value['is_gift']) {?>
              <span class="gift-quantity"><?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['quantity']), ENT_QUOTES, 'UTF-8');?>
</span>
            <?php } else { ?>
              <input
                class="js-cart-line-product-quantity"
                data-down-url="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['down_quantity_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_country=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::getValue('id_country'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_state=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::getValue('id_state'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                data-up-url="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['up_quantity_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_country=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::getValue('id_country'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_state=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::getValue('id_state'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                data-update-url="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['update_quantity_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_country=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::getValue('id_country'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&id_state=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( Tools::getValue('id_state'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                data-product-id="<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
"
                type="number"
                value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                name="product-quantity-spin"
                min="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['minimal_quantity'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
              />
            <?php }?>
          </div>
          <div class="col-md-6 col-xs-4 form_total_price" data-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
">
            <span class="product-price">
              <strong>
                <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['is_gift'])) && $_smarty_tpl->tpl_vars['product']->value['is_gift']) {?>
                  <span class="gift"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Gift','mod'=>'ets_onepagecheckout'),$_smarty_tpl ) );?>
</span>
                <?php } else { ?>
                  <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['total'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                <?php }?>
              </strong>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-xs-4 text-xs-right ets_remove_cart">
        <div class="cart-line-product-actions">
          <a
              class                       = "remove-from-cart"
              rel                         = "nofollow"
              href                        = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['remove_from_cart_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
              data-link-action            = "ets-delete-from-cart"
              data-id-product             = "<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product']), ENT_QUOTES, 'UTF-8');?>
"
              data-id-product-attribute   = "<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']), ENT_QUOTES, 'UTF-8');?>
"
              data-id-customization   	  = "<?php echo htmlspecialchars(intval($_smarty_tpl->tpl_vars['product']->value['id_customization']), ENT_QUOTES, 'UTF-8');?>
"
          >
            <?php if (!(isset($_smarty_tpl->tpl_vars['product']->value['is_gift'])) || !$_smarty_tpl->tpl_vars['product']->value['is_gift']) {?>
                <span class="ets_icon_svg">
                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z"/></svg>
                </span>
            <?php }?>
          </a>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayCartExtraProductActions','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>

        </div>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
</div>
<?php }
}
