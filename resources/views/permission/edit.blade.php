<!-- resources/views/editPermission.blade.php -->

@extends('layouts.master')

@section('title', 'Edit Permission')

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


<div class="container"><div class="container" style="margin-left: 70px;">
    <h2>Edit Permission</h2>

    <form action="{{ route('permissions.update', $permission->id) }}" method="post">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="permissionName">Permission Name:</label>
            <input type="text" name="permissionName" id="permissionName" class="form-control"
                   value="{{ $permission->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: gray; border-color: gray; margin-left:280px;">Update Permission</button>
    </form>
</div>

@endsection

