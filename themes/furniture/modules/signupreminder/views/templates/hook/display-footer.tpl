{*
* 2007-2018 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- Sign-Up Reminder Module -->
<style>
	.sur-container {
		height: {$height|intval}px;
		margin-left: -{math equation="width / 2" width=$width format="%d"}px;
		margin-top: -{math equation="height / 2" height=$height format="%d"}px;
		width: {$width|intval}px;
	}

	.sur-title {
		color: {$title_color|escape:'html':'UTF-8'};
		font-size: {$title_size|intval}px;
	}

	.sur-message {
		color: {$message_color|escape:'html':'UTF-8'};
		font-size: {$message_size|intval}px;
	}
</style>

<div id="sur-lightbox" class="sur-lightbox">
	<div id="sur-container" class="sur-container">
		<div id="sur-form" class="sur-form{if $image_enabled == 1} {if $image_position == 'left'}sur-right{else}sur-left{/if}{/if}">
			<h1 class="sur-title">{$title|escape:'html':'UTF-8'}</h1>
			<p class="sur-message">{$message|escape:'html':'UTF-8'}</p>
			<form>
				<ul>
					{if $name_enabled == 1}
					<li><input id="sur-firstname" class="sur-text" type="text" placeholder="{l s='First name' mod='signupreminder'}"{if $name_required == 1} required="required"{/if}></li>
					<li><input id="sur-lastname" class="sur-text" type="text" placeholder="{l s='Last name' mod='signupreminder'}"{if $name_required == 1} required="required"{/if}></li>
					{/if}
					{if $gender_enabled == 1}
						<li>
							<input id="sur-male" type="radio" class="sur-radio" name="sur-gender" value="1" checked="checked">
							<label class="sur-label" for="sur-male"></label>
							<span class="sur-label-text">{l s='Male' mod='signupreminder'}</span>
							<input id="sur-female" type="radio" class="sur-radio" name="sur-gender" value="2">
							<label class="sur-label" for="sur-female"></label>
							<span class="sur-label-text">{l s='Female' mod='signupreminder'}</span>
						</li>
					{/if}
					{if $birthdate_enabled == 1}
					<li><input id="sur-birthdate" class="sur-text" type="text" placeholder="{l s='Your birthday' mod='signupreminder'}"{if $birthdate_required == 1} required="required"{/if}></li>
					{/if}
					<li><input id="sur-email" class="sur-text" type="text" placeholder="{l s='Your email address' mod='signupreminder'}" required="required"></li>
					<li>
						<button id="sur-submit" class="sur-submit" type="button">
							<svg id="icon-mail" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 44 44">
								<g>
								  <g>
								    <g>
								      <path d="M43,6H1C0.447,6,0,6.447,0,7v30c0,0.553,0.447,1,1,1h42c0.552,0,1-0.447,1-1V7C44,6.447,43.552,6,43,6z M42,33.581     L29.612,21.194l-1.414,1.414L41.59,36H2.41l13.392-13.392l-1.414-1.414L2,33.581V8h40V33.581z"/>
								    </g>
								  </g>
								  <g>
								    <g>
								      <path d="M39.979,8L22,25.979L4.021,8H2v0.807L21.293,28.1c0.391,0.391,1.023,0.391,1.414,0L42,8.807V8H39.979z"/>
								    </g>
								  </g>
								</g>
							</svg>
							{l s='Sign Up' mod='signupreminder'}
						</button>
					</li>
				</ul>
			</form>
			<p id="sur-warning" class="sur-warning sur-hidden">{l s='Please make sure all the highlighted fields are filled out correctly' mod='signupreminder'}</p>
		</div>
		{if $image_enabled == 1}
			<div id="sur-image" class="sur-image {if $image_position == 'left'}sur-left{else}sur-right{/if}" style="background-image: url({$image|escape:'html':'UTF-8'});">
			</div>
		{/if}
		<p id="sur-confirmation" class="sur-confirmation sur-hidden">{l s='Thank you for signing up!' mod='signupreminder'}</p>
		<span id="sur-close" class="sur-close"></span>
	</div>
</div>

<script type="text/javascript">
	var sur_delay = {$delay|intval},
		sur_dir = '{$module_dir|escape:"html":"UTF-8"}',
		sur_secure_key = '{$secure_key|escape:"html":"UTF-8"}';
</script>
<!-- end Sign-Up Reminder Module -->