@extends('layouts.master')
@section('title', 'Create Activity Log')
@push('styles')
<style>
    h1 {
            font-size: 45px;
            margin-bottom: 20px;
        }
    </style>
    @endpush
@section('content')

<div class="container" style="margin-left: 160px;">
        <h1>Create Activity Log</h1>

        <form action="{{ route('activity-logs.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="action">Action:</label>
                <input type="text" style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" name="action" id="action" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description"  style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" class="form-control" required></textarea>
            </div>
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary mt-3 btn-block">Create Log</button>
            </div>
            <div class="col-md-6">
                <a href="{{ route('activity-logs.index') }}" class="btn btn-secondary mt-3 btn-block">Back to Activity Logs</a>
            </div>
        </div>
        </form>

    </div>
    @endsection
