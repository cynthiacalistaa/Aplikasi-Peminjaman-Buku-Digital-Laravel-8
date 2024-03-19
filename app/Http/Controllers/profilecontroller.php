<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class profilecontroller extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('auth.profile', compact('user'));
    }

    public function update(Request $request, $id){
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'email'      => 'required|email|unique:users,email, ' . $id . ',id',
            'no_telp'    => 'required'
        ]);
    
        $user = User::find($id);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
    
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $imageName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('public/images', $imageName); // simpan di direktori storage
            $user->photo = $imageName;
        }
    
    
        $user->save();
    
        return back()->with('status', 'Profile updated!');
    }

}
