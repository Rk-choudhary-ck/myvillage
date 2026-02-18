{{-- Culture Index --}}
@extends('layouts.admin')
@section('title','Culture & Festivals')
@section('breadcrumb') / Culture @endsection
@section('content')
<div class="page-header">
  <div><h1 class="page-title">Culture & Festivals</h1><p class="page-sub">{{ $cultures->total() }} items</p></div>
  <a href="{{ route('admin.culture.create') }}" class="admin-btn admin-btn-primary">+ Add Item</a>
</div>
<div class="admin-card">
  <div class="dc-body" style="padding:0">
    <table class="admin-table">
      <thead><tr><th>Item</th><th>Category</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($cultures as $item)
        <tr>
          <td class="td-title"><span style="font-size:24px;margin-right:10px">{{ $item->icon }}</span>{{ $item->title }}</td>
          <td><span class="tag">{{ ucfirst($item->category) }}</span></td>
          <td>
            <form method="POST" action="{{ route('admin.culture.toggle-active', $item) }}" style="display:inline">@csrf
              <button class="status-badge {{ $item->is_active ? 'status-green' : 'status-gray' }}" style="border:none;cursor:pointer">{{ $item->is_active ? 'Active' : 'Hidden' }}</button>
            </form>
          </td>
          <td>{{ $item->sort_order }}</td>
          <td><div class="table-actions">
            <a href="{{ route('admin.culture.edit', $item) }}" class="ta-btn ta-edit">Edit</a>
            <form method="POST" action="{{ route('admin.culture.destroy', $item) }}" style="display:inline">@csrf @method('DELETE')<button class="ta-btn ta-del" onclick="return confirm('Delete?')">Del</button></form>
          </div></td>
        </tr>
        @empty
        <tr><td colspan="5" class="td-empty">No culture items. <a href="{{ route('admin.culture.create') }}">Add first →</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:20px">{{ $cultures->links() }}</div>
@endsection
