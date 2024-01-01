@extends('layouts.master')

@section('title', 'Create New Permission')

@push('styles')

<style>
    h2 {
            font-size: 40px;
            margin-bottom: 20px;
            margin-left:140px;
        }
</style>
@endpush
@section('content')

<div class="container"><div class="container" style="margin-left: 50px;">
    <h2>Create New Permission</h2>

    <form action="{{ route('permissions.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="permissionName">Permission Name:</label>
            <input type="text" name="permissionName" id="permissionName" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: gray; border-color: gray; margin-left:250px;">Create Permission</button>
    </form>
</div>

@endsection
