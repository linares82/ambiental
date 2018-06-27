<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AspectosAmbientale extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aspectos_ambientales';

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
                  'proceso_id',
                  'area_id',
                  'actividad',
                  'descripcion',
                  'efecto',
                  'aspecto_id',
                  'eme_id',
                  'condicion_id',
                  'impacto_id',
                  'puesto_id',
                  'al_federal_bnd',
                  'al_estatal_bnd',
                  'obj_corporativo_bnd',
                  'quejas_bnd',
                  'severidad_id',
                  'bnd_potencial',
                  'frecuencia_id',
                  'bnd_real',
                  'probabilidad_id',
                  'imp_potencial_id',
                  'imp_real_id',
                  'observaciones',
                  'ctrls_opracionales',
                  'entity_id',
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
     * Get the aaProceso for this model.
     */
    public function aaProceso()
    {
        return $this->belongsTo('App\Models\AaProceso','proceso_id','id');
    }

    /**
     * Get the area for this model.
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id','id');
    }

    /**
     * Get the aaAspecto for this model.
     */
    public function aaAspecto()
    {
        return $this->belongsTo('App\Models\AaAspecto','aspecto_id','id');
    }

    /**
     * Get the aaEme for this model.
     */
    public function aaEme()
    {
        return $this->belongsTo('App\Models\AaEme','eme_id','id');
    }

    /**
     * Get the aaCondicione for this model.
     */
    public function aaCondicione()
    {
        return $this->belongsTo('App\Models\AaCondicione','condicion_id','id');
    }

    /**
     * Get the aaImpacto for this model.
     */
    public function aaImpacto()
    {
        return $this->belongsTo('App\Models\AaImpacto','impacto_id','id');
    }

    /**
     * Get the puesto for this model.
     */
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto','puesto_id','id');
    }

    /**
     * Get the bnd for this model.
     */
    public function bnd()
    {
        return $this->belongsTo('App\Models\Bnd','bnd_real','id');
    }

    /**
     * Get the efecto for this model.
     */
    public function efecto()
    {
        return $this->belongsTo('App\Models\Efecto','severidad_id','id');
    }

    /**
     * Get the duracionAccion for this model.
     */
    public function duracionAccion()
    {
        return $this->belongsTo('App\Models\DuracionAccion','frecuencia_id','id');
    }

    /**
     * Get the probabilidad for this model.
     */
    public function probabilidad()
    {
        return $this->belongsTo('App\Models\Probabilidad','probabilidad_id','id');
    }

    /**
     * Get the impPotencial for this model.
     */
    public function impPotencial()
    {
        return $this->belongsTo('App\Models\ImpPotencial','imp_potencial_id','id');
    }

    /**
     * Get the impReal for this model.
     */
    public function impReal()
    {
        return $this->belongsTo('App\Models\ImpReal','imp_real_id','id');
    }

    /**
     * Get the entity for this model.
     */
    public function entity()
    {
        return $this->belongsTo('App\Models\Entity','entity_id','id');
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
