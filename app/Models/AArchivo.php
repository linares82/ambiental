<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class AArchivo extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'a_archivos';

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
                  'archivo',
                  'fec_ini_vigencia',
                  'fec_fin_vigencia',
                  'aviso',
                  'dias_aviso',
                  'responsable_id',
                  'obs',
                  'st_archivo_id',
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
     * Get the caCaDoc for this model.
     */
    public function caCaDoc()
    {
        return $this->belongsTo('App\Models\CaCaDoc','documento_id','id');
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
     * Get the aStArchivo for this model.
     */
    public function aStArchivo()
    {
        return $this->belongsTo('App\Models\AStArchivo','st_archivo_id','id');
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
     * Get the aArchiDocs for this model.
     */
    public function aArchiDocs()
    {
        return $this->hasMany('App\Models\AArchiDoc','a_archivo_id','id');
    }

    /**
     * Get the aComentariosArchivo for this model.
     */
    public function aComentariosArchivo()
    {
        return $this->hasOne('App\Models\AComentariosArchivo','a_archivo_id','id');
    }

    /**
     * Set the fec_ini_vigencia.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecIniVigenciaAttribute($value)
    {
        
        $this->attributes['fec_ini_vigencia'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
        
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
     * Get fec_ini_vigencia in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecIniVigenciaAttribute($value)
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

    public function getFecFinVigencia()
    {
        return date('j/n/Y', strtotime($this->fec_fin_vigencia));
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
