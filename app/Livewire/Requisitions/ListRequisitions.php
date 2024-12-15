<?php
// app/Livewire/Requisitions/ListRequisitions.php

namespace App\Livewire\Requisitions;

use App\Models\Requisition;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ListRequisitions extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $dateType = 'entry'; // 'entry' o 'exit'
    public $searchDate = '';

    public $editingRequisitionId = null;
    public $editingStatus = '';
    public $editingNotes = '';
    public $editingExitTime = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingSearchDate()
    {
        $this->resetPage();
    }

    public function updatingDateType()
    {
        $this->resetPage();
    }

    public function editStatus($requisitionId)
    {
        $this->editingRequisitionId = $requisitionId;
        $this->editingStatus = Requisition::find($requisitionId)->status;
    }

    public function editRequisition($requisitionId)
    {
        $requisition = Requisition::find($requisitionId);
        $this->editingRequisitionId = $requisitionId;
        $this->editingStatus = $requisition->status;
        $this->editingNotes = $requisition->notes;
        $this->editingExitTime = $requisition->exit_time;
    }

    public function updateRequisition($requisitionId)
    {
        $requisition = Requisition::find($requisitionId);
        $requisition->update([
            'status' => $this->editingStatus,
            'notes' => $this->editingNotes,
            'exit_time' => $this->editingExitTime
        ]);

        $this->editingRequisitionId = null;
        $this->dispatch('requisition-updated', 'Estado actualizado correctamente');
    }

    public function render()
    {
        return view('livewire.requisitions.list-requisitions', [
            'requisitions' => Requisition::with(['user', 'article'])
                ->when($this->search, function($query) {
                    $query->where('folio', 'like', '%' . $this->search . '%')
                        ->orWhereHas('article', function($subQuery) {
                            $subQuery->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->when($this->filterStatus !== '', function($query) {
                    $query->where('status', $this->filterStatus);
                })
                ->when($this->searchDate, function($query) {
                    $dateField = $this->dateType === 'entry' ? 'entry_time' : 'exit_time';
                    $query->whereDate($dateField, $this->searchDate);
                })
                ->latest()
                ->paginate(20),
            'statusOptions' => Requisition::STATUS
        ]);
    }
}