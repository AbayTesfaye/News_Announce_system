<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller 
{
    public function __construct()
    {
        // Apply the auth middleware to all methods except index and show
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6); // grab dummy data
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        // validation
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],

        ]);
        // create post
       Auth::user()->posts()->create($fields);

        // redirect 
       return back()->with('success', 'Your post was created');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
         // authenticated user
        Gate::authorize('modify',$post);

        return view('posts.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
         // authenticated user
        Gate::authorize('modify',$post);
                // validation
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],

        ]);
        // create post
        $post->update($fields);

        // redirect 
       return redirect()->route('dashboard')->with('success', 'Your post was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // authenticated user
        Gate::authorize('modify',$post);
         // delete the post
           $post->delete();
         // rediret 
        return back()->with('delete','Your post was deleted');

    }
}
