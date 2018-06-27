<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Efecto extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'efectos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'efecto',
                  'descripcion',
                  'usu_alta_id',
                  'usu_mod_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }

    /**
     * Get the aspectosAmbientales for this model.
     */
    public function aspectosAmbientales()
    {
        return $this->hasMany('App\Models\AspectosAmbientale','severidad_id','id');
    }

    /**
     * Get the lnCaracteristicas for this model.
     */
    public function lnCaracteristicas()
    {
        return $this->hasMany('App\Models\LnCaracteristica','efecto_id','id');
    }

    /**
     * Get the mImpPotencials for this model.
     */
    public function mImpPotencials()
    {
        return $this->hasMany('App\Models\MImpPotencial','efecto_id','id');
    }

    /**
     * Get the mImpReals for this model.
     */
    public function mImpReals()
    {
        return $this->hasMany('App\Models\MImpReal','efecto_id','id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get deleted_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDeletedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

}
