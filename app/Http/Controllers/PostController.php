<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments')->with('postCategory')->get();


        return Inertia::render('Posts/Index', [
            'posts' => $posts,
        ]);
    }

     public function destroyComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        return back()->with('flash', [
            'message' => 'Comment deleted successfully.'
        ]);
    }

    public function create()
    {
        $postcategories = PostCategory::all();
        return Inertia::render('Posts/CreatePost',[
            'postcategories'=>$postcategories
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'post_category_id' => 'required|exists:post_categories,id',
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',

        ]);

        Post::create([
            'post_category_id' => $validated['post_category_id'],
            'title'       => $validated['title'],
            'content'     => $validated['content']
        ]);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post created successfully!');
    }

    public function storeComment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'body' => $validated['body'],
        ]);

        return back()->with('message', 'Comment added successfully!');
    }

}
