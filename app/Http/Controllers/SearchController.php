<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = User::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->where('id', '!=', Auth::id())
            ->get();

            // 自分がフォローしているユーザーIDを取得
            $followings = DB::table('follows')
                ->where('follower_id', Auth::id())
                ->pluck('user_id')
                ->toArray();

        return view('search.index', compact('users', 'keyword','followings'));
    }
}
