{{-- resources/views/livewire/requisitions/list-requisitions.blade.php --}}
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
            {{ __('Requisiciones') }}
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Folio</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Artículo</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Fecha de Entrada</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Fecha de Salida</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Notas</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Estado</th>
                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($requisitions as $requisition)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $requisition->folio }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $requisition->article->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $requisition->entry_time }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($editingRequisitionId === $requisition->id)
                                    <x-text-input 
                                        type="datetime-local" 
                                        wire:model="editingExitTime" 
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        max="9999-12-31T23:59"
                                        min="1000-01-01T00:00"
                                        pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}" 
                                        oninput="if(this.value.match(/\d{5}/)) this.value = this.value.slice(0,4) + this.value.slice(5)"
                                    />
                                @else
                                    {{ $requisition->exit_time }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($editingRequisitionId === $requisition->id)
                                    <textarea 
                                        wire:model="editingNotes"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        rows="4"
                                    ></textarea>
                                @else
                                    {{ $requisition->notes }}
                                @endif
                            </td>
                            <td class="flex px-6 py-4 whitespace-nowrap">
                                @if ($editingRequisitionId === $requisition->id)
                                    <select 
                                        wire:model="editingStatus"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    >
                                        @foreach ($statusOptions as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $requisition->status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-800' }}">
                                        {{ $statusOptions[$requisition->status] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($editingRequisitionId === $requisition->id)
                                    <button 
                                        wire:click="updateRequisition({{ $requisition->id }})"
                                        class="text-indigo-600 hover:text-indigo-900 mr-3"
                                    >
                                        Guardar
                                    </button>
                                    <button 
                                        wire:click="$set('editingRequisitionId', null)"
                                        class="text-gray-600 hover:text-gray-900"
                                    >
                                        Cancelar
                                    </button>
                                @else
                                    <button 
                                        wire:click="editRequisition({{ $requisition->id }})"
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