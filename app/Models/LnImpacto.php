<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class LnImpacto extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ln_impactos';

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
                  'enc_impacto_id',
                  'factor_id',
                  'rubro_id',
                  'especifico_id',
                  'estatus_id',
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
     * Get the encImpacto for this model.
     */
    public function encImpacto()
    {
        return $this->belongsTo('App\Models\EncImpacto','enc_impacto_id','id');
    }

    /**
     * Get the factor for this model.
     */
    public function factor()
    {
        return $this->belongsTo('App\Models\Factor','factor_id','id');
    }

    /**
     * Get the rubro for this model.
     */
    public function rubro()
    {
        return $this->belongsTo('App\Models\Rubro','rubro_id','id');
    }

    /**
     * Get the especifico for this model.
     */
    public function especifico()
    {
        return $this->belongsTo('App\Models\Especifico','especifico_id','id');
    }

    /**
     * Get the stRegImpacto for this model.
     */
    public function stRegImpacto()
    {
        return $this->belongsTo('App\Models\StRegImpacto','estatus_id','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }

    /**
     * Get the lnCaracteristicas for this model.
     */
    public function lnCaracteristicas()
    {
        return $this->hasMany('App\Models\LnCaracteristica','reg_impacto_id','id');
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
