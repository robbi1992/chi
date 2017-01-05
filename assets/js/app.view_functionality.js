function doUpdate(e, el) {
	if(e.keyCode == 13) {
		var params = {
			regID: regID,
			fisID: $(el).attr('datafisid'),
			fiID: $(el).attr('datafiid'),
			item: $(el).attr('dataitem'),
			date: $(el).attr('datadate'),
			ca: $(el).val()
		};

		$.ajax({
          	url: inputUrl + 'input_ca',
          	type: 'post',
          	dataType: 'JSON',
          	data: JSON.stringify(params)
        }).done(function(result) {
        	if (result == false) {
        		alert('Any problems, please try again later ...');
        	}
        	else {
        		$(el).closest('tr').find('td[view="editCa"]').empty().html(result);
				Report.update.appendInput = true;	
        	}
        });     	
	}
}

//(function($) {
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
			                enabled: true,
			                style: {
            				  fontSize: '11px'
            				}
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
			        color: '#0f2233',
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
		update: {
			appendInput: true,
			init: function() {
				var editCa = $('td[view="editCa"]');
				editCa.on('click', function(){
					if (Report.update.appendInput) {
						Report.update.appendInput = false;
						value = $(this).html();
						fisID = $(this).attr('datafisid');
						fiID = $(this).attr('datafiid');
						item = $(this).attr('dataitem');
						date = $(this).attr('datadate');
						$(this).empty().append('<input datafiid="'+fiID+'" dataitem="'+item+'" datadate="'+date+'" datafisid="'+fisID+'" class="form-control input-sm" onkeypress="doUpdate(event, this)" value="'+value+'" />');
                		$(this).find('input').focus();
					}
				});
			}
		}
	};

	Report.hil.init();
	Report.update.init();
//})(jQuery);