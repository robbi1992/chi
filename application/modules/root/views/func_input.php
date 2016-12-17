<?php echo jquery_select2(); ?>
<style>
	.mymargin-20 {
		margin-bottom: 20px; 
	}
</style>

<section class="content">
	<form name="intFunc" role="form" method="post">
	<div class="row mymargin-20">
		<div class="col-md-6">
			<label >AirCraft Registered</label>
            <!-- acType means acRegistered -->
            <select class="form-control select input-sm" id="acType" name="acType" data-placeholder="AirCraft Registered" required="">
                <option value=""></option>
                <?php foreach($acType as $row): ?>
                    <optgroup label="<?php echo $row['name_aircraft'];?>">
                        <?php foreach($acReg as $col): 
                            if($row['id'] === $col['id_aircraft_type_fk']):
                        ?>
                        <option value="<?php echo $col['id'];?>"><?php echo $col['name_ac_reg'];?></option>
                        <?php 
                        endif;
                        endforeach; 
                        ?>            
                    </optgroup>
                <?php endforeach; ?>
            </select>
		</div>
		<div class="col-md-6">&nbsp;</div>
	</div>
	<?php
	foreach ($items as $v) {
	?>
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="funcItem[]" value="<?php echo $v->fi_id;?>">
					</span>
					<input type="text" class="form-control input-sm" value="<?php echo $v->fi_name;?>" disabled>
				</div>
			</h3>
		</div>
		<div class="box-body">
			<?php
			foreach($items_sub as $val) {
				if($v->fi_id === $val->fi_id) {
				?>
			<div class="col-md-3">
				<div class="input-group">
					<span class="input-group-addon">
						<input type="checkbox" name="funcItemSub[]" value="<?php echo $val->fis_id;?>">
					</span>
					<input type="text" class="form-control input-sm" value="<?php echo $val->fis_name;?>" disabled>
					<input type="number" class="form-control input-sm" name="funcItemSubTotal[]" placeholder="Total item" disabled required>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin.func.js"></script>