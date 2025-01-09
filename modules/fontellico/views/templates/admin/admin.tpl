{*
* 2007-2018 Andrey & co
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author    Andrey <byalonovich@bk.ru>
*  @copyright 2015-2020 Andrey & co
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}
<div id="fontellico-module">
	<div class="clearfix" id="custom-classes-wrap">
		<button class="btn btn-default" id="select-css-icons" data-target="#modal_custom_classes_select" data-toggle="modal">{l s='Add custom class' mod='fontellico'}</button>
		<div>{l s='Custom classes' mod='fontellico'}</div>
		{if !empty($icons)}
			{foreach name=icons from=$icons item=icon}
				{foreach name=custom_classes from=$custom_classes item=custom_class}
					{if $custom_class.uid == $icon.uid}
						<div class="col-md-3 fticon">
							<span data-uid="{$icon.uid|escape:'html':'UTF-8'}"
								  data-src="{$icon.src|escape:'html':'UTF-8'}"
								  {if !empty($icon.svg)}
								  data-path="{$icon.svg.path|escape:'html':'UTF-8'}"
								  data-width="{$icon.svg.width|escape:'html':'UTF-8'}"
								  {/if}
								  class="{if !empty($prefix)}{$prefix|escape:'html':'UTF-8'}{/if}{$icon.css|escape:'html':'UTF-8'}"></span>
							<button class="del-icon btn btn-default" >x</button>
							<input size="5" class="code" value="{$icon.code|escape:'html':'UTF-8'}" />
							<div class="change-class-text">{l s='Change class' mod='fontellico'}</div>
							<table class="custom-class-table">
								<tr>
									<td>
										<input size="5" class="css" value="{$icon.css|escape:'html':'UTF-8'}" />
									</td>
									<td>
										=
									</td>
									<td>
										<input size="15" class="custom_css" value="{if !empty($custom_class.custom_class)}{$custom_class.custom_class|escape:'html':'UTF-8'}{/if}" />
									</td>
								</tr>

							</table>

						</div>
					{/if}
				{/foreach}
			{/foreach}
		{/if}
		<div class="change-class-text hidden">{l s='Change class' mod='fontellico'}</div>
	</div>
	<div class="clearfix">
	    <input id="icon-search" placeholder="{l s='Search' mod='fontellico'}"/>
	    <div >
		    <label for="fontello-prefix">{l s='Prefix' mod='fontellico'}</label>
			<input size="10" id="fontello-prefix" name="fontello-prefix" type="text" value="{if !empty($prefix)}{$prefix|escape:'html':'UTF-8'}{/if}" />
		</div>
		<div id="ft-icons" class="clearfix">
			{if !empty($icons)}
				{foreach name=icons from=$icons item=icon}
					<div class="col-md-1 fticon">
						<span data-uid="{$icon.uid|escape:'html':'UTF-8'}"
							  data-src="{$icon.src|escape:'html':'UTF-8'}"
							  {if !empty($icon.svg)}
							  data-path="{$icon.svg.path|escape:'html':'UTF-8'}"
							  data-width="{$icon.svg.width|escape:'html':'UTF-8'}"
							  {/if}
							  class="{if !empty($prefix)}{$prefix|escape:'html':'UTF-8'}{/if}{$icon.css|escape:'html':'UTF-8'}"
							  ></span>
						<button class="del-icon btn btn-default" >x</button>
						<input size="5" class="code" value="{$icon.code|escape:'html':'UTF-8'}" />
						<input size="5" class="css" value="{$icon.css|escape:'html':'UTF-8'}" />

					</div>
				{/foreach}
			{/if}
		</div>
			<button id="ajax-save" class="btn btn-default pull-right" data-url="{$ajax_url|escape:'html':'UTF-8'}" >
				<i class="process-icon-save"></i>{l s='Save' mod='fontellico'}
			</button>
			<button class="btn btn-default" id="add-icons" data-target="#modal_available_icons" data-toggle="modal">{l s='Add icons' mod='fontellico'}</button>
			<button class="btn btn-default" id="clear-icons" >{l s='Clear icons' mod='fontellico'}</button>
			<form action={$upload_form_url|escape:'html':'UTF-8'} method="POST" id="reset-form">
                <input type="hidden" name="reset_request" value="1"/>

                <input type="submit" id="submit-reset" value="{l s='Reset icons' mod='fontellico'}" class="btn btn-default" />
            </form>

			<input id="fix-unicode-input" placeholder="{l s='Add unicode value' mod='fontellico'}"/>
            <button id="fix-unicode" class="btn btn-default" data-url="{$ajax_url|escape:'html':'UTF-8'}" >
				{l s='Fix unicode' mod='fontellico'}
			</button>

	</div>
	<div class="import-export-section">
		<h4> {l s='Import/export' mod='fontellico'}</h4>
		<div class="col-md-3">
			<a href="{$download_url|escape:'html':'UTF-8'}" download class="btn btn-default">Download config file</a>
		</div>
		<div class="col-md-4">
			<form action={$upload_form_url|escape:'html':'UTF-8'} method="POST" enctype="multipart/form-data">
				<input type="hidden" name="upload_file_request" value="1"/>
				<div class="btn btn-default file-input">
					<span>{l s='Open config file...' mod='fontellico'}</span>
					<input type="file" id="zipped_config_data" name="zipped_config_data" />
				</div>
				<div class="checkbox pull-right">
					<label>
					  <input type="checkbox" id="add-to-config" name="add-to-config" />  {l s='Add to config' mod='fontellico'}
					</label>
				</div>

				<input type="submit" id="submit-upload" value="{l s='Upload' mod='fontellico'}" class="btn btn-default" disabled/>
			</form>
		</div>

	</div>
</div>