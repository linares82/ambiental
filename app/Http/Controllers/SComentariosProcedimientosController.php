<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SProcedimiento;
use App\Http\Controllers\Controller;
use App\Models\SEstatusProcedimiento;
use App\Models\SComentariosProcedimiento;
use App\Http\Requests\SComentariosProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SComentariosProcedimientosController extends Controller
{

    /**
     * Display a listing of the s comentarios procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SComentariosProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sComentariosProcedimientos = $r->with('sprocedimiento','sestatusprocedimiento','user')->paginate(25);
		//$sComentariosProcedimientos = SComentariosProcedimiento::with('sprocedimiento','sestatusprocedimiento','user')->paginate(25);

        return view('s_comentarios_procedimientos.index', compact('sComentariosProcedimientos'));
    }

    /**
     * Show the form for creating a new s comentarios procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sProcedimientos = SProcedimiento::pluck('descripcion','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('s_comentarios_procedimientos.create', compact('sProcedimientos','sEstatusProcedimientos','users','users'));
    }

    /**
     * Store a new s comentarios procedimiento in the storage.
     *
     * @param App\Http\Requests\SComentariosProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SComentariosProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            //dd($data);
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            SComentariosProcedimiento::create($data);
            
            $sProcedimiento=SProcedimiento::find($data['s_procedimiento_id']);
            $sProcedimiento->estatus_id=$data['estatus_id'];
            $sProcedimiento->save();

            return redirect()->route('s_comentarios_procedimientos.s_comentarios_procedimiento.index')
                             ->with('success_message', trans('s_comentarios_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified s comentarios procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sComentariosProcedimiento = SComentariosProcedimiento::with('sprocedimiento','sestatusprocedimiento','user')->findOrFail($id);

        return view('s_comentarios_procedimientos.show', compact('sComentariosProcedimiento'));
    }

    /**
     * Show the form for editing the specified s comentarios procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sComentariosProcedimiento = SComentariosProcedimiento::findOrFail($id);
        $sProcedimientos = SProcedimiento::pluck('descripcion','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();

        return view('s_comentarios_procedimientos.edit', compact('sComentariosProcedimiento','sProcedimientos','sEstatusProcedimientos','users','users'));
    }

    /**
     * Update the specified s comentarios procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SComentariosProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SComentariosProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sComentariosProcedimiento = SComentariosProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sComentariosProcedimiento->update($data);

            return redirect()->route('s_comentarios_procedimientos.s_comentarios_procedimiento.index')
                             ->with('success_message', trans('s_comentarios_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s comentarios procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sComentariosProcedimiento = SComentariosProcedimiento::findOrFail($id);
            $sComentariosProcedimiento->delete();

            return redirect()->route('s_comentarios_procedimientos.s_comentarios_procedimiento.index')
                             ->with('success_message', trans('s_comentarios_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_procedimientos.unexpected_error')]);
        }
    }

    public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=SComentariosProcedimiento::select('s_comentarios_procedimientos.id', 'comentario', 'estatus')
                                ->join('s_estatus_procedimientos as st', 'st.id','=','s_comentarios_procedimientos.estatus_id')
                                ->where('s_procedimiento_id', '=', $request->get('s_procedimiento_id'))
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
