@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.promociones.create', trans('quickadmin::templates.templates-view_index-add_new') , null, array('class' => 'btn btn-success')) !!}</p>

@if ($promociones->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>Estado</th>
						<th>Operación</th>
						<th>Nombre</th>
						<th>Provincia</th>
						<th>Localidad</th>
						<th>Zona</th>
						<th>Tipo</th>
						<th>Precio</th>
						<th>Publicado</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($promociones as $row)
                        <tr>
                            <td>{{ $row->estado }}</td>
							<td>{{ $row->operacion }}</td>
							<td>{{ $row->nombre }}</td>
							<td>{{ isset($row->provincias->name) ? $row->provincias->name : '' }}</td>
							<td>{{ isset($row->localidades->name) ? $row->localidades->name : '' }}</td>
							<td>{{ isset($row->zonas->name) ? $row->zonas->name : '' }}</td>
							<td>{{ isset($row->tiposinmuebles->name) ? $row->tiposinmuebles->name : '' }}</td>
							<td>{{ $row->precio }}</td>
							<td>{{ $row->publicado }}</td>
                            <td>
                                {!! link_to_route('admin.promociones.edit', trans('quickadmin::templates.templates-view_index-edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("quickadmin::templates.templates-view_index-are_you_sure")."');",  'route' => array('admin.promociones.destroy', $row->id))) !!}
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