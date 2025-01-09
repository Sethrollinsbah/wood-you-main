{*
*  2014-2020 Prestashoppe
*
*  @author    Prestashoppe
*  @copyright 2014-2020 Prestashoppe
*  @license   Prestashoppe Commercial License
*}

<div id="pre-fac-payment-info" class="box">
    <h4>{l s='Fac Payment Info' mod='prefirstatlanticcommerce'}</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tbody>
                {if $prefacpaymentdata.order_number}
                    <tr><td><strong>{l s='Merchant Order Id' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.order_number}</td></tr>
                {/if}
                {if $prefacpaymentdata.reference_number}
                    <tr><td><strong>{l s='Reference Number' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.reference_number}</td></tr>
                {/if}
                {if $prefacpaymentdata.padded_card_no}
                    <tr><td><strong>{l s='Padded Card Number' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.padded_card_no}</td></tr>
                {/if}
                {if $prefacpaymentdata.auth_code}
                    <tr><td><strong>{l s='Auth Code' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.auth_code}</td></tr>
                {/if}
                {if $prefacpaymentdata.cavvv_value}
                    <tr><td><strong>{l s='CAVV Value' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.cavvv_value}</td></tr>
                {/if}
                {if $prefacpaymentdata.eci_indicator}
                    <tr><td><strong>{l s='ECI Indicator' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.eci_indicator}</td></tr>
                {/if}
                {if $prefacpaymentdata.transaction_stain}
                    <tr><td><strong>{l s='Transaction Stain' mod='prefirstatlanticcommerce'}</strong></td> <td>{$prefacpaymentdata.transaction_stain}</td></tr>
                {/if}
            </tbody>
        </table>
    </div>
</div>

