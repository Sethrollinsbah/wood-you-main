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

{if $iso_lang_current == 'some_other_lang'}
{else}
	<p>In order to export all current carousel data, just click "Export carousels" and save file. This file contains all multilingual data including hook positions and page exceptions.</p>
	</p>In order to import, just upload the file using "Import carousels" button. You can use this file on the same store as a backup, or you can upload it to any other store. When you upload the file, data is processed in a smart way to synchronize with installed languages/shops.</p>
	<p>Note: If you are using multistore, data is imported only to shops that are currently selected. It may be a single shop, a group of shops, or all shops. </p>
	<h4>Advanced use:</h4>
	<p>If you want, you can change pre-installed demo content, that is used every time on module reset. Same content is pre-installed when you export module as part of your theme. In order to do that, follow these steps:</p>
	<ol>
		<li>Make a regular export and save the file</li>
		<li>Rename file to "carousels-custom.txt"</li>
		<li>Move file to "/modules/easycaroulels/democontent/carousels-custom.txt"</li>
	</ol>
{/if}
{* since 2.5.0 *}
