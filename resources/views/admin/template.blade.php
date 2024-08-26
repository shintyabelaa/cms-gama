<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <meta
            name="description"
            content="Responsive HTML Admin Dashboard Template based on Bootstrap 5"
        />
        <meta name="author" content="NobleUI" />
        <meta
            name="keywords"
            content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"
        />

        <title>NobleUI - HTML Bootstrap 5 Admin Dashboard Template</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
            rel="stylesheet"
        />
        <!-- End fonts -->

        <!-- core:css -->
        <link
            rel="stylesheet"
            href="{{ asset("assets/vendors/core/core.css") }}"
        />
        <!-- endinject -->

        <!-- Plugin css for this page -->
        <link
            rel="stylesheet"
            href="{{ asset("assets/vendors/flatpickr/flatpickr.min.css") }}"
        />
        <!-- End plugin css for this page -->

        <!-- inject:css -->
        <link
            rel="stylesheet"
            href="{{ asset("assets/fonts/feather-font/css/iconfont.css") }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset("assets/vendors/flag-icon-css/css/flag-icon.min.css") }}"
        />
        <!-- endinject -->

        <!-- Layout styles -->
        <link
            rel="stylesheet"
            href="{{ asset("assets/css/demo1/style.css") }}"
        />
        <!-- End layout styles -->

        <link
            rel="shortcut icon"
            href="{{ asset("/assets/images/favicon.png") }}"
        />

        @yield("styles")
        @vite("resources/css/app.css")
    </head>

    <body>
        <div class="main-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar">
                <div class="sidebar-header">
                   
                    <a
                    href= "{{ route('admin.owner.dashboard')}}"
                    class="!tw-text-base !tw-font-normal !tw-text-primary sidebar-brand "
                    style="font-family: 'sansation'"
                >
                    <span style="font-family: 'dyadis'">GAMA.</span>
                    COFFEE HOUSE
                </a>
                    <div class="sidebar-toggler not-active ">
                        <span class="!tw-bg-primary"></span>
                        <span class="!tw-bg-primary"></span>
                        <span class="!tw-bg-primary"></span>
                    </div>
                </div>
                <div class="sidebar-body">
                    <ul class="nav">
                        <li class="nav-item nav-category">Admin</li>
                        <li class="nav-item">
                            <a
                                href="{{ route("data-admin.index") }}"
                                class="nav-link"
                            >
                                <i class="link-icon" data-feather="user"></i>
                                <span class="link-title">Data Admin</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">Menu</li>
                        <li class="nav-item">
                            <a
                                 href="{{ route(auth()->user()->role == 'owner' ? 'admin.owner.dashboard' : (auth()->user()->role == 'kasir' ? 'admin.kasir.dashboard' : 'admin.dashboard')) }}"
                                class="nav-link"
                            >
                                <i class="link-icon" data-feather="grid"></i>
                                <span class="link-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="{{ route("products.index") }}"
                                class="nav-link"
                            >
                                <i
                                    class="link-icon"
                                    data-feather="book-open"
                                ></i>
                                <span class="link-title">Manajemen Menu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                  href="{{ route("orders.index") }}"
                                class="nav-link"
                            >
                                <i
                                    class="link-icon"
                                    data-feather="dollar-sign"
                                ></i>
                                <span class="link-title">
                                    Manajemen Pesanan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href= "{{ route('admin.review')}}"
                                class="nav-link"
                            >
                                <i
                                    class="link-icon"
                                    data-feather="dollar-sign"
                                ></i>
                                <span class="link-title">
                                    Ulasan Pelanggan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                               href="{{ route("admin.report") }}"
                                class="nav-link"
                            >
                                <i class="link-icon" data-feather="file"></i>
                                <span class="link-title">Laporan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <nav class="settings-sidebar">
                <div class="sidebar-body">
                    <a href="#" class="settings-sidebar-toggler">
                        <i data-feather="settings"></i>
                    </a>
                    <h6 class="text-muted mb-2">Sidebar:</h6>
                    <div class="border-bottom mb-3 pb-3">
                        <div class="form-check form-check-inline">
                            <input
                                type="radio"
                                class="form-check-input"
                                name="sidebarThemeSettings"
                                id="sidebarLight"
                                value="sidebar-light"
                                checked
                            />
                            <label class="form-check-label" for="sidebarLight">
                                Light
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                type="radio"
                                class="form-check-input"
                                name="sidebarThemeSettings"
                                id="sidebarDark"
                                value="sidebar-dark"
                            />
                            <label class="form-check-label" for="sidebarDark">
                                Dark
                            </label>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-wrapper">
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar">
                    <a href="#" class="sidebar-toggler">
                        <i data-feather="menu"></i>
                    </a>
                    <div class="navbar-content">
                        <?php
                        $notifications = Auth::user()->notifications->take(5); // Get the latest 5 notifications
                        ?>
                        <div class="navbar-content">
                            <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="notificationDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                <i data-feather="bell"></i>
                                <div class="indicator">
                                    <div class="circle"></div>
                                </div>
                                   
                                </a>
                                <div
                                    class="dropdown-menu p-0"
                                    aria-labelledby="notificationDropdown"
                                >
                                    <div
                                        class="d-flex align-items-center justify-content-between border-bottom px-3 py-2"
                                    >
                                    <p>{{ $notifications->count() }} New Notifications</p>
                                        <a
                                            href="javascript:;"
                                            class="text-muted"
                                        >
                                            Clear all
                                        </a>
                                    </div>
                                    <div class="p-1">
                                        @foreach($notifications as $notification)
                                        <a href="{{ route('orders.index') }}" class="dropdown-item d-flex align-items-center py-2">
                                            <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                                <i class="icon-sm text-white" data-feather="gift"></i>
                                            </div>
                                            <div class="flex-grow-1 me-2">
                                                <p>New Order from {{ $notification->data['customer_name'] }}</p>
                                                <p class="tx-12 text-muted">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </a>                                        
                                        @endforeach
                                    </div>
                                    <div
                                        class="d-flex align-items-center justify-content-center border-top px-3 py-2"
                                    >
                                        <a href="{{ route('orders.index') }}">View all</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="profileDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <img
                                        class="wd-30 ht-30 rounded-circle"
                                        src="{{ asset("assets/images/gamalogoreal.jpg") }}"
                                        alt="profile"
                                    />
                                </a>
                                <div
                                    class="dropdown-menu p-0"
                                    aria-labelledby="profileDropdown"
                                >
                                    <div
                                        class="d-flex flex-column align-items-center border-bottom px-5 py-3"
                                    >
                                        <div class="mb-3">
                                            <img
                                                class="wd-80 ht-80 rounded-circle"
                                                src="{{ asset("assets/images/gamalogoreal.jpg") }}"
                                                alt=""
                                            />
                                        </div>
                                        <div class="text-center">
                                            <p class="tx-16 fw-bolder">
                                                {{ Auth::user()->name }}
                                            </p>
                                            <p class="tx-12 text-muted">
                                                {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled p-1">
                                        <li class="d-flex dropdown-item py-2">
                                            <form
                                                action="{{ route("logout") }}"
                                                method="POST"
                                                class="d-flex text-body ms-0"
                                            >
                                                @csrf
                                                <i
                                                    class="icon-md me-2"
                                                    data-feather="log-out"
                                                ></i>
                                                <button
                                                    type="submit"
                                                    class="text-body ms-0"
                                                    style="
                                                        border: none;
                                                        background: none;
                                                        padding: 0;
                                                    "
                                                >
                                                    Log Out
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- partial -->

                <!-- CONTENT -->
                @yield("content")
                <!-- END CONTENT -->
                <!-- partial:partials/_footer.html -->
                <footer
                    class="footer d-flex flex-column flex-md-row align-items-center justify-content-between border-top small px-4 py-3"
                >
                    <p class="text-muted mb-md-0 mb-1">
                        Copyright © 2022
                        <a href="https://www.nobleui.com" target="_blank">
                            NobleUI
                        </a>
                        .
                    </p>
                    <p class="text-muted">
                        Handcrafted With
                        <i
                            class="text-primary icon-sm mb-1 ms-1"
                            data-feather="heart"
                        ></i>
                    </p>
                </footer>
                <!-- partial -->
            </div>
        </div>
        <!-- core:js -->
        <script src="{{ asset("assets/vendors/core/core.js") }}"></script>
        <!-- endinject -->

        <!-- Plugin js for this page -->
        <script src="{{ asset("assets/vendors/flatpickr/flatpickr.min.js") }}"></script>
        <script src="{{ asset("assets/vendors/apexcharts/apexcharts.min.js") }}"></script>
        <!-- End plugin js for this page -->

        <!-- inject:js -->
        <script src="{{ asset("assets/vendors/feather-icons/feather.min.js") }}"></script>
        <script src="{{ asset("assets/js/template.js") }}"></script>
        <!-- endinject -->

        <!-- Custom js for this page -->
        <script src="{{ asset("assets/js/dashboard-light.js") }}"></script>
        <!-- End custom js for this page -->

        @yield("scripts")
    </body>
</html>
