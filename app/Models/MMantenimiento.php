<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class MMantenimiento extends Model
{

    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'm_mantenimientos';

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
        'no_orden',
        'codigo',
        'm_tpo_manto_id',
        'objetivo_id',
        'subequipo_id',
        'solicitante_id',
        'fec_planeada',
        'aviso_bnd',
        'dias_aviso',
        'fec_inicio',
        'descripcion',
        'lugar',
        'ejecutor_id',
        'responsable_id',
        'recomendaciones',
        'materiales',
        'horas_inv',
        'costo',
        'tpp_bnd',
        'riesgos',
        'supervision_bnd',
        'conoce_procedimiento_bnd',
        'lleva_equipo_bnd',
        'cumple_puntos_bnd',
        'estatus_id',
        'eventualidades_bnd',
        'levantar_formato_bnd',
        'registro_bitacora_bnd',
        'accion',
        'resultado',
        'fec_final',
        'observaciones',
        'entity_id',
        'usu_alta_id',
        'usu_mod_id',
        'hora_inicio',
        'hora_fin'
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
     * Get the mTpoManto for this model.
     */
    public function mTpoManto()
    {
        return $this->belongsTo('App\Models\MTpoManto', 'm_tpo_manto_id', 'id');
    }

    /**
     * Get the mObjetivo for this model.
     */
    public function mObjetivo()
    {
        return $this->belongsTo('App\Models\MObjetivo', 'objetivo_id', 'id');
    }

    /**
     * Get the subequipo for this model.
     */
    public function subequipo()
    {
        return $this->belongsTo('App\Models\Subequipo', 'subequipo_id', 'id');
    }

    /**
     * Get the empleado for this model.
     */
    public function solicitante()
    {
        return $this->belongsTo('App\Models\Empleado', 'solicitante_id', 'id');
    }

    public function ejecutor()
    {
        return $this->belongsTo('App\Models\Empleado', 'ejecutor_id', 'id');
    }

    public function responsable()
    {
        return $this->belongsTo('App\Models\Empleado', 'responsable_id', 'id');
    }



    /**
     * Get the bnd for this model.
     */
    public function tpp()
    {
        return $this->belongsTo('App\Models\Bnd', 'tpp_bnd', 'id');
    }

    public function supervision()
    {
        return $this->belongsTo('App\Models\Bnd', 'supervision_bnd', 'id');
    }

    public function conoceProcedimiento()
    {
        return $this->belongsTo('App\Models\Bnd', 'conoce_procedimiento_bnd', 'id');
    }

    public function llevaEquipo()
    {
        return $this->belongsTo('App\Models\Bnd', 'lleva_equipo_bnd', 'id');
    }

    public function cumplePuntos()
    {
        return $this->belongsTo('App\Models\Bnd', 'cumple_puntos_bnd', 'id');
    }

    public function eventualidades()
    {
        return $this->belongsTo('App\Models\Bnd', 'eventualidades_bnd', 'id');
    }

    public function levantarFormato()
    {
        return $this->belongsTo('App\Models\Bnd', 'levantar_formato_bnd', 'id');
    }

    public function registroBitacora()
    {
        return $this->belongsTo('App\Models\Bnd', 'registro_bitacora_bnd', 'id');
    }
    /**
     * Get the mEstatus for this model.
     */
    public function mEstatus()
    {
        return $this->belongsTo('App\Models\MEstatus', 'estatus_id', 'id');
    }

    /**
     * Get the entity for this model.
     */
    public function entity()
    {
        return $this->belongsTo('App\Models\Entity', 'entity_id', 'id');
    }

    /**
     * Get the user for this model.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'usu_mod_id', 'id');
    }

    /**
     * Get the mantoDocs for this model.
     */
    public function mantoDocs()
    {
        return $this->hasMany('App\Models\MantoDoc', 'mantenimiento_id', 'id');
    }

    /**
     * Set the fec_planeada.
     *
     * @param  string  $value
     * @return void
     */
    public function setFecPlaneadaAttribute($value)
    {
        $this->attributes['fec_planeada'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    public function setFecInicioAttribute($value)
    {
        $this->attributes['fec_inicio'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }

    public function setFecFinalAttribute($value)
    {
        $this->attributes['fec_final'] = !empty($value) ? date($this->getDateFormat(), strtotime($value)) : null;
    }


    /**
     * Get fec_planeada in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getFecPlaneadaAttribute($value)
    {
        if (is_null($value)) {
            return null;
        } else {
            return date('d/m/Y', strtotime($value));
        }
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

    public function getFecFinalAttribute($value)
    {
        if (is_null($value)) {
            return null;
        } else {
            return date('d/m/Y', strtotime($value));
        }
    }

    public function getFecInicioAttribute($value)
    {
        if (is_null($value)) {
            return null;
        } else {
            return date('d/m/Y', strtotime($value));
        }
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
