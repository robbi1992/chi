
        
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/redist/when.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/core.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/graphics.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapimage.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapdata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areadata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areacorners.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/scale.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/tooltip.js"></script>               

<script>

    
    function checkCoord(input){
        if ( input != 0 ) {
            return true;
        }
        return false;
    }
    
        
	$().ready(function(){
        
        var img = $('img');
        img.mapster({
            mapKey: 'state',
            mapValue: 'data-statename',
            isSelectable: false,
            showToolTip: true,
            areas: [
                { 
                    key: "AS",
                    selected: true,
                    fillColor: 'ff0000',
                    fillOpacity: 100
                },
                { 
                    key: "AD",
                    selected: true,
                    fillColor: 'ffeb3b',
                    fillOpacity: 100
                },
                { 
                    key: "AC",
                    selected: true,
                    fillColor: '8bc34a',
                    fillOpacity: 100
                },
                { 
                    key: "AE",
                    selected: true,
                    fillColor: '3C8DBC',
                    fillOpacity: 100
                }
            ]
        });
        
        $('area').mapster('select');
        
        $('area').bind('mouseover', function() {
            $(this).mapster('tooltip',this,$(this).attr('id').toUpperCase());
        });
    });
    

    
</script>


<section class="content-header">
	<h1>Interior Appereance<small><i class="fa fa-fw fa-angle-double-right"></i><b><?php echo $typeac; ?> <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $typereg; ?></b></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="ac_cabin">
                <?php
                if(count($cabin_template) == 0) {
                    ?>
                    <div class="alert alert-danger">Template not found</div>
                    <?php
                }
                else {
                    ?>
                    <img src="<?php echo base_url(); ?>assets/upload_cabin/<?php echo $cabin_template[0]->FileImage;?>" id="ImageAirCraft" class="imgmapMainImage img-responsive" alt="" usemap="#map"/>
                    <?php
                    if(count($cabin_template_detail) > 0 ) {
                        $pv_map = formula_performance_for_map($value_performance);
                        ?>
                        <map name="map" id="map">
                        <?php
                        foreach ($cabin_template_detail as $v) {
                            $has_value = FALSE;
                            if(count($pv_map) > 0) {
                                foreach($pv_map as $vmap) {
                                    if($v->id == $vmap['cabinTemplate']) {
                                        $new_val =  $vmap['value'] / $vmap['num'];
                                        ?>
                                        <area href="#" state="<?php echo map_color($new_val);?>" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                                        <?php
                                        $has_value = TRUE;
                                    }
                                }
                                if(!$has_value) {
                                    ?>
                                    <area href="#" state="AE" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                                    <?php
                                }
                            }
                            else {
                                ?>
                                <area href="#" state="AE" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                                <?php
                            }
                        }
                        ?>
                        </map>
                        <?php
                    } 
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Interior Appereance - <?php echo $cabin_selected['name_type']; ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-bordered">
                        <thead>
                            <thead>
                                <tr>
                                    <th width="10%">No.</th>
                                    <th width="30%">Item</th>
                                    <th width="50%">Chart</th>
                                    <th width="10%">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $value_performance = formula_performance_value($value_performance);
                                //exit();
                                $no = 1;
                                foreach ($item_performance as $i => $v) {                             
                                    $print = TRUE;
                                    ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $v->fName;?></td>
                                        <?php
                                            if(count($value_performance) > 0) {
                                                foreach($value_performance as $vals) {
                                                    if($v->id == $vals['faultCode']) {
                                                        $new_val =  $vals['value'] / $vals['num'];
                                                        ?>
                                                        <td>
                                                            <div class="progress progress-xs">
                                                                <div class="progress-bar progress-bar-<?php echo performance($new_val);?>" style="width: <?php echo $new_val; ?>%">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?php echo parsing_float($new_val); ?> %</td>
                                                        <?php
                                                        $print = FALSE;
                                                    }
                                                    /*else {
                                                        echo '<td>Not inspected yet</td>'; 
                                                        echo '<td>Not inspected yet</td>';        
                                                    }*/
                                                }
                                                if($print) {
                                                    echo '<td>Not set yet</td>';
                                                    echo '<td>Not set yet</td>'; 
                                                }    
                                            }
                                            else {
                                                echo '<td>Not set yet</td>';
                                                echo '<td>Not set yet</td>';
                                            }
                                        ?>
                                    </tr>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-3">
            <?php
            $all_performance_value = formula_all_performance($all_value_performance);
            foreach ($cabins as $key => $value) {
                $print = TRUE;
                if (count($all_performance_value) > 0) {
                    foreach ($all_performance_value as $i => $v) {
                        if($value->id == $v['cabin']) {
                            $new_value = $v['value'] / $v['num'];
                            $print = FALSE;
                            ?>
                            <a href="<?php echo base_url('health_view/interior/' . $typeac . '/' . $typereg . '/' . $value->id);?>" class="btn btn-lg btn-block btn-social bg-<?php echo performance_color($new_value);?>">
                                <i class="fa fa-chevron-circle-right"></i> <?php echo $value->name_type; ?>
                            </a>
                            <?php 
                        }
                    }
                    if($print) {
                        ?>
                        <a href="<?php echo base_url('health_view/interior/' . $typeac . '/' . $typereg . '/' . $value->id);?>" class="btn btn-lg btn-block btn-social bg-blue">
                            <i class="fa fa-chevron-circle-right"></i> <?php echo $value->name_type; ?>
                        </a>
                        <?php 
                    }
                }
                else {
                    ?>
                    <a href="<?php echo base_url('health_view/interior/' . $typeac . '/' . $typereg . '/' . $value->id);?>" class="btn btn-lg btn-block btn-social bg-blue">
                        <i class="fa fa-chevron-circle-right"></i> <?php echo $value->name_type; ?>
                    </a>
                    <?php 
                }  
            }
            ?>
        </div>
    </div>
  
</section>

<script type="text/javascript">

</script>