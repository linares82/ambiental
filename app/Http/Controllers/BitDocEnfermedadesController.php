<?php

namespace App\Http\Controllers;

use App\Models\BitDocEnfermedade;
use App\Models\BitacoraEnfermedade;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitDocEnfermedadesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;


class BitDocEnfermedadesController extends Controller
{

    /**
     * Display a listing of the bit doc enfermedades.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitDocEnfermedade::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitDocEnfermedades = $r->with('bitacoraenfermedade')->paginate(25);
		//$bitDocEnfermedades = BitDocEnfermedade::with('bitacoraenfermedade')->paginate(25);

        return view('bit_doc_enfermedades.index', compact('bitDocEnfermedades'));
    }

    /**
     * Show the form for creating a new bit doc enfermedade.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $bitacoraEnfermedades = BitacoraEnfermedade::pluck('descripcion','id')->all();
        
        return view('bit_doc_enfermedades.create', compact('bitacoraEnfermedades'));
    }

    /**
     * Store a new bit doc enfermedade in the storage.
     *
     * @param App\Http\Requests\BitDocEnfermedadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitDocEnfermedadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            BitDocEnfermedade::create($data);

            return redirect()->route('bit_doc_enfermedades.bit_doc_enfermedade.index')
                             ->with('success_message', trans('bit_doc_enfermedades.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_doc_enfermedades.unexpected_error')]);
        }
    }

    /**
     * Display the specified bit doc enfermedade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitDocEnfermedade = BitDocEnfermedade::with('bitacoraenfermedade')->findOrFail($id);

        return view('bit_doc_enfermedades.show', compact('bitDocEnfermedade'));
    }

    /**
     * Show the form for editing the specified bit doc enfermedade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitDocEnfermedade = BitDocEnfermedade::findOrFail($id);
        $bitacoraEnfermedades = BitacoraEnfermedade::pluck('descripcion','id')->all();

        return view('bit_doc_enfermedades.edit', compact('bitDocEnfermedade','bitacoraEnfermedades'));
    }

    /**
     * Update the specified bit doc enfermedade in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitDocEnfermedadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitDocEnfermedadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitDocEnfermedade = BitDocEnfermedade::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitDocEnfermedade->update($data);

            return redirect()->route('bit_doc_enfermedades.bit_doc_enfermedade.index')
                             ->with('success_message', trans('bit_doc_enfermedades.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_doc_enfermedades.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bit doc enfermedade from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitDocEnfermedade = BitDocEnfermedade::findOrFail($id);
            $bitDocEnfermedade->delete();

            return redirect()->route('bit_doc_enfermedades.bit_doc_enfermedade.index')
                             ->with('success_message', trans('bit_doc_enfermedades.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_doc_enfermedades.unexpected_error')]);
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
                $r = Storage::disk('bit_doc_enfermedade')->put($nombre, \File::get($file));
                //dd($r);
                $data['documento']=$request->get('documento');
                $data['bitacora_enfermedade_id']=$request->get("bitacora_enfermedade_id");
                $data['archivo']=$nombre;
                //dd($data);
                $file= BitDocEnfermedade::create($data);
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
        $lineas= BitDocEnfermedade::select('id', 'documento', 'archivo')
                                ->where('bitacora_enfermedade_id', '=', $request->get('bitacora_enfermedade_id'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'documento'=>$l->documento,
                                         'file_path'=>asset('/storage/bit_doc_enfermedade/'.$l->archivo),
                                         'file_name'=>$l->archivo
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
