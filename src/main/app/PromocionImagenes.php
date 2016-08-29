<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class PromocionImagenes extends Model {

    protected $table    = 'promocion_imagenes';
    
    protected $fillable = ['is_active',
    								'title',
                                     'is_featured',
                                    'image_name',
                                    'image_path',
                                    'image_extension',
                                    'mobile_image_name',
                                    'mobile_image_path',
                                    'mobile_extension',
    								'promocion_id'
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
    	$dql = new PromocionImagenes;
    	$dql = $dql->where('promocion_id', '=', $idPromocion);
    	return $dql->get();
    }
    
}