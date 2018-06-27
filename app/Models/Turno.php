<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Turno extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'turnos';

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
                  'turno',
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
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }

    /**
     * Get the bitacoraAccidente for this model.
     */
    public function bitacoraAccidente()
    {
        return $this->hasOne('App\Models\BitacoraAccidente','turno_id','id');
    }

    /**
     * Get the bitacoraEnfermedades for this model.
     */
    public function bitacoraEnfermedades()
    {
        return $this->hasMany('App\Models\BitacoraEnfermedade','turno_id','id');
    }

    /**
     * Get the bitacoraFfs for this model.
     */
    public function bitacoraFfs()
    {
        return $this->hasMany('App\Models\BitacoraFf','turno_id','id');
    }

    /**
     * Get the bitacoraPlantas for this model.
     */
    public function bitacoraPlantas()
    {
        return $this->hasMany('App\Models\BitacoraPlantum','turno_id','id');
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
