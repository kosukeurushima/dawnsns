<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowListController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();

        $followUsers = User::query()
            ->whereIn('id', function ($query) use ($authUser) {
                $query->select('user_id')
                    ->from('follows')
                    ->where('follower_id', $authUser->id);
            })
            ->orderBy('name', 'desc')
            ->get();

        $followUserIds = $followUsers->pluck('id');

        $posts = Post::query()
            ->with('user')
            ->whereIn('user_id', $followUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('follows.follow-list', compact('followUsers', 'posts'));
    }
}
