@extends('layouts.admin')
@section('content')
@php $model = array_values(get_defined_vars())[2] ?? null; $id = $model->id ?? ''; @endphp
<div class="page-header">
    <h1 class="page-title">View Record #{{ $id }}</h1>
    <a href="javascript:history.back()" class="admin-btn admin-btn-ghost">← Back</a>
</div>
<div class="admin-card">
    <div class="admin-card-body">
        <p style="color:#6b7280;font-size:14px;">Use the <strong>Edit</strong> button from the list to modify this record.</p>
    </div>
</div>
@endsection
