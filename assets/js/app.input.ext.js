(function($) {
	form = $('form[name="uploadForm"]');

	Upload = {
		progress: function(value) {
			if(value) {
				form.find('input, button, select').attr('disabled', 'disabled');
			}
			else {
				form.find('input, button, select').removeAttr('disabled');	
			}
		},
		render: function(data) {
			var rows = $('tr[view="rows"]');
			rows.find('[view="' + data.area + '"]').find('img').attr('src', extUrl + 'thumbnails/' + data.upload_data.file_name);
		},
		init: function() {
			form.on('submit', function() {
				var area = $(this).find('[name="extArea"]').val(),
					image = $(this).find('[name="extImg"]').val(),
					formData = new FormData(this);
					
				if(area == '' || image == '') {
					alert('Please fill all of inputs');
				}
				else {
					Upload.progress(true);
					$.ajax({
						type: 'POST',
						url: baseUrl + 'upload_image',
						data: formData,
						cache: false,
						contentType: false,
						processData: false
					}).done(function(result) {
						if( ! result.error) {
							Upload.render(result);
						}
						else {
							alert(result.error);
						}
					}).always(function() {
						Upload.progress(false);
					});
				}
				return false;
			});
		}
	};

	Upload.init();
})(jQuery);