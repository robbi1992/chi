
        
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
                        ?>
                        <map name="map" id="map">
                        <?php
                        foreach ($cabin_template_detail as $v) {
                            ?>
                            <area href="#" state="AC" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                            <?php
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
                  <h3 class="box-title">Interior Appereance - Seat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-bordered">
                    <tbody><tr>
                      <th style="width: 10px">No.</th>
                      <th>Item</th>
                      <th colspan="2">Average</th>
                    </tr>
                    
                    <?php
                        $tag_html = '';
                        $list_reg = array(
                                            'Seat Cover' => array('95'),
                                            'Seat Cushion' => array('50'),
                                            'Ottoman (Foot Rest)' => array('95'),
                                            'Seat Belt' => array('60'),
                                            'Amrest set' => array('70'),
                                            'folding Table' => array('95'),
                                            'Table Compartment' => array('99'),
                                            'Literature Pocket' => array('60'),
                                            'Snake Light' => array('100'),
                                            'Shell & Bumper' => array('95'),
                                            'Video Monitor' => array('100'),
                                            'Pax. Control Unit' => array('95'),
                                            'IFE Control' => array('100')
                                         );
                        $i = 1;
                        $progress = '';
                        foreach($list_reg as $key => $value ){
                            
                            foreach($value as $key2 => $value2 ){
                            
                                if($value2 >= 80){
                                    $progress = 'success';
                                    $bg = 'green';
                                }elseif($value2 <= 80 AND $value2 >= 60){
                                    $progress = 'warning';
                                    $bg = 'yellow';
                                }elseif($value2 <= 60 ){
                                    $progress = 'danger';
                                    $bg = 'red';
                                }
                            
                                echo '<tr>
                                      <td>'. $i .'</td>
                                      <td style="width:200px;">'. $key .'</td>
                                      <td style="width:200px;">
                                        <div class="progress progress-xs">
                                          <div class="progress-bar progress-bar-'. $progress .'" style="width: '. $value2 .'%"></div>
                                        </div>
                                      </td>
                                      <td style="text-align: center; width:50px;">
                                        <span class="badge bg-'. $bg .'">'. $value2 .'</span>                                        
                                      </td>
                                    </tr>';
                            
                            }
                            $i++;
                        }
                    ?>
                    
                  </tbody></table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-3">
            <?php
            foreach ($cabins as $key => $value) {
                ?>
                <a href="<?php echo base_url('health_view/interior/' . $typeac . '/' . $typereg . '/' . $value->id);?>" class="btn btn-lg btn-block btn-social bg-blue">
                    <i class="fa fa-chevron-circle-right"></i> <?php echo $value->name_type; ?>
                </a>
                <?php   
            }
            ?>
        </div>
    </div>
  
</section>

<script type="text/javascript">

</script>