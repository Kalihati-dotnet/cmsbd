<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Manage\ManageController;

use App\Models\Post;
use App\Models\Tag;
//use App\Models\PostTag;

class ManagePostsController extends ManageController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.posts.index')->withPosts(
            Post::orderBy('id','desc')->paginate(5)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'slug' => 'required',
            'body' => 'required|max:10000',
            'category' => 'required|integer',
        ]);
       $body = str_replace("&nbsp;",'',$request->input('body')); 

        //echo '<code>'.htmlentities($bod).'</code>';

       $post = new Post;     
       $post->title = $request->input('title');
       $post->slug = ($post->whereSlug($request->input('slug'))->exists()) ? 
                    $request->input('slug') . '-' . time() : $request->input('slug');
       $post->body  = $body;
       $post->status  = ($request->input('submitDraft')) ? 'DRAFT' : 'PUBLISHED';
       $post->comment  = ($request->input('comment')) ? true : false;
       $post->user_id  = Auth()->user()->id;
       $post->category_id  = $request->input('category');
       $post->published_at  = ($request->input('submitPublish')) ? now() : null;
       $post->save();
       $post->tags()->sync($request->tags, false);
       return redirect('manage/posts/create')->with('success', trans('msg.created', ['attr' => 'Post']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('manage.posts.show')->withPost(
            Post::findOrFail($id)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('manage.posts.edit')->withPost(
            Post::findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            //'slug' => 'required|unique:posts',
            'body' => 'required|max:10000',
            'category' => 'required|integer',
        ]);
        $body = str_replace("&nbsp;",'',$request->input('body')); 

        $post = Post::findOrFail($id);
        
        $post->title = $request->input('title');
        //$post->slug = $request->input('slug');
        $post->body  = $body;
        $post->status  = ($request->input('submitDraft')) ? 'DRAFT' :
                        (($request->input('submitPublish')) ? 'PUBLISHED' : $post->status);
       
        $post->comment  = ($request->input('comment')) ? true : false;
        $post->user_id  = Auth()->user()->id;
        $post->category_id  = $request->input('category');
        $post->published_at  = ($request->input('submitPublish')) ? now() : null;

        $post->update();

        $post->tags()->sync($request->tags, true);

        return redirect('manage/posts')->with('success', trans('msg.updated', ['attr' => 'Post']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $find = Post::findOrFail($id);
        if($request->ajax()){
            if($find !== null){
                $find->delete();
                return response()->json(array('msg'=> 'ok'), 200);
            }
           return response()->json(array('msg'=> 'Target not found!'), 404);
        } else {
            $response_url =  ((int)($request->page)) ? 'manage/posts?page='.(int)($request->page) : 'manage/posts';
            $find->delete();
            return redirect($response_url)->with('success', trans('msg.deleted', ['attr' => 'Post']));
        }
    }
}
