<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post:: all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
      'title'=> 'required|string|max:255',
      'content' => 'required|string',
      ]);

      $data = $request->all();

      $post = new Post();
      $post->fill($data);
      $post->slug = $this->generateslug($post->title);
      $post->save();

      return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $request->validate([
       'title' => 'required|string|max:255',
       'content' => 'required|string'
     ]);

     $data = $request->all();

     $data['slug'] = $this->generateslug($data['title'], $post->title != $data['title']);
     $post->update($data);

     return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $post->delete();
      return redirect()->route('admin.posts.index');
    }

    private function generateslug(string $title, bool $change = true){
      $slug = Str::slug($title,'-');

      if (!$change) {
        return $slug;
      }

      $slug_origin = $slug;
      $count = 1;

      $post_slug = Post::where('slug', '=', $slug)->first();

      while ($post_slug) {
          $slug = $slug_origin . '-'. $count ;
          $count++ ;

          $post_slug = Post::where('slug', '=', $slug)->first();
      }
      return $slug;
    }
}
