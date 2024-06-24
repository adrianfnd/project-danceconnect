<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ url('/') }}">
                <img class="img-fluid for-light" src="../assets/images/logo/logo.png" style="width: 150px"
                    alt="Studio Management">
                <img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="Studio Management">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="{{ url('/') }}">
                <img class="img-fluid" src="../assets/images/logo/logo-icon.png" style="width: 40px" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{ url('/') }}">
                            <img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt="">
                        </a>
                        <div class="mobile-back text-end">
                            <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ url('/dashboard') }}">
                            <i data-feather="home"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="music"></i><span>Studio
                                Management</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ url('/studios') }}">List Studios</a></li>
                            <li><a href="{{ url('/studios-schedules') }}">List Studio Schedules</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="users"></i><span>Tutor
                                Management</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ url('/tutors') }}">List Tutors</a></li>
                            <li><a href="{{ url('/tutors-classes') }}">List Classes</a></li>
                            <li><a href="{{ url('/tutors-users') }}">List Users</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ url('/transactions') }}">
                            <i data-feather="dollar-sign"></i><span>Transaction Management</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
