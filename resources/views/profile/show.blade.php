        
@extends('layouts.master')

@section('title', 'Your Profile')

@push('styles')

<style>

        #container {
            flex: 1;
            padding-left:300px;
            margin-top:80px;
            
        }

        h1 {
            color: #343a40;
        }

        p {
            margin-bottom: 10px;
        }
         img {

        border-radius: 50%;
        height:50px;
        width:50px;
        object-fit: cover;
}

</style>
@endpush
@section('content')
        
    <div id="container">
       <img src="{{ asset('storage/' . auth()->user()->profile_image) }}">
        <h1>Name: {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <p>Role:
            @foreach(auth()->user()->roles as $role)
                {{ $role->name }}
            @endforeach
        </p>
        <p style="margin-bottom:50px;">This is your profile page.</p>       
</div>

@endsection