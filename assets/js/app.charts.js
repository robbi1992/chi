(function($) {
	myCharts = {
		gauge: {
			options: {
				chart: {
        		    type: 'gauge',
        		    plotBackgroundColor: null,
        		    plotBackgroundImage: null,
        		    plotBorderWidth: 0,
        		    plotShadow: false
        		},
        		title: {
        		    text: false
        		},
        		pane: {
            		startAngle: -150,
            		endAngle: 150,
            		background: [{
            		    backgroundColor: {
            		        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            		        stops: [
            		            [0, '#FFF'],
            		            [1, '#333']
            		        ]
            		    },
            		    borderWidth: 0,
            		    outerRadius: '109%'
            		}, 
            		{
                		backgroundColor: {
                	    	linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                	    	stops: [
                	    	    [0, '#333'],
                	    	    [1, '#FFF']
                	    	]
                		},
            		    borderWidth: 1,
            		    outerRadius: '107%'
            		}, 
            		{
                // default background
            		}, 
            		{
           	    	 backgroundColor: '#DDD',
            		    borderWidth: 0,
            		    outerRadius: '105%',
            		    innerRadius: '103%'
            		}]
        		},
        		yAxis: {
            		min: 0,
            		max: 100,

            		minorTickInterval: 'auto',
            		minorTickWidth: 1,
            		minorTickLength: 10,
            		minorTickPosition: 'inside',
            		minorTickColor: '#666',

            		tickPixelInterval: 30,
            		tickWidth: 2,
            		tickPosition: 'inside',
            		tickLength: 10,
            		tickColor: '#666',
            		labels: {
            		    step: 2,
            		    rotation: 'auto'
            		},
            		title: {
            		    text: '%'
            		},
            		plotBands: [{
            		    from: 0,
            		    to: 97.31,
            		    color: '#DF5353' // green
            		}, {
            		    from: 97.31,
            		    to: 100,
            		    color: '#55BF3B' // red
            		}]
       			},
       			credits: {
        		  enabled: false
        		},
        		series: [{
        		    name: 'Performance',
        		    data: [98],
        		    tooltip: {
        		        valueSuffix: ' %'
        		    }
        		}]
			},//end function
			generateChart: function(data){
				myCharts.gauge.options.series[0].data = data.perform;
				$('#chartGauge').removeClass('hidden');
				Highcharts.chart('chartGauge', myCharts.gauge.options);
			},
			sendRequest: function(param) {
				$('img[name="chartGaugeLoading"]').removeClass('hidden');
				$('#chartGauge').addClass('hidden');
				$.ajax({
					url: myBaseUrl + '/gauge',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(param)
				}).done(function(result) {
					$('img[name="chartGaugeLoading"]').addClass('hidden');
					myCharts.gauge.generateChart(result);
				});	
			},
			init: function() {
				//Highcharts.chart('chartGauge', myCharts.gauge.options);
				var param = { valWeek: $('[name="weekCabin"]').val() };
				myCharts.gauge.sendRequest(param);

				$('[name="weekCabin"]').on('change', function() {
					var val = $(this).val();
					//var valName = $(this).find('option:selected').html();
					if(val != '') {
						var param = {
							valWeek: val
						};

						myCharts.gauge.sendRequest(param);
					}
				});
			}
		},//end chart
		hil: {
			param: {
				subtitle: ''
			},
			options: {
				chart: {
			        type: 'bar'
			    },
			    title: {
			        text: false
			    },
			    subtitle: {
			        text: 'Week 1'
			    },
			    xAxis: {
			        title: {
			            text: 'HIL Type'
			        },
			        categories: ['HLWB (AVG)', 'HLNB (AVG)']
			    },
			    yAxis: {
			        min: 0,
			        max: 4,
			        title: {
			            text: 'Ratio (AVG)',
			            align: 'high'
			        },
			        labels: {
			            overflow: 'justify'
			        }
			    },
			    plotOptions: {
			        bar: {
			            dataLabels: {
			                enabled: true
			            }
			        }
			    },
			    legend: {
			        layout: 'horizontal',
			        align: 'right',
			        verticalAlign: 'middle',
			        x: -90,
			        y: 95,
			        floating: true,
			        borderWidth: 1,
			        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			        shadow: true
			    },
			    credits: {
			        enabled: false
			    },
			    series: [{
			        name: 'Ratio (AVG)',
			        data: [2.83, 1.45]
			    },
			    {
			        name: 'Target',
			        color: '#0f2233',
			        data: [3, 1.45]
			    }
			    ]
			},
			generateChart: function(result) {
				myCharts.hil.options.subtitle.text = myCharts.hil.param.subtitle;
				myCharts.hil.options.series[0].data = result.ratios;
				myCharts.hil.options.series[1].data = result.targets;
				$('#chartHil').removeClass('hidden');
				Highcharts.chart('chartHil', myCharts.hil.options);
			},
			sendRequest: function(param) {
				$('#chartHil').addClass('hidden');
				$('img[name="chartHilLoading"]').removeClass('hidden');
				$.ajax({
					url: myBaseUrl + '/hil',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(param)
				}).done(function(result) {
					myCharts.hil.generateChart(result);
					$('img[name="chartHilLoading"]').addClass('hidden');
				});	
			},
			init: function() {
				//Highcharts.chart('chartHil', myCharts.hil.options);
				var param = { valWeek: $('[name="weekHil"]').val() };
				myCharts.hil.param.subtitle = $('[name="weekHil"]').find('option:selected').html();

				myCharts.hil.sendRequest(param);

				$('[name="weekHil"]').on('change', function() {
					var val = $(this).val();
					var valName = $(this).find('option:selected').html();
					myCharts.hil.param.subtitle = valName;
					if(val != '') {
						var param = {
							valWeek: val
						};

						myCharts.hil.sendRequest(param);
					}
				});
			}
		}
	};

	myCharts.gauge.init();
	myCharts.hil.init();
})(jQuery);