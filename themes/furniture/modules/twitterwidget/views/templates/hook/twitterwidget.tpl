{* 
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2018 PrestaShop SA
* @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*

**
* This file will be removed in 1.6
*} 

<div id="twitter-widget" class="{$hook_name|escape:'html':'UTF-8'} twitter-box col-md-6 square_arrows">
	{if !empty($twitt_title_text)}
		<h2 class="title_main_section">
			<a href="http://www.twitter.com/{$TWITTLOGIN|escape:'intval'}" target="_blank">
			<span>
				<b>{$twitt_title_text|escape:'html':'UTF-8'}</b>
			</span>
			</a>
		</h2>
	{/if}
	{if !empty($twitt_undertitle_text)}
		<h5 class="twitter-subtitle">{$twitt_undertitle_text|escape:'html':'UTF-8'}</h5>
	{/if}
		<div class="twits_cont">
			<div class="wrap_tweets">
		         <div class="twitter_carousel">
					{foreach name=tweets from=$TWITTER_RESPONSE item=t}
						{if $smarty.foreach.tweets.iteration <= $NUMBOFTWITTS}
							{if isset($t.text)}
								<div class="item_twits">
									<p>
										{$t.text|escape:'html':'UTF-8'}
										<span>{$t.created_at|escape:'html':'UTF-8'}</span>
									</p> 
									
								</div>
							{else}
									<div class="item_twits">
										<p>{l s='YOUR TWITTER LINE IS EMPTY!' d='Shop.Theme.Global'}</p>
										<span>{l s='Check your login in configuration' d='Shop.Theme.Global'}!</span>
									</div>
							{/if}
						{/if}
					{/foreach}
				</div>
			</div>
		</div>
</div>