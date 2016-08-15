@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($clientes, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('admin.clientes.update', $clientes->id))) !!}

<div class="form-group">
    {!! Form::label('user_id', 'Asignado', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('user_id', $user, old('user_id',$clientes->user_id), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('fecha_ingreso', 'Fecha de ingreso', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('fecha_ingreso', old('fecha_ingreso',$clientes->fecha_ingreso), array('class'=>'form-control datetimepicker')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('medio_captacion', 'Medio de captación', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('medio_captacion', $medio_captacion, old('medio_captacion',$clientes->medio_captacion), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('name', 'Nombre*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$clientes->name), array('class'=>'form-control')) !!}
        <p class="help-block">Nombre y apellidos o razón social</p>
    </div>
</div><div class="form-group">
    {!! Form::label('email', 'Email', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::email('email', old('email',$clientes->email), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('telefono', 'Telefono', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('telefono', old('telefono',$clientes->telefono), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('document_number', 'DNI/NIE/CIF', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('document_number', old('document_number',$clientes->document_number), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('province', 'Provincia', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('province', old('province',$clientes->province), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('town', 'Localidad', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('town', old('town',$clientes->town), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('cp', 'C.P.', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('cp', old('cp',$clientes->cp), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('observaciones', 'Observaciones internas', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('observaciones', old('observaciones',$clientes->observaciones), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route('admin.clientes.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection