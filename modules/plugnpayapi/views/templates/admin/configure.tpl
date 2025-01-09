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
<script type="text/javascript">
	$(document).ready(function() {
		var id_section = {$section_adminpage};
		//$("#discount").attr("disabled","disabled");
		$("#discount").removeAttr("disabled", "disabled");

		var section = ["general", "control_fraude", "medios_pago", "cms_entidades", "cms_medios_pago",
			"cms_planes", "cms_interes"
		];
		var tabs = ["tab1", "tab2", "tab3", "tab4", "tab5", "tab6", "tab7"];

		switch (id_section) {
			case 7:
				sectindex = "cms_interes";
				tabindex = "tab7";
				break;
			case 5:
			case 4:
				sectindex = "cms_medios_pago";
				tabindex = "tab5";
				break;
			case 5:
				sectindex = "cms_entidades";
				tabindex = "tab4";
				break;
			case 1:
				sectindex = "general";
				tabindex = "tab1";
				break;
			default:
				sectindex = "general";
				tabindex = "tab1";
				break;
		}

		loop_section(sectindex, tabindex);

		//click tab event
		$("#general_tab").click(function() {
			loop_section("general", "tab1");
		});

		$("#control_fraude_tab").click(function() {
			loop_section("control_fraude", "tab2");
		});

		$("#cms_medios_pago_tab").click(function() {
			loop_section("cms_medios_pago", "tab5");
		});

		$("#cms_entidades_tab").click(function() {
			loop_section("cms_entidades", "tab4");
		});

		$("#cms_planes_tab").click(function() {
			loop_section("cms_planes", "tab6");
		});
		$("#cms_interes_tab").click(function() {
			loop_section("cms_interes", "tab7");
		});

		//mejorar este codigo
		$("#id_entity").hide();
		$("#id_medio").hide();
		$("#id_promocion").hide();
		$("#id_interes").hide();

		{if isset($smarty.get.update_promocion) || isset($smarty.get.add_promocion) }                     
			loop_section("cms_planes", "tab6");
		{/if}

		{if isset($smarty.get.update_interes) || isset($smarty.get.add_interes)}                     
			loop_section("cms_interes", "tab7");
		{/if}
		{if isset($smarty.get.update_entidad) || isset($smarty.get.add_entidad)}                     
			loop_section("cms_entidades", "tab4");
		{/if}
		{*
		var urlAjax = "{$url_base}modules/decidir/ajax/back/ajaxadminloadpromos.php";

		$.ajax({
			url: urlAjax,
			type: 'get',
			dataType: "json",
			data: {
				ajax_payment_method: 1
			},
			success: function(dataResponse) {
				$("#promo_type").attr("selected", "selected");
				$("#payment_method")[0].options.length = 0;

				$.each(dataResponse, function(key, data) {
					//$("#payment_method").append("<option value='"+data.id+"''>"+data.name+"</option>");
				})
			}
		});

		*}

	$("#promo_type").change(function() {

		$('#payment_method')[0].options.length = 0;

		$.ajax({
			url: urlAjax,
			type: 'get',
			dataType: "json",
			data: {
				ajax_payment_method: $("#promo_type").val()
			},
			success: function(dataResponse) {

				$.each(dataResponse, function(key, data) {
					$("#payment_method").append("<option value='" + data.id + "''>" + data
						.name + "</option>");
				})
			}
		});

		if ($("#promo_type").val() == 1) {
			$("#entity").removeAttr("disabled");
			$("#quote").val("0");
			$("#quote").removeAttr("disabled");
			$("#porcentaje").val("0");
			$("#porcentaje").removeAttr("disabled");
		} else {
			$('#entity').val(0).change();
			$("#entity").attr("disabled", "disabled");
			$("#quote").val("0");
			$("#quote").attr("disabled", "disabled");
			$("#porcentaje").val("0");
			$("#porcentaje").attr("disabled", "disabled");
		}

	});

	$("#interes_visa").addClass("active");
	//init show payment method
	$(".list_interes").hide();
	var select_value = $("#interest_pmethod_field").val();
	var id_first_element = "#box_" + select_value; $(id_first_element).show();

	$("#interest_pmethod_field").change(function() {
		$(".list_interes").each(function(index) {
			$(".list_interes").hide();
			var select_value = $("#interest_pmethod_field").val();
			var id_first_element = "#box_" + select_value;
			$(id_first_element).show();
		});
	});

	//visibility of select 
	/*if($("#module_form_8").is(':visible')){
		$("#pmethod_select_interes").hide();
	}else{
		$("#pmethod_select_interes").show();
	}*/

	//hide select
	if ($("#fieldset_0_5_5").is(":visible")) {
		$("#pmethod_select_interes").hide();
	}

	function loop_section(contentindex, tab) {

		//index of section
		var index;
		for (index = 0; index < section.length; ++index) {
			console.log(section[index] + "==" + contentindex);

			if (section[index] == contentindex) {
				$("#" + contentindex).addClass("active");
			} else {
				$("#" + section[index]).removeClass("active");
			}
		}

		var indextab;
		for (indextab = 0; indextab < tabs.length; ++indextab) {
			console.log(tabs[indextab] + "==" + tab);

			if (tabs[indextab] == tab) {
				console.log("#" + tab);

				$("#" + tab).addClass("active");
			} else {
				$("#" + tabs[indextab]).removeClass("active");
			}
		}
	}
	});


	//promo datepickers
	$(function() {
		$("#TRdatepicker").datepicker({
			dateFormat: "yyyy-mm-dd"
		});
	});
</script>

<script>
	$(document).ready(function() {

		function populateMultiSelect(data, selector) {
			$.each(data.split(','), function(i, e) {
				$(selector + " option[value='" + e + "']").prop("selected", true);
			});
		}

		var dataDays="{$id_days}";
		var dataInstallments="{$id_installments}";

		populateMultiSelect(dataDays, "#id_days");
		populateMultiSelect(dataInstallments, "#id_installment");

	});
</script>

<!-- Tab nav -->
<style>
	@media (max-width: 992px) {
		.table-responsive-row td:nth-of-type(1):before {
			content: "Id";
		}

		.table-responsive-row td:nth-of-type(2):before {
			content: "Cuotas";
		}

		.table-responsive-row td:nth-of-type(3):before {
			content: "Marca";
		}

		.table-responsive-row td:nth-of-type(4):before {
			content: "Tarjetas";
		}

		.table-responsive-row td:nth-of-type(5):before {
			content: "Coeficiente";
		}

		.table-responsive-row td:nth-of-type(6):before {
			content: "Activado";
		}
	}

	#pmethod_select_interes {
		margin: 5px 0 15px 0;
	}

	#date_from.datepicker,
	#date_to.datepicker {
		width: 100% !important;
	}
</style>

<ul class="nav nav-tabs" id="todopagoConfig">
	<li id="tab1" class="active">
		<a href="#" id="general_tab">
			<i class="icon-cogs"></i>
			{l s='General configuration' mod='decidir'}
		</a>
	</li>
	<li id="tab2">
		<a href="#" id="control_fraude_tab">
			<i class="icon-shield"></i>
			{l s='Cybersource configuration' mod='decidir'}
		</a>
	</li>
	<!--li id="tab3">
		<a href="#" id="medios_pago_tab">
			<i class="icon-cogs"></i>
			Configuraci&oacute;n Medios de Pago
		</a>
	</li-->
	<li id="tab5">
		<a href="#" id="cms_medios_pago_tab">
			<i class="icon-credit-card"></i>
			{l s='AMB Payment methods' mod='decidir'}
		</a>
	</li>
	<li id="tab4">
		<a href="#" id="cms_entidades_tab">
			<i class="icon-building"></i>
			{l s='ABM Entities' mod='decidir'}
		</a>
	</li>
	<li id="tab6">
		<a href="#" id="cms_planes_tab">
			<i class="icon-money"></i>
			{l s='ABM Payment plans' mod='decidir'}
		</a>
	</li>
	<li id="tab7">
		<a href="#" id="cms_interes_tab">
			<i class="icon-superscript"></i>
			{l s='ABM Installments' mod='decidir'}
		</a>
	</li>
</ul>
<div class="tab-content panel">
	<!-- Tab Configuracion -->
	<div class="tab-pane active" id="general">
		<div class="panel">
			<div class="panel-heading">
				<i class="icon-cogs"></i>{l s='Documentation' mod='decidir'}
			</div>
			<center>
			<img src="{$module_dir|escape:'htmlall':'UTF-8'}views/img/readme.png" style="  width: 31px;margin: 5px;" />
			<a href="{$module_dir|escape:'htmlall':'UTF-8'}readme.pdf" target="_blank">README</a> /
			<img src="{$module_dir|escape:'htmlall':'UTF-8'}views/img/readme.png" style="  width: 31px;margin: 5px;" /><a href="{$module_dir|escape:'htmlall':'UTF-8'}termsandconditions.pdf" target="_blank">TERMS</a> / <img src="{$module_dir|escape:'htmlall':'UTF-8'}views/img/excel.png" style="  width: 31px;margin: 5px;" />
			<a href="{$module_dir|escape:'htmlall':'UTF-8'}planilla.xlsx" target="_blank">{l s='XLS form to send to Decidir' mod='decidir'}</a>
			</center>
			<br/>	<br/>
			<p><i class="icon-credit-card"></i> {l s='Testing credit cards' mod='decidir'}</p>
			<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-sm border-info">
			  <thead>
				<tr>
				  <th scope="col"></th>
				  <th scope="col">VISA</th>
				  <th scope="col">MASTERCARD</th>
				  <th scope="col">CABAL</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <th scope="row">N°</th>
				  <td>4507 9900 0000 4905</td>
				  <td>5299 9100 1000 0015</td>
				  <td>5896 5700 0000 0008</td>
				</tr>
				<tr>
				  <th scope="row">{l s='Valid until' mod='decidir'} </th>
				  <td>12/30</td>
				  <td>12/30</td>
				  <td>12/30</td>
				</tr>
				<tr>
				  <th scope="row">{l s='CVC' mod='decidir'}</th>
				  <td>123</td>
				  <td>123</td>
				  <td>123</td>
				</tr>
			  </tbody>
		  
			</table>
		  </div>
		</div>
		{$config_general nofilter}
	</div>
	<!-- Tab Cybersource -->
	<div class="tab-pane" id="control_fraude">
		{$config_cybersource nofilter}
	</div>
	<!-- Tab Medios de pago -->
	<div class="tab-pane" id="medios_pago">

		{$cms_mediospago nofilter}
	</div>
	<!-- Tab CMS entidad -->
	<div class="tab-pane" id="cms_entidades">
		<span style="float:right;" class="panel-heading-action">
			<a style="decoration:none; position: relative;float: left;" id="desc-zone-new" class="list-toolbar-btn"
				href="{$urlAddEntity|escape}">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Add new' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-new"></i>
				</span>
			</a>
			<a class="list-toolbar-btn" style=" position: relative;float: left;" href="javascript:location.reload();">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Refresh' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-refresh"></i>
				</span>
			</a>
		</span>
		{$cms_entidades nofilter}
	</div>
	<!-- Tab CMS Medios de pago -->
	<div class="tab-pane" id="cms_medios_pago">
		<span style="float:right;" class="panel-heading-action"><a
				style="decoration:none;    position: relative;float: left;" id="desc-zone-new" class="list-toolbar-btn"
				href="{$urlAddBank|escape}">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Add new' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-new"></i>
				</span>
			</a>
			<a class="list-toolbar-btn" style="    position: relative;float: left;"
				href="javascript:location.reload();">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Refresh' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-refresh"></i>
				</span>
			</a>
		</span>
		{$cms_mediospago nofilter}
	</div>
	<!-- Tab CMS planes de pago -->
	<div class="tab-pane" id="cms_planes">
		<span style="float:right;" class="panel-heading-action">
			<a style="decoration:none;    position: relative;float: left;" id="desc-zone-new" class="list-toolbar-btn"
				href="{$urlAddPromo|escape}">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Add new' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-new"></i>
				</span>
			</a>
			<a style="decoration:none;    position: relative;float: left;" href="javascript:location.reload();">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Refresh' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-refresh"></i>
				</span>
			</a>
		</span>
		{$cms_planespago nofilter}
	</div>
	<!-- Tab CMS intereses -->
	<div class="tab-pane" id="cms_interes">
		<span style="float:right;" class="panel-heading-action">
			<a style="decoration:none; position: relative;float: left;" id="desc-zone-new" class="list-toolbar-btn"
				href="{$urlAddInteres}">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Add new' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-new"></i>
				</span>
			</a>
			<a class="list-toolbar-btn" style="decoration:none;    position: relative;float: left;"
				href="javascript:location.reload();">
				<span title="" data-toggle="tooltip" class="label-tooltip"
					data-original-title="{l s='Refresh' mod='decidir'}" data-html="true" data-placement="top">
					<i class="process-icon-refresh"></i>
				</span>
			</a>
		</span>
		<div>
			{$cms_selectInteresList nofilter}
		</div>
		<div class="tab-content panel">
			<div class="tab-pane" id="interes_visa">
				{$cms_interes nofilter}
			</div>
		</div>
	</div>
</div>