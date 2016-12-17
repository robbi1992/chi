<style>
    .myLink:hover {
        cursor: pointer;
    }
</style>
<section class="content-header">
    <h1>
        <small>
            <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
            <i class="fa fa-fw fa-angle-double-right"></i> View
            <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url();?>/view/aircraft_type"> All Aircraft</a>
            <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $typeac;?> <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url('/view/performance/' . $typeac . '/' . $typereg);?>"><?php echo $typereg;?></a>
            <i class="fa fa-fw fa-angle-double-right"></i> <i class="fa fa-plane"></i> Exterior Appearance
        </small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Exterior Images</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-condensed table-responsive">
                    <thead>
                        <tr class="btn-github">
                        <?php
                        foreach ($items as $val) {
                        ?>
                            <th class="text-center"><?php echo $val['itemName'];?></th>
                        <?php
                        }
                        ?>
                        </tr>
                    <tbody>
                        <tr view="rows">
                        <?php
                        foreach ($items as $val) {
                            $print = TRUE;
                            if(count($images) > 0) {
                                foreach($images as $v) {
                                    if($val['itemID'] === $v->exi_id) {
                                        ?>
                                        <td view="<?php echo $val['itemID'] ?>" class="text-center"><img class="myLink" view="imgReal" style="width:80px; height: 80px;" data-src="<?php echo ext_assets_url . 'src/' . $v->eif_url;?>" src="<?php echo ext_assets_url . 'thumbnails/' . $v->eif_url;?>"></td>
                                        <?php
                                        $print = FALSE;
                                    }   
                                }
                                if($print) {
                                    ?>
                                    <td view="<?php echo $val['itemID'] ?>" class="text-center"><img style="width:80px; height: 80px;" src="<?php echo ext_assets_url . 'no_images.jpg';?>"></td>
                                    <?php
                                }
                            }
                            else {
                                ?>
                                <td view="<?php echo $val['itemID'] ?>" class="text-center"><img style="width:80px; height: 80px;" src="<?php echo ext_assets_url . 'no_images.jpg';?>"></td>
                                <?php
                            }
                        }
                        ?>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- form input -->
    <div class="row">
    <div class="col-md-12">
        <div class="progress-group">
            <span class="progress-text">Scoring</span>
            <span class="progress-number"><b view="ex_scoring"><?php echo $scoring;?></b>/100 <b>(%)</b></span>
            <div class="progress sm">
                <div view="ex_progress" class="progress-bar <?php echo bg_exterior($scoring); ?>" style="width: <?php echo $scoring;?>%;"></div>
            </div>
        </div>
        <table class="table table-bordered table-hover table-responsive table-condensed table-striped">
            <thead>
                <tr class="btn-github">
                    <th class="text-center">No</th>
                    <th class="text-center">Group</th>
                    <th class="text-center">Item</th>
                    <th class="text-center">Value</th>
                    <th class="text-center">Inspected date</th>
                    <th class="text-center">Inspector</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($result as $value) {
                    $num = 1;
                    if($value['value'] == 3) {
                        $bg = 'bg-green';
                    }
                    else if($value['value'] == 2) {
                        $bg = 'bg-yellow';
                    }
                    else if($value['value'] == 1) {
                        $bg = 'bg-red';
                    }
                    else {
                        $bg = '';
                    }
                    ?>
                <tr class="<?php echo $bg;?>">
                    <td class="text-center"><?php echo $no;?></td>
                    <td><?php echo $value['item'];?></td>
                    <td><?php echo $value['subItemName'];?></td>
                    <td class="text-center" view="value"><?php echo $value['value'];?></td>
                    <td class="hidden" view="subItem"><?php echo $value['subItemId'];?></td>
                    <td class="text-center" view="date"><?php echo $value['date'];?></td>
                    <td class="text-center" view="inspector"><?php echo $value['inspector'];?></td>
                </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<div name="imgModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <img style="width: 100%; height: 100%">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $('[view=imgReal]').on('click', function() {
        mySrc = $(this).attr('data-src'),
        modal = $('[name="imgModal"]');
        modal.find('img').attr('src', mySrc);
        modal.modal('show');
    });
</script>