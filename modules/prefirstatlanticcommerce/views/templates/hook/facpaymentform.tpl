{*
*  2014-2020 Prestashoppe
*
*  @author    Prestashoppe
*  @copyright 2014-2020 Prestashoppe
*  @license   Prestashoppe Commercial License
*}

<div class="pre-fac-payment">
    <form action="{$action_url}" id="fac-payment-form">
        <input type="hidden" name="token" value="{$token}" />
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fac-card-number" class="control-label fac-control-label">{l s='Card number' mod='prefirstatlanticcommerce'} <span class="required">*</span></label>
                    <input name="fac-card-number" id="fac-card-number" type="tel" class="input-lg form-control fac-card-number" autocomplete="fac-card-number" placeholder="•••• •••• •••• ••••" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fac-card-expiry" class="control-label fac-control-label">{l s='Card expiry (MM/YYYY)' mod='prefirstatlanticcommerce'} <span class="required">*</span></label>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <select id="fac-card-expiry-month" class="form-control form-control-select" name="fac-card-expiry-month">
                                {foreach from=$months item=month}
                                    <option value="{$month}">{$month}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <select id="fac-card-expiry-year" class="form-control form-control-select" name="fac-card-expiry-year">
                                {foreach from=$years item=year key=key}
                                    <option value="{$key}">{$year}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fac-card-cvc"  class="control-label fac-control-label">{l s='CVC' mod='prefirstatlanticcommerce'} <span class="required">*</span></label>
                    <input name="fac-card-cvc" id="fac-card-cvc" type="tel" class="input-lg form-control fac-card-cvc" autocomplete="off" placeholder="•••" required>
                </div>
            </div>
        </div>
    </form>
</div>
