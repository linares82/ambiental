<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\PermissionGroup;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesFormRequest;
use Exception;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Role::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$roles = $r->paginate(25);
		//$roles = Role::paginate(25);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        return view('roles.create');
    }

    /**
     * Store a new role in the storage.
     *
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RolesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Role::create($data);

            return redirect()->route('roles.role.index')
                             ->with('success_message', trans('roles.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
        }
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $users=User::pluck('name', 'id');
        $usersRelacionados=array();
        foreach($role->users as $ur){
            $usersRelacionados=array_add($usersRelacionados, $ur->id, $ur->name);
        }
        $grupos=PermissionGroup::pluck('name', 'id');
        $gruposRelacionados=array();
        foreach($role->grupos as $gr){
            $gruposRelacionados=array_add($gruposRelacionados, $gr->id, $gr->name);
        }
        $permisos=Permission::pluck('name', 'id');
        $permisosRelacionados=array();
        foreach($role->permissions as $pr){
            $permisosRelacionados=array_add($permisosRelacionados, $pr->id, $pr->name);
        }

        return view('roles.edit', compact('role', 'usersRelacionados', 'users', 'gruposRelacionados', 'grupos', 'permisos', 'permisosRelacionados'));
    }

    /**
     * Update the specified role in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RolesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $role = Role::findOrFail($id);
            $role->update($data);

            return redirect()->route('roles.role.index')
                             ->with('success_message', trans('roles.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified role from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.role.index')
                             ->with('success_message', trans('roles.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
        }
    }

    public function addUser(Request $request){
        if ($request->ajax()) {
            $user=$request->get('user');
            $rol=$request->get('rol');
            $rol=Role::findOrFail($rol);
            $rol->users()->attach($user);
        }
    }
    
    public function lessUser(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $user=$request->get('user');
            $rol=$request->get('rol');
            $rol=Role::findOrFail($rol);
            $rol->users()->detach($user);
        }
    }
    
    public function addPermission(Request $request){
        if ($request->ajax()) {
            $permission=$request->get('permission');
            $rol=$request->get('rol');
            $rol=Role::findOrFail($rol);
            $rol->permissions()->attach($permission);
        }
    }
    
    public function lessPermission(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $permission=$request->get('permission');
            $rol=$request->get('rol');
            $rol=Role::findOrFail($rol);
            $rol->permissions()->detach($permission);
        }
    }
    
    public function addGroup(Request $request){
        if ($request->ajax()) {
            $grupo=$request->get('grupo');
            $rol=$request->get('rol');
            $rol=Role::findOrFail($rol);
            $rol->grupos()->attach($grupo);
        }
    }
    
    public function lessGroup(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $grupo=$request->get('grupo');
            $rol=$request->get('rol');
            $rol=Role::findOrFail($rol);
            $rol->grupos()->detach($grupo);
        }
    }

}
