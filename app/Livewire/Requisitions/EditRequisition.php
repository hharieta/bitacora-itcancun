<?php

namespace App\Livewire\Requisitions;

use App\Models\Requisition;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class EditRequisition extends Component
{
    public Requisition $requisition;
    public array $statusOptions;
    public $showNotification = false;
    public $notificationType = '';
    public $notificationMessage = '';

    public $exit_time;
    public $notes;
    public $status;
    public $department;

    protected $rules = [
        'exit_time' => 'nullable|date',
        'notes' => 'nullable|string',
        'status' => 'required|string|in:active,inactive'
    ];

    public function mount(Requisition $requisition)
    {
        $this->requisition = $requisition;
        
        $this->exit_time = $requisition->exit_time ? $requisition->exit_time->format('Y-m-d\TH:i') : null;
        $this->notes = $requisition->notes;
        $this->status = $requisition->status;
        
        $this->statusOptions = [
            'active' => 'Activo',
            'inactive' => 'Inactivo'
        ];
    }

    public function update()
    {
        try {
            $this->validate();

            $this->requisition->exit_time = $this->exit_time;
            $this->requisition->notes = $this->notes;
            $this->requisition->status = $this->status;

            $this->requisition->save();
            
            $this->dispatch('open-modal', 'notification-modal');
            $this->notificationType = 'success';
            $this->notificationMessage = 'Requisición actualizada exitosamente.';
            
            return redirect()->route('requisitions.index');
        } catch (\Exception $e) {
            $this->dispatch('open-modal', 'notification-modal');
            $this->notificationType = 'error';
            $this->notificationMessage = 'Error al actualizar la requisición: ' . $e->getMessage();
        }
    }

    public function cancel()
    {
        return redirect()->route('requisitions.index');
    }

    public function render()
    {
        return view('livewire.requisitions.edit-requisition');
    }
}