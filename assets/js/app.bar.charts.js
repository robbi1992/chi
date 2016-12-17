(function($) {
	var Chart = {
		chartType: {
			options: {
				chart: {
			        type: 'bar'
			    },
			    title: {
			        text: 'Performance Aircraft Type'
			    },
			    subtitle: {
			        text: 'PK-GIA'
			    },
			    xAxis: {
			        title: {
			            text: 'Aircraft Registered'
			        }
			    },
			    yAxis: {
			        min: 80,
			        max: 100,
			        title: {
			            text: 'Performance (%)',
			            align: 'high'
			        },
			        labels: {
			            overflow: 'justify'
			        }
			    },
			    tooltip: {
			        valueSuffix: ' %'
			    },
			    plotOptions: {
			        bar: {
			            dataLabels: {
			                enabled: true
			            }
			        }
			    },
			    credits: {
			        enabled: false
			    },
			    series: [{
			        name: 'performance'
			    }]
			},
			sendRequest: function(param) {
				$.ajax({
					url: myBaseUrl + '/get_type_data',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(param)
				}).done(function(result) {
					Chart.chartType.generate(result);
				});
			},
			generate: function(result) {
				Chart.chartType.options.xAxis.categories = result.categories;
				Chart.chartType.options.series[0].data = result.performances;
				//height = result.categories.length * 40;
				//$('#typeChart').css('min-height', '200px');
				//$('#typeChart').css('height', height + 'px');
				Highcharts.chart('typeChart', Chart.chartType.options);

			},
			myParams: {
				acType: '',
				acTypeName: '',
				acTypeSort: null
			},
			init: function() {
				val = $('select[name="acTypeFirst"]').val();
				sort = $('select[name="acTypeSort"]').val();
				Chart.chartType.options.subtitle.text = $('select[name="acTypeFirst"]').find('option:selected').html();
				param = {acType: val, acTypeName: Chart.chartType.options.subtitle.text, acTypeSort: sort};
				Chart.chartType.myParams.acType = val;
				Chart.chartType.myParams.acTypeSort = sort;
				Chart.chartType.myParams.acTypeName = Chart.chartType.options.subtitle.text; 
				Chart.chartType.sendRequest(param);

				$('select[name="acTypeFirst"]').on('change', function() {
					val = $(this).val();
					valName =  $(this).find('option:selected').html();
					Chart.chartType.myParams.acType = val;
					Chart.chartType.myParams.acTypeName = valName;

					if(val != '') {
						param = {acType: val, acTypeName: valName, acTypeSort: Chart.chartType.myParams.acTypeSort};
						Chart.chartType.options.subtitle.text = valName;
						Chart.chartType.sendRequest(param);
					}
				});

				$('select[name="acTypeSort"]').on('change', function() {
					sort = $(this).val();
					Chart.chartType.myParams.acTypeSort = sort;

					param = {acType: Chart.chartType.myParams.acType, 
						acTypeName: Chart.chartType.myParams.acTypeName, 
						acTypeSort: Chart.chartType.myParams.acTypeSort};
					Chart.chartType.sendRequest(param);
				});
			    //Highcharts.chart('typeChart', Chart.chartType.options);
			}
		}
	};

	Chart.chartType.init();
})(jQuery);