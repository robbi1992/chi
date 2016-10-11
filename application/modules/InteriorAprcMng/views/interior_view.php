    <!-- JS -->
    <?php echo jquery_select2(); ?>
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
    
    $().ready(function(){
        $('.select').select2();	   	   
        var img = $('img');
        img.mapster({
            mapKey: 'state',
            mapValue: 'data-statename',
            isSelectable: false,
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
        
        //$('area').bind('click', function() {
//            
//           
//        });
//        
        $('#change-box').click(function(e){
            img.mapster({
                mapKey: 'state',
                isSelectable: false,
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
            
        
            $('area').bind('click', function() {
                $(this).mapster('tooltip',this,$(this).attr('id').toUpperCase());
            });
                        
            e.preventDefault();
        });
        
        
        
        
    });
    
</script>


<section class="content-header">
	<h1>Map Aircraft Generator<small><i class="fa fa-fw fa-angle-double-right"></i> All Aircraft</small></h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="ac_cabin">
                <?php if($data_acTemplateH['FileImage']): ?>
                    <img src="<?php echo base_url('/assets/upload_cabin/'); ?>/<?php echo $data_acTemplateH['FileImage'];?>" id="ImageAirCraft" class="imgmapMainImage" alt="" usemap="#map"/>
                <?php endif; ?>
                <map name="map" id="map">
                    <?php if($data_acTemplateH['FileImage']): ?>
                        <?php $no = 1; foreach($data_acTemplated as $row): ?>                    
                            <area alt="<?php echo $row['noItem'];?>" title="<?php echo $row['noItem'];?>" href="#" state="AC" id="<?php echo $row['noItem'];?>" class="area" shape="circle" coords="<?php echo $row['coordinate'];?>" />
                        <?php $no++; endforeach;?>
                    <?php endif; ?>
                </map>
            </div>
            <div>
                <a href="#" class="btn btn-primary btn-sm" id="change-box">Change</a>
            </div>
        </div>
    </div>
</section>