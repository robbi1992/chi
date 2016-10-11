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

    /* Utility function to convert a canvas to a BLOB */
    var dataURLToBlob = function(dataURL) {
        var BASE64_MARKER = ';base64,';
        if (dataURL.indexOf(BASE64_MARKER) == -1) {
            var parts = dataURL.split(',');
            var contentType = parts[0].split(':')[1];
            var raw = parts[1];
    
            return new Blob([raw], {type: contentType});
        }
    
        var parts = dataURL.split(BASE64_MARKER);
        var contentType = parts[0].split(':')[1];
        var raw = window.atob(parts[1]);
        var rawLength = raw.length;
    
        var uInt8Array = new Uint8Array(rawLength);
    
        for (var i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }
    
        return new Blob([uInt8Array], {type: contentType});
    }
    /* End Utility function to convert a canvas to a BLOB      */

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {   
                var image = new Image();
                    image.onload = function (imageEvent) {
                    // Resize the image
                    var canvas = document.createElement('canvas'),
                        max_size = 1000,// TODO : pull max size from a site config
                        width = image.width,
                        height = image.height;
                    if (width > height) {
                        if (width > max_size) {
                            height *= max_size / width;
                            width = max_size;
                        }
                    } else {
                        if (height > max_size) {
                            width *= max_size / height;
                            height = max_size;
                        }
                    }
                    
                    //alert(width);                    
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                    var dataUrl = canvas.toDataURL('image/jpeg');
                    var resizedImage = dataURLToBlob(dataUrl);
                    $.event.trigger({
                        type: "imageResized",
                        blob: resizedImage,
                        url: dataUrl
                    });
                }
                image.src = e.target.result;
                $('#ImageAirCraft').attr('src', image.src);
                //.css("width", "100%").css("height", "auto")                
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
	$().ready(function(){
        $('.select').select2();
        $('.images').hide();
        //$('#AcReg').attr('disabled',true);
//        $('#CabItms').attr('disabled',true);
        
    	$("#imgInp").change(function(){    	
            //removeOldMapAndValues();
            var acType = $("#acType").val();
            //var acReg = $("#AcReg").val();
            var CabItms = $("#CabItms").val();
            var imgInp = $("#imgInp").val();
            
            if(acType == '' || CabItms == ''){
                alert('Please Complete Data');     
                $('#imgInp').val("");
                return false;
            }
             
//            $.ajax({
//                type: "POST",
//                url: "<?php echo base_url('//aircraft_mapgenerate/uplad_image/'); ?>",
//                data: { 'image': imgInp},
//                success: function(data){
//                    alert(data);
//                }
//            });                          
            readURL(this);            
             $('.images').show(); 
            resizeHtml();
            //loadImagemapGenerator(width,height);
		    //container.empty();                            
        });
        
        //$( "#acType" ).change(function() {            
//            $('#AcReg').select2("val", "");
//            $('#AcReg').empty();
//            $('#AcReg').attr('disabled',false);
//            $('#CabItms').attr('disabled',false);
//            var manuf = $(this).val();
//            var dataType = 'AAA';
//            $.ajax({
//                    type: "POST",
//                    url: "<?php echo base_url('//aircraft_mapgenerate/select_data/'); ?>",
//                    data: { 'manuf': manuf,'dataType': dataType},
//                    success: function(data){
//                        var opts = $.parseJSON(data);
//                        $('#AcReg').append('<option value="">Select Type</option>');
//                        $.each(opts, function(i, d) {
//                            if(d == 0){
//                                alert('Empty Data Registration');
//                                $('#AcReg').attr('disabled',true).select2("val","");
//                                $('#CabItms').attr('disabled',true).select2("val","");
//                                return false;
//                            }
//                            $('#AcReg').append('<option value="' + d.id + '">' + d.name + '</option>');
//                        });
//                    }
//                });
//        });
        
        
    });    
</script>

<section class="content-header">
	<h1>Map Aircraft Generator<small><i class="fa fa-fw fa-angle-double-right"></i></small></h1>
</section>
<section class="content">
    <div class="">
        <?php echo form_open_multipart(base_url('/aircraft_mapgenerate/upload_image'), array('class' => 'form-horizontal row-form','role'=>'form')); ?>
          <div class="">
            <div class="row">
                <div id="imagemap4posis" class="images">
        		<div id="mapContainer" class="effect">
        			<img src="#" id="ImageAirCraft" class="imgmapMainImage" alt="" usemap="#map" />
        			<map name="map" id="map"></map>
        		</div>
        		<div class="form" style="width: 1072px;">
        			<input id="coordsText" class="effect" name="" type="hidden" value="" placeholder="Coordinates" style="width: 1058px;">
        		</div>
        	</div>                                    
            </div>                               
            <div class="row">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6">
                            <label >AirCraft Type</label>
                            <select class="form-control select input-sm" id="acType" name="acType" data-placeholder="AirCraft Type">
                                <option value=""></option>
                                <?php foreach($data_acType as $row): ?>
                                    <option value="<?php echo $row['id'];?>" ><?php echo $row['name_aircraft'];?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label >Cabin Items</label>
                              <select class="form-control select" id="CabItms" name="CabItms" data-placeholder="Select Items">
                                <option value=""></option>
                                <?php foreach($data_CabItm as $row): ?>
                                    <option value="<?php echo $row['id'];?>" <?php if($row['id'] == @$data_row['id_aircraft_type_fk']){echo 'selected';}  ?> ><?php echo $row['name_type'];?></option>
                                <?php endforeach; ?>
                              </select>
                        </div>
                    </div>
                </div>     
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Image Aircraft Cabin</label>
                            <input type='file' id="imgInp" name="imgInp" class="form-control input-sm" /> 
                        </div>
                        <div class="col-md-4">
                            <label >Item No.</label>
                            <input type="text" name="ItemNo" class="form-control input-sm" id="ItemNo" placeholder="Item No." />
                            <input type="hidden" name="coordsVal" class="form-control input-sm" id="coordsVal"/>
                        </div>
                        <div class="col-md-4">
                            <label >&nbsp;</label>
                            <input type="hidden" name="url" id="url" value="<?php echo base_url('/aircraft_mapgenerate/insert_mapgenerator/'); ?>" />
                            <div id="form_cabinItem"></div>
                            <button type="submit" id="SaveItem" class="btn btn-block btn-flat btn-primary btn-sm">Save Item</button> 
                        </div>
                    </div>
                    
                </div>    
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>