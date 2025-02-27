{*
 * PrestaChamps
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Commercial License
 * you can't distribute, modify or sell this code
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file
 * If you need help please contact leo@prestachamps.com
 *
 * @author    Mailchimp
 * @copyright Mailchimp
 * @license   commercial
 *}
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>{l s='ID' mod='mailchimppro'}</th>
            <th></th>
            <th>{l s='Name' mod='mailchimppro'}</th>
            <th>{l s='Description' mod='mailchimppro'}</th>
            <th>{l s='Type' mod='mailchimppro'}</th>
            <th>{l s='Vendor' mod='mailchimppro'}</th>
            <th>{l s='Variants' mod='mailchimppro'}</th>
            <th>{l s='Actions' mod='mailchimppro'}</th>
        </tr>
        </thead>
        <tbody>
        {foreach $products as $product}
            <tr>
                <td>{$product.id|escape:'htmlall':'UTF-8'}</td>
                <td>
                    <img src="{$product.image_url|escape:'htmlall':'UTF-8'}" class="img-responsive img-thumbnail">
                </td>
                <td>
                    <a href="{$product.url|escape:'htmlall':'UTF-8'}">
                        {$product.title|escape:'htmlall':'UTF-8'}
                    </a>
                </td>
                <td>{$product.description nofilter}</td> {* HTML comment, no escape necessary *}
                <td>{$product.type|escape:'htmlall':'UTF-8'}</td> {* HTML comment, no escape necessary *}
                <td>{$product.vendor|escape:'htmlall':'UTF-8'}</td> {* HTML comment, no escape necessary *}
                <td>
                    {include file='./product/variants.tpl' variants=$product.variants}
                </td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <a class="btn btn-default" href="{LinkHelper::getAdminLink('AdminMailchimpProProducts', true, [], ['action' => 'entitydelete', 'entity_id' => $product.id])|escape:'htmlall':'UTF-8'}" title="{l s='Delete' mod='mailchimppro'}">
                            <i class="icon icon-trash" aria-hidden="true"></i>
                            <span>{l s='Delete' mod='mailchimppro'}</span>
                        </a>
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>