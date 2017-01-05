(function($) {
	var Chart = {
		performanceType: '',
		acType: '',
		acTypeName: '',
		acReg: '',
		cabin: {
			options: {
				chart: {
			        type: 'bar'
			    },
			    title: {
			        text: 'Performance Aircraft Type'
			    },
			    xAxis: {
			        title: {
			            text: 'Aircraft Registered'
			        }
			    },
			    yAxis: {
			        min: 0,
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
			    legend: {
			        layout: 'horizontal',
			        align: 'right',
			        verticalAlign: 'middle',
			        x: -100,
			        y: 120,
			        floating: true,
			        borderWidth: 1,
			        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			        shadow: true
			    },
			    credits: {
			        enabled: false
			    },
			    series: [{
			        name: 'performance'	
			    },
			    {
			        name: 'target',
			        type: 'spline',
			        color: '#0f2233'	
			    }]
			},
			sendRequest: function(param) {
				$('img[name="chartCcLoading"]').removeClass('hidden');
				$('#cabinChart').addClass('hidden');
				$.ajax({
					url: myBaseUrl + '/cabin_performance_dashboard',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(param)
				}).done(function(result) {
					$('img[name="chartCcLoading"]').addClass('hidden');
					Chart.cabin.generate(result);
				});
			},
			generate: function(result) {
				Chart.cabin.options.xAxis.categories = result.categories;
				Chart.cabin.options.series[0].data = result.performances;
				Chart.cabin.options.series[1].data = result.targets;
				height = result.categories.length * 40;
				$('#cabinChart').css('min-height', '200px');
				$('#cabinChart').css('height', height + 'px');
				$('#cabinChart').removeClass('hidden');
				Highcharts.chart('cabinChart', Chart.cabin.options);

			},
			init: function() {
				Chart.performanceType = $('select[name="performanceType"]').val();
				valName = $('select[name="performanceType"]').find('option:selected').html();
				Chart.cabin.options.title.text = valName;
				param = {type: Chart.performanceType};
				Chart.cabin.sendRequest(param);

				$('select[name="performanceType"]').on('change', function() {
					//reset all select
					$('select[name="acType"]').val('');
					$('select[name="acReg"]').val('');
					val = $(this).val();
					Chart.performanceType = val;
					valName =  $(this).find('option:selected').html();
					if(val != '') {
						param = {type: val};
						Chart.cabin.options.title.text = valName;
						Chart.cabin.sendRequest(param);
					}
				});
			}
		},
		//aircraft type
		type: {
			render: function(data) {
				var table = $('select[name="acReg"]').empty();
				table.append('<option value="">AC Registered</option>');
				$.each(data, function(index, val) {
					option = '<option value=' + val.id + '>'+ val.name_ac_reg +'</option>';
					table.append(option);
				});
			},
			sendRequest: function(params) {
				$.ajax({
					url: myBaseUrl + '/get_ac_reg',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(params)
				}).done(function(result) {
					Chart.type.render(result);
				});
			},
			init: function() {
				$('select[name="acType"]').on('change', function() {
					if(Chart.performanceType == '') {
						alert('Please select the performance type first...');
					}
					else {
						Chart.acType = $(this).val();
						if(Chart.acType != '') {
							Chart.acTypeName = $(this).find('option:selected').html();
							params = {
								type: Chart.performanceType,
								acType: Chart.acType,
								acTypeName: Chart.acTypeName
							};

							Chart.type.sendRequest(params);
						}
					}
				});
			}
		},
		reg: {
			options: {
				credits: {
			        enabled: false
			    },
				title: {
		            text: '',
		            x: -20 //center
		        },
		        subtitle: {
		            text: '',
		            x: -20
		        },
		        xAxis: {
		            categories: []
		        },
		        yAxis: {
		            title: {
		                text: 'Performance (%)'
		            },
		            min: 88,
		            max: 100,
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: '%'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Performance'
		        }, {
		            name: 'Target',
		            color: '#0f2233'
		        }]
			},
			generate: function(result) {
				Chart.reg.options.title.text = Chart.cabin.options.title.text;
				Chart.reg.options.xAxis.categories = result.categories;
				Chart.reg.options.series[0].data = result.performances;
				Chart.reg.options.series[1].data = result.targets;
				height = result.categories.length * 40;
				$('#cabinChart').css('min-height', '200px');
				$('#cabinChart').css('height', height + 'px');
				Highcharts.chart('cabinChart', Chart.reg.options);	
			},
			sendRequest: function(params) {
				$.ajax({
					url: myBaseUrl + '/cabin_per_registered',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(params)
				}).done(function(result) {
					Chart.reg.generate(result);
				});	
			},
			init: function() {
				//ac registered on change event
				$('select[name="acReg"]').on('change', function() {
					Chart.acReg = $(this).val();
					if(Chart.acReg != '') {
						Chart.reg.options.subtitle.text = $(this).find('option:selected').html();
						params = {
							type: Chart.performanceType,
							acReg: Chart.acReg
						};
						Chart.reg.sendRequest(params);						
					}
				});
			}
		},
		trend: {
			options: {
				credits: {
			        enabled: false
			    },
				title: {
		            text: '',
		            x: -20 //center
		        },
		        subtitle: {
		            text: '',
		            x: -20
		        },
		        xAxis: {
		            categories: []
		        },
		        yAxis: {
		            title: {
		                text: 'Performance (%)'
		            },
		            min: 97,
		            max: 100,
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: '%'
		        },
		        legend: {
		            layout: 'horizontal',
			        align: 'right',
			        verticalAlign: 'middle',
			        x: -10,
			        y: 140,
			        floating: true,
			        borderWidth: 1,
			        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			        shadow: true
		        },
		        series: []
			},
			generate: function(result) {
				series = [];
				$.each(result.performances, function(index, value) {
					series.push({
						name: index,
						data: value
					});
				});
				Chart.trend.options.series = series;
				Chart.trend.options.xAxis.categories = result.categories;
				if(result.type == 'hil') {
					Chart.trend.options.yAxis.min = 0;
					Chart.trend.options.yAxis.max = 4;
					Chart.trend.options.yAxis.title.text = 'Ratio';
					Chart.trend.options.tooltip.valueSuffix = '';
				}
				else {
					Chart.trend.options.yAxis.min = 97;
					Chart.trend.options.yAxis.max = 100;
					Chart.trend.options.yAxis.title.text = 'Performance (%)';
					Chart.trend.options.tooltip.valueSuffix = '%';
				}
				$('#chartTrend').removeClass('hidden');
				Highcharts.chart('chartTrend', Chart.trend.options);
			},
			sendRequest: function(params) {
				$('img[name="chartTrendLoading"]').removeClass('hidden');
				$('#chartTrend').addClass('hidden');
				$.ajax({
					url: myBaseUrl + '/trend_kpi_cabin',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(params)
				}).done(function(result) {
					$('img[name="chartTrendLoading"]').addClass('hidden');
					Chart.trend.generate(result);
				});	
			},
			param: {
				timeTrend: null,
				typeTrend: null
			},
			init: function() {
				//ac registered on change event
				Chart.trend.param.timeTrend = $('select[name="timeTrend"]').val();
				Chart.trend.param.typeTrend = $('select[name="typeTrend"]').val();
				Chart.trend.options.subtitle.text = $('select[name="timeTrend"]').find('option:selected').html();
				Chart.trend.options.title.text = $('select[name="typeTrend"]').find('option:selected').html();

				$('select[name="timeTrend"]').on('change', function() {
					timeTrend = $(this).val();
					Chart.trend.param.timeTrend = timeTrend;
					Chart.trend.options.subtitle.text = $(this).find('option:selected').html();

					var params = {
						typeTrend: Chart.trend.param.typeTrend,
						timeTrend: Chart.trend.param.timeTrend
					};

					Chart.trend.sendRequest(params);
				});

				$('select[name="typeTrend"]').on('change', function() {
					typeTrend = $(this).val();
					Chart.trend.param.typeTrend = typeTrend;
					Chart.trend.options.title.text = $(this).find('option:selected').html();

					var params = {
						typeTrend: Chart.trend.param.typeTrend,
						timeTrend: Chart.trend.param.timeTrend
					};

					Chart.trend.sendRequest(params);
				});

				var params = {
					typeTrend: Chart.trend.param.typeTrend,
					timeTrend: Chart.trend.param.timeTrend
				};

				Chart.trend.sendRequest(params);
			}
		},
		func: {
			param: {
				acTypeFunc: null,
				cabinFunc: null,
				galleyArea: null
			},
			generate: function(result) {
				myTable = $('table[name="funcData"]');
				myTable.find('tbody').empty();
				wrapper = myTable.find('tbody');

				if(result.data.length == 0) {
					myTable.find('tbody').append('<tr><td colspan="3" class="text-center">No problems found</td></tr>');
				}
				else {
					myRows = $('[template="rows"]');
					$.each(result.data, function(index, value) {
						row = myRows.clone().removeAttr('template').removeClass('hidden');
						row.find('[view="acReg"]').html(value.acReg);
						row.find('[view="descFunc"]').html(value.desc);
						row.find('[view="caFunc"]').html(value.ca);
						row.appendTo(wrapper);
					});
				}

				myTable.removeClass('hidden');
			},
			sendRequest: function(params) {
				$('img[name="funcDataLoading"]').removeClass('hidden');
				$('table[name="funcData"]').addClass('hidden');
				$.ajax({
					url: myBaseUrl + '/func_area_performance',
					type: 'POST',
					dataType: 'JSON',
					data: JSON.stringify(params)
				}).done(function(result) {
					$('img[name="funcDataLoading"]').addClass('hidden');
					Chart.func.generate(result);
				});	
			},
			init: function() {
				$('select[name="galley"]').addClass('hidden');
				Chart.func.param.cabinFunc = $('select[name="cabinFunc"]').val();
				Chart.func.param.acTypeFunc = $('select[name="acTypeFunc"]').val();

				if(Chart.func.param.cabinFunc != 5) {
					$('select[name="galley"]').addClass('hidden');

					var params = {
						acTypeFunc: Chart.func.param.acTypeFunc,
						cabinFunc: Chart.func.param.cabinFunc
					};

					Chart.func.sendRequest(params);
				}
				else {
					$('select[name="galley"]').removeClass('hidden');
				}

				$('select[name="cabinFunc"]').on('change', function() {
					cabinFunc = $(this).val();
					Chart.func.param.cabinFunc = cabinFunc;

					if(cabinFunc != 5) {
						$('select[name="galley"]').addClass('hidden');

						var params = {
							acTypeFunc: Chart.func.param.acTypeFunc,
							cabinFunc: Chart.func.param.cabinFunc
						};

						Chart.func.sendRequest(params);
					}
					else {
						$('select[name="galley"]').removeClass('hidden');
					}
				});

				$('select[name="acTypeFunc"]').on('change', function() {
					acTypeFunc = $(this).val();
					Chart.func.param.acTypeFunc = acTypeFunc;

					var params = {
						acTypeFunc: Chart.func.param.acTypeFunc,
						cabinFunc: Chart.func.param.cabinFunc
					};

					Chart.func.sendRequest(params);
				});

				$('select[name="galley"]').on('change', function() {
					if($(this).val() != '') {
						var params = {
							acTypeFunc: Chart.func.param.acTypeFunc,
							cabinFunc: Chart.func.param.cabinFunc,
							galleyArea: $(this).val()
						};

						Chart.func.sendRequest(params);
					}
				});

				var params = {
					acTypeFunc: Chart.func.param.acTypeFunc,
					cabinFunc: Chart.func.param.cabinFunc
				};

				Chart.func.sendRequest(params);
			}
		}
	};

	Chart.cabin.init();
	Chart.type.init();
	Chart.reg.init();
	Chart.trend.init();
	Chart.func.init();
})(jQuery);