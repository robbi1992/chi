<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title_index ;?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $head ;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
        <!-- Horizontal Form -->
          <div class="box box-info">
            <!-- form start -->
            <div class="box-body">
              <form role="form" action="<?php echo base_url('/bckeluar/bckeluar_261/index'); ?>"  method="post">
                <!-- text input -->
                <div class="form-group">
                  <label>Filter By</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select onchange="show_div(this.value)" class="form-control select2 input-sm col-sm-12" id="filter_by" name="filter_by">
                                <option value="1">Hari</option>
                                <option value="2">Range Hari</option>
                                <option value="3">Bulan</option>
                            </select>    
                        </div>
                    </div>                  
                  </div>
                <div class="form-group">
                  <label>No Surat Jalan</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="nosuja" class="form-control input-sm " placeholder="No Surat Jalan">
                        </div>
                    </div>                  
                </div>
                <div class="form-group" id="start" style="display:none">
                 <label>Start</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="start" class="form-control input-sm datepicker" placeholder="Start"/>
                        </div>
                    </div>                  
                  </div>
                <div class="form-group" id="end" style="display:none">
                 <label>End</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="end" class="form-control input-sm datepicker" placeholder="End"/>
                        </div>
                    </div>                  
                </div>
                <div class="form-group" id="day" >
                 <label>Day</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="day" class="form-control input-sm datepicker" placeholder="Start"/>
                        </div>
                    </div>                  
                  </div>
                <div class="form-group" id="monthly" style="display:none">
                 <label>Bulan</label>
                    <div class="row">
                        <div class="col-sm-3">
                            <select style="width:100%" class="form-control select2" name="bulan">
                            <option value=""></option>
                            <?php foreach($arr_bulan as $bulan){ ?>
                                <option value="<?php echo $bulan['bulan'];?>"><?php echo $bulan['nama_bulan'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select style="width:100%" class="form-control select2" name="tahun">
                            <option value=""></option>
                            <?php foreach($arr_tahun as $tahun){ ?>
                                <option value="<?php echo $tahun['tahun'];?>"><?php echo $tahun['tahun'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>                  
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-xs">Cari</button>  
                  <a href="<?=base_url('bckeluar/bckeluar_261/add')?>" class="btn btn-info btn-xs">Tambah</a>        
                </div>
              </form>
            </div>
          </div>
          
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data <?php echo $title_index ;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datatables" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO.</th>
                  <th>NO PENGAJUAN</th>
                  <th>NO DOKUMEN</th>
                  <th>TGL PENGAJUAN</th>
                  <th>PABEAN</th>
                  <th>PENGIRIM/PENERIMA</th>
                  <th></th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
      
    $().ready(function(){	
    	var $tables = $('#datatables').dataTable({
    		"scrollY"			: "342px",
            "scrollCollapse"	: true,
    		"processing" 		: true, //Feature control the processing indicator.
    		"serverSide" 		: true, //Feature control DataTables' server-side processing mode.
    		"order" 	 		: [], //Initial no order.
    
    		// Load data for the table's content from an Ajax source
    		"ajax": {
    			"url"	: "<?php echo site_url('bckeluar/bckeluar_261/ajax_get_data'); ?>",
    			"type"	: "POST"
    		},
    
    		//Set column definition initialisation properties.
    		"columnDefs" : [
    			{ 
    				"targets"	: [ 0 ], //first column / numbering column
    				"orderable"	: false, //set not orderable
    			},
    		],
    	});
        
    });
    </script>
  <script type="text/javascript">
    function show_div(id){
      if(id==1){
        $("#start").show();
        $("#end").show();
        $("#day").hide();
        $("#monthly").hide();
      }
      if(id==2){
        $("#start").hide();
        $("#end").hide();
        $("#day").show();
        $("#monthly").hide();
      }
      if(id==3){
        $("#start").hide();
        $("#end").hide();
        $("#day").hide();
        $("#monthly").show();
      }
    }
  </script>