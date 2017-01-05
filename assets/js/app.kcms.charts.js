(function($) {
    var Chart = {
        kcms: {
            params: {
                subtitle: ''
            },
            options: {
                chart: {
                    type: 'column'
                },
                title: {
                    text: false
                },
                subtitle: {
                    text: 'Week 4'
                },
                xAxis: {
                    categories: ['Function', 'Interior', 'Exterior']
                },
                yAxis: [{
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
                }, {
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
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Performance',
                    data: [99, 99.9, 98],
                    pointPadding: 0.3,
                    pointPlacement: -0.2
                }, {
                    name: 'Target',
                    color: '#0f2233',
                    data: [97, 96, 97],
                    pointPadding: 0.4,
                    pointPlacement: -0.2
                }]
            }, // end options
            generateChart: function(result) {
                Chart.kcms.options.subtitle.text = Chart.kcms.params.subtitle;
                Chart.kcms.options.xAxis.categories = result.categories;
                Chart.kcms.options.series[0].data = result.performances;
                Chart.kcms.options.series[1].data = result.targets;
                $('#kcmsChart').removeClass('hidden');
                Highcharts.chart('kcmsChart', Chart.kcms.options);
            },
            sendRequest: function(param) {
                $('img[name="chartKcmsLoading"]').removeClass('hidden');
                $('#kcmsChart').addClass('hidden');
                $.ajax({
                    url: myBaseUrl + '/kcms_performance',
                    type: 'POST',
                    dataType: 'JSON',
                    data: JSON.stringify(param)
                }).done(function(result) {
                    $('img[name="chartKcmsLoading"]').addClass('hidden');
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