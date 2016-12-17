<link rel ="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/app.chi.css">
<section class="content-header">
    <h1>
        <small>
            <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
            <i class="fa fa-fw fa-angle-double-right"></i> View
            <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url();?>/view/aircraft_type"> All Aircraft</a>
            <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $type;?> <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url('/view/performance/' . $type . '/' . $reg['regName']);?>"><?php echo $reg['regName'];?></a>
            <i class="fa fa-fw fa-angle-double-right"></i> <i class="fa fa-plane"></i> Interior Appearance
        </small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-5">
        	 <!-- Bar chart -->
	      <div class="box box-primary">
	        <div class="box-header with-border">
	          <i class="fa fa-bar-chart-o"></i>
	          <h3 class="box-title">Current Performance </h3>
	        </div>
	        <div class="box-body">
	          <div id="bar-chart"></div>
	        </div>
	      </div>
        </div>
        <div class="col-md-7">
    		<div class="box box-danger">
    			<div class="box-header with-border">
	          		<h3 class="box-title">Detail cabin performance </h3>
    			</div>
    			<div class="box-body">
    				<select name="selectArea" class="form-control">
    					<?php
    					$data = array();
    					foreach ($items as $key => $val) {
    						if(isset($data[$val['iniID']])) {

    						}
  							else {
  								$data[$val['iniID']] = $val;
  								?>
  								<option value="<?php echo $val['iniID'];?>"><?php echo $val['iniName'];?></option>
  								<?php
  							}
  						}
    					?>
    				</select>
    				<table template="rows" class="table table-bordered table-responsive table-condensed" style="margin-top: 10px;">
			            <thead>
			            	<tr class="btn-github">
			            		<!--<th class="text-center">No.</th>-->
			            		<th class="text-center" style="vertical-align: middle;">Item</th>
			            		<th class="text-center" style="vertical-align: middle;">Remark</th>
			            		<th class="text-center">Total defect</th>
			            		<th class="text-center">Total dirty</th>
			            	</tr>
			            </thead>
			            <?php
    					$in = 1; 
    					$data = array();
    					foreach ($items as $key => $val) {
    						if(isset($data[$val['iniID']])) {
    						}
    						else {
    							$data[$val['iniID']] = $val;
    							?>
    							<tbody class="hidden" row="<?php echo $val['iniID'];?>">
    								<?php
    								$no = 1;
			                      	foreach ($items as $v) {
			                      		if($data[$val['iniID']]['iniID'] === $v['iniID']) {
			                      			?>
			                      			<tr>
			                      				<!--<td class="chi-middle-center" rowspan="2"><?php echo $no;?></td>-->
			                      				<td class="chi-middle" rowspan="2"><?php echo $v['inisName'];?></td>
			                      				<td class="chi-middle" rowspan="2"><?php echo $v['remark'];?></td>
			                      				<td class="text-center"><?php echo $v['defect'];?></td>
			                      				<td class="text-center"><?php echo $v['dirty'];?></td>
			                      			</tr>
			                      			<tr>
			                      				<td class="text-center"><?php echo $v['defectPerform'];?> %</td>
			                      				<td class="text-center"><?php echo $v['dirtyPerform'];?> %</td>
			                      			</tr>
			                      			<?php
			                      			$no++;
			                      		}
			                      	}
    								?>
    							</tbody>
    							<?php
    						}
    					}
    					?>
			        </table>
    			</div><!-- end body-->
    		</div>
    	</div>
    </div><!-- end row-->
</section>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/exporting.js"></script>
<script type="text/javascript">
	var regID = '<?php echo $reg["regID"];?>';
	var baseUrl = '<?php echo site_url() ?>/view/';
	var chartData = <?php echo json_encode($performance); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.view_interior.js"></script>
<!-- end single page -->