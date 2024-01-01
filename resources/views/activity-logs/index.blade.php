@extends('layouts.master')

@section('title', 'User Activity Logs')
@push('styles')
<style>
       h1{
        text-align:center;
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
        .thead-dark th {
        background-color: #343a40;
        color: #fff;
    }

    .btn-success {
        background-color: gray;
        border-color: gray;
    }
    .btn-success:hover {
        background-color: gray;
        border-color: gray;
    }
    .action-icons {
            margin-right: 5px;
            color: #007bff;
            cursor: pointer;
            color:#343a40;
        }

        btn-success :active {
            background-color: #343a40;
            border-color: #fff;
            box-shadow: 0 2px 4px #fff;
        }

    </style>
    @endpush
@section('content')

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-4">
        <h1>User Activity Logs</h1>

        <a href="{{ route('activity-logs.create') }}" class="btn btn-success mb-3 add">Add Log</a>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activityLogs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user_id }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->created_at }}</td>
                        <td class="text-center">
                            <a href="{{ route('activity-logs.show', $log->id) }}" class="action-icons"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('activity-logs.edit', $log->id) }}" class="action-icons"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('activity-logs.destroy', $log->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-icons" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

            {{ $activityLogs->links() }}
@endsection
