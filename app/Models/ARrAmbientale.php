<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ARrAmbientale extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'a_rr_ambientales';

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
                  'material_id',
                  'categoria_id',
                  'documento_id',
                  'descripcion',
                  'fec_fin_vigencia',
                  'archivo',
                  'aviso',
                  'dias_aviso',
                  'responsable_id',
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
    protected $dates = ['fec_fin_vigencia','deleted_at', 'updated_at', 'created_at'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the caMaterial for this model.
     */
    public function caMaterial()
    {
        return $this->belongsTo('App\Models\CaMaterial','material_id','id');
    }

    /**
     * Get the caCategoria for this model.
     */
    public function caCategoria()
    {
        return $this->belongsTo('App\Models\CaCategoria','categoria_id','id');
    }

    /**
     * Get the caAaDoc for this model.
     */
    public function caAaDoc()
    {
        return $this->belongsTo('App\Models\CaAaDoc','documento_id','id');
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
     * Get the aComentariosRr for this model.
     */
    public function aComentariosRr()
    {
        return $this->hasOne('App\Models\AComentariosRr','a_rr_id','id');
    }

    /**
     * Get the aRrAmbDocs for this model.
     */
    public function aRrAmbDocs()
    {
        return $this->hasMany('App\Models\ARrAmbDoc','a_rr_ambiental_id','id');
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
