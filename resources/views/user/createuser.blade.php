<!-- resources/views/create.blade.php -->

@extends('layouts.master')

@section('title', 'Create User')
@push('styles')
<style>
input.form-control:focus {
    border-color: #343a40;
    box-shadow: 0 0 0 0.01rem rgba(52,58,64);
}
.container {
        margin-left:155px;
        align-items: center;


    }

    h2 {
        text-align: center;
        padding-left:270px;
        font size:40px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .add{
        width: 100%; 
        color:#343a40;
        background-color:#fff;
        border-color:#343a40;
    }
    .add:hover{
        color:#fff;
        background-color:#343a40;
        border-color:#343a40;
    }

</style>
@endpush



@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <h2>Create User</h2>
    <div class="container">
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role_id" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary add">Save</button>
    </form>

</div>
@endsection
