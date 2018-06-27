<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AArchivo;
use App\Models\AStArchivo;
use App\Models\AComentariosArchivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\AComentariosArchivosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AComentariosArchivosController extends Controller
{

    /**
     * Display a listing of the a comentarios archivos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AComentariosArchivo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aComentariosArchivos = $r->with('aarchivo','astarchivo','user')->paginate(25);
		//$aComentariosArchivos = AComentariosArchivo::with('aarchivo','astarchivo','user')->paginate(25);

        return view('a_comentarios_archivos.index', compact('aComentariosArchivos'));
    }

    /**
     * Show the form for creating a new a comentarios archivo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aArchivos = AArchivo::pluck('descripcion','id')->all();
$aStArchivos = AStArchivo::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('a_comentarios_archivos.create', compact('aArchivos','aStArchivos','users','users'));
    }

    /**
     * Store a new a comentarios archivo in the storage.
     *
     * @param App\Http\Requests\AComentariosArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AComentariosArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AComentariosArchivo::create($data);

            $aArchivo=AArchivo::find($data['a_archivo_id']);
            $aArchivo->st_archivo_id=$data['a_st_archivo_id'];
            $aArchivo->save();
            
            return redirect()->route('a_comentarios_archivos.a_comentarios_archivo.index')
                             ->with('success_message', trans('a_comentarios_archivos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_archivos.unexpected_error')]);
        }
    }

    /**
     * Display the specified a comentarios archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aComentariosArchivo = AComentariosArchivo::with('aarchivo','astarchivo','user')->findOrFail($id);

        return view('a_comentarios_archivos.show', compact('aComentariosArchivo'));
    }

    /**
     * Show the form for editing the specified a comentarios archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aComentariosArchivo = AComentariosArchivo::findOrFail($id);
        $aArchivos = AArchivo::pluck('descripcion','id')->all();
$aStArchivos = AStArchivo::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();

        return view('a_comentarios_archivos.edit', compact('aComentariosArchivo','aArchivos','aStArchivos','users','users'));
    }

    /**
     * Update the specified a comentarios archivo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AComentariosArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AComentariosArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aComentariosArchivo = AComentariosArchivo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aComentariosArchivo->update($data);

            return redirect()->route('a_comentarios_archivos.a_comentarios_archivo.index')
                             ->with('success_message', trans('a_comentarios_archivos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_archivos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a comentarios archivo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aComentariosArchivo = AComentariosArchivo::findOrFail($id);
            $aComentariosArchivo->delete();

            return redirect()->route('a_comentarios_archivos.a_comentarios_archivo.index')
                             ->with('success_message', trans('a_comentarios_archivos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_archivos.unexpected_error')]);
        }
    }

        public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=AComentariosArchivo::select('a_comentarios_archivos.id', 'comentario', 'estatus')
                                ->join('a_st_archivos as st', 'st.id','=','a_comentarios_archivos.a_st_archivo_id')
                                ->where('a_archivo_id', '=', $request->get('a_archivo'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'comentario'=>$l->comentario,
                                         'estatus'=>$l->estatus
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
