<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | DEPED Division of Laguna</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/pages/auth.css') }}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/logo/favicon.ico') }}" type="image/png">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="center mb-4">
                        <a href="{{ route('welcome') }}" title="HOMEPAGE">
                            <img class="img-fluid" width="150px" height="150px" src="{{ asset('auth/images/auth_brand.png') }}" alt="Logo">
                        </a>
                    </div>
                    <h3 class="text-custom text-center">Reset Password</h3>
                    <p class="auth-subtitle mb-5">Input your email and new password.</p>

                    <!-- Start Validation Message -->
                    <x-jet-validation-errors class="alert alert-secondary text-danger border border-danger" />
                    <!-- End Validation Message -->

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group form-floating position-relative has-icon-left">
                            <input type="email" class="form-control form-control-xl" placeholder="Email Address" id="email" name="email" value="{{old('email', $request->email)}}" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <label class="ms-5" for="email">Email Address</label>
                        </div>
                        <div class="form-group form-floating position-relative has-icon-left">
                            <input type="password" class="form-control form-control-xl" minlength="8" maxlength="24" placeholder="Password" id="password" name="password" required autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <label class="ms-5" for="password">Password</label>
                        </div>
                        <div class="form-group form-floating position-relative has-icon-left">
                            <input type="password" class="form-control form-control-xl" minlength="8" maxlength="24" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            <div class=" form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <label class="ms-5" for="password_confirmation">Confirm Password</label>
                        </div>

                        <button class="btn btn-block btn-lg custom-btn mt-4">Reset Password</button>
                    </form>
                    <a href="{{ route('admin.logout') }}" class="btn btn-block btn-lg btn-secondary mt-2">Logout</a>

                </div>
            </div>
            <div class="col-xl-7 d-none d-xl-block">
                <div id="auth-right">
                    <div class="auth-background" id="auth-right"></div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>