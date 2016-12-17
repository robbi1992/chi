<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo isset($title) ? $title : 'Cabin health index';?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/adminlte/css/skins/skin-blue.min.css">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

  <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo site_url();?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>HI</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Cabin</b> Health Index</span>
      </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" view="btnBack" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url();?>assets/plugins/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/plugins/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  Name of user - role
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo site_url();?>/site/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less
    <section class="sidebar">
      <!-- Sidebar Menu
      <ul class="sidebar-menu">
        <li class="header">Navigation Menu</li>
        <!-- Optionally, you can add icons to the links 

        <?php 
        foreach ($items as $val) {
          ?>
            <li><a view="cabinMenu" cabin="<?php echo $val->ini_id;?>" href="javascript:;"><i class="fa fa-link"></i> <span><?php echo $val->ini_name;?></span></a></li>
          <?php
        }
        ?>
      </ul>
      <!-- /.sidebar-menu
    </section>
    <!-- /.sidebar
  </aside>-->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cabin Health Index
        <small>Interior Appereance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Input</a></li>
        <li class="active"><?php echo $type; ?></li>
        <li class="active"><i class="fa fa-plane"></i> <?php echo $reg['regName']; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- select cabin area -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body">
              <div class="form-group">
                <label>Cabin area</label>
                <select name="intNav" class="form-control" style="width: 100%;">
                  <option selected="selected" val="">-- Choose cabin area --</option>
                  <?php 
                  foreach ($items as $val) {
                  ?>
                    <option value="<?php echo $val->ini_id;?>"><?php echo $val->ini_name;?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            </div>
        </div>
      </div><!-- end row-->
      <!-- end select cabin area -->
      <!-- status bar -->
      <div class="row hidden" template="intStatus">
        <div class="col-md-12">
          <p class="text-center">
            <strong>Current Performance</strong>
          </p>
          <div class="progress-group">
            <span class="progress-text">Interior Performance</span>
            <span class="progress-number">
              <b><span view="performanceBar"></span></b>/100%
            </span>
            <div class="progress sm">
              <div view="progress-bar" style="width: 90%;"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- row form -->
      <div class="row hidden" template="intForm">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Input appereance form</h3>
            </div>
            <div class="box-body">
              <form name="intForm" role="form" action="javascript:;">
                <div class="form-group">
                    <label>Weight per area</label>
                    <input type="text" class="form-control" name="intWeight" readonly="readonly">
                  </div>
                <div class="form-group">
                  <label>Items per area</label>
                  <select name="intItem" class="form-control" style="width: 100%;">
                  </select>
                </div>
                <div template="intDetail" class="hidden">
                  <div class="form-group">
                    <label>Total item</label>
                    <input type="text" class="form-control" name="intTotal" readonly="readonly">
                  </div>
                  <div class="form-group hidden">
                    <label>Defect performance</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="intDefectPerform" readonly="readonly">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                  <div class="form-group hidden">
                    <label>Dirty performance</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="intDirtyPerform" readonly="readonly">
                      <span class="input-group-addon">%</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Defect</label>
                    <input type="text" class="form-control" name="intDefect">
                  </div>
                  <div class="form-group">
                    <label>Dirty</label>
                    <input type="text" class="form-control" name="intDirty">
                  </div>
                  <div class="form-group">
                    <label>Remark</label>
                    <textarea name="intRemark" class="form-control"></textarea>
                  </div>
                </div>
                <button name="intSubmit" class="btn btn-primary form-control">Input</button>
              </form>
            </div>
          </div>
        </div>
      </div><!--end row form-->
      <!-- end status bar -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>
  </div><!-- end wrapper -->
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url();?>assets/plugins/adminlte/js/app.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
  <!-- Single page -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/fn.progress.color.js"></script>
  <script type="text/javascript">
    var baseUrl = '<?php echo site_url();?>/mobile/',
        backUrl = '<?php echo site_url();?>/health_input/',
        acReg = '<?php echo $reg["regID"];?>';
  </script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/app.interior.js"></script>
</body>
</html>