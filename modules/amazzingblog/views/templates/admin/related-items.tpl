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

<div class="ab related-items {$type|escape:'html':'UTF-8'}">
	<div class="input-group ">
		<input type="text" class="related-items-autocomplete" autocomplete="off">
		<span class="input-group-addon"><i class="icon-search"></i></span>
	</div>
	<div class="related-items-list">
		{if !empty($related_items)}
		{foreach $related_items as $item}
			<div class="related-item" data-id="{$item.id|intval}">
				<button type="button" class="btn btn-default removeRelatedItem"><i class="icon-remove"></i></button>
				<span class="item-id">{$item.id|intval}</span>
				<span class="item-name">{$item.name|escape:'html':'UTF-8'}</span>
			</div>
		{/foreach}
		{/if}
	</div>
	<input type="hidden" class="related-ids" name="{$input_name|escape:'html':'UTF-8'}" value="{$imploded_ids|escape:'html':'UTF-8'}">
</div>

{* This file will be used for posts and products. So we include JS/CSS here for portability *}
{literal}
<style type="text/css">
	.ab .related-items-list {
		margin: 10px 0;
	}
	.ab .related-item {
		margin: 10px 0;
		cursor: pointer;
	}
	.ab .related-item .item-id {
		color: #CCC;
		margin: 0 5px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		{/literal}
		var $relatedContainer = $(".ab.related-items.{$type|escape:'html':'UTF-8'}"),
			$autoCompleteInput = $relatedContainer.find(".related-items-autocomplete"),
			$itemsList = $relatedContainer.find(".related-items-list"),
			$relatedIDsInput = $relatedContainer.find("input.related-ids"),
			autoCompleteAjaxPath = ab_ajax_path+"&action=GetAutocompleteMatches&type={$type|escape:'html':'UTF-8'}";
		{literal}
		$autoCompleteInput.autocomplete(autoCompleteAjaxPath, {
			minChars: 1,
			autoFill: false,
			max:10,
			cacheLength:0,
			formatItem: function(item) {
				item = splitItem(item[0]);
				return item ? item[0]+' - '+item[1] : false;
			},
			extraParams: {
				excluded_ids: getRelatedIDs(),
			}
		}).result(function(result, data, formatted){
			formatted = splitItem(formatted);
			if (!formatted) {
				return;
			}
			var id = formatted[0],
				text = formatted[1],
				html = '<div class="related-item" data-id="'+id+'"><button type="button" class="btn btn-default removeRelatedItem"><i class="icon-remove"></i></button><span class="item-id">'+id+'</span><span class="item-name">'+text+'</span></div>';
			$itemsList.prepend(html);
			updateRelatedInput();
			$autoCompleteInput.val('');
			sortableRelated();
		});
		sortableRelated();

		$relatedContainer.on('click', '.removeRelatedItem', function(e){
			e.preventDefault();
			$(this).parent().remove();
			updateRelatedInput();
		});

		// make sure item has format ID - NAME
		function splitItem(item) {
			item = item.split(' - ');
			// return item; // debug
			var id = item.shift(),
				name = item.join(' - ');
			return (id && parseInt(id) == id && name) ? [id, name] : false;
		}

		function sortableRelated() {
			$itemsList.sortable({
				stop: function() {
		        	updateRelatedInput();
		        },
			});
		}

		function updateRelatedInput() {
			var ids = [];
			$itemsList.find('.related-item').each(function(){
				ids.push($(this).data('id'));
			});
			$relatedIDsInput.val(ids.join(','));
			$autoCompleteInput.setOptions({
				extraParams: {excluded_ids : getRelatedIDs()}
			});
		}

		function getRelatedIDs(){
			return $relatedIDsInput.val();
		}
	});
</script>
{/literal}

{* since 1.3.0 *}
