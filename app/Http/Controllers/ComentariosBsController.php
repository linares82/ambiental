<?php

namespace App\Http\Controllers;

use App\Models\SStB;
use App\Models\User;
use App\Models\BitacoraSeguridad;
use App\Models\ComentariosB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComentariosBsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ComentariosBsController extends Controller
{

    /**
     * Display a listing of the comentarios bs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ComentariosB::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$comentariosBs = $r->with('bitacoraseguridad','sstb','user')->paginate(25);
		//$comentariosBs = ComentariosB::with('bitacoraseguridad','sstb','user')->paginate(25);

        return view('comentarios_bs.index', compact('comentariosBs'));
    }

    /**
     * Show the form for creating a new comentarios b.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $bitacoraSeguridads = BitacoraSeguridad::pluck('fecha','id')->all();
$sStBs = SStB::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('comentarios_bs.create', compact('bitacoraSeguridads','sStBs','users','users'));
    }

    /**
     * Store a new comentarios b in the storage.
     *
     * @param App\Http\Requests\ComentariosBsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ComentariosBsFormRequest $request)
    {
        //dd($request);
        try {  
            $data = $request->getData();
            //dd($data);
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            //dd($data);
            $f=ComentariosB::create($data);
            //dd($f);
            
            $bitacora_seguridad= BitacoraSeguridad::find($data['bitacora_seguridad_id']);
            $bitacora_seguridad->estatus_id=$data['estatus_id'];
            $bitacora_seguridad->save();
            
            return redirect()->route('comentarios_bs.comentarios_b.index')
                             ->with('success_message', trans('comentarios_bs.model_was_added'));

        } catch (Exception $exception) {
            dd($exception);
            Log::info($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('comentarios_bs.unexpected_error')]);
        }
    }

    /**
     * Display the specified comentarios b.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $comentariosB = ComentariosB::with('bitacoraseguridad','sstb','user')->findOrFail($id);

        return view('comentarios_bs.show', compact('comentariosB'));
    }

    /**
     * Show the form for editing the specified comentarios b.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $comentariosB = ComentariosB::findOrFail($id);
        $bitacoraSeguridads = BitacoraSeguridad::pluck('fecha','id')->all();
$sStBs = SStB::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();

        return view('comentarios_bs.edit', compact('comentariosB','bitacoraSeguridads','sStBs','users','users'));
    }

    /**
     * Update the specified comentarios b in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ComentariosBsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ComentariosBsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $comentariosB = ComentariosB::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $comentariosB->update($data);

            return redirect()->route('comentarios_bs.comentarios_b.index')
                             ->with('success_message', trans('comentarios_bs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('comentarios_bs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified comentarios b from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $comentariosB = ComentariosB::findOrFail($id);
            $comentariosB->delete();

            return redirect()->route('comentarios_bs.comentarios_b.index')
                             ->with('success_message', trans('comentarios_bs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('comentarios_bs.unexpected_error')]);
        }
    }

    public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=ComentariosB::select('comentarios_bs.id', 'costo','comentario', 'estatus')
                                ->join('s_st_bs as st', 'st.id','=','comentarios_bs.estatus_id')
                                ->where('bitacora_seguridad_id', '=', $request->get('bitacora_seguridad_id'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'comentario'=>$l->comentario,
                                         'costo'=>$l->costo,
                                         'estatus'=>$l->estatus
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
