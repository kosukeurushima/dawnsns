<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>フォロワー一覧</title>
</head>

<body>

<h1>フォロワー一覧</h1>

<h2>フォロワーユーザー</h2>

<div style="margin-bottom:20px;">

@forelse ($followerUsers as $user)

<div style="display:inline-block;margin-right:12px;text-align:center;">

<img
src="{{ asset('images/' . ($user->image ?? 'dawn.png')) }}"
width="50"
height="50"
style="border-radius:50%;object-fit:cover;"
>

<div>{{ $user->name }}</div>

</div>

@empty

<p>フォロワーはいません</p>

@endforelse

</div>

<hr>

<h2>フォロワーの投稿</h2>

@forelse ($posts as $post)

<div style="margin:12px 0;padding:10px;border:1px solid #ddd;">

<div style="display:flex;align-items:center;gap:10px;">

<img
src="{{ asset('images/' . ($post->user->image ?? 'dawn.png')) }}"
width="32"
height="32"
style="border-radius:50%;object-fit:cover;"
>

<strong>{{ $post->user->name }}</strong>

<small>{{ $post->created_at }}</small>

</div>

<p>{{ $post->post }}</p>

</div>

@empty

<p>投稿はありません</p>

@endforelse

</body>
</html>
