(function($) {
	var Report = {
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
			        text: 'Cabin Area Performances'
			    },
			    xAxis: {
			        title: {
			            text: false
			        },
			        categories: []
			    },
			    yAxis: {
			        min: 92,
			        max: 100,
			        title: {
			            text: 'Performance(%)',
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
			        x: -110,
			        y: 185,
			        floating: true,
			        borderWidth: 1,
			        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			        shadow: true
			    },
			    credits: {
			        enabled: false
			    },
			    series: [{
			        name: 'Performance',
			        color: '#00A65A',
			        data: []
			    },
			    {
			        name: 'Target',
			        color: '#DD4B39',
			        data: []
			    }
			    ]
			},
			init: function() {
				Report.hil.options.xAxis.categories = chartData.categories;
				Report.hil.options.series[0].data = chartData.performances;
				Report.hil.options.series[1].data = chartData.targets;
				Highcharts.chart('bar-chart', Report.hil.options);
			}
		},
		table: {
			init: function() {
				var selectVal = $('[name="selectArea"]').val();
				var rows = $('table[template="rows"]');
				rows.find('tbody[row="'+selectVal+'"]').removeClass('hidden');

				$('[name="selectArea"]').on('change', function() {
					rows.find('tbody').addClass('hidden');
					var selectVal = $(this).val();
					rows.find('tbody[row="'+selectVal+'"]').removeClass('hidden');					
				});
			}
		}
	}

	Report.hil.init();
	Report.table.init();
})(jQuery);