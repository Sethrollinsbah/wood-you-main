{*
* 2007-2023 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2023 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<script>
	$(document).ready(function() {
		var refundtype = false;

		//$("#loader").show();
		$('#total_void_check').change(function() {
			if ($(this).is(':checked')) {
				console.log("active");
				$("#refundTotalCost").attr("disabled", "disabled");
				$("#refundTotalCost").val($("#order_amount").val());
				refundtype = true;
			} else {
				console.log("no active");
				$("#refundTotalCost").removeAttr("disabled");
				$("#refundTotalCost").val(0);
				refundtype = false;
			}
		});

		$("#refund-button").click(function() {
			$('#message').html("");
			$("#loader").show();

			$.ajax({
				type: "POST",
				url: "{$url_refund}",
				accepts: "application/json",
				data: {
					'orderOperation': "{$num_order_dec}",
					'orderecommerce': {$order_id},
					'amount': $("#refundTotalCost").val(),
					'refundtype': refundtype,
				},
				success: function(data) {
					//alert(data);
					$('#message_refund').text(data);
					$("#loader").hide();
				},
				error: function(data) {

				}
			});

		});
	});
</script>
<style>
	.left-position {
		width: 40%;
		margin-top: 10px;
	}

	#message_refund {
		color: red;
		font-size: 13px;
		margin: 0px 0 5px 0;
	}

	#loader {
		background-image: url({$module_dir}imagenes/loader.gif);
		width: 30px;
		height: 30px;
		border: 1px solid 000;
		float: left;
		margin: 1px 0 0 4px;
		display: none;
	}

	.left {
		float: left;
	}

	.right {
		float: right;
	}

	.clear {
		clear: both;
	}
</style>
<div class="card mt-2 d-print-none panel" id="refund-box ">

	<div class='card-header'>
		<h3>{l s='Decidir operation details' mod='decidir'}</h3>
	</div>
	<div class='card-body'>
		<p>


			<strong>{l s='Transaction ID' mod='decidir'}:</strong>{$site_transaction_id} <br />
			<strong>{l s='Amount' mod='decidir'} : </strong> {$amount} <br />
			<strong>{l s='Payment type' mod='decidir'}: </strong>{$payment_type} <br />
			<strong>{l s='State' mod='decidir'}: </strong>{$estado} <br />
			<strong>{l s='Bin' mod='decidir'}: </strong> {$bin}<br />
			<strong>{l s='Installment' mod='decidir'}: </strong> {$cuotas}<br />

		</p>


	</div>
	<div class="panel-heading card-header">

		<h3>D{l s='Decidir refunds' mod='decidir'}</h3>
		<span class="badge" id="id_decidir">{$num_order_dec}</span> ({l s='Transaction ID on Decidir' mod='decidir'})
	</div>
	<div class="panel panel-total left-position">
		<div class="table-responsive">
			<table class="table">
				<tr>
					<td class="text-right">{l s='Products' mod='decidir'}+{l s='Shipping' mod='decidir'}</td>
					<td class="amount text-right nowrap">
						{$total_pay} {$currency_code}
					</td>
					<td class="partial_refund_fields current-edit" style="display:block;">
						<div class="input-group">
							<div class="input-group-addon">
								{$currency_code}
							</div>
							<input type="text" name="partialRefundTotalCost" id="refundTotalCost" value="0">
						</div>
					</td>
					<input type="hidden" name="amount" id="order_amount" value="{$total_pay}">
				</tr>
				<tr id="total_order">
					<td class="text-right"><strong>Total</strong></td>
					<td class="amount text-right nowrap">
						<strong>{$total_pay} {$currency_code}</strong>
						<input type="hidden" id="total_payment_value" name="total_payment" value="{$total_pay}">
					</td>
					<td class="partial_refund_fields current-edit">
						<input type="checkbox" id="total_void_check" value="total_void">
						<span>{l s='Total refund' mod='decidir'}</span>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div id="message_refund"></div>
	<a href="#dec-refund" id="refund-button" class="btn btn-default left">
		<i class="icon-exchange"></i>
		{l s='Refund' mod='decidir'}
	</a>
	<div id="loader" class="right"></div>
	<div class="clear"></div>
	<!--a href="#dec-void" id="void-button" class="btn btn-default">
		<i class="icon-exchange"></i>
		Anulacion
	</a-->
</div>