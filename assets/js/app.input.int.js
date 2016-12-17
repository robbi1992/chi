(function($) {
	var Int = {
		params: {
			iniID: iniID,
			acReg: acReg,
			inisID: null,
			items: null,
			defect: null,
			dirty: null,
			remark: null,
			currentMenu: iniName,
		},
		form: $('form[name="intForm"]'),
		cabinMenu: $('a[view="cabinMenu"]'),
		renderForm: function(data) {
			//$('.alert.alert-info').addClass('hidden');
			$('[template="intDetail"]').addClass('hidden');
			//console.log(data.weight[0].weight);
			var temp = $('[template="intStatus"]'),
				tempForm = $('[template="intForm"]');
			temp.find('.progress-text').empty().html(Int.params.currentMenu + ' Performance');
			temp.find('[view="performanceBar"]').html(data.result.performance.cabin);
			temp.find('[view="progress-bar"]').css('width', data.result.performance.cabin + '%');
			temp.find('[view="progress-bar"]').removeAttr('class');
			temp.find('[view="progress-bar"]').addClass('progress-bar');
			temp.find('[view="progress-bar"]').addClass(progressColor(data.result.performance.cabin));

			tempForm.find('[name="intWeight"]').val(data.result.weight[0].weight);
			//fill the option value
			rows = tempForm.find('[name="intItem"]').empty();
			tempTable = $('[template="rowTable"]');
			tempTable.find('tbody').empty();
			rowsTable = tempTable.find('tbody');

			std = $('<option value="">-- Please select item --</option>');
			std.appendTo(rows);
			no = 1;
			$.each(data.result.data, function(index, val) {
				row = $('<option value="'+val.inisID+'" data-total="'+ val.total+'" data-defect="'+ val.defect 
					+'" data-dirty="'+ val.dirty +'" data-dirtyPerform="'+ val.dirtyPerform +'" data-defectPerform="'
					+ val.defectPerform +'" data-remark="'+ val.remark +'" data-iniID="'+ val.iniID +'">'
					+val.inisName+'</option>');
				rowTable = tempTable.find('[view="templateRow"]').clone().removeClass('hidden').removeAttr('view');
				rowTable.find('[view="rowNo"]').html(no);
				rowTable.find('[view="rowName"]').html(val.inisName);
				rowTable.find('[view="rowDefect"]').html(val.defect);
				rowTable.find('[view="rowDirty"]').html(val.dirty);
				rowTable.find('[view="rowRemark"]').html(val.remark);
				rowTable.appendTo(rowsTable);
				row.appendTo(rows);
				no++;
			});
			//end fill the option value
			tempTable.removeClass('hidden');
			temp.removeClass('hidden');
			Int.form.find('[name="intItem"]').select2();
			tempForm.removeClass('hidden');

			//initialize select event
			tempForm.find('[name="intItem"]').on('change', function() {
				attrData = $(this).find('option:selected');
				
				row = $('[template="intDetail"]');
				row.find('[name="intTotal"]').val(attrData.attr('data-total'));
				row.find('[name="intDefectPerform"]').val(attrData.attr('data-defectPerform'));
				row.find('[name="intDirtyPerform"]').val(attrData.attr('data-dirtyPerform'));
				row.find('[name="intDefect"]').val(attrData.attr('data-defect'));
				row.find('[name="intDirty"]').val(attrData.attr('data-dirty'));
				row.find('[name="intRemark"]').val(attrData.attr('data-remark'));

				Int.params.inisID = attrData.val();
				Int.params.iniID = attrData.attr('data-iniID');
				Int.params.items = attrData.attr('data-total');
				Int.params.defect = attrData.attr('data-defect');
				Int.params.dirty = attrData.attr('data-dirty');
				Int.params.remark = attrData.attr('data-remark');

				row.removeClass('hidden');
			});
		},
		getSub: function(params) {
			$.ajax({
				url: baseUrl + 'get_sub_items',
				type: 'post',
				dataType: 'json',
				data: JSON.stringify(params)
			}).done(function(result) {
				Int.renderForm(result);
			});
		},
		enabled: function(value) {
			if(value) {
				Int.form.find('[name*=int]').removeAttr('disabled');
				Int.form.find(['name=intSubmit']).html('Input');
			}
			else {
				Int.form.find('[name*=int]').attr('disabled', 'disabled');
				Int.form.find(['name=intSubmit']).html('Loading');	
			}
		},
		doUpdate: function(params) {
			Int.enabled(false);

			$.ajax({
				url: baseUrl + 'update_interior',
				type: 'post',
				dataType: 'json',
				data: JSON.stringify(params)
			}).done(function(result) {
				Int.renderForm(result);
			}).always(function() {
				Int.enabled(true);
			});
		},
		init: function() {
			var params = {
					acReg: Int.params.acReg,
					cabinArea: Int.params.iniID
				};
			Int.getSub(params);

			Int.cabinMenu.on('click', function() {
				parent = $(this).closest('.list-group');
				parent.find('.list-group-item.active').removeClass('active');
				$(this).addClass('active');
				var params = {
					acReg: acReg,
					cabinArea: $(this).attr('cabin')
				};
				$('[template="intDetail"]').addClass('hidden');
				$('body.skin-blue.sidebar-mini').removeClass('sidebar-open');
				Int.params.currentMenu = $(this).attr('cabinName');
				Int.params.inisID = null;
				Int.getSub(params);
			});

			Int.form.on('submit', function() {
				Int.params.defect = $(this).find('[name="intDefect"]').val();
				Int.params.dirty = $(this).find('[name="intDirty"]').val();
				Int.params.remark = $(this).find('[name="intRemark"]').val();

				if(Int.params.inisID == null) {
					alert('Update nothing');
				}
				else {
					params = {
						acRID: Int.params.acReg,
						inisID: Int.params.inisID,
						iniID: Int.params.iniID,
						items: Int.params.items,
						defect: Int.params.defect,
						dirty: Int.params.dirty,
						remark: Int.params.remark
					};
					Int.doUpdate(params);
				}
				return false;
			});
		}
	};

	Int.init();
})(jQuery);