<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AStArchivo extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'a_st_archivos';

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
                  'estatus',
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
     * Get the aArchivos for this model.
     */
    public function aArchivos()
    {
        return $this->hasMany('App\Models\AArchivo','st_archivo_id','id');
    }

    /**
     * Get the aComentariosArchivos for this model.
     */
    public function aComentariosArchivos()
    {
        return $this->hasMany('App\Models\AComentariosArchivo','a_st_archivo_id','id');
    }

    /**
     * Get the aComentariosProcedimientos for this model.
     */
    public function aComentariosProcedimientos()
    {
        return $this->hasMany('App\Models\AComentariosProcedimiento','a_st_procedimiento_id','id');
    }

    /**
     * Get the aProcedimiento for this model.
     */
    public function aProcedimiento()
    {
        return $this->hasOne('App\Models\AProcedimiento','st_archivo_id','id');
    }

    /**
     * Get the aRrAmbientales for this model.
     */
    public function aRrAmbientales()
    {
        return $this->hasMany('App\Models\ARrAmbientale','st_archivo_id','id');
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
