@extends('layouts.master')

@section('title', 'Edit Activity Log')
@push('styles')
<style>
            h1 {
             padding-left:50px; 
            font-size: 45px;
            margin-bottom: 20px;
        }
    </style>
    @endpush
@section('content')

<div class="container" style="margin-left: 160px;">
        <h1>Edit Activity Log</h1>

        <form action="{{ route('activity-logs.update', $activityLog->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="action">Action:</label>
                <input type="text" name="action" id="action" style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" class="form-control" value="{{ $activityLog->action }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" class="form-control" required>{{ $activityLog->description }}</textarea>
            </div>
            <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary mt-3 ">Update Log</button>
            </div>
            <div class="col">
                <a href="{{ route('activity-logs.index') }}" class="btn btn-secondary mt-3 btn-block">Back to Activity Logs</a>
            </div>
        </div>


        </form>

    </div>
@endsection

