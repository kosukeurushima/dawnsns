<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with('user')
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post' => ['required', 'string', 'max:400'],
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'post' => $validated['post'],
        ]);

        return redirect()->route('posts.index');
    }
}
