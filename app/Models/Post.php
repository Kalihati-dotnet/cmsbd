<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;


class Post extends Model
{
    protected $table = 'posts';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    
    // public function scopeMightAlsoLike($query)
    // {
    //     return $query->inRandomOrder()->take(6);
    // }
}
