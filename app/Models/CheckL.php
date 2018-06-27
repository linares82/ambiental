<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CheckL extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'check_ls';

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
                  'check_id',
                  'a_check_id',
                  'norma_id',
                  'no_conformidad',
                  'especifico',
                  'requisito',
                  'rnc',
                  'minimo_vsm',
                  'maximo_vsm',
                  'cumplimiento',
                  'monto_min',
                  'monto_medio',
                  'monto_max',
                  'correccion',
                  'correccion_detallada',
                  't_semanas',
                  'responsable',
                  'monto_estimado',
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
     * Get the check for this model.
     */
    public function check()
    {
        return $this->belongsTo('App\Models\Check','check_id','id');
    }

    /**
     * Get the aCheck for this model.
     */
    public function aCheck()
    {
        return $this->belongsTo('App\Models\ACheck','a_check_id','id');
    }

    /**
     * Get the norma for this model.
     */
    public function norma()
    {
        return $this->belongsTo('App\Models\Norma','norma_id','id');
    }

    /**
     * Get the cumplimiento for this model.
     */
    public function cumplimiento()
    {
        return $this->belongsTo('App\Models\Cumplimiento','cumplimiento','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
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
