(function($) {
	var Func = {
		params: {
			items: [],
			itemsSub: [],
			itemSubTotal: [],
			acReg: null
		},
		sendRequest: function(params) {
			$.ajax({
				url: myBaseUrl + 'save_func',
				type: 'POST',
				dataType: 'JSON',
				data: JSON.stringify(params)
			}).done(function(result) {
				if(result && result.status == 'success') {
					swal({
						title: 'Saved',
						text: 'Data is saved',
						type: 'success',
						timer: 2000,
						showConfirmButton: false
					},
					function(){
						window.location.href = myBaseUrl + 'functionality';
					});
				}
			});
		},
		init: function() {
			$('[name="funcItem[]"]').on('change', function() {
				$(this).closest('.box-success').find('.box-body input:checkbox').prop('checked', this.checked);
				if(this.checked) {
					$(this).closest('.box-success').find('.box-body input[name="funcItemSubTotal[]"]').removeAttr('disabled');
				}
				else {
					$(this).closest('.box-success').find('.box-body input[name="funcItemSubTotal[]"]').attr('disabled', 'disabled');
					$(this).closest('.box-success').find('.box-body input[name="funcItemSubTotal[]"]').val('');
				}
			});

			$('[name="funcItemSub[]"]').on('change', function() {
				if(this.checked) {
					$(this).closest('.input-group').find('[name="funcItemSubTotal[]"]').removeAttr('disabled').focus();
				}
				else {
					$(this).closest('.input-group').find('[name="funcItemSubTotal[]"]').attr('disabled', 'disabled');
					$(this).closest('.input-group').find('[name="funcItemSubTotal[]"]').val('');
				}
			});

			$('form[name="intFunc"]').on('submit', function() {
				Func.params.items = $('[name="funcItem[]"]:checked').map(function() {
				    return this.value;
				}).get();
				Func.params.itemsSub = $('[name="funcItemSub[]"]:checked').map(function() {
				    return this.value;
				}).get();
				Func.params.itemSubTotal = $('[name="funcItemSubTotal[]"]').map(function() {
				    if(this.value != ''){
				    	return this.value;
				    }
				}).get();

				Func.params.acReg = $('[name="acType"] option:selected').val();

				var params = {
					items: Func.params.items,
					itemsSub: Func.params.itemsSub,
					itemSubTotal: Func.params.itemSubTotal,
					acReg: Func.params.acReg
				};
				//console.log(params);
				Func.sendRequest(params);
				return false;
			});

			$('select[name="acType"]').select2();
		}
	}
	Func.init();
})(jQuery);