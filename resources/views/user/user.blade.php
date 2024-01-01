<!-- resources/views/user.blade.php -->
@extends('layouts.master')

@section('title', 'User Management')

@push('styles')

<style>
     h2 {
            font-size: 44px;
            /* left-margin:350px; */
              padding-left:160px;
 }
 .action-icons {
        margin-right: 5px;
        color: #212529;
        cursor: pointer;
 }
 input[type="text"] {
    width: 270px; 
    margin-top:10px;
}
    table {
        width: 80%; 
        margin: 20px auto; 
        border-collapse: collapse; 
    }

     th, td {
        padding-left:5px;
        padding-right:5px
        text-align: left;
    } 

    th {
        background-color: #212529;
        color: white;
    }

    .top-right-button {
        position: absolute;
        top: 200px;
        right: 30px;
        z-index: 1000;
        background-color: #212529;
        border-color:#6c757d;
    }
    .possition{
        position: reletive;
    }

    .top-right-button:hover {
        background-color: #6c757d;
        border-color:#6c757d;
    }
    .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li.page-item a {
            color: #212529;
        }

        .pagination .page-item.active .page-link {
           background-color: #212529;
           border-color: #212529;
           color: #fff;
}


        .pagination li.page-item.disabled a {
            color: #fff;
            border-color: 212529;
            cursor: not-allowed;
        }

        .pagination li.page-item a:hover {
            background-color: #212529;
            border-color: #212529;       
            color: #fff; 
        }
        .delete-selected-btn {
           background-color: #212529;
           color: #fff;
           border-color:#212529 ;
           margin-top: 20px;

       }

     .delete-selected-btn:hover {
        border-color: black;
         background-color: #fff;
         color:black
   }

</style>
@endpush


@section('content')

<body>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h2>User Management</h2>
        <form action="{{ route('users.index') }}" method="get">
            <div class="mb-3">
            <input type="text" name="search" placeholder="Search by name, email, or role" value="{{ request('search') }}">
            <button type="submit" class="action-icons"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <form action="{{ route('users.deleteSelected') }}" method="post" id="deleteForm">
            @csrf
            <button type="submit" class="btn btn-danger delete-selected-btn" id="deleteAllSelectedRecord">Delete All Selected</button>
            <input type="hidden" name="selected_ids" id="selectedIds" value="">
        </form>

        <table border="1">
            <thead>
                <tr>
                    <th><input type="checkbox" name="select_all_ids" id="select_all_ids"></th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through users and display their details -->
                @if($loginUser->hasPermission('User access'))
                    @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" name="selected_ids[]" class="checkbox_ids" value="{{ $user->id }}"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ count($user->roles) > 0 ? $user->roles()->first()->name : '' }}</td>
                            <td>
                                @if(!$user->trashed())
                                    @if($loginUser->hasPermission('User edit'))
                                        <a href="{{ route('users.edit', $user->id) }}" class="action-icons"><i class="fas fa-edit"></i></a>
                                    @endif
                                    @if($loginUser->hasPermission('User delete')) 
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="action-icons"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    @endif
                                @else
                                    @if($user->trashed())
                                        <form action="{{ route('users.restore', $user->id) }}" method="post" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-icons"><i class="fas fa-undo-alt"></i></button>
                                        </form>
                                        @if($user->deleted_at)
                                            <form action="{{ route('users.forceDelete', $user->id) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"class="action-icons"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="possition">
        @if($loginUser->hasPermission('User create')) 
            <a href="{{ route('users.create') }}" class="btn btn-primary top-right-button">Add User</a>
        @endif
</div>
    </div>
    {{ $users->links() }}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select_all_ids');
            const checkboxes = document.querySelectorAll('.checkbox_ids');
            const form = document.getElementById('deleteForm');

            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });

            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', function () {
                    selectAllCheckbox.checked = checkboxes.length === document.querySelectorAll('.checkbox_ids:checked').length;
                });
            });

            form.addEventListener('submit', function (event) {
                const selectedIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                if (selectedIds.length === 0) {
                    event.preventDefault();
                    alert('No users selected for deletion.');
                } else {
                    document.getElementById('selectedIds').value = selectedIds.join(',');
                }
            });
        });
    </script>
@endsection
