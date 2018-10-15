<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ARrAmbientale;
class CambiarStReqReg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ian:cambiarStReqReg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia el estatus de reg reg ambiental cuando se alcanza la fecha de vigencia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hoy=date('Y/m/d');
        $registros= ARrAmbientale::select('a_rr_ambientales.id','a_rr_ambientales.st_rr_id')
                                 ->whereDate('a_rr_ambientales.fec_fin_vigencia', $hoy)
                                 ->join('a_rr_amb_leyes as l','l.descripcion','=','a_rr_ambientales.descripcion')
                                 ->where('l.activo',1)
                                 ->get();
        //dd($registros->toArray());
        foreach($registros as $r){
            $registro= ARrAmbientale::find($r->id);
            $registro->st_rr_id=1;
            $registro->save();
        }
    }
}
