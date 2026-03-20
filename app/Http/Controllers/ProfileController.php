<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $posts = Post::where('user_id',$user->id)
            ->orderBy('created_at','desc')
            ->get();

        return view('profile.index',compact('user','posts'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit',compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'bio'=>'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,png,bmp,gif,svg|max:20480',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $user->image = $filename;
        }

        $user->save();

        return redirect('/profile');
    }
}
