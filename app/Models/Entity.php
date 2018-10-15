<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entities';

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
                  'rzon_social',
                  'responsable',
                  'dir1',
                  'dir2',
                  'rfc',
                  'abreviatura',
                  'logo',
                  'usu_alta_id',
                  'usu_mod_id',
                  'multi_entidad',
                  'entidad_id',
                  'tema',
                  'tipo_entity_id',
                  'filtred_by_entity'
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
     * Get the entidad for this model.
     */
    public function entidad()
    {
        return $this->belongsTo('App\Models\Entidad','entidad_id');
    }

    /**
     * Get the aArchivos for this model.
     */
    public function aArchivos()
    {
        return $this->hasMany('App\Models\AArchivo','cia_id','id');
    }

    /**
     * Get the aNoConformidades for this model.
     */
    public function aNoConformidades()
    {
        return $this->hasMany('App\Models\ANoConformidade','cia_id','id');
    }

    /**
     * Get the aProcedimientos for this model.
     */
    public function aProcedimientos()
    {
        return $this->hasMany('App\Models\AProcedimiento','cia_id','id');
    }

    /**
     * Get the aRrAmbientales for this model.
     */
    public function aRrAmbientales()
    {
        return $this->hasMany('App\Models\ARrAmbientale','cia_id','id');
    }

    /**
     * Get the areas for this model.
     */
    public function areas()
    {
        return $this->hasMany('App\Models\Area','cia_id','id');
    }

    /**
     * Get the aspectosAmbientales for this model.
     */
    public function aspectosAmbientales()
    {
        return $this->hasMany('App\Models\AspectosAmbientale','cia_id','id');
    }

    /**
     * Get the bitacoraAccidente for this model.
     */
    public function bitacoraAccidente()
    {
        return $this->hasOne('App\Models\BitacoraAccidente','cia_id','id');
    }

    /**
     * Get the bitacoraConsumibles for this model.
     */
    public function bitacoraConsumibles()
    {
        return $this->hasMany('App\Models\BitacoraConsumible','cia_id','id');
    }

    /**
     * Get the bitacoraEnfermedades for this model.
     */
    public function bitacoraEnfermedades()
    {
        return $this->hasMany('App\Models\BitacoraEnfermedade','cia_id','id');
    }

    /**
     * Get the bitacoraFfs for this model.
     */
    public function bitacoraFfs()
    {
        return $this->hasMany('App\Models\BitacoraFf','cia_id','id');
    }

    /**
     * Get the bitacoraPendientes for this model.
     */
    public function bitacoraPendientes()
    {
        return $this->hasMany('App\Models\BitacoraPendiente','cia_id','id');
    }

    /**
     * Get the bitacoraPlantas for this model.
     */
    public function bitacoraPlantas()
    {
        return $this->hasMany('App\Models\BitacoraPlantum','cia_id','id');
    }

    /**
     * Get the bitacoraResiduos for this model.
     */
    public function bitacoraResiduos()
    {
        return $this->hasMany('App\Models\BitacoraResiduo','cia_id','id');
    }

    /**
     * Get the bitacoraSeguridads for this model.
     */
    public function bitacoraSeguridads()
    {
        return $this->hasMany('App\Models\BitacoraSeguridad','cia_id','id');
    }

    /**
     * Get the empleados for this model.
     */
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado','cia_id','id');
    }

    /**
     * Get the encImpactos for this model.
     */
    public function encImpactos()
    {
        return $this->hasMany('App\Models\EncImpacto','cia_id','id');
    }

    /**
     * Get the mMantenimientos for this model.
     */
    public function mMantenimientos()
    {
        return $this->hasMany('App\Models\MMantenimiento','cia_id','id');
    }

    /**
     * Get the pCorreoBitacoras for this model.
     */
    public function pCorreoBitacoras()
    {
        return $this->hasMany('App\Models\PCorreoBitacora','cia_id','id');
    }

    /**
     * Get the revDocumentals for this model.
     */
    public function revDocumentals()
    {
        return $this->hasMany('App\Models\RevDocumental','cia_id','id');
    }

    /**
     * Get the revRequisitos for this model.
     */
    public function revRequisitos()
    {
        return $this->hasMany('App\Models\RevRequisito','cia_id','id');
    }

    /**
     * Get the sDocumento for this model.
     */
    public function sDocumento()
    {
        return $this->hasOne('App\Models\SDocumento','cia_id','id');
    }

    /**
     * Get the sProcedimiento for this model.
     */
    public function sProcedimiento()
    {
        return $this->hasOne('App\Models\SProcedimiento','cia_id','id');
    }

    /**
     * Get the sRegistro for this model.
     */
    public function sRegistro()
    {
        return $this->hasOne('App\Models\SRegistro','cia_id','id');
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
