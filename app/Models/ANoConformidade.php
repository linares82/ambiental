<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ANoConformidade extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'a_no_conformidades';

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
                  'no_conformidad',
                  'fecha',
                  'anio',
                  'mes',
                  'area_id',
                  'tpo_deteccion_id',
                  'tpo_bitacora_id',
                  'tpo_inconformidad_id',
                  'solucion',
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
     * Get the area for this model.
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }

    /**
     * Get the csTpoDeteccion for this model.
     */
    public function csTpoDeteccion()
    {
        return $this->belongsTo('App\Models\CsTpoDeteccion','tpo_deteccion_id','id');
    }

    /**
     * Get the caTpoBitacora for this model.
     */
    public function caTpoBitacora()
    {
        return $this->belongsTo('App\Models\CaTpoBitacora','tpo_bitacora_id','id');
    }

    /**
     * Get the caTpoNoConformidad for this model.
     */
    public function caTpoNoConformidad()
    {
        return $this->belongsTo('App\Models\CaTpoNoConformidad','tpo_inconformidad_id','id');
    }

    /**
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','responsable_id','id');
    }

    /**
     * Get the aStNc for this model.
     */
    public function aStNc()
    {
        return $this->belongsTo('App\Models\AStNc','estatus_id','id');
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
     * Get the aComentariosNc for this model.
     */
    public function aComentariosNc()
    {
        return $this->hasOne('App\Models\AComentariosNc','no_conformidad_id','id');
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
//    public function getFecPlaneadaAttribute($value)
//    {
//        return date('j/n/Y g:i A', strtotime($value));
//    }

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
