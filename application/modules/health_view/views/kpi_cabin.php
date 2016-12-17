<section class="content-header">
    <h1>CABIN PERFORMANCE INDEX<small><i class="fa fa-fw fa-angle-double-right"></i><b><?php echo $typeac;?> - <?php echo $typereg; ?></b></small></h1>
</section>
<section class="content">
    <div class="">
        <div class="row">
            <div class="main-menu-chi">
                <div class="col-md-5">
                    <a href="<?php echo site_url('/health_view/functionality/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                        <i class="fa fa-chevron-circle-right"></i> Functionality <span style="color: red;">(Under construction)</span>
                    </a>
                    <!--<a href="<?php echo site_url('/health_view/interior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-<?php echo performance_color($interior_value);?>">
                        <i class="fa fa-chevron-circle-right"></i> Interior Appereance
                    </a>-->
                    <!--real data
                    <a href="<?php echo site_url('/view/interior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-<?php echo performance_color($interior_value);?>">
                        <i class="fa fa-chevron-circle-right"></i> Interior Appereance
                    </a>
                    
                    <a href="<?php echo site_url('/view/interior/' . url_title('B777-300') .'/'. url_title('PK-GIA')); ?>" class="btn btn-lg btn-block btn-social bg-<?php echo performance_color($interior_value);?>">
                        <i class="fa fa-chevron-circle-right"></i> Interior Appereance
                    </a>
                    <a href="<?php echo site_url('/health_view/exterior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social <?php echo bg_pt_exterior($exterior_performance['scoring']); ?>">
                        <i class="fa fa-chevron-circle-right"></i> Exterior Appereance
                    </a>
                    -->
                    <a href="<?php echo site_url('/view/interior/' . url_title('B777-300') .'/'. url_title('PK-GIA')); ?>" class="btn btn-lg btn-block btn-social bg-green">
                        <i class="fa fa-chevron-circle-right"></i> Interior Appereance (99.95%)
                    </a>
                    <!--
                    <a href="<?php echo site_url('/health_view/exterior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                        <i class="fa fa-chevron-circle-right"></i> Exterior Appereance (100%)
                    </a>
                    -->
                    <a href="<?php echo site_url('/view/exterior/' . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-green">
                        <i class="fa fa-chevron-circle-right"></i> Exterior Appereance (100%)
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

</script>