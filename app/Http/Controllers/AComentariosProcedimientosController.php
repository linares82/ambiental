<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AStArchivo;
use App\Models\AProcedimiento;
use App\Http\Controllers\Controller;
use App\Models\AComentariosProcedimiento;
use App\Http\Requests\AComentariosProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AComentariosProcedimientosController extends Controller
{

    /**
     * Display a listing of the a comentarios procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AComentariosProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aComentariosProcedimientos = $r->with('aprocedimiento','astarchivo','user')->paginate(25);
		//$aComentariosProcedimientos = AComentariosProcedimiento::with('aprocedimiento','astarchivo','user')->paginate(25);

        return view('a_comentarios_procedimientos.index', compact('aComentariosProcedimientos'));
    }

    /**
     * Show the form for creating a new a comentarios procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aProcedimientos = AProcedimiento::pluck('descripcion','id')->all();
$aStArchivos = AStArchivo::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('a_comentarios_procedimientos.create', compact('aProcedimientos','aStArchivos','users','users'));
    }

    /**
     * Store a new a comentarios procedimiento in the storage.
     *
     * @param App\Http\Requests\AComentariosProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AComentariosProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AComentariosProcedimiento::create($data);
            
            $aProcedimiento=AProcedimiento::find($data['a_procedimiento_id']);
            $aProcedimiento->st_archivo_id=$data['a_st_procedimiento_id'];
            $aProcedimiento->save();

            return redirect()->route('a_comentarios_procedimientos.a_comentarios_procedimiento.index')
                             ->with('success_message', trans('a_comentarios_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified a comentarios procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aComentariosProcedimiento = AComentariosProcedimiento::with('aprocedimiento','astarchivo','user')->findOrFail($id);

        return view('a_comentarios_procedimientos.show', compact('aComentariosProcedimiento'));
    }

    /**
     * Show the form for editing the specified a comentarios procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aComentariosProcedimiento = AComentariosProcedimiento::findOrFail($id);
        $aProcedimientos = AProcedimiento::pluck('descripcion','id')->all();
$aStArchivos = AStArchivo::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();

        return view('a_comentarios_procedimientos.edit', compact('aComentariosProcedimiento','aProcedimientos','aStArchivos','users','users'));
    }

    /**
     * Update the specified a comentarios procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AComentariosProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AComentariosProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aComentariosProcedimiento = AComentariosProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aComentariosProcedimiento->update($data);

            return redirect()->route('a_comentarios_procedimientos.a_comentarios_procedimiento.index')
                             ->with('success_message', trans('a_comentarios_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a comentarios procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aComentariosProcedimiento = AComentariosProcedimiento::findOrFail($id);
            $aComentariosProcedimiento->delete();

            return redirect()->route('a_comentarios_procedimientos.a_comentarios_procedimiento.index')
                             ->with('success_message', trans('a_comentarios_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_procedimientos.unexpected_error')]);
        }
    }

    public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=AComentariosProcedimiento::select('a_comentarios_procedimientos.id', 'comentario', 'estatus')
                                ->join('a_st_archivos as st', 'st.id','=','a_comentarios_procedimientos.a_st_procedimiento_id')
                                ->where('a_procedimiento_id', '=', $request->get('a_procedimiento'))
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
