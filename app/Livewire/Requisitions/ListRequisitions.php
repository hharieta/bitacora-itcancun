<?php
// app/Livewire/Requisitions/ListRequisitions.php

namespace App\Livewire\Requisitions;

use App\Models\Requisition;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ListRequisitions extends Component
{
    public $editingRequisitionId = null;
    public $editingStatus = '';

    public function editStatus($requisitionId)
    {
        $this->editingRequisitionId = $requisitionId;
        $this->editingStatus = Requisition::find($requisitionId)->status;
    }

    public function updateStatus($requisitionId)
    {
        $requisition = Requisition::find($requisitionId);
        $requisition->update([
            'status' => $this->editingStatus
        ]);

        $this->editingRequisitionId = null;
        $this->dispatch('requisition-updated', 'Estado actualizado correctamente');
    }

    public function render()
    {
        return view('livewire.requisitions.list-requisitions', [
            'requisitions' => Requisition::with(['user', 'article'])->latest()->get(),
            'statusOptions' => Requisition::STATUS
        ]);
    }
}