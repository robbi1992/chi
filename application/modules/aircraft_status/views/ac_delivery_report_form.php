<?php echo jquery_select2(); ?>

<script type="text/javascript">
$().ready(function(){
	//$('[name=id_users_group_fk]').select2({width : '75%'});
});
</script>

<section class="content-header">
	<h1>Original A/C Delivery Report <small><i class="fa fa-fw fa-angle-double-right"></i> <?php echo $ttl; ?></small></h1>
</section>

<div class="callout callout-info">
	<span>Untuk penulisan format tanggal pada MS. Excel harus menggunakan format tanggal bahasa Indonesia, contoh : 99/99/9999</span>
</div>

<?php if ($this->session->flashdata('upload_file') == 'failed'){ ?>
	<div class="col-xs-12">
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="icon fa fa-warning"></i>
			<span>The data is not successfully stored into database!! Make sure the file was successfully uploaded</span>
		</div>
	</div>
<?php }else if($this->session->flashdata('upload_file') == 'success'){ ?>
	<div class="col-xs-12">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<i class="icon fa fa-check"></i>			
			<span>Data successfully saved into the database</span>
		</div>
	</div>
<?php } ?>

<?php echo form_open_multipart($act, array('class' => 'form-horizontal row-form')); ?>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm"></label>
		<div class="col-sm-3">
			<a href="<?php echo base_url('/assets/donwload_file_excel/original_ac_delivery_report.xls'); ?>" target="_blank">
				Download Excel
				<!--<img class="img-responsive img-rounded" src="<?php echo base_url('/assets/images/excel.png'); ?>" width="35px"; height="35px;" />-->
				<i class="fa  fa-download"></i>
			</a>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label input-sm">Upload File</label>
		<div class="col-sm-3">
			<input type="file" name="userfile" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" class="btn btn-flat btn-primary color-palette btn-sm"><span class="fa fa-upload"></span> &nbsp;Upload </button>
			<a class="btn btn-flat bg-olive color-palette btn-sm" href="<?php echo $back; ?>"><span class="fa  fa-arrow-left"></span>&nbsp;&nbsp;Back</a>
		</div>
	</div>
<?php echo form_close(); ?>