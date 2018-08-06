<?php
namespace App\Http\Response;

use Illuminate\Http\Request;
//use ArrayObject;
//use JsonSerializable;
//use Symfony\Component\HttpFoundation\Response as BaseResponse;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;

class PostIndexResponse implements Responsable
{ 
    protected $posts;

    public function __construct(Collection $posts)
    {
       $this->posts = $posts;
    }

    public function toResponse($request){

       if($request->ajax()){
            return response()->json($this->transformPosts());
       }

        return view('index')->withPosts($this->posts);
    }

    protected function transformPosts()
    {
        return $this->posts->map(function($post){
            return [
                'name' => $post->title,
                'body' => $post->body
            ];
        });
    }
}

