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
                item.series.yaxis.ticks[y].label +
                " : <strong>" + x + "</strong>");
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