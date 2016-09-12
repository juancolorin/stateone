<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Parte de Visita</title>
</head>
<body>

	<img src="http://www.stateone.es/public/static/images/logo-secun.png" width="150px" />
	
	<br />
	<br />
	
	<div style="border:1px solid #000; padding:0 10px;">
		<h3>DATOS CLIENTE</h3>
	
		<p>Nombre: <strong>{{$data['name']}}</strong></p>
		
		<p>NIF: <strong>{{$data['document_number']}}</strong></p>
		
		<p>Tel&eacute;fonos de Contacto: <strong>{{$data['telefono']}}</strong></p>
		
		<p>Correo Electr&oacute;nico (opcional): <strong>{{$data['email']}}</strong></p>
		
		<p>Direcci&oacute;n (lugar de procedencia): <strong>{{$data['address']}}</strong></p>
	</div>
	
	<br />
	
	<div style="border:1px solid #000; padding:0 10px;">
		<h3>DATOS INMUEBLE</h3>
		
		<p>Provincia: <strong>{{$data['inmueble_provincia']}}</strong></p>
		
		<p>Poblaci&oacute;n: <strong>{{$data['inmueble_poblacion']}}</strong></p>
		
		<p>Inmueble visitado: <strong>{{$data['inmueble_visitado']}}</strong></p>
	</div>
	
	<p style="font-size:12px;"><em>De conformidad con la normativa vigente en materia de Protecci&oacute;n de Datos de Car&aacute;cter Personal, el cliente arriba indicado queda &nbsp;informado y presta su consentimiento para </em>que los datos de car&aacute;cter personal que nos proporcione al rellenar el presente documento sean incorporados<em> a los ficheros titularidad y responsabilidad de F-SAB-8, S.L. con domicilio en 04720 Avd. Carlos III, 348 Aguadulce, Almer&iacute;a para su tratamiento por &eacute;sta con la finalidad de gestionar la comercializaci&oacute;n de productos inmobiliarios. A tal efecto, autoriza y consiente que STATE ONE le mantenga puntualmente informado telef&oacute;nicamente y/o, en caso de haberlo proporcionado, mediante correo electr&oacute;nico, de cualesquiera productos inmobiliarios.</em></p>
	
	<p style="font-size:12px;"><em>Todos los datos que se recaban en el presente documento son de obligada cumplimentaci&oacute;n, a excepci&oacute;n de su direcci&oacute;n de correo electr&oacute;nico, por lo que la no facilitaci&oacute;n de aqu&eacute;llos impedir&aacute; la gesti&oacute;n de comercializaci&oacute;n la remisi&oacute;n de informaci&oacute;n alguna. </em></p>
	
	<p style="font-size:12px;"><em>STATE ONE le garantiza la posibilidad de revocar el consentimiento prestado para el tratamiento de sus datos con la finalidad prevista, as&iacute; como el ejercicio de sus derechos de acceso, rectificaci&oacute;n, cancelaci&oacute;n y oposici&oacute;n, siempre en los t&eacute;rminos establecidos en la legislaci&oacute;n vigente, mediante comunicaci&oacute;n escrita dirigida a STATE ONE, por correo ordinario a la direcci&oacute;n arriba indicada o por correo electr&oacute;nico a info@stateone.es.</em></p>
	
	<br />
	
	<p>En Aguadulce a {{$data['day']}} de {{$data['month']}} del {{$data['year']}}</p>
	
	<p>
		Fdo. Cliente
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		Fdo. Agencia Inmobiliaria
	</p>
    
</body>
</html>