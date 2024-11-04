<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'users';
    public function index()
    {
        $user = User::all();
        return view('admin.users.index', compact('user'));
    }

    public function promoteToAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Tài khoản thành Admin');
    }

    public function demoteToUser($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Tài khoản thành user');
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Xóa tài khoản thành công');
    }
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.users')->with('success', 'Admin account has been created.');
    }
    // Phương thức khóa tài khoản
    public function lock($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->is_locked = true;
            $user->save();
            return redirect()->back()->with('success', 'Tài khoản đã bị khóa.');
        }
        return redirect()->back()->with('error', 'Người dùng không tồn tại.');
    }

    // Phương thức mở khóa tài khoản
    public function unlock($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->is_locked = false;
            $user->save();
            return redirect()->back()->with('success', 'Tài khoản đã được mở khóa.');
        }
        return redirect()->back()->with('error', 'Người dùng không tồn tại.');
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
