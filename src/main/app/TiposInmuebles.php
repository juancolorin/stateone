<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class TiposInmuebles extends Model {

    

    

    protected $table    = 'tiposinmuebles';
    
    protected $fillable = ['name'];
    

    public static function boot()
    {
        parent::boot();

        TiposInmuebles::observe(new UserActionsObserver);
    }
    
    
    
    
}