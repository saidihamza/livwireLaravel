<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Article;
use Livewire\WithPagination;

class Articles extends Component
{
 use WithPagination;
 public  $title, $content, $category, $is_published = false;
 public $article_id;
 public $updateMode = false;
 public $search = '';
 public $sortBy = 'created_at';
 public $sortDirection = 'desc';
 public $showModal = false;
 public $confirmDelete = false;
 public $deleteId;
 protected $rules = [
 'title' => 'required|string|max:255',
 'content' => 'required|string',
 'category' => 'nullable|string|max:100',
 'is_published' => 'boolean'
 ];
 protected $messages = [
 'title.required' => 'Le titre est obligatoire.',
 'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
 'content.required' => 'Le contenu est obligatoire.',
 'category.max' => 'La catégorie ne peut pas dépasser 100
caractères.'
 ];
 public function render()
 {
 $articles = Article::query()
 ->when($this->search, function ($query) {
 $query->where('title', 'like', '%' . $this->search . '%')
 ->orWhere('content', 'like', '%' . $this->search .
'%')
 ->orWhere('category', 'like', '%' . $this->search .
'%');
 })
 ->orderBy($this->sortBy, $this->sortDirection)
 ->paginate(5);
         return view('livewire.articles', [
            'articles' => $articles
        ]);
 }
 public function updatingSearch()
 {
 $this->resetPage();
 }
 public function sortBy($field)
 {
 if ($this->sortBy === $field) {
 $this->sortDirection = $this->sortDirection === 'asc' ? 'desc'
: 'asc';
 } else {
 $this->sortBy = $field;
 $this->sortDirection = 'asc';
 }
 }
 private function resetInputFields()
 {
 $this->title = '';
 $this->content = '';
 $this->category = '';
 $this->is_published = false;
 $this->article_id = '';
 }
 public function create()
 {
 $this->resetInputFields();
 $this->updateMode = false;
 $this->showModal = true;
 }
 public function store()
 {
 $this->validate();
 Article::create([
 'title' => $this->title,
 'content' => $this->content,
 'category' => $this->category,
 'is_published' => $this->is_published
 ]);
 session()->flash('message', 'Article créé avec succès !');
 $this->closeModal();
 $this->resetInputFields();
  }
 public function edit($id)
 {
 $article = Article::findOrFail($id);
 $this->article_id = $id;
 $this->title = $article->title;
 $this->content = $article->content;
 $this->category = $article->category;
 $this->is_published = $article->is_published;
 $this->updateMode = true;
 $this->showModal = true;
 }
 public function update()
 {
 $this->validate();
 Article::find($this->article_id)->update([
 'title' => $this->title,
 'content' => $this->content,
 'category' => $this->category,
 'is_published' => $this->is_published
 ]);
 session()->flash('message', 'Article mis à jour avec succès !');
 $this->closeModal();
 $this->resetInputFields();
 $this->updateMode = false;
 }
 public function confirmDelete($id)
 {
 $this->deleteId = $id;
 $this->confirmDelete = true;
 }
 public function delete()
 {
 Article::find($this->deleteId)->delete();
 session()->flash('message', 'Article supprimé avec succès !');
 $this->confirmDelete = false;
 $this->deleteId = null;
 }
 public function closeModal()
 {
 $this->showModal = false;
 $this->resetValidation();
 }
 public function cancelDelete()
 {
 $this->confirmDelete = false;
 $this->deleteId = null;
 }
 public function togglePublished($id)
 {
 $article = Article::find($id);
 $article->is_published = !$article->is_published;
 $article->save();
 session()->flash('message', 'Statut de publication mis à jour !');
 }
}