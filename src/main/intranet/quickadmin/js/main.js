$(document).ready(function () {

    var activeSub = $(document).find('.active-sub');
    if (activeSub.length > 0) {
        activeSub.parent().show();
        activeSub.parent().parent().find('.arrow').addClass('open');
        activeSub.parent().parent().addClass('open');
    }

    $('.datatable').dataTable({
        retrieve: true,
        "iDisplayLength": 100,
        "aaSorting": [],
        "aoColumnDefs": [
            {'bSortable': false, 'aTargets': [0]}
        ]
    });

    $('.mass').click(function () {
        if ($(this).is(":checked")) {
            $('.single').each(function () {
                if ($(this).is(":checked") == false) {
                    $(this).click();
                }
            });
        } else {
            $('.single').each(function () {
                if ($(this).is(":checked") == true) {
                    $(this).click();
                }
            });
        }
    });

    $('.page-sidebar').on('click', 'li > a', function (e) {

        if ($('body').hasClass('page-sidebar-closed') && $(this).parent('li').parent('.page-sidebar-menu').size() === 1) {
            return;
        }

        var hasSubMenu = $(this).next().hasClass('sub-menu');

        if ($(this).next().hasClass('sub-menu always-open')) {
            return;
        }

        var parent = $(this).parent().parent();
        var the = $(this);
        var menu = $('.page-sidebar-menu');
        var sub = $(this).next();

        var autoScroll = menu.data("auto-scroll");
        var slideSpeed = parseInt(menu.data("slide-speed"));
        var keepExpand = menu.data("keep-expanded");

        if (keepExpand !== true) {
            parent.children('li.open').children('a').children('.arrow').removeClass('open');
            parent.children('li.open').children('.sub-menu:not(.always-open)').slideUp(slideSpeed);
            parent.children('li.open').removeClass('open');
        }

        var slideOffeset = -200;

        if (sub.is(":visible")) {
            $('.arrow', $(this)).removeClass("open");
            $(this).parent().removeClass("open");
            sub.slideUp(slideSpeed, function () {
                if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
                    if ($('body').hasClass('page-sidebar-fixed')) {
                        menu.slimScroll({
                            'scrollTo': (the.position()).top
                        });
                    }
                }
            });
        } else if (hasSubMenu) {
            $('.arrow', $(this)).addClass("open");
            $(this).parent().addClass("open");
            sub.slideDown(slideSpeed, function () {
                if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
                    if ($('body').hasClass('page-sidebar-fixed')) {
                        menu.slimScroll({
                            'scrollTo': (the.position()).top
                        });
                    }
                }
            });
        }
        if (hasSubMenu == true || $(this).attr('href') == '#') {
            e.preventDefault();
        }
    });
    
    if ($("#provincias_id").length > 0 && $("#provincias_id").val() != "Ninguno") {
    	loadLocalidades($("#provincias_id").val());
    }
    
    $("#provincias_id").change(function() {
    	loadLocalidades($(this).val());
    });
    
    $('ul.nav.nav-tabs a').click(function (e) {
	  e.preventDefault();
	  $(".active.in").removeClass("active").removeClass("id");
	  $(this).tab('show');
	})
	
	$('a.linkMapa').on('click', function (e) {
		var href = $(this).attr('href');
		$(this).hide();
		$(href).show();
		$("a.cerrarMapa").show();
		$("a.resetMap").show();
		loadMap();
	});
	
	$('a.cerrarMapa').on('click', function (e) {
		var href = $(this).attr('href');
		$(href).hide();
		$(this).hide();
		$("a.resetMap").hide();
		$('a.linkMapa').show();
	});
	
	$('a.resetMap').on('click', function (e) {
		$("#long").val();
		$("#lat").val();
		loadMap();
	});
    
    // Poner al final ya que da error
    $('.ckeditor').each(function () {
        CKEDITOR.replace($(this));
    })
    
});

function loadLocalidades(idProvincia) {
	if (idProvincia != "") {
		// Assign handlers immediately after making the request,
		// and remember the jqxhr object for this request
		var jqxhr = $.getJSON("/admin/localidades/" + idProvincia + "/search/json", function() {
			//console.log( "success" );
		}).fail(function() {
		    console.log( "error" );
		});
		 
		// Perform other work here ...
		 
		// Set another completion function for the request above
		jqxhr.complete(function() {
			if (jqxhr.responseJSON) {
				var html = '<option value="0">Ninguna</option>';
				var selected = '';
				$.each(jqxhr.responseJSON, function(index, item) {
					if (item.id == $("#localidades").data("selected")) {
						selected = 'selected="selected"';
					}
					html += '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>';
				});
				$("#localidades select").html(html).selectpicker('refresh').selectpicker('show');
				$("#localidades select").change(function() {
					loadZonas($(this).val());
				});
			}
	
			if ($("#localidades").data("selected") != "") {
				loadZonas($("#localidades").data("selected"));
			}
		});
	}
}

function loadZonas(idLocalidad) {
	// Assign handlers immediately after making the request,
	// and remember the jqxhr object for this request
	var jqxhr = $.getJSON("/admin/zonas/" + idLocalidad + "/search/json", function() {
		//console.log( "success" );
	}).fail(function() {
	    console.log( "error" );
	});
	 
	// Perform other work here ...
	 
	// Set another completion function for the request above
	jqxhr.complete(function() {
		if (jqxhr.responseJSON) {
			var html = '<option value="0">Ninguna</option>';
			var selected = '';
			$.each(jqxhr.responseJSON, function(index, item) {
				if (item.id == $("#zonas").data("selected")) {
					selected = 'selected="selected"';
				}
				html += '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>';
			});
			$("#zonas select").html(html).selectpicker('refresh').selectpicker('show');
		}

	});
}