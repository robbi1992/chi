<style>
	.my-link:hover {
		cursor: pointer;
	}
</style>
<section class="content-header">
	<h1>PERFORMANCE MONITORING<small><i class="fa fa-fw fa-angle-double-right"></i> All Aircraft</small></h1>
</section>
<section class="content">
	<div class="row">
	<?php
	foreach($list as $v):
	?>
		<div class="col-lg-3 col-xs-6">
		<!-- small box -->
			<div class="small-box bg-primary my-link" onClick="getDataAC('<?php echo $v->id;?>','<?php echo $v->name_aircraft;?>')">
				<div class="inner">
				<h6 class="text-center"><strong><?php echo $v->name_aircraft;?></strong></h6>
				</div>
			</div>
		</div>
	<?php
	endforeach;
	?>
	</div>
	<div class="hidden" name="searchResult">
		<div class="box">
			<div class="box-header with-border">
				<h4>Aircraft Type: <span view="acType"></span></h4>
			</div>
			<div class="box-body">
				<!-- append items -->
				<div class="col-lg-2 col-xs-6 hidden" template="searchRow">
					<!-- small box -->
					<a href="">
						<div class="small-box">
							<div class="inner">
								<h3><span view="acRegName"></span> <br /><small style="color:#000;" view="acRegPerform"></small></h3>
							</div>
							<div class="icon">
								<i class="fa fa-plane"></i>
							</div>
						</div>
					</a>
				</div>
				<!-- end append items -->
				<div class="row">
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	function getDataAC(acType, acTypeName) {
		var acType = {
			param: {
				acType: acType,
				acTypeName: acTypeName
			}
		};
		$.ajax({
			url: '<?php echo base_url() . 'health_view/get_ac_reg';?>',
			type: 'post',
			dataType: 'json',
			data: JSON.stringify(acType)
		}).done(function(result){
			if(result.status == 'ok') {
				var resultData = $('[name="searchResult"]'),
					myBaseUrl = '<?php echo base_url();?>health_view/cabin/'+acTypeName;
				//clear acType
				resultData.find('[view="acType"]').empty().html(result.acType);
				var template = resultData.find('[template="searchRow"]');
				var rows = resultData.find('.row').empty();
				
				$.each(result.result, function(index, value) {
					var row = template.clone().removeClass('hidden').removeAttr('template');

					if(value.performance_interior >= 96 && value.performance_interior <= 100) {
						myBg = 'bg-blue';
					}
					else if(value.performance_interior >= 85 && value.performance_interior < 96) {
						myBg = 'bg-green';
					}
					else if(value.performance_interior >= 75 && value.performance_interior < 85) {
						myBg = 'bg-yellow';
					}
					else if(value.performance_interior > 0 && value.performance_interior < 75) {
						myBg = 'bg-red';
					}					
					else {
						myBg = 'undefined';
					}

					row.find('[view="acRegName"]').html(value.name_ac_reg);
					row.find('[view="acRegPerform"]').html(value.performance_interior + '%');
					row.find('div.small-box').addClass(myBg);
					row.find('a').attr('href', myBaseUrl + '/' +value.name_ac_reg)
						.attr('title', 'click to view health index detail');
					row.appendTo(rows);
				});
				resultData.removeClass('hidden');
			}
			else {
				alert('Any something wrong, please try again later');
			}
		});
	}
</script>