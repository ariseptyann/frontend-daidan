

function kuiperUi() {
	$('.modal.splash').modal('show');
	$('#content .first-focus').focus();
	$('body').on('click', '.open-nav', function (e) {
		e.preventDefault();
		var var1 = $('.drawer');
		var var2 = $('#side-nav');
		var var3 = $('#nav-overlay');
		var1.removeClass('active');
		var2.addClass('active');
		var3.addClass('active');
	});
	$('body').on('click', '.open-drawer', function (e) {
		e.preventDefault();
		var var1 = $(this).attr('data-target');
		openDrawer('.'+var1);
	});
	$('body').on('click', '.close-current-drawer', function () {
		var var1 = $(this).parents('.drawer');
		var1.removeClass('active');
	});
	$('body').on('click', '.close-sidebar', function () {
		var var2 = $('#side-nav');
		var var3 = $('#nav-overlay');
		var2.removeClass('active');
		var3.removeClass('active');
	});
	$('body').on('click', '.add-spinner', function() {
	    var loc1 = $(this).html();
	    var loc2 = '<div class="spinner-content">'+loc1+'</div>';
	    var loc3 = '<div class="spinner-contain"><div class="spinner-border"></div></div>';
	    $(this).html(loc2+loc3);
	});
	$('body').on('click', '[data-toggle="modal"]', function() {
	    var var1 = $(this).attr('data-target');
	    setTimeout(function() { $(var1).find('.first-focus').focus() }, 1);
	});
	$('body').on('click', '[data-modifier="loading"]', function() {
	    var1 = $(this).attr('data-target');
	    $(var1).addClass('loading');
	    setTimeout(function() {
	        $(var1).removeClass('loading');
	    }, 500); 
	});
	$('body').on('click', '#nav-overlay', function () {
		var var1 = $('#side-nav');
		$(this).removeClass('active');
		var1.removeClass('active');
	});
	$('body').on('click', '.js-open-mobile-menu', function (e) {
		e.preventDefault();
		var var1 = $('#side-nav');
		var var2 = $('#nav-overlay');
		var1.addClass('active');
		var2.addClass('active');
	});
	$('body').on('click', '.js-sgx-tab', function() {

	    var var0 = $(this);
	    var var1 = `<div class="spinner"><div class="spinner-border"></div></div>`;

	    var var2 = $(this).data(`target`);
	    var var3 = $(`.sgx-pane`);
	    var var4 = $(`.sgx-pane.${var2}`);

	    $(`.js-sgx-tab`).removeClass(`loading`);
	    $(`.js-sgx-tab`).find('.spinner').remove();

	    $(this).addClass('loading').prepend(var1);
	});
	$('body').on('change', '.js-sgx-select-toggle', function() {

	    var target = $(this).find(':selected').attr('data-target');
	    var group = $(this).find(':selected').attr('data-group');
	    var umbrella = $(this).parents('form');

	    $(`.${group}`).addClass(`d-none`);
	    $(`.${target}`).removeClass(`d-none`);
	});

	function openDrawer(drawerClass){
		if ($(drawerClass)[0]){
			$(drawerClass).addClass('active');
		}
	}
	function drawerScrollTop(){
		var var0 = window.innerWidth;
		var var1 = $('.sidebar-logo').outerHeight();
		var var3 = ($('.announcement-area').length != 0) ? $('.announcement-area').outerHeight() : 0;
		var var4 = var1 + var3;
		if(var0 < 992){
			$('#side-nav').scrollTop(var4);
		}
		if(var0 > 992){
			$('#side-nav').scrollTop(0);
		}
	}
}
function kuiperTableFilters(){

	$('.js-filter-select-timerange').on('change', function() {
	    var loc1 = this.value;
	    var loc2 = $(this).parents('.form-group').find('.eta-time-range');
	    if (loc1 == 'custom') {
	        loc2.removeClass('d-none');
	        loc2.find('input').attr('required','required');
	    } else {
	        loc2.addClass('d-none');
	        loc2.find('input').removeAttr('required');
	    }
	});

	$('body').on('click', '.js-fitler-select-ship-type', function(e) {
	    e.preventDefault();
	    var var1 = $(`.js-fitler-select-ship-type`);
	    var var2 = $(`.js-fitler-select-ship-type.all-choices`);
	    var var5 = $(`.js-fitler-select-ship-type.active`);

	    if($(this).hasClass('all-choices')){
	        var1.removeClass('active');
	        $(this).addClass('active');
	    } else {
	        var2.removeClass('active');
	        if($(this).hasClass('active')){
	            $(this).removeClass('active');
	            var var3 = $(`.js-fitler-select-ship-type.active`);
	            if(var3.length == 0){
	                var2.addClass('active');
	            }
	        } else {
	            $(this).addClass('active');
	        }
	    }
	});

	$('body').on('click', '.js-multi-filter a', function(e) {
	    e.preventDefault();
	    var var0 = $(this).parents('.js-multi-filter');
	    var var1 = var0.find(`> a`);
	    var var2 = var0.find(`> a.all-choices`);
	    

	    if($(this).hasClass('all-choices')){
	        var1.removeClass('active');
	        $(this).addClass('active');
	    } else {
	        var2.removeClass('active');
	        if($(this).hasClass('active')){
	            $(this).removeClass('active');
	            var var3 = var0.find(`> a.active`);
	            if(var3.length == 0){
	                var2.addClass('active');
	            }
	        } else {
	            $(this).addClass('active');
	        }
	    }
	});

	$('body').on('click', '.js-row-opener', function(e) {
	    e.preventDefault();
	    var var0 = $(this).parents('tr');

	    if(var0.hasClass('active')){
	        var0.removeClass('active');
	    } else {
	        var0.addClass('active');
	    }
	});
}
function systemTrays(){
	$('body').on('click', '.js-tray-head', function (e) {
		var var0 = $(`.tray-alarms`);
		var var1 = $(`.system-tray-overlay`);

		if(var0.hasClass(`active`)){
			var0.removeClass(`active`);
			var1.removeClass(`active`);
		} else {
			var0.addClass(`active`);
			var1.addClass(`active`);
		}
	});
	$('body').on('click', '.system-tray-overlay', function (e) {
		var var0 = $(`.tray-alarms`);

		$(this).removeClass(`active`);
		var0.removeClass(`active`);
	});
}
function kuiperDataTables(){
	$('#datatable-general').DataTable({
	    order: [[ 1, "desc" ]],
	    language: { 
	        search: "",
	        searchPlaceholder: "Search..."
	    },
	    pageLength : 50,
	    pagingType : `simple`,
	    lengthChange : false,
	    dom : `<"wrapper"iftp>`,
	});
}