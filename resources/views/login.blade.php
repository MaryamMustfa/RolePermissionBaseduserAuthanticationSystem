<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            margin: auto;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 5%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 15px 0px #000000;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        label {
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #343a40;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #23272b;
        }

        /* Success and Error Message Styles */
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .alert {
            width: 300px;
            opacity: 1;
            transition: opacity 2.5s ease-in-out;
            margin-bottom: 10px;
        }

        .alert-success {
            background-color: #343a40;
            color: #fff;
        }

        .alert-danger {
            background-color:#343a40;
            color: #fff;
        }
.container {
    margin-top: 5%;
    box-shadow: none;
}  
   .card {
    box-shadow: 0 0 0 !important;
}

    </style>
</head>

<body>
    {{-- if Registration successful --}}
    @if(session('success'))
    <div class="alert-container">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif

     @if(session('error'))
     <div class="alert-container">
       <div class="alert alert-danger">
        {{ session('error') }}
    </div>
</div>
@endif


    <div class="container shadow-none">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center; font-size:25px">Login</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p style="margin-left:230px;">Don't have an account? <a href="{{ route('register-form') }}">Register here</a></p>

    </div>

    <!-- Include Bootstrap JS and other scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    // Auto fade out for success and error messages
    document.addEventListener('DOMContentLoaded', function () {
        var alerts = document.querySelectorAll('.alert');

        alerts.forEach(function (alert) {
            setTimeout(function () {
                alert.style.opacity = '0';
                setTimeout(function () {
                    alert.style.display = 'none';
                }, 500);
            }, 3000);
        });
    });
</script>


</body>

</html>
