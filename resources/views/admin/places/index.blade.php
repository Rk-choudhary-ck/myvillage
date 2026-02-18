@extends('layouts.admin')
@section('title','Manage Places')
@section('breadcrumb') / Places @endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Famous Places</h1>
    <p class="page-sub">{{ $places->total() }} places</p>
  </div>
  <a href="{{ route('admin.places.create') }}" class="admin-btn admin-btn-primary">+ Add Place</a>
</div>

<div class="admin-card">
  <div class="dc-body" style="padding:0">
    <table class="admin-table">
      <thead>
        <tr><th>Place</th><th>Category</th><th>Featured</th><th>Status</th><th>Order</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($places as $place)
        <tr>
          <td class="td-title">
            @if($place->thumbnail)
            <img src="{{ Storage::url($place->thumbnail) }}" style="width:44px;height:44px;object-fit:cover;border-radius:8px;margin-right:10px;vertical-align:middle">
            @else
            <span style="font-size:28px;margin-right:10px;vertical-align:middle">{{ $place->icon ?? '📍' }}</span>
            @endif
            {{ $place->name }}
          </td>
          <td><span class="tag">{{ $place->category }}</span></td>
          <td>
            <form method="POST" action="{{ route('admin.places.toggle-featured', $place) }}" style="display:inline">
              @csrf
              <button class="status-badge {{ $place->is_featured ? 'status-green' : 'status-gray' }}" style="border:none;cursor:pointer">
                {{ $place->is_featured ? '⭐ Yes' : 'No' }}
              </button>
            </form>
          </td>
          <td>
            <form method="POST" action="{{ route('admin.places.toggle-active', $place) }}" style="display:inline">
              @csrf
              <button class="status-badge {{ $place->is_active ? 'status-green' : 'status-gray' }}" style="border:none;cursor:pointer">
                {{ $place->is_active ? 'Active' : 'Hidden' }}
              </button>
            </form>
          </td>
          <td>{{ $place->sort_order }}</td>
          <td>
            <div class="table-actions">
              <a href="{{ route('admin.places.edit', $place) }}" class="ta-btn ta-edit">Edit</a>
              <form method="POST" action="{{ route('admin.places.destroy', $place) }}" style="display:inline">
                @csrf @method('DELETE')
                <button class="ta-btn ta-del" onclick="return confirm('Delete this place?')">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="td-empty">No places added yet. <a href="{{ route('admin.places.create') }}">Add first place →</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:20px">{{ $places->links() }}</div>
@endsection
