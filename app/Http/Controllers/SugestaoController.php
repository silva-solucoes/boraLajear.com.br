<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sugestao;

class SugestaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Busca todas as sugestões do banco de dados, paginado com 10 registros por página
         // Recebe o parâmetro de categoria do request
         $categoria = $request->input('categoria');

         // Query para buscar as sugestões
         $query = Sugestao::query();

         // Filtra por categoria se uma categoria específica foi selecionada
         if ($categoria) {
             $query->where('category', $categoria);
         }

         // Paginação com 10 registros por página
         $sugestoes = $query->orderBy('created_at', 'desc')->paginate(5);

        // Retorna a view com as sugestões paginadas
        return view('listar-sugestoes', compact('sugestoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retorna a view com o formulário para criar uma nova sugestão
        return view('criar-sugestao');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Cria uma nova sugestão no banco de dados
        Sugestao::create($request->all());

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->route('sugestoes.index')
            ->with('success', 'Sugestão criada com sucesso.');
    }

    // Aqui pode adicionar funções adicionais conforme necessário para o seu aplicativo
}
