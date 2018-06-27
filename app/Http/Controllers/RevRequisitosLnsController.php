<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\AaImpacto;
use App\Models\Condicione;
use App\Models\RevRequisito;
use App\Models\Importancium;
use App\Models\RevRequisitosLn;
use App\Models\EstatusCondicione;
use App\Http\Controllers\Controller;
use App\Http\Requests\RevRequisitosLnsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class RevRequisitosLnsController extends Controller
{

    /**
     * Display a listing of the rev requisitos lns.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=RevRequisitosLn::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$revRequisitosLns = $r->with('revrequisito','aaimpacto','condicione','area','estatuscondicione','importancium','empleado','user')->paginate(25);
		//$revRequisitosLns = RevRequisitosLn::with('revrequisito','aaimpacto','condicione','area','estatuscondicione','importancium','empleado','user')->paginate(25);

        return view('rev_requisitos_lns.index', compact('revRequisitosLns'));
    }

    /**
     * Show the form for creating a new rev requisitos ln.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $revRequisitos = RevRequisito::pluck('anio','id')->all();
        $aaImpactos = AaImpacto::pluck('impacto','id')->all();
        $condiciones = Condicione::pluck('condicion','id')->all();
        $areas = Area::pluck('area','id')->all();
        $estatusCondiciones = EstatusCondicione::pluck('estatus','id')->all();
        $importancia = Importancium::pluck('importancia','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('rev_requisitos_lns.create', compact('revRequisitos','aaImpactos','condiciones','areas','estatusCondiciones','importancia','empleados','users','users'));
    }

    /**
     * Store a new rev requisitos ln in the storage.
     *
     * @param App\Http\Requests\RevRequisitosLnsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RevRequisitosLnsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            RevRequisitosLn::create($data);

            return redirect()->route('rev_requisitos.rev_requisito.index')
                             ->with('success_message', trans('rev_requisitos_lns.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_requisitos_lns.unexpected_error')]);
        }
    }

    /**
     * Display the specified rev requisitos ln.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $revRequisitosLn = RevRequisitosLn::with('revrequisito','aaimpacto','condicione','area','estatuscondicione','importancium','empleado','user')->findOrFail($id);

        return view('rev_requisitos_lns.show', compact('revRequisitosLn'));
    }

    /**
     * Show the form for editing the specified rev requisitos ln.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $revRequisitosLn = RevRequisitosLn::findOrFail($id);
        $revRequisitos = RevRequisito::pluck('anio','id')->all();
        $aaImpactos = AaImpacto::pluck('impacto','id')->all();
        $condiciones = Condicione::pluck('condicion','id')->all();
        $areas = Area::pluck('area','id')->all();
        $estatusCondiciones = EstatusCondicione::pluck('estatus','id')->all();
        $importancia = Importancium::pluck('importancia','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $users = User::pluck('name','id')->all();

        return view('rev_requisitos_lns.edit', compact('revRequisitosLn','revRequisitos','aaImpactos','condiciones','areas','estatusCondiciones','importancia','empleados','users','users'));
    }

    /**
     * Update the specified rev requisitos ln in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RevRequisitosLnsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RevRequisitosLnsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $revRequisitosLn = RevRequisitosLn::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $revRequisitosLn->update($data);

            return redirect()->route('rev_requisitos.rev_requisito.index')
                             ->with('success_message', trans('rev_requisitos_lns.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_requisitos_lns.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified rev requisitos ln from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $revRequisitosLn = RevRequisitosLn::findOrFail($id);
            $revRequisitosLn->delete();

            return redirect()->route('rev_requisitos_lns.rev_requisitos_ln.index')
                             ->with('success_message', trans('rev_requisitos_lns.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_requisitos_lns.unexpected_error')]);
        }
    }

    public function getByEnc(Request $request){
        //dd($request->all());
        $lineas=RevRequisitosLn::select('rev_requisitos_lns.id','rev_requisitos_lns.rev_requisitos_id','i.impacto','c.condicion',
                                        'st.estatus', 'imp.importancia')
                         ->join('aa_impactos as i','i.id', '=', 'rev_requisitos_lns.impacto_id')
                         ->join('condiciones as c','c.id', '=', 'rev_requisitos_lns.condicion_id')
                         ->join('estatus_condiciones as st','st.id', '=', 'rev_requisitos_lns.estatus_id')
                         ->join('importancia as imp','imp.id', '=', 'rev_requisitos_lns.importancia_id')
                         ->where('rev_requisitos_id', '=', $request->get('rev_requisito'))
                         ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array('id'=>$l->id,
                                         'impacto'=>$l->impacto,
                                         'condicion'=>$l->condicion,
                                         'estatus'=>$l->estatus,
                                         'fec_cumplimiento'=>$l->fec_cumplimiento,
                                         'importancia'=>$l->importancia
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
