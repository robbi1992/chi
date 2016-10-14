<section class="content-header">
	<h1>CABIN PERFORMANCE INDEX<small><i class="fa fa-fw fa-angle-double-right"></i><b><?php echo $typeac;?> - <?php echo $typereg; ?></b></small></h1>
</section>
<section class="content">
    <div class="">
        <div class="row">
            <div class="main-menu-chi">
                <div class="col-md-5">
                    <a href="<?php echo base_url('/health_input/functionality/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                        <i class="fa fa-chevron-circle-right"></i> Functionality
                    </a>
                    <a href="<?php echo base_url('/health_input/interior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-red">
                        <i class="fa fa-chevron-circle-right"></i> Interior Appereance
                    </a>
                    <a href="<?php echo base_url('/health_input/exterior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-red">
                        <i class="fa fa-chevron-circle-right"></i> Exterior Appereance
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

</script>