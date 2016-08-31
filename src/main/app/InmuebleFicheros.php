<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class InmuebleFicheros extends Model {

    protected $table    = 'inmueble_ficheros';
    
    protected $fillable = ['is_active',
    								'title',
                                    'is_featured',
                                    'image_name',
                                    'image_path',
                                    'image_extension',
                                    'mobile_image_name',
                                    'mobile_image_path',
                                    'mobile_extension',
    								'inmueble_id'
    ];

    public static function boot()
    {
        parent::boot();

        Zonas::observe(new UserActionsObserver);
    }
    
    public function inmuebles()
    {
        return $this->hasOne('App\Inmuebles', 'id', 'inmueble_id');
    }

    public function loadByIdInmueble($idInmueble)
    {
    	$dql = new InmuebleFicheros;
    	$dql = $dql->where('inmueble_id', '=', $idInmueble);
    	return $dql->get();
    }
    
}