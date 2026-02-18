@extends('layouts.admin')
@section('title','Manage Blogs')
@section('breadcrumb') / Blogs @endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Blog Posts</h1>
    <p class="page-sub">{{ $blogs->total() }} total posts</p>
  </div>
  <a href="{{ route('admin.blogs.create') }}" class="admin-btn admin-btn-primary">+ New Post</a>
</div>

<div class="admin-card">
  <div class="dc-body" style="padding:0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Title</th><th>Category</th><th>Author</th><th>Views</th><th>Status</th><th>Date</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($blogs as $blog)
        <tr>
          <td class="td-title">
            @if($blog->thumbnail)
            <img src="{{ Storage::url($blog->thumbnail) }}" style="width:40px;height:40px;object-fit:cover;border-radius:6px;margin-right:10px;vertical-align:middle">
            @endif
            {{ Str::limit($blog->title, 50) }}
            @if($blog->is_featured)<span class="badge" style="background:#f59e0b;margin-left:6px">⭐ Featured</span>@endif
          </td>
          <td><span class="tag">{{ $blog->category }}</span></td>
          <td>{{ $blog->author }}</td>
          <td>{{ number_format($blog->views) }}</td>
          <td>
            <form method="POST" action="{{ route('admin.blogs.toggle-publish', $blog) }}" style="display:inline">
              @csrf
              <button class="status-badge {{ $blog->is_published ? 'status-green' : 'status-gray' }}" style="border:none;cursor:pointer">
                {{ $blog->is_published ? '✅ Published' : '⬜ Draft' }}
              </button>
            </form>
          </td>
          <td class="td-date">{{ $blog->created_at->format('d M Y') }}</td>
          <td>
            <div class="table-actions">
              <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="ta-btn" style="background:#f0fdf4;color:#16a34a">View</a>
              <a href="{{ route('admin.blogs.edit', $blog) }}" class="ta-btn ta-edit">Edit</a>
              <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" style="display:inline">
                @csrf @method('DELETE')
                <button class="ta-btn ta-del" onclick="return confirm('Delete this post?')">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="td-empty">No blog posts yet. <a href="{{ route('admin.blogs.create') }}">Create first post →</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div style="margin-top:20px">{{ $blogs->links() }}</div>
@endsection
