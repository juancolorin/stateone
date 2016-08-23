<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class Zonas extends Model {

    protected $table    = 'zonas';
    
    protected $fillable = [
          'name',
          'localidades_id'
    ];

    public static function boot()
    {
        parent::boot();

        Zonas::observe(new UserActionsObserver);
    }
    
    public function localidades()
    {
        return $this->hasOne('App\Localidades', 'id', 'localidades_id');
    }

    public function loadByIdLocalidad($idLocalidad)
    {
    	$dql = new Zonas;
    	$dql = $dql->where('localidades_id', '=', $idLocalidad);
    	return $dql->get();
    }
    
}