<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BitacoraSeguridad extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bitacora_seguridads';

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
                  'fecha',
                  'anio',
                  'mes',
                  'tpo_deteccion_id',
                  'area_id',
                  'tpo_bitacora_id',
                  'tpo_inconformidad_id',
                  'inconformidad',
                  'solucion',
                  'grupo_id',
                  'norma_id',
                  'norma',
                  'responsable_id',
                  'fec_planeada',
                  'fec_solucion',
                  'costo',
                  'estatus_id',
                  'entity_id',
                  'usu_alta_id',
                  'usu_mod_id',
                  'dias_aviso'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fec_planeada','deleted_at', 'updated_at', 'created_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the csTpoDeteccion for this model.
     */
    public function csTpoDeteccion()
    {
        return $this->belongsTo('App\Models\CsTpoDeteccion','tpo_deteccion_id','id');
    }

    /**
     * Get the area for this model.
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id','id');
    }

    /**
     * Get the csTpoBitacora for this model.
     */
    public function csTpoBitacora()
    {
        return $this->belongsTo('App\Models\CsTpoBitacora','tpo_bitacora_id','id');
    }

    /**
     * Get the csTpoInconformidade for this model.
     */
    public function csTpoInconformidade()
    {
        return $this->belongsTo('App\Models\CsTpoInconformidade','tpo_inconformidad_id','id');
    }

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
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','responsable_id','id');
    }

    /**
     * Get the sStB for this model.
     */
    public function sStB()
    {
        return $this->belongsTo('App\Models\SStB','estatus_id','id');
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
     * Get the comentariosB for this model.
     */
    public function comentariosB()
    {
        return $this->hasOne('App\Models\ComentariosB','bitacora_seguridad_id','id');
    }

    /**
     * Set the fecha.
     *
     * @param  string  $value
     * @return void
     */
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fec_planeada.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecPlaneadaAttribute($value)
    {
        $this->attributes['fec_planeada'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fec_solucion.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecSolucionAttribute($value)
    {
        $this->attributes['fec_solucion'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fecha in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFechaAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get fec_planeada in array format
     *
     * @param  string  $value
     * @return array
     */
    /*public function getFecPlaneadaAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }*/

    /**
     * Get fec_solucion in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecSolucionAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
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
