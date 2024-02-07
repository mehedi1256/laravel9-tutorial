<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::withTrashed()->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        Post::create([
            'user_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'is_published' => $request->is_published,
            'is_active' => $request->is_active
        ]);

        $request->session()->flash('alert-success','Post saved successfully');
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(! $post) {
            abort(404);
        }
        return view('posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(! $post) {
            abort(404);
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
       $post = Post::find($id);
       if(! $post) {
        abort(404);
       }
       $post->update([
        'title' => $request->title,
        'description' => $request->description,
        'is_published' => $request->is_published,
        'is_active' => $request->is_active
       ]);

       $request->session()->flash('alert-info', 'Post updated successfully');
       return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id){
        $post = Post::find($id);
        if(! $post) {
            abort(404);
        }
        $post->delete();
        $request->session()->flash('alert-danger', 'Post deleted successfully');
        return to_route('posts.index');
    }

    public function softDelete(Request $request, $id) {
        $post = Post::onlyTrashed()->find($id);
        if(! $post) {
            abort(404);
        }

        $post->update([
            'deleted_at' => null
        ]);

        $request->session()->flash('alert-message', 'Post Recover successfully');
        return to_route('posts.index');
    }

    public function getPosts() {
        return DB::select('insert into posts (title, description, is_published, is_active) values (?, ?, ?, ?)', ['laravel tutorial', 'Ii is most important tutorial and effective tutorial', 1, 1]);
    }
}
