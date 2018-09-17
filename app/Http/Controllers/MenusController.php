<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Entity;
use App\Models\Permisssion;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenusFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MenusController extends Controller
{
	public $menuArmado = "";
        public $ids=array();
    /**
     * Display a listing of the menus.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Menu::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$menus = $r->with('permiso','user')->paginate(25);
		//$menus = Menu::with('permiso','user')->paginate(25);

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $permisos = Permisssion::pluck('id','id')->all();
$users = User::pluck('id','id')->all();
        
        return view('menus.create', compact('permisos','users','users'));
    }

    /**
     * Store a new menu in the storage.
     *
     * @param App\Http\Requests\MenusFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MenusFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Menu::create($data);

            return redirect()->route('menus.menu.index')
                             ->with('success_message', trans('menus.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('menus.unexpected_error')]);
        }
    }

    /**
     * Display the specified menu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $menu = Menu::with('permiso','user')->findOrFail($id);

        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $permisos = Permission::pluck('id','id')->all();
$users = User::pluck('id','id')->all();

        return view('menus.edit', compact('menu','permisos','users','users'));
    }

    /**
     * Update the specified menu in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MenusFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MenusFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $menu = Menu::findOrFail($id);
            $menu->update($data);

            return redirect()->route('menus.menu.index')
                             ->with('success_message', trans('menus.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('menus.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified menu from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return redirect()->route('menus.menu.index')
                             ->with('success_message', trans('menus.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('menus.unexpected_error')]);
        }
    }


    public function armaMenu($padre = 1) {
        
        $this->getEntityName();
        /*if (session()->has('menu')) {
            return session('menu');
        } else {
         * 
         */
            $m = $this->armaMenuPrincipal();
            session(['menu' => $m]);

            //dd($this->menuArmado);
            return session('menu');
            //return $this->menuArmado;
        //}
    }

    public function armaMenuPrincipal($padre = 1) {
        $permiso = false;
        //$menu=$this->menuRepository->search(array('padre'=>$padre));
        //$usuario_actual=User::find(Auth::user()->id)->is('admin');
        $menu = Menu::where('depende_de', $padre)
                        ->where('activo', true)
                        ->orderBy('orden', 'asc')->get();

        //dd($menu);

        if (!empty($menu)) {
            //dd($menu);
            foreach ($menu as $item) {
                $permiso=false;
                //$permiso=User::find(Auth::user()->id)->can($item->permiso);
                $autenticado = Auth::user();
                //Log::info($autenticado);
                //dd($item);
                if ($item->permiso_id != "home" and $item->permiso_id != "logout") {
                    //Log::info($item->permiso_id);
                    
                    if (Auth::check()) {
                        //dd(Auth::user()->canDo('permissions.permission.index'));
                        $permiso = Auth::user()->canDo($item->permiso_id);
                        //dd($permiso);
                    }
                    
                } else {
                    //Log::info("Sin permiso para ".$item->permiso_id);
                    //dd($item->permiso);
                    $permiso = true;
                }
                $link = route($item->link);
                //dd($permiso);
                if ($permiso and $item->activo == 1) {
                    //dd($item->id);
                    $r = intval($this->tieneItems($item->id));
                    //dd(action($item->link));

                    if ($r == 1) {
                        if ($item->parametros == "_blank") {
                            $this->menuArmado = $this->menuArmado . "<li class='dropdown-toggle' id='".$item->id."'>
									                <a href=' " . $link . " ' target='" . $item->parametros . "' class='dropdown-toggle'>
                                                                                            <i class='menu-icon " . $item->imagen . "'></i><span class='menu-text'>" . $item->item . "</span> <b class='arrow fa fa-angle-down'></b>
											</a>
													
									                <ul class='submenu'>";
                        } else {
                            $this->menuArmado = $this->menuArmado . "<li class='dropdown-toggle' id='".$item->id."'>
									                <a href=' " . $link . " ' class='dropdown-toggle'>
                                                                                            <i class='menu-icon " . $item->imagen . "'></i><span class='menu-text'>" . $item->item . "</span> </i><b class='arrow fa fa-angle-down'></b>
											</a>
									                <ul class='submenu'>";
                        }

                        $this->menuArmado = $this->armaMenuPrincipal($item->id);
                        $this->menuArmado = $this->menuArmado . "</ul></li>";
                    } else {
                        //dd($this->menuArmado);
                        $uri = $_SERVER['REQUEST_URI'];
                        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        
                        if($url==$link){
                            if ($item->parametros == "_blank") {
                            $this->menuArmado = $this->menuArmado . "<li class='active' id='".$item->id."' ><a href='" . $link . "' target='" . $item->parametros . "'><i class='menu-icon " . $item->imagen . "'></i><span class='menu-text'>" . $item->item . "</span></a><b class='arrow'></b></li>";
                            } else {
                                $this->menuArmado = $this->menuArmado . "<li class='active' id='".$item->id."' ><a href='" . $link . "'><i class='menu-icon " . $item->imagen . "'></i><span class='menu-text'>" . $item->item . "</span></a><b class='arrow'></b></li>";
                            }
                        }else{
                            if ($item->parametros == "_blank") {
                                $this->menuArmado = $this->menuArmado . "<li class='' id='".$item->id."'><a href='" . $link . "' target='" . $item->parametros . "'><i class='menu-icon " . $item->imagen . "'></i><span class='menu-text'>" . $item->item . "</span></a><b class='arrow'></b></li>";
                            } else {
                                $this->menuArmado = $this->menuArmado . "<li class='' id='".$item->id."'><a href='" . $link . "'><i class='menu-icon " . $item->imagen . "'></i><span class='menu-text'>" . $item->item . "</span></a><b class='arrow'></b></li>";
                            }
                        }
                        
                    }
                    //Log::info($this->menuArmado);
                }
            }
            return $this->menuArmado;
        }


        //dd($this->menuArmado);
        //return $this->menuArmado;
    }

    public function tieneItems($padre) {
        $menu = Menu::where('depende_de', $padre)->where('activo', true)->count();

        //dd($menu);
        if ($menu == 0) {
            return -1;
        } else {
            return 1;
        }
    }

    public function getEntityName(){
        //dd(Entity::find(Auth::user()->entity_id)->value('rzon_social'));
        //return Auth::user()->entity_id;
        $entidad= Entity::find(Auth::user()->entity_id);
        //dd($entidad);
        return $entidad->abreviatura;
    }

    public function clasesMenu(Request $request){
        $ids=$this->getIds($request->get('id'));
        echo json_encode($this->ids);
    }
    
    public function getIds($id){
        $opt=Menu::find($id);
        
        if($opt->depende_de>1){
            //$this->ids=$this->ids.$opt->depende_de.",";
            array_push($this->ids,$opt->depende_de);
            $this->getIds($opt->depende_de);
        }
                
    }
}
