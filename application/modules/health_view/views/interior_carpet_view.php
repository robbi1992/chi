
        
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
	<h1>Interior Appereance<small><i class="fa fa-fw fa-angle-double-right"></i><b><?php echo $typeac; ?> - <?php echo $typereg; ?></b></small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="ac_cabin">
                <img src="<?php echo base_url(); ?>assets/images/LOPA-BG.jpg" id="ImageAirCraft" class="imgmapMainImage img-responsive" alt="" usemap="#map"/>
                <map name="map" id="map">
                    <area alt="" title="" href="on" state="AS" data-statename="" id="area1" onclick="return checkCoord(1);" class="area test" shape="circle" coords="170,84,3" />
                    <area alt="" title="" href="on" state="AS" data-statename="" id="area2" onclick="return checkCoord(2);" class="area test" shape="circle" coords="171,134,3" />
                    <area alt="" title="" href="on" state="AS" data-statename="" id="area3" onclick="return checkCoord(3);" class="area test" shape="circle" coords="360,84,3" />
                    <area alt="" title="" href="on" state="AS" data-statename="" id="area4" onclick="return checkCoord(4);" class="area test" shape="circle" coords="361,107,3" />
                    <area alt="" title="" href="on" state="AC" data-statename="" id="area5" onclick="return checkCoord(5);" class="area test" shape="circle" coords="362,132,3" />
                    <area alt="" title="" href="on" state="AC" data-statename="" id="area6" onclick="return checkCoord(6);" class="area test" shape="circle" coords="493,86,3" />
                    <area alt="" title="" href="on" state="AC" data-statename="" id="area7" onclick="return checkCoord(7);" class="area test" shape="circle" coords="492,111,3" />
                    <area alt="" title="" href="on" state="AS" data-statename="" id="area8" onclick="return checkCoord(8);" class="area test" shape="circle" coords="495,136,3" />
                    <area alt="" title="" href="on" state="AS" data-statename="" id="area9" onclick="return checkCoord(9);" class="area test" shape="circle" coords="677,87,3" />
                    <area alt="" title="" href="on" state="AD" data-statename="" id="area10" onclick="return checkCoord(10);" class="area test" shape="circle" coords="679,105,3" />
                    <area alt="" title="" href="on" state="AD" data-statename="" id="area13" onclick="return checkCoord(13);" class="area test" shape="circle" coords="680,139,3" />
                </map>
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
                  <table class="table table-bordered table-striped">
                    <tbody><tr>
                      <th style="width: 10px">No.</th>
                      <th>Zone</th>
                      <th>Aisle</th>
                      <th>Under Seat</th>
                      <th>Average</th>
                      <th>Excellent</th>
                      <th>Good</th>
                      <th>Fair</th>
                      <th>Poor</th>
                      <th>Date Inspect</th>
                      <th>Inspect By</th>
                    </tr>
                    
                    <?php
                        $tag_html = '';
                        $list_reg = array(
                                            'Zone A' => array('100')
                                         );
                        $i = 1;
                        $progress = '';
                        foreach($list_reg as $key => $value ){
                            
                            foreach($value as $key2 => $value2 ){
                                echo '<tr>
                                      <td>'. $i .'</td>
                                      <td style="">'. $key .'</td>
                                      <td style="text-align: center;">
                                        '. $value2 .'
                                      </td>
                                      <td>96</td>
                                      <td>98</td>
                                      <td>14</td>
                                      <td>14</td>
                                      <td>0</td>
                                      <td>0</td>
                                      <td>8/19/2014</td>
                                      <td>Airlangga</td>
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
            <a href="<?php echo base_url("/health_view/interior/" . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-red">
                <i class="fa fa-chevron-circle-right"></i> Seat
            </a>
            <a href="<?php echo base_url('#'); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Galley
            </a>
            <a href="<?php echo base_url('#'); ?>" class="btn btn-lg btn-block btn-social bg-green">
                <i class="fa fa-chevron-circle-right"></i> Lavatory
            </a>
            <a href="<?php echo base_url("/health_view/interior_seatcover/" . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-red">
                <i class="fa fa-chevron-circle-right"></i> Seat Cover
            </a>
            <a href="<?php echo base_url("/health_view/interior_carpet/" . url_title($typeac) .'/'. url_title($typereg)); ?>" class="btn btn-lg btn-block btn-social bg-blue">
                <i class="fa fa-chevron-circle-right"></i> Carpet
            </a>
        </div>
    </div>
  
</section>

<script type="text/javascript">

</script