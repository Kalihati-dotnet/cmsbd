<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $parent = 'parent_id';

    protected $fillable = [
        'name', 'parent_id',
    ];

    //primary key
    public $primaryKey = 'id';

    // Timestamps
   // public $timestamps = true;
   
    public function posts()
    {
        return $this->hasMany(App\Models\Post::class, 'category_id');
    }
    public function parent()
    { 
       return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    public function children()
    { 
       return $this->hasMany(static::class, 'parent_id')->orderBy('name', 'asc');
    }

}
