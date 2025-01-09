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

{$id_banner = $banner.id_banner}
<div class="banner-item clearfix" data-id="{$id_banner|intval}">
	<form method="post" action="" class="form-horizontal">
	<div class="banner-header clearfix">
		<input type="checkbox" value="{$id_banner|intval}" class="banner-box" title="{$id_banner|intval}">
		<span class="banner-name">
			<span class="banner-preview">
				<span {if isset($banner.header_img)}style="background-image:url({$banner.header_img|escape:'html':'UTF-8'})"{/if}>
					{if isset($banner.header_html)}HTML{/if}
				</span>
			</span>
			{$banner.title|escape:'html':'UTF-8'}
			{if !empty($banner.exc_note)}<span class="exc-note">{$banner.exc_note|escape:'html':'UTF-8'}</span>{/if}
		</span>

		<span class="actions pull-right">
			{if $banner.days_before_publish > 0}
				<span class="pub-note alert-info">{l s='Will be published in %d day(s)' mod='custombanners' sprintf=$banner.days_before_publish}</span>
			{else if $banner.days_expired > 0}
				<span class="pub-note alert-warning">{l s='Expired %d day(s) ago' mod='custombanners' sprintf=$banner.days_expired}</span>
			{/if}
			<a class="activateBanner list-action-enable action-{if $banner.active}enabled{else}disabled{/if}" href="#" title="{l s='Active' mod='custombanners'}">
				<i class="icon-check"></i>
				<i class="icon-remove"></i>
				<input type="checkbox" name="active" value="1" class="toggleable_param hidden"{if $banner.active} checked{/if}>
			</a>
			<i class="dragger act icon icon-arrows-v icon-2x"></i>
			<div class="btn-group pull-right">
				<button title="{l s='Edit' mod='custombanners'}" class="editBanner btn btn-default">
					<i class="icon-pencil"></i> {l s='Edit' mod='custombanners'}
				</button>
				<button title="{l s='Scroll Up' mod='custombanners'}" class="scrollUp btn btn-default">
					<i class="icon icon-minus"></i> {l s='Cancel' mod='custombanners'}
				</button>
				<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<i class="icon-caret-down"></i>
				</button>
				<ul class="dropdown-menu">
					<li class="dont-hide">
						{* can not use 'a' here, because e.preventDefault() doesnt work in this case *}
						<div class="toggle-hook-list dropdown-action"><i class="icon-copy"></i> {l s='Copy to hook' mod='custombanners'}</div>
						<div class="dynamic-hook-list" style="display:none;">
							<button class="btn btn-default copyToAnotherHook">{l s='OK' mod='custombanners'}</button>
						</div>
					</li>
					<li class="dont-hide">
						<div class="toggle-hook-list dropdown-action"><i class="icon-arrow-left"></i> {l s='Move to hook' mod='custombanners'}</div>
						<div class="dynamic-hook-list" style="display:none;">
							<button class="btn btn-default moveToAnotherHook">{l s='OK' mod='custombanners'}</button>
						</div>
					</li>
					<li>
						<div class="deleteBanner dropdown-action">
							<i class="icon icon-trash"></i>
							{l s='Delete' mod='custombanners'}
						</div>
					</li>
				</ul>
			</div>

		</span>
	</div>

	<div class="banner-details" style="display:none;">
		<div class="ajax-errors alert alert-danger" style="display:none"></div>
		{foreach from=$input_fields item=field key=input_name}
		{if isset($field.display_name)}
		<div class="form-group {$input_name|escape:'html':'UTF-8'}{if !isset($banner.content.$input_name) && empty($field.always_visible)} empty{/if}">
			<label class="control-label col-lg-1">
				<span{if isset($field.tooltip)} class="label-tooltip" data-toggle="tooltip" title="{$field.tooltip|escape:'html':'UTF-8'}"{/if}>
					{$field.display_name|escape:'html':'UTF-8'}
				</span>
				<a href="#" class="show-field" title="{l s='Add' mod='custombanners'}"><i class="icon-plus"></i></a>
			</label>
			<div class="col-lg-10 clearfix">
			{foreach from = $languages item = lang}
				{$id_lang = $lang.id_lang}
				{if isset($banner.content.$input_name.$id_lang)}
					{$value = $banner.content.$input_name.$id_lang}
				{else}
					{$value = 0}
				{/if}
				<div class="multilang lang-{$id_lang|intval}" data-lang="{$id_lang|intval}" style="{if $id_lang != $id_lang_current}display: none;{/if}">
				{if $input_name == 'img' || $input_name == 'img_hover'}
					<div class="img-holder{if $value} has-img{/if}">
						<div class="img-uploader">
							<i class="icon-file-image-o"></i>
							{l s='Drag your image here, or' mod='custombanners'}
							<a href="#" class="img-browse">{l s='browse' mod='custombanners'}</a>
							<input type="file" class="banner_img_file" name="banner_{$input_name|escape:'html':'UTF-8'}_{$id_lang|intval}" style="display:none;">
							<input type="hidden" class="banner_img_name" name="banner_data[{$id_lang|intval}][{$input_name|escape:'html':'UTF-8'}]" value="{if $value}{basename($value)|escape:'html':'UTF-8'}{/if}">
						</div>
						{if $value}
							<img src="{$value|escape:'html':'UTF-8'}">
						{/if}
						<i class="icon-trash delete-image act" title="{l s='Delete' mod='custombanners'}"></i>
					</div>
				{else if $input_name == 'link'}
					<select name="banner_data[{$id_lang|intval}][link][type]" class="col-lg-3 linkTypeSelector">
						{foreach $field.selector key=k item=type}
							<option value="{$k|escape:'html':'UTF-8'}"{if $value && $value.type == $k} selected{/if}>{$type|escape:'html':'UTF-8'}</option>
						{/foreach}
					</select>
					<div class="input-group link-type col-lg-9" data-type="{if $value && $value.type}{$value.type|escape:'html':'UTF-8'}{else}custom{/if}">
						<span class="input-group-addon">
							<span class="any">{l s='Any URL' mod='custombanners'}</span>
							<span class="by_id">
								<span class="label-tooltip" data-toggle="tooltip" title="{l s='Just add the ID of selected resource. For example: \"10\"' mod='custombanners'}">
									<i class="icon-info-circle"></i>
								</span>
								{l s='ID' mod='custombanners'}
							</span>
						</span>
						<input type="text" name="banner_data[{$id_lang|intval}][link][href]" value="{if $value && $value.href}{$value.href|escape:'html':'UTF-8'}{/if}">
						<span class="input-group-addon">
							<label class="label-checkbox">
								<input type="checkbox" name="banner_data[{$id_lang|intval}][link][_blank]" value="1"{if $value && isset($value._blank)} checked="checked"{/if}>
								{l s='new window' mod='custombanners'}
							</label>
						</span>
					</div>
				{else if $input_name == 'html'}
					<textarea class="mce" name="banner_data[{$id_lang|intval}][{$input_name|escape:'html':'UTF-8'}]" id="banner_{$id_banner|intval}_{$input_name|escape:'html':'UTF-8'}_{$id_lang|intval}">{if $value}{$value}{* can not be escaped *}{/if}</textarea>
				{else if $input_name == 'class'}
					<div class="input-group">
						<input type="text" name="banner_data[{$id_lang|intval}][class]" value="{if $value}{$value|escape:'html':'UTF-8'}{/if}" class="all-langs" data-all="txt-class">
						<span class="input-group-addon act show-classes">
							{l s='Predefined classes' mod='custombanners'}
							<i class="icon-angle-down"></i>
						</span>
					</div>
				{else if $input_name == 'exceptions'}
					{foreach $field.selectors as $key => $selector}
						<div class="exceptions-block {$key|escape:'html':'UTF-8'}{if $value && $value[$key]['type']} has-ids{/if}">
							<select name="banner_data[{$id_lang|intval}][exceptions][{$key|escape:'html':'UTF-8'}][type]" class="exc all-langs {$key|escape:'html':'UTF-8'}" data-all="select-exc-{$key|escape:'html':'UTF-8'}">
								{foreach $selector as $k => $type}
									<option value="{$k|escape:'html':'UTF-8'}"{if $value && $value[$key]['type'] == $k} selected{/if}>{$type|escape:'html':'UTF-8'}</option>
								{/foreach}
							</select>
							<div class="input-group exc-ids">
								<span class="input-group-addon">
									<span class="label-tooltip" data-toggle="tooltip" title="{l s='For example: 11, 15, 18' mod='custombanners'}">
										{$show_exclude_txt = $value && Tools::substr($value[$key]['type'], -4) == '_all'}
										<span class="include-ids-txt{if $show_exclude_txt} hidden{/if}">{l s='IDs' mod='custombanners'}</span>
										<span class="exclude-ids-txt{if !$show_exclude_txt} hidden{/if}">{l s='Except IDs' mod='custombanners'}</span>
									</span>
								</span>
								<input type="text" name="banner_data[{$id_lang|intval}][exceptions][{$key|escape:'html':'UTF-8'}][ids]" value="{if $value && $value[$key]['ids']}{$value[$key]['ids']|escape:'html':'UTF-8'}{/if}" class="ids all-langs" data-all="txt-exc-{$key|escape:'html':'UTF-8'}">
							</div>
						</div>
					{/foreach}
				{else}
					<input type="text" name="banner_data[{$id_lang|intval}][{$input_name|escape:'html':'UTF-8'}]" id="banner_{$id_banner|intval}_{$input_name|escape:'html':'UTF-8'}_{$id_lang|intval}" value="{if $value}{$value|escape:'html':'UTF-8'}{/if}" class="{if isset($field.all_langs)}all-langs{/if}{if !empty($field.datepicker)} datepicker all-langs{/if}"{if !empty($field.datepicker)} data-all="txt-{$input_name|escape:'html':'UTF-8'}"{/if}>
				{/if}
				</div>
			{/foreach}
			</div>
			<div class="col-lg-1">
				{if !isset($field.all_langs)}
				<div class="banner-langs">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						{foreach from=$languages item=lang}
							<span class="multilang lang-{$lang.id_lang|intval}" style="{if $lang.id_lang != $id_lang_current}display:none;{/if}">{$lang.iso_code|escape:'html':'UTF-8'}</span>
						{/foreach}
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						{foreach from=$languages item=lang}
						<li>
							<a href="#" onclick="event.preventDefault(); selectLanguage($(this), {$lang.id_lang|intval})">
								{$lang.name|escape:'html':'UTF-8'}
							</a>
						</li>
						{/foreach}
					</ul>
				</div>
				{/if}
				{if empty($field.always_visible)}
				<i class="icon-times hide-field act" title="{l s='Remove' mod='custombanners'}"></i>
				{/if}
				{if !empty($field.datepicker)}
					<a href="#" class="clear-date {$input_name|escape:'html':'UTF-8'} hidden"><i class="icon-eraser"></i> {l s='Clear date' mod='custombanners'}</a>
				{/if}
			</div>
		</div>
		{/if}
		{/foreach}
		<div class="p-footer">
			<input type="hidden" name="id_banner" value="{$id_banner|intval}">
			<input type="hidden" name="hook_name" value="{$banner.hook_name|escape:'html':'UTF-8'}">
			<input type="hidden" name="id_wrapper" value="{$banner.id_wrapper|intval}">
			<button class="saveBanner btn btn-default">
				<i class="process-icon-save"></i>
				{l s='Save' mod='custombanners'}
			</button>
			<label class="label-checkbox">
				<input type="checkbox" name="lang_source" value="{$id_lang_current|intval}" >
				{l s='Copy all data from selected language to others' mod='custombanners'}
			</label>
		</div>
	</div>
	</form>
</div>
{* since 2.9.1 *}
