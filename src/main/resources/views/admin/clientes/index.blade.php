@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.clientes.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($clientes->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                    	<th>Nombre</th>
						<th>Email</th>
						<th>DNI/NIE/CIF</th>
						<th>Medio de captación</th>
						<th>Asignado</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clientes as $row)
                        <tr>
                        	<td>{{ $row->name }}</td>
							<td>{{ $row->email }}</td>
							<td>{{ $row->document_number }}</td>
							<td>{{ $row->medio_captacion }}</td>
							<td>{{ isset($row->user->name) ? $row->user->name : '' }}</td>
                            <td>
                            	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalPV{{ $row->id }}">
								  P.V.
								</button>
								<!-- Modal -->
								<div class="modal" id="modalPV{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalPVLabel{{ $row->id }}">
									<div class="modal-dialog" role="document">
								    	<div class="modal-content">
								      		<div class="modal-header">
								        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        		<h4 class="modal-title" id="modalPVLabel{{ $row->id }}">Crear parte de visita</h4>
								      		</div>
								      		<div class="modal-body">
								        		<form class="form-horizontal" role="form" action="/admin/clientes/pv" method="GET" target="_blank">
								        			<legend>Datos cliente</legend>
								        			<div class="form-group">
									              		<label for="recipient-name" class="col-md-4 control-label">Nombre:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="name" value="{{ $row->name }}">
									              		</div>
									            	</div>
									            	<div class="form-group">
									              		<label for="message-text" class="col-md-4 control-label">DNI/NIE/CIF:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="document_number" value="{{ $row->document_number }}">
									              		</div>
									            	</div>
									            	<div class="form-group">
									              		<label for="message-text" class="col-md-4 control-label">Teléfonos de contacto:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="telefono" value="{{ $row->telefono }}">
									              		</div>
									            	</div>
									            	<div class="form-group">
									              		<label for="message-text" class="col-md-4 control-label">Correo electrónico:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="email" value="{{ $row->email }}">
									              			<span class="help-block">opcional</span>
									              		</div>
									            	</div>
									            	<div class="form-group">
									              		<label for="message-text" class="col-md-4 control-label">Dirección:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="address" value="{{ $row->province }} {{ $row->town }}">
									              			<span class="help-block">lugar de procedencia</span>
									              		</div>
									            	</div>
									            	<legend>Datos inmueble</legend>
									            	<div class="form-group">
									              		<label for="recipient-name" class="col-md-4 control-label">Provincia</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="inmueble_provincia">
									              		</div>
									            	</div>
									            	<div class="form-group">
									              		<label for="message-text" class="col-md-4 control-label">Población:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="inmueble_poblacion">
									              		</div>
									            	</div>
									            	<div class="form-group">
									              		<label for="message-text" class="col-md-4 control-label">Inmueble visitado:</label>
									              		<div class="col-md-8">
									              			<input type="text" class="form-control" name="inmueble_visitado">
									              		</div>
									            	</div>
									            	<div class="form-group">
									            		<label class="col-md-4 control-label"></label>
									            		<div class="col-md-8">
									            			<button type="submit" value="Submit" class="btn btn-primary">Crear parte de visita</button>
									            		</div>
									            	</div>
									          	</form>
								      		</div>
								      		<div class="modal-footer">
								        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								      		</div>
								    	</div>
								  	</div>
								</div>
                                {!! link_to_route('admin.clientes.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.clientes.destroy', $row->id))) !!}
                                {!! Form::submit(trans('quickadmin::templates.templates-view_index-delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
@else
    {{ trans('quickadmin::templates.templates-view_index-no_entries_found') }}
@endif

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
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