<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>LMS | Gawharshad</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/app-assets/images/logo/logo-Gawharshad.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/fonts/font-awesome/css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/fonts/material-icon/materialdesignicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/sweetalert2.min.css')}}">

    @yield('style')
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/custom.css')}}">

</head>

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i>&nbsp; Search...</a>
                                <div class="search-input">
                                    <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                                    <input id="input_search" class="input" type="number" placeholder="Search by ID Number or Tazkira ID" tabindex="-1" data-search="template-list">
                                    <div class="search-input-close"><i class="feather icon-x"></i></div>
                                </div>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <div class="bookmark-input search-input">
                                <div class="bookmark-input-icon"><i class="feather icon-search primary"></i></div>
                                <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="0" data-search="template-list">
                                <ul class="search-list search-list-bookmark"></ul>
                            </div>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item">
                            <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                <a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a>
                                <a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-af"></i> Dari</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>

                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label notification-readed-btn" href="#" data-toggle="dropdown">
                                <i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up"><span class="notification-number"></span></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <span class="notification-title white">App Notifications</span>
                                    </div>
                                </li>
                                <li class="scrollable-container media-list">
                                    <h6 class="text-center pt-1 pb-1">You Have No Notification</h6>
                                </li>
                                <!-- <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li> -->
                            </ul>
                        </li>

                        @php
                                $table_name = Auth::user()->table_name;
                                $record_id  = Auth::user()->record_id;
                                
                                if($table_name == 1){
                                    $data = App\Model\Teacher::find($record_id);

                                }elseif($table_name == 2){
                                    $data = App\Model\Student::find($record_id);

                                }elseif($table_name == 3){
                                    $data = App\Model\Staff::find($record_id);
                                }
                        @endphp

                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name text-bold-600">{{$data->first_name}} {{$data->last_name}}</span>
                                    <span class="user-status">Online</span>
                                </div>
                                <span>
                                    @if($data->photo != '')
                                        @if($table_name == 1)
                                            <img class="round" src="{{ url('/storage/app/teacher/'.$data->photo) }}" alt="avatar" height="40" width="40">
                                        @elseif($table_name == 2)
                                            <img class="round" src="{{ url('/storage/app/student/'.$data->photo) }}" alt="avatar" height="40" width="40">
                                        @elseif($table_name == 3)
                                            <img class="round" src="{{ url('/storage/app/staff/'.$data->photo) }}" alt="avatar" height="40" width="40">
                                        @endif
                                    @else
                                        <img class="round" src="{{asset('public/app-assets/images/portrait/small/user_default.jpg')}}" alt="avatar" height="40" width="40">
                                    @endif
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{route('user_profile')}}"><i class="feather icon-user"></i> Profile</a>
                            
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="feather icon-power"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="/gu-lms/dashboard">
                        <img src="{{asset('public/app-assets/images/logo/logo-Gawharshad.png')}}" alt="" class="logo">
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-tachometer-alt"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>
                @can('view-course')
                    <li class="nav-item {{ Request::is('course') ? 'active' : '' }}">
                        <a href="{{ route('course') }}"><i class="mdi mdi-book-open-page-variant" style="top: -5px;"></i><span class="menu-title" data-i18n="Email">Course list</span></a>
                    </li>
                @endcan
                @can('set-course')
                    <li class="nav-item {{ Request::is('approved-courses') || Request::is('set-course') || Request::is('new-course') ? 'active' : '' }}">
                        <a href="{{ route('approved-courses') }}"><i class="mdi mdi-bookmark-check" style="top: -2px;"></i><span class="menu-title" data-i18n="Email">Course</span></a>
                    </li>
                @endcan
                @can('approve-course-view')
                    <li class="nav-item {{ Request::is('approve-course') || Request::is('active-course') ? 'active' : '' }}">
                        <a href="{{ route('approve-course') }}"><i class="mdi mdi-bookmark-check" style="top: -2px;"></i><span class="menu-title" data-i18n="Email">Approve Course</span></a>
                    </li>
                @endcan
                @can('view-teachers')
                    <li class="nav-item {{ Request::is('lecturer') || Request::is('new-lecturer') ? 'active' : '' }}">
                        <a href="{{ route('lecturer') }}"><i class="mdi mdi-teach" style="top: -2px;"></i><span class="menu-title" data-i18n="Chat">Lecturer</span></a>
                    </li>
                @endcan
                @can('view-students')
                    <li class=" nav-item {{ Request::is('student_list') || Request::is('student_form') ? 'active' : '' }}">
                        <a href="{{route('student_list')}}"><i class="fas fa-user-graduate"></i><span class="menu-title" data-i18n="Todo">Studnet</span></a>
                    </li>
                @endcan
                @can('view-faculties')
                    <li class=" nav-item {{ Request::is('faculty') || Request::is('faculty-form') ? 'active' : '' }}">
                        <a href="{{ route('faculty') }}"><i class="fas fa-university"></i><span class="menu-title" data-i18n="Todo">Faculty</span></a>
                    </li>
                @endcan
                @can('view-staffs')
                    <li class=" nav-item {{ Request::is('staff-list') || Request::is('staff-form')? 'active' : '' }}">
                        <a href="{{ route('staff-list') }}"><i class="fas fa-user-tie"></i><span class="menu-title" data-i18n="Todo">Staff</span></a>
                    </li>
                @endcan
                @can('view-positions')
                    <li class=" nav-item {{ Request::is('position_list') || Request::is('position_form') ? 'active' : '' }}">
                        <a href="{{ route('position_list') }}"><i class="mdi mdi-account-card-details-outline" style="top: -3px;"></i><span class="menu-title" data-i18n="Todo">Position</span></a>
                    </li>
                @endcan
                @can('view-year-periods')
                    <li class=" nav-item {{ Request::is('yearPeriod_list') || Request::is('yearPeriod_form') ? 'active' : '' }}">
                        <a href="{{ route('yearPeriod_list') }}"><i class="mdi mdi-calendar-month" style="top: -3px;"></i><span class="menu-title" data-i18n="Todo">Year & Period</span></a>
                    </li>
                @endcan
                @can('view-roles')
                    <li class=" nav-item {{ Request::is('role_list') || Request::is('role_form') ? 'active' : '' }}">
                        <a href="{{ route('role_list') }}"><i class="mdi mdi-account-key" style="top: -5px;"></i><span class="menu-title" data-i18n="Todo">Role</span></a>
                    </li>
                @endcan
                @can('view-users')
                    <li class=" nav-item {{ Request::is('user_list') ? 'active' : '' }}">
                        <a href="{{route('user_list')}}"><i class="fas fa-users"></i><span class="menu-title" data-i18n="Todo">User</span></a>
                    </li>
                @endcan
                @can('teacher-courses')
                    <li class=" nav-item {{ Request::is('teacher-course') ? 'active' : '' }}">
                        <a href="{{route('teacher-course')}}"><i class="mdi mdi-book-open-page-variant" style="top: -5px;"></i><span class="menu-title" data-i18n="Todo">Course</span></a>
                    </li>
                @endcan
                @can('student-courses')
                    <li class=" nav-item {{ Request::is('student-course') ? 'active' : '' }}">
                        <a href="{{route('student-course')}}"><i class="mdi mdi-book-open-page-variant" style="top: -5px;"></i><span class="menu-title" data-i18n="Todo">Courses</span></a>
                    </li>
                @endcan
                @can('students_credit_list')
                    <li class=" nav-item {{ Request::is('student_credit_list') || Request::is('active_credit_page') || Request::is('search_student_credits') ? 'active' : '' }}">
                        <a href="{{route('student_credit_list')}}"><i class="fas fa-users"></i><span class="menu-title" data-i18n="Todo">Approve Credit</span></a>
                    </li>
                @endcan
                @can('student_select_credits')
                    <li class=" nav-item {{ Request::is('select_credit') || Request::is('') ? 'active' : '' }}">
                        <a href="{{route('select_credit')}}"><i class="far fa-check-square"></i><span class="menu-title" data-i18n="Todo">Select Credit</span></a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class='container pt-4' id="loader" hidden="">
      <div class='loader'>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--dot'></div>
        <div class='loader--text'></div>
      </div>
    </div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">&copy; <span id="year"></span> All Rights Reserved to<a class="text-bold-800 grey darken-2" href="" target="_blank">GU</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app.js')}}"></script>
    <script src="{{asset('public/app-assets/js/scripts/components.js')}}"></script>
    <script src="{{ asset('public/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
    <script src="{{asset('public/app-assets/js/scripts/sweetalert2.min.js')}}"></script>

    <script>
        function loader() 
        {
            $('.data').html($('#loader').html());
        }
    </script>

    <script>
        var d = new Date();
        document.getElementById('year').innerHTML = d.getFullYear();
    </script>

    <script>
        $('.badge-up').hide();
        $(document).ready(function(){
            let table_name = "{{Auth::user()->table_name}}"; 
            console.log(table_name);
            setInterval(() =>{
            if((table_name== 2) || (table_name == 3)){
                $.get("{{ route('get-notification') }}", function(data){
                    $('.media-list').html(data);
                    $('.notification-number').html(noti_number);
                });
            }
            }, 900);
        });
        $('.notification-readed-btn').click(function(){
            setTimeout(function() {
                $.get("{{ route('notification-readed') }}", function(res){
                    console.log(res);
                });
            },7000);
        });
    </script>
    @yield('script')
    @yield('resize')
</body>
<!-- END: Body-->

</html>