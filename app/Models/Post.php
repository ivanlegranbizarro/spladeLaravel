<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'content',
    'category_id',
  ];

  protected static function boot()
  {
    parent::boot();

    static::saving(function ($post) {
      $post->slug = Str::slug($post->title);
    });
  }
}
