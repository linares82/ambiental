<?php
namespace YaroslavMolchan\Rbac\Helpers;

use YaroslavMolchan\Rbac\Models\Role;

class CacheHelper {

    /**
     * @param Role $role
     */
    static function get($role) {
        $key = $role->getCacheKey();
        $key = $role->getCacheKey();
//        if (true === \Cache::has($key)) {
            $permissions = $role->permissions()->pluck('slug')->toArray();
        if(count($permissions)>0){
		\Cache::forever($key, $permissions);
	}  
	  
        //}

        return \Cache::get($key);
    }

    /**
     * @param Role $role
     */
    static function clear($role)
    {
        \Cache::forget($role->getCacheKey());
    }
}