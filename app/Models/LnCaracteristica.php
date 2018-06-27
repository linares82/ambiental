<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class LnCaracteristica extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ln_caracteristicas';

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
                  'reg_impacto_id',
                  'caracteristica_id',
                  'efecto_id',
                  'desc_efecto',
                  'descripcion',
                  'resarcion',
                  'emision_efecto_id',
                  'duracion_accion_id',
                  'continuidad_efecto_id',
                  'reversibilidad_id',
                  'probabilidad_id',
                  'mitigacion_id',
                  'intensidad_impacto_id',
                  'imp_real_id',
                  'imp_potencial_id',
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
     * Get the lnImpacto for this model.
     */
    public function lnImpacto()
    {
        return $this->belongsTo('App\Models\LnImpacto','reg_impacto_id','id');
    }

    /**
     * Get the caracteristica for this model.
     */
    public function caracteristica()
    {
        return $this->belongsTo('App\Models\Caracteristica','caracteristica_id','id');
    }

    /**
     * Get the efecto for this model.
     */
    public function efecto()
    {
        return $this->belongsTo('App\Models\Efecto','efecto_id','id');
    }

    /**
     * Get the emisionEfecto for this model.
     */
    public function emisionEfecto()
    {
        return $this->belongsTo('App\Models\EmisionEfecto','emision_efecto_id','id');
    }

    /**
     * Get the duracionAccion for this model.
     */
    public function duracionAccion()
    {
        return $this->belongsTo('App\Models\DuracionAccion','duracion_accion_id','id');
    }

    /**
     * Get the continuidadEfecto for this model.
     */
    public function continuidadEfecto()
    {
        return $this->belongsTo('App\Models\ContinuidadEfecto','continuidad_efecto_id','id');
    }

    /**
     * Get the reversibilidad for this model.
     */
    public function reversibilidad()
    {
        return $this->belongsTo('App\Models\Reversibilidad','reversibilidad_id','id');
    }

    /**
     * Get the probabilidad for this model.
     */
    public function probabilidad()
    {
        return $this->belongsTo('App\Models\Probabilidad','probabilidad_id','id');
    }

    /**
     * Get the mitigacion for this model.
     */
    public function mitigacion()
    {
        return $this->belongsTo('App\Models\Mitigacion','mitigacion_id','id');
    }

    /**
     * Get the intensidadImpacto for this model.
     */
    public function intensidadImpacto()
    {
        return $this->belongsTo('App\Models\IntensidadImpacto','intensidad_impacto_id','id');
    }

    /**
     * Get the impReal for this model.
     */
    public function impReal()
    {
        return $this->belongsTo('App\Models\ImpReal','imp_real_id','id');
    }

    /**
     * Get the impPotencial for this model.
     */
    public function impPotencial()
    {
        return $this->belongsTo('App\Models\ImpPotencial','imp_potencial_id','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
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
