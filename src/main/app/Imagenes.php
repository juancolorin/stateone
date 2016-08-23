<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class Imagenes extends Model {

    protected $table    = 'imagenes';
    
    protected $fillable = [
          'promocion_id',
    	  'name',
    	  'publicada',
          'image'
    ];

    public static function boot()
    {
        parent::boot();

        Zonas::observe(new UserActionsObserver);
    }
    
    public function promociones()
    {
        return $this->hasOne('App\Promociones', 'id', 'promocion_id');
    }

    public function loadByIdPromocion($idPromocion)
    {
    	$dql = new Imagenes;
    	$dql = $dql->where('promocion_id', '=', $idPromocion);
    	return $dql->get();
    }
    
}