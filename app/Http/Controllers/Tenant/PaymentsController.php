<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant\{Payment};

class PaymentsController extends Controller
{
    public function index(){
        $payments = Payment::orderBy('id', 'desc')->get();

        return view('tenant.admin.payments.index', compact('payments'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $payment = new Payment();
        $payment->name = $request->name;
        $payment->active = $request->has('active');
        $payment->save();

        return redirect()->back()->with('success', 'Método de pago creado con éxito!');
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $payment = Payment::find($id);
        $payment->name = $request->name;
        $payment->active = $request->has('active');
        $payment->save();

        return redirect()->back()->with('success', 'Método de pago creado con éxito!');
    }


}
