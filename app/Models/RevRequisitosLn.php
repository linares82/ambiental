<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class RevRequisitosLn extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rev_requisitos_lns';

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
                  'rev_requisitos_id',
                  'impacto_id',
                  'condicion_id',
                  'area_id',
                  'norma',
                  'estatus_id',
                  'importancia_id',
                  'responsable_id',
                  'dias_advertencia1',
                  'dias_advertencia2',
                  'dias_advertencia3',
                  'fec_cumplimiento',
                  'observaciones',
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
     * Get the revRequisito for this model.
     */
    public function revRequisito()
    {
        return $this->belongsTo('App\Models\RevRequisito','rev_requisitos_id','id');
    }

    /**
     * Get the aaImpacto for this model.
     */
    public function aaImpacto()
    {
        return $this->belongsTo('App\Models\AaImpacto','impacto_id','id');
    }

    /**
     * Get the condicione for this model.
     */
    public function condicione()
    {
        return $this->belongsTo('App\Models\Condicione','condicion_id','id');
    }

    /**
     * Get the area for this model.
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id','id');
    }

    /**
     * Get the estatusCondicione for this model.
     */
    public function estatusCondicione()
    {
        return $this->belongsTo('App\Models\EstatusCondicione','estatus_id','id');
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
     * Get fec_cumplimiento in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecCumplimientoAttribute($value)
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
