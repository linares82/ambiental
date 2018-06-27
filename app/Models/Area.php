<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'areas';

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
                  'area',
                  'usu_alta_id',
                  'usu_mod_id',
                  'entity_id'
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
     * Get the entity for this model.
     */
    public function entity()
    {
        return $this->belongsTo('App\Models\Entity','entity_id','id');
    }

    /**
     * Get the aspectosAmbientales for this model.
     */
    public function aspectosAmbientales()
    {
        return $this->hasMany('App\Models\AspectosAmbientale','area_id','id');
    }

    /**
     * Get the bitacoraAccidente for this model.
     */
    public function bitacoraAccidente()
    {
        return $this->hasOne('App\Models\BitacoraAccidente','area_id','id');
    }

    /**
     * Get the bitacoraEnfermedade for this model.
     */
    public function bitacoraEnfermedade()
    {
        return $this->hasOne('App\Models\BitacoraEnfermedade','area_id','id');
    }

    /**
     * Get the bitacoraSeguridads for this model.
     */
    public function bitacoraSeguridads()
    {
        return $this->hasMany('App\Models\BitacoraSeguridad','area_id','id');
    }

    /**
     * Get the empleados for this model.
     */
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado','area_id','id');
    }

    /**
     * Get the revRequisitosLn for this model.
     */
    public function revRequisitosLn()
    {
        return $this->hasOne('App\Models\RevRequisitosLn','area_id','id');
    }

    /**
     * Get the subequipos for this model.
     */
    public function subequipos()
    {
        return $this->hasMany('App\Models\Subequipo','area_id','id');
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
