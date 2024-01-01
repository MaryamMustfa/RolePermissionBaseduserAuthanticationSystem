<!-- resources/views/edit.blade.php -->
@extends('layouts.master')

@section('title', 'Edit User')
@push('styles')
    <style>
        input.form-control:focus {
            border-color: #343a40;
            box-shadow: 0 0 0 0.01rem rgba(52,58,64);
        }

        input.form-control,
    select.form-control {
        height: 40px; 
        font-size: 16px; 
    }

    .container {
        margin-left: 155px;
        align-items: center;
    }


        h2 {
            text-align: center;
            font-size: 45px;
            margin-bottom: 20px;
        }
        select.form-control:focus{
            border-color: #343a40;
            box-shadow: 0 0 0 0.01rem rgba(52,58,64);
        }
        select.form-control option {
            border-color: #343a40;
        color: #fff;
        background-color:#343a40;
    }


        .form-group {
            margin-bottom: 20px;
        }

        .add {
            width: 100%;
            color: #fff;
            background-color: #343a40;
            border-color: #343a40;
        }

        .add:hover {
            color: #343a40;
            background-color: #fff;
            border-color: #343a40;
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
    <div class="container">
        <h2>Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role_id">Role:</label>
                <select name="role_id" class="form-control" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary add">Update</button>
        </form>
    </div>
@endsection
