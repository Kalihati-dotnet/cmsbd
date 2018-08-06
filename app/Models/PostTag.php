<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tag';

    public $timestamps = false;
    public function tag()
    {
    	return $this->belongsTo('App\Models\Tag');
    }
}
