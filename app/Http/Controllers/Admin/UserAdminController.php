<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index()
    {
        // Only super_admin can manage users
        if (session('admin_user_role') !== 'super_admin') {
            abort(403, 'Only Super Admin can manage users.');
        }
        $users = AdminUser::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);

        $data = $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:admin_users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:super_admin,admin,editor',
        ]);

        $data['password']  = Hash::make($data['password']);
        $data['is_active'] = $request->boolean('is_active', true);

        AdminUser::create($data);
        return redirect()->route('admin.users.index')->with('success', 'Admin user created!');
    }

    public function show(AdminUser $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(AdminUser $user)
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, AdminUser $user)
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);

        $data = $request->validate([
            'name'  => 'required|max:100',
            'email' => 'required|email|unique:admin_users,email,' . $user->id,
            'role'  => 'required|in:super_admin,admin,editor',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    public function destroy(AdminUser $user)
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);
        if ($user->id === session('admin_user_id')) {
            return back()->with('error', 'You cannot delete your own account!');
        }
        $user->delete();
        return back()->with('success', 'User deleted!');
    }

    public function toggleAdmin(AdminUser $user)
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'User status updated!');
    }

    public function resetPassword(Request $request, AdminUser $user)
    {
        if (session('admin_user_role') !== 'super_admin') abort(403);
        $request->validate(['password' => 'required|min:8|confirmed']);
        $user->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password reset successfully!');
    }
}
