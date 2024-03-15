<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);
        $user = User::find($request->id);
        if ($request->password == "") {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);
        }else{
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                'password' => bcrypt($request['password']),
            ]);

        }
        return redirect()->route('users.index')->with('success', ' مدیر با موفقیت ویرایش شد ');


    }
    public function disableUser(Request $request)
    {
        User::find($request->userId)->update([
            "active" => $request->active,
        ]);
        $user = User::where('id', $request->userId)->first();
        return response()->json($user);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
        ]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'active' => true,
            'password' => bcrypt($request['password']),
        ]);
        return redirect()->route('user.create')->with('success', 'ادمین جدید ' . $request['name'] . ' افزوده شد.');
    }
}
