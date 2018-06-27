<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BitacoraAccidente extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bitacora_accidentes';

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
                  'area_id',
                  'responsable_id',
                  'persona_id',
                  'accidente_id',
                  'descripcion',
                  'investigacion',
                  'procedimiento',
                  'accion_id',
                  'costo_directo',
                  'costo_indirecto',
                  'fecha',
                  'anio',
                  'mes',
                  'turno_id',
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
     * Get the area for this model.
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id','id');
    }

    /**
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','persona_id','id');
    }

    /**
     * Get the csAccidente for this model.
     */
    public function csAccidente()
    {
        return $this->belongsTo('App\Models\CsAccidente','accidente_id','id');
    }

    /**
     * Get the csAccione for this model.
     */
    public function csAccione()
    {
        return $this->belongsTo('App\Models\CsAccione','accion_id','id');
    }

    /**
     * Get the turno for this model.
     */
    public function turno()
    {
        return $this->belongsTo('App\Models\Turno','turno_id','id');
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
     * Get the bitDocAccidente for this model.
     */
    public function bitDocAccidente()
    {
        return $this->hasOne('App\Models\BitDocAccidente','bitacora_accidente_id','id');
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
