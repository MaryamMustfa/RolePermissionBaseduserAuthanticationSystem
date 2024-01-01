<!-- resources/views/auth/verify-otp.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
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
    </style>
</head>
<body>
{{-- if login  successful --}}
    @if(session('success'))
    <div class="alert-container">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <!-- if opt is invalid -->
    @error('otp')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align:center; background-color:#343a40; color:#fff;">OTP Verification</div>

                    <div class="card-body">
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('verify') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="two_factor_code" class="col-md-4 col-form-label text-md-right">Enter OTP</label>

                                <div class="col-md-6">
                                    <input id="two_factor_code" style="border-color:#343a40; box-shadow: 0 0 1px #343a40;" type="text" name="two_factor_code" class="form-control @error('two_factor_code') is-invalid @enderror" required autofocus>

                                    @error('two_factor_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color:#343a40; border-color:#343a40">
                                        Verify OTP
                                    </button>
                                    <a class="btn btn-link" style="color:#343a40; border-color:#343a40" href="{{ route('loginform') }}">
                                        Back to Login
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
