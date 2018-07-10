<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Entity;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=User::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$users = $r->paginate(25);
		//$users = User::paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $roles=array();
        $rolesRelacionados=array();
        $entities=Entity::pluck('rzon_social', 'id');
        
        return view('users.create', compact('roles', 'rolesRelacionados', 'entities'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UsersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            if(!isset($data['entity_id'])){
                $data['entity_id']=Auth::user()->id;
            }
            if(isset($data['password'])){
                $data['password']=Hash::make($data['password']);
            }
            User::create($data);

            return redirect()->route('users.user.index')
                             ->with('success_message', trans('users.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles=Role::pluck('name', 'id');
        $rolesRelacionados=array();
        foreach($user->roles as $ur){
            $rolesRelacionados=array_add($rolesRelacionados, $ur->id, $ur->name);
        }
        $entities=Entity::pluck('rzon_social', 'id');
        //dd($user);
        return view('users.edit', compact('user', 'roles', 'rolesRelacionados','entities'));
    }
    
    public function editPerfil($id)
    {
        $user = User::findOrFail($id);
        $entities=Entity::pluck('rzon_social', 'id');

        return view('users.perfil', compact('user', 'entities'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UsersFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            if(isset($data['password'])){
                $data['password']=Hash::make($data['password']);
            }elseif(is_null($data['password'])){
                unset($data['password']);
            }
            //dd($data);
            
            $user = User::findOrFail($id);
            if(!isset($data['entity_id'])){
                $data['entity_id']=Auth::user()->id;
            }
            //dd($data);
            $user->update($data);

            return redirect()->route('users.user.index')
                             ->with('success_message', trans('users.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                             ->with('success_message', trans('users.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }

    public function addRol(Request $request){
        if ($request->ajax()) {
            $user=$request->get('user');
            $rol=$request->get('rol');
            $user=User::findOrFail($user);
            $user->roles()->attach($rol);
        }
    }
    
    public function lessRol(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $user=$request->get('user');
            $rol=$request->get('rol');
            $user=User::findOrFail($user);
            $user->roles()->detach($rol);
        }
    }

}
