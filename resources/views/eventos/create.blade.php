@extends('layouts.app') {{-- Ou o layout principal que seu projeto estiver usando --}}

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Contêiner centralizado e estilizado com Tailwind (Ticket #007) -->
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Criar Novo Evento</h2>

        <form action="{{ route('eventos.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Campo: Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título do Evento</label>
                <input 
                    type="text" 
                    name="titulo" 
                    id="titulo" 
                    value="{{ old('titulo') }}" 
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 
                    @error('titulo') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror"
                    placeholder="Digite o título do evento"
                >
                <!-- Feedback de erro em vermelho (Ticket #008) -->
                @error('titulo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Descrição -->
            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea 
                    name="descricao" 
                    id="descricao" 
                    rows="4" 
                    class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 
                    @error('descricao') border-red-500 focus:ring-red-500 @else border-gray-300 @enderror"
                    placeholder="Descreva os detalhes do evento"
                >{{ old('descricao') }}</textarea>
                <!-- Feedback de erro em vermelho (Ticket #008) -->
                @error('descricao')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botão de Envio Estilizado com Hover (Ticket #007) -->
            <div class="flex justify-end pt-4">
                <button 
                    type="submit" 
                    class="w-full sm:w-auto bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-md shadow-md hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Criar Evento
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
