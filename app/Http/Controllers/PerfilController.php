<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class PerfilController extends Controller
{
    /**
     * Mostra a página de perfil do usuário.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $formattedUpdatedAt = Carbon::parse($user->updated_at)->timezone('America/Sao_Paulo');
        return view('meu-perfil', compact('user', 'formattedUpdatedAt'));
    }

    /**
     * Processa a atualização do perfil do usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validação dos dados do formulário
        //$request->validate(['username' => 'required|string|max:255|unique:users,username,' . $user->id,'password' => 'nullable|string|min:8|confirmed',]);

        // Preparar dados para atualização
        $data = [
            'username' => $request->username,
        ];

        // Verifica se foi solicitada a atualização da senha
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        try {
            // Atualiza o usuário
            User::where('id', $user->id)->update($data);
        } catch (\Exception $e) {
            // Tratamento de erro: redireciona de volta com uma mensagem de erro
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocorreu um erro ao salvar o perfil. Por favor, tente novamente.']);
        }

        return redirect()->route('perfil.mostrar')->with('success', 'Perfil atualizado com sucesso!');
    }
}
