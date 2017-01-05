<link rel ="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/app.chi.css">
<section class="content-header">
    <h1>
        <small>
            <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
            <i class="fa fa-fw fa-angle-double-right"></i> Input
            <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url();?>/input/aircraft_type"> All Aircraft</a>
            <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $type;?> <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url('/input/performance/' . $type . '/' . $reg['regName']);?>"><?php echo $reg['regName'];?></a>
            <i class="fa fa-fw fa-angle-double-right"></i> <i class="fa fa-plane"></i> Functionality
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
                    <h3 class="box-title">Problem Identification Corrective Action </h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr class="btn-github">
                                <th class="text-center">Name</th>
                                <th class="text-center">Items</th>
                                <th class="text-center">Defects</th>
                                <th class="text-center">Remark</th>
                                <th class="text-center">Corrective Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($detail as $v) {
                            ?>
                            <tr>
                                <td><?php echo $v['subName']; ?></td>
                                <td class="text-center"><?php echo $v['subItems']; ?></td>
                                <td class="text-center"><?php echo $v['subDefects']; ?></td>
                                <td><?php echo $v['subRemark']; ?></td>
                                <td class="text-center" view="editCa" datafiid="<?= $v['itemID'];?>" dataitem="<?= $v['subItems'];?>" datadate="<?= $v['date'];?>" datafisid="<?= $v['subID'];?>"><?php echo $v['ca']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/exporting.js"></script>
<script type="text/javascript">
	var regID = '<?php echo $reg["regID"];?>';
	var baseUrl = '<?php echo site_url() ?>/view/';
    var inputUrl = '<?php echo site_url() ?>/input/';
	var chartData = <?php echo json_encode($performance); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.view_functionality.js"></script>