<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Check;
use App\Models\CheckL;
use App\Models\ACheck;
use App\Models\Cliente;
use App\Models\Norma;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChecksFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use DB;

class ChecksController extends Controller
{

    /**
     * Display a listing of the checks.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Check::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$checks = $r->with('cliente','acheck','user')->paginate(25);
                //dd($checks->toArray());
		//$checks = Check::with('cliente','acheck','user')->paginate(25);

        return view('checks.index', compact('checks'));
    }

    /**
     * Show the form for creating a new check.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $clientes = Cliente::pluck('cliente','id')->all();
        $aChecks = ACheck::pluck('area','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('checks.create', compact('clientes','aChecks','users','users'));
    }

    /**
     * Store a new check in the storage.
     *
     * @param App\Http\Requests\ChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ChecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $check=Check::create($data);

            return redirect()->route('checks.check.index')
                             ->with('success_message', trans('checks.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('checks.unexpected_error')]);
        }
    }

    /**
     * Display the specified check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $check = Check::with('cliente','acheck','user')->findOrFail($id);

        return view('checks.show', compact('check'));
    }

    /**
     * Show the form for editing the specified check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $check = Check::findOrFail($id);
        $clientes = Cliente::pluck('cliente','id')->all();
        $aChecks = ACheck::pluck('area','id')->all();
        $users = User::pluck('name','id')->all();
        $normas = Norma::pluck('norma', 'id');
        $normasRelacionados=array();
        foreach($check->normas as $norma){
            $normasRelacionados=array_add($normasRelacionados, $norma->id, $norma->norma);
        }
        //dd($normasRelacionados);

        return view('checks.edit', compact('check','clientes','aChecks','users','users','normas','normasRelacionados'));
    }

    /**
     * Update the specified check in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ChecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $check = Check::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $check->update($data);

            return redirect()->route('checks.check.index')
                             ->with('success_message', trans('checks.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('checks.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified check from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $check = Check::findOrFail($id);
            $check->delete();

            return redirect()->route('checks.check.index')
                             ->with('success_message', trans('checks.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('checks.unexpected_error')]);
        }
    }

    public function addNorma(Request $request){
        if ($request->ajax()) {
            $norma=$request->get('norma');
            $check=$request->get('check');
            $check=Check::findOrFail($check);
            $check->normas()->attach($norma);
            
            //Crea Lineas
            $lineas=DB::table('mchecks')
                                    ->select('a_chequeo', 'norma_id', 'no_conformidad', 'correccion', 'requisito', 'rnc', 'minimo_vsm', 'maximo_vsm')
                                    ->where('a_chequeo', $check->a_check_id)
                                    ->where('norma_id', '=',$norma)
                                    ->orderBy('norma_id')->orderBy('orden')->get();
            $sm=DB::table('sms')->where('id', '1')->value('monto');
            foreach($lineas as $ln){
                    $linea=array();
                    $linea['a_check_id']		= $ln->a_chequeo;
                    $linea['norma_id']		= $ln->norma_id;
                    $linea['no_conformidad']= $ln->no_conformidad;
                    $linea['correccion']	= $ln->correccion;
                    $linea['requisito']		= $ln->requisito;
                    $linea['rnc']			= $ln->rnc;
                    $linea['cumplimiento']	= 1;
                    $linea['minimo_vsm']	= $ln->minimo_vsm;
                    $linea['maximo_vsm']	= $ln->maximo_vsm;
                    $linea['monto_min'] 	= $ln->minimo_vsm*$sm;
                    $linea['monto_max']   	= $ln->maximo_vsm*$sm;
                    $linea['monto_medio'] 	= ($linea['monto_min']+$linea['monto_max'])/2;
                    $linea['t_semanas']		= 0;					
                    $linea['responsable']	= "";					
                    $linea['monto_estimado']= 0;					
                    $linea['usu_alta_id'] 	= Auth::user()->id;
                    $linea['usu_mod_id']  	= Auth::user()->id;
                    $l=new Checkl($linea);
                    Check::find($check->id)->checkls()->save($l);
            }
            ////////////////////////////////
        }
    }
    
    public function lessNorma(Request $request){
        //dd($request);
        if ($request->ajax()) {
            $norma=$request->get('norma');
            $check=$request->get('check');
            $check=Check::findOrFail($check);
            $check->normas()->detach($norma);
            
            $lineas=DB::table('check_ls')
                                    ->select('id', 'norma_id')
                                    ->where('check_id', $check->id)
                                    ->where('norma_id', '=',$norma)
                                    ->orderBy('norma_id')->get();
            foreach($lineas as $ln){
                    CheckL::find($ln->id)->delete();
            }
        }
    }


}
