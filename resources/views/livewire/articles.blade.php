<div>
 <!-- Messages Flash -->
 @if (session()->has('message'))
 <div class="bg-green-100 border border-green-400 text-green-700 px4 py-3 rounded mb-6" role="alert">
 <span class="block sm:inline">{{ session('message') }}</span>
 </div>
 @endif
 <!-- Header avec bouton Créer et Recherche -->
 <div class="bg-white shadow rounded-lg p-6 mb-6">
 <div class="flex flex-col sm:flex-row sm:items-center sm:justifybetween gap-4">
 <div class="flex-1">
 <h2 class="text-xl font-semibold text-gray-900 mb2">Gestion des Articles</h2>
 <p class="text-gray-600">Créez, modifiez et gérez vos
articles facilement.</p>
 </div>
 <div class="flex flex-col sm:flex-row gap-3">
 <!-- Barre de recherche -->
 <div class="relative">
 <input
 type="text"
wire:model.debounce.300ms="search"
placeholder="Rechercher..."
 class="w-full sm:w-64 pl-10 pr-4 py-2 border
border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:bordertransparent"
 >
<div class="absolute inset-y-0 left-0 pl-3 flex itemscenter pointer-events-none">
 <svg class="h-5 w-5 text-gray-400" fill="none"
stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0
0114 0z"/>
 </svg>
 </div>
 </div>
 <!-- Bouton Créer -->
 <button
 wire:click="create"
class="bg-blue-600 hover:bg-blue-700 text-white px-6
py-2 rounded-lg font-medium transition duration-200 flex items-center gap2"
 >
 <svg class="w-5 h-5" fill="none" stroke="currentColor"
viewBox="0 0 24 24">
 <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
 </svg>
Nouvel Article
 </button>
 </div>
 </div>
 </div>
 <!-- Tableau des articles -->
  <div class="bg-white shadow rounded-lg overflow-hidden">
 <div class="overflow-x-auto">
 <table class="min-w-full divide-y divide-gray-200">
 <thead class="bg-gray-50">
 <tr>
 <th class="px-6 py-3 text-left">
 <button wire:click="sortBy('id')" class="textxs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700
flex items-center gap-1">
 ID
@if($sortBy === 'id')
 <svg class="w-4 h-4"
fill="currentColor" viewBox="0 0 20 20">
 @if($sortDirection === 'asc')
 <path d="M14.707 12.707a1 1 0
01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4
4a1 1 0 010 1.414z"/>
 @else
 <path d="M5.293 7.293a1 1 0
011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l4-4a1 1 0 010-1.414z"/>
 @endif
 </svg>
 @endif
 </button>
 </th>
<th class="px-6 py-3 text-left">
 <button wire:click="sortBy('title')"
class="text-xs font-medium text-gray-500 uppercase tracking-wider
hover:text-gray-700 flex items-center gap-1">
 Titre
@if($sortBy === 'title')
 <svg class="w-4 h-4"
fill="currentColor" viewBox="0 0 20 20">
 @if($sortDirection === 'asc')
 <path d="M14.707 12.707a1 1 0
01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4
4a1 1 0 010 1.414z"/>
 @else
 <path d="M5.293 7.293a1 1 0
011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l4-4a1 1 0 010-1.414z"/>
 @endif
 </svg>
 @endif
 </button>
 </th>
<th class="px-6 py-3 text-left text-xs font-medium
text-gray-500 uppercase tracking-wider">Catégorie</th>
 <th class="px-6 py-3 text-left text-xs font-medium
text-gray-500 uppercase tracking-wider">Statut</th>
 <th class="px-6 py-3 text-left">
 <button wire:click="sortBy('created_at')"
class="text-xs font-medium text-gray-500 uppercase tracking-wider
hover:text-gray-700 flex items-center gap-1">
 Créé le
@if($sortBy === 'created_at')
 <svg class="w-4 h-4"
fill="currentColor" viewBox="0 0 20 20">
 @if($sortDirection === 'asc')
 <path d="M14.707 12.707a1 1 0
01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4
4a1 1 0 010 1.414z"/>
 @else
 <path d="M5.293 7.293a1 1 0
011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l4-4a1 1 0 010-1.414z"/>
 @endif
 </svg>
 @endif
 </button>
 </th>
<th class="px-6 py-3 text-right text-xs font-medium
text-gray-500 uppercase tracking-wider">Actions</th>
 </tr>
 </thead>
 <tbody class="bg-white divide-y divide-gray-200">
 @forelse($articles as $article)
 <tr class="hover:bg-gray-50">
 <td class="px-6 py-4 whitespace-nowrap text-sm
font-medium text-gray-900">
 #{{ $article->id }}
 </td>
<td class="px-6 py-4">
 <div class="max-w-xs">
 <div class="text-sm font-medium textgray-900 truncate">{{ $article->title }}</div>
 <div class="text-sm text-gray-500
truncate">{{ Str::limit($article->content, 50) }}</div>
 </div>
 </td>
<td class="px-6 py-4 whitespace-nowrap">
 @if($article->category)
 <span class="inline-flex items-center
px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
 {{ $article->category }}
 </span>
 @else
 <span class="text-gray-400 textsm">Aucune</span>
 @endif
 </td>
<td class="px-6 py-4 whitespace-nowrap">
 <button
 wire:click="togglePublished({{
$article->id }})"
 class="inline-flex items-center px-2.5
py-0.5 rounded-full text-xs font-medium transition duration-200 {{
$article->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' :
'bg-red-100 text-red-800 hover:bg-red-200' }}"
 >
 {{ $article->is_published ? 'Publié' :
'Brouillon' }}
 </button>
 </td>
<td class="px-6 py-4 whitespace-nowrap text-sm
text-gray-500">
 {{ $article->created_at->format('d/m/Y') }}
 </td>
<td class="px-6 py-4 whitespace-nowrap textright text-sm font-medium">
    <div class="flex items-center justify-end
gap-2">
 <button
 wire:click="edit({{ $article->id
}})"
 class="text-blue-600 hover:textblue-900 transition duration-200"
 title="Modifier"
 >
 <svg class="w-5 h-5" fill="none"
stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round"
stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0
002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v2.828l8.586-8.586z"/>
 </svg>
 </button>
 <button
 wire:click="confirmDelete({{
$article->id }})"
 class="text-red-600 hover:text-red900 transition duration-200"
 title="Supprimer"
 >
 <svg class="w-5 h-5" fill="none"
stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round"
stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0
0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-
1h-4a1 1 0 00-1 1v3M4 7h16"/>
 </svg>
 </button>
 </div>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="6" class="px-6 py-12 text-center
text-gray-500">
 <svg class="mx-auto h-12 w-12 text-gray-400
mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2
2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2
2z"/>
 </svg>
<p class="text-lg font-medium">Aucun
article trouvé</p>
 <p class="text-sm">Commencez par créer
votre premier article.</p>
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 <!-- Pagination -->
 <div class="bg-white px-4 py-3 border-t border-gray-200">
 {{ $articles->links() }}
 </div>
  </div>
 <!-- Modal Créer/Modifier -->
 @if($showModal)
 <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto
h-full w-full z-50">
 <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4
lg:w-1/2 shadow-lg rounded-md bg-white">
 <div class="mt-3">
 <div class="flex items-center justify-between mb-4">
 <h3 class="text-lg font-medium text-gray-900">
 {{ $updateMode ? 'Modifier l\'article' : 'Créer
un nouvel article' }}
 </h3>
<button wire:click="closeModal" class="text-gray400 hover:text-gray-600">
 <svg class="w-6 h-6" fill="none"
stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
 </svg>
 </button>
 </div>
 <form wire:submit.prevent="{{ $updateMode ? 'update' :
'store' }}">
 <div class="grid grid-cols-1 gap-4">
 <!-- Titre -->
 <div>
 <label for="title" class="block text-sm
font-medium text-gray-700 mb-1">Titre *</label>
 <input
 type="text"
wire:model="title"
id="title"
class="w-full px-3 py-2 border bordergray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
focus:border-transparent @error('title') border-red-500 @enderror"
 placeholder="Entrez le titre de
l'article"
 >
 @error('title')
 <p class="mt-1 text-sm text-red-600">{{
$message }}</p>
 @enderror
 </div>
 <!-- Catégorie -->
 <div>
 <label for="category" class="block text-sm
font-medium text-gray-700 mb-1">Catégorie</label>
 <input
 type="text"
wire:model="category"
id="category"
class="w-full px-3 py-2 border bordergray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
focus:border-transparent @error('category') border-red-500 @enderror"
 placeholder="Ex: Technologie,
Actualités..."
 >
 @error('category')
 <p class="mt-1 text-sm text-red-600">{{
$message }}</p>
 @enderror
 </div>
 <!-- Contenu -->
 <div>
 <label for="content" class="block text-sm
font-medium text-gray-700 mb-1">Contenu *</label>
 <textarea
 wire:model="content"
id="content"
 rows="5"
 class="w-full px-3 py-2 border bordergray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
focus:border-transparent @error('content') border-red-500 @enderror"
 placeholder="Rédigez le contenu de
votre article..."
 ></textarea>
@error('content')
 <p class="mt-1 text-sm text-red-600">{{
$message }}</p>
 @enderror
 </div>
 <!-- Statut de publication -->
 <div class="flex items-center">
 <input
 type="checkbox"
wire:model="is_published"
id="is_published"
class="h-4 w-4 text-blue-600
focus:ring-blue-500 border-gray-300 rounded"
 >
<label for="is_published" class="ml-2 block
text-sm text-gray-900">
 Publier immédiatement
 </label>
 </div>
 </div>
 <!-- Boutons -->
 <div class="flex items-center justify-end mt-6 pt-4
border-t space-x-3">
 <button
 type="button"
 wire:click="closeModal"
class="px-4 py-2 text-sm font-medium textgray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200
focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
 >
 Annuler
 </button>
<button
 type="submit"
 class="px-4 py-2 text-sm font-medium textwhite bg-blue-600 border border-transparent rounded-md hover:bg-blue-700
focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
{{ $updateMode ? 'Mettre à jour' : 'Créer'
}}
 </button>
 </div>
 </form>
 </div>
 </div>
 </div>
 @endif
 <!-- Modal Confirmation Suppression -->
 @if($confirmDelete)
 <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto
h-full w-full z-50">
 <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg
rounded-md bg-white">
 <div class="mt-3 text-center">
 <div class="mx-auto flex items-center justify-center h12 w-12 rounded-full bg-red-100 mb-4">
 <svg class="h-6 w-6 text-red-600" fill="none"
stroke="currentColor" viewBox="0 0 24 24">
 <path stroke-linecap="round" strokelinejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0
2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-
.77.833.192 2.5 1.732 2.5z"/>
 </svg>
 </div>
<h3 class="text-lg font-medium text-gray-900 mb2">Confirmer la suppression</h3>
 <p class="text-sm text-gray-500 mb-4">
 Êtes-vous sûr de vouloir supprimer cet article ?
 Cette action est irréversible.
 </p>
<div class="flex items-center justify-center space-x3">
 <button
 wire:click="cancelDelete"
 class="px-4 py-2 text-sm font-medium text-gray700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200
focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
 >
 Annuler
 </button>
<button
 wire:click="delete"
class="px-4 py-2 text-sm font-medium text-white
bg-red-600 border border-transparent rounded-md hover:bg-red-700
focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
 >
 Supprimer
 </button>
 </div>
 </div>
 </div>
 </div>
 @endif
</div>
routes/web.php
<?php