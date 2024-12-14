{{-- resources/views/livewire/articles/list-articles.blade.php --}}
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
            {{ __('Lista de Artículos') }}
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Nombre</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Descripción</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Precio</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Partida</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Departamento</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Jefe Depto.</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($articles as $article)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($editingArticleId === $article->id)
                                    <x-text-input wire:model="editingName" class="block w-full" type="text" />
                                @else
                                    {{ $article->name }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingArticleId === $article->id)
                                    <textarea wire:model="editingDescription" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="2"></textarea>
                                @else
                                    {{ $article->description }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($editingArticleId === $article->id)
                                    <x-text-input wire:model="editingPrice" class="block w-full" type="number" step="0.01" />
                                @else
                                    ${{ number_format($article->price, 2) }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($editingArticleId === $article->id)
                                    <x-text-input wire:model="editingPartition" class="block w-full" type="number" />
                                @else
                                    {{ $article->partition }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($editingArticleId === $article->id)
                                    <x-text-input wire:model="editingDepartment" class="block w-full" type="text" />
                                @else
                                    {{ $article->department }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($editingArticleId === $article->id)
                                    <x-text-input wire:model="editingDepartmentHead" class="block w-full" type="text" />
                                @else
                                    {{ $article->department_head }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($editingArticleId === $article->id)
                                    <button 
                                        wire:click="updateArticle({{ $article->id }})"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3"
                                    >
                                        Guardar
                                    </button>
                                    <button 
                                        wire:click="cancelEdit"
                                        class="text-gray-600 hover:text-gray-900"
                                    >
                                        Cancelar
                                    </button>
                                @else
                                    <button 
                                        wire:click="editArticle({{ $article->id }})"
                                        class="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Editar
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>