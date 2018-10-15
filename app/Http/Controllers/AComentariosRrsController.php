<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AStRr;
use App\Models\ARrAmbientale;
use App\Models\AComentariosRrs;
use App\Http\Controllers\Controller;
use App\Http\Requests\AComentariosRrsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AComentariosRrsController extends Controller
{

    /**
     * Display a listing of the a comentarios rrs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AComentariosRrs::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aComentariosRrsObjects = $r->with('arrambientale','astrr','user')->paginate(25);
		//$aComentariosRrsObjects = AComentariosRrs::with('arrambientale','astrr','user')->paginate(25);

        return view('a_comentarios_rrs.index', compact('aComentariosRrsObjects'));
    }

    /**
     * Show the form for creating a new a comentarios rrs.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aRrAmbientales = ARrAmbientale::pluck('descripcion','id')->all();
$aStRrs = AStRr::pluck('id','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('a_comentarios_rrs.create', compact('aRrAmbientales','aStRrs','users','users'));
    }

    /**
     * Store a new a comentarios rrs in the storage.
     *
     * @param App\Http\Requests\AComentariosRrsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AComentariosRrsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            //dd($data);
		$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            
            
            AComentariosRrs::create($data);
            
            $aRrAmbientale=ARrAmbientale::find($data['a_rr_id']);
            $aRrAmbientale->st_rr_id=$data['a_st_rr_id'];
            $aRrAmbientale->save();


            /*return redirect()->route('a_comentarios_rrs.a_comentarios_rrs.index')
                             ->with('success_message', trans('a_comentarios_rrs.model_was_added'));
*/
        } catch (Exception $exception) {
            Log::info($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_rrs.unexpected_error')]);
        }
    }

    /**
     * Display the specified a comentarios rrs.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aComentariosRrs = AComentariosRrs::with('arrambientale','astrr','user')->findOrFail($id);

        return view('a_comentarios_rrs.show', compact('aComentariosRrs'));
    }

    /**
     * Show the form for editing the specified a comentarios rrs.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aComentariosRrs = AComentariosRrs::findOrFail($id);
        $aRrAmbientales = ARrAmbientale::pluck('descripcion','id')->all();
$aStRrs = AStRr::pluck('id','id')->all();
$users = User::pluck('name','id')->all();

        return view('a_comentarios_rrs.edit', compact('aComentariosRrs','aRrAmbientales','aStRrs','users','users'));
    }

    /**
     * Update the specified a comentarios rrs in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AComentariosRrsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AComentariosRrsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aComentariosRrs = AComentariosRrs::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aComentariosRrs->update($data);

            return redirect()->route('a_comentarios_rrs.a_comentarios_rrs.index')
                             ->with('success_message', trans('a_comentarios_rrs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_rrs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a comentarios rrs from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aComentariosRrs = AComentariosRrs::findOrFail($id);
            $aComentariosRrs->delete();

            return redirect()->route('a_comentarios_rrs.a_comentarios_rrs.index')
                             ->with('success_message', trans('a_comentarios_rrs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_comentarios_rrs.unexpected_error')]);
        }
    }

        public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=AComentariosRrs::select('a_comentarios_rrs.id', 'comentario', 'estatus')
                                ->join('a_st_rrs as st', 'st.id','=','a_comentarios_rrs.a_st_rr_id')
                                ->where('a_rr_id', '=', $request->get('a_rr_ambientale'))
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
