<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/greeting',function () {
    return "Hello world!";
}); */

/* Route::get('/greeting/{id}',function ($id) {
    return "User id is " . $id;
}); */

/* Route::get('/user-name/{name?}',function ($name = null) {
    return "User name is ".$name;
}); */

/* Route::get('/user/{id}/{name}',function ($id, $name) {
    return "User id is $id and name is $name";
})->where(['id' => '[0-9]+', 'name' =>'[A-Za-z]+']); */

/* Route::get('/',function(){
    return 'Home';
}); */

// Route::redirect('/','login');
/* Route::get('login',function (){
    return '<a href="about">about</a>';
}); */

/* Route::get('about', function() {
    return 'about page';
}); */

/* Route::get('/greeting',function() {
    $name = "Mehedi Hassan Shovo";
    // return view('greeting', ['name' => $name]);
    // return view('greeting', compact('name'));
    // return view('greeting')->with('name',$name);
    // return View::make('greeting')->with('name',$name);
    // return View::make('greeting',['name' => $name]);
    return View::make('greeting',compact('name'));
}); */

// Route::view('greeting','greeting');

/* Route::get('/profile',function() {
    return view('admin.profile');
}); */

/* Route::view('master','layouts.master');
Route::view('test', 'test');
Route::view('test2', 'test2');
Route::view('post','post'); */

/* Route::get('/users',[UserController::class,'index']);
Route::get('/users/show/{id}',[UserController::class,'show']); */

//check laravel db connection

/* Route::get('/connection',function() {
    try {
        DB::connection()->getPdo();
        return 'connection successful';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}); */

// Route::resource('/posts',PostController::class);

Route::get('/test', function() {

    //for inserting data into database
    /* Post::create([
        'title' => 'PHP v8.2',
        'description' => 'I is most improved',
        'is_published' => false,
        'is_active' => false
    ]); */

    //for red data from database

    // $post = Post::all();
    // $post = Post::find(6);
    // $post = Post::findOrFail(5);
    // $post = Post::where('title', '=', 'job finding')->orwhere('description','find a job')->get();
    // $post = Post::where(['title' => 'PHP v8.2', 'description' => 'I is most improved'])->get();
    // $post = Post::find(3);
    // $post = Post::where('title', 'laravel')->first();
    // if(! $post) {
    //     return "post not found";
    // }

    // $post->update([
    //     'title' => 'laravel10',
    //     'description' => 'laravel 10 released'
    // ]);
    // return 'return updated successfully';

    // return 'Post inserted successfully';

    // $post = Post::findOrFail(3);
    // $post->delete();
    // return 'Post deleted successfully';

    /* $post = Post::find(4);
    if(! $post) {
        return "Post not found";
    }else{
        $post->delete();
        return 'post is deleted successfully';
    } */
});

/* Route::get('/posts/show', [PostController::class, 'index']);
Route::get('/posts/store', [PostController::class, 'store']);
Route::get('/posts/update', [PostController::class, 'update']);
Route::get('/posts/destroy', [PostController::class, 'destroy']); */



Route::resource('posts',PostController::class);
Route::get('posts/soft-delete/{id}', [PostController::class, 'softDelete'])->name('posts.soft-delete');
Route::get('get/posts', [PostController::class, 'getPosts'])->name('get.posts');

Route::get('test', function(){
    //oneToOne Relationship

    $user = User::first();
    // if($user->post){
        return $user->post;
    // }
    
    /* $post = Post::first();
    return $post->user; */

    //oneToMany Relationship

    /* $user = User::first();
    return $user->posts; */

});


/* Route::get('/session', function() {
    Session::put('login', 'you are logged in');
    //Session::forget('login'); //just delete one session
    Session::flush(); //delete all sessions

    if(Session::has('login')) {
        return Session::get('login');
    }else {
        return 'you are not logged in';
    }
}); */
