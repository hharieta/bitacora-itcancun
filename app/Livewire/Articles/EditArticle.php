<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class EditArticle extends Component
{
    public Article $article;
    public $name;
    public $description;
    public $price;
    public $partition;
    public $department;
    public $department_head;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'partition' => 'required|integer|min:0',
        'department' => 'required|string|max:255',
        'department_head' => 'required|string|max:255',
    ];

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->name = $article->name;
        $this->description = $article->description;
        $this->price = $article->price;
        $this->partition = $article->partition;
        $this->department = $article->department;
        $this->department_head = $article->department_head;
    }

    public function update()
    {
        try {
            $this->validate();

            $this->article->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'partition' => $this->partition,
                'department' => $this->department,
                'department_head' => $this->department_head,
            ]);

            session()->flash('message', 'Artículo actualizado exitosamente.');
            return redirect()->route('articles.list');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar el artículo: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('articles.list');
    }

    public function render()
    {
        return view('livewire.articles.edit-article');
    }
}