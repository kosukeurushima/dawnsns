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
        //abort(403, '動作確認中のため投稿は無効です（認証導入後に有効化します）');

    // ここより下はあとで戻す
        $validated = $request->validate([
            'post' => ['required', 'string', 'max:400'],
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'post' => $validated['post'],
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
    // 自分の投稿以外は消せない
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
