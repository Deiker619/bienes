<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css" />
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="shortcut icon" href="../assets/images/favicon.png" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body style="background-color: #f2f2f2;">
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
                <a class="sidebar-brand brand-logo" href="{{route('dashboard')}}"><img style="object-fit: scale-down" src="../assets/images/fundacion.png"
                        alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{route('dashboard')}}"><img
                    style="object-fit: scale-down"  src="../assets/images/logo-minis-.png" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="../assets/images/faces/face1.jpg" alt="profile" />
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column pr-3">
                            <span class="font-weight-medium mb-2">{{ Auth::user()->name }}</span>
                            <!--    <span class="font-weight-normal">$8,753.00</span> -->
                        </div>
                        <!-- <span class="badge badge-danger text-white ml-3 rounded">3</span> -->
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                @can('dashboard.Artificios')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('artificios') }}">
                            <i class="mdi mdi-wheelchair-accessibility menu-icon"></i>
                            <span class="menu-title">Artificios</span>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('coordinacion') }}">
                        <i class="mdi mdi-home-city menu-icon"></i>
                        <span class="menu-title">Coordinaciones</span>
                    </a>
                </li>
                <!-- Menu desplegable -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        <span class="menu-title">Basic UI Elements</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('stock_show') }}">
                        <i class="mdi mdi-cube-outline menu-icon"></i>
                        <span class="menu-title">Stock</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('retiro_stock') }}">
                        <i class="mdi  mdi-cube-send menu-icon"></i>
                        <span class="menu-title">Retirar de stock</span>
                    </a>
                </li>
                @can('dashboard.usuario')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('usuario') }}">
                            <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                            <span class="menu-title">Gestión de usuarios</span>
                        </a>
                    </li>
                @endcan
                <!-- DIVISOR -->
                <!-- <li class="nav-item">
                    <span class="nav-link" href="#">
                        <span class="menu-title">Docs</span>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">Documentation</span>
                    </a>
                </li> -->
                <li class="nav-item sidebar-actions">
                    <div class="nav-link">
                        <div class="mt-4">

                            <ul class="mt-4 pl-0">
                                <form action="{{ route('logout') }}" method="POST" x-data>
                                    @csrf

                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit()">
                                        <li>Sign Out</li>
                                    </a>
                                </form>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles light"></div>
                    <div class="tiles dark"></div>
                </div>
            </div>
            <nav class="navbar col-lg-12 col-12  p-lg-0 fixed-top d-flex flex-row">
                <!-- BARRA SUPERIOR -->
                <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
                    <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img
                            src="../assets/images/logo-mini.svg" alt="logo" /></a>
                    <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button"
                        data-toggle="minimize">
                        <i class="mdi mdi-menu"></i>
                    </button>
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="count count-varient1">7</span>
                            </a>
                            
                            <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../assets/images/faces/face4.jpg" alt="" class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on your photo</span>
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../assets/images/faces/face3.jpg" alt="" class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="mb-0"> James <span class="text-small text-muted">posted a photo on your wall</span>
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="../assets/images/faces/face2.jpg" alt="" class="profile-pic" />
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="mb-0"> Alex <span class="text-small text-muted">just mentioned you in his post</span>
                                        </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0">View all activities</p>
                            </div>
                        </li> -->
                        <!-- <li class="nav-item dropdown d-none d-sm-flex">
                            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="count count-varient2">5</span>
                            </a>
                            <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="messageDropdown">
                                <h6 class="p-3 mb-0">Messages</h6>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-item-content flex-grow">
                                        <span class="badge badge-pill badge-success">Request</span>
                                        <p class="text-small text-muted ellipsis mb-0"> Suport needed for user123 </p>
                                    </div>
                                    <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-item-content flex-grow">
                                        <span class="badge badge-pill badge-warning">Invoices</span>
                                        <p class="text-small text-muted ellipsis mb-0"> Invoice for order is mailed </p>
                                    </div>
                                    <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-item-content flex-grow">
                                        <span class="badge badge-pill badge-danger">Projects</span>
                                        <p class="text-small text-muted ellipsis mb-0"> New project will start tomorrow </p>
                                    </div>
                                    <p class="text-small text-muted align-self-start"> 4:10 PM </p>
                                </a>
                                <h6 class="p-3 mb-0">See all activity</h6>
                            </div>
                        </li> -->
                        <li class="nav-item nav-search border-0 ml-1 ml-md-3 ml-lg-5 d-none d-md-flex">

                            @livewire('search.search-show')
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right ml-lg-auto">
                        
                        <!-- IDIOMA -->
                        <!-- <li class="nav-item dropdown d-none d-xl-flex border-0">
                            <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                                <i class="mdi mdi-earth"></i> English </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                                <a class="dropdown-item" href="#"> French </a>
                                <a class="dropdown-item" href="#"> Spain </a>
                                <a class="dropdown-item" href="#"> Latin </a>
                                <a class="dropdown-item" href="#"> Japanese </a>
                            </div>
                        </li> -->
                        <!-- END IDIOMA-->
                        <!-- PERFIL -->
                        <li class="nav-item nav-profile dropdown  border-0">
                            <a class="nav-link dropdown-toggle flex align-items-center" id="profileDropdown"
                                href="#" data-toggle="dropdown">
                                <img class="nav-profile-img mr-2" alt=""
                                    src="../assets/images/faces/face3.jpg" />
                                <span class="profile-name">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="mdi mdi-cached mr-2 text-success"></i> Perfil </a>
                                <form action="{{ route('logout') }}" method="POST" x-data>
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        @click.prevent="$root.submit()">

                                        <i class="mdi mdi-logout mr-2 text-primary"></i> {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </li>
                       
                        <!-- END PERFIL -->
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
                <!-- END BARRA SUPERIOR -->
            </nav>
            <!-- CONTENEDOR PRINCIPAL -->
            <div class="main-panel">

                <div class="content-wrapper pb-0">
                    {{ $slot }}
                </div>

                <!-- FOOTER -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                            Fundación José Gregorio Hernández {{date('Y')}}</span>
                        
                    </div>
                </footer>
                <!-- END -->
            </div>
            <!-- END CONTENEDOR PRINCIPAL -->
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @livewireScripts
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
 {{--    <script src="../assets/vendors/chart.js/Chart.min.js"></script> --}}
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
     <script src="../assets/vendors/flot/jquery.flot.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
    <script src="../assets/vendors/flot/jquery.flot.pie.js"></script> 
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
     <!-- <script src="../assets/js/hoverable-collapse.js"></script> -->
    <script src="../assets/js/misc.js"></script> 
    <!-- endinject -->


    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    @stack('modals')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('artificioAdded', (message) => {
            /* console.log(message); */
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                background: "#66BB6A",
                customClass: {
                    title: 'text-white  custom-title',
                    fontWeight: '500'
                }

            });
            Toast.fire({
                icon: "success",
                title: message,
               
            });
        });
        Livewire.on('error', (message) => {
            /* console.log(message); */
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                background: "#ef233c",
                customClass: {
                    title: 'text-white  custom-title',
                    fontWeight: '500'
                }

            });
            Toast.fire({
                icon: "error",
                title: message
            });
        });
    </script>

    @if (isset($js))
        {{ $js }}

    @endif


</body>

</html>
