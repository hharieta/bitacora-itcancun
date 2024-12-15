<?php
namespace App\Livewire\Articles;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]
class ListArticles extends Component
{
    use WithPagination;

    public $editingArticleId = null;
    public $editingName = '';
    public $editingDescription = '';
    public $editingPrice = '';
    public $editingPartition = '';
    public $editingDepartment = '';
    public $editingDepartmentHead = '';

    public function editArticle($articleId)
    {
        $article = Article::find($articleId);
        $this->editingArticleId = $articleId;
        $this->editingName = $article->name;
        $this->editingDescription = $article->description;
        $this->editingPrice = $article->price;
        $this->editingPartition = $article->partition;
        $this->editingDepartment = $article->department;
        $this->editingDepartmentHead = $article->department_head;
    }

    public function updateArticle($articleId)
    {
        $this->validate([
            'editingName' => 'required|string|max:255',
            'editingDescription' => 'required|string',
            'editingPrice' => 'required|numeric|min:0',
            'editingPartition' => 'required|integer|min:0',
            'editingDepartment' => 'required|string|max:255',
            'editingDepartmentHead' => 'required|string|max:255',
        ]);

        $article = Article::find($articleId);
        $article->update([
            'name' => $this->editingName,
            'description' => $this->editingDescription,
            'price' => $this->editingPrice,
            'partition' => $this->editingPartition,
            'department' => $this->editingDepartment,
            'department_head' => $this->editingDepartmentHead,
        ]);

        $this->editingArticleId = null;
        $this->dispatch('article-updated', 'Artículo actualizado correctamente');
    }

    public function cancelEdit()
    {
        $this->editingArticleId = null;
        $this->reset([
            'editingName',
            'editingDescription',
            'editingPrice',
            'editingPartition',
            'editingDepartment',
            'editingDepartmentHead'
        ]);
    }

    public function render()
    {
        return view('livewire.articles.list-articles', [
            'articles' => Article::latest()->paginate(20)
        ]);
    }
}