<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
            {{ __('Editar Artículo') }}
        </h2>

        <form wire:submit.prevent="update">
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Nombre" />
                        <x-text-input 
                            id="name"
                            type="text" 
                            wire:model="name" 
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" value="Precio" />
                        <x-text-input 
                            id="price"
                            type="number" 
                            step="0.01"
                            wire:model="price" 
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="partition" value="Partida" />
                        <x-text-input 
                            id="partition"
                            type="number" 
                            wire:model="partition" 
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('partition')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="department" value="Departamento" />
                        <x-text-input 
                            id="department"
                            type="text" 
                            wire:model="department" 
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('department')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="department_head" value="Jefe de Departamento" />
                        <x-text-input 
                            id="department_head"
                            type="text" 
                            wire:model="department_head" 
                            class="mt-1 block w-full"
                        />
                        <x-input-error :messages="$errors->get('department_head')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="description" value="Descripción" />
                    <textarea 
                        id="description"
                        wire:model="description"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        rows="4"
                    ></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
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