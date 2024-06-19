<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //menampilkan semua data user datatable
    public function index()
    {
        $data['page_title'] = "Data Pengguna";
        $data['users'] = User::where('role', 1)->get();
        return view('user.index', $data);
    }
    //menampilkan form tambah user
    public function create()
    {
        $data['page_title'] = "Tambah Pengguna";
        return view('user.tambahuser', $data);
    }
    //menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:1,2,3'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }
    //menampilkan form edit user
    public function edit($id)
    {
        $data['page_title'] = "Edit Pengguna";
        $data['user'] = User::find($id);
        return view('user.edituser', $data);
    }
    //menyimpan data user yang diedit
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:1,2,3'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diubah');
    }
    //menghapus user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }

}
