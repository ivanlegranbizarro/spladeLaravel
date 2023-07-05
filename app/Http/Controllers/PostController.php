<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class PostController extends Controller
{
  public function index(): View
  {
    $categories = Category::pluck('name', 'id')->toArray();
    return view('posts.index', [
      'posts' => SpladeTable::for(Post::class)
        ->column('id')
        ->column('title', sortable: true)
        ->withGlobalSearch(columns: ['title'])
        ->column('action')
        ->bulkAction(
          label: 'Delete',
          each: fn(Post $post) => $post->delete(),
          before: fn() => Toast::title('Posts deleted!'),
          after: fn() => redirect()->route('posts.index'),
        )
        ->selectFilter('category_id', $categories)
        ->paginate(5),
    ]);
  }

  public function create(): View
  {
    $categories = Category::pluck('name', 'id')->toArray();
    return view('posts.create', compact('categories'));
  }

  public function store(PostStoreRequest $request): RedirectResponse
  {
    Post::create($request->validated());
    Toast::title('New post created!');

    return redirect()->route('posts.index');
  }

  public function show(Post $post): View
  {
    return view('posts.show', compact('post'));
  }

  public function edit(Post $post): View
  {
    $categories = Category::pluck('name', 'id')->toArray();
    return view('posts.edit', compact('post', 'categories'));
  }

  public function update(PostStoreRequest $request, Post $post): RedirectResponse
  {
    $post->update($request->validated());
    Toast::title('Post updated!');

    return redirect()->route('posts.index');
  }

  public function destroy(Post $post): RedirectResponse
  {
    $post->delete();
    Toast::title('Post deleted!');

    return redirect()->route('posts.index');
  }
}
