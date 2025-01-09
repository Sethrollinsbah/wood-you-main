{*
*  2014-2020 Prestashoppe
*
*  @author    Prestashoppe
*  @copyright 2014-2020 Prestashoppe
*  @license   Prestashoppe Commercial License
*}

<div id="" class="panel">
    <div class="panel-heading">
        <i class="icon-money"></i>
        {l s='Thawani Pay Payment Info' mod='prethawanipay'}
    </div>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                {if $prethawanipaymentdata.payment_id}
                    <tr><td><strong>{l s='Payment Id' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.payment_id}</td></tr>
                {/if}
                {if $prethawanipaymentdata.merchant_reference}
                    <tr><td><strong>{l s='Merchant Reference' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.merchant_reference}</td></tr>
                {/if}
                {if $prethawanipaymentdata.amount}
                    <tr><td><strong>{l s='Amount' mod='prethawanipay'}</strong></td> <td>{Tools::displayPrice($prethawanipaymentdata.amount)}</td></tr>
                {/if}
                {if $prethawanipaymentdata.language}
                    <tr><td><strong>{l s='Language' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.language}</td></tr>
                {/if}
                {* {if $prethawanipaymentdata.transaction_date}
                    <tr><td><strong>{l s='Transaction Date' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.transaction_date}</td></tr>
                {/if} *}
                {if $prethawanipaymentdata.transaction_status}
                    <tr><td><strong>{l s='Transaction Status' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.transaction_status}</td></tr>
                {/if}
                {* {if $prethawanipaymentdata.code}
                    <tr><td><strong>{l s='Code' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.code}</td></tr>
                {/if} *}
                {if $prethawanipaymentdata.message}
                    <tr><td><strong>{l s='Message' mod='prethawanipay'}</strong></td> <td>{$prethawanipaymentdata.message}</td></tr>
                {/if}
            </tbody>
        </table>
    </div>
</div>

