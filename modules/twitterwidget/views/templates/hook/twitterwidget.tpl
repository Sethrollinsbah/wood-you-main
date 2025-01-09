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
*}

<div class="theme-carousel twitter-box {$hook_name|escape:'html':'UTF-8'}{if !in_array($hook_name, ['displayHome', 'displayTwitter'])} container{/if}">
	{if !empty($twitt_title_text)}
		<h2 class="twitter-title">{$twitt_title_text|escape:'html':'UTF-8'}</h2>
	{/if}
	{if !empty($twitt_undertitle_text)}
		<h5 class="twitter-subtitle">{$twitt_undertitle_text|escape:'html':'UTF-8'}</h5>
	{/if}
	<div class="tweets-container">
		<a class="twitter-bird" href="http://www.twitter.com/{$TWITTLOGIN|escape:'html':'UTF-8'}" target="_blank"><i class="icon-twitter"></i></a>
		<div class="twitter-carousel">
			{foreach name=tweets from=$TWITTER_RESPONSE item=t}
				{if $smarty.foreach.tweets.iteration <= $NUMBOFTWITTS}
					<div class="item-tweet">
						{if isset($t.text)}
							<span class="tweet-content">{$t.text|escape:'html':'UTF-8'}</span><br>
							<span class="tweet-date">{$t.created_at|escape:'html':'UTF-8'}</span>
						{else}
							{l s='YOUR TWITTER LINE IS EMPTY!' mod='twitterwidget'}
							<span>{l s='Check your login in configuration' mod='twitterwidget'}!</span>
						{/if}
					</div>
				{/if}
			{/foreach}
		</div>
	</div>
</div>
