<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('administrator-access')) return $next($request);

            abort(403, 'Maaf, Hak Akses Anda Dibatasi !');
        });
    }


    public function index(Request $request)
    {
        $users = User::paginate(10);

        $filterKeyword = $request->post('keyword');
        $status = $request->post('status');

        if ($filterKeyword) {
            $users = User::WHERE('email', 'LIKE', "%$filterKeyword%")
                ->WHERE('status', $status)
                ->paginate(10);
        }

        return view('pages.users.index', ['users' => $users]);
    }


    public function create()
    {
        return view('pages.users.create');
    }


    public function store(Request $request)
    {

        \Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "username" => "required|min:5|max:20",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
            "image" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "password_confirmation" => "required|same:password"
        ])->validate();

        // extends model User
        $user = new user;
        // mengambil data inputan
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->roles = json_encode($request->get('roles'));
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->password = \Hash::make($request->get('password'));

        if ($request->file('image')) {
            $file = $request->file('image')->store('avatars', 'public');

            $user->avatar = $file;
        }


        $user->save();
        // for ($i = 0; $i < 50; $i++) {
        // }

        return redirect()->route('users.create')->with('status', 'Berhasil Menambah Data User!');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.show', ['user' => $user]);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        \Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
        ])->validate();

        $user = User::findOrFail($id);

        $user->name = $request->get('name');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->status = $request->get('status');

        if ($request->file('image')) {
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                \Storage::delete('public/' . $user->avatar);
            }
            $file = $request->file('image')->store('avatars', 'public');
            $user->avatar = $file;
        }

        $user->save();

        return redirect()->route('users.index')->with('status', 'Berhasil Update Data User ' . $user->name);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('status', 'Berhasil Hapus Data');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);

        return view('pages.profile.index', ['user' => $user]);
    }
}
