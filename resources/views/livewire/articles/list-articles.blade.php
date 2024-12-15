{{-- resources/views/livewire/articles/list-articles.blade.php --}}
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="mb-4 flex items-center space-x-4">
        <div class="w-3/4 md:w-full">
            <div class="flex">
                <div class="flex-1 relative">
                    <input 
                        wire:model.live="search" 
                        type="text" 
                        class="w-full rounded-l-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                        placeholder="Buscar por nombre o descripción..."
                    />
                </div>
                <div class="relative">
                    <select 
                        wire:model.live="filterDepartment"
                        class="rounded-r-md border-l-0 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                    >
                        <option value="">Todos</option>
                        @foreach($departments as $department)
                            <option value="{{ $department }}">{{ $department }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
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
                                    <textarea 
                                        wire:model="editingDescription" 
                                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" 
                                        rows="2"
                                    ></textarea>
                                @else
                                    <div class="group relative inline-block">
                                        <span class="cursor-help">
                                            {{ Str::limit($article->description, 50, '...') }}
                                        </span>
                                        <div class="hidden group-hover:block absolute z-10 w-64 p-2 mt-2 text-sm bg-gray-600 text-white rounded-lg shadow-lg">
                                            {{ $article->description }}
                                        </div>
                                    </div>
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
                                <a 
                                    href="{{ route('articles.edit', $article) }}"
                                    class="text-indigo-600 hover:text-indigo-900"
                                >
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>