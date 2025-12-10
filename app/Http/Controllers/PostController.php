<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use App\Models\Comment;

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
        return Inertia::render('Posts/CreatePost');
    }

}
