<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::user() && Auth::user()->is_active) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        /* Validações */
        $validated = Validator::make($request->all(), [
            'cpf'      => 'required',
            'password' => 'required'
        ], [
            'cpf.required'      => "Por favor, entre com seu CPF",
            'password.required' => "Por favor, entre com sua senha",
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        /* Autenticação */
        $credentials = $request->only([
            'cpf',
            'password'
        ]);

        $cpf = preg_replace('/\D/', '', $request->input('cpf'));

        if (Auth::attempt([
            'cpf'      => $cpf,
            'password' => $credentials['password']
        ])) {
            if (Auth::check() && !Auth::user()->is_active) {
                return response()->json(['errors' => 'Usuário inativo, entre em contato com o administrador']);
            }
            return response()->json(['success' => 'Usuário logado com sucesso']);
        }

        return response()->json(['errors' => 'CPF e/ou senha não conferem']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
