<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Permission;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionGroupsFormRequest;
use Exception;
use Illuminate\Http\Request;

class PermissionGroupsController extends Controller
{

    /**
     * Display a listing of the permission groups.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=PermissionGroup::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$permissionGroups = $r->paginate(25);
		//$permissionGroups = PermissionGroup::paginate(25);

        return view('permission_groups.index', compact('permissionGroups'));
    }

    /**
     * Show the form for creating a new permission group.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $permissions=array();
        $rolesRelacionados=array();
        
        
        return view('permission_groups.create', compact('permissions', 'rolesRelacionados'));
    }

    /**
     * Store a new permission group in the storage.
     *
     * @param App\Http\Requests\PermissionGroupsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PermissionGroupsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            PermissionGroup::create($data);

            return redirect()->route('permission_groups.permission_group.index')
                             ->with('success_message', trans('permission_groups.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permission_groups.unexpected_error')]);
        }
    }

    /**
     * Display the specified permission group.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $permissionGroup = PermissionGroup::findOrFail($id);

        return view('permission_groups.show', compact('permissionGroup'));
    }

    /**
     * Show the form for editing the specified permission group.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $permissionGroup = PermissionGroup::findOrFail($id);
        
        $permissions=Permission::pluck('name', 'id');
        $permisosRelacionados=array();
        foreach($permissionGroup->permissions as $pr){
            $permisosRelacionados=array_add($permisosRelacionados, $pr->id, $pr->name);
        }
        $roles=Role::pluck('name', 'id');
        $rolesRelacionados=array();
        foreach($permissionGroup->roles as $rr){
            $rolesRelacionados=array_add($rolesRelacionados, $rr->id, $rr->name);
        }
        //dd($permisosRelacionados);
        return view('permission_groups.edit', compact('permissionGroup', 'permissions', 
                                                      'roles', 'permisosRelacionados',
                                                      'rolesRelacionados'));
    }

    /**
     * Update the specified permission group in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PermissionGroupsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PermissionGroupsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $permissionGroup = PermissionGroup::findOrFail($id);
            $permissionGroup->update($data);

            return redirect()->route('permission_groups.permission_group.index')
                             ->with('success_message', trans('permission_groups.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permission_groups.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified permission group from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $permissionGroup = PermissionGroup::findOrFail($id);
            $permissionGroup->delete();

            return redirect()->route('permission_groups.permission_group.index')
                             ->with('success_message', trans('permission_groups.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permission_groups.unexpected_error')]);
        }
    }

    public function addPermission(Request $request){
        if ($request->ajax()) {
            $permission=$request->get('permission');
            $permission_group=$request->get('permission_group');
            $pg=PermissionGroup::findOrFail($permission_group);
            $pg->permissions()->attach($permission);
        }
    }
    
    public function lessPermission(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $permission=$request->get('permission');
            $permission_group=$request->get('permission_group');
            $pg=PermissionGroup::findOrFail($permission_group);
            $pg->permissions()->detach($permission);
        }
    }
    
    public function addRole(Request $request){
        if ($request->ajax()) {
            $role=$request->get('rol');
            $permission_group=$request->get('permission_group');
            $pg=PermissionGroup::findOrFail($permission_group);
            $pg->roles()->attach($role);
        }
    }
    
    public function lessRole(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $role=$request->get('rol');
            $permission_group=$request->get('permission_group');
            $pg=PermissionGroup::findOrFail($permission_group);
            $pg->roles()->detach($role);
        }
    }

}
