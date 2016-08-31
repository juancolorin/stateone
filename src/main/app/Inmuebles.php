<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Inmuebles extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'inmuebles';
    
    protected $fillable = [
          'estado',
          'operacion',
          'nombre',
    	  'ref_catastral',
    	  'finca_registral',
    	  'cod_externo',
          'descripcion',
          'provincias_id',
          'localidades_id',
          'zonas_id',
          'latitud',
          'longitud',
          'tiposinmuebles_id',
    	  'promociones_id',
    	  'propietarios_id',
          'precio',
          'precio_min',
    	  'precio_alquiler',
          'direccion',
          'cp',
          'dormitorios',
          'banos',
          'aseos',
          'm2_salon',
    	  'm2_cocina',
          'terraza',
          'balcon',
          'armarios_empotrados',
          'garaje_privado',
          'aparcamiento',
          'trastero',
          'ascensor',
          'm2_construidos',
          'm2_utiles',
          'm2_parcela',
          'm2_terraza',
          'm2_patio',
          'plantas',
          'tipo_suelo',
          'climatizacion',
          'ventanas',
          'agua_caliente',
          'cocina',
          'calefacción',
          'aa',
          'ce',
          'acepta_animales',
          'bodega',
          'buhardilla',
          'chimenea',
          'despensa',
          'sotano',
          'tendedero',
          'vestidor',
          'alarma',
          'conserje',
          'domotica',
          'energia_solar',
          'jacuzzi',
          'piscina_privada',
          'piscina_cubierta',
          'portero_automatico',
          'puerta_blindada',
          'rejas',
          'solarium',
          'terraza_cubierta',
          'piscina_comunitaria',
          'pista_tenis',
          'pista_padel',
          'parque_infantil',
          'sistema_seguridad',
          'zonas_verdes',
          'vigilancia',
          'publicado'
    ];
    
    public static $estado = ["Disponible" => "Disponible","Vendido" => "Vendido", "Alquilado" => "Alquilado", "Reservado" => "Reservado", "Oferta Presentada" => "Oferta Presentada", "Baja" => "Baja"];
    public static $operacion = ["Venta" => "Venta", "Alquiler" => "Alquiler", "Alquiler con opción a compra" => "Alquiler con opción a compra", "Venta y Alquiler" => "Venta y Alquiler"];


    public static function boot()
    {
        parent::boot();

        Inmuebles::observe(new UserActionsObserver);
    }
    
    public function provincias()
    {
        return $this->hasOne('App\Provincias', 'id', 'provincias_id');
    }


    public function localidades()
    {
        return $this->hasOne('App\Localidades', 'id', 'localidades_id');
    }


    public function zonas()
    {
        return $this->hasOne('App\Zonas', 'id', 'zonas_id');
    }


    public function tiposinmuebles()
    {
        return $this->hasOne('App\TiposInmuebles', 'id', 'tiposinmuebles_id');
    }

    public function promociones()
    {
    	return $this->hasOne('App\Promociones', 'id', 'promociones_id');
    }
    
    public function propietarios()
    {
    	return $this->hasOne('App\Propietarios', 'id', 'propietarios_id');
    }
    
}