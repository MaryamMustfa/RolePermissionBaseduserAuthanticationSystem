<!-- resources/views/editRole.blade.php -->
@extends('layouts.master')

@section('title', 'Edit Role')

@push('styles')
<style>
h2 {
            font-size: 45px;
            margin-bottom: 20px;
            margin-left:180px;
        }
</style>
@endpush

@section('content')

<div class="container"><div class="container" style="margin-left: 30px;">

    <h2>Edit Role</h2>

    <form action="{{ route('roles.update', $role->id) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="roleName">Role Name:</label>
            <input type="text" name="roleName" id="roleName" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="form-group">
            <label>Permissions:</label><br>
            <!-- Loop through permissions and display checkboxes -->
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                           {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}
                           class="form-check-input">
                    <label class="form-check-label">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: gray; border-color: gray; margin-left:280px;">Update Role</button>
    </form>
</div>
@endsection
