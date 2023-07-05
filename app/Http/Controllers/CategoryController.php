<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class CategoryController extends Controller
{
  public function index(): View
  {
    return view('categories.index', [
      'categories' => SpladeTable::for(Category::class)
        ->column('id')
        ->column('name', sortable: true)
        ->column('action')
        ->withGlobalSearch(columns: ['name'])
        ->paginate(5),
    ]);
  }

  public function create(): View
  {
    return view('categories.create');
  }

  public function store(CategoryStoreRequest $request): RedirectResponse
  {

    Category::create($request->validated());
    Toast::title('New category created!');

    return redirect()->route('categories.index');
  }

  public function edit(Category $category): View
  {
    return view('categories.edit', compact('category'));
  }

  public function update(CategoryStoreRequest $request, Category $category): RedirectResponse
  {
    $category->update($request->validated());
    Toast::title('Category updated!');

    return redirect()->route('categories.index');
  }

  public function destroy(Category $category): RedirectResponse
  {
    $category->delete();
    Toast::title('Category deleted!');

    return redirect()->route('categories.index');
  }
}
