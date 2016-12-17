(function($) {
	var Int = {
		params: {
			items: [],
			itemsSub: [],
			itemWeight: [],
			itemSubTotal: [],
			acReg: null
		},
		sendRequest: function(params) {
			$.ajax({
				url: myBaseUrl + 'save_interior',
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
						window.location.href = myBaseUrl;
					});
				}
			});
		},
		init: function() {
			$('[name="intItem[]"]').on('change', function() {
				$(this).closest('.box-success').find('.box-body input:checkbox').prop('checked', this.checked);
				//console.log(this.checked);
				if(this.checked) {
					$(this).closest('.box-success').find('.box-body input[name="intItemSubTotal[]"]').removeAttr('disabled');	
					$(this).closest('.input-group').find('[name="intItemWeight[]"]').removeAttr('disabled').focus();
				}
				else {
					$(this).closest('.box-success').find('.box-body input[name="intItemSubTotal[]"]').attr('disabled', 'disabled');
					$(this).closest('.box-success').find('.box-body input[name="intItemSubTotal[]"]').val('');
					$(this).closest('.input-group').find('[name="intItemWeight[]"]').attr('disabled', 'disabled');
					$(this).closest('.input-group').find('[name="intItemWeight[]"]').val('');	
				}
			});

			$('[name="intItemSub[]"]').on('change', function() {
				if(this.checked) {
					$(this).closest('.input-group').find('[name="intItemSubTotal[]"]').removeAttr('disabled').focus();
				}
				else {
					$(this).closest('.input-group').find('[name="intItemSubTotal[]"]').attr('disabled', 'disabled');
					$(this).closest('.input-group').find('[name="intItemSubTotal[]"]').val('');
				}
			});

			$('form[name="intForm"]').on('submit', function() {
				Int.params.items = $('[name="intItem[]"]:checked').map(function() {
				    return this.value;
				}).get();
				Int.params.itemsSub = $('[name="intItemSub[]"]:checked').map(function() {
				    return this.value;
				}).get();
				Int.params.itemWeight = $('[name="intItemWeight[]"]').map(function() {
				    if(this.value != ''){
				    	return this.value;
				    }
				}).get();
				Int.params.itemSubTotal = $('[name="intItemSubTotal[]"]').map(function() {
				    if(this.value != ''){
				    	return this.value;
				    }
				}).get();

				Int.params.acReg = $('[name="acType"] option:selected').val();

				var params = {
					items: Int.params.items,
					itemsSub: Int.params.itemsSub,
					itemWeight: Int.params.itemWeight,
					itemSubTotal: Int.params.itemSubTotal,
					acReg: Int.params.acReg
				};
				//console.log(params);
				Int.sendRequest(params);

				return false;
			});

			$('select[name="acType"]').select2();
		}
	};

	Int.init();
})(jQuery);