<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Exibir o formulário de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Processar o login
    public function login(Request $request)
    {
        // Validar os dados do formulário de login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentar autenticar o usuário
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Redirecionar para o dashboard após login bem-sucedido
        }

        // Retornar com mensagem de erro se a autenticação falhar
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ]);
    }
}
