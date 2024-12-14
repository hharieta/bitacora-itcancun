{{-- resources/views/livewire/articles/manage-articles.blade.php --}}

<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif
    <x-modal name="notification-modal" :show="false">
        <div class="p-6">
            <div class="flex items-center justify-center">
                @if($notificationType === 'success')
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                @else
                    <div class="bg-red-100 rounded-full p-3">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $notificationType === 'success' ? 'Éxito' : 'Error' }}
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        {{ $notificationMessage }}
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button wire:click="$dispatch('close-modal', 'notification-modal')">
                    Cerrar
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        {{-- Formulario de creación --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Crear Nuevo Artículo') }}
            </h2>

            <form wire:submit.prevent="{{ $editing ? 'update' : 'save' }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input wire:model="name" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Descripción')" />
                    <textarea 
                        wire:model="description"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        rows="3"
                    ></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="price" :value="__('Precio')" />
                    <x-text-input wire:model="price" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="partition" :value="__('Partida')" />
                    <x-text-input wire:model="partition" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('partition')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="department" :value="__('Departamento')" />
                    <x-text-input wire:model="department" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="department_head" :value="__('Jefe de Departamento')" />
                    <x-text-input wire:model="department_head" type="text" class="mt-1 block w-full" required />
                    <x-input-error :messages="$errors->get('department_head')" class="mt-2" />
                </div>

                <div class="flex justify-end gap-4">
                    @if($editing)
                        <div >
                            <x-secondary-button type="button" wire:click="cancelEdit">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                        </div>
                        <div>
                            <x-primary-button type="submit">
                                {{ __('Actualizar Artículo') }}
                            </x-primary-button>
                        </div>
                    @else
                        <x-primary-button type="submit">
                            {{ __('Guardar Artículo') }}
                        </x-primary-button>
                    @endif
                </div>
            </form>
        </div>

        {{-- Lista de artículos --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Artículos Registrados') }}
                </h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Nombre</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Precio</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Partida</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Departamento</th>
                                <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Responsable</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($articles as $article)
                                <tr>
                                    <td class="px-6 py-4">{{ $article->name }}</td>
                                    <td class="px-6 py-4">${{ number_format($article->price, 2) }}</td>
                                    <td class="px-6 py-4">{{ $article->partition }}</td>
                                    <td class="px-6 py-4">{{ $article->department }}</td>
                                    <td class="px-6 py-4">{{ $article->department_head }}</td>
                                    <td class="px-6 py-4">
                                        <x-secondary-button wire:click="edit({{ $article->id }})">
                                            {{ __('Editar') }}
                                        </x-secondary-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>