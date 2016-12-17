(function($) {
	var form = $('form[name="formReport"]');
	var Report = {
		generateChart: function(result) {
			//rawData = [[90, 0], [98, 1]];
			//ticks = [[0, 'tes'], [1, 'teslagi']];
			$('#bar-chart').css('height', 300);
			var rawData = result.rawData,
				ticks = result.ticks;

			//console.log(rawData);
			//console.log(ticks);

			var dataSet = [
				    { data: rawData, color: "#E8E800" }
				];

			options.yaxis.ticks = ticks;
  			$.plot($("#bar-chart"), dataSet, options); 
  			$("#bar-chart").UseTooltip();
		},
		enabled: function(value) {
			if(value) {
				form.find('[name*=search]').removeAttr('disabled');
			}
			else {
				form.find('[name*=search]').attr('disabled', 'disabled');	
			}
		},
		post: function(params) {
			Report.enabled(false);
			$.ajax({
				url: baseUrl + 'performance_report',
				type: 'post',
				dataType: 'JSON',
				data: JSON.stringify(params)
			}).done(function(result) {
				Report.generateChart(result);
			}).always(function() {
				Report.enabled(true);
			});
		},
		init: function () {
			form.on('submit', function() {
				var acType = $(this).find('[name="searchType"]').val(),
					params = {param: acType};

				Report.post(params);
				return false;
			});
		}
	}

	Report.init();
})(jQuery);