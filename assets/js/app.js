(function($) {

	RegExp.escape = function(str) {
		return String(str).replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
	};

	String.prototype.toIntDef = function(def) {
		var rtn = parseInt(this, 10);
		return isNaN(rtn) ? def : rtn;
	};

	String.prototype.toFloatDef = function(def) {
		var rtn = parseFloat(this, 10);
		return isNaN(rtn) ? def : rtn;
	};

	jQuery.fn.extend({
		toIntDef: function(def) {
			return (this + '').toIntDef(def);
		},
		toFloatDef: function(def) {
			return (this + '').toFloatDef(def);
		}
	});
	
	$.getAESPass = function() {
		return $.ajaxSettings.headers['X-AES-Pass'];
	};
	
	$(document).ajaxComplete(function(event, jqXHR, ajaxOptions) {
		var response = (jqXHR.getResponseHeader("content-type") || '').indexOf('json') < 0 ? false : $.parseJSON(jqXHR.responseText);
		$('#pleaseWaitDialog').addClass('enabled');
		$('#pleaseWaitDialog').modal('hide');
		if (response && response.message) {
			swal('Oops...', response.message, 'error');
		}
		if (response && response.redirect) {
			window.location.replace(response.redirect);
		}
		var pass = jqXHR.getResponseHeader('X-AES-Pass');
		if (pass) {
			$.ajaxSetup({headers: {'X-AES-Pass': pass}});
		}
		if(jqXHR.status == 500) {
			swal('Oops...', 'Any something error, please try again later...', 'error');
		}
	});
	
	$(document).ajaxSend(function() {
		$('#pleaseWaitDialog.enabled').modal();
	});

	$(window).on('hashchange', function() {
		var hash = location.hash.replace(/^#[\/]*/, '');
		if (hash != '') {
			if ($.ajaxSettings.headers && $.ajaxSettings.headers['X-AES-Pass']) {
				delete $.ajaxSettings.headers['X-AES-Pass'];
			}
			$('#container').load('http://localhost/auth/' + hash, function(responseText, textStatus, jqXHR) {
				if ((jqXHR.getResponseHeader("content-type") || '').indexOf('html') < 0) {
					$(this).empty();
				}
				else {
					$('ul.sidebar-menu li[class*="active"]').removeClass('active');
					$('ul.sidebar-menu li[class*="active"]').removeClass('active');
					$('ul.sidebar-menu li ul.treeview-menu').removeClass('menu-open').css('display', 'none');
					$('ul.sidebar-menu a[href="#/' + hash + '"]').closest('li').addClass('active');
					$('ul.sidebar-menu a[href="#/' + hash + '"]').closest('li.treeview').addClass('active');
					$('ul.sidebar-menu a[href="#/' + hash + '"]').closest('li.treeview').find('ul.treeview-menu').addClass('menu-open').css('display', 'block');

					if($('ul.sidebar-menu li.treeview').hasClass('active')) {
						$('ul.sidebar-menu li.treeview').find('span i').removeClass('fa-angle-left');
						$('ul.sidebar-menu li.treeview').find('span i').addClass('fa-angle-down');
					}
					else {
						$('ul.sidebar-menu li.treeview').find('span i').removeClass('fa-angle-down');
						$('ul.sidebar-menu li.treeview').find('span i').addClass('fa-angle-left');
					}
					document.title = $('h1.page-title').html().replace(/<.+/, '').trim() + ' - devbybee';
				}
			});
			//remove backdrop modal
			$('modal.backdrop').fadeOut(function(){
				$(this).remove();
				$(this).removeClass('modal-open');
			});
		}
	});

	$(document).ready(function() {
		$('.nav a:not(.dropdown-toggle)').on('click', function(){
			$('.navbar-toggle:visible').click() //bootstrap 3.x by Richard
		});
		navArrow = $('ul.sidebar-menu li.treeview');
		navArrow.on('click', function() {
			if(navArrow.hasClass('active')) {
				$(this).find('span i').removeClass('fa-angle-down');
				$(this).find('span i').addClass('fa-angle-left');
			}
			else {
				$(this).find('span i').removeClass('fa-angle-left');
				$(this).find('span i').addClass('fa-angle-down');
			}
		});
		$(window).trigger('hashchange');
	});

})(jQuery);