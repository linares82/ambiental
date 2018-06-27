<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SRegistro;
use App\Models\SComentariosRegistro;
use App\Http\Controllers\Controller;
use App\Models\SEstatusProcedimiento;
use App\Http\Requests\SComentariosRegistrosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SComentariosRegistrosController extends Controller
{

    /**
     * Display a listing of the s comentarios registros.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SComentariosRegistro::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sComentariosRegistros = $r->with('sregistro','sestatusprocedimiento','user')->paginate(25);
		//$sComentariosRegistros = SComentariosRegistro::with('sregistro','sestatusprocedimiento','user')->paginate(25);

        return view('s_comentarios_registros.index', compact('sComentariosRegistros'));
    }

    /**
     * Show the form for creating a new s comentarios registro.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sRegistros = SRegistro::pluck('detalle','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('s_comentarios_registros.create', compact('sRegistros','sEstatusProcedimientos','users','users'));
    }

    /**
     * Store a new s comentarios registro in the storage.
     *
     * @param App\Http\Requests\SComentariosRegistrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SComentariosRegistrosFormRequest $request)
    {
        //dd($request);
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            
            SComentariosRegistro::create($data);

            $sRegistro=SRegistro::find($data['s_registros_id']);
            $sRegistro->estatus_id=$data['estatus_id'];
            $sRegistro->save();
            
            return redirect()->route('s_comentarios_registros.s_comentarios_registro.index')
                             ->with('success_message', trans('s_comentarios_registros.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_registros.unexpected_error')]);
        }
    }

    /**
     * Display the specified s comentarios registro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sComentariosRegistro = SComentariosRegistro::with('sregistro','sestatusprocedimiento','user')->findOrFail($id);

        return view('s_comentarios_registros.show', compact('sComentariosRegistro'));
    }

    /**
     * Show the form for editing the specified s comentarios registro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sComentariosRegistro = SComentariosRegistro::findOrFail($id);
        $sRegistros = SRegistro::pluck('detalle','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();

        return view('s_comentarios_registros.edit', compact('sComentariosRegistro','sRegistros','sEstatusProcedimientos','users','users'));
    }

    /**
     * Update the specified s comentarios registro in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SComentariosRegistrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SComentariosRegistrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sComentariosRegistro = SComentariosRegistro::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sComentariosRegistro->update($data);

            return redirect()->route('s_comentarios_registros.s_comentarios_registro.index')
                             ->with('success_message', trans('s_comentarios_registros.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_registros.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s comentarios registro from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sComentariosRegistro = SComentariosRegistro::findOrFail($id);
            $sComentariosRegistro->delete();

            return redirect()->route('s_comentarios_registros.s_comentarios_registro.index')
                             ->with('success_message', trans('s_comentarios_registros.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_registros.unexpected_error')]);
        }
    }

    public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=SComentariosRegistro::select('s_comentarios_registros.id', 'comentario', 'estatus')
                                ->join('s_estatus_procedimientos as st', 'st.id','=','s_comentarios_registros.estatus_id')
                                ->where('s_registros_id', '=', $request->get('s_registros_id'))
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
