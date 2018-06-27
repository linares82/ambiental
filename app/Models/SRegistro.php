<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SRegistro extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 's_registros';

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
                  'grupo_id',
                  'norma_id',
                  'elemento_id',
                  'detalle',
                  'fec_registro',
                  'aviso',
                  'dias_aviso',
                  'responsable_id',
                  'fec_fin_vigencia',
                  'archivo',
                  'estatus_id',
                  'entity_id',
                  'usu_alta_id',
                  'usu_mod_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fec_fin_vigencia','deleted_at', 'updated_at', 'created_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the csGrupoNorma for this model.
     */
    public function csGrupoNorma()
    {
        return $this->belongsTo('App\Models\CsGrupoNorma','grupo_id','id');
    }

    /**
     * Get the csNorma for this model.
     */
    public function csNorma()
    {
        return $this->belongsTo('App\Models\CsNorma','norma_id','id');
    }

    /**
     * Get the csElementosInspeccion for this model.
     */
    public function csElementosInspeccion()
    {
        return $this->belongsTo('App\Models\CsElementosInspeccion','elemento_id','id');
    }

    /**
     * Get the bnd for this model.
     */
    public function bnd()
    {
        return $this->belongsTo('App\Models\Bnd','aviso','id');
    }

    /**
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','responsable_id','id');
    }

    /**
     * Get the sEstatusProcedimiento for this model.
     */
    public function sEstatusProcedimiento()
    {
        return $this->belongsTo('App\Models\SEstatusProcedimiento','estatus_id','id');
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
     * Get the sComentariosRegistro for this model.
     */
    public function sComentariosRegistro()
    {
        return $this->hasOne('App\Models\SComentariosRegistro','s_registros_id','id');
    }

    /**
     * Set the fec_registro.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecRegistroAttribute($value)
    {
        $this->attributes['fec_registro'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fec_fin_vigencia.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecFinVigenciaAttribute($value)
    {
        $this->attributes['fec_fin_vigencia'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fec_registro in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecRegistroAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get fec_fin_vigencia in array format
     *
     * @param  string  $value
     * @return array
     */
//    public function getFecFinVigenciaAttribute($value)
//    {
//        return date('j/n/Y g:i A', strtotime($value));
//    }

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
