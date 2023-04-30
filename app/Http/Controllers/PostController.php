<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post = Post::find(5, ['title','description']);
        // $posts = Post::simplePaginate(5);
        $posts = Post::withTrashed()->paginate(5);
        // return $posts;
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
        /* $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:5|max:100',
            'is_published' => 'required',
            'is_active' => 'required'
        ]); */

        // Post::create($request->all());
        Post::create([
            'user_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'is_published' => $request->is_published,
            'is_active' => $request->is_active
        ]);

        /* $posts = new Post;
        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts->is_published = $request->is_published;
        $posts->is_active = $request->is_active;
        $posts->save(); */

        $request->session()->flash('alert-success','Post saved successfully');
        // Session::flash('alert-success','Post created successfully');
        // Session::put('alert-success','Post created successfully');
        // dd('insert successfully');

        // return redirect()->back()->withInput();

        // return to_route('posts.create')->withInput();
        return to_route('posts.index');

        /* Post::create([
            'title' => 'laravel10',
            'description' => 'it is awesome'
        ]);
        return 'inserted successfully'; */
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
        // return DB::table('posts')->where('id', '1')->get();
        // return DB::table('posts')->find(2);
        // return DB::table('posts')->first();
        // return DB::table('posts')->value('title');
        // return DB::table('posts')->pluck('title', 'description');
        // return DB::select('select * from posts where title = ?', ['Eu id tempora fuga']);
        return DB::select('insert into posts (title, description, is_published, is_active) values (?, ?, ?, ?)', ['laravel tutorial', 'Ii is most important tutorial and effective tutorial', 1, 1]);
    }
}
