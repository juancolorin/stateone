@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.promociones.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive" id="promociones">
                <thead>
                    <tr>
                    	<th>COD</th>
                        <th>Estado</th>
						<th>Operación</th>
						<th>Nombre</th>
						<th>Provincia</th>
						<th>Localidad</th>
						<th>Zona</th>
						<th>Tipo</th>
						<th>Publicado</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
            
        </div>
	</div>
	
@endsection

@section('javascript')
    <script>

        $(document).ready(function () {
            $('#promociones').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                },
                ajax: {
                    url: "/admin/promociones/datatables",
                    method: 'GET'
                },
                columns: [
					{data: 'id', name: 'id'},
                    {data: 'estado', name: 'estado'},
                    {data: 'operacion', name: 'operacion'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'provincia_name', name: 'provincia_name'},
                    {data: 'localidad_name', name: 'localidad_name'},
                    {data: 'zona_name', name: 'zona_name'},
                    {data: 'tipo_inmueble_name', name: 'tipo_inmueble_name'},
                    {data: 'publicado', name: 'publicado'},
                    {data: 'id', name: 'actions', "searchable": false, "orderable": "false", },
                ],
                "columnDefs": [ 
					{
	                    "targets": -1,
	                    "data": "actions",
	                    "render": function ( data, type, full, meta ) {
	                        var html = "";
	                        html += '<a href="/admin/promociones/' + data + '/edit" class="btn btn-xs btn-info">Editar</a>';
	                        html += '<form method="POST" action="/admin/promociones/' + data + '" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm(\'¿Está seguro?\');"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '">';
	                        	html += '<input class="btn btn-xs btn-danger" type="submit" value="Eliminar">';
	                        html += '</form>';
	                        return html;
	                	}
					},
					{
	                    "targets": -2,
	                    "data": "publicado",
	                    "render": function ( data, type, full, meta ) {
	                        var html = "No";
	                        if (data == 1) {
	                        	html = "Si";
	                        } 
	                        return html;
	                	}
					} 
	            ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                        .on('change', function () {
                            column.search($(this).val()).draw();
                        });
                    });
                }
            });
            
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
        });
    </script>
@stop