<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'targetUserId' => ['required', 'integer'],
        ]); // targetUserIdは必須＆半角数字の想定 :contentReference[oaicite:3]{index=3}

        $loginUserId = Auth::id();
        $targetUserId = (int) $validated['targetUserId'];

        if ($loginUserId === $targetUserId) {
            return back()->withErrors(['targetUserId' => '自分自身はフォローできません。']);
        }

        // 二重登録防止（followsに同じ組み合わせがあれば作らない）
        DB::table('follows')->updateOrInsert(
            [
                'user_id' => $targetUserId,      // フォローされる側 :contentReference[oaicite:4]{index=4}
                'follower_id' => $loginUserId,   // フォローする側 :contentReference[oaicite:5]{index=5}
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return back();
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'targetUserId' => ['required', 'integer'],
        ]);

    $loginUserId = Auth::id();
    $targetUserId = (int) $validated['targetUserId'];

        DB::table('follows')
            ->where('user_id', $targetUserId)
            ->where('follower_id', $loginUserId)
            ->delete(); // フォロー解除は該当フォロー情報を削除 :contentReference[oaicite:7]{index=7}

        return back();
    }

}
