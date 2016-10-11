<script type="text/javascript">
function view_ac_delivery_report(id){
	var id_ac_delivery = id;
	
	if(id_ac_delivery != ''){
		$.post (
			'<?php echo site_url('/aircraft_status/ac_delivery_report/ajax_detail_ac_delivery_report'); ?>'
			, {
				/*<?php echo $this->security->get_csrf_token_name(); ?>: token_cookie
				,*/ id_ac_delivery : id_ac_delivery
			}
			, function(data) {
				var arr_val = data.split('#');
				$('[name=operator]').val(arr_val[1]);
				$('[name=aircraft_status]').val(arr_val[2]);
				$('[name=model]').val(arr_val[3]);
				$('[name=msn]').val(arr_val[4]);
				$('[name=original_export_date]').val(arr_val[5]);
				$('[name=last_export_date]').val(arr_val[6]);
				$('[name=act_delivery_date]').val(arr_val[7]);
				$('[name=acceptence]').val(arr_val[8]);
				$('[name=previous_registry]').val(arr_val[9]);
				$('[name=lessor]').val(arr_val[10]);
				$('[name=owner]').val(arr_val[11]);
				$('[name=owner_address]').val(arr_val[12]);				
				$('[name=engine1_mnf]').val(arr_val[13]);
				$('[name=date_engine1_mnf]').val(arr_val[14]);
				$('[name=pn_engine1]').val(arr_val[15]);
				$('[name=sn_engine1]').val(arr_val[16]);
				$('[name=engine2_mnf]').val(arr_val[17]);
				$('[name=date_engine2_mnf]').val(arr_val[18]);
				$('[name=pn_engine2]').val(arr_val[19]);
				$('[name=sn_engine2]').val(arr_val[20]);
				$('[name=engine3_mnf]').val(arr_val[21]);
				$('[name=date_engine3_mnf]').val(arr_val[22]);
				$('[name=pn_engine3]').val(arr_val[23]);
				$('[name=sn_engine3]').val(arr_val[24]);
				$('[name=engine4_mnf]').val(arr_val[25]);
				$('[name=date_engine4_mnf]').val(arr_val[26]);
				$('[name=pn_engine4]').val(arr_val[27]);
				$('[name=sn_engine4]').val(arr_val[28]);
				$('[name=date_apu_mnf]').val(arr_val[29]);
				$('[name=apu_model]').val(arr_val[30]);
				$('[name=pn_apu]').val(arr_val[31]);
				$('[name=sn_apu]').val(arr_val[32]);
				$('[name=nlg_mnf]').val(arr_val[33]);
				$('[name=date_nlg_mnf]').val(arr_val[34]);
				$('[name=pn_nlg]').val(arr_val[35]);
				$('[name=sn_nlg]').val(arr_val[36]);					
				$('[name=mlg_lg_mnf]').val(arr_val[37]);
				$('[name=date_mlg_lg_mnf]').val(arr_val[38]);
				$('[name=pn_mlg_lh]').val(arr_val[39]);
				$('[name=sn_mlg_lh]').val(arr_val[40]);
				$('[name=mlg_rh_mnf]').val(arr_val[41]);
				$('[name=date_mlg_rh_mnf]').val(arr_val[42]);
				$('[name=pn_mlg_rh]').val(arr_val[43]);
				$('[name=sn_mlg_rh]').val(arr_val[44]);				
			}
		);	
	}
}

$().ready(function(){	 
	var aircraft_registry = '<?php echo $aircraft_registry; ?>';
	var model			  = '<?php echo $model; ?>';
	var msn			  	  = '<?php echo $msn; ?>';
	var original_start	  = '<?php echo $original_start; ?>';
	var original_end	  = '<?php echo $original_end; ?>';
	var acceptance_start  = '<?php echo $acceptance_start; ?>';
	var acceptance_end	  = '<?php echo $acceptance_end; ?>';
	var lessor	  		  = '<?php echo $lessor; ?>';
	var pn_engine	  	  = '<?php echo $pn_engine; ?>';
	var sn_engine	  	  = '<?php echo $sn_engine; ?>';
	var pn_apu	  	  	  = '<?php echo $pn_apu; ?>';
	var sn_apu	  	  	  = '<?php echo $sn_apu; ?>';
	var pn_nlg	  	  	  = '<?php echo $pn_nlg; ?>';
	var sn_nlg	  	  	  = '<?php echo $sn_nlg; ?>';
	
	var data = "aircraft_registry" + aircraft_registry + 
				"&model" + model + 
				"&msn" + msn + 
				"&original_start" + original_start + 
				"&original_end" + original_end +
				"&acceptance_start" + acceptance_start + 
				"&acceptance_end" + acceptance_end +
				"&lessor" + lessor +
				"&pn_engine" + pn_engine +
				"&sn_engine" + sn_engine +
				"&pn_apu" + pn_apu +
				"&sn_apu" + sn_apu + 
				"&pn_nlg" + pn_nlg +
				"&sn_nlg" + sn_nlg; 
	
	$('#datatables').dataTable({
		"scrollY"			: "342px",
		"scrollX"			: true,
        "scrollCollapse"	: true,
		"paging"			: false,
		"searching"			: false,
		"processing" 		: true, //Feature control the processing indicator.
		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
		"order" 	 		: [], //Initial no order.

		// Load data for the table's content from an Ajax source
		"ajax": {
			"url"	: "<?php echo site_url('aircraft_status/ac_delivery_report/ajax_ac_delivery_report'); ?>",
			"type"	: "POST",
			"data"	: {
				aircraft_registry:aircraft_registry,
				model : model,
				msn   : msn,
				original_start : original_start,
				original_end : original_end,
				acceptance_start : acceptance_start,
				acceptance_end : acceptance_end,
				lessor : lessor,
				pn_engine : pn_engine,
				sn_engine : sn_engine,
				pn_apu : pn_apu,
				sn_apu : sn_apu,
				pn_nlg : pn_nlg,
				sn_nlg : sn_nlg
			}
		},

		//Set column definition initialisation properties.
		"columnDefs" : [
			{ 
				"targets"	: [ 0 ], //first column / numbering column
				"orderable"	: false, //set not orderable
			},
		],
	});
});
</script>

<section class="content-header">
	<h1>Original AC Delivery Report <small><i class="fa fa-fw fa-angle-double-right"></i> List Data</small></h1>
</section>

<div class="actions">
	<a href="<?php echo $add; ?>" class="btn btn-flat bg-light-blue color-palette btn-sm"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add New</a>
	<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
</div>

<div class="block-table table-sorting clearfix"><!-- block-fluid table-sorting clearfix -->
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tabel" id="datatables">
		<thead>
			<tr>
				<th width="2%">no</th>
				<th width="">aircraft registry</th>
				<th width="">model</th>
				<th width="">MSN</th>
				<th width="">org. exp. date</th>
				<th width="">acceptence</th>
				<th width="">lessor</th>
				<th width="">PN engine1</th>
				<th width="">SN engine1</th>
				<th width="">PN apu</th>
				<th width="">SN apu</th>
				<th width="">PN nlg</th>
				<th width="">SN nlg</th>
				<th width="2%">action</th>
			</tr>
		</thead>
	</table>
</div>