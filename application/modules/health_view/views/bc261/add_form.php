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
    
          <div class="box box-info">
            <!-- form start -->
            <div class="box-body">
              <form class="form-horizontal" action="<?php echo base_url('/bckeluar/bckeluar_261/add'); ?>"  method="post">
              <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No Dokumen BC / Pendaftaran</label>
                          <div class="col-sm-7">
                            <input type="text" name="nodo" class="form-control input-sm">
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Dokumen</label>
                          <div class="col-sm-8">
                            <input type="text" name="tado" class="form-control input-sm datepicker">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nomor Surat Jalan</label>
                          <div class="col-sm-7">
                            <input type="text" name="nosuja" class="form-control input-sm">
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Surat Jalan</label>
                          <div class="col-sm-8">
                            <input type="text" name="tasuja" class="form-control input-sm datepicker">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tujuan Pengiriman</label>
                          <div class="col-sm-7">
                            <select class="form-control input-sm" name="tupe">
                                <option value="">Tujuan Pengiriman</option>
                                <?php foreach($tujuan_pengiriman as $tupe): ?>
                                    <option value="<?php echo $tupe['tujuan'];?>"><?php echo $tupe['tujuan'];?></option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No Kontrak</label>
                          <div class="col-sm-7">
                            <input type="text" name="noko" class="form-control input-sm"/>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Kontrak</label>
                          <div class="col-sm-8">
                            <input type="text" name="tako" class="form-control input-sm datepicker">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No Ijin Kepala Kantor</label>
                          <div class="col-sm-7">
                            <input type="text" name="nikk" class="form-control input-sm" />
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Ijin Kepala Kantor</label>
                          <div class="col-sm-8">
                            <input type="text" name="tikk" class="form-control input-sm datepicker">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pengirim / Penerima</label>
                          <div class="col-sm-7">
                            <select class="form-control input-sm select2 col-sm-12" id="pepe" name="pepe">
                                <option value="">Pengirim / Penerima</option>
                                <?php foreach($supplier_data as $data_row): ?>
                                    <option value="<?php echo $data_row['id'];?>"><?php echo $data_row['nama_supp'];?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="nama_penerima" id="nama_penerima"/>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Alamat</label>
                          <div class="col-sm-8">
                            <input type="text" name="alamat" class="form-control input-sm" id="alamat" readonly="true">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Keluar</label>
                          <div class="col-sm-7">
                            <input type="text" name="take" class="form-control input-sm datepicker">
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No. Pengajuan</label>
                          <div class="col-sm-7">
                            <input type="text" name="nope" class="form-control input-sm">
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tgl Pengajuan</label>
                          <div class="col-sm-8">
                            <input type="text" name="tape" class="form-control input-sm datepicker" value="<?php echo date('d-m-Y');?>" readonly="true"/>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jenis Kemasan</label>
                          <div class="col-sm-7">
                            <input type="text" name="jeke" class="form-control input-sm"/>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jml Kemasan</label>
                          <div class="col-sm-8">
                            <input type="text" name="juke" class="form-control input-sm"/>
                          </div>
                        </div>
                    </div>
                </div>
                
              <hr class="bg-aqua" style="height: 2px;"/>
              
              <div class="row">
                  <div class="col-sm-12 data-barang">                    
                    <h3 class="box-title">Data Barang</h3>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:300px">Jenis</th>
                                <th style="text-align: center;width:250px">Jenis Barang</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: center;width:125px">Satuan</th>
                                <th style="text-align: center;">Berat Bersih (Kg)</th>
                                <th style="text-align: center;">Nilai CIF</th>
                                <th style="text-align: center;">&nbsp;</th>
    				        </tr>
                        </thead>
                       	<tbody class="my-data-barang">
                      		<tr class="text-data-barang">
                                <td>
                                    <select class="form-control select2 input-sm col-sm-12" id="jenis_brg">
                                      <option value="">Pilih Jenis Barang</option>
                                      <?php foreach($barang_data as $data_row): ?>
                                        <option value="<?php echo $data_row['kode'];?>"><?php echo $data_row['nama'];?></option>
                                      <?php endforeach; ?>
                                    </select>    
                                </td>  
                                <td>
                                    <input type="hidden" id="gudang_brg_id" class="form-control input-sm col-sm-12" readonly="true"/>
                                    <input type="text" id="gudang_brg_text" class="form-control input-sm col-sm-12" readonly="true"/>  
                                </td>  
                                <td><input type="text" id="jml_brg" class="form-control input-sm col-sm-12 numeric" placeholder="Jumlah" style="text-align: right;"/></td>  
                                <td>
                                    <select class="form-control select2 input-sm col-sm-12" id="satuan_brg">
                                      <option value="">Satuan</option>
                                      <?php foreach($jenis_satuan as $data_row): ?>
                                        <option value="<?php echo $data_row['id'];?>"><?php echo $data_row['kode'];?></option>
                                      <?php endforeach; ?>
                                    </select>                                
                                </td>  
                                <td><input type="text" id="bb_brg" class="form-control input-sm col-sm-12 numeric" placeholder="Berat Bersih (Kg)"  style="text-align: right;"/></td>                                            
                                <td><input type="text" id="cif_brg" class="form-control  input-sm col-sm-12 numeric" placeholder="Nilai CIF" style="text-align: right;"/></td>
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-barang">1</span></td>
                            </tr>
                        </tbody>
                    </table>
                        <a class="btn btn-info pull-right add-box" class=""><i class="fa fa-plus"></i></a>
                  </div>
              </div>
              
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Simpan</button>
                <a href="<?php echo base_url('/bckeluar/bckeluar_261/index'); ?>" class="btn btn-default" class="">Kembali</a>
              </div>
                
              </div>
              
              
              <!-- /.box-footer -->
            </form>
            </div>
          </div>
          
    </section>
    <!-- /.content -->
  </div>
  <script>
    
        $( "#pepe" ).change(function() {
            var pepe = $(this).val();
            $.getJSON('<?php echo base_url('bckeluar/bckeluar_30/cek_alamat/');?>/'+pepe, function (data) {
                if (data == '003') { alert('Data Not Found!'); } 
                else { 
                    $("#alamat").val(data.alamat);
                    $("#nama_penerima").val(data.nama_penerima);  
                    
                }
            });
        });
</script>