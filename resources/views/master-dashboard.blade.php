<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Ready Bootstrap Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <div class="col-2"></div>
                    <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img src="{{asset('Store/'.Auth::user()->profile)}}" alt="user-img" width="36" height="36"
                                    class="img-circle"><span>{{Auth::user()->fullName()}}</span></span> </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="{{asset('Store/'.Auth::user()->profile)}}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{Auth::user()->fullName()}}</h4>
                                            <p class="text-muted">{{Auth::user()->email}}</p><a href="{{route('staff.show',Auth::user()->id)}}"
                                                class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="info p-2">
                        <a class="d-flex align-items-center " href="{{route('home')}}">
                            <div class="photo">
                                <img src="{{asset('Store/'.$company->logo)}}" alt="">
                            </div>
                             {{$company->name}}
                        </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="{{route('home')}}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                            <i class="la la-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="" data-toggle="collapse" href="#staffshow" aria-expanded="true">
                            <i class="bi bi-person-square"></i>
                            <p>Staff</p>
                            <span style="margin-left: auto;" class="caret"></span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="staffshow" aria-expanded="true" style="">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('staff.index')}}">
                                        <i class="bi bi-person-square"></i>
                                        <span class="link-collapse">View Staff</span>
                                    </a>
                                </li>
                                @if (!Gate::denies('admin'))
                                <li>
                                    <a href="{{route('staff.create')}}">
                                        <i class="bi bi-person-square"></i>
                                        <span class="link-collapse">Add staff</span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('food.index') }}">
                            <i class="la la-cog"></i>
                            <p>Food</p>
                        </a>
                    </li>
                    @if (!Gate::denies('admin'))
                    <li class="nav-item">
                        <a href="{{ Route('position.index') }}">
                            <i class="bi bi-person-vcard-fill"></i>
                            <p>Positions</p>
                        </a>
                    </li>
                    @endif
                    @if (!Gate::denies('admin'))
                        <li class="nav-item">
                            <a href="{{ Route('branch.index') }}">
                                <i class="bi bi-person-vcard-fill"></i>
                                <p>Branches</p>
                            </a>
                        </li>
                    @endif
                    @if (!Gate::denies('admin'))
                        <li class="nav-item">
                            <a href="{{ Route('show.company') }}">
                                <i class="la la-cog"></i>
                                <p>Setting</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    @yield('page-title')

                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title">Creating Branch Form</h6>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</body>

@stack('scripts')
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/ready.min.js') }}"></script>
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</html>
