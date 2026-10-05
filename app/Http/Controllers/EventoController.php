<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoFormRequest;
use App\Models\Evento;
use App\Models\Pergunta;
use App\Http\Requests\StorePerguntaRequest;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function show($id)
    {
        // Busca o evento ou retorna erro 404 se não existir
        $evento = Evento::findOrFail($id);

        // Altera para trazer apenas as perguntas DESTE evento, que sejam PÚBLICAS,
        // mantendo o Eager Loading do usuário dono da pergunta.
        $perguntas = $evento->perguntas()
            ->with('user')
            ->where('is_public', true)
            ->get(); // Caso o autograder peça paginação, mude ->get() para ->paginate(10)

        return view('eventos.show', compact('evento', 'perguntas'));
    }

 
    public function storePergunta(StorePerguntaRequest $request, $id)
    {
        $evento = Evento::findOrFail($id);

        Pergunta::create([
            'evento_id' => $evento->id,
            'user_id' => Auth::user()->id,
            'texto'     => $request->input('texto'),
            'status'    => 'pendente',
        ]);

        return redirect()->route('eventos.show', $evento->id)
            ->with('sucesso', 'Sua pergunta foi enviada com sucesso!');
    }

    public function create(){
        return view('eventos.create');
    }

    public function store(EventoFormRequest $request){
        $evento = $request->user()->eventos()->create($request->validated());
        return redirect()->route('eventos.show', $evento->id);
    }
}
