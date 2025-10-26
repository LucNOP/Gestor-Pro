<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('projects.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Novo Projeto
                    </a>

                    <div class="mt-6">
                        @forelse ($projects as $project)
                            <div class="flex justify-between items-center py-4 border-b last:border-b-0">
                                {{-- Título e Descrição --}}
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $project->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $project->description }}</p>
                                </div>

                                {{-- Botão de Editar --}}
                                <div>
                                    <a href="{{ route('projects.edit', $project) }}"
                                        class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                        Editar
                                    </a>
                                </div>
                                {{-- Formulário de Excluir --}}
                                <form method="POST" action="{{ route('projects.destroy', $project) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type-="submit" class="text-sm font-medium text-red-600 hover:text-red-800"
                                        onclick="return confirm('Tem certeza que deseja excluir este projeto?')">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p>Não foi encontrado projetos.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>