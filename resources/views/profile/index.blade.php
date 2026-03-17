<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>プロフィール</title>
</head>

<body>

<h1>プロフィール</h1>

<img
src="{{ asset('images/' . ($user->image ?? 'dawn.png')) }}"
width="60"
style="border-radius:50%;"
>

<h2>{{ $user->name }}</h2>

<p>{{ $user->bio }}</p>

<a href="/profile/edit">プロフィール編集</a>

<hr>

<h2>自分の投稿</h2>

@foreach ($posts as $post)

<div style="margin:10px 0">

<small>{{ $post->created_at }}</small>

<p>{{ $post->post }}</p>

</div>

@endforeach

</body>
</html>
