
<!-- resources/views/createRole.blade.php -->

@extends('layouts.master')

@section('title', 'Create New Role')

@push('styles')
<style>
h2 {
            font-size: 45px;
            margin-bottom: 20px;
            margin-left:120px;
        }
</style>
@endpush
@section('content')

<div class="container" style="margin-left: 30px;">

    <h2>Create New Role</h2>

    <form action="{{ route('roles.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="roleName">Role Name:</label>
            <input type="text" name="roleName" id="roleName" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Permissions:</label><br>
            <!-- Loop through permissions and display checkboxes -->
            @foreach($permissions as $permission)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: gray; border-color: gray; margin-left:280px;">Create Role</button>
    </form>
</div>

@endsection

