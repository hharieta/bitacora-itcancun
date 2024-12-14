{{-- resources/views/livewire/requisitions/create-requisition.blade.php --}}
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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Crear Nueva Requisición') }}
            </h2>

            <form wire:submit="save" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="folio" :value="__('Folio')" />
                        <x-text-input wire:model="folio" type="text" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('folio')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="article_id" :value="__('Artículo')" />
                        <select 
                            wire:model="article_id"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required
                        >
                            <option value="">Seleccionar Artículo</option>
                            @foreach($articles as $article)
                                <option value="{{ $article->id }}">
                                    {{ $article->name }} - {{ $article->partition_number }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('article_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="entry_time" :value="__('Hora de Entrada')" />
                        <x-text-input wire:model="entry_time" type="datetime-local" class="mt-1 block w-full" required pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}" oninput="if(this.value.match(/\d{5}/)) this.value = this.value.slice(0,4) + this.value.slice(5)"/>
                        <x-input-error :messages="$errors->get('entry_time')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="exit_time" :value="__('Hora de Salida')" />
                        <x-text-input wire:model="exit_time" type="datetime-local" class="mt-1 block w-full" pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}" oninput="if(this.value.match(/\d{5}/)) this.value = this.value.slice(0,4) + this.value.slice(5)"/>
                        <x-input-error :messages="$errors->get('exit_time')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="status" :value="__('Estado')" />
                        <select 
                            wire:model="status"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required
                        >
                            @foreach(self::STATUS as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="notes" :value="__('Notas')" />
                        <textarea 
                            wire:model="notes"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            rows="3"
                        ></textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button type="submit">
                        {{ __('Crear Requisición') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>