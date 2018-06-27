<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Bnd extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bnds';

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
                  'bnd'
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
     * Get the aArchivos for this model.
     */
    public function aArchivos()
    {
        return $this->hasMany('App\Models\AArchivo','aviso','id');
    }

    /**
     * Get the aProcedimientos for this model.
     */
    public function aProcedimientos()
    {
        return $this->hasMany('App\Models\AProcedimiento','aviso','id');
    }

    /**
     * Get the aRrAmbientales for this model.
     */
    public function aRrAmbientales()
    {
        return $this->hasMany('App\Models\ARrAmbientale','aviso','id');
    }

    /**
     * Get the aspectosAmbientales for this model.
     */
    public function aspectosAmbientales()
    {
        return $this->hasMany('App\Models\AspectosAmbientale','quejas_bnd','id');
    }

    /**
     * Get the bitacoraPendientes for this model.
     */
    public function bitacoraPendientes()
    {
        return $this->hasMany('App\Models\BitacoraPendiente','aviso','id');
    }

    /**
     * Get the bitacoraResiduos for this model.
     */
    public function bitacoraResiduos()
    {
        return $this->hasMany('App\Models\BitacoraResiduo','requiere_vobo','id');
    }

    /**
     * Get the empleados for this model.
     */
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado','bnd_subordinados','id');
    }

    /**
     * Get the mMantenimientos for this model.
     */
    public function mMantenimientos()
    {
        return $this->hasMany('App\Models\MMantenimiento','tpp_bnd','id');
    }

    /**
     * Get the pAmbientalCorreo for this model.
     */
    public function pAmbientalCorreo()
    {
        return $this->hasOne('App\Models\PAmbientalCorreo','bnd_responsable','id');
    }

    /**
     * Get the pCorreoBitacoras for this model.
     */
    public function pCorreoBitacoras()
    {
        return $this->hasMany('App\Models\PCorreoBitacora','bnd_jefe','id');
    }

    /**
     * Get the sDocumento for this model.
     */
    public function sDocumento()
    {
        return $this->hasOne('App\Models\SDocumento','aviso','id');
    }

    /**
     * Get the sProcedimiento for this model.
     */
    public function sProcedimiento()
    {
        return $this->hasOne('App\Models\SProcedimiento','aviso','id');
    }

    /**
     * Get the sRegistro for this model.
     */
    public function sRegistro()
    {
        return $this->hasOne('App\Models\SRegistro','aviso','id');
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
