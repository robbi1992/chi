
<style>
	.mymargin-20 {
		margin-bottom: 20px; 
	}
</style>

<section class="content">
	<form name="intFunc" role="form" method="post">
	<div class="row mymargin-20">
		<div class="col-md-6">
			<input name="acType" type="hidden" value="<?php echo $name[0]->id;?>">
			<label for="acTypeValue">AirCraft Registered</label>
			<input id="acTypeValue" name="acTypeValue" type="text" class="form-control" value="<?php echo $name[0]->name_ac_reg;?>" readonly>
		</div>
		<div class="col-md-6">&nbsp;</div>
	</div>
	<?php
	foreach ($items as $v) {
		$items_checked = '';
		if (array_key_exists($v->fi_id, $trans_items)) {
			$items_checked = 'checked';
		}
	?>
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="funcItem[]" value="<?php echo $v->fi_id;?>" <?php echo $items_checked;?>>
					</span>
					<input type="text" class="form-control input-sm" value="<?php echo $v->fi_name;?>" disabled>
				</div>
			</h3>
		</div>
		<div class="box-body">
			<?php
			foreach($items_sub as $val) {
				if($v->fi_id === $val->fi_id) {
					$is_items = '';
					$is_dis = 'disabled';
					$is_checked = '';
					if (array_key_exists($val->fis_id, $trans)) {
						$is_items = $trans[$val->fis_id];
						$is_dis = '';
						$is_checked = 'checked';
					}
				?>
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="funcItemSub[]" value="<?php echo $val->fis_id;?>" <?php echo $is_checked;?>>
					</span>
					<input type="text" class="form-control input-sm" value="<?php echo $val->fis_name;?>" disabled>
					<input type="number" class="form-control input-sm" name="funcItemSubTotal[]" placeholder="Total item" <?php echo $is_dis;?> required value="<?php echo $is_items;?>">
				</div>
			</div>
				<?php
				}
			}
			?>
		</div>
	</div>
	<?php
	}
	?>
	<button type="submit" class="btn btn-primary" name="btn-save"><i class="fa fa-save"></i> Save</button>
	</form>
</section>

<script type="text/javascript">
	myBaseUrl = '<?php echo site_url();?>/root/';
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin.func.update.js"></script>