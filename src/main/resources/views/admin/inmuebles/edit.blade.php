@extends('admin.layouts.master') 
@section('content')

<div class="row">
	<div class="col-sm-12">
		<h1>Editar el inmueble</h1>

		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				{!! implode('', $errors->all('
				<li class="error">:message</li>')) !!}
			</ul>
		</div>
		@endif
		
		@if (session('success'))
		    <div class="alert alert-success">
		        {{ session('success') }}
		    </div>
		@endif
	</div>
</div>

<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#general" aria-controls="general" aria-expanded="true" role="tab" data-toggle="tab" id="general-tab">General</a></li>
	<li role="presentation"><a href="#distribucion" aria-controls="distribucion" aria-expanded="true" role="tab" data-toggle="tab" id="distribucion-tab">Distribución</a></li>
	<li role="presentation"><a href="#superficie" aria-controls="superficie" aria-expanded="true" role="tab" data-toggle="tab" id="superficie-tab">Superficie</a></li>
	<li role="presentation"><a href="#calidades" aria-controls="calidades" aria-expanded="true" role="tab" data-toggle="tab" id="calidades-tab">Calidades</a></li>
	<li role="presentation"><a href="#otras_caracteristicas" aria-controls="otras_caracteristicas" aria-expanded="true" role="tab" data-toggle="tab" id="otras_caracteristicas-tab">Otras características</a></li>
	<li role="presentation"><a href="#imagenes" aria-controls="imagenes" aria-expanded="true" role="tab" data-toggle="tab" id="imagenes-tab">Imágenes</a></li>
	<li role="presentation"><a href="#ficheros" aria-controls="ficheros" aria-expanded="true" role="tab" data-toggle="tab" id="ficheros-tab">Ficheros</a></li>
</ul>

<div class="tab-content">
	{!! Form::model($inmuebles, array('class' => 'form-horizontal', 'id'
	=> 'form-with-validation', 'method' => 'PATCH', 'route' =>
	array('admin.inmuebles.update', $inmuebles->id))) !!}

	<div id="general" class="tab-pane fade in active" role="tabpanel" aria-labelledby="general-tab">
		<div class="form-group">
			{!! Form::label('id', 'Código', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('id', null, ['class' =>
				'form-control', 'readonly' => 'true']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('publicado', 'Publicar en web',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::hidden('publicado','') !!} {!!
				Form::checkbox('publicado', 1, $inmuebles->publicado == 1) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('estado', 'Estado*', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::select('estado', $estado,
				old('estado',$inmuebles->estado), array('class'=>'form-control'))
				!!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('operacion', 'Operación*', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::select('operacion', $operacion,
				old('operacion',$inmuebles->operacion),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('propietarios_id', 'Propietario',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::select('propietarios_id', $propietarios,
				old('propietarios_id',$inmuebles->propietarios_id),
				array('class'=>'form-control selectpicker')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('promociones_id', 'Promoción',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::select('promociones_id', $promociones,
				old('promociones_id',$inmuebles->promociones_id),
				array('class'=>'form-control selectpicker')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('provincias_id', 'Provincia',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::select('provincias_id', $provincias,
				old('provincias_id',$inmuebles->provincias_id),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('localidades_id', 'Localidad',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">
				<div id="localidades" data-selected="{{$inmuebles->localidades_id}}">
					<select class="selectpicker form-control"  name="localidades_id" data-live-search="true" >
						<option value="0">Ninguna</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('zonas_id', 'Zona', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">
				<div id="zonas" data-selected="{{$inmuebles->zonas_id}}">
					<select class="selectpicker form-control"  name="zonas_id" data-live-search="true" >
						<option value="0">Ninguna</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('direccion', 'Dirección', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('direccion',
				old('direccion',$inmuebles->direccion),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('cp', 'C.P.', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('cp',
				old('cp',$inmuebles->cp), array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('latitud', 'Latitud', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('latitud',
				old('latitud',$inmuebles->latitud),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('longitud', 'Longitud', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('longitud',
				old('longitud',$inmuebles->longitud),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			<label for="mapa" class="col-sm-2
			control-label">Mapa</label>
			<div class="col-sm-10">
				<a href="#mapagoogle" class="btn btn-info linkMapa">VER MAPA</a>
				<a href="#mapagoogle" class="btn btn-success resetMap" style="display:none;">REINICIAR</a>
				<a href="#mapagoogle" class="btn btn-danger cerrarMapa" style="display:none;">CERRAR MAPA</a>
				<div id="mapagoogle" style="display:none; width:100%; height: 300px;"></div>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('tiposinmuebles_id', 'Tipo de inmueble (Principal)*',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::select('tiposinmuebles_id',
				$tiposinmuebles,
				old('tiposinmuebles_id',$inmuebles->tiposinmuebles_id),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('precio', 'Precio', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('precio',
				old('precio',$inmuebles->precio), array('class'=>'form-control'))
				!!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('precio_min', 'Precio mínimo',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('precio_min',
				old('precio_min',$inmuebles->precio_min),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('precio_alquiler', 'Precio alquiler', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('precio_alquiler',
				old('precio_alquiler',$inmuebles->precio_alquiler), array('class'=>'form-control'))
				!!}
			</div>
		</div>
		<div class="form-group">
		    {!! Form::label('descripcion', 'Descripción', array('class'=>'col-sm-2 control-label')) !!}
		    <div class="col-sm-10">
		        {!! Form::textarea('descripcion', old('descripcion',$inmuebles->descripcion), array('class'=>'form-control ckeditor')) !!}
		    </div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'),
				array('class' => 'btn btn-primary')) !!} {!!
				link_to_route('admin.inmuebles.index',
				trans('quickadmin::templates.templates-view_edit-cancel'), null,
				array('class' => 'btn btn-default')) !!}
			</div>
		</div>
		
	</div>
	
	<div id="distribucion" class="tab-pane fade" role="tabpanel" aria-labelledby="distribucion-tab">
		<div class="form-group">
			{!! Form::label('dormitorios', 'Dormitorios',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('dormitorios',
				old('dormitorios',$inmuebles->dormitorios),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('banos', 'Baños', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('banos',
				old('banos',$inmuebles->banos), array('class'=>'form-control'))
				!!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('aseos', 'Aseos', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('aseos',
				old('aseos',$inmuebles->aseos), array('class'=>'form-control'))
				!!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('armarios_empotrados', 'Armarios empotrados',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('armarios_empotrados',
				old('armarios_empotrados',$inmuebles->armarios_empotrados),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		
		<ul class="list-group col-sm-4">
  			<li class="list-group-item">
  				{!! Form::hidden('terraza','') !!} {!!
				Form::checkbox('terraza', 1, $inmuebles->terraza
				== 1) !!} Terraza
  			</li>
  			<li class="list-group-item">
  				{!! Form::hidden('balcon','') !!} {!!
				Form::checkbox('balcon', 1, $inmuebles->balcon
				== 1) !!} Balcón
  			</li>
  			<li class="list-group-item">
  				{!! Form::hidden('balcon','') !!} {!!
				Form::checkbox('balcon', 1, $inmuebles->balcon
				== 1) !!} Balcón
  			</li>
  		</ul>
  		<ul class="list-group col-sm-4">
  			<li class="list-group-item">
  				{!! Form::hidden('garaje_privado','') !!} {!!
				Form::checkbox('garaje_privado', 1, $inmuebles->garaje_privado
				== 1) !!} Garaje privado
  			</li>
  			<li class="list-group-item">
  				{!! Form::hidden('aparcamiento','') !!} {!!
				Form::checkbox('aparcamiento', 1, $inmuebles->aparcamiento
				== 1) !!} Aparcamiento
  			</li>
  		</ul>
  		<ul class="list-group col-sm-4">
  			<li class="list-group-item">
  				{!! Form::hidden('trastero','') !!} {!!
				Form::checkbox('trastero', 1, $inmuebles->trastero
				== 1) !!} Trastero
  			</li>
  			<li class="list-group-item">
  				{!! Form::hidden('ascensor','') !!} {!!
				Form::checkbox('ascensor', 1, $inmuebles->ascensor
				== 1) !!} Ascensor
  			</li>
		</ul>
		
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'),
				array('class' => 'btn btn-primary')) !!} {!!
				link_to_route('admin.inmuebles.index',
				trans('quickadmin::templates.templates-view_edit-cancel'), null,
				array('class' => 'btn btn-default')) !!}
			</div>
		</div>
	</div>
	
	<div id="superficie" class="tab-pane fade" role="tabpanel" aria-labelledby="superficie-tab">
		<div class="form-group">
			{!! Form::label('plantas', 'Plantas', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('plantas',
				old('plantas',$inmuebles->plantas),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_construidos', 'm2 construidos',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_construidos',
				old('m2_construidos',$inmuebles->m2_construidos),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_utiles', 'm2 utiles', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_utiles',
				old('m2_utiles',$inmuebles->m2_utiles),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_parcela', 'm2 parcela', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_parcela',
				old('m2_parcela',$inmuebles->m2_parcela),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_terraza', 'm2 terraza', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_terraza',
				old('m2_terraza',$inmuebles->m2_terraza),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_patio', 'm2 patio', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_patio',
				old('m2_patio',$inmuebles->m2_patio),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_salon', 'm2 salón', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_salon',
				old('m2_salon',$inmuebles->m2_salon),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('m2_cocina', 'm2 cocina', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('m2_cocina',
				old('m2_cocina',$inmuebles->m2_cocina),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'),
				array('class' => 'btn btn-primary')) !!} {!!
				link_to_route('admin.inmuebles.index',
				trans('quickadmin::templates.templates-view_edit-cancel'), null,
				array('class' => 'btn btn-default')) !!}
			</div>
		</div>
	</div>
	
	<div id="calidades" class="tab-pane fade" role="tabpanel" aria-labelledby="calidades-tab">
		<div class="form-group">
			{!! Form::label('tipo_suelo', 'Tipo de suelo',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('tipo_suelo',
				old('tipo_suelo',$inmuebles->tipo_suelo),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('climatizacion', 'Climatización',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('climatizacion',
				old('climatizacion',$inmuebles->climatizacion),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('ventanas', 'Ventanas', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('ventanas',
				old('ventanas',$inmuebles->ventanas),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('agua_caliente', 'Agua caliente',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('agua_caliente',
				old('agua_caliente',$inmuebles->agua_caliente),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('cocina', 'Cocina', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('cocina',
				old('cocina',$inmuebles->cocina), array('class'=>'form-control'))
				!!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('calefacción', 'Calefacción',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('calefacción',
				old('calefacción',$inmuebles->calefacción),
				array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('aa', 'A/A', array('class'=>'col-sm-2
			control-label')) !!}
			<div class="col-sm-10">{!! Form::text('aa',
				old('aa',$inmuebles->aa), array('class'=>'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('ce', 'Certificado energético',
			array('class'=>'col-sm-2 control-label')) !!}
			<div class="col-sm-10">{!! Form::text('ce',
				old('ce',$inmuebles->ce), array('class'=>'form-control')) !!}
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'),
				array('class' => 'btn btn-primary')) !!} {!!
				link_to_route('admin.inmuebles.index',
				trans('quickadmin::templates.templates-view_edit-cancel'), null,
				array('class' => 'btn btn-default')) !!}
			</div>
		</div>
	</div>
	
	<div id="otras_caracteristicas" class="tab-pane fade" role="tabpanel" aria-labelledby="otras_caracteristicas-tab">
		
		<ul class="list-group col-sm-4">
  			<li class="list-group-item">
  				{!! Form::hidden('acepta_animales','') !!} {!!
				Form::checkbox('acepta_animales', 1, $inmuebles->acepta_animales
				== 1) !!} Acepta animales
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('bodega','') !!} {!!
				Form::checkbox('bodega', 1, $inmuebles->bodega
				== 1) !!} Bodega
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('buhardilla','') !!} {!!
				Form::checkbox('buhardilla', 1, $inmuebles->buhardilla
				== 1) !!} Buhardilla
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('chimenea','') !!} {!!
				Form::checkbox('chimenea', 1, $inmuebles->chimenea
				== 1) !!} Chimenea
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('despensa','') !!} {!!
				Form::checkbox('despensa', 1, $inmuebles->despensa
				== 1) !!} Despensa
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('sotano','') !!} {!!
				Form::checkbox('sotano', 1, $inmuebles->sotano
				== 1) !!} Sótano
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('tendedero','') !!} {!!
				Form::checkbox('tendedero', 1, $inmuebles->tendedero
				== 1) !!} Tendedero
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('vestidor','') !!} {!!
				Form::checkbox('vestidor', 1, $inmuebles->vestidor
				== 1) !!} Vestidor
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('alarma','') !!} {!!
				Form::checkbox('alarma', 1, $inmuebles->alarma
				== 1) !!} Alarma
  			</li>
  			
  		</ul>
  		<ul class="list-group col-sm-4">
  			
  			<li class="list-group-item">
  				{!! Form::hidden('conserje','') !!} {!!
				Form::checkbox('conserje', 1, $inmuebles->conserje
				== 1) !!} Conserje
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('domotica','') !!} {!!
				Form::checkbox('domotica', 1, $inmuebles->domotica
				== 1) !!} Domótica
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('energia_solar','') !!} {!!
				Form::checkbox('energia_solar', 1, $inmuebles->energia_solar
				== 1) !!} Energía solar
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('jacuzzi','') !!} {!!
				Form::checkbox('jacuzzi', 1, $inmuebles->jacuzzi
				== 1) !!} Jacuzzi
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('piscina_privada','') !!} {!!
				Form::checkbox('piscina_privada', 1, $inmuebles->piscina_privada
				== 1) !!} Piscina privada
  			</li>
  		
  			<li class="list-group-item">
  				{!! Form::hidden('piscina_cubierta','') !!} {!!
				Form::checkbox('piscina_cubierta', 1, $inmuebles->piscina_cubierta
				== 1) !!} Piscina cubierta
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('portero_automatico','') !!} {!!
				Form::checkbox('portero_automatico', 1, $inmuebles->portero_automatico
				== 1) !!} Portero automático/vídeo
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('puerta_blindada','') !!} {!!
				Form::checkbox('puerta_blindada', 1, $inmuebles->puerta_blindada
				== 1) !!} Puerta blindada
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('rejas','') !!} {!!
				Form::checkbox('rejas', 1, $inmuebles->rejas
				== 1) !!} Rejas
  			</li>
  			
  		</ul>
  		<ul class="list-group col-sm-4">
  			
  			<li class="list-group-item">
  				{!! Form::hidden('solarium','') !!} {!!
				Form::checkbox('solarium', 1, $inmuebles->solarium
				== 1) !!} Solarium
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('terraza_cubierta','') !!} {!!
				Form::checkbox('terraza_cubierta', 1, $inmuebles->terraza_cubierta
				== 1) !!} Terraza cubierta
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('piscina_comunitaria','') !!} {!!
				Form::checkbox('piscina_comunitaria', 1, $inmuebles->piscina_comunitaria
				== 1) !!} Piscina comunitaria
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('pista_tenis','') !!} {!!
				Form::checkbox('pista_tenis', 1, $inmuebles->pista_tenis
				== 1) !!} Pista de tenis
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('pista_padel','') !!} {!!
				Form::checkbox('pista_padel', 1, $inmuebles->pista_padel
				== 1) !!} Pista de pádel
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('parque_infantil','') !!} {!!
				Form::checkbox('parque_infantil', 1, $inmuebles->parque_infantil
				== 1) !!} Parque infantil
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('sistema_seguridad','') !!} {!!
				Form::checkbox('sistema_seguridad', 1, $inmuebles->sistema_seguridad
				== 1) !!} Sistema de seguridad
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('zonas_verdes','') !!} {!!
				Form::checkbox('zonas_verdes', 1, $inmuebles->zonas_verdes
				== 1) !!} Zonas verdes
  			</li>
  			
  			<li class="list-group-item">
  				{!! Form::hidden('vigilancia','') !!} {!!
				Form::checkbox('vigilancia', 1, $inmuebles->vigilancia
				== 1) !!} Vigilancia
  			</li>
  			
		</ul>
		
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'),
				array('class' => 'btn btn-primary')) !!} {!!
				link_to_route('admin.inmuebles.index',
				trans('quickadmin::templates.templates-view_edit-cancel'), null,
				array('class' => 'btn btn-default')) !!}
			</div>
		</div>
		
	</div>
	
	{!! Form::close() !!}
	
	<div id="imagenes" class="tab-pane fade" role="tabpanel" aria-labelledby="imagenes-tab">
		<form id="fileuploadImagenesPromocion" action="#" method="POST" enctype="multipart/form-data" data-promocion-id="{{ $inmuebles->id }}">
			<input name="_token" type="hidden" value="{{ csrf_token() }}">
			<input name="promocion_id" type="hidden" value="{{$inmuebles->id}}">
	        <div class="row fileupload-buttonbar">
	            <div class="col-lg-7">
	                <span class="btn btn-success fileinput-button">
	                    <i class="fa fa-plus"></i>
	                    <span>Añadir imágenes...</span>
	                    <input type="file" name="files[]" multiple="">
	                </span>
	            </div>
	            <div class="col-lg-5 fileupload-progress fade">
	                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
	                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
	                </div>
	                <div class="progress-extended">&nbsp;</div>
	            </div>
	        </div>
	        
	        <br />
	        <div id="imagenes-promocion-upload" class="row"></div>
	        
	        <h2>Imágenes</h2>
	        <table role="presentation" id="listadoImagenesPromocion" data-promocion-id="{{ $inmuebles->id }}" data-token="{{ csrf_token() }}" class="table table-striped">
	        	<thead class="files">
	        		<th>Imagen</th>
	        		<th>Título</th>
	        		<th>Principal</th>
	        		<th>Publicada</th>
	        		<th></th>
	        	</thead>
	        	<tbody class="files"></tbody>
	        </table>
	    </form>
	</div>
	
	<div id="ficheros" class="tab-pane fade" role="tabpanel" aria-labelledby="ficheros-tab">
		<form id="fileuploadFicherosPromocion" action="#" method="POST" enctype="multipart/form-data" data-promocion-id="{{ $inmuebles->id }}">
			<input name="_token" type="hidden" value="{{ csrf_token() }}">
			<input name="promocion_id" type="hidden" value="{{$inmuebles->id}}">
	        <div class="row fileupload-buttonbar">
	            <div class="col-lg-7">
	                <span class="btn btn-success fileinput-button">
	                    <i class="fa fa-plus"></i>
	                    <span>Añadir ficheros...</span>
	                    <input type="file" name="files[]" multiple="">
	                </span>
	            </div>
	            <div class="col-lg-5 fileupload-progress fade">
	                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
	                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
	                </div>
	                <div class="progress-extended">&nbsp;</div>
	            </div>
	        </div>
	        
	        <br />
	        <div id="ficheros-promocion-upload" class="row"></div>
	        
	        <h2>Ficheros</h2>
	        <table role="presentation" id="listadoFicherosPromocion" data-promocion-id="{{ $inmuebles->id }}" data-token="{{ csrf_token() }}" class="table table-striped">
	        	<thead class="files">
	        		<th>Fichero</th>
	        		<th>Título</th>
	        		<th>Principal</th>
	        		<th>Publicado</th>
	        		<th></th>
	        	</thead>
	        	<tbody class="files"></tbody>
	        </table>
	    </form>
	</div>
	
</div>

@endsection