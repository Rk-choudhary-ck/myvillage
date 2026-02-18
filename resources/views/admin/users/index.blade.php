@extends('layouts.admin')
@section('title','Admin Users')
@section('breadcrumb') / Users @endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Admin Users</h1>
    <p class="page-sub">{{ $users->total() }} admin accounts</p>
  </div>
  @if(session('admin_user_role') === 'super_admin')
  <a href="{{ route('admin.users.create') }}" class="admin-btn admin-btn-primary">+ Add User</a>
  @endif
</div>

<div class="admin-card">
  <div class="dc-body" style="padding:0">
    <table class="admin-table">
      <thead>
        <tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Last Login</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td class="td-title">
            <div style="display:flex;align-items:center;gap:10px">
              <div style="width:36px;height:36px;background:#1a5c10;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:13px;font-weight:700;flex-shrink:0">
                {{ strtoupper(substr($user->name,0,2)) }}
              </div>
              {{ $user->name }}
              @if($user->id == session('admin_user_id'))<span style="font-size:10px;background:#dcfce7;color:#16a34a;padding:2px 8px;border-radius:10px;margin-left:6px">You</span>@endif
            </div>
          </td>
          <td>{{ $user->email }}</td>
          <td>
            <span class="status-badge {{ $user->role === 'super_admin' ? 'status-green' : 'status-gray' }}">
              {{ ucfirst(str_replace('_',' ',$user->role)) }}
            </span>
          </td>
          <td>
            <span class="status-badge {{ $user->is_active ? 'status-green' : 'status-gray' }}">
              {{ $user->is_active ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td class="td-date">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</td>
          <td>
            @if(session('admin_user_role') === 'super_admin' && $user->id != session('admin_user_id'))
            <div class="table-actions">
              <a href="{{ route('admin.users.edit', $user) }}" class="ta-btn ta-edit">Edit</a>
              <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline">
                @csrf @method('DELETE')
                <button class="ta-btn ta-del" onclick="return confirm('Delete this user?')">Delete</button>
              </form>
            </div>
            @else
            <span style="color:#9ca3af;font-size:12px">—</span>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="td-empty">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:20px">{{ $users->links() }}</div>
@endsection
