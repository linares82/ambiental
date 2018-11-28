<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SDocumentosLeye extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 's_documentos_leyes';

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
                  'documento_id',
                  'descripcion',
                  'fec_inicio_vigencia',
                  'fec_fin_vigencia',
                  'aviso',
                  'dias_aviso',
                  'entity_id',
                  'activo',
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
     * Get the csCatDoc for this model.
     */
    public function csCatDoc()
    {
        return $this->belongsTo('App\Models\CsCatDoc','documento_id','id');
    }

    /**
     * Get the bnd for this model.
     */
    public function bnd()
    {
        return $this->belongsTo('App\Models\Bnd','aviso','id');
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
     * Set the fec_inicio_vigencia.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecInicioVigenciaAttribute($value)
    {
        $this->attributes['fec_inicio_vigencia'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
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
     * Get fec_inicio_vigencia in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecInicioVigenciaAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get fec_fin_vigencia in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecFinVigenciaAttribute($value)
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
