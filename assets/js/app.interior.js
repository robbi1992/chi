(function($) {
	Interior = {
		params: {
			currentMenu: '',
			inisID: null,
			iniID: null,
			acrID: acReg,
			items: null,
			defect: null,
			dirty: null,
			remark: ''
		},
		form: $('form[name="intForm"]'),
		cabinMenu: $('a[view="cabinMenu"]'),
		enabled: function(value) {
			if(value) {
				Interior.form.find('[name*=int]').removeAttr('disabled');
				Interior.form.find(['name=intSubmit']).html('Input');
			}
			else {
				Interior.form.find('[name*=int]').attr('disabled', 'disabled');
				Interior.form.find(['name=intSubmit']).html('Loading');	
			}
		},
		doUpdate: function(params) {
			Interior.enabled(false);

			$.ajax({
				url: baseUrl + 'update_interior',
				type: 'post',
				dataType: 'json',
				data: JSON.stringify(params)
			}).done(function(result) {
				Interior.renderForm(result);
			}).always(function() {
				Interior.enabled(true);
			});
		},
		renderForm: function(data) {
			$('.alert.alert-info').addClass('hidden');
			$('[template="intDetail"]').addClass('hidden');
			//console.log(data.weight[0].weight);
			var temp = $('[template="intStatus"]'),
				tempForm = $('[template="intForm"]');
			temp.find('.progress-text').empty().html(Interior.params.currentMenu + ' Performance');
			temp.find('[view="performanceBar"]').html(data.result.performance.cabin);
			temp.find('[view="progress-bar"]').css('width', data.result.performance.cabin + '%');
			temp.find('[view="progress-bar"]').removeAttr('class');
			temp.find('[view="progress-bar"]').addClass('progress-bar');
			temp.find('[view="progress-bar"]').addClass(progressColor(data.result.performance.cabin));

			tempForm.find('[name="intWeight"]').val(data.result.weight[0].weight);
			//fill the option value
			rows = tempForm.find('[name="intItem"]').empty();
			std = $('<option value="">-- Please select item --</option>');
			std.appendTo(rows);
			$.each(data.result.data, function(index, val) {
				row = $('<option value="'+val.inisID+'" data-total="'+ val.total+'" data-defect="'+ val.defect 
					+'" data-dirty="'+ val.dirty +'" data-dirtyPerform="'+ val.dirtyPerform +'" data-defectPerform="'
					+ val.defectPerform +'" data-remark="'+ val.remark +'" data-iniID="'+ val.iniID +'">'
					+val.inisName+'</option>');
				row.appendTo(rows);
			});
			//end fill the option value
			temp.removeClass('hidden');
			Interior.form.find('[name="intItem"]').select2();
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

				Interior.params.inisID = attrData.val();
				Interior.params.iniID = attrData.attr('data-iniID');
				Interior.params.items = attrData.attr('data-total');
				Interior.params.defect = attrData.attr('data-defect');
				Interior.params.dirty = attrData.attr('data-dirty');
				Interior.params.remark = attrData.attr('data-remark');

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
				Interior.renderForm(result);
			});
		},
		init: function() {
			$('a[view="btnBack"]').on('click', function() {
				window.location.href = backUrl;
				return false;
			});
			$('select[name="intNav"]').select2({minimumResultsForSearch: -1}).on('change', function() {
				var params = {
					acReg: acReg,
					cabinArea: $(this).val()
				};
				$('[template="intDetail"]').addClass('hidden');
				Interior.params.currentMenu = $(this).find('option:selected').html();
				Interior.params.inisID = null;
				Interior.getSub(params);
			});

			/*Interior.cabinMenu.on('click', function() {
				var params = {
					acReg: acReg,
					cabinArea: $(this).attr('cabin')
				};
				$('[template="intDetail"]').addClass('hidden');
				$('body.skin-blue.sidebar-mini').removeClass('sidebar-open');
				Interior.params.currentMenu = $(this).find('span').html();
				Interior.params.inisID = null;
				Interior.getSub(params);
			});*/

			Interior.form.on('submit', function() {
				Interior.params.defect = $(this).find('[name="intDefect"]').val();
				Interior.params.dirty = $(this).find('[name="intDirty"]').val();
				Interior.params.remark = $(this).find('[name="intRemark"]').val();

				if(Interior.params.inisID == null) {
					alert('Update nothing');
				}
				else {
					params = {
						acRID: Interior.params.acrID,
						inisID: Interior.params.inisID,
						iniID: Interior.params.iniID,
						items: Interior.params.items,
						defect: Interior.params.defect,
						dirty: Interior.params.dirty,
						remark: Interior.params.remark
					};
					Interior.doUpdate(params);
				}
				return false;
			});
		}
	};
	Interior.init();
})(jQuery);