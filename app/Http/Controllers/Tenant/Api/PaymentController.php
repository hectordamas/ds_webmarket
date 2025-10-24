<?php

namespace App\Http\Controllers\Tenant\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Payment};

class PaymentController extends Controller
{
    public function store(Request $request){
		try {
			$data = [];
        	$datosReq = $request->all(); 
		
			for ($i = 0; $i < count($datosReq); $i++) {
				$data['Descrip'][$i] = @$datosReq[$i]['Descrip'];
				$data['Activo'][$i] = @$datosReq[$i]['Activo'];
                $data['CodMe'][$i] = @$datosReq[$i]['CodMe'];
			}

            for ($i = 0; $i < count($data['CodMe']); $i++) {
                $codme = $data['CodMe'][$i]  ?? null;
                $evento = $data['Evento'][$i] ?? null;

                if (!$codme || !$evento) {
                    continue;
                }
            
                $payment = Payment::where('codme', $codme)->first();
            
                if ($evento == 'D') {
                    if ($payment) {
                        $payment->delete();
                    }
                } else {
                    if (!$payment) {
                        $payment = new Payment();
                        $payment->codme = $codme;
                    }
                
                    $payment->codme = $data['CodMe'][$i];
                    $payment->name = $data['Descrip'][$i];
                    $payment->active = $data['Activo'][$i];
                    $payment->save();
                }
            }
            
            return response()->json([
                'success' => true
            ]);

        }catch(\Exception $e){
			return response()->json([$e->getMessage(), 'Linea ' . $e->getLine()]);
        };
    }
}
