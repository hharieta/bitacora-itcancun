<?php

namespace App\Livewire\Requisitions;

use App\Models\Article;
use App\Models\Requisition;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class CreateRequisition extends Component
{
    public $showNotification = false;
    public $notificationType = '';
    public $notificationMessage = '';
    
    public $folio;
    public $article_id;
    public $entry_time;
    public $exit_time;
    public $user_id;
    public $status = 'inactive';
    public $notes;

    const STATUS = ['active' => 'Activo', 'inactive' => 'Inactivo'];

    protected $rules = [
        'folio' => 'required|string|max:255',
        'article_id' => 'required|integer',
        'entry_time' => 'required|date',
        'exit_time' => 'nullable|date',
        'status' => 'required|string|in:active,inactive',
        'notes' => 'nullable|string',
    ];

    public function save()
    {
        try {
            $validated = $this->validate();
            $validated['user_id'] = auth()->id();
            Requisition::create($validated);
            $this->dispatch('open-modal', 'notification-modal');
            $this->notificationType = 'success';
            $this->notificationMessage = 'Requisición creada exitosamente.';
            $this->reset(['folio', 'article_id', 'entry_time', 'exit_time', 'notes']);
        }catch (\Exception $e) {
            $this->dispatch('open-modal', 'notification-modal');
            $this->notificationType = 'error';
            $this->notificationMessage = 'Error al crear la requisición: ' . $e->getMessage();
        }
    }

    public function mount()
    {
        $this->status = 'inactive';
    }

    public function render()
    {
        return view('livewire.requisitions.create-requisition',
    [
        'articles' => Article::all(),
    ]);
    }
}
