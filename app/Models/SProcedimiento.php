<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SProcedimiento extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 's_procedimientos';

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
                  'tpo_procedimiento_id',
                  'tpo_doc_id',
                  'descripcion',
                  'archivo',
                  'aviso',
                  'dias_aviso',
                  'responsable_id',
                  'fec_fin_vigencia',
                  'estatus_id',
                  'entity_id',
                  'usu_alta_id',
                  'usu_mod_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fec_fin_vigencia','deleted_at', 'updated_at', 'created_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the csTpoProcedimiento for this model.
     */
    public function csTpoProcedimiento()
    {
        return $this->belongsTo('App\Models\CsTpoProcedimiento','tpo_procedimiento_id','id');
    }

    /**
     * Get the csTpoDoc for this model.
     */
    public function csTpoDoc()
    {
        return $this->belongsTo('App\Models\CsTpoDoc','tpo_doc_id','id');
    }

    /**
     * Get the bnd for this model.
     */
    public function bnd()
    {
        return $this->belongsTo('App\Models\Bnd','aviso','id');
    }

    /**
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','responsable_id','id');
    }

    /**
     * Get the sEstatusProcedimiento for this model.
     */
    public function sEstatusProcedimiento()
    {
        return $this->belongsTo('App\Models\SEstatusProcedimiento','estatus_id','id');
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
     * Get the sComentariosProcedimiento for this model.
     */
    public function sComentariosProcedimiento()
    {
        return $this->hasOne('App\Models\SComentariosProcedimiento','s_procedimiento_id','id');
    }

    /**
     * Set the fec_fin_vigencia.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecFinVigenciaAttribute($value)
    {
        $this->attributes['fec_fin_vigencia'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fec_fin_vigencia in array format
     *
     * @param  string  $value
     * @return array
     */
//    public function getFecFinVigenciaAttribute($value)
//    {
//        return date('j/n/Y g:i A', strtotime($value));
//    }

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
