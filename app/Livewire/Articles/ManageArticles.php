<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ManageArticles extends Component
{
    use WithPagination;

    public $name;
    public $description;
    public $price;
    public $partition;
    public $department;
    public $department_head;
    public $articleId;
    public $editing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'partition' => 'required|integer|min:0',
        'department' => 'required|string|max:255',
        'department_head' => 'required|string|max:255',
    ];

    public function save()
    {
        try {
            $validated = $this->validate();
            
            Article::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'partition' => $this->partition,
                'department' => $this->department,
                'department_head' => $this->department_head,
            ]);

            session()->flash('message', 'Artículo creado exitosamente.');
            $this->reset();
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear el artículo: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->articleId = $id;
        $this->name = $article->name;
        $this->description = $article->description;
        $this->price = $article->price;
        $this->partition = $article->partition;
        $this->department = $article->department;
        $this->department_head = $article->department_head;
        $this->editing = true;
    }

    public function update()
    {
        try {
            $validated = $this->validate();
            $article = Article::findOrFail($this->articleId);
            $article->update($validated);
            
            session()->flash('message', 'Artículo actualizado exitosamente.');
            $this->reset(['name', 'description', 'price', 'partition', 'department', 'department_head', 'articleId']);
            $this->editing = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar el artículo: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        $this->reset();
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.articles.manage-articles',
        [
            'articles' => Article::latest()->paginate(10)
        ]);
    }
}
