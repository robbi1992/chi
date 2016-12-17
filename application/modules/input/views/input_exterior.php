<section class="content-header">
    <h1>
        <small>
            <a href="<?php echo site_url();?>"><i class="fa fa-home"></i> Main Menu</a>
            <i class="fa fa-fw fa-angle-double-right"></i> Input
            <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url();?>/input/aircraft_type"> All Aircraft</a>
            <i class="fa fa-fw fa-angle-double-right"></i> <?php echo $typeac;?> <i class="fa fa-fw fa-angle-double-right"></i> <a href="<?php echo site_url('/input/performance/' . $typeac . '/' . $typereg);?>"><?php echo $typereg;?></a>
            <i class="fa fa-fw fa-angle-double-right"></i> <i class="fa fa-plane"></i> Exterior Appearance
        </small>
    </h1>
</section>

<section class="content">
    <!-- upload foto -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Images upload form</h3>
                </div>
                <div class="box-body">
                    <form name="uploadForm" method="post" enctype="multipart/form-data" role="form">
                        <input type="hidden" name="extReg" value="<?php echo $idAcReg; ?>">
                        <div class="form-group col-md-4">
                            <label>Exterior area</label>
                            <select name="extArea" class="form-control">
                                <option value="">-- Please select area --</option>
                                <?php
                                foreach ($items as $val) {
                                ?>
                                <option value="<?php echo $val['itemID']; ?>"><?php echo $val['itemName']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Image File</label>
                            <input type="file" name="extImg" class="form-control" accept="image/*">
                        </div>
                        <div class="form-group col-md-4">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary form-control">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end upload foto -->
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
                                        <td view="<?php echo $val['itemID'] ?>" class="text-center"><img style="width:80px; height: 80px;" src="<?php echo ext_assets_url . 'thumbnails/' . $v->eif_url;?>"></td>
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
                        <th class="text-center">Action</th>
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
                        <td class="text-center"><?php echo $no;?></td>
                        <td><?php echo $value['item'];?></td>
                        <td><?php echo $value['subItemName'];?></td>
                        <td class="text-center" view="value"><?php echo $value['value'];?></td>
                        <td class="hidden" view="subItem"><?php echo $value['subItemId'];?></td>
                        <td class="text-center" view="date"><?php echo $value['date'];?></td>
                        <td class="text-center" view="inspector"><?php echo $value['inspector'];?></td>
                        <td class="text-center"><button view="btn-edit" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</button></td>
                    </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script type="text/javascript"> 
    var baseUrl = '<?php echo site_url('input');?>/';
    var extUrl = '<?php echo ext_assets_url;?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/app.input.ext.js"></script>
<script type="text/javascript">
    var edit = {
        params: {
            value : 0,
            idAcReg: '<?php echo $idAcReg;?>',
            subItem: 0,
            baseUrl: '<?php echo site_url('input');?>/',
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