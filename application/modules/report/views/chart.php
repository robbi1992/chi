<section class="content-header">
	<h1>Dashboard</h1>
</section>
<section class="content">
	<!-- form -->
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Chart Parameter</h3>
        </div>
        <div class="box-body">
          <form name="formReport" action="javascript:;" role="form">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="searhType">Aircraft Type</label>
                  <select class="form-control" id="searhType" name="searhType">
                    <option>B777-300</option>
                    <option>B777-800</option>
                    <option>B747-400</option>
                    <option>CRJ100</option>
                    <option>A330-300</option>
                    <option>A330-200</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <label>&nbsp;</label>
                <button type="submit" name="searchBtn" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
              </div>
            </div><!-- end row -->
          </form>
        </div>
      </div>
      <!-- end form -->
      <!-- Bar chart -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>
          <h3 class="box-title">Cabin Performance Index</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div id="bar-chart" style="height: 300px;"></div>
        </div>
      </div>
    </div><!-- end col-md-12 -->
  </div><!-- end row -->
  
  <div class="row">
		<div class="col-md-12">
			<!-- LINE CHART -->
          	<div class="box box-info">
            	<div class="box-header with-border">
              		<h3 class="box-title">Cabin Performance Index</h3>

              		<div class="box-tools pull-right">
                		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              		</div>
            	</div>
            	<div class="box-body">
            	  	<div class="chart">
            	  		<canvas id="lineChart" style="height:250px"></canvas>
            	  	</div>
            	</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
</section>

<!-- select 2 -->
<?php echo jquery_select2(); ?>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.report.js"></script>
<!-- flot chart -->
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/flot/jquery.flot.numberformatter.js"></script>
<script type="text/javascript" src="http://www.jqueryflottutorial.com/jquery.flot.time.js"></script>
<script type="text/javascript" src="http://www.jqueryflottutorial.com/jquery.flot.symbol.js"></script>
<script type="text/javascript" src="http://www.jqueryflottutorial.com/jquery.flot.axislabels.js"></script>
<script type="text/javascript" src="http://www.jqueryflottutorial.com/jquery.flot.shashtable-2.1.js"></script>
<script type="text/javascript" src="http://www.jqueryflottutorial.com/excanvas.js"></script>

<script type="text/javascript">
  /*
   * BAR CHART
   * ---------
   */
  var rawData = [[92.3, 0], [90, 1],[88, 2],[774, 3],[99.9, 4], [85, 5],[100, 6]];
  var dataSet = [{ data: rawData, color: "#E8E800" }];
  var ticks = [[0, "PK-GIG"], [1, "PK-GIJ"], [2, "PK-GIK"], [3, "PK-GIF"], [4, "PK-GIL"], [5, "PK-GIE"], [6, "PK-GIA"]];
  var options = {
            series: {
                bars: {
                    show: true
                }
            },
            bars: {
                align: "center",
                barWidth: 0.5,
                horizontal: true,
                fillColor: { colors: [{ opacity: 0.5 }, { opacity: 1}] },
                lineWidth: 1
            },
            xaxis: {
                axisLabel: "Performance",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                max: 100,
                tickColor: "#5E5E5E",
                color: "black"
            },
            yaxis: {
                axisLabel: "Aircraft",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                tickColor: "#5E5E5E",
                ticks: ticks,
                tickFormatter: function (v, axis) {
                    return $.formatNumber(v, { format: "#,###", locale: "us" });
                },
                color: "black"
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#858585",
                position: "ne"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#171717", "#4F4F4F"] }
            }
        };

    var previousPoint = null, previousLabel = null;
 
        $.fn.UseTooltip = function () {
            $(this).bind("plothover", function (event, pos, item) {
                if (item) {
                    if ((previousLabel != item.series.label) ||
                 (previousPoint != item.dataIndex)) {
                        previousPoint = item.dataIndex;
                        previousLabel = item.series.label;
                        $("#tooltip").remove();
 
                        var x = item.datapoint[0];
                        var y = item.datapoint[1];
 
                        var color = item.series.color;
                        //alert(color)
                        //console.log(item.series.xaxis.ticks[x].label);                
 
                        showTooltip(item.pageX,
                        item.pageY,
                        color,
                        "<strong>" + item.series.label + "</strong><br>" + item.series.yaxis.ticks[y].label +
                        " : <strong>" + $.formatNumber(x, { format: "#,###", locale: "us" }) + "</strong> USD/oz");
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        };
 
        function showTooltip(x, y, color, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 10,
                left: x + 10,
                border: '2px solid ' + color,
                padding: '3px',
                'font-size': '9px',
                'border-radius': '5px',
                'background-color': '#fff',
                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                opacity: 0.9
            }).appendTo("body").fadeIn(200);
        }

    $.plot($("#bar-chart"), dataSet, options);
    $("#bar-chart").UseTooltip();
    /* END BAR CHART */
</script>
<!-- Chart -->
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript">
	$(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    //var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    //var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    //areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);

  });
</script>