<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Response\PostIndexResponse;

class IndexController extends Controller
{
    public function index()
    {
        return new PostIndexResponse(Post::latest()->take('3')->get());
    }
}
