<?php
/* Smarty version 3.1.48, created on 2025-01-06 13:54:44
  from '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/boninstagramcarousel/views/templates/front/boninstagramcarousel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_677c26f4e93704_81508306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '340a00ed18f795cf4264eb56a8b9b6f3d678c9f6' => 
    array (
      0 => '/home/u695283169/domains/woodyoubahamas.com/public_html/modules/boninstagramcarousel/views/templates/front/boninstagramcarousel.tpl',
      1 => 1709033585,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677c26f4e93704_81508306 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="boninstagram">
    <div class="instagram-carousel-container clearfix block <?php if ($_smarty_tpl->tpl_vars['display_caroucel']->value) {?>bonhidden<?php }?>">
        <div class="instagram-home-title revealOnScroll animated fadeInUp" data-animation="fadeInUp">
            <h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Instagram','mod'=>'boninstagramcarousel'),$_smarty_tpl ) );?>
</h3>
            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Direct message us on our instagram for offers.','mod'=>'boninstagramcarousel'),$_smarty_tpl ) );?>
</span>
        </div>
        <div class="block_content">
            <ul class="instagram-list <?php if ($_smarty_tpl->tpl_vars['display_caroucel']->value) {?>owl-carousel-instagram owl-carousel owl-theme owl-loaded owl-drag <?php } else { ?>clearfix<?php }?>">
                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['limit']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['limit']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                    <li class="instagram-item <?php if (!$_smarty_tpl->tpl_vars['display_caroucel']->value) {?>instagram-item-gallery<?php }?> revealOnScroll animated fadeInUp" data-animation="fadeInUp" >
                        <a href="https://www.instagram.com/<?php if ($_smarty_tpl->tpl_vars['instagram_type']->value == "tagged") {?>explore/tags/<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['user_tag']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['user_id']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>/" target="_blank" rel="nofollow">
                            <img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['baseurl']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
img/parseImg/sample-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
.jpg" alt="instagram-<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['i']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                            <span class="instagram_cover"></span>
                            <svg class="insta-eye" x="0px" y="0px" viewBox="0 0 611.977 611.977" style="enable-background:new 0 0 611.977 611.977;" xml:space="preserve">
                            <g>
                                <path d="M604.056,284.039c-2.196-2.196-4.461-5.216-5.902-7.412c-48.18-52.641-103.018-92.654-162.317-120.108
                                    c-83.046-37.817-167.533-39.258-249.824-3.706c-63.005,26.698-120.108,68.221-172.68,125.255
                                    c-17.776,18.531-17.776,37.062,0,56.348C54.1,379.644,102.28,416.706,157.118,445.6c20.041,10.364,40.013,19.286,60.054,25.188
                                    c29.649,8.922,60.054,14.07,91.145,14.07l0,0c7.412,0,14.825,0,22.237-0.755c13.315-1.51,28.14-2.951,42.278-6.657
                                    c84.487-21.482,160.876-69.662,231.979-148.247C614.488,315.884,614.488,298.108,604.056,284.039z M582.574,310.737
                                    c-67.466,74.124-138.639,120.108-217.91,140.08c-12.628,2.951-26.698,4.461-38.572,5.902c-34.111,2.196-68.908-1.51-102.263-11.873
                                    c-18.531-5.902-37.062-13.315-54.838-23.747c-51.886-27.453-97.871-63.005-136.374-105.969c-8.167-8.922-8.167-11.119,0-19.286
                                    c50.377-54.083,103.773-93.409,163.072-118.598c36.307-15.58,73.369-23.747,109.675-23.747c39.258,0,78.585,8.922,117.843,27.453
                                    c56.348,25.943,108.234,64.515,154.15,114.137c1.51,1.51,2.951,3.706,4.461,5.216C584.839,304.079,585.525,307.785,582.574,310.737
                                    z M303.855,204.012c-57.103,0-103.773,46.67-103.773,103.773s46.67,103.773,103.773,103.773
                                    c57.103,0,103.773-46.67,103.773-103.773C408.383,250.683,361.713,204.012,303.855,204.012z M303.855,384.86
                                    c-42.278,0-76.32-34.111-76.32-76.32s34.111-76.388,76.32-76.388s76.32,34.111,76.32,76.32
                                    C380.999,349.995,346.133,384.86,303.855,384.86z"/>
                            </g>
                        </svg>
                        </a>
                    </li>
                <?php }
}
?>
            </ul>
        </div>
    </div>
</section><?php }
}
