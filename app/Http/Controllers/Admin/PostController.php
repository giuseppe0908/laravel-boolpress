<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use App\Mail\SendNewMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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
        Mail::to('mail@gmail.it')->send(new SendNewMail());
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category:: all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories','tags'));
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
      'category_id' => 'exists:categories,id|nullable',
      'title'=> 'required|string|max:255',
      'content' => 'required|string',
      'cover' => 'image|max:100|nullable',
      'tag_ids.*' => 'exists:tags,id' // * = all
      ]);

      $data = $request->all();

      $cover = NULL;
      if (array_key_exists('cover',$data)) {
        $cover = Storage::put('uploads', $data['cover']);
      }

      $post = new Post();
      $post->fill($data);
      $post->slug = $this->generateslug($post->title);
      $post->cover = 'storage/'. $cover;
      $post->save();

      if (array_key_exists('tag_ids', $data)) {
        $post->tags()->attach($data['tag_ids']);
      }

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
      $categories = Category:: all();
      $tags = Tag::all();
      return view('admin.posts.edit',compact('post','categories','tags'));
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
       'category_id' => 'exists:categories,id|nullable',
       'title' => 'required|string|max:255',
       'content' => 'required|string',
       'cover' => 'image|max:100|nullable',
       'tag_ids.*' => 'exists:tags,id' // * = all
     ]);

     $data = $request->all();

     $data['slug'] = $this->generateslug($data['title'], $post->title != $data['title'], $post->slug);

      if(array_key_exists('cover', $data)) {
        $cover = Storage::put('uploads',$data['cover']);
        $data['cover'] = 'storage/'. $cover;
      }

     $post->update($data);
     if (array_key_exists('tag_ids', $data)) {
       $post->tags()->sync($data['tag_ids']);
     } else {
       $post->tags()->detach();
     }

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
      $post->tags()->sync([]);
      $post->delete();

      return redirect()->route('admin.posts.index');
    }

    private function generateslug(string $title, bool $change = true, string $old_slug = ''){
      $slug = Str::slug($title,'-');

      if (!$change) {
        return $old_slug;
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
