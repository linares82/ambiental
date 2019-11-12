<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BitacoraResiduo extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bitacora_residuos';

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
                  'residuo',
                  'cantidad',
                  'fecha',
                  'anio',
                  'mes',
                  'lugar_generacion',
                  'ubicacion',
                  'dispocision',
                  'transportista',
                  'manifiesto',
                  'resp_tecnico',
                  'requiere_vobo',
                  'registro_residuos',
                  'peligrosidad',
                  'fec_ingreso',
                  'cedula_operacion',
                  'factor_indicador',
                  'factor_calculado',
                  'responsable_id',
                  'entity_id',
                  'usu_alta_id',
                  'usu_mod_id',
                  'fec_salida',
                  'aut_transportista'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha','deleted_at', 'updated_at', 'created_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the caResiduo for this model.
     */
    public function caResiduo()
    {
        return $this->belongsTo('App\Models\CaResiduo','residuo','id');
    }

    /**
     * Get the bnd for this model.
     */
    public function bnd()
    {
        return $this->belongsTo('App\Models\Bnd','cedula_operacion','id');
    }

    /**
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','responsable_id','id');
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
     * Set the fec_ingreso.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecIngresoAttribute($value)
    {
        $this->attributes['fec_ingreso'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fec_salida.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecSalidaAttribute($value)
    {
        $this->attributes['fec_salida'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fecha in array format
     *
     * @param  string  $value
     * @return array
     */
//    public function getFechaAttribute($value)
//    {
//        return date('j/n/Y g:i A', strtotime($value));
//    }

    /**
     * Get fec_ingreso in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecIngresoAttribute($value)
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

    /**
     * Get fec_salida in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecSalidaAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

}
