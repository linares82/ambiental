<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Area;
use App\Models\AaEme;
use App\Models\Entity;
use App\Models\Efecto;
use App\Models\Puesto;
use App\Models\ImpReal;
use App\Models\AaImpacto;
use App\Models\AaAspecto;
use App\Models\AaProceso;
use App\Models\AaCondicione;
use App\Models\Probabilidad;
use App\Models\ImpPotencial;
use App\Models\DuracionAccion;
use App\Models\AspectosAmbientale;
use App\Http\Controllers\Controller;
use App\Http\Requests\AspectosAmbientalesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AspectosAmbientalesController extends Controller
{

    /**
     * Display a listing of the aspectos ambientales.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AspectosAmbientale::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['proceso_id']) and $input['proceso_id']<>null){
			$r->where('proceso_id', '=', $input['proceso_id']);
		}
                if(isset($input['area_id']) and $input['area_id']<>null){
			$r->where('area_id', '=', $input['area_id']);
		}
		if(isset($input['actividad']) and $input['actividad']<>null){
			$r->where('actividad', 'like', '%'.$input['actividad'].'%');
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
                $aaProcesos = AaProceso::pluck('proceso','id')->all();
                $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
		$aspectosAmbientales = $r->with('aaproceso','area','aaaspecto','aaeme','aacondicione','aaimpacto','puesto','bnd','efecto','duracionaccion','probabilidad','imppotencial','impreal','entity','user')->paginate(25);
		//$aspectosAmbientales = AspectosAmbientale::with('aaproceso','area','aaaspecto','aaeme','aacondicione','aaimpacto','puesto','bnd','efecto','duracionaccion','probabilidad','imppotencial','impreal','entity','user')->paginate(25);

        return view('aspectos_ambientales.index', compact('aspectosAmbientales','aaProcesos','areas'));
    }

    /**
     * Show the form for creating a new aspectos ambientale.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aaProcesos = AaProceso::pluck('proceso','id')->all();
        $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
        $aaAspectos = AaAspecto::pluck('aspectos','id')->all();
        $aaEmes = AaEme::pluck('eme','id')->all();
        $aaCondiciones = AaCondicione::pluck('condicion','id')->all();
        $aaImpactos = AaImpacto::pluck('impacto','id')->all();
        $puestos = Puesto::where('entity_id',Auth::user()->entity_id)->pluck('puesto','id')->all();
        $bnds = Bnd::where('id', '>', 0)->pluck('bnd','id')->all();
        $efectos = Efecto::pluck('descripcion','id')->all();
        $duracionAccions = DuracionAccion::pluck('duracion_accion','id')->all();
        $probabilidads = Probabilidad::pluck('probabilidad','id')->all();
        $impPotencials = ImpPotencial::pluck('imp_potencial','id')->all();
        
        $impReals = ImpReal::pluck('imp_real','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        //dd($impReals);
        
        return view('aspectos_ambientales.create', compact('aaProcesos','areas','aaAspectos','aaEmes','aaCondiciones','aaImpactos','puestos','bnds',
                        'bnds','bnds','bnds','efectos','bnds','duracionAccions','bnds','probabilidads','impPotencials','impReals','entities','users','users'));
    }

    /**
     * Store a new aspectos ambientale in the storage.
     *
     * @param App\Http\Requests\AspectosAmbientalesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AspectosAmbientalesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            AspectosAmbientale::create($data);

            return redirect()->route('aspectos_ambientales.aspectos_ambientale.index')
                             ->with('success_message', trans('aspectos_ambientales.model_was_added'));

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aspectos_ambientales.unexpected_error')]);
        }
    }

    /**
     * Display the specified aspectos ambientale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aspectosAmbientale = AspectosAmbientale::with('aaproceso','area','aaaspecto','aaeme','aacondicione','aaimpacto','puesto','bnd','efecto','duracionaccion','probabilidad','imppotencial','impreal','entity','user')->findOrFail($id);

        return view('aspectos_ambientales.show', compact('aspectosAmbientale'));
    }

    /**
     * Show the form for editing the specified aspectos ambientale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aspectosAmbientale = AspectosAmbientale::findOrFail($id);
        $aaProcesos = AaProceso::pluck('proceso','id')->all();
        $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
        $aaAspectos = AaAspecto::pluck('aspectos','id')->all();
        $aaEmes = AaEme::pluck('eme','id')->all();
        $aaCondiciones = AaCondicione::pluck('condicion','id')->all();
        $aaImpactos = AaImpacto::pluck('impacto','id')->all();
        $puestos = Puesto::where('entity_id',Auth::user()->entity_id)->pluck('puesto','id')->all();
        $bnds = Bnd::where('id', '>', 0)->pluck('bnd','id')->all();
        $efectos = Efecto::pluck('descripcion','id')->all();
        $duracionAccions = DuracionAccion::pluck('duracion_accion','id')->all();
        $probabilidads = Probabilidad::pluck('probabilidad','id')->all();
        $impPotencials = ImpPotencial::pluck('imp_potencial','id')->all();
        //dd($impPotencials);
        $impReals = ImpReal::pluck('imp_real','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('aspectos_ambientales.edit', compact('aspectosAmbientale','aaProcesos','areas','aaAspectos','aaEmes','aaCondiciones','aaImpactos','puestos','bnds','bnds','bnds','bnds','efectos','bnds','duracionAccions','bnds','probabilidads','impPotencials','impReals','entities','users','users'));
    }

    /**
     * Update the specified aspectos ambientale in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AspectosAmbientalesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AspectosAmbientalesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aspectosAmbientale = AspectosAmbientale::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aspectosAmbientale->update($data);

            return redirect()->route('aspectos_ambientales.aspectos_ambientale.index')
                             ->with('success_message', trans('aspectos_ambientales.model_was_updated'));

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aspectos_ambientales.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified aspectos ambientale from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aspectosAmbientale = AspectosAmbientale::findOrFail($id);
            $aspectosAmbientale->delete();

            return redirect()->route('aspectos_ambientales.aspectos_ambientale.index')
                             ->with('success_message', trans('aspectos_ambientales.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aspectos_ambientales.unexpected_error')]);
        }
    }



}
