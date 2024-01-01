@extends('layouts.master')

@section('title', 'Edit Profile')

@push('styles')
<style>
    h1 {
            font-size: 40px;
            margin-bottom: 20px;
            margin-left:80px;
            margin-top:5px;
        }
        #container{
            margin-left:350px;
        }
</style>
@endpush
@section('content')
        
    <div id="container">
        <h1 >Edit Profile</h1>
        
        <form method="POST" action="{{ route('profileupdate') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" placeholder="*********" class="form-control">
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture" accept="image/*" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary"style="background-color: gray; border-color: gray; margin-left:80px; margin-top:10px;">Update Profile</button>
        </form>
    </div>
</div>

@endsection