
        
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/redist/when.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/core.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/graphics.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapimage.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/mapdata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areadata.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/areacorners.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/scale.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/mapimage/tooltip.js"></script>               

    <?php echo jquery_select2(); ?>

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
        <div class="col-md-12" view="mapGenerator">
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
                                        <area href="#" onclick="Input.getMenu('<?php echo $v->id;?>', '<?php echo $v->noItem;?>')" state="<?php echo map_color($new_val);?>" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                                        <?php
                                        $has_value = TRUE;
                                    }
                                }
                                if(!$has_value) {
                                    ?>
                                    <area href="#" onclick="Input.getMenu('<?php echo $v->id;?>', '<?php echo $v->noItem;?>')" state="AE" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
                                    <?php
                                }
                            }
                            else {
                                ?>
                                <area href="#" onclick="Input.getMenu('<?php echo $v->id;?>', '<?php echo $v->noItem;?>')" state="AE" id="<?php echo $v->noItem;?>" shape="circle" coords="<?php echo $v->coordinate;?>" />
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

<!-- Modal Template -->
<div class="modal fade" id="menuModal" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Item name: <span name="modalTitle"></span></h4>
            </div>
            <!-- modal body -->
            <div class="modal-body">
                <form name="inspection_form" class="form-horizontal">
                    <div class="form-group">
                        <label for="fault_code" class="col-sm-3 control-label">Fault code</label>
                        <div class="col-sm-9">
                            <select name="fault_code" id="fault_code" style="width:100%;" required="required">
                                <option></option>
                                <?php
                                foreach ($fault_by_performance as $key => $v) {
                                    ?>
                                    <option value="<?php echo $v->fCode;?>"><?php echo $v->fCode . ' - ' . $v->fName; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fault_code_detail" class="col-sm-3 control-label">Fault code detail</label>
                        <div class="col-sm-9">
                            <option class="hidden" view="template"></option>
                            <select name="fault_code_detail" id="fault_code_detail" style="width:100%;" required="required">
                                <option value="">Please select fault code first</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fault_types" class="col-sm-3 control-label">Fault Types</label>
                        <div class="col-sm-9">
                            <select name="fault_types" id="fault_types" style="width:100%;" required="required">
                                <option></option>
                                <?php
                                foreach ($fault_types as $key => $v) {
                                    ?>
                                    <option value="<?php echo $v['fCode'];?>"><?php echo $v['fCode'] . ' - ' . $v['fName']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="value" class="col-sm-3 control-label">Value</label>
                        <div class="col-sm-9">
                            <div class="input-group" id="value">
                                <input type="text" name="value" class="form-control" placeholder="Performance Value" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">%</span>
                            </div>
                            <!--<select name="value" id="value" style="width:100%;" required="required">
                                <option value="1">Bad</option>
                                <option value="2">Fair</option>
                                <option value="3">Good</option>
                                <option value="4" selected="selected">Excellent</option>
                            </select>-->
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-xs pull-right" name="btn-insert">Insert to cart</button>
                    <h4>Cart</h4>
                    <hr>
                    <table view="tableCart" class="table table-bordered">
                        <thead>
                            <!-- template row -->
                            <tr class="hidden" view="templateCart">
                                <td view="no"></td>
                                <td view="faultCodeDetail"></td>
                                <td view="faultType"></td>
                                <td view="value"></td>
                            </tr>
                            <!-- end template row -->
                            <tr>
                                <th>No</th>
                                <th>Fault code detail</th>
                                <th>Fault Type</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- appended by ajax -->
                            <!-- end appended by ajax -->
                        </tbody>
                    </table>
                    <!-- end modal body -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button name="btn-save" type="button" class="btn btn-primary">Save Data</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Template -->
<script type="text/javascript">
    var Input = {
        params: {
            no: 0,
            cabinID: 0,
            faultCodeDetailVal: '',
            faultTypeVal: '',
            value: 0,
            acRegID: 0,
            peformanceType: 0,
            transInterior: [],
            isneedsave: false
        },
        baseUrl: '<?php echo base_url('health_input');?>/',
        inspectForm: $('form[name="inspection_form"]'),
        renderToDetail: function(listDetail) {
            var rows = Input.inspectForm.find('select[name="fault_code_detail"]').empty(),
                template = Input.inspectForm.find('[view="template"]');
            $.each(listDetail, function(index, value){
                row = template.clone().removeClass('hidden').removeAttr('view').attr('value', value.id).html(value.fCode + ' - ' + value.fName);
                row.appendTo(rows);
            });
            rows.select2();
        },
        renderToCart: function(params) {
            var rows = Input.inspectForm.find('table tbody');
            var template = Input.inspectForm.find('[view="templateCart"]');
            var row = template.clone().removeClass('hidden').removeAttr('view');

            row.find('[view="no"]').html(Input.params.no + 1);
            row.find('[view="faultCodeDetail"]').html(params.faultCodeDetailName);
            row.find('[view="faultType"]').html(params.faultTypeName);
            row.find('[view="value"]').html(params.valueName);

            row.appendTo(rows);
            Input.params.no = Input.params.no + 1;
            Input.params.faultCodeDetailVal = params.faultCodeDetailVal;
            Input.params.faultTypeVal = params.faultTypeVal;
            Input.params.value = params.valueVal;

            data = {
                fcid_fault_code: Input.params.faultCodeDetailVal,
                ft_fault_type: Input.params.faultTypeVal,
                value: Input.params.value,
                catd_id: Input.params.cabinID,
                ac_reg_id: Input.params.acRegID,
                pt_id: Input.params.peformanceType
            };
            Input.params.transInterior.push(data);
            //console.log(Input.params.transInterior);
        },
        getMenu: function(id, name) {
            Input.params.cabinID = id;
            Input.params.acRegID = '<?php echo $cabin_template[0]->aircraft_reg_fk; ?>';
            Input.params.peformanceType = "<?php echo $cabin_selected['id'];?>";
            Input.params.no = 0;
            //Input.params.cabinID = 0;
            Input.params.faultCodeDetailVal = '';
            Input.params.faultTypeVal = '';
            Input.params.Value = 0;
            Input.params.transInterior = [];
            Input.params.isneedsave = false;
            
            var wrapper = $('#menuModal');
            wrapper.find('[name="modalTitle"]').empty().html(name);
            wrapper.find('table tbody').empty();
            wrapper.modal();
        },
        getDetail: function(value) {
            $.ajax({
                url: Input.baseUrl + 'get_fault_code_detail',
                type: 'post',
                dataType: 'json',
                data: JSON.stringify(value)
            }).done(function(result){
                Input.renderToDetail(result);
            });
        },
        init: function() {
            Input.inspectForm.find('select[name="fault_code"]').select2({
                placeholder: 'Choose fault code'
            });
            Input.inspectForm.find('select[name="fault_types"]').select2({
                placeholder: 'Choose fault type'
            });
            /*Input.inspectForm.find('select[name="value"]').select2({
                minimumResultsForSearch : -1
            });*/
            Input.inspectForm.find('select[name="fault_code"]').on('change', function(){
                var param = {
                    param: $(this).val()
                };
                Input.getDetail(param);
            });
            Input.inspectForm.find('button[name="btn-insert"]').on('click', function(){
                var faultCodeDetailName = Input.inspectForm.find('select[name="fault_code_detail"] option:selected').html(),
                    faultCodeDetailVal = Input.inspectForm.find('select[name="fault_code_detail"] option:selected').val(),
                    faultTypeName = Input.inspectForm.find('select[name="fault_types"] option:selected').html(),
                    faultTypeVal = Input.inspectForm.find('select[name="fault_types"] option:selected').val(),
                    valueName = Input.inspectForm.find('input[name="value"]').val(),
                    valueVal = Input.inspectForm.find('input[name="value"]').val();
                    //valueName = Input.inspectForm.find('select[name="value"] option:selected').html(),
                    //valueVal = Input.inspectForm.find('select[name="value"] option:selected').val();
                if(faultTypeVal == "" || faultCodeDetailVal == "" || valueVal == "") {
                    alert('Please fulfill the fields');
                }
                else {
                    if(faultTypeVal == Input.params.faultTypeVal && faultCodeDetailVal == Input.params.faultCodeDetailVal) {
                        alert('Please do not input the same data');
                    }
                    else {
                        var params = {
                            faultCodeDetailName: faultCodeDetailName,
                            faultCodeDetailVal: faultCodeDetailVal,
                            faultTypeName: faultTypeName,
                            faultTypeVal: faultTypeVal,
                            valueName: valueName,
                            valueVal: valueVal
                        };
                        Input.renderToCart(params);
                    }
                    Input.params.save = true;
                }
            });
            //save function
            $('button[name="btn-save"]').on('click', function() {
                if(Input.params.save) {
                    $.ajax({
                        url: Input.baseUrl + 'interior_save',
                        type: 'post',
                        dataType: 'json',
                        data: JSON.stringify(Input.params.transInterior)
                    }).done(function(result){
                        if(result) {
                            if(result.code == 500) {
                                alert('Sorry, please try again laters');        
                            }
                            else {
                                alert('Data saved');
                                window.location.reload();    
                            }
                        }
                    }).fail(function(){
                        alert('Sorry, please try again laters');
                    });
                }
                else {
                    Alert('No data need save...');
                }
            });
        }
    };

    Input.init();
</script>