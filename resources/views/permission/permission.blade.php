<!-- resources/views/permissions.blade.php -->

@extends('layouts.master')

@section('title', 'Manage Permissions')
@push('styles')
<style>
h2{
    font-size:40px;
    margin-bottom:30px;
    padding-left:170px;
}

.action-icons {
        margin-right: 5px;
        color: #343a40;
        cursor: pointer;
    }
    .btn-primary.top-right-button {
        margin: 1 30px 50px 10px;
        float: left;
        background-color: #343a40;
        border-color: #343a40;
    
    }
    .pagination {
            justify-content: center;
            margin-top: 20px;
            margin-left:180px;
        }

    .pagination li.page-item a:hover {
            color: #343a40; 
        }

        .pagination .page-item.active .page-link {
           background-color: #212529;
           border-color: #212529;
           color: #fff;
        }
   .pagination li.page-item a {
            color: #212529;

        }
    </style>
@endpush

@section('content')
<h2>Manage Permissions</h2>
<div class="container" style="margin-left:20px">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($loginUser->hasPermission('Permission create')) 
        <a href="{{ route('permissions.create') }}" class="btn btn-primary top-right-button" style="margin-right:50px;">Add New Permission</a>
    @endif
    <table border="1">
        <thead>
            <tr>
                <th>Permission Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through permissions and display their details -->
            @if($loginUser->hasPermission('Permission access'))  
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>
                        @if($loginUser->hasPermission('Permission edit')) 
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="action-icons"><i class="fas fa-edit"></i></a>
                        @endif
                        @if($loginUser->hasPermission('Permission delete')) 
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="post" style="display: inline;">
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
</div>
{{ $permissions->links() }}

@endsection
