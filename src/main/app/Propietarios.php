<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 



class Propietarios extends Model {

    

    

    protected $table    = 'propietarios';
    
    protected $fillable = [
          'user_id',
          'fecha_ingreso',
          'medio_captacion',
          'name',
          'email',
          'document_number',
          'address',
          'province',
          'town',
          'cp',
          'observaciones'
    ];
    
    public static $medio_captacion = ["Web" => "Web", "Oficina" => "Oficina", "Teléfono" => "Teléfono", "Publicidad" => "Publicidad", "Otros" => "Otros"];


    public static function boot()
    {
        parent::boot();

        Propietarios::observe(new UserActionsObserver);
    }
    
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    
    
    /**
     * Set attribute to datetime format
     * @param $input
     */
    public function setFechaIngresoAttribute($input)
    {
        if($input != '') {
            $this->attributes['fecha_ingreso'] = Carbon::createFromFormat(config('quickadmin.date_format') . ' ' . config('quickadmin.time_format'), $input)->format('Y-m-d H:i:s');
        }else{
            $this->attributes['fecha_ingreso'] = '';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function getFechaIngresoAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('quickadmin.date_format') . ' ' .config('quickadmin.time_format'));
        }else{
            return '';
        }
    }


}