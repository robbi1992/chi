<!-- Generic page styles -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/uploader/css/style.css">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/uploader/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/uploader/css/jquery.fileupload-ui.css">

<section class="content-header">
    <h1>Exterior Appereance<small><i class="fa fa-fw fa-angle-double-right"></i><b><?php echo $typeac; ?> <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $typereg; ?></b></small></h1>
</section>

<section class="content">
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
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Group</th>
                    <th>Item</th>
                    <th>Value</th>
                    <th>Inspected date</th>
                    <th>Inspector</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($result as $value) {
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
                    <td><?php echo $no;?></td>
                    <td><?php echo $value['item'];?></td>
                    <td><?php echo $value['subItemName'];?></td>
                    <td view="value"><?php echo $value['value'];?></td>
                    <td class="hidden" view="subItem"><?php echo $value['subItemId'];?></td>
                    <td view="date"><?php echo $value['date'];?></td>
                    <td view="inspector"><?php echo $value['inspector'];?></td>
                    <td><button view="btn-edit" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</button></td>
                </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- end form input -->
    <div class="container" style="width:100%;">
    <h2 class="lead">Form Upload Exterior Photos</h2>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="javascript:;" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><div class="alert alert-danger">Sorry, but your browser doesn't support javascript</div></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" accept="image/*" multiple>
                    <input type="hidden" name="acReg[]" value="<?php echo $typereg;?>">
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>

    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>The maximum file size for uploads is <strong>200 KB</strong>.</li>
                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed.</li>
            </ul>
        </div>
    </div><!-- end panel default -->
    </div><!-- end container -->

    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div><!-- end div#blueimp-gallery -->
<!-- The template to display files available for upload -->
</section>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script src="<?php echo base_url();?>assets/plugins/uploader/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.fileupload-image.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.fileupload-ui.js"></script>
<script type="text/javascript">
    var myBaseUrl = '<?php echo site_url("uploader/?ac_reg=" . $idAcReg);?>';
</script>
<!-- The main application script -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script type="text/javascript">
    var edit = {
        params: {
            value : 0,
            idAcReg: '<?php echo $idAcReg;?>',
            subItem: 0,
            baseUrl: '<?php echo site_url('health_input');?>/',
            stop: true
        },
        doUpdate: function(params) {
            $.ajax({
                url: edit.params.baseUrl + 'updateExteriorValue',
                type: 'post',
                dataType: 'JSON',
                data: JSON.stringify(params)
            }).done(function(result) {
                if(result.status == 200) {
                    edit.params.stop = true;
                    //progress bar
                    $('.progress-group').find('[view="ex_scoring"]').html(result.score);
                    $('.progress-group').find('[view="ex_progress"]').removeAttr('class');
                    $('.progress-group').find('[view="ex_progress"]').addClass('progress-bar');
                    
                    if(result.score > 98 && result.score <= 100) {
                        bg = 'progress-bar-aqua';
                    }
                    else if(result.score > 87 && result.score <= 98) {
                        bg = 'progress-bar-green';
                    }
                    else if(result.score > 74 && result.score <= 87) {
                        bg = 'progress-bar-yellow';
                    }
                    else if(result.score >= 0 && result.score <= 74) {
                        bg = 'progress-bar-red';
                    }
                    else {
                        bg = 'undefined';
                    }
                    $('.progress-group').find('[view="ex_progress"]').addClass(bg);
                    $('.progress-group').find('[view="ex_progress"]').css('width', result.score + '%');
                }
                else {
                    alert('Any problems, please try again later ...');
                    edit.params.stop = false;
                }
            });
        },
        update: function(e, el) {
            if(e.keyCode == 13) {
                var val = $(el).val(); 
                
                if (val == "" || val == 0) {
                    alert('value is not allowed null');
                }
                else {
                    if (val == edit.params.value) {
                        var row = $(el).closest('tr');
                        var temp = row.find('[view="value"]');
                        temp.empty();
                        temp.html(edit.params.value);
                        //alert('there is no value change');
                    }
                    else {
                        if(val > 0 && val < 5) {
                            edit.params.value = val;
                            var params = {
                                acReg : edit.params.idAcReg,
                                subItem: edit.params.subItem,
                                val : edit.params.value
                            };
                            edit.doUpdate(params);
                            if (edit.params.stop) {
                                if(val == 1) {
                                    bg ='bg-red';
                                }
                                else if(val == 2) {
                                    bg = 'bg-yellow';
                                }
                                else if(val == 3) {
                                    bg = 'bg-green';
                                }
                                else {
                                    bg = '';
                                }

                                var row = $(el).closest('tr');
                                var temp = row.find('[view="value"]');
                                temp.empty();
                                temp.html(edit.params.value);
                                row.find('[view="date"]').empty().html('<?php echo date("Y-m-d");?>');
                                row.find('[view="inspector"]').empty().html('<?php echo $_SESSION["users"]->id;?>');
                                row.removeClass();
                                row.addClass(bg);
                            }
                        }
                        else {
                            alert('only 1, 2, 3 , 4 value are allowed');
                        }
                    }
                }
                return false;
            }
        },
        init: function() {
            $('[view="btn-edit"]').on('click', function() {
                var row = $(this).closest('tr');
                var temp = row.find('[view="value"]');

                edit.params.subItem = parseInt(row.find('[view="subItem"]').html());
                edit.params.value = parseInt(temp.html());
                temp.empty().append('<input class="form-control" onkeypress="edit.update(event, this)" value=' + edit.params.value + ' />');
                temp.find('input').focus();
            });
        }
    }
    edit.init();
</script>