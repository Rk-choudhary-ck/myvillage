@extends('layouts.admin')
@section('title', isset($blog) ? 'Edit Blog Post' : 'New Blog Post')
@section('breadcrumb')
  / <a href="{{ route('admin.blogs.index') }}">Blogs</a>
  / {{ isset($blog) ? 'Edit' : 'New Post' }}
@endsection

@section('styles')
<style>
.editor-wrap { border: 2px solid #e2e8f0; border-radius: 10px; overflow: hidden; }
.editor-toolbar { background: #f7fafc; border-bottom: 1px solid #e2e8f0; padding: 10px 16px; display: flex; gap: 8px; flex-wrap: wrap; }
.editor-toolbar button { padding: 6px 12px; border: 1px solid #cbd5e0; background: white; border-radius: 6px; cursor: pointer; font-size: 13px; transition: all 0.2s; }
.editor-toolbar button:hover { background: #2d8a1a; color: white; border-color: #2d8a1a; }
#blogContent { min-height: 350px; padding: 20px; border: none; outline: none; font-size: 15px; line-height: 1.7; width: 100%; resize: vertical; font-family: inherit; }
.image-preview-box { width: 100%; aspect-ratio: 16/9; background: #f7fafc; border: 2px dashed #cbd5e0; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; cursor: pointer; transition: border-color 0.3s; }
.image-preview-box:hover { border-color: #2d8a1a; }
.image-preview-box img { width: 100%; height: 100%; object-fit: cover; }
.image-preview-box .placeholder { text-align: center; color: #a0aec0; }
.image-preview-box .placeholder span { font-size: 40px; display: block; margin-bottom: 8px; }
</style>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">{{ isset($blog) ? 'Edit Blog Post' : 'New Blog Post' }}</h1>
    <p class="page-sub">{{ isset($blog) ? 'Update your village story' : 'Share a new story from Chanan Khera' }}</p>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.blogs.index') }}" class="admin-btn admin-btn-ghost">← Back to Blogs</a>
  </div>
</div>

<form method="POST"
      action="{{ isset($blog) ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if(isset($blog)) @method('PUT') @endif

  <div class="form-two-col">
    <!-- Main Column -->
    <div class="form-main-col">

      <div class="admin-card">
        <div class="admin-card-header">Post Content</div>
        <div class="admin-card-body">

          <div class="form-group">
            <label class="form-label">Post Title *</label>
            <input type="text" name="title" class="admin-input @error('title') is-invalid @enderror"
                   value="{{ old('title', $blog->title ?? '') }}"
                   placeholder="e.g., The Annual Baisakhi Celebration of Chanan Khera" required>
            @error('title')<div class="form-error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label class="form-label">Short Excerpt *</label>
            <textarea name="excerpt" rows="3" class="admin-input @error('excerpt') is-invalid @enderror"
                      placeholder="A brief description shown in blog listings (1-2 sentences)" required>{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
            @error('excerpt')<div class="form-error">{{ $message }}</div>@enderror
          </div>

          <div class="form-group">
            <label class="form-label">Full Content *</label>
            <div class="editor-wrap">
              <div class="editor-toolbar">
                <button type="button" onclick="format('bold')"><strong>B</strong></button>
                <button type="button" onclick="format('italic')"><em>I</em></button>
                <button type="button" onclick="format('underline')"><u>U</u></button>
                <button type="button" onclick="insertHeading('h2')">H2</button>
                <button type="button" onclick="insertHeading('h3')">H3</button>
                <button type="button" onclick="format('insertUnorderedList')">• List</button>
                <button type="button" onclick="format('insertOrderedList')">1. List</button>
                <button type="button" onclick="insertQuote()">❝ Quote</button>
                <button type="button" onclick="insertLink()">🔗 Link</button>
              </div>
              <div id="blogContent" contenteditable="true">{{ old('content', $blog->content ?? '') }}</div>
            </div>
            <input type="hidden" name="content" id="contentInput">
            @error('content')<div class="form-error">{{ $message }}</div>@enderror
          </div>

        </div>
      </div>

    </div>

    <!-- Sidebar Column -->
    <div class="form-side-col">

      <!-- Publish -->
      <div class="admin-card">
        <div class="admin-card-header">Publish Settings</div>
        <div class="admin-card-body">
          <div class="toggle-group">
            <label class="toggle-label">Published</label>
            <label class="toggle-switch">
              <input type="checkbox" name="is_published" value="1"
                     {{ old('is_published', $blog->is_published ?? false) ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div class="toggle-group">
            <label class="toggle-label">Featured Post</label>
            <label class="toggle-switch">
              <input type="checkbox" name="is_featured" value="1"
                     {{ old('is_featured', $blog->is_featured ?? false) ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div class="form-group" style="margin-top:16px">
            <label class="form-label">Author Name</label>
            <input type="text" name="author" class="admin-input"
                   value="{{ old('author', $blog->author ?? session('admin_user_name')) }}">
          </div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%; margin-top:16px">
            {{ isset($blog) ? '💾 Update Post' : '🚀 Publish Post' }}
          </button>
        </div>
      </div>

      <!-- Category -->
      <div class="admin-card">
        <div class="admin-card-header">Category & Tags</div>
        <div class="admin-card-body">
          <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category" class="admin-input" required>
              <option value="">Select Category</option>
              @foreach(['Culture','Farming','Heritage','Festival','Nature','Community','Sports','Food','History'] as $cat)
              <option value="{{ $cat }}" {{ old('category', $blog->category ?? '') == $cat ? 'selected' : '' }}>
                {{ $cat }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Tags (comma separated)</label>
            <input type="text" name="tags" class="admin-input"
                   value="{{ old('tags', $blog->tags ?? '') }}"
                   placeholder="bhangra, harvest, tradition">
          </div>
        </div>
      </div>

      <!-- Thumbnail -->
      <div class="admin-card">
        <div class="admin-card-header">Thumbnail Image</div>
        <div class="admin-card-body">
          <div class="image-preview-box" onclick="document.getElementById('thumbnail').click()">
            @if(isset($blog) && $blog->thumbnail)
            <img src="{{ Storage::url($blog->thumbnail) }}" id="thumbPreview" alt="Thumbnail">
            @else
            <div class="placeholder" id="thumbPlaceholder">
              <span>🖼</span>
              <p>Click to upload image</p>
              <small>Recommended: 1200×630px</small>
            </div>
            @endif
          </div>
          <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none"
                 onchange="previewImage(this, 'thumbPreview', 'thumbPlaceholder')">
        </div>
      </div>

      <!-- SEO -->
      <div class="admin-card">
        <div class="admin-card-header">SEO Settings</div>
        <div class="admin-card-body">
          <div class="form-group">
            <label class="form-label">Custom Slug</label>
            <input type="text" name="slug" class="admin-input"
                   value="{{ old('slug', $blog->slug ?? '') }}"
                   placeholder="auto-generated-from-title">
            <small class="form-help">Leave blank to auto-generate</small>
          </div>
          <div class="form-group">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" rows="3" class="admin-input"
                      placeholder="SEO description (max 160 chars)">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
function format(cmd) {
  document.getElementById('blogContent').focus();
  document.execCommand(cmd, false, null);
}
function insertHeading(tag) {
  document.execCommand('formatBlock', false, tag);
}
function insertQuote() {
  document.execCommand('formatBlock', false, 'blockquote');
}
function insertLink() {
  const url = prompt('Enter URL:');
  if (url) document.execCommand('createLink', false, url);
}
document.querySelector('form').addEventListener('submit', function() {
  document.getElementById('contentInput').value = document.getElementById('blogContent').innerHTML;
});
function previewImage(input, previewId, placeholderId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      let preview = document.getElementById(previewId);
      if (!preview) {
        preview = document.createElement('img');
        preview.id = previewId;
        input.closest('.image-preview-box').innerHTML = '';
        input.closest('.image-preview-box').appendChild(preview);
      }
      preview.src = e.target.result;
      const ph = document.getElementById(placeholderId);
      if (ph) ph.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endsection
