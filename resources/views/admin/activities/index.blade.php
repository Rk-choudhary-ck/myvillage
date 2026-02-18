{{-- activities/index.blade.php --}}
@extends('layouts.admin')
@section('title','Activities & Games')
@section('breadcrumb') / Activities @endsection
@section('content')
<div class="page-header">
  <div><h1 class="page-title">Activities & Games</h1><p class="page-sub">{{ $activities->total() }} activities</p></div>
  <a href="{{ route('admin.activities.create') }}" class="admin-btn admin-btn-primary">+ Add Activity</a>
</div>
<div class="admin-card">
  <div class="dc-body" style="padding:0">
    <table class="admin-table">
      <thead><tr><th>Activity</th><th>Category</th><th>Season</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($activities as $act)
        <tr>
          <td class="td-title"><span style="font-size:24px;margin-right:10px">{{ $act->icon }}</span>{{ $act->name }}</td>
          <td><span class="tag">{{ $act->category }}</span></td>
          <td><span class="tag">{{ $act->season }}</span></td>
          <td><span class="status-badge {{ $act->is_active ? 'status-green' : 'status-gray' }}">{{ $act->is_active ? 'Active' : 'Hidden' }}</span></td>
          <td><div class="table-actions">
            <a href="{{ route('admin.activities.edit', $act) }}" class="ta-btn ta-edit">Edit</a>
            <form method="POST" action="{{ route('admin.activities.destroy', $act) }}" style="display:inline">@csrf @method('DELETE')<button class="ta-btn ta-del" onclick="return confirm('Delete?')">Del</button></form>
          </div></td>
        </tr>
        @empty
        <tr><td colspan="5" class="td-empty">No activities. <a href="{{ route('admin.activities.create') }}">Add first →</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:20px">{{ $activities->links() }}</div>
@endsection
