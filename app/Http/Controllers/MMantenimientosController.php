<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\MEstatus;
use App\Models\MTpoManto;
use App\Models\MObjetivo;
use App\Models\Subequipo;
use App\Models\MMantenimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\MMantenimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use DB;
use PDF;

class MMantenimientosController extends Controller
{

    /**
     * Display a listing of the m mantenimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $r = MMantenimiento::where('id', '<>', '0');
        if (isset($input['id']) and $input['id'] <> null) {
            $r->where('id', '=', $input['id']);
        }
        if (isset($input['m_tpo_manto_id']) and $input['m_tpo_manto_id'] <> null) {
            $r->where('m_tpo_manto_id', '=', $input['m_tpo_manto_id']);
        }
        if (isset($input['objetivo_id']) and $input['objetivo_id'] <> null) {
            $r->where('objetivo_id', '=', $input['objetivo_id']);
        }
        if (isset($input['subequipo_id']) and $input['subequipo_id'] <> null) {
            $r->where('subequipo_id', '=', $input['subequipo_id']);
        }
        if (isset($input['estatus_id']) and $input['estatus_id'] <> null) {
            $r->where('estatus_id', '=', $input['estatus_id']);
        }
        $entity = Entity::find(Auth::user()->entity_id);
        if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity == 1) {
            //dd('si puede');
            $r->where('entity_id', '=', Auth::user()->entity_id);
        }
        /*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
        $mTpoMantos = MTpoManto::pluck('tpo_manto', 'id')->all();
        $mObjetivos = MObjetivo::where('entity_id', Auth::user()->entity_id)->pluck('objetivo', 'id')->all();
        $subequipos = Subequipo::where('entity_id', Auth::user()->entity_id)->pluck('subequipo', 'id')->all();
        $mEstatuses = MEstatus::pluck('id', 'id')->all();
        $mMantenimientos = $r->paginate(25);
        //$mMantenimientos = MMantenimiento::with('mtpomanto','mobjetivo','subequipo','empleado','bnd','mestatus','entity','user')->paginate(25);

        return view('m_mantenimientos.index', compact('mMantenimientos', 'mTpoMantos', 'mObjetivos', 'mEstatuses', 'subequipos'));
    }

    /**
     * Show the form for creating a new m mantenimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $mTpoMantos = MTpoManto::pluck('tpo_manto', 'id')->all();
        $mObjetivos = MObjetivo::where('entity_id', Auth::user()->entity_id)->pluck('objetivo', 'id')->all();
        $subequipos = Subequipo::where('entity_id', Auth::user()->entity_id)->pluck('subequipo', 'id')->all();
        $empleados = Empleado::where('entity_id', Auth::user()->entity_id)->pluck('nombre', 'id')->all();
        $bnds = Bnd::where('id', '>', 0)->pluck('bnd', 'id');
        $mEstatuses = MEstatus::pluck('estatus', 'id')->all();
        $entities = Entity::pluck('rzon_social', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        return view('m_mantenimientos.create', compact('mTpoMantos', 'mObjetivos', 'subequipos', 'empleados', 'bnds', 'empleados', 'empleados', 'bnds', 'bnds', 'bnds', 'bnds', 'bnds', 'mEstatuses', 'bnds', 'bnds', 'bnds', 'entities', 'users', 'users'));
    }

    /**
     * Store a new m mantenimiento in the storage.
     *
     * @param App\Http\Requests\MMantenimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MMantenimientosFormRequest $request)
    {
        try {

            $data = $request->getData();

            $data['usu_mod_id'] = Auth::user()->id;
            $data['usu_alta_id'] = Auth::user()->id;
            $data['entity_id'] = Auth::user()->entity_id;
            MMantenimiento::create($data);

            return redirect()->route('m_mantenimientos.m_mantenimiento.index')
                ->with('success_message', trans('m_mantenimientos.model_was_added'));
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('m_mantenimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified m mantenimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mMantenimiento = MMantenimiento::with('mtpomanto', 'mobjetivo', 'subequipo', 'empleado', 'bnd', 'mestatus', 'entity', 'user')->findOrFail($id);

        return view('m_mantenimientos.show', compact('mMantenimiento'));
    }

    /**
     * Show the form for editing the specified m mantenimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mMantenimiento = MMantenimiento::findOrFail($id);
        $mTpoMantos = MTpoManto::pluck('tpo_manto', 'id')->all();
        $mObjetivos = MObjetivo::where('entity_id', Auth::user()->entity_id)->pluck('objetivo', 'id')->all();
        $subequipos = Subequipo::where('entity_id', Auth::user()->entity_id)->pluck('subequipo', 'id')->all();
        $empleados = Empleado::where('entity_id', Auth::user()->entity_id)->pluck('nombre', 'id')->all();
        $bnds = Bnd::where('id', '>', 0)->pluck('bnd', 'id');
        $mEstatuses = MEstatus::pluck('estatus', 'id')->all();
        //dd($mEstatuses);
        $entities = Entity::pluck('rzon_social', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        return view('m_mantenimientos.edit', compact('mMantenimiento', 'mTpoMantos', 'mObjetivos', 'subequipos', 'empleados', 'bnds', 'empleados', 'empleados', 'bnds', 'bnds', 'bnds', 'bnds', 'bnds', 'mEstatuses', 'bnds', 'bnds', 'bnds', 'entities', 'users', 'users'));
    }

    /**
     * Update the specified m mantenimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MMantenimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MMantenimientosFormRequest $request)
    {
        try {

            $data = $request->getData();
            //dd($data);
            $mMantenimiento = MMantenimiento::findOrFail($id);
            $data['usu_mod_id'] = Auth::user()->id;

            $mMantenimiento->update($data);

            return redirect()->route('m_mantenimientos.m_mantenimiento.index')
                ->with('success_message', trans('m_mantenimientos.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('m_mantenimientos.unexpected_error')]);
        }
    }

    /**
     * Remove the specified m mantenimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mMantenimiento = MMantenimiento::findOrFail($id);
            $mMantenimiento->delete();

            return redirect()->route('m_mantenimientos.m_mantenimiento.index')
                ->with('success_message', trans('m_mantenimientos.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('m_mantenimientos.unexpected_error')]);
        }
    }

    public function conEquipo(Request $request)
    {
        $final = array();
        if ($request->ajax()) {
            $data = $request->all();
            //dd($data);
            $id = e($data['objetivo_id']);
            $subequipo = e($data['subequipo_id']);

            $result = DB::table('subequipos as s')
                ->where('s.equipo_id', '=', $id)
                ->where('entity_id', '=', Auth::user()->entity_id)
                ->get();
            //dd($result);
            if (isset($subequipo) and $subequipo <> 0) {
                foreach ($result as $r1) {
                    if ($r1->id == $subequipo) {
                        array_push($final, array(
                            'id' => $r1->id,
                            'subequipo' => $r1->subequipo,
                            'selectec' => 'Selected'
                        ));
                    } else {
                        array_push($final, array(
                            'id' => $r1->id,
                            'subequipo' => $r1->subequipo,
                            'selectec' => ''
                        ));
                    }
                }
                //return $final;
                echo json_encode($final);
            } else {
                //return $result;	
                echo json_encode($result);
            }
        }
    }


    public function conSubequipo(Request $request)
    {
        if ($request->ajax()) {
            $id = e($request->get('id'));
            return DB::table('subequipos as s')
                ->join('areas as a', 'a.id', '=', 's.area_id')
                ->select('s.subequipo', 's.clase', 's.marca', 's.modelo', 's.no_serie', 's.fecha_carga', 'a.area', 's.ubicacion')
                ->where('s.id', '=', $id)
                ->distinct()->get();
        }
    }

    public function rptFormato($id)
    {
        /*$usuario=User::find(Auth::user()->id)->name;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		//$img  =  User::find(Sentry::getUser()->id)->Entidad->logo;
		
		$no_orden=$m->no_orden;
		
		if(!file_exists($carpeta)){
			mkdir($carpeta);
		}

		if(file_exists($carpeta . '/mantenimiento.pdf')){
			unlink($carpeta . '/mantenimiento.pdf');
		}
*/

        //dd($carpeta . '/mantenimiento');

        /*JasperPHP::process(
	    base_path() . '/public/reportes/reportes/mantenimiento.jasper', 
	    $carpeta . '/mantenimiento',
	    array("pdf"), 
	    array('id'=>$id,
	    	  //'ruta_img'=>base_path().'/public/uploads/cias/'.$img),
			  'codigo'=> Hash::make($no_orden)),
	    Config::get('database.connections.mysql') //DB connection array
	    )->execute();
		
	    for($i=0;$i<1000;$i++){
	    	if(!file_exists($carpeta.'/mantenimiento.pdf')){
	    		sleep(3);
	    	}else{
	    		sleep(3);
	    		break;
	    	}
	    }
	    return Response::download($carpeta.'/mantenimiento.pdf');	    
		*/
        //dd($m);
        $m = MMantenimiento::find($id);
        $entidad  =  Entity::find(Auth::user()->entity_id);

        $img = asset('storage/entities/' . $entidad->logo);
        $fecha = date('d/m/Y');
        //dd($img);
        $pdf = PDF::loadView('m_mantenimientos.orden_mantor', array('m' => $m, 'img' => $img, 'fecha' => $fecha))
            ->setPaper('letter', 'portrait');
        return $pdf->download('reporte.pdf');

        //return View::make('m_mantenimientos.orden_mantor', array('m'=>$m, 'img'=>$img, 'fecha'=>$fecha));
    }
}
