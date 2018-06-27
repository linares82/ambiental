@inject('menu','App\Http\Controllers\MenusController')
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('ace-master/assets/css/bootstrap.min.css') }}" />
        <!--<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="{{ asset('ace-master/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

        <!-- page specific plugin styles -->

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ asset('ace-master/assets/css/fonts.googleapis.com.css') }}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('ace-master/assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('ace-master/assets/css/ace-skins.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('ace-master/assets/css/ace-rtl.min.css') }}" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="{{ asset('ace-master/assets/js/ace-extra.min.js') }}"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
        <style>
            .navbar {
                border-radius: 0;
                margin-bottom: 0;
            }

            .navbar-default {
                background-color: #04a822;
                border-color: #6d8f6c;
            }
            .navbar-default .navbar-brand {
                color: #ecf1ec;
            }
            .navbar-default .navbar-brand:hover,
            .navbar-default .navbar-brand:focus {
                color: #ecdbff;
            }
            .navbar-default .navbar-text {
                color: #ecf1ec;
            }
            .navbar-default .navbar-nav > li > a {
                color: #ecf1ec;
            }
            .navbar-default .navbar-nav > li > a:hover,
            .navbar-default .navbar-nav > li > a:focus {
                color: #ecdbff;
            }
            .navbar-default .navbar-nav > .active > a,
            .navbar-default .navbar-nav > .active > a:hover,
            .navbar-default .navbar-nav > .active > a:focus {
                color: #ecdbff;
                background-color: #6d8f6c;
            }
            .navbar-default .navbar-nav > .open > a,
            .navbar-default .navbar-nav > .open > a:hover,
            .navbar-default .navbar-nav > .open > a:focus {
                color: #ecdbff;
                background-color: #6d8f6c;
            }
            .navbar-default .navbar-toggle {
                border-color: #6d8f6c;
            }
            .navbar-default .navbar-toggle:hover,
            .navbar-default .navbar-toggle:focus {
                background-color: #6d8f6c;
            }
            .navbar-default .navbar-toggle .icon-bar {
                background-color: #ecf1ec;
            }
            .navbar-default .navbar-collapse,
            .navbar-default .navbar-form {
                border-color: #ecf1ec;
            }
            .navbar-default .navbar-link {
                color: #ecf1ec;
            }
            .navbar-default .navbar-link:hover {
                color: #ecdbff;
            }

            @media (max-width: 767px) {
                .navbar-default .navbar-nav .open .dropdown-menu > li > a {
                    color: #ecf1ec;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
                .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
                    color: #ecdbff;
                }
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
                .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
                    color: #ecdbff;
                    background-color: #6d8f6c;
                }
            }
        </style>
        <!-- Colorpicker-->
        <link rel="stylesheet" href="{{ asset('ace-master/assets/css/bootstrap-colorpicker.min.css') }}" />
        <!--Editable-->
        <link rel="stylesheet" href="{{asset('ace-master/assets/css/bootstrap-editable.min.css')}}" />
        <!--Chosen-->
        <link rel="stylesheet" href="{{asset('ace-master/assets/css/chosen.min.css')}}" type="text/css" />
        <!--ToAStr-->
        <link rel="stylesheet" href="{{asset('ace-master/assets/css/toastr.css')}}" type="text/css" />
        <!--Datetime picker-->
        <link rel="stylesheet" href="{{asset('ace-master/assets/css/bootstrap-datetimepicker.min.css')}}" />
        <link rel="stylesheet" href="{{asset('ace-master/assets/css/bootstrap-datepicker3.min.css')}}" />
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="{{url('/home')}}" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            {{ config('app.name', 'Laravel') }}
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">

                        @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @else
                        <li class="light-green dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                    <!--<img class="nav-user-photo" src="{{ asset('ace-master/assets/images/avatars/user.jpg') }}" alt="Jason's Photo" />
                                -->
                                <span class="user-info">
                                    <small>Bienvenido,</small>
                                    {{ Auth::user()->name }}
                                </span>

                                                                <!--<i class="ace-icon fa fa-caret-down"></i>-->
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Settings
                                    </a>
                                </li>

                                <li>
                                    <a href="profile.html">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="green">
                            <a href="{{ route('users.user.editPerfil', Auth::user()->id) }}">
                                <i class="ace-icon fa fa-user"></i>
                                Perfil
                            </a>
                        </li>
                        <li class="green">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                Salir
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            <div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed sidebar-scroll" data-sidebar="true" data-sidebar-scroll="true" data-sidebar-hover="true">
                <script type="text/javascript">
                    try {
                        ace.settings.loadState('sidebar')
                    } catch (e) {
                    }
                </script>
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse" style="height:40px;">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
                <ul class="nav nav-list">
                    <?php
                    echo $menu->armaMenu(1);
                    ?> 

                </ul><!-- /.nav-list -->

            </div>

            <div class="main-content">
                <div class="main-content-inner">


                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            @yield('content')
                            <!-- PAGE CONTENT ENDS -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </div>
            </div><!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-60">
                            Derechos reservados 2107, {{ config('app.name', 'Laravel') }}
                        </span>

                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!--[if !IE]> -->
        <script src="{{ asset('ace-master/assets/js/jquery-2.1.4.min.js') }}"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
                    if ('ontouchstart' in document.documentElement)
                        document.write("<script src='" + "{{ asset('ace-master/assets/js/jquery.mobile.custom.min.js') }}" + "'>" + "<" + "/script>");
        </script>
        <script src="{{ asset('ace-master/assets/js/bootstrap.min.js') }}"></script>
        <!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="{{ asset('ace-master/assets/js/jquery-ui.custom.min.js') }}"></script>
        <script src="{{ asset('ace-master/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
        <script src="{{ asset('ace-master/assets/js/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('ace-master/assets/js/jquery.sparkline.index.min.js') }}"></script>


        <!-- ace scripts -->
        <script src="{{ asset('ace-master/assets/js/ace-elements.min.js') }}"></script>
        <script src="{{ asset('ace-master/assets/js/ace.min.js') }}"></script>

        <!--Colorpicker-->
        <script src="{{ asset('ace-master/assets/js/bootstrap-colorpicker.min.js') }}"></script>
        <!--Editable-->
        <script src="{{ asset('ace-master/assets/js/bootstrap-editable.min.js') }}"></script>
        <!--        Chosen-->
        <script src="{{ asset('ace-master/assets/js/chosen.jquery.min.js') }}"></script>
        <!--ToAStr-->
        <script src="{{ asset('ace-master/assets/js/toastr.js') }}"></script>
        <!--Moment for datetime picker-->
        <script src="{{ asset('ace-master/assets/js/moment.min.js') }}"></script>
        <!--Datetime picker-->
        <script src="{{ asset('ace-master/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        <!-- Date picker-->
        <script src="{{ asset('ace-master/assets/js/bootstrap-datepicker.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#search_form").hide();
                $("#search_btn").click(function () {
                    $("#search_form").toggle(1000);
                });
                $(".chosen").chosen({width: "100%"});
            });
            $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function(){
                    $(this).prev().focus();
            });
        </script>
        <!-- inline scripts related to this page -->
        @stack('scripts')

    </body>
</html>
