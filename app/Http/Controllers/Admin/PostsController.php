<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Posts;

class PostsController extends Controller
{
    // protected $dates = ['expired_at'];

    public function index()
    {
      $posts = Post::allowed()->get();
      return view('admin.posts.index', compact('posts'));
    }

    // public function create()
    // {
    //   $categories = Category::all();
    //   $tags = Tag::all();
    //
    //   return view('admin.posts.create', compact('categories', 'tags'));
    // }

    public function store(Request $request)
    {
      // autorización para crear un nuevo post
      $this->authorize('create', new Post);

      $this->validate($request, ['title' => 'required']);

      $post = Post::create([
        'title' => $request->title,
        'url' => str_slug($request->title),
        'user_id' => auth()->id()

      ]);

      return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
      // AUTORIZACIÓN PARA EDITAR UN POST EN POLICIES
      $this->authorize('update', $post);

      return view('admin.posts.edit',[
        'categories' => Category::all(),
        'tags' => Tag::all(),
        'post' => $post
      ]);
    }

    public function update(Post $post, Request $request)
    {
      $this->authorize('update', $post);

      $this->validate($request, [
        'title'           => 'required|max:255',
        'body'            => 'required',
        'published_at'    => 'required'
      ]);
      // return Post::create($request->all());

      $post->title = $request->title;
      $post->url = str_slug($request->title);
      $post->body = $request->body;
      $post->except = $request->except;
      $post->published_at = $request->has('published_at') ? Carbon::parse($request->published_at) : null;
      $post->category_id = $request->category;
      $post->save();

      $post->tags()->sync($request->tags);

      return redirect()->route('admin.posts.edit', $post)->with('flash','Tu publicación ha sido guardada  ');
    }


}
