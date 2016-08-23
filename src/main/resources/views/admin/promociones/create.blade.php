@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => 'admin.promociones.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('estado', 'Estado*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('estado', $estado, old('estado'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('operacion', 'Operación*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('operacion', $operacion, old('operacion'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('nombre', 'Nombre*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('nombre', old('nombre'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('descripcion', 'Descripción', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::textarea('descripcion', old('descripcion'), array('class'=>'form-control ckeditor')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('provincias_id', 'Provincia', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('provincias_id', $provincias, old('provincias_id'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('localidades_id', 'Localidad', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('localidades_id', $localidades, old('localidades_id'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('zonas_id', 'Zona', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('zonas_id', $zonas, old('zonas_id'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('latitud', 'Latitud', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('latitud', old('latitud'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('longitud', 'Longitud', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('longitud', old('longitud'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tiposinmuebles_id', 'Tipo de inmueble (Principal)*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('tiposinmuebles_id', $tiposinmuebles, old('tiposinmuebles_id'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('precio', 'Precio', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('precio', old('precio'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('precio_min', 'Precio mínimo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('precio_min', old('precio_min'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('direccion', 'Dirección', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('direccion', old('direccion'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('cp', 'C.P.', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('cp', old('cp'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('dormitorios', 'Dormitorios', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('dormitorios', old('dormitorios'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('banos', 'Baños', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('banos', old('banos'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('aseos', 'Aseos', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('aseos', old('aseos'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('salon', 'Salón', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('salon','') !!}
        {!! Form::checkbox('salon', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('terraza', 'Terraza', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('terraza','') !!}
        {!! Form::checkbox('terraza', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('balcon', 'Balcón', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('balcon','') !!}
        {!! Form::checkbox('balcon', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('armarios_empotrados', 'Armarios empotrados', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('armarios_empotrados','') !!}
        {!! Form::checkbox('armarios_empotrados', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('garaje_privado', 'Garaje privado', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('garaje_privado','') !!}
        {!! Form::checkbox('garaje_privado', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('aparcamiento', 'Aparcamiento', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('aparcamiento','') !!}
        {!! Form::checkbox('aparcamiento', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('trastero', 'Trastero', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('trastero','') !!}
        {!! Form::checkbox('trastero', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('ascensor', 'Ascensor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('ascensor','') !!}
        {!! Form::checkbox('ascensor', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('m2_construidos', 'm2 construidos', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('m2_construidos', old('m2_construidos'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('m2_utiles', 'm2 utiles', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('m2_utiles', old('m2_utiles'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('m2_parcela', 'm2 parcela', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('m2_parcela', old('m2_parcela'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('m2_terraza', 'm2 terraza', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('m2_terraza', old('m2_terraza'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('m2_patio', 'm2_patio', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('m2_patio', old('m2_patio'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('plantas', 'Plantas', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('plantas', old('plantas'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tipo_suelo', 'Tipo de suelo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('tipo_suelo', old('tipo_suelo'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('climatizacion', 'Climatización', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('climatizacion', old('climatizacion'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('ventanas', 'Ventanas', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ventanas', old('ventanas'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('agua_caliente', 'Agua caliente', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('agua_caliente', old('agua_caliente'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('cocina', 'Cocina', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('cocina', old('cocina'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('calefacción', 'Calefacción', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('calefacción', old('calefacción'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('aa', 'A/A', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('aa', old('aa'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('ce', 'Certificado energético', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ce', old('ce'), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('acepta_animales', 'Acepta animales', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('acepta_animales','') !!}
        {!! Form::checkbox('acepta_animales', 1, true) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('bodega', 'Bodega', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('bodega','') !!}
        {!! Form::checkbox('bodega', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('buhardilla', 'Buhardilla', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('buhardilla','') !!}
        {!! Form::checkbox('buhardilla', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('chimenea', 'Chimenea', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('chimenea','') !!}
        {!! Form::checkbox('chimenea', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('despensa', 'Despensa', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('despensa','') !!}
        {!! Form::checkbox('despensa', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sotano', 'Sótano', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('sotano','') !!}
        {!! Form::checkbox('sotano', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('tendedero', 'Tendedero', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('tendedero','') !!}
        {!! Form::checkbox('tendedero', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('vestidor', 'Vestidor', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('vestidor','') !!}
        {!! Form::checkbox('vestidor', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('alarma', 'Alarma', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('alarma','') !!}
        {!! Form::checkbox('alarma', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('conserje', 'Conserje', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('conserje','') !!}
        {!! Form::checkbox('conserje', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('domotica', 'Domótica', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('domotica','') !!}
        {!! Form::checkbox('domotica', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('energia_solar', 'Energía solar', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('energia_solar','') !!}
        {!! Form::checkbox('energia_solar', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('jacuzzi', 'Jacuzzi', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('jacuzzi','') !!}
        {!! Form::checkbox('jacuzzi', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('piscina_privada', 'Piscina privada', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('piscina_privada','') !!}
        {!! Form::checkbox('piscina_privada', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('piscina_cubierta', 'Piscina cubierta', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('piscina_cubierta','') !!}
        {!! Form::checkbox('piscina_cubierta', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('portero_automatico', 'Portero automático/vídeo', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('portero_automatico','') !!}
        {!! Form::checkbox('portero_automatico', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('puerta_blindada', 'Puerta blindada', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('puerta_blindada','') !!}
        {!! Form::checkbox('puerta_blindada', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('rejas', 'Rejas', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('rejas','') !!}
        {!! Form::checkbox('rejas', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('solarium', 'Solarium', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('solarium','') !!}
        {!! Form::checkbox('solarium', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('terraza_cubierta', 'Terraza cubierta', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('terraza_cubierta','') !!}
        {!! Form::checkbox('terraza_cubierta', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('piscina_comunitaria', 'Piscina comunitaria', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('piscina_comunitaria','') !!}
        {!! Form::checkbox('piscina_comunitaria', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('pista_tenis', 'Pista de tenis', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('pista_tenis','') !!}
        {!! Form::checkbox('pista_tenis', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('pista_padel', 'Pista de pádel', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('pista_padel','') !!}
        {!! Form::checkbox('pista_padel', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('conserjeria', 'Conserjería', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('conserjeria','') !!}
        {!! Form::checkbox('conserjeria', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('parque_infantil', 'Parque infantil', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('parque_infantil','') !!}
        {!! Form::checkbox('parque_infantil', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('sistema_seguridad', 'Sistema de seguridad', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('sistema_seguridad','') !!}
        {!! Form::checkbox('sistema_seguridad', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('zonas_verdes', 'Zonas verdes', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('zonas_verdes','') !!}
        {!! Form::checkbox('zonas_verdes', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('vigilancia', 'Vigilancia', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('vigilancia','') !!}
        {!! Form::checkbox('vigilancia', 1, false) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('publicado', 'Publicar en web', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::hidden('publicado','') !!}
        {!! Form::checkbox('publicado', 1, false) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection