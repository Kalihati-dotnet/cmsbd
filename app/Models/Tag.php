<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    //primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    public function posts()
    {
    	return $this->belongsToMany('App\Models\Post');
    }

    
    public function post_tags()
    {
    	return $this->hasMany('App\Models\PostTag', 'tag_id');
    }
}
