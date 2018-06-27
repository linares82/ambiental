<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class CaAaDoc extends Model
{
    
    use SoftDeletes;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ca_aa_docs';

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
                  'doc',
                  'usu_alta_id',
                  'usu_mod_id',
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
     * Get the aRrAmbientales for this model.
     */
    public function aRrAmbientales()
    {
        return $this->hasMany('App\Models\ARrAmbientale','documento_id','id');
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
