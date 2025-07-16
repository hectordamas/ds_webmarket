<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tenant\{PasswordResetCode};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    public function showRequestForm(){
        return view('tenant.password.forgot');
    }

    public function showResetForm(){
        return view('tenant.password.reset-code');
    }

    public function sendCode(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $code = random_int(100000, 999999); // 6 dígitos
        PasswordResetCode::create([
            'email' => $request->email,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($request->email)->send(new \App\Mail\PasswordResetCodeMail($code));

        return redirect('password/reset-code')->with('success', 'Código enviado a tu correo.');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
            'password' => 'required|confirmed|min:6',
        ]);
    
        $registro = PasswordResetCode::where('email', $request->email)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();
    
        if (!$registro) {
            return redirect()->back()->withErrors(['code' => 'Código inválido o expirado']);
        }
    
        // Actualizar contraseña
        User::where('email', $request->email)->update([
            'password' => bcrypt($request->password)
        ]);
    
        // Marcar código como usado
        $registro->update(['used' => true]);
    
        return redirect('/login')->with('success', 'Contraseña actualizada');
    }
}
