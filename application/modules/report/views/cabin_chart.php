<section class="content-header">
	<h1>Dashboard</h1>
</section>
<section class="content">
	<div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Cabin performance Monitoring</h3>
        		  	<div class="box-tools pull-right">
          			  <select name="performanceType">
          			  	<option value="">-- Performance type --</option>
          			  	<option value="1">Cabin Function</option>
                    <option value="2">Interior Appearance</option>
                    <option value="3">Exterior Appearance</option>
          			  </select>

                  <select name="acType">
                    <option value="">-- Aircraft Type</option>
                    <?php
                    foreach($type as $tv) {
                    ?>
                    <option value="<?php echo $tv->id;?>"><?php echo $tv->name_aircraft;?></option>
                    <?php
                    }
                    ?>
                  </select>

                  <select name="acReg">
                    <option value="">-- Aircraft Registered --</option>
                  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="cabinChart"></div>
        		</div>
        	</div>
    	</div>
    </div>
</section>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/exporting.js"></script>
<script type="text/javascript">
	var myBaseUrl = "<?php echo site_url('report');?>";
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.cabin.charts.js"></script>