(function($) {
	var Chart = {
		kcms: {
			params: {
				subtitle: ''
			},
			options: {
				chart: {
			        zoomType: 'xy'
			    },
			    title: {
			        text: false
			    },
			    subtitle: {
			        text: 'Week 4'
			    },
			    xAxis: [{
			    	categories: ['Function', 'Interior', 'Exterior'],
        		    crosshair: true
        		}],
        		yAxis: [{ // Primary yAxis
        			min: 80,
        			max: 100,
        		    labels: {
        		        format: '{value} %',
        		        style: {
        		            color: Highcharts.getOptions().colors[1]
        		        }
        		    },
        		    title: {
        		        text: 'Target',
        		        style: {
        		            color: Highcharts.getOptions().colors[1]
        		        }
        		    }
        		},
        		{
        			min: 80,
        			max: 100,
        			title: {
            		    text: 'Performance',
            		    style: {
            		        color: Highcharts.getOptions().colors[0]
            		    }
            		},
            		labels: {
            		    format: '{value} %',
            		    style: {
            		        color: Highcharts.getOptions().colors[0]
            		    }
            		},
            		opposite: true
        		}],
        		tooltip: {
        		    shared: true
        		},
        		legend: {
        		    layout: 'horizontal',
        		    align: 'left',
        		    x: 100,
        		    verticalAlign: 'middle',
        		    y: 110,
        		    floating: true,
        		    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        		},
        		credits: {
			        enabled: false
			    },
        		series: [{
        		    name: 'Performance',
        		    type: 'column',
        		    yAxis: 1,
        		    data: [99, 99.9, 98],
        		    tooltip: {
        		        valueSuffix: '%'
        		    }
        		}, 
        		{
        		    name: 'Target',
        		    type: 'spline',
        		    data: [97, 96, 97],
        		    color: '#DD4B39',
        		    tooltip: {
        		        valueSuffix: '%'
        		    }
        		}]
			},
			generateChart: function(result) {
				Chart.kcms.options.subtitle.text = Chart.kcms.params.subtitle;
				Chart.kcms.options.xAxis.categories = result.categories;
				Chart.kcms.options.series[0].data = result.performances;
				Chart.kcms.options.series[1].data = result.targets;
				Highcharts.chart('kcmsChart', Chart.kcms.options);
			},
			sendRequest: function(param) {
				$.ajax({
					url: myBaseUrl + '/kcms_performance',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(param)
				}).done(function(result) {
					Chart.kcms.generateChart(result);
				});	
			},
			init: function() {
				var param = { valWeek: $('[name="weekKcms"]').val() };
				Chart.kcms.params.subtitle = $('[name="weekKcms"]').find('option:selected').html();

				Chart.kcms.sendRequest(param);

				$('[name="weekKcms"]').on('change', function() {
					var val = $(this).val();
					var valName = $(this).find('option:selected').html();
					Chart.kcms.params.subtitle = valName;
					if(val != '') {
						var param = {
							valWeek: val
						};

						Chart.kcms.sendRequest(param);
					}
				});
			}
		}
	};

	Chart.kcms.init();
})(jQuery);