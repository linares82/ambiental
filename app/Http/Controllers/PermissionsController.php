<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsFormRequest;
use Exception;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    /**
     * Display a listing of the permissions.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Permission::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$permissions = $r->paginate(25);
		//$permissions = Permission::paginate(25);

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('permissions.create');
    }

    /**
     * Store a new permission in the storage.
     *
     * @param App\Http\Requests\PermissionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PermissionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Permission::create($data);

            return redirect()->route('permissions.permission.index')
                             ->with('success_message', trans('permissions.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permissions.unexpected_error')]);
        }
    }

    /**
     * Display the specified permission.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PermissionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PermissionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $permission = Permission::findOrFail($id);
            $permission->update($data);

            return redirect()->route('permissions.permission.index')
                             ->with('success_message', trans('permissions.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permissions.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified permission from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return redirect()->route('permissions.permission.index')
                             ->with('success_message', trans('permissions.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permissions.unexpected_error')]);
        }
    }



}
