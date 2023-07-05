<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit post') }}
      </h2>
      <Link href="{{ route('posts.create') }}"
        class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md">
      Edit Post
      </Link>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <x-splade-form :default="$post" method="PUT" class="max-w-md mx-auto p-4 bg-white rounded-md"
        :action="route('posts.update', $post->id)">
        <x-splade-input name="title" label="Title" placeholder="Post title"></x-splade-input>
        <x-splade-textarea name="content" autosize label="Content" />
        <x-splade-select name="category_id" label="Category" :options="$categories"></x-splade-select>
        <x-splade-submit class="mt-3"></x-splade-submit>
      </x-splade-form>
    </div>
  </div>
</x-app-layout>
