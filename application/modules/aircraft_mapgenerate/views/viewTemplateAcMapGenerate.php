    <!-- JS -->
    <?php echo jquery_select2(); ?>
	<script type="text/javascript" async="" src="<?php echo base_url(); ?>assets/plugins/image_generator/inpage_linkid.js" id="undefined"></script>
    <script type="text/javascript" async="" src="<?php echo base_url(); ?>assets/plugins/image_generator/dc.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/image_generator/jquery.maphilight.js"></script>
	
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/image_generator/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/image_generator/snippet.css" type="text/css" media="screen">
    
    	<!-- jQuery File Upload -->
	<script src="<?php echo base_url(); ?>assets/plugins/image_generator/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/image_generator/jquery.iframe-transport.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/image_generator/jquery.fileupload.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/image_generator/script_upload.js"></script>
    
        
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/redist/when.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/core.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/graphics.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapimage.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapdata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areadata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areacorners.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/scale.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/tooltip.js"></script>               
    
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/image_generator/script2.js"></script>

<script>        
	$().ready(function(){
        $('.images').show();
        $('.select').select2();	   	   
        $('.imgmapMainImage').maphilight({
    		strokeColor: '00FFFF',
    		alwaysOn: true,
    		fillColor: '00FFFF',
    		fillOpacity: 1
    	});
        resizeHtml();	   
    });
</script>


<section class="content-header">
	<h1>Map Aircraft Generator<small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ac_type_selected;?>
    <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ac_reg_selected;?>
    </small></h1>
</section>
<section class="content">
    <div class="">
        <?php echo form_open_multipart(base_url('/aircraft_mapgenerate/upload_image'), array('class' => 'form-horizontal row-form','role'=>'form')); ?>
          <div class="">
            <div class="row">
                <div id="imagemap4posis" class="images">
            		<div id="mapContainer" class="effect">
            			<?php if($data_acTemplateH['FileImage']): ?>
                            <img src="<?php echo base_url('/assets/upload_cabin/'); ?>/<?php echo $data_acTemplateH['FileImage'];?>" id="ImageAirCraft" class="imgmapMainImage" alt="" usemap="#map"/>
                        <?php endif; ?>
                        <map name="map" id="map">
                            <?php if($data_acTemplateH['FileImage']): ?>
                                <?php $no = 1; foreach($data_acTemplated as $row): ?>
                                    <area alt="<?php echo $row['noItem'];?>" title="<?php echo $row['noItem'];?>" state="AC" data-statename="" id="ItemNo_<?php echo $row['noItem'];?>_<?php echo $no;?>" class="area test" shape="circle" coords="<?php echo $row['coordinate'];?>" />
                                <?php $no++; endforeach;?>
                            <?php endif; ?>
                        </map>
            		</div>
            		<div class="form" style="width: 1072px;">
            			<input id="coordsText" class="effect" name="" type="hidden" value="" placeholder="Coordinates" style="width: 1058px;">
            		</div>
            	</div>                                    
            </div>                               
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label>AirCraft (Type_Registered)</label>
                            <input type="text" class="form-control input-sm" disabled="disabled" value="<?php echo $ac_type_selected . '_' . $ac_reg_selected;?>">
                            <!--<select class="form-control select input-sm" id="acType" name="acType" data-placeholder="AirCraft Type">
                                <option value=""></option>
                                <?php foreach($data_acType as $row): ?>
                                    <option value="<?php echo $row['id'];?>" <?php if($data_acTemplateH['acType_fk']==$row['id']){echo 'selected';}?>><?php echo $row['name_aircraft'];?></option>
                                <?php endforeach; ?>
                            </select>-->
                        </div>
                        <div class="col-md-6">
                            <label>Cabin Items</label>
                            <input type="hidden" name="CabItms" value="<?php echo $data_acTemplateH['cabinItem'];?>">
                            <input type="text" class="form-control input-sm" disabled="disabled" value="<?php echo $cabin_selected; ?>">
                              <!--<select class="form-control select" id="CabItms" name="CabItms" data-placeholder="Select Items">
                                <option value=""></option>
                                <?php foreach($data_CabItm as $row): ?>
                                    <option value="<?php echo $row['id'];?>" <?php if($row['id'] == @$data_acTemplateH['cabinItem']){echo 'selected';}  ?> ><?php echo $row['name_type'];?></option>
                                <?php endforeach; ?>
                              </select>
                              -->
                        </div>
                    </div>
                   
                </div>     
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label >Item No.</label>
                            <input type="text" name="ItemNo" class="form-control input-sm" id="ItemNo" placeholder="Item No." />
                            <input type="hidden" name="coordsVal" class="form-control input-sm" id="coordsVal"/>
                        </div>
                        <div class="col-md-6">
                            <label >&nbsp;</label>
                            <input type="hidden" name="url" id="url" value="<?php echo base_url('/aircraft_mapgenerate/insert_mapgenerator/'); ?>" />
                            <div id="form_cabinItem">
                                <?php if($data_acTemplateH['FileImage']): ?>
                                    <?php $no = 1; foreach($data_acTemplated as $row): ?>
                                        <input type="hidden" id="coords_<?php echo $row['noItem'];?>_<?php echo $no;?>" name="coordsItem[]" value="<?php echo $row['coordinate'] . ',' .$row['noItem'];?>">
                                    <?php $no++; endforeach;?>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="ac_templateH" value="<?php echo $data_acTemplateH['id'];?>">
                            <button type="submit" id="SaveItem" class="btn btn-block btn-flat btn-primary btn-sm">Save Item</button>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>