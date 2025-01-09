{*
* 2007-2018 Amazzing
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
*
*  @author    Amazzing <mail@amazzing.ru>
*  @copyright 2007-2018 Amazzing
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*
*}

{if $is_17}
	<h3>{l s='Related blog posts' mod='amazzingblog'}</h3>
	{if $id_product}
		<div class="form-group">
			<label class="control-label">
				<span class="label-tooltip" data-toggle="tooltip" title="{l s='For example 1,2,3' mod='amazzingblog'}">{l s='Post IDs' mod='amazzingblog'}</span>
			</label>
			<input type="text" name="related_post_ids" value="{$imploded_post_ids|escape:'html':'UTF-8'}">
		</div>
	{else}
		<div class="alert alert-warning">
			{l s='Please save product before adding related posts' mod='amazzingblog'}
		</div>
	{/if}
{else}
	<div id="product-relatedposts" class="panel product-tab">
	{if $id_product}
		<input type="hidden" name="submitted_tabs[]" value="amazzingblogmodule" />
		<h3><i class="icon-AdminBlog"></i> {l s='Related blog posts' mod='amazzingblog'}</h3>
		<div class="alert alert-info">
				{l s='Related posts will be displayed at the bottom of product page.' mod='amazzingblog'}
				<a href="{$ab_config_path|escape:'html':'UTF-8'}&tab=blocks&hook=displayFooterProduct" target="_blank">
					{l s='Edit block "Related posts"' mod='amazzingblog'} <i class="icon-external-link-sign"></i>
				</a>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2">{l s='Start typing...' mod='amazzingblog'}</label>
			<div class="col-lg-5">
				{include file='./related-items.tpl'
					type='post'
					input_name='related_post_ids'
					imploded_ids=$imploded_post_ids
					related_items=$related_post_items
				}
			</div>
		</div>
		<div class="panel-footer">
			<a href="{$link->getAdminLink('AdminProducts')|escape:'html':'UTF-8'}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel' mod='amazzingblog'}</a>
			<button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save' mod='amazzingblog'}</button>
			<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay' mod='amazzingblog'}</button>
		</div>
	{else}
		<div class="alert alert-warning">
			{l s='Please save product before adding related posts' mod='amazzingblog'}
		</div>
	{/if}
	</div>
{/if}
{* since 1.3.0 *}
