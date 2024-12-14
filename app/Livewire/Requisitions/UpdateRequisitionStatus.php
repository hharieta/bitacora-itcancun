<?php

namespace App\Livewire\Requisitions;

use App\Models\Requisition;
use Livewire\Component;

class UpdateRequisitionStatus extends Component
{
    public Requisition $requisition;
    public $status;

    public function mount(Requisition $requisition)
    {
        $this->requisition = $requisition;
        $this->status = $requisition->status;
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required|string|in:' . implode(',', array_keys(Requisition::STATUS))
        ]);

        $this->requisition->update([
            'status' => $this->status
        ]);

        $this->dispatch('status-updated', [
            'message' => 'Estado actualizado correctamente',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.requisitions.update-requisition-status', [
            'statusOptions' => Requisition::STATUS
        ]);
    }
}