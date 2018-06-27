<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class EncImpacto extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enc_impactos';

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
                  'tipo_impacto_id',
                  'fecha_inicio',
                  'fecha_fin',
                  'notas',
                  'usu_alta_id',
                  'usu_mod_id',
                  'proyecto',
                  'up_calle',
                  'up_no',
                  'up_colonia',
                  'up_cp',
                  'up_delegacion',
                  'up_sup_predio',
                  'od_calle',
                  'od_no',
                  'od_colonia',
                  'od_cp',
                  'od_delegacion',
                  'od_rfc',
                  'od_telefono',
                  'od_correo',
                  'rl_ape_pat',
                  'rl_ape_mat',
                  'rl_nombre',
                  'rl_id_vigente',
                  'rl_id_no',
                  'rl_no_intrumento',
                  'rl_autorizados',
                  'longitud',
                  'latitud',
                  'altitud',
                  'utm_x',
                  'utm_y',
                  'entity_id'
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
     * Get the tipoImpacto for this model.
     */
    public function tipoImpacto()
    {
        return $this->belongsTo('App\Models\TipoImpacto','tipo_impacto_id','id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','usu_mod_id','id');
    }

    /**
     * Get the entity for this model.
     */
    public function entity()
    {
        return $this->belongsTo('App\Models\Entity','entity_id','id');
    }

    /**
     * Get the documento for this model.
     */
    public function documento()
    {
        return $this->hasOne('App\Models\Documento','enc_impacto_id','id');
    }

    /**
     * Get the regImpactos for this model.
     */
    public function lnImpactos()
    {
        return $this->hasMany('App\Models\LnImpacto','enc_impacto_id','id');
    }

    /**
     * Set the fecha_inicio.
     *
     * @param  string  $value
     * @return void
     */
    public function setFechaInicioAttribute($value)
    {
        $this->attributes['fecha_inicio'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Set the fecha_fin.
     *
     * @param  string  $value
     * @return void
     */
    public function setFechaFinAttribute($value)
    {
        $this->attributes['fecha_fin'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    /**
     * Get fecha_inicio in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFechaInicioAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    /**
     * Get fecha_fin in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFechaFinAttribute($value)
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
