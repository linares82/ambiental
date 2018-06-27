<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empleados';

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
                  'ctrl_interno',
                  'nombre',
                  'direccion',
                  'mail',
                  'contacto',
                  'area_id',
                  'puesto_id',
                  'bnd_subordinados',
                  'jefe_id',
                  'user_id',
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
        return $this->belongsTo('App\Models\Bnd','bnd_subordinados','id');
    }

    /**
     * Get the jefe for this model.
     */
    public function jefe()
    {
        return $this->belongsTo('App\Models\Empleado','jefe_id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }

    /**
     * Get the entity for this model.
     */
    public function entity()
    {
        return $this->belongsTo('App\Models\Entity','entity_id','id');
    }

    /**
     * Get the aArchivos for this model.
     */
    public function aArchivos()
    {
        return $this->hasMany('App\Models\AArchivo','responsable_id','id');
    }

    /**
     * Get the aNoConformidades for this model.
     */
    public function aNoConformidades()
    {
        return $this->hasMany('App\Models\ANoConformidade','responsable_id','id');
    }

    /**
     * Get the aProcedimientos for this model.
     */
    public function aProcedimientos()
    {
        return $this->hasMany('App\Models\AProcedimiento','responsable_id','id');
    }

    /**
     * Get the aRrAmbientales for this model.
     */
    public function aRrAmbientales()
    {
        return $this->hasMany('App\Models\ARrAmbientale','responsable_id','id');
    }

    /**
     * Get the bitacoraAccidente for this model.
     */
    public function bitacoraAccidente()
    {
        return $this->hasOne('App\Models\BitacoraAccidente','responsable_id','id');
    }

    /**
     * Get the bitacoraEnfermedade for this model.
     */
    public function bitacoraEnfermedade()
    {
        return $this->hasOne('App\Models\BitacoraEnfermedade','persona_id','id');
    }

    /**
     * Get the bitacoraFfs for this model.
     */
    public function bitacoraFfs()
    {
        return $this->hasMany('App\Models\BitacoraFf','responsable_id','id');
    }

    /**
     * Get the bitacoraPendientes for this model.
     */
    public function bitacoraPendientes()
    {
        return $this->hasMany('App\Models\BitacoraPendiente','responsable_id','id');
    }

    /**
     * Get the bitacoraPlanta for this model.
     */
    public function bitacoraPlanta()
    {
        return $this->hasOne('App\Models\BitacoraPlantum','responsable_id','id');
    }

    /**
     * Get the bitacoraResiduos for this model.
     */
    public function bitacoraResiduos()
    {
        return $this->hasMany('App\Models\BitacoraResiduo','responsable_id','id');
    }

    /**
     * Get the bitacoraSeguridads for this model.
     */
    public function bitacoraSeguridads()
    {
        return $this->hasMany('App\Models\BitacoraSeguridad','responsable_id','id');
    }

    /**
     * Get the mMantenimientos for this model.
     */
    public function mMantenimientos()
    {
        return $this->hasMany('App\Models\MMantenimiento','solicitante_id','id');
    }

    /**
     * Get the pCorreoBitacoras for this model.
     */
    public function pCorreoBitacoras()
    {
        return $this->hasMany('App\Models\PCorreoBitacora','empleado_id','id');
    }

    /**
     * Get the revDocumentoalLn for this model.
     */
    public function revDocumentoalLn()
    {
        return $this->hasOne('App\Models\RevDocumentoalLn','responsable_id','id');
    }

    /**
     * Get the revRequisitosLn for this model.
     */
    public function revRequisitosLn()
    {
        return $this->hasOne('App\Models\RevRequisitosLn','responsable_id','id');
    }

    /**
     * Get the sDocumento for this model.
     */
    public function sDocumento()
    {
        return $this->hasOne('App\Models\SDocumento','responsable_id','id');
    }

    /**
     * Get the sProcedimiento for this model.
     */
    public function sProcedimiento()
    {
        return $this->hasOne('App\Models\SProcedimiento','responsable_id','id');
    }

    /**
     * Get the sRegistro for this model.
     */
    public function sRegistro()
    {
        return $this->hasOne('App\Models\SRegistro','responsable_id','id');
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
