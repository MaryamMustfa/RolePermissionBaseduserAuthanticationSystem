<!-- resources/views/dashboard.blade.php -->
@extends('layouts.master')

@section('title', 'Your Dashboard')

@section('content')
    <div class="container">
    <h1>Welcome, @foreach(auth()->user()->roles as $role)
        {{ $role->name }}
    @endforeach</h1>
      <p>This is your personalized dashboard. Feel free to explore the features and manage your account. Have a nice day</p>
</div>
      @endsection

@push('styles')
    <style>

         p {
            font-size: 16px;
            color: #666;
            text-align: center;
            margin-left: 42%;
        }

        h1 {
            margin-left: 430px;
            margin-top:150px;
        }
        .container{
            margin-left:25px;
        }
    </style>
@endpush
