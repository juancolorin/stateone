if ($("#fileuploadImagenesInmueble").length > 0) {
	fileUploadImagenesInmueble();
}

if ($("#fileuploadFicherosInmueble").length > 0) {
	fileUploadFicherosInmueble();
}

$(document).ready(function () {

    if ($("#listadoImagenesInmueble").length > 0) {
    	loadImagenesInmueble($("#listadoImagenesInmueble").data("inmueble-id"), $("#listadoImagenesInmueble").data("token"));
    }
    
    if ($("#listadoFicherosInmueble").length > 0) {
    	loadFicherosInmueble($("#listadoFicherosInmueble").data("inmueble-id"), $("#listadoFicherosInmueble").data("token"));
    }
    
});

function loadImagenesInmueble(idInmueble, token) {
	if (idInmueble != "") {
		// Assign handlers immediately after making the request,
		// and remember the jqxhr object for this request
		var jqxhr = $.getJSON("/admin/inmueble-imagenes/" + idInmueble + "/search/json", function() {
			//console.log( "success" );
		}).fail(function() {
		    console.log( "error" );
		});
		 
		// Perform other work here ...
		 
		// Set another completion function for the request above
		jqxhr.complete(function() {
			if (jqxhr.responseJSON) {
				var html = '';
				$.each(jqxhr.responseJSON, function(index, item) {
					//html += '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>';
					html += '<tr class="template-upload" data-id="' + item.id + '">';
						html += '<td>';
							html += '<span class="preview"><a target="_blank" href="' + item.image_path + item.image_name + '" title="' + item.title + '"><img src="' + item.image_path + item.image_name + '" width="150px" title="' + item.title + '" name="' + item.title + '"></a></span>';
						html += '</td>';
						html += '<td>';
							html += '<p class="name"><input type="text" class="form-control name" value="' + item.title + '" /></p>';
						html += '</td>';
						html += '<td>';
							if (item.is_featured) {
								html += '<input type="checkbox" class="form-control principal" checked="checked" />';
							} else {
								html += '<input type="checkbox" class="form-control principal" />';
							}
						html += '</td>';
						html += '<td>';
							if (item.is_active) {
								html += '<input type="checkbox" class="form-control publicada" checked="checked" />';
							} else {
								html += '<input type="checkbox" class="form-control publicada" />';
							}
						html += '</td>';
						html += '<td>';
							html += '<button class="btn btn-primary guardar">';
								html += '<i class="fa fa-save"></i> <span>Guardar</span>';
							html += '</button>';
							html += '<button class="btn btn-danger eliminar">';
								html += '<i class="fa fa-trash"></i> <span>Eliminar</span>';
							html += '</button>';
						html += '</td>';
					html += '</tr>';
				});
				$("#listadoImagenesInmueble tbody.files").html(html);
				$("#listadoImagenesInmueble tbody.files").find(".guardar").click(function() {
					var id = $(this).closest("tr").data("id");
					var name = $(this).closest("tr").find("input.name").val();
					var principal = 0;
					if ($(this).closest("tr").find(".principal").is(':checked')) {
						principal = 1;
					}
					var publicada = 0;
					if ($(this).closest("tr").find(".publicada").is(':checked')) {
						publicada = 1;
					}
					guardarImagenInmueble(id, name, principal, publicada, idInmueble, token);
					return false;
				});
				$("#listadoImagenesInmueble tbody.files").find(".eliminar").click(function() {
					eliminarImagenInmueble($(this).closest("tr").data("id"), idInmueble, token);
					return false;
				});
			}
		});
	}
}

function guardarImagenInmueble(id, name, principal, publicada, idInmueble, token) {
     var formData = {
		 id: id,
		 is_featured: principal,
		 is_active: publicada,
		 title: name,
		 mobile_image_name: name,
		 inmueble_id: idInmueble,
		 _token: token
     }

     var url = '/admin/inmueble-imagenes/' + id + '/update';

     $.ajax({
    	 type: 'PUT',
         url: url,
         data: formData,
         dataType: 'json',
         success: function (data) {
             console.log(data);
             loadImagenesInmueble(idInmueble, token);
         },
         error: function (data) {
             console.log('Error:', data);
         }
     });
}

function eliminarImagenInmueble(id, idInmueble, token) {
	if (confirm('¿Está seguro que desea eliminar esta imágen?')) {
		$.ajax({
			url: "/admin/inmueble-imagenes/" + id + "/destroy",
		    type: 'post',
		    data: {_token :token},
		    success:function(msg){ 
	        	console.log(msg);
	        	loadImagenesInmueble(idInmueble, token);
	        }
		});
	}
}

function fileUploadImagenesInmueble() {
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var urlImagenes = '/admin/inmueble-imagenes/' + $('#fileuploadImagenesInmueble').data("inmueble-id") + '/new';
	    var uploadButtonImagenes = $('<button/>')
	            .addClass('btn btn-primary')
	            .prop('disabled', true)
	            .text('Procesando...')
	            .on('click', function () {
	                var $this = $(this),
	                    data = $this.data();
	                $this
	                    .off('click')
	                    .text('Abort')
	                    .on('click', function () {
	                        $this.remove();
	                        data.abort();
	                    });
	                data.submit().always(function () {
	                    $this.remove();
	                });
	            });
	    $( "#fileuploadImagenesInmueble" ).submit(function( event ) {
	    	return false;
	    });
	    $('#fileuploadImagenesInmueble').fileupload({
	        url: urlImagenes,
	        dataType: 'json',
	        autoUpload: false,
	        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	        maxFileSize: 999000,
	        // Enable image resizing, except for Android and Opera,
	        // which actually support image resizing, but fail to
	        // send Blob objects via XHR requests:
	        disableImageResize: /Android(?!.*Chrome)|Opera/
	            .test(window.navigator.userAgent),
	        previewMaxWidth: 100,
	        previewMaxHeight: 100,
	        previewCrop: true
	    }).on('fileuploadadd', function (e, data) {
	    	console.log(1);
	        data.context = $('<div class="col-md-2 overlow" />').appendTo('#imagenes-inmueble-upload');
	        $.each(data.files, function (index, file) {
	            var node = $('<p/>')
	                    .append($('<span/>').text(file.name));
	            if (!index) {
	                node
	                    .append('<br>')
	                    .append(uploadButtonImagenes.clone(true).data(data));
	            }
	            node.appendTo(data.context);
	        });
	    }).on('fileuploadprocessalways', function (e, data) {
	    	console.log(2);
	        var index = data.index,
	            file = data.files[index],
	            node = $(data.context.children()[index]);
	        if (file.preview) {
	            node
	                .prepend('<br>')
	                .prepend(file.preview);
	        }
	        if (file.error) {
	            node
	                .append('<br>')
	                .append($('<span class="text-danger"/>').text(file.error));
	        }
	        if (data && data.files && index + 1 === data.files.length) {
	            data.context.find('button')
	                .text('Subir')
	                .prop('disabled', !!data.files.error);
	        }
	    }).on('fileuploadprogressall', function (e, data) {
	    	console.log(3);
	        var progress = parseInt(data.loaded / data.total * 100, 10);
	        $('#progress .progress-bar').css(
	            'width',
	            progress + '%'
	        );
	    }).on('fileuploaddone', function (e, data) {
	    	
	    	if (data && data.result && data.result.files && data.result.files.length > 0) {
	    		$.each(data.result.files, function (index, file) {
	                if (file.url) {
	                    var link = $('<a>')
	                        .attr('target', '_blank')
	                        .prop('href', file.url);
	                    $(data.context.children()[index])
	                        .wrap(link);
	                } else if (file.error) {
	                    var error = $('<span class="text-danger"/>').text(file.error);
	                    $(data.context.children()[index])
	                        .append('<br>')
	                        .append(error);
	                }
	            });
	    	}
	    	
	    	loadImagenesInmueble($('#fileuploadImagenesInmueble').data("inmueble-id"), $('#fileuploadImagenesInmueble').data("token"));
	    	
	    }).on('fileuploadfail', function (e, data) {
	    	console.log(6);
	        $.each(data.files, function (index) {
	            var error = $('<span class="text-danger"/>').text('Ha ocurrido un error.');
	            $(data.context.children()[index])
	                .append('<br>')
	                .append(error);
	        });
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
}

/// **** FICHEROS ***** /////
function loadFicherosInmueble(idInmueble, token) {
	if (idInmueble != "") {
		// Assign handlers immediately after making the request,
		// and remember the jqxhr object for this request
		var jqxhr = $.getJSON("/admin/inmueble-ficheros/" + idInmueble + "/search/json", function() {
			//console.log( "success" );
		}).fail(function() {
		    console.log( "error" );
		});
		 
		// Perform other work here ...
		 
		// Set another completion function for the request above
		jqxhr.complete(function() {
			if (jqxhr.responseJSON) {
				var html = '';
				$.each(jqxhr.responseJSON, function(index, item) {
					//html += '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>';
					html += '<tr class="template-upload" data-id="' + item.id + '">';
						html += '<td>';
							html += '<span class="preview"><a target="_blank" href="' + item.image_path + item.image_name + '" title="' + item.title + '" class="btn btn-info"><i class="fa fa-download"></i> Descargar</a></span>';
						html += '</td>';
						html += '<td>';
							html += '<p class="name"><input type="text" class="form-control name" value="' + item.title + '" /></p>';
						html += '</td>';
						html += '<td>';
							if (item.is_featured) {
								html += '<input type="checkbox" class="form-control principal" checked="checked" />';
							} else {
								html += '<input type="checkbox" class="form-control principal" />';
							}
						html += '</td>';
						html += '<td>';
							if (item.is_active) {
								html += '<input type="checkbox" class="form-control publicada" checked="checked" />';
							} else {
								html += '<input type="checkbox" class="form-control publicada" />';
							}
						html += '</td>';
						html += '<td>';
							html += '<button class="btn btn-primary guardar">';
								html += '<i class="fa fa-save"></i> <span>Guardar</span>';
							html += '</button>';
							html += '<button class="btn btn-danger eliminar">';
								html += '<i class="fa fa-trash"></i> <span>Eliminar</span>';
							html += '</button>';
						html += '</td>';
					html += '</tr>';
				});
				$("#listadoFicherosInmueble tbody.files").html(html);
				$("#listadoFicherosInmueble tbody.files").find(".guardar").click(function() {
					var id = $(this).closest("tr").data("id");
					var name = $(this).closest("tr").find("input.name").val();
					var principal = 0;
					if ($(this).closest("tr").find(".principal").is(':checked')) {
						principal = 1;
					}
					var publicada = 0;
					if ($(this).closest("tr").find(".publicada").is(':checked')) {
						publicada = 1;
					}
					guardarFicheroInmueble(id, name, principal, publicada, idInmueble, token);
					return false;
				});
				$("#listadoFicherosInmueble tbody.files").find(".eliminar").click(function() {
					eliminarFicheroInmueble($(this).closest("tr").data("id"), idInmueble, token);
					return false;
				});
			}
		});
	}
}

function guardarFicheroInmueble(id, name, principal, publicada, idInmueble, token) {
     var formData = {
		 id: id,
		 is_featured: principal,
		 is_active: publicada,
		 title: name,
		 mobile_image_name: name,
		 inmueble_id: idInmueble,
		 _token: token
     }

     var url = '/admin/inmueble-ficheros/' + id + '/update';

     $.ajax({
    	 type: 'PUT',
         url: url,
         data: formData,
         dataType: 'json',
         success: function (data) {
             console.log(data);
             loadFicherosInmueble(idInmueble, token);
         },
         error: function (data) {
             console.log('Error:', data);
         }
     });
}

function eliminarFicheroInmueble(id, idInmueble, token) {
	if (confirm('¿Está seguro que desea eliminar esta imágen?')) {
		$.ajax({
			url: "/admin/inmueble-ficheros/" + id + "/destroy",
		    type: 'post',
		    data: {_token :token},
		    success:function(msg){ 
	        	console.log(msg);
	        	loadFicherosInmueble(idInmueble, token);
	        }
		});
	}
}

function fileUploadFicherosInmueble() {
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var urlFicheros = '/admin/inmueble-ficheros/' + $('#fileuploadFicherosInmueble').data("inmueble-id") + '/new';
	    var uploadButtonFicheros = $('<button/>')
	            .addClass('btn btn-primary')
	            .prop('disabled', true)
	            .text('Procesando...')
	            .on('click', function () {
	                var $this = $(this),
	                    data = $this.data();
	                $this
	                    .off('click')
	                    .text('Abort')
	                    .on('click', function () {
	                        $this.remove();
	                        data.abort();
	                    });
	                data.submit().always(function () {
	                    $this.remove();
	                });
	            });
	    $( "#fileuploadFicherosInmueble" ).submit(function( event ) {
	    	return false;
	    });
	    $('#fileuploadFicherosInmueble').fileupload({
	        url: urlFicheros,
	        dataType: 'json',
	        autoUpload: false,
	        maxFileSize: 999000,
	        // Enable image resizing, except for Android and Opera,
	        // which actually support image resizing, but fail to
	        // send Blob objects via XHR requests:
	        disableImageResize: /Android(?!.*Chrome)|Opera/
	            .test(window.navigator.userAgent),
	        previewMaxWidth: 100,
	        previewMaxHeight: 100,
	        previewCrop: true
	    }).on('fileuploadadd', function (e, data) {
	    	console.log(1);
	        data.context = $('<div class="col-md-2 overlow" />').appendTo('#ficheros-inmueble-upload');
	        $.each(data.files, function (index, file) {
	            var node = $('<p/>')
	                    .append($('<span/>').text(file.name));
	            if (!index) {
	                node
	                    .append('<br>')
	                    .append(uploadButtonFicheros.clone(true).data(data));
	            }
	            node.appendTo(data.context);
	        });
	    }).on('fileuploadprocessalways', function (e, data) {
	    	console.log(2);
	        var index = data.index,
	            file = data.files[index],
	            node = $(data.context.children()[index]);
	        if (file.preview) {
	            node
	                .prepend('<br>')
	                .prepend(file.preview);
	        }
	        if (file.error) {
	            node
	                .append('<br>')
	                .append($('<span class="text-danger"/>').text(file.error));
	        }
	        if (data && data.files && index + 1 === data.files.length) {
	            data.context.find('button')
	                .text('Subir')
	                .prop('disabled', !!data.files.error);
	        }
	    }).on('fileuploadprogressall', function (e, data) {
	    	console.log(3);
	        var progress = parseInt(data.loaded / data.total * 100, 10);
	        $('#progress .progress-bar').css(
	            'width',
	            progress + '%'
	        );
	    }).on('fileuploaddone', function (e, data) {
	    	
	    	if (data && data.result && data.result.files && data.result.files.length > 0) {
	    		$.each(data.result.files, function (index, file) {
	                if (file.url) {
	                    var link = $('<a>')
	                        .attr('target', '_blank')
	                        .prop('href', file.url);
	                    $(data.context.children()[index])
	                        .wrap(link);
	                } else if (file.error) {
	                    var error = $('<span class="text-danger"/>').text(file.error);
	                    $(data.context.children()[index])
	                        .append('<br>')
	                        .append(error);
	                }
	            });
	    	}
	    	
	    	loadFicherosInmueble($('#fileuploadFicherosInmueble').data("inmueble-id"), $('#fileuploadFicherosInmueble').data("token"));
	    	
	    }).on('fileuploadfail', function (e, data) {
	    	console.log(6);
	        $.each(data.files, function (index) {
	            var error = $('<span class="text-danger"/>').text('Ha ocurrido un error.');
	            $(data.context.children()[index])
	                .append('<br>')
	                .append(error);
	        });
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
}