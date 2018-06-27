<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CsGrupoNorma extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cs_grupo_normas';

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
                  'grupo_norma',
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
     * Get the bitacoraSeguridads for this model.
     */
    public function bitacoraSeguridads()
    {
        return $this->hasMany('App\Models\BitacoraSeguridad','grupo_id','id');
    }

    /**
     * Get the csElementosInspeccion for this model.
     */
    public function csElementosInspeccion()
    {
        return $this->hasOne('App\Models\CsElementosInspeccion','grupo_norma_id','id');
    }

    /**
     * Get the csNormas for this model.
     */
    public function csNormas()
    {
        return $this->hasMany('App\Models\CsNorma','grupo_norma_id','id');
    }

    /**
     * Get the revDocumentoalLn for this model.
     */
    public function revDocumentoalLn()
    {
        return $this->hasOne('App\Models\RevDocumentoalLn','grupo_norma_id','id');
    }

    /**
     * Get the sRegistro for this model.
     */
    public function sRegistro()
    {
        return $this->hasOne('App\Models\SRegistro','grupo_id','id');
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
