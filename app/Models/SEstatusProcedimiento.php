<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SEstatusProcedimiento extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 's_estatus_procedimientos';

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
     * Get the sComentariosDocumentos for this model.
     */
    public function sComentariosDocumentos()
    {
        return $this->hasMany('App\Models\SComentariosDocumento','estatus_id','id');
    }

    /**
     * Get the sComentariosProcedimiento for this model.
     */
    public function sComentariosProcedimiento()
    {
        return $this->hasOne('App\Models\SComentariosProcedimiento','estatus_id','id');
    }

    /**
     * Get the sComentariosRegistro for this model.
     */
    public function sComentariosRegistro()
    {
        return $this->hasOne('App\Models\SComentariosRegistro','estatus_id','id');
    }

    /**
     * Get the sDocumento for this model.
     */
    public function sDocumento()
    {
        return $this->hasOne('App\Models\SDocumento','estatus_id','id');
    }

    /**
     * Get the sProcedimiento for this model.
     */
    public function sProcedimiento()
    {
        return $this->hasOne('App\Models\SProcedimiento','estatus_id','id');
    }

    /**
     * Get the sRegistro for this model.
     */
    public function sRegistro()
    {
        return $this->hasOne('App\Models\SRegistro','estatus_id','id');
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
