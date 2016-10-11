$(document).ready(function(){
	
	// Preloading Images
	$.preloadImages = function() {
		for(var i = 0; i<arguments.length; i++) {
			$('<img>').attr('src', arguments[i]);
		}
	}
	
	// Crypt Mail
	function UnCryptMailto( s )
	{
		var n = 0;
		var r = '';
		for( var i = 0; i < s.length; i++)
		{
			n = s.charCodeAt( i );
			if( n >= 8364)
				n = 128;
			r += String.fromCharCode( n - 1 );
		}
		return r;
	}
	var key = 'nbjmnfAebsjpepnj/ef';
	var emailHtml = '<a href="'+UnCryptMailto('nbjmup;') + UnCryptMailto(key)+'">' + UnCryptMailto(key) + '</a>';
	$('.email').html(emailHtml);
	$('#social a.feedback').attr('href', UnCryptMailto('nbjmup;') + UnCryptMailto(key));
	
	// Check if Browser has Flash activated
	var useFlash = false;
	try
	{
		var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
		if (fo)
		{
			useFlash = true;
		}
	}
	catch (e)
	{
		if (navigator.mimeTypes
		&& navigator.mimeTypes['application/x-shockwave-flash'] != undefined
		&& navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin) {
			useFlash = true;
		}
	}
	
	// Check if IE
	//if(navigator.appName.indexOf("Internet Explorer") != -1 || navigator.userAgent.toLowerCase().indexOf('msie') != -1)
		//useFlash = false;
	
	// deactivate flash switch if browser don't support flash or is IE
	if(useFlash == false)
		$('#flashUploadSwitch').hide();
	
	// Switch -> Flash Upload
	var uploadHtml5Drag = true;
	var uploadSwitchAllowed = true;
	$('#flashUploadSwitch').click(function(e) {
		if(uploadSwitchAllowed)
		{
			uploadSwitchAllowed = false;
			if(uploadHtml5Drag)
			{
				$('#uploadForm').slideUp(400, function() {
					$('#flashUploadSwitch').find('.flash').hide().next().show();
					$('#flashUpload').slideDown(400, function() {
						uploadHtml5Drag = false;
						uploadSwitchAllowed = true;
					});
				});
			} else {
				$('#flashUpload').slideUp(400, function() {
					$('#flashUploadSwitch').find('.flash').show().next().hide();
					$('#uploadForm').slideDown(400, function() {
						uploadHtml5Drag = true;
						uploadSwitchAllowed = true;
					});
				});
			}
		}
		e.preventDefault();
	});
	
	$('#navi a, a[rel^="#"]').click(function(e) {
		var current = $('#navi').attr('currentValue');
		var rel = $(this).attr('rel');
		$('#navi').attr('currentValue', rel);
		if($(this).css('display') != 'block')
		$(current).slideUp(400, function() {
			$(rel).slideDown(400, function() {
				resizeHtml();
				if(rel == '#imagemap4posis')
					$('#dots').show();
			});
			resizeHtml();
		});
		if(current == '#imagemap4posis')
			$('#dots').hide();
		e.preventDefault();
	});
	
	// Logo
	$('#logo').hover(function() {
		$(this).attr('src', 'asset/plugins/image_generator/logo_active.png');
	}, function() {
		$(this).attr('src', 'asset/plugins/image_generator/logo.png');
	});
	
	resizeUploadContainer();
	
	// set a coordinate point  
	$('#mapContainer').click(function(e) {
        e.stopImmediatePropagation();
        var ItemNo = $("#ItemNo").val();
	    var cek_coord = e.target.id;
	    var alt_val = e.target.alt;
        if(cek_coord == 'ImageAirCraft'){
            if(ItemNo == ''){
                alert('Please Insert Item Number');
                return false;
            } else {
                setCoordinates(e, 1);
            }
        }else{
            var r;
            r = confirm('Are you sure to delete data ' + alt_val);
            if (r == true) {
                $('#mapContainer').find('area#'+ cek_coord).remove();
                var coords = cek_coord.split("_");
                $('#form_cabinItem').find('#coords_'+ coords[1]+'_'+coords[2]).remove();
                hightlight(); 
            }
        }
        e.preventDefault();
         $('html, body').animate({
            scrollTop: $("#mapContainer").offset().top
        }, 700);
	});
	
	// ...
	$('#newUpload span, .textareaButton3').click(function(e) {
		$('#dots').hide();
		$('#navi').attr('currentValue', '#upload');

        // scroll window top
        $('html, body').animate({ scrollTop: 0 }, 200);

        // change view
		$('#imagemap4posis').slideUp(400, function() {
			$('#upload').slideDown(400, function() {
				resizeHtml();
			});
		});
	});
	
	// ...
	$('#urlMessage a').click(function(e) {
		$('#dots').empty();
		$('#imagemap4posis #mapContainer').find('img').attr('src', '#');
		$('#navi').attr('currentValue', '#upload');
		$('#imagemap4posis').slideUp(400, function() {
			$('#upload').slideDown(400, function() {
				resizeHtml();
			});
			removeErrorMessage();
		});
		e.preventDefault();
	});
	
	// ...
	$('#uploadUndo, #uploadUndo2').click(function(e) {
		$('#upload').slideUp(400, function() {
			if($('#imagemap4posis #mapContainer').find('img').attr('src') == '#') {
				$('#upload').slideDown(400);
				$('#navi').attr('currentValue', '#upload');
			} else {
				$('#navi').attr('currentValue', '#imagemap4posis');
				$('#imagemap4posis').slideDown(400, function() {
					resizeHtml();
					$('#dots').show();
				});
			}
		});
	});
	
	// insert image path via url
	$('#linkform').submit(function(e) {
		enterImagelinkForm();
		e.preventDefault();
	});
	$('.imageurl_submit').click(function(e) {
		enterImagelinkForm();
		e.preventDefault();
	});
	
	// ...
	$('#imageurl').focusout(function() {
		var val = $('#imageurl').val().trim();
		if(val !=  '')
			$(this).addClass('active');
		else
			$(this).removeClass('active');
	});
	
	// Imagemap Generator Buttons
	$('.clearButton').click(function() {
		$('#coordsText').val('');
	});

	// ...
	$('.clearCurrentButton').click(function() {
		$('#coordsText').val('');
		$('#mapContainer').find('area:last').remove();
		hightlight();
		
		// update textarea
		
		var textareaVal = $('#areaText').val();
		var tmpArr = textareaVal.split('<area');
		var lastCoords = tmpArr[tmpArr.length - 1].split('/>')[0];
		textarea = textareaVal.replace('<area' + lastCoords+'/>\n    ', '');
		$('#areaText').val(textarea);
	});

	// ...
	$('.clearAllButton').click(function() {
		$('#coordsText').val('');
		$('#areaText').val('');
		$('#mapContainer').find('map').empty();
		$('#dots').empty();
		hightlight();
		textarea = "";
	});
	
	var timeoutIdShow = 0
	var timeoutIdHide = 0
	
	$('#info').mouseover(function() {
		clearTimeout(timeoutIdHide);
		timeoutIdShow = setTimeout(function() {
			$('#infotext').stop(true, true).show(200);
			$('#info').stop(true, true).animate({opacity: 1}, 200);
		}, 200);
	});
	$('#infotext').mouseover(function() {
		clearTimeout(timeoutIdHide);
	});
	$('#infotext').mouseleave(function() {
		clearTimeout(timeoutIdShow);
		timeoutIdHide = setTimeout(function() {
			$('#infotext').stop(true, true).hide(200);
			$('#info').stop(true, true).animate({opacity: 0.5}, 200);
		}, 200);
	});
	
	// show donate popup
	setTimeout(function() {
		$('#feedbackPopup').slideDown(400);
	}, 10000);
    $('#social').hover(function() {
        $('#feedbackPopup').slideDown(400);
    });
	
	// close donate popup
	$('#feedbackPopup a').click('a', function(e) {
		$('#feedbackPopup').slideUp(400);
		e.preventDefault();
	});
	
	// donate close-button fadeIn & fadeOut
	var timeoutIdHideBtn = 0
	$('#feedbackPopup').mouseover(function() {
		clearTimeout(timeoutIdHideBtn);
		$('#feedbackPopup a').show();
	});
	$('#feedbackPopup').mouseout(function() {
		timeoutIdHideBtn = setTimeout(function() {
			$('#feedbackPopup a').hide();
		}, 100);
	});
	$('#feedbackPopup a').mouseover(function() {
		clearTimeout(timeoutIdHideBtn);
	});
	$('#feedbackPopup a').mouseout(function() {
		clearTimeout(timeoutIdHideBtn);
	});
});

$(window).resize(function() {
	resizeUploadContainer();
});

var counter = 0;
var coordsLength = 0;
var textarea = '';
function setCoordinates(e, status) {
	var x = e.pageX;
	var y = e.pageY;
	var z = 10;
    var n = $('.number-content-coordinate').length + 1;
    
	var offset = $('#imagemap4posis img').offset();
	x -= parseInt(offset.left);
	y -= parseInt(offset.top);
	if(x < 0) { x = 0; }
	if(y < 0) { y = 0; }
	
	var value = $('#coordsText').val();
    
	if(value == '') {
		value = x+','+y;
		coordsLength = value.length;
		counter++;
	}
    
	if(status)
		$('#coordsText').val(value);
		$('#coordsVal').val(value);
    
	if($('#area'+counter).length != 0)
		$('#area'+counter).remove();
	var countKomma = value.split(',').length;
    
    var acType = $("#acType").val();
    var CabItms = $("#CabItms").val();
    var ItemNo = $("#ItemNo").val();
    var coordsVal = $("#coordsVal").val();
    var coordsVal = coordsVal + ',' + 5;
    var url = $("#url").val();
    
    if(acType == '' || CabItms == '' || ItemNo ==''){
        alert('Please Complete Data');
        return false;
    }
    
    var html = '<area shape="circle" state="AS" data-statename="" id="ItemNo_'+ItemNo+'_'+counter+'" class="area" coords="'+coordsVal+'" href="#" alt="'+ItemNo+'" title="'+ItemNo+'">';
    $('#map').append(html);
    
    var coordsItem = '<input type="hidden" id="coords_'+ItemNo+'_'+counter+'" name="coordsItem[]" value="'+x+','+y+',5,'+ ItemNo +'">';
    $('#form_cabinItem').append(coordsItem);
     
	$('#mapContainer').append($('.imgmapMainImage'));
	$('#mapContainer').children('div').remove();
	$('.imgmapMainImage').removeClass('maphilighted');
	$('canvas').remove();
    hightlight();
    $('#coordsText').val('');
    $("#ItemNo").val('');

}

function hightlight() {
    $('.imgmapMainImage').maphilight({
		strokeColor: '00FFFF',
		alwaysOn: true,
		fillColor: '00FFFF',
		fillOpacity: 1
	});
}

function hightlight2() {
	$('.imgmapMainImage').maphilight({
		strokeColor: '00FFFF',
		alwaysOn: true,
		fillColor: '00FFFF',
		fillOpacity: 1
	});
}

function resizeUploadContainer() {
	if($('#upload').length) {
		var val = (($(window).height() - $('#logo').outerHeight() - $('#upload').outerHeight()) / 2) * 0.6;
		if(val < 100) { val = 100; }
		$('.infobox').css('margin-top', val+'px');
	}
	resizeHtml();
}
	
function loadImagemapGenerator(width, height) {
	$('#mapContainer img');
	if(width == 0)
		width = $('#mapContainer img').width();
	if(height == 0)
		height = $('#mapContainer img').height();
	$('#newUpload').width(width-8);
	$('#mapContainer').width(width);
	widthTmp = (width < 350) ? 364 : width;
	widthTmp2 = (width < 350) ? 350 : width;
	//$('div.form').width(widthTmp+4);
	$('div.form input').width(widthTmp2-34);
	width = (width < 363) ? 363 : width;
	$('div.form textarea').css({'width': width-20});
	$('#mapContainer').height(height);
	
	resizeHtml();
}

function resizeHtml() {
	var current, height;
	$.each($('.infobox'), function() {
		if($(this).css('display') != 'none')
		current = $(this);
	});
	
	if(typeof(current) == 'undefined') {
		height = $('#imagemap4posis').outerHeight() + $('#header').outerHeight();
	} else {
		height = $(current).outerHeight(true) + $('#header').outerHeight();
	}
	
	if((typeof(current) == 'undefined' && height > $(window).height())
		|| (typeof(current) != 'undefined' && height > $(window).height())) {
		$('html').height(height);
		$('footer').css('top', height - 30 +'px');
	} else if(typeof(current) != 'undefined') {
		$('html').height('100%');
		$('footer').css('top', $(window).height() - 30 +'px');
	}
}
		
function removeOldMapAndValues() {
	if($('.imgmapMainImage').hasClass('maphilighted')) {
		$('#mapContainer').append($('.imgmapMainImage'));
		$('#mapContainer').children('div').remove();
		$('.imgmapMainImage').removeClass('maphilighted').css('opacity', 1);
		$('#dots').empty();
		$('#coordsText').val('');
		$('#areaText').val('');
		$('#map').children('area').remove();
	}
}
function removeErrorMessage() {
	$('#urlMessage').hide();
}
function enterImagelinkForm() {
	removeErrorMessage();
	var url = $('#imageurl').val().trim();
	var error = true;
	
	var urlBegin = url.substr(0, 4);
	if(urlBegin == 'http' || urlBegin == 'www.')
		error = false;
		
	var parts = url.split('.');
	var ext = parts[parts.length-1].toLowerCase();
	if(ext == 'gif' || ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'tif' || ext == 'tiff' || ext == 'bmp')
		error = false;
	
	if(error == false) {
		$('#imagemap4posis #mapContainer').find('img').attr('src', url);
		removeOldMapAndValues();
		jQuery.ajax({
			type: 'POST',
			url: 'upload_ident.php',
			data: {'file': url, 'width': 0, 'height': 0},
			//data: {'data': '[true, "'+url+'", 0, 0]'},
			dataType : 'json'
		});
		$('#navi').attr('currentValue', '#imagemap4posis');
		$('#upload').slideUp(400, function() {
			$('#uploadUndo, #uploadUndo2').show();
			$('#imagemap4posis').slideDown(400, function() {
				resizeHtml();
				
				// not correct loaded yet?
				setTimeout(function() {
					loadImagemapGenerator();
				}, 300);
				
				setTimeout(function() {
					if($('#main').width() <= 20 && $('#main').height() <= 20)
						$('#urlMessage').slideDown(600);
				}, 1000);
				
			});
			loadImagemapGenerator(0, 0);
		});
	} else {
		$('a.imageurl_submit').parent().find('.error').remove();
		$('a.imageurl_submit').after('<p class="error hidden">Incorrect input (Example: www. [...] .jpg / .png / .gif)</p>');
		$('a.imageurl_submit').parent().find('.error').slideDown(400).delay(5000).slideUp(400, function(){ $(this).remove(); });
	}
}