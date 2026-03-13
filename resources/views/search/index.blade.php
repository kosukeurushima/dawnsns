<h1>ユーザー検索</h1>

<form method="GET" action="{{ route('search.index') }}">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <button type="submit">検索</button>
</form>

<hr>

@foreach ($users as $user)

<div style="margin:10px 0">

<img src="{{ asset('images/' . ($user->image ?? 'dawn.png')) }}" width="40">

{{ $user->name }}

@if(in_array($user->id, $followings))

<form method="POST" action="{{ route('follow.delete') }}" style="display:inline">
@csrf
@method('DELETE')
<input type="hidden" name="targetUserId" value="{{ $user->id }}">
<button type="submit">解除</button>
</form>

@else

<form method="POST" action="{{ route('follow.create') }}" style="display:inline">
@csrf
<input type="hidden" name="targetUserId" value="{{ $user->id }}">
<button type="submit">フォロー</button>
</form>

@endif

</div>

@endforeach
