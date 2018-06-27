<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
                  'slug',
                  'name'
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
     * Get the permissionGroupRole for this model.
     */
    /*public function permissionGroupRole()
    {
        return $this->hasOne('App\Models\PermissionGroupRole','role_id','id');
    }*/
    
    public function grupos()
    {
        return $this->belongsToMany('App\Models\PermissionGroup','permission_group_role','role_id', 'permission_group_id');
    }

    /**
     * Get the permissionRole for this model.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role','role_id','permission_id');
    }

    /**
     * Get the roleUser for this model.
     */
    /*public function roleUser()
    {
        return $this->hasOne('App\Models\RoleUser','role_id','id');
    }*/
    
    public function users()
    {
        return $this->belongsToMany('App\Models\User','role_user','role_id', 'user_id');
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

}
