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
        color:"black"
    },
    yaxis: {
        axisLabel: "Aircraft Type",
        axisLabelUseCanvas: true,
        axisLabelFontSizePixels: 12,
        axisLabelFontFamily: 'Verdana, Arial',
        axisLabelPadding: 3,
        tickColor: "#5E5E5E",        
        ticks: '', 
        color:"black"
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