<section class="content-header">
    <h1>
        <small>
            <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
            <i class="fa fa-fw fa-angle-double-right"></i> Input
            <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url();?>/input/aircraft_type"> All Aircraft</a>
            <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $typeac;?> <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $typereg;?>
        </small>
    </h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-5">
			<!--real data
            <a href="<?php echo site_url('/input/interior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-<?php echo performance_color($interior_value);?>">
                <i class="fa fa-chevron-circle-right"></i> Interior Appereance
            </a>
            -->
			<a href="<?php echo site_url('/input/functionality/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Functionality
                <span>(<?php echo (isset($func)) ? $func : '100';?> %)</span>
            </a>
			<a href="<?php echo site_url('/input/interior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Interior Appereance
                <span>(<?php echo (isset($int)) ? $int : '100';?> %)</span>
            </a>
            <a href="<?php echo site_url('/input/exterior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Exterior Appereance
                <span>(<?php echo (isset($ext)) ? $ext : '100';?> %)</span>
            </a>
		</div>
		<div class="col-md-7"></div>
	</div>
</section>