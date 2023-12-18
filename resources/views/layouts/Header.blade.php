@php
    $unreadNoti = auth()->user()->unreadNotifications;
@endphp
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="#" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset(config('app.companyInfo.logo')) }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset(config('app.companyInfo.logo')) }}" class="rounded" alt="" height="50">
                        </span>
                    </a>

                    <a href="#" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset(config('app.companyInfo.logo')) }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset(config('app.companyInfo.logo')) }}" class="rounded" alt="" height="50">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                            id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="dropdown-item bg-transparent text-wrap">
                                <a href="{{ url('/dashboard') }}" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i
                                        class="mdi mdi-magnify ms-1"></i></a>
                                <a href="{{ url('/dashboard') }}" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i
                                        class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header mt-2">
                                <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src=""
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="fs-11 mb-0 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src=""
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                    <div class="d-flex">
                                        <img src=""
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="fs-11 mb-0 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i
                                    class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="ms-1 header-item d-none">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>


                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell fs-22"></i>
                        @if (count($unreadNoti))
                            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{ $unreadNoti->count()}}<span class="visually-hidden">unread messages</span></span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 overflow-hidden" aria-labelledby="page-header-notifications-dropdown" style="border-color:transparent;border-radius: 15px">

                        <div class="dropdown-head bg-pattern rounded-top" style="background: #1F2C3E;">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13">{{ count($unreadNoti)}} New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
                                            New
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content" id="notificationItemsTabContent" style="max-height: 300px; overflow-y: scroll;overflow-x: hidden;">
                            <div class="tab-pane fade p-1 active show" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
                                @if (count($unreadNoti) != 0)
                                    @foreach ($unreadNoti as $noti)
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                                    <i class="bx bx-message-square-dots"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <a href="{{ route('order.detail',['order'=>$noti->data['orderId'],'notiId'=>$noti->id]) }}" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 fs-13 lh-base"><b class="text-success">{{ $noti->data['name'] }}</b> {{$noti->data['message']}}
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline me-2"></i>{{$noti->created_at->diffForHumans()}}</span>

                                                </p>
                                            </div>
                                            <div class="">
                                                <a href="{{ route('noti.delete',$noti->id) }}" class="btn noti_close_btn shadow-sm  p-1 py-1 d-flex justify-content-center align-items-center" style="width: 30px;height:30px;z-index:2000;"><i class=" ri-close-fill"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                @else
                                    <div class="w-25 w-sm-50 pt-3 mx-auto">
                                        <img src="{{ asset('assets/images/svg/bell.svg') }}" class="img-fluid" alt="user-pic">
                                    </div>
                                    <div class="text-center pb-5 mt-2">
                                        <h6 class="fs-18 fw-semibold lh-base">You have no any notifications </h6>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/user-dummy-img.jpg') }}"
                                alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user()->name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Admin</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}!</h6>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                            class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                            class="align-middle">Edit Profile</span></a>
                        <a class="dropdown-item" href="{{ route('editPassword') }}"><i
                                class="ri-key-fill  text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Edit Password</span></a>
                        <a class="dropdown-item" href="{{ route('logout') }}" id="logoutBtn" onclick="return confirm('Are you sure you want to logout?')"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
