<!-- resources/views/roles.blade.php -->

@extends('layouts.master')

@section('title', 'Roles Management')
@push('styles')
<style>
        .action-icons {
            margin-right: 5px;
            color: #007bff;
            cursor: pointer;
            color:#343a40;
        }
        h2{
            text-align: center;
            margin-bottom:30px
        }
        .create {
        position: relative;
        text-align: center; 
        margin-top: 20px; 
    }

    .role{
        margin-top: 10px; 
    }
    </style>
@endpush
@section('content')
<div class="container" style="margin-left:25px">
    <h2>Roles Management</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through roles and display their details -->
            @if($loginUser->hasPermission('Role access'))
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ implode(', ', $role->permissions()->pluck('name')->toArray()) }}</td>
                    <td>
                    @if($loginUser->hasPermission('Role edit')) 
                        <a href="{{ route('roles.edit', $role->id) }}" class="action-icons"><i class="fas fa-edit"></i></a>
                        @endif
                        @if($loginUser->hasPermission('Role delete')) 
                        <form action="{{ route('roles.destroy', $role->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="action-icons"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
<div class="create">
    <div class="role">
    @if($loginUser->hasPermission('Role create')) 
    <a href="{{ route('roles.create') }}" class="btn btn-primary" style="background-color:gray; border-color:gray;">Add Role</a>
    @endif
  </div>
</div>
</div>
@endsection

