<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Ready Bootstrap Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
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
                                aria-expanded="false"> <img src="assets/img/profile.jpg" alt="user-img" width="36"
                                    class="img-circle"><span>Kun Kimlong </span></span> </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4>Hizrian</h4>
                                            <p class="text-muted">hello@themekita.com</p><a href="profile.html"
                                                class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
                                <a class="dropdown-item" href="#"></i> My Balance</a>
                                <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Account
                                    Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-power-off"></i> Logout</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="assets/img/profile.jpg" alt="">
                    </div>
                    <div class="info p-2">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            Restaurant
                        </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="index.html">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                            <i class="la la-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{Route('staff.index')}}">
                            <i class="bi bi-person-square"></i>
                            <p>Staffs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{Route('position.index')}}">
                            <i class="bi bi-person-vcard-fill"></i>
                            <p>Positions</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{Route('branch.index')}}">
                            <i class="bi bi-person-vcard-fill"></i>
                            <p>Branches</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{Route('branch.index')}}">
                            <i class="la la-cog"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="notifications.html">
                            <i class="la la-bell"></i>
                            <p>Notifications</p>
                            <span class="badge badge-success">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="typography.html">
                            <i class="la la-font"></i>
                            <p>Typography</p>
                            <span class="badge badge-danger">25</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="icons.html">
                            <i class="la la-fonticons"></i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li class="nav-item update-pro">
                        <button data-toggle="modal" data-target="#modalUpdate">
                            <i class="la la-hand-pointer-o"></i>
                            <p>Update To Pro</p>
                        </button>
                    </li>
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
<script src="{{ asset('assets/js/custom.js')}}"></script>

</html>
