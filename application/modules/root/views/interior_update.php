
<style>
	.mymargin-20 {
		margin-bottom: 20px; 
	}
</style>

<section class="content">
	<form name="intForm" role="form" method="post">
	<div class="row mymargin-20">
		<div class="col-md-6">
			<input name="acType" type="hidden" value="<?php echo $name[0]->id;?>">
			<label for="acTypeValue">AirCraft Registered</label>
			<input id="acTypeValue" name="acTypeValue" type="text" class="form-control" value="<?php echo $name[0]->name_ac_reg;?>" readonly>
		</div>
		<div class="col-md-6">&nbsp;</div>
	</div>
	<?php
	$weights = $items_weight;
	foreach ($items as $i => $v) {
		$weight = '';
		$items_disabled = 'disabled';
		$items_checked = '';
		if (array_key_exists($v->ini_id, $weights)) {
			$weight = $weights[$v->ini_id];
			$items_disabled = '';
			$items_checked = 'checked';
		}
	?>
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="intItem[]" value="<?php echo $v->ini_id;?>" <?php echo $items_checked; ?>>
					</span>
					<input type="text" class="form-control input-sm" value="<?php echo $v->ini_name;?>" disabled>
					<input type="number" class="form-control input-sm" name="intItemWeight[]" placeholder="weight" required <?php echo $items_disabled; ?> value="<?php echo $weight;?>">
				</div>
			</h3>
		</div>
		<div class="box-body">
			<?php
			foreach($items_sub as $val) {
				if($v->ini_id === $val->ini_id) {
					$is_items = '';
					$is_dis = 'disabled';
					$is_checked = '';
					if (array_key_exists($val->inis_id, $trans)) {
						$is_items = $trans[$val->inis_id];
						$is_dis = '';
						$is_checked = 'checked';
					}
				?>
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="intItemSub[]" value="<?php echo $val->inis_id;?>" <?php echo $is_checked; ?>>
					</span>
					<input type="text" class="form-control input-sm" value="<?php echo $val->inis_name;?>" disabled>
					<input type="number" class="form-control input-sm" name="intItemSubTotal[]" placeholder="Total item" required <?php echo $is_dis; ?> value="<?php echo $is_items;?>">
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin.int.update.js"></script>