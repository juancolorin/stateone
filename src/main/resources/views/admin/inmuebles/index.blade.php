@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.inmuebles.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

	<form id="busqueda-inmuebles" onsubmit="return false;" class="row form-horizontal">
	
		<div class="col-sm-4">
			<div class="form-group">
				{!! Form::label('id', 'Código', array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">
					{!! Form::text('id', null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('ref_catastral', 'Ref. Cat.', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('ref_catastral',
					old('ref_catastral',null),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('finca_registral', 'Fin. reg.', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('finca_registral',
					old('finca_registral',null),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('codigo_externo', 'Cod ext.', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('codigo_externo',
					old('codigo_externo',null),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('estado', 'Estado', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::select('estado', [null=>'Ninguno'] + $estado,
					old('estado',NULL), array('class'=>'form-control'))
					!!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('operacion', 'Operación', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::select('operacion', [null=>'Ninguna'] + $operacion,
					old('operacion',NULL),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('propietarios_id', 'Propietario',
				array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">{!! Form::select('propietarios_id', $propietarios,
					old('propietarios_id',NULL),
					array('class'=>'form-control selectpicker')) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				{!! Form::label('publicado', 'En web', array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">
					{!! Form::checkbox('publicado', NULL, NULL) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('promociones_id', 'Promoción',
				array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">{!! Form::select('promociones_id', $promociones,
					old('promociones_id',NULL),
					array('class'=>'form-control selectpicker')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('provincias_id', 'Provincia',
				array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">{!! Form::select('provincias_id', $provincias,
					old('provincias_id',NULL),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('localidades_id', 'Localidad',
				array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">
					<div id="localidades" data-selected="">
						<select class="selectpicker form-control"  name="localidades_id" data-live-search="true" >
							<option value="0">Ninguna</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('zonas_id', 'Zona', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">
					<div id="zonas" data-selected="">
						<select class="selectpicker form-control"  name="zonas_id" data-live-search="true" >
							<option value="0">Ninguna</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="pvp_desde" class="col-sm-3 control-label">€ desde:</label>
				<div class="col-sm-9">
					<input class="form-control" name="pvp_desde" type="text" id="pvp_desde">
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('direccion', 'Dirección', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('direccion',
					old('direccion',NULL),
					array('class'=>'form-control')) !!}
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				{!! Form::label('cp', 'C.P.', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('cp',
					old('cp',NULL), array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('tiposinmuebles_id', 'Tipo',
				array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">{!! Form::select('tiposinmuebles_id',
					$tiposinmuebles,
					old('tiposinmuebles_id',NULL),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('dormitorios', 'Dormitorios',
				array('class'=>'col-sm-3 control-label')) !!}
				<div class="col-sm-9">{!! Form::text('dormitorios',
					old('dormitorios',NULL),
					array('class'=>'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('banos', 'Baños', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('banos',
					old('banos',NULL), array('class'=>'form-control'))
					!!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::label('aseos', 'Aseos', array('class'=>'col-sm-3
				control-label')) !!}
				<div class="col-sm-9">{!! Form::text('aseos',
					old('aseos',NULL), array('class'=>'form-control'))
					!!}
				</div>
			</div>
			<div class="form-group">
				<label for="pvp_hasta" class="col-sm-3 control-label">€ hasta:</label>
				<div class="col-sm-9">
					<input class="form-control" name="pvp_hasta" type="text" id="pvp_hasta">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label"></label>
				<div class="col-sm-9">
					<button class="btn btn-success" id="buscar"><i class="fa fa-search"></i> Buscar</button>
				</div>
			</div>
		</div>
	
	</form>

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive" id="inmuebles">
                <thead>
                    <tr>
                    	<th></th>
                        <th>Estado</th>
						<th>Operación</th>
						<th>Precio</th>
						<th>D</th>
						<th>B</th>
						<th>A</th>
						<th>Dirección</th>
						<th>Provincia</th>
						<th>Localidad</th>
						<th>Tipo</th>
						<th>Web</th>
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

            var table = $('#inmuebles').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    "url": "/quickadmin/js/Spanish.json"
                },
                ajax: {
                    url: "/admin/inmuebles/datatables",
                    method: 'GET',
                    data: function (d) {
                        d.pvp_min = $('#pvp_desde').val();
                        d.pvp_max = $('#pvp_hasta').val();
                        d.id = $('#id').val();
                        d.estado = $('#estado').val();
                        d.operacion = $('#operacion').val();
                        d.propietarios_id = $('#propietarios_id').val();
                        d.publicado = $('#publicado').is(':checked');
                        d.promociones_id = $('#promociones_id').val();
                        d.provincias_id = $('#provincias_id').val();
                        d.localidades_id = $('#localidades_id').val();
                        d.zonas_id = $('#zonas_id').val();
                        d.direccion = $('#direccion').val();
                        d.cp = $('#cp').val();
                        d.tiposinmuebles_id = $('#tiposinmuebles_id').val();
                        d.dormitorios = $('#dormitorios').val();
                        d.banos = $('#banos').val();
                        d.aseos = $('#aseos').val();
                        d.ref_catastral = $('#ref_catastral').val();
                        d.finca_registral = $('#finca_registral').val();
                        d.codigo_externo = $('#codigo_externo').val();
                    }
                },
                columns: [
					{data: 'id', name: 'id'},
                    {data: 'estado', name: 'estado'},
                    {data: 'operacion', name: 'operacion'},
                    {data: 'precio', name: 'precio'},
                    {data: 'dormitorios', name: 'dormitorios'},
                    {data: 'banos', name: 'banos'},
                    {data: 'aseos', name: 'aseos'},
                    {data: 'direccion', name: 'direccion'},
                    {data: 'provincia_name', name: 'provincia_name'},
                    {data: 'localidad_name', name: 'localidad_name'},
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
	                        html += '<a href="/admin/inmuebles/' + data + '/edit" class="btn btn-xs btn-info">Editar</a>';
	                        html += '<form method="POST" action="/admin/inmuebles/' + data + '" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm(\'¿Está seguro?\');"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '">';
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
                        /*
                        var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
	                    column.data().unique().sort().each( function ( d, j ) {
	                        select.append( '<option value="'+d+'">'+d+'</option>' )
	                    } );
	                    */
                    });
                }
            });

            // Event listener to the two range filtering inputs to redraw on input
            $('#buscar').click( function() {
                table.draw();
            } );

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