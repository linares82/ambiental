<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permission_groups';

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
                  'name',
                  'module'
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
    public function permissionGroupRole()
    {
        return $this->hasOne('App\Models\PermissionGroupRole','permission_group_id','id');
    }

    /**
     * Get the permissionPermissionGroup for this model.
     */
    /*
    public function permissionPermissionGroup()
    {
        return $this->hasOne('App\Models\PermissionPermissionGroup','permission_group_id','id');
    }
    */
    
    public function permissions(){
        return $this->belongsToMany('App\Models\Permission','permission_permission_group','permission_group_id','permission_id');
    }
    
    public function roles(){
        return $this->belongsToMany('App\Models\Role','permission_group_role','permission_group_id','role_id');
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
