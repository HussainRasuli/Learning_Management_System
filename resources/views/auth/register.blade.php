
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Gawharshad Learning Managment System</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/app-assets/images/logo/logo-Gawharshad.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/custom.css')}}">
    <!-- END: Custom CSS-->
    <style>
        .show-hide{
            font-size: 1.1rem; 
            float: right; 
            margin-top: -1.9rem;
            margin-right: .6rem;
        }
    </style>
</head>
<!-- BEGIN: Body-->
@include('layouts.jdf')
<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page login_body" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-12 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                                </div>
                                <div class="col-lg-12 col-12 p-0">
                                    <div class="card rounded-0 mb-0 p-1">
                                        <div class="card-header pt-50 pb-1 justify-content-center ">
                                            <div class="card-title">
                                            <img src="{{asset('public/app-assets/images/logo/logo-Gawharshad.png')}}"
                                                    class="login_logo" alt="branding logo" style="width: 147px;">
                                            </div>
                                        </div>
                                        <p class="px-2 title2 r-title">Fill The Below Form to Create an Account.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-0">
                                                <form method="POST" action="{{ route('register')}}">
                                                    @csrf
                                                    <input type="hidden" name="year" value="<?php echo jdate("Y","","","","en"); ?>">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-label-group">
                                                                <input type="text" class="form-control" name="first-name" autocomplete="off" placeholder="First Name" required value="{{ old('first-name')}}">
                                                                <label for="inputEmail">First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-label-group">
                                                                <input type="text" class="form-control" name="last-name" autocomplete="off" placeholder="Last Name" required value="{{ old('last-name')}}">
                                                                <label for="inputEmail">Last Name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-label-group">
                                                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email" required>
                                                      <label for="inputEmail">Email</label>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong style="color:red;">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-label-group">
                                                        <input type="password" id="register-password" class="form-control @error('password') is-invalid @enderror" name="password"  value="{{ old('password') }}" required autocomplete="new-password" placeholder="Password">
                                                        <i class="feather icon-eye show-hide" id="eye"></i>
                                                        <i class="feather icon-eye-off show-hide" id="eye-off"></i>
                                                        <label for="inputPassword">Password</label>
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong style="color:red;">{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                    <div class="form-label-group">
                                                        <input type="password" id="conf-password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                                        <i class="feather icon-eye show-hide" id="conf-eye"></i>
                                                        <i class="feather icon-eye-off show-hide" id="conf-eye-off"></i>
                                                        <label for="inputConfPassword">Confirm Password</label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right btn-inline btn-block mb-50">Register</a>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="login-footer text-center">
                                            <div class="divider">
                                            </div>
                                            <div class="footer-btn d-inline">
                                                <span style="font-size: .9rem;"> &copy; <span id="year"></span>. All
                                                    RIGHT RESERVED.</span>
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
    <!-- END: Content-->
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->
    <script>
    var date = new Date();
    document.getElementById('year').innerHTML = date.getFullYear();
    
    $('#eye-off').click(function(){
        let type = $('#register-password').attr('type');
        if(type === 'password'){
            $(this).hide();
            $('#eye').show();
            $('#register-password').attr('type', 'text');
        }
    });

    $('#eye').click(function(){
        let type = $('#register-password').attr('type');
        if(type === 'text'){
            $(this).hide();
            $('#eye-off').show();
            $('#register-password').attr('type', 'password');
        }
    });

    $('#conf-eye-off').click(function(){
        let type = $('#conf-password').attr('type');
        if(type === 'password'){
            $(this).hide();
            $('#conf-eye').show();
            $('#conf-password').attr('type', 'text');
        }
    });

    $('#conf-eye').click(function(){
        let type = $('#conf-password').attr('type');
        if(type === 'text'){
            $(this).hide();
            $('#conf-eye-off').show();
            $('#conf-password').attr('type', 'password');
        }
    });
    </script>

</body>
<!-- END: Body-->

</html>