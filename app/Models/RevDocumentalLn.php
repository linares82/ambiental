<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class RevDocumentalLn extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rev_documental_lns';

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
                  'rev_documental_id',
                  'tpo_documento_id',
                  'documento_id',
                  'grupo_norma_id',
                  'norma_id',
                  'estatus_id',
                  'importancia_id',
                  'responsable_id',
                  'dias_advertencia1',
                  'dias_advertencia2',
                  'dias_advertencia3',
                  'fec_cumplimiento',
                  'fec_vencimiento',
                  'archivo',
                  'observaciones',
                  'usu_alta_id',
                  'usu_mod_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fec_cumplimiento','fec_vencimiento','created_at','updated_at','deleted_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the revDocumental for this model.
     */
    public function revDocumental()
    {
        return $this->belongsTo('App\Models\RevDocumental','rev_documental_id','id');
    }

    /**
     * Get the tpoDoc for this model.
     */
    public function tpoDoc()
    {
        return $this->belongsTo('App\Models\TpoDoc','tpo_documento_id','id');
    }

    /**
     * Get the rDocumento for this model.
     */
    public function rDocumento()
    {
        return $this->belongsTo('App\Models\RDocumento','documento_id','id');
    }

    /**
     * Get the csGrupoNorma for this model.
     */
    public function csGrupoNorma()
    {
        return $this->belongsTo('App\Models\CsGrupoNorma','grupo_norma_id','id');
    }

    /**
     * Get the csNorma for this model.
     */
    public function csNorma()
    {
        return $this->belongsTo('App\Models\CsNorma','norma_id','id');
    }

    /**
     * Get the estatusRequisito for this model.
     */
    public function estatusRequisito()
    {
        return $this->belongsTo('App\Models\EstatusRequisito','estatus_id','id');
    }

    /**
     * Get the importancium for this model.
     */
    public function importancium()
    {
        return $this->belongsTo('App\Models\Importancium','importancia_id','id');
    }

    /**
     * Get the empleado for this model.
     */
    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado','responsable_id','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }
    
    public function files()
    {
        return $this->hasMany('App\Models\FilesRevDocumentalLn', 'rev_documental_ln_id','id');
    }

    /**
     * Set the fec_cumplimiento.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecCumplimientoAttribute($value)
    {
        $this->attributes['fec_cumplimiento'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fec_vencimiento.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecVencimientoAttribute($value)
    {
        $this->attributes['fec_vencimiento'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fec_cumplimiento in array format
     *
     * @param  string  $value
     * @return array
     */
//    public function getFecCumplimientoAttribute($value)
//    {
//        return date('j/n/Y g:i A', strtotime($value));
//    }

    /**
     * Get fec_vencimiento in array format
     *
     * @param  string  $value
     * @return array
     */
//    public function getFecVencimientoAttribute($value)
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
