<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
            {{ __('Editar Requisición') }} - Folio: {{ $requisition->folio }}
        </h2>

        <div class="mb-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <x-input-label value="Artículo" />
                    <p class="mt-1 text-gray-600 dark:text-gray-400">
                        {{ $requisition->article->name }}
                    </p>
                </div>

                <div>
                    <x-input-label value="Fecha de Entrada" />
                    <p class="mt-1 text-gray-600 dark:text-gray-400">
                        {{ $requisition->entry_time }}
                    </p>
                </div>
                @if($requisition->user)
                <div>
                    <x-input-label value="Usuario" />
                    <p class="mt-1 text-gray-600 dark:text-gray-400">
                        {{ $requisition->user->name }}
                    </p>
                </div>
                @endif
                <div>
                    <x-input-label value="Departamento" />
                    <p class="mt-1 text-gray-600 dark:text-gray-400">
                        {{ $requisition->article->department }}
                    </p>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="update">
            <div class="space-y-6">
                <div class="flex flex-col md:flex-row gap-6 justify-start">
                    <div class="w-full md:w-48 lg:w-48">
                        <x-input-label for="exit_time" value="Fecha de Salida" />
                        <x-text-input 
                            id="exit_time"
                            type="datetime-local" 
                            wire:model="exit_time" 
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('requisition.exit_time')" class="mt-2" />
                    </div>
                    <div class="w-full md:w-32 lg:w-32">
                        <x-input-label for="status" value="Estado" />
                        <select 
                            id="status"
                            wire:model="status"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        >
                        @foreach ($statusOptions as $value => $label)
                            <option value="{{ $value }}">
                                {{ $label }}
                            </option>
                        @endforeach
                        </select>
                            <x-input-error :messages="$errors->get('requisition.status')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label for="notes" value="Notas" />
                    <textarea 
                        id="notes"
                        wire:model="notes"
                        class="mt-1 block w-full md:w-3/4 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        rows="4"
                    ></textarea>
                    <x-input-error :messages="$errors->get('requisition.notes')" class="mt-2" />
                </div>

                <div class="flex justify-end space-x-4">
                    <x-secondary-button wire:click="cancel" type="button">
                        Cancelar
                    </x-secondary-button>
                    
                    <x-primary-button type="submit">
                        Guardar Cambios
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</div>