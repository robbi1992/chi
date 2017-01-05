<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard CHI - GMF</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/adminlte/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/adminlte/css/skins/_all-skins.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/stylesheet.css'); ?>" />

  <script type="text/javascript" src="<?php echo base_url('/assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/assets/plugins/adminlte/js/app.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('/assets/plugins/adminlte/js/demo.js'); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css');?>">
</head>
<body class="layout-top-nav skin-black">
<div class="body-page">
<nav class="navbar navbar-inverse navcustomgmf">
  <div class="container">
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-nav-gmf pull-right">
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('users_logged_in')->name_users; ?> <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="#"><span>Change Password</span></a></li>
        <li><a href="<?php echo site_url('/site/logout'); ?>"><span>Sign out</span></a></li> 
      </ul>
    </li>
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo site_url('/setting/users_group'); ?>"><span>Group Users</span></a></li>
        <li><a href="<?php echo site_url('/setting/users'); ?>"><span>Users Management</span></a></li> 
        <li><a href="<?php echo site_url('/setting/menu_management'); ?>"><span>Menu Management</span></a></li> 
      </ul>
    </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<!-- dont touch -->
<section class="content-header">
	<h1>
    <small>
      <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
      <i class="fa fa-fw fa-angle-double-right"></i> Charts
    </small>
    <span class="logo-lg pull-right">
      <img src="<?php echo base_url('/assets/images/banner01.png'); ?>" class="img-responsive" alt="img-responsive"
      style="width: 100px;" />
    </span>
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Cabin performance Index</h3>
          <div class="box-tools pull-right">
            <select name="weekCabin">
              <?php $weeks =  count_weeks();?>
              <option value="<?php echo $weeks;?>" selected>Week <?php echo $weeks;?></option>
              <?php
              for($i=$weeks-1; $i > $weeks-4; $i--){
                ?>
                <option value="<?php echo $i;?>">Week <?php echo $i;?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="box-body">
          <img name="chartGaugeLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
          <div class="hidden" id="chartGauge" style="height: 225px;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Functionality Status</h3>
        </div>
        <div class="box-body">
        <div class="row">
          <?php
          $icons = array(
              'IFE' => 'tv.png',
              'Galley' => 'kitchen.png',
              'Lavatory' => 'toilet.png',
              'Seat' => 'seat.png'
            );
          foreach($func_status as $vals) {
            ?>
            <div class="col-md-6">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><img src="<?php echo base_url('/assets/images/' . $icons[$vals['funcName']]);?>"></span>
                <div class="info-box-content">
                  <span class="info-box-text" style="font-size: 22px;"><?php echo $vals['funcName'];?></span>
                  <span class="info-box-number" style="font-size: 28px;"><?php echo $vals['funcPerform'];?> %</span>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div><!-- end row -->
        </div><!-- end box body-->
      </div><!-- end box primary -->
    </div><!-- end col -->
  </div><!-- end row -->
  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">HIL Ratio</h3>
          <div class="box-tools pull-right">
            <select name="weekHil">
              <?php $weeks =  count_weeks();?>
              <option value="<?php echo $weeks;?>" selected>Week <?php echo $weeks;?></option>
              <?php
              for($i=$weeks-1; $i > $weeks-4; $i--){
                ?>
                <option value="<?php echo $i;?>">Week <?php echo $i;?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="box-body">
          <img name="chartHilLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
          <div class="hidden" id="chartHil" style="height: 225px;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">KPI</h3>
          <div class="box-tools pull-right">
            <select name="weekKcms">
              <?php $weeks =  count_weeks();?>
              <option value="<?php echo $weeks;?>" selected>Week <?php echo $weeks;?></option>
              <?php
              for($i=$weeks-1; $i > $weeks-4; $i--){
                ?>
                <option value="<?php echo $i;?>">Week <?php echo $i;?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div><!-- end box header -->
        <div class="box-body">
          <img name="chartKcmsLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
          <div class="hidden" id="kcmsChart" style="height: 225px;"></div>
        </div>
      </div><!-- end box primary -->
    </div><!-- end div -->
    <div class="col-md-4">
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">&nbsp;</h3>
            <div class="box-tools pull-right">
              <select name="acTypeFunc">
                <option value="">All Aircraft</option>
                <?php
                foreach ($list as $value) {
                ?>
                <option value="<?php echo $value->id;?>"><?php echo $value->name_aircraft;?></option>
                <?php
                }
                ?>
              </select>

              <select name="cabinFunc">
                <option value="">All Area</option>
                <?php
                foreach ($func_items as $value) {
                ?>
                <option value="<?php echo $value->fi_id;?>"><?php echo $value->fi_name;?></option>
                <?php
                }
                ?>
              </select>

              <select name="galley" class="hidden">
                <option value="">-- Galley Items --</option>
                <option value="Oven" selected="selected">Oven</option>
                <option value="Coffe Maker">Coffe Maker</option>
                <option value="Boiler">Boiler</option>
                <option value="Chiller">Chiller</option>
                <option value="Microwave">Microwave</option>
                <option value="Bun Warmer">Bun Warmer</option>
                <option value="Espresso Maker">Espresso Maker</option>
              </select>
            </div>
          </div>
          <div class="box-body">
            <img name="funcDataLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
            <table name="funcData" class="table table-bordered table-condensed table-stripped table-hover hidden">
              <thead>
                <tr>
                  <th class="text-center btn-github" colspan="3">Problem Identification Corrective Action</th>
                </tr>
                <tr>
                  <th class="text-center">A/C</th>
                  <th class="text-center">Desc</th>
                  <th class="text-center">Corrective Action</th>
                </tr>
                <tr template="rows" class="hidden btn-google">
                  <td view="acReg"></td>
                  <td view="descFunc"></td>
                  <td view="caFunc"></td>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
    </div>
  </div><!-- end row -->
	<div class="row">
    	<div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">&nbsp;</h3>
                <div class="box-tools pull-right">
                  <select name="performanceType">
                    <option value="1" selected>Cabin Function</option>
                    <option value="2">Interior Appearance</option>
                    <option value="3">Exterior Appearance</option>
                  </select>

                  <select name="acType">
                    <option value="">Aircraft Type</option>
                    <?php
                    foreach($list as $tv) {
                    ?>
                    <option value="<?php echo $tv->id;?>"><?php echo $tv->name_aircraft;?></option>
                    <?php
                    }
                    ?>
                  </select>

                  <select name="acReg">
                    <option value="">AC Registered</option>
                  </select>
                </div>
            </div>
            <div class="box-body">
              <img name="chartCcLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
              <div class="hidden" id="cabinChart" style="height: 280px;"></div>
            </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Trend KPI Cabin</h3>
              <div class="box-tools pull-right">
                <select name="typeTrend">
                  <option value="1" selected>Function, Appearance</option>
                  <option value="2">HIL</option>
                </select>
                <select name="timeTrend">
                  <?php $years = year_report();
                  foreach ($years as $value) {
                    ?>
                    <option value="<?php echo $value;?>"><?php echo $value;?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="box-body">
              <img name="chartTrendLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
              <div class="hidden" id="chartTrend" style="height: 280px;"></div>
            </div>
          </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Aircraft Type</h3>
                <div class="box-tools pull-right">
                  <select name="acTypeFirst">
                    <?php
                    foreach ($list as $value) {
                    ?>
                    <option value="<?php echo $value->id;?>" <?php echo ($value->id == 5) ? 'selected' : '' ?>><?php echo $value->name_aircraft;?></option>
                    <?php
                    }
                    ?>
                  </select>
                  <select name="acTypeSort">
                    <option value="1" selected="selected">Top 5</option>
                    <option value="0">Bottom 5</option>
                  </select>
                </div>
            </div>
            <div class="box-body">
              <img name="chartTypeLoading" class="hidden" src="<?php echo base_url('assets/images/plane.gif');?>" style="display: block; margin-left: auto; margin-right: auto;">
              <div class="hidden" id="typeChart" style="height: 280px;"></div>
            </div>
          </div>
      </div><!-- end col -->
    </div><!-- end row -->
</section>

<!-- dont touch -->
<div class="modal fade enabled" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" style="z-index: 11000;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1>Loading...</h1>
      </div>
      <div class="modal-body">
        <div class="progress">
          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-val "0" aria-valuemax="100" style="width: 100%">
                <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end ajax progress -->
</div>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/sweetalert/sweetalert.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/app.js'); ?>"></script>
<!-- -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/highcharts-more.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/highcharts/exporting.js"></script>
<script type="text/javascript">
	var myBaseUrl = "<?php echo site_url('report');?>";
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.charts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.bar.charts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.cabin.charts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.kcms.charts.js"></script>
<!-- dont touch -->
</body>
</html>