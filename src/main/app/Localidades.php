<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class Localidades extends Model {

    protected $table    = 'localidades';
    
    protected $fillable = [
          'name',
          'provincias_id'
    ];

    public static function boot()
    {
        parent::boot();

        Localidades::observe(new UserActionsObserver);
    }
    
    public function provincias()
    {
        return $this->hasOne('App\Provincias', 'id', 'provincias_id');
    }

    public function loadByIdProvincia($idProvincia)
    {
    	$dql = new Localidades;
		$dql = $dql->where('provincias_id', '=', $idProvincia);
		return $dql->get();
    }
}