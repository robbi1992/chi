

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Application CHI - GMF</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/adminlte/css/AdminLTE.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/adminlte/css/skins/_all-skins.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/plugins/treeview/css/jquery.treeview.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/stylesheet.css'); ?>" />
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="<?php echo base_url('/assets/plugins/jQuery/jQuery-2.2.0.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/plugins/treeview/js/jquery.treeview.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.cookie.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/plugins/adminlte/js/app.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('/assets/plugins/adminlte/js/demo.js'); ?>"></script>
	
	<script type="text/javascript">
	$().ready(function(){	
		var token_cookie = $.cookie('<?php echo $this->config->item('csrf_cookie_name'); ?>');
		
		$("#browser, #browser2").treeview({
			animated: "medium",
			control: "#treecontrol",
			persist: "cookie",
			cookieId: "treeview-black"
		});
	});
	</script>
</head>
<body class="layout-top-nav skin-black layout-boxed ">
	<!--<div class="wrapper">-->
	<div class="body-page">
        <?php echo $this->load->view($header); ?>
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body pad table-responsive">
                            <div class="col-md-8 col-xs-12">
                                <header class="main-header">
                                	<a href="<?php echo base_url(); ?>" class="logo">
                                		<!-- mini logo for sidebar mini 50x50 pixels -->
                                		<span class="logo-mini"><b>GMF</b></span>
                                		<!-- logo for regular state and mobile devices -->
                                		<span class="logo-lg">
                                			<img src="<?php echo base_url('/assets/images/banner01.png'); ?>" class="img-responsive" alt="img-responsive" />
                                		</span>
                                	</a>
                                </header>
                                <h3 class="lockscreen-logo">
                                    CABIN HEALTH MONITORING
                                </h3>
                            </div>
                        </div>
                        <?php 
                            $sessUser = $this->session->userdata('users');
                            $groupUser = $sessUser->id_users_group_fk; 
                        ?>
                        
                        <?php if($groupUser == 1): ?>
                            <?php echo $this->load->view($mainmenu); ?>
                        <?php endif; ?>
                        
                        <div class="box-body pad table-responsive">
                            <div class="col-md-12">
                                
                                <div class="">
                                    
                                    <?php if($groupUser == 1): ?>
                                    <section class="content">
                                        <div class="main-menu">
                                            <div class="main-menu-chi">
                                                
                                            </div>
                                        </div>
                                    </section>
                                    <?php elseif($groupUser == 2): ?>
                                    <section class="content">
                                        <div class="main-menu">
                                            <div class="row">
                                                <div class="main-menu-chi">
                                                    <div class="col-md-2 col-xs-12 col-md-offset-3">
                                                        <a href="<?php echo site_url('/view/aircraft_type'); ?>" class="btn btn-block btn-primary">
                                                            <i class="fa fa-eye fa-5x"></i> 
                                                            <br />
                                                            VIEW
                                                        </a>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <a href="<?php echo site_url('/input/aircraft_type'); ?>" class="btn btn-block btn-primary">
                                                            <i class="fa fa-edit fa-5x"></i> 
                                                            <br /> 
                                                            INPUT
                                                        </a>
                                                    </div>
                                                    <div class="col-md-2 col-xs-12">
                                                        <a href="<?php echo site_url('/report'); ?>" class="btn btn-block btn-primary">
                                                            <i class="fa fa-line-chart fa-5x"></i> 
                                                            <br /> 
                                                            DASHBOARD
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>                                   
                                    <?php endif; ?>
                                </div>
            				</div>
                        </div>
                        <!-- /.box -->
                    </div>
                    
                </div>
				
			</div>
		</div>
	</div>
	<!--</div>-->

</body>
</html>