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
              <form class="form-horizontal" action="#"  method="post">
              <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No Dokumen BC / Pendaftaran</label>
                          <div class="col-sm-7">
                            <input type="text" name="nodo" class="form-control input-sm" value="<?php echo $data_dokumen['no_dokumen'];?>">
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Dokumen</label>
                          <div class="col-sm-8">
                            <input type="text" name="tado" class="form-control input-sm datepicker"  value="<?php echo date('d-m-Y',strtotime($data_dokumen['tgl_dokumen']));?>" />
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Nomor Surat Jalan</label>
                          <div class="col-sm-7">
                            <input type="text" name="nosuja" class="form-control input-sm" value="<?php echo $data_dokumen['no_sj'];?>" />
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Surat Jalan</label>
                          <div class="col-sm-8">
                            <input type="text" name="tasuja" class="form-control input-sm datepicker" value="<?php echo date('d-m-Y',strtotime($data_dokumen['tgl_sj']));?>" />
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
                                    <option value="<?php echo $tupe['tujuan'];?>" <?php if($data_dokumen['tujuan_pengiriman'] == $tupe['tujuan']) {echo 'selected';} ?>><?php echo $tupe['tujuan'];?></option>
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
                            <input type="text" name="noko" class="form-control input-sm" value="<?php echo $data_dokumen['no_kontrak'];?>"/>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Kontrak</label>
                          <div class="col-sm-8">
                            <input type="text" name="tako" class="form-control input-sm datepicker" value="<?php echo date('d-m-Y',strtotime($data_dokumen['tgl_kontrak']));?>" />
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No Ijin Kepala Kantor</label>
                          <div class="col-sm-7">
                            <input type="text" name="nikk" class="form-control input-sm" value="<?php echo $data_dokumen['no_ijin'];?>" />
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Ijin Kepala Kantor</label>
                          <div class="col-sm-8">
                            <input type="text" name="tikk" class="form-control input-sm datepicker" value="<?php echo date('d-m-Y',strtotime($data_dokumen['tgl_ijin']));?>" />
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
                                    <option value="<?php echo $data_row['id'];?>" <?php if($data_dokumen['id_pemasok'] == $data_row['id']) {echo 'selected';} ?>><?php echo $data_row['nama_supp'];?></option>
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
                            <input type="text" name="alamat" class="form-control input-sm" id="alamat" value="<?php echo $data_dokumen['alamat_penerima'];?>" readonly="true">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tanggal Keluar</label>
                          <div class="col-sm-7">
                            <input type="text" name="take" class="form-control input-sm datepicker" value="<?php echo date('d-m-Y',strtotime($data_dokumen['tgl_keluar']));?>" />
                          </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">No. Pengajuan</label>
                          <div class="col-sm-7">
                            <input type="text" name="nope" class="form-control input-sm" value="<?php echo $data_dokumen['no_pengajuan'];?>" />
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Tgl Pengajuan</label>
                          <div class="col-sm-8">
                            <input type="text" name="tape" class="form-control input-sm datepicker"  value="<?php echo date('d-m-Y',strtotime($data_dokumen['tgl_pengajuan']));?>" readonly="true"/>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jenis Kemasan</label>
                          <div class="col-sm-7">
                            <input type="text" name="jeke" class="form-control input-sm"  value="<?php echo $data_dokumen['jenis_kemasan'];?>" />
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="col-sm-4 control-label">Jml Kemasan</label>
                          <div class="col-sm-8">
                            <input type="text" name="juke" class="form-control input-sm" value="<?php echo $data_dokumen['jml_kemasan'];?>" />
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
                            <?php foreach($data_dokumen_detail as $dokumen_detail): ?>
                            <tr class="text-data-barang">
                                <td>
                                    <input type="text" class="form-control input-sm col-sm-12" value="<?php echo $dokumen_detail['uraian_brg'];?>" readonly />
                                    <input name="jenis_brg[]" type="hidden" class="form-control input-sm col-sm-12"  value="<?php echo $dokumen_detail['kode_brg'];?>" />
                                </td>
                                <td>
                                    <?php $data_jenis_satuan = $this->db->where('id',$dokumen_detail['kode_gudang'])->get('mst_jenis_barang')->row(); ?>
                                    <input type="text" class="form-control input-sm col-sm-12" value="<?php echo $data_jenis_satuan->nama;?>" readonly />
                                    <input name="gudang_brg[]" type="hidden" class="form-control input-sm col-sm-12" value="<?php echo $dokumen_detail['kode_gudang'];?>" /> 
                                </td>  
                                <td>
                                    <input name="jml_brg[]" type="text" class="form-control input-sm col-sm-12" placeholder="Jumlah" value="<?php echo $dokumen_detail['jumlah_brg'];?>" style="text-align: right;" readonly/>
                                </td>  
                                <td>
                                    <input name="satuan_brg[]" type="text" class="form-control input-sm col-sm-12" value="<?php echo $dokumen_detail['satuan_dok'];?>" readonly/>                           
                                </td>  
                                <td><input name="bb_brg[]" type="text" class="form-control input-sm col-sm-12" placeholder="Berat Bersih (Kg)" value="<?php echo $dokumen_detail['berat_bersih'];?>" style="text-align: right;" readonly/></td>                                            
                                <td><input name="cif_brg[]" type="text" class="form-control  input-sm col-sm-12" placeholder="Nilai CIF"  value="<?php echo $dokumen_detail['nilai_cif_brg'];?>" style="text-align: right;" readonly/></td>
                                <td style="text-align: center; width: 10px;"><span style="display:none;" class="box-number-data-barang"><?php echo $dokumen_detail['no_urut'];?></span><a class="remove-box btn btn-danger"><i class="fa fa-remove"></a></td>
                            </tr>
                            <?php endforeach; ?>
                      		
                        </tbody>
                    </table>
                  </div>
              </div>
              
              <!-- /.box-body -->
              <div class="box-footer">
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
            $.getJSON('<?php echo base_url('bckeluar/bckeluar_261/cek_alamat/');?>/'+pepe, function (data) {
                if (data == '003') { alert('Data Not Found!'); } 
                else { 
                    $("#alamat").val(data.alamat);
                    $("#nama_penerima").val(data.nama_penerima);  
                    
                }
            });
        });
</script>