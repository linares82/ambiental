<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Check;
use App\Models\Norma;
use App\Models\CheckL;
use App\Models\ACheck;
use App\Models\Cumplimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CheckLsController extends Controller
{

    /**
     * Display a listing of the check ls.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CheckL::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$checkLs = $r->with('check','acheck','norma')->paginate(25);
		//$checkLs = CheckL::with('check','acheck','norma')->paginate(25);

        return view('check_ls.index', compact('checkLs'));
    }

    /**
     * Show the form for creating a new check l.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $checks = Check::pluck('cliente','id')->all();
$aChecks = ACheck::pluck('area','id')->all();
$normas = Norma::pluck('norma','id')->all();
$cumplimientos = Cumplimiento::pluck('id','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('check_ls.create', compact('checks','aChecks','normas','cumplimientos','users','users'));
    }

    /**
     * Store a new check l in the storage.
     *
     * @param App\Http\Requests\CheckLsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CheckLsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CheckL::create($data);

            return redirect()->route('check_ls.check_l.index')
                             ->with('success_message', trans('check_ls.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('check_ls.unexpected_error')]);
        }
    }

    /**
     * Display the specified check l.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $checkL = CheckL::with('check','acheck','norma','cumplimiento','user')->findOrFail($id);

        return view('check_ls.show', compact('checkL'));
    }

    /**
     * Show the form for editing the specified check l.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $checkL = CheckL::findOrFail($id);
        
        $aChecks = ACheck::pluck('area','id')->all();
        $normas = Norma::pluck('norma','id')->all();
        $cumplimientos = Cumplimiento::pluck('cumplimiento','id')->all();
        $users = User::pluck('name','id')->all();

        return view('check_ls.edit', compact('checkL','aChecks','normas','cumplimientos','users','users'));
    }

    /**
     * Update the specified check l in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CheckLsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CheckLsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $checkL = CheckL::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $checkL->update($data);

            return redirect()->route('checks.check.index')
                             ->with('success_message', trans('check_ls.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('check_ls.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified check l from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $checkL = CheckL::findOrFail($id);
            $checkL->delete();

            return redirect()->route('checks.check.index')
                             ->with('success_message', trans('check_ls.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('check_ls.unexpected_error')]);
        }
    }

    public function getByCheck(Request $request){
        //dd($request->all());
        $lineas=CheckL::select('check_ls.id','a.area', 'n.norma', 'check_ls.no_conformidad', 'check_ls.requisito','c.cumplimiento','check_ls.updated_at')
                      ->join('a_checks as a', 'a.id', '=', 'check_ls.a_check_id')
                      ->join('normas as n', 'n.id', '=','check_ls.norma_id')
                      ->join('cumplimientos as c', 'c.id', '=', 'check_ls.cumplimiento')                
                      ->where('check_ls.check_id', '=', $request->get('check'))
                      ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array('area'=>$l->area,
                                         'id'=>$l->id,
                                         'norma'=>$l->norma,
                                         'no_conformidad'=>$l->no_conformidad,
                                         'requisito'=>$l->requisito,
                                         'cumplimiento'=>$l->cumplimiento,
                                         'updated_at'=>$l->updated_at));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
