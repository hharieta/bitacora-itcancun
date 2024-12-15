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

    public $editingRequisitionId = null;
    public $editingStatus = '';
    public $editingNotes = '';
    public $editingExitTime = '';

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
            'requisitions' => Requisition::with(['user', 'article'])->latest()->paginate(20),
            'statusOptions' => Requisition::STATUS
        ]);
    }
}