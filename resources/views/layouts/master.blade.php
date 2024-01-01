<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        #app {
            display: flex;
        }

        #sidebar {
             width: 160px;
            position: fixed;
            height: 100%;
            background: #343a40;
            color: white;
            padding-top: 20px;
        }

        #content {
            margin-left: 250px;
            padding: 20px;
        }

        .top-right {
            position: fixed;
            top: 20px;
            right: 20px;
        }

                /* Additional style for the search bar */
            #search-bar {
            margin-bottom: 20px;
            
        }

        /* Style for the search icon */
        #search-icon {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }
        #searchInput {
            padding: 5px 8px;
            font-size: 12px; 
            width: 150px; 
        }
 
        /* Style for the top navigation bar */
        #top-navbar {
            position: fixed;
            top: 0;
            right: 0;
            background-color: #343a40;
            padding: 10px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            width:89%;
        }

        /* Style for the logo */
        #logo {
            font-size: 30px;
        }

        /* Style for the dropdown menu */
        .dropdown-menu {
            background-color: #fffff;
            color: #6c757d;
            border: none; 
        }

        /* Style for the content area */
        #content {
            margin-top: 60px; /* Add top margin */
            margin-left: 30px;
            padding: 20px;
            padding-right:30px;
        }
     
        /* Style for the list on hover */
        #top-navbar:hover .dropdown-menu {
            display: block;
            background-color: #ffff;
        }
.dropdown-menu a.dropdown-item:hover {
    background-color:#6c757d;
    color: #ffff;
}
.user-profile {
    display: flex;
    align-items: right;
}

/* Style for the profile image */
.profile-image {
    width: 40px;
   border:1px solid;
   border-color:#fffff;
    height: 40px;
    border-radius: 50%; 
   margin-left: 930%;
}
  .user-profile .profile-image img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;

        }
    </style>
        @stack('styles')
</head>
<body>

<div id="app">
<div id="top-navbar">

    <div id="logo">Performance Test</div>
      <a href="{{ route('profileshow') }}" class="user-profile">
      @if (auth()->user()->profile_image)
               <div class="profile-image">
               <img src="{{ asset('storage/' . auth()->user()->profile_image) }}">
              </div>
         @endif
        </a>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ auth()->user()->name }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    
            <a class="dropdown-item" href="{{ route('profileshow') }}">View Profile</a>
            <a class="dropdown-item" href="{{ route('profileedit') }}">Edit Profile</a>
            <a href="{{ route('dashboard.logout') }}" class="dropdown-item">Logout</a>

        </div>
    </div>
</div>


//sidebar code
    <div id="sidebar">
        <!-- Search bar with icon -->
        <div id="search-bar" class="position-relative">
            <input type="text" class="form-control" id="searchInput" placeholder="Search...">
            <i class="fas fa-search text-muted" id="search-icon"></i>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('users.index') }}">User</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('activity-logs.index') }}">Activity Logs</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('roles.index') }}">Role</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('permissions.index') }}">Permission</a></li>
        </ul>
    </div>
    <div id="content">
        @yield('content')
    </div>


<!-- Include Bootstrap JS and dependencies if needed -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<!-- JavaScript for filtering -->
<script>
    $(document).ready(function() {
        // Add event listener for the search bar
        $('#searchInput').on('input', function() {
            var searchText = $(this).val().toLowerCase();

            // Iterate through the navigation links and show/hide based on search
            $('#sidebar .nav-link').each(function() {
                var linkText = $(this).text().toLowerCase();
                $(this).closest('li').toggle(linkText.includes(searchText));
            });
        });
    });
</script>
@stack('scripts')
</body>
</html>
