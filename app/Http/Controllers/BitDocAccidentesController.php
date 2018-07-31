<?php

namespace App\Http\Controllers;

use App\Models\BitDocAccidente;
use App\Models\BitacoraAccidente;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitDocAccidentesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class BitDocAccidentesController extends Controller
{

    /**
     * Display a listing of the bit doc accidentes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitDocAccidente::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitDocAccidentes = $r->with('bitacoraaccidente')->paginate(25);
		//$bitDocAccidentes = BitDocAccidente::with('bitacoraaccidente')->paginate(25);

        return view('bit_doc_accidentes.index', compact('bitDocAccidentes'));
    }

    /**
     * Show the form for creating a new bit doc accidente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $bitacoraAccidentes = BitacoraAccidente::pluck('descripcion','id')->all();
        
        return view('bit_doc_accidentes.create', compact('bitacoraAccidentes'));
    }

    /**
     * Store a new bit doc accidente in the storage.
     *
     * @param App\Http\Requests\BitDocAccidentesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitDocAccidentesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            BitDocAccidente::create($data);

            return redirect()->route('bit_doc_accidentes.bit_doc_accidente.index')
                             ->with('success_message', trans('bit_doc_accidentes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_doc_accidentes.unexpected_error')]);
        }
    }

    /**
     * Display the specified bit doc accidente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitDocAccidente = BitDocAccidente::with('bitacoraaccidente')->findOrFail($id);

        return view('bit_doc_accidentes.show', compact('bitDocAccidente'));
    }

    /**
     * Show the form for editing the specified bit doc accidente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitDocAccidente = BitDocAccidente::findOrFail($id);
        $bitacoraAccidentes = BitacoraAccidente::pluck('descripcion','id')->all();

        return view('bit_doc_accidentes.edit', compact('bitDocAccidente','bitacoraAccidentes'));
    }

    /**
     * Update the specified bit doc accidente in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitDocAccidentesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitDocAccidentesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitDocAccidente = BitDocAccidente::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitDocAccidente->update($data);

            return redirect()->route('bit_doc_accidentes.bit_doc_accidente.index')
                             ->with('success_message', trans('bit_doc_accidentes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_doc_accidentes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bit doc accidente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitDocAccidente = BitDocAccidente::findOrFail($id);
            $bitDocAccidente->delete();

            return redirect()->route('bit_doc_accidentes.bit_doc_accidente.index')
                             ->with('success_message', trans('bit_doc_accidentes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_doc_accidentes.unexpected_error')]);
        }
    }

    public function cargaArchivo(Request $request) {
        //dd($request);
        $r=false;
        try{
            if ($request->hasFile('file')) {
                
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $nombre = $file->getClientOriginalName();
                $nombre=date('dmYHmi')."_".str_replace(' ','_',$nombre);
                $r = Storage::disk('bit_doc_accidente')->put($nombre, \File::get($file));
                //dd($r);
                $data['documento']=$request->get('documento');
                $data['bitacora_accidente_id']=$request->get("bitacora_accidente_id");
                $data['archivo']=$nombre;
                //dd($data);
                $file= BitDocAccidente::create($data);
            } else {
                return "no";
            }

            if ($r) {
                return $nombre;
            } else {
                return "Error vuelva a intentarlo";
            }
        }catch(Exception $e){
            Log::info($e);
        }    
    }

    public function getFiles(Request $request){
        //dd($request->all());
        $lineas= BitDocAccidente::select('id', 'documento', 'archivo')
                                ->where('bitacora_accidente_id', '=', $request->get('bitacora_accidente_id'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'documento'=>$l->documento,
                                         'file_path'=>asset('/storage/bit_doc_accidente/'.$l->archivo),
                                         'file_name'=>$l->archivo
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
