
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>Login | GU-LMS</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/app-assets/images/logo/logo-Gawharshad.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/pages/authentication.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">

    <style>
    .show-hide{
        font-size: 1.1rem; 
        float: right; 
        margin-top: -1.9rem;
        margin-right: .6rem;
    }
    </style>

</head>
<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-12 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-3" style="width:28rem; padding-top: 3rem; padding-bottom: 2rem;">
                                        <div class="card-header pt-50 pb-1 justify-content-center ">
                                            <div class="card-title">
                                                <img src="{{asset('public/app-assets/images/logo/logo-Gawharshad.png')}}"  alt="branding logo" style="width:147px;">
                                            </div>
                                        </div>
                                        <p class="px-2" style="margin-block-end: 0;text-align: center;font-weight: bold;">Welcome to GU-LMS</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1" style="padding-top: 2rem !important;padding: 0.5rem;">
                                              <form method="POST" action="{{ route('login') }}">
                                                 @csrf
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="user-name" name="email" value="{{ old('email') }}" placeholder="User Email" required>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input id="password" type="password" placeholder="User Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                        <i class="feather icon-eye show-hide" id="eye"></i>
                                                        <i class="feather icon-eye-off show-hide" id="eye-off"></i>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                    </fieldset>
                                                    <button type="submit" class="btn btn-primary float-left btn-inline btn-block btn-login"> {{ __('Login') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="login-footer" style="padding-bottom: 2.5rem !important;">
                                            <div class="divider">
                                                <!-- <div class="divider-text">OR</div> -->
                                            </div>
                                            <div class="footer-btn text-center">
                                                <span style="font-size: 11px;"> &copy; <span id="year"></span>. All RIGHT RESERVED Gawharshad</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/components.js')}}"></script>
    <script>
    var d = new Date();
    document.getElementById('year').innerHTML=d.getFullYear();

    $('#eye-off').click(function(){
            let type = $('#password').attr('type');
            if(type === 'password'){
                $(this).hide();
                $('#eye').show();
                $('#password').attr('type', 'text');
            }
        });

        $('#eye').click(function(){
            let type = $('#password').attr('type');
            if(type === 'text'){
                $(this).hide();
                $('#eye-off').show();
                $('#password').attr('type', 'password');
            }
        });
    </script>
</body>
</html>

