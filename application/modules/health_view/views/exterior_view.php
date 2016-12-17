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
    <h2 class="lead">Exterior Photos</h2>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="javascript:;" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><div class="alert alert-danger">Sorry, but your browser doesn't support javascript</div></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
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
    </tr>
{% } %}
</script>
<script src="<?php echo base_url();?>assets/plugins/uploader/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/load-image.all.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.blueimp-gallery.min.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url();?>assets/plugins/uploader/js/jquery.fileupload.js"></script>
<!-- The File Upload validation plugin -->
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