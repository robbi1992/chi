<section class="content-header">
	<h1>Dashboard</h1>
</section>
<section class="content">
	<!-- Gauge chart-->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Cabin performance Index</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Week 1</option>
          			  	<option>Week 2</option>
          			  	<option>Week 3</option>
          			  	<option>Week 4</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="gauge-chart" style="height: 300px;"></div><!--end gauge chart -->
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end gauge -->
    <!-- trend chart-->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Trend KPI Cabin</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Function & Appearance</option>
          			  	<option>HIL</option>
          			  </select>
          			  <select>
          			  	<option>Monthly</option>
          			  	<option>Quarterly</option>
          			  	<option>Yearly</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="trend-chart" style="height: 400px;"></div><!--end gauge chart -->
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end trend -->
    <!-- trend chart-->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Performance type All area</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Cabin function</option>
          			  	<option>Interior Appearance</option>
          			  	<option>Exterior Appearance</option>
          			  </select>
          			  <select>
          			  	<option>B777-300</option>
          			  	<option>B747-400</option>
          			  	<option>B737-800</option>
          			  	<option>ATR72-600</option>
          			  	<option>CRJ1000</option>
          			  	<option>A330-300</option>
          			  	<option>A330-200</option>
          			  	<option>A320</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="b737-chart" style="height: 400px;"></div><!--end gauge chart -->
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end trend -->
    <!-- exterior chart -->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Exterior Chart</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Exterior Appearance</option>
          			  	<option>Cabin function</option>
          			  	<option>Interior Appearance</option>
          			  </select>
          			  <select>
          			  	<option>PK-GIA</option>
          			  	<option>PK-GIC</option>
          			  	<option>PK-GID</option>
          			  	<option>PK-GIE</option>
          			  	<option>PK-GIF</option>
          			  	<option>PK-GIG</option>
          			  	<option>PK-GIH</option>
          			  	<option>PK-GII</option>
          			  	<option>PK-GIJ</option>
          			  	<option>PK-GIK</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="ext-chart" style="height: 400px;"></div><!--end gauge chart -->
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end trend -->
    <!-- cabinarea chart-->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Performance Cabin Area</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Cabin Function</option>
          			  	<option>Interior appearance</option>
          			  	<option>Exterior appearance</option>
          			  </select>
          			  <select>
          			  	<option>Seat first class</option>
          			  	<option>Seat Business class</option>
          			  	<option>Seat Economy class</option>
          			  	<option>Galley</option>
          			  	<option>Lavatory</option>
          			  	<option>Luggage Bin</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="cabinArea-chart" style="height: 300px;"></div><!--end gauge chart -->
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end cabinarea -->
	<div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">HIL Ratio</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Week 1</option>
          			  	<option>Week 2</option>
          			  	<option>Week 3</option>
          			  	<option>Week 4</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="hil-chart"></div>
        		</div>
        	</div>
    	</div>
    </div>
    <!-- cabin function -->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Aircraft type performance</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Cabin function</option>
          			  	<option>Interior appearance</option>
          			  	<option>Exterior appearance</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="cabin-chart"></div>
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end cabin function -->
    <!-- kpi cabin maintenance services -->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">KPI Cabin Maintenance Services</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>Week 1</option>
          			  	<option>Week 2</option>
          			  	<option>Week 3</option>
          			  	<option>Week 4</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        		<div id="kpi-chart" style="height: 400px;">
        			<table id="datatable">
					    <thead>
					        <tr>
					            <th></th>
					            <th>Current</th>
					            <th>Target</th>
					        </tr>
					    </thead>
					    <tbody>
					        <tr>
					            <th>Cabin function</th>
					            <td>99.1</td>
					            <td>98</td>
					        </tr>
					        <tr>
					            <th>Interior appearance</th>
					            <td>98.48</td>
					            <td>96</td>
					        </tr>
					        <tr>
					            <th>Cabin function</th>
					            <td>98.40</td>
					            <td>94</td>
					        </tr>
					    </tbody>
					</table>
					</div><!--end kpi chart -->
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end kpi cabin function -->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Aircraft registered performance</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>B777-300</option>
          			  	<option>B747-400</option>
          			  	<option>B737-800</option>
          			  	<option>ATR72-600</option>
          			  	<option>CRJ1000</option>
          			  	<option>A330-300</option>
          			  	<option>A330-200</option>
          			  	<option>A320</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<div id="reg-chart"></div>
        		</div>
        	</div>
    	</div>
    </div>
    <!-- table -->
    <div class="row">
    	<div class="col-md-12">
    		<div class="box box-primary">
        		<div class="box-header with-border">
        		  <h3 class="box-title">Cabin area performances</h3>
        		  	<div class="box-tools pull-right">
          			  <select>
          			  	<option>B737-800</option>
          			  	<option>B777-300</option>
          			  	<option>B747-400</option>
          			  	<option>ATR72-600</option>
          			  	<option>CRJ1000</option>
          			  	<option>A330-300</option>
          			  	<option>A330-200</option>
          			  	<option>A320</option>
          			  </select>
          			  <select>
          			  	<option>Seat first class</option>
          			  	<option>Seat business class</option>
          			  	<option>Seat economy class</option>
          			  	<option>IFE System</option>
          			  	<option>Galley</option>
          			  	<option>Lavatory</option>
          			  	<option>Luggage Bin</option>
          			  </select>
          			</div>
        		</div>
        		<div class="box-body">
        			<table class="table-bordered table-condensed table-hover table-responsive">
        				<thead>
        					<tr>
        						<th class="text-center">Oven</th>
        						<th class="text-center">Performance</th>
        						<th class="text-center">Status</th>
        						<th class="text-center">Desc</th>
        					</tr>
        				</thead>
        				<tbody>
        					<tr>
        						<td>PK-GMA</td>
        						<td class="text-center">85%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Fwd Galley No. 1</td>
        					</tr>
        					<tr>
        						<td>PK-GMC</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GMD</td>
        						<td class="text-center">90%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Aft Galley No. 2</td>
        					</tr>
        					<tr>
        						<td>PK-GME</td>
        						<td class="text-center">92%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Aft Galley No. 2</td>
        					</tr>
        					<tr>
        						<td>PK-GMF</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GMG</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GMH</td>
        						<td class="text-center">90%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Fwd Galley No. 1</td>
        					</tr>
        					<tr>
        						<td>PK-GMI</td>
        						<td class="text-center">85%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Aft Galley No. 1</td>
        					</tr>
        					<tr>
        						<td>PK-GMJ</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GMK</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GML</td>
        						<td class="text-center">92%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Aft Galley No. 2</td>
        					</tr>
        					<tr>
        						<td>PK-GMM</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GMN</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        					<tr>
        						<td>PK-GMO</td>
        						<td class="text-center">90%</td>
        						<td class="text-center text-red"><i class="fa fa-dot-circle-o"></i></td>
        						<td>Oven Fwd Galley No. 2</td>
        					</tr>
        					<tr>
        						<td>PK-GMP</td>
        						<td class="text-center">100%</td>
        						<td class="text-center text-green"><i class="fa fa-dot-circle-o"></i></td>
        						<td></td>
        					</tr>
        				</tbody>
        			</table>
        		</div>
        	</div>
    	</div>
    </div>
    <!-- end table -->
</section>

<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.axislabels.js"></script>
<!-- single page -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/fn.flot.tooltip.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.flot.config.js"></script>
<script type="text/javascript">
	rawData = [[1.45, 0], [2.83, 1]];
	ticks = [[0, 'HLNB (AVG)'], [1, 'HLWB (AVG)']];
	var hil = $('#hil-chart');
	hil.css('height', 150);

	var dataSet = [
		{ data: rawData, color: "#429867" }
	];

	options.yaxis.ticks = ticks;
	options.xaxis.max = 3;
	options.xaxis.axisLabel = 'Ratio';
	options.yaxis.axisLabel = 'HIL Ratio';

  	$.plot(hil, dataSet, options); 
  	hil.UseTooltip();
</script>
<script type="text/javascript">
	//cabin chart
	rawData = [[99.30, 0], [99.40, 1], [99.50, 2], [99.60, 3], [99.70, 4], [99.80, 5], [99.90, 6], [100, 7]];
	ticks = [[0, 'CRJ 1000'], [1, 'A320'], [2, 'B737-800'], [3, 'B777-300'], [4, 'A330-300'], [5, 'A330-200'], [6, 'ATR72-600'], [7, 'B747-400']];
	var hil = $('#cabin-chart');
	hil.css('height', 300);

	var dataSet = [
		{ data: rawData, color: "#E8E800" }
	];

	options.yaxis.ticks = ticks;
	options.xaxis.min = 90;
	options.xaxis.max = 100;
	options.yaxis.axisLabel = 'Aircraft Type';
	options.xaxis.axisLabel = 'Performance';

  	$.plot(hil, dataSet, options); 
  	hil.UseTooltip();
</script>
<script type="text/javascript">
	//cabin chart
	rawData = [[92.60, 0], [98.91, 1], [93, 2], [99.42, 3], [98.94, 4], [98.65, 5], [96.92, 6], [98.33, 7], [96.67, 8], [99.82, 9]];
	ticks = [[0, 'PK-GIA'], [1, 'PK-GIC'], [2, 'PK-GID'], [3, 'PK-GIE'], [4, 'PK-GIF'], [5, 'PK-GIG'], [6, 'PK-GIH'], [7, 'PK-GII'], [8, 'PK-GIJ'], [9, 'PK-GIK']];
	var hil = $('#reg-chart');
	hil.css('height', 350);

	var dataSet = [
		{ data: rawData, color: "#489fdf" }
	];

	options.yaxis.ticks = ticks;
	options.xaxis.min = 80;
	options.xaxis.max = 100;
	options.yaxis.axisLabel = 'Aircraft Registered';
	options.xaxis.axisLabel = 'Performance';

  	$.plot(hil, dataSet, options); 
  	hil.UseTooltip();
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
	$(function () {

	    Highcharts.chart('kpi-chart', {
	        data: {
	            table: 'datatable'
	        },
	        chart: {
	            type: 'column'
	        },
	        yAxis: {
	            allowDecimals: true,
	            max: 100,
	            title: {
	                text: 'Performance'
	            }
	        },
	        tooltip: {
	            formatter: function () {
	                return '<b>' + this.series.name + '</b><br/>' +
	                    this.point.y + ' ' + this.point.name.toLowerCase();
	            }
	        }
	    });
	});
</script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script type="text/javascript">
	$(function () {

	    Highcharts.chart('gauge-chart', {

	        chart: {
	            type: 'gauge',
	            plotBackgroundColor: null,
	            plotBackgroundImage: null,
	            plotBorderWidth: 0,
	            plotShadow: false
	        },

	        title: {
	            text: 'Performance'
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
	            }, {
	                backgroundColor: {
	                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                    stops: [
	                        [0, '#333'],
	                        [1, '#FFF']
	                    ]
	                },
	                borderWidth: 1,
	                outerRadius: '107%'
	            }, {
	                // default background
	            }, {
	                backgroundColor: '#DDD',
	                borderWidth: 0,
	                outerRadius: '105%',
	                innerRadius: '103%'
	            }]
	        },

	        // the value axis
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
	                from: 90,
	                to: 100,
	                color: '#55BF3B' // green
	            }, {
	                from: 0,
	                to: 90,
	                color: '#DF5353' // red
	            }]
	        },

	        series: [{
	            name: 'Speed',
	            data: [80],
	            tooltip: {
	                valueSuffix: ' %'
	            }
	        }]

	    },
	    // Add some life
	    function (chart) {
	        if (!chart.renderer.forExport) {
	            setInterval(function () {
	                var point = chart.series[0].points[0],
	                    newVal,
	                    inc = Math.round((Math.random() - 0.5) * 20);

	                newVal = point.y + inc;
	                if (newVal < 0 || newVal > 200) {
	                    newVal = point.y - inc;
	                }

	                point.update(newVal);

	            }, 3000);
	        }
	    });
	});
</script>
<!-- trend kpi cabin -->
<script type="text/javascript">
	$(function () {
	    Highcharts.chart('trend-chart', {
	        title: {
	            text: 'KPI Cabin Performance',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'Monthly',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4']
	        },
	        yAxis: {
	            title: {
	                text: 'Performance (%)'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }],
	            max: 100
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
	            name: 'Cabin function',
	            data: [100, 100, 100, 100]
	        }, {
	            name: 'Interior appearance',
	            data: [99, 98, 100, 96]
	        }, {
	            name: 'Exterior appearance',
	            data: [98.5, 99.90, 97, 100]
	        }]
	    });
	});
</script>

<!-- cabin Area -->
<script type="text/javascript">
	$(function () {
	    Highcharts.chart('cabinArea-chart', {
	        title: {
	            text: 'Cabin Function',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'Seat first class',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6']
	        },
	        yAxis: {
	            title: {
	                text: 'Performance (%)'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }],
	            max: 100
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
	            name: 'Seat first class',
	            data: [100, 99.50, 99.70, 100, 99.50, 100]
	        }
	        ]
	    });
	});
</script>

<!-- 08 nov 2016 -->
<script type="text/javascript">
	$(function () {
	    Highcharts.chart('b737-chart', {
	        title: {
	            text: 'Performance All Areas',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'B737-800',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Seat Business Class', 'Seat Business Class', 'Cabin Compartment', 'Galley Area', 'Lavartory Compartment', 'Attendant Seat', 'Carpet']
	        },
	        yAxis: {
	            title: {
	                text: 'Performance (%)'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }],
	            max: 100
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
	            name: 'Achievement',
	            data: [93.3, 89.98, 97.55, 99.44, 97.93, 96.92, 99]
	        }, {
	            name: 'Target',
	            data: [97, 96, 96, 96, 95, 95, 94.92]
	        }]
	    });
	});
</script>

<script type="text/javascript">
	$(function () {
	    Highcharts.chart('ext-chart', {
	        title: {
	            text: 'Exterior Areas',
	            x: -20 //center
	        },
	        subtitle: {
	            text: 'B737-800 PK-GIA',
	            x: -20
	        },
	        xAxis: {
	            categories: ['Radome', 'Upper fuselage', 'Lower fuselage', 'Wing', 'Tail']
	        },
	        yAxis: {
	            title: {
	                text: 'Performance (%)'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }],
	            max: 100
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
	            name: 'Achievement',
	            data: [98.33, 96.67, 96.67, 96.67, 96.67]
	        }, {
	            name: 'Target',
	            data: [92.60, 93, 93, 92.60, 92.60]
	        }]
	    });
	});
</script>