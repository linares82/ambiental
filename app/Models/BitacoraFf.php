<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BitacoraFf extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bitacora_ffs';

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
                  'ca_fuente_fija_id',
                  'fecha',
                  'anio',
                  'mes',
                  'turno_id',
                  'consumo',
                  'capacidad_diseno',
                  'tp_gases',
                  'tp_chimenea',
                  'fec_ult_manto',
                  'desc_manto',
                  'obs',
                  'responsable_id',
                  'entity_id',
                  'usu_alta_id',
                  'usu_mod_id'
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
     * Get the caFuentesFija for this model.
     */
    public function caFuentesFija()
    {
        return $this->belongsTo('App\Models\CaFuentesFija','ca_fuente_fija_id','id');
    }

    /**
     * Get the turno for this model.
     */
    public function turno()
    {
        return $this->belongsTo('App\Models\Turno','turno_id','id');
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
     * Set the fec_ult_manto.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecUltMantoAttribute($value)
    {
        $this->attributes['fec_ult_manto'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
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
     * Get fec_ult_manto in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecUltMantoAttribute($value)
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
