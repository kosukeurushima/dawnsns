<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowerListController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();

        // 自分をフォローしているユーザー
        $followerUsers = User::query()
            ->whereIn('id', function ($query) use ($authUser) {
                $query->select('follower_id')
                    ->from('follows')
                    ->where('user_id', $authUser->id);
            })
            ->orderBy('name', 'desc')
            ->get();

        $followerUserIds = $followerUsers->pluck('id');

        // フォロワーの投稿
        $posts = Post::query()
            ->with('user')
            ->whereIn('user_id', $followerUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('follows.follower-list', compact('followerUsers','posts'));
    }
}
