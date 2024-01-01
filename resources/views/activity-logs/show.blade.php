@extends('layouts.master')

@section('title', 'Activity Log Details')
@push('styles')
<style>       


        h1 {
            
            font-size: 45px;
            margin-bottom: 20px;
        }
   
   </style>
@section('content')
<div class="container" style="margin-left: 250px;">

        <h1>Activity Log Details</h1>

        <ul>
            <li>ID: {{ $activityLog->id }}</li>
            <li>User ID: {{ $activityLog->user_id }}</li>
            <li>Action: {{ $activityLog->action }}</li>
            <li>Description: {{ $activityLog->description }}</li>
            <li>Timestamp: {{ $activityLog->created_at }}</li>
        </ul>

        <a href="{{ route('activity-logs.index') }}" class="btn btn-secondary mt-3">Back to Activity Logs</a>
    </div>
@endsection

