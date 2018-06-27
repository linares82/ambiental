<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'checks';

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
                  'cliente_id',
                  'a_check_id',
                  'solicitud',
                  'detalle',
                  'fec_apertura',
                  'fec_cierre',
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
     * Get the cliente for this model.
     */
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','cliente_id','id');
    }

    /**
     * Get the aCheck for this model.
     */
    public function aCheck()
    {
        return $this->belongsTo('App\Models\ACheck','a_check_id','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }

    /**
     * Get the checkNorma for this model.
     */
    public function normas()
    {
        return $this->belongsToMany('App\Models\Norma', 'check_norma','check_id', 'norma_id');
    }

    /**
     * Get the checkls for this model.
     */
    public function checkls()
    {
        return $this->hasMany('App\Models\Checkl','check_id','id');
    }

    /**
     * Set the fec_apertura.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecAperturaAttribute($value)
    {
        $this->attributes['fec_apertura'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fec_cierre.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecCierreAttribute($value)
    {
        $this->attributes['fec_cierre'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fec_apertura in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecAperturaAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get fec_cierre in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecCierreAttribute($value)
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
