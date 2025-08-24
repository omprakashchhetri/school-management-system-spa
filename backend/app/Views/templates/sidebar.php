<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ============================ Sidebar Start ============================ -->

<aside class="sidebar">
    <!-- sidebar close btn -->
    <button type="button"
        class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i
            class="ph ph-x"></i></button>
    <!-- sidebar close btn -->

    <a href="index.html"
        class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="<?=base_url()?>assets/images/logo/logo.png" alt="Logo">
    </a>
    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            <ul class="sidebar-menu">
                <li class="sidebar-menu__item">
                    <a href="" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-squares-four"></i></span>
                        <span class="text">Admin Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="admin/role-list" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-users-three"></i></span>
                        <span class="text">Role Management</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="class-list" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-list-bullets"></i></span>
                        <span class="text">Class List</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="employee-list" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-user-list"></i></span>
                        <span class="text">Employee List</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="class-teacher-list" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-chalkboard-teacher"></i></span>
                        <span class="text">Class Teacher List</span>
                    </a>
                </li>
                <li class="sidebar-menu__item">
                    <a href="section-list" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-list-checks"></i></span>
                        <span class="text">Section List</span>
                    </a>
                </li>
                <li class="sidebar-menu__item has-dropdown">
                    <a href="javascript:void()" class=" sidebar-menu__link">
                        <span class="icon"><i class="ph ph-graduation-cap"></i></span>
                        <span class="text">Subject Management</span>
                    </a>
                    <!-- Submenu start -->
                    <ul class="sidebar-submenu">
                        <li class="sidebar-submenu__item">
                            <a href="subject-list" class="nav_js sidebar-submenu__link"> Subject List </a>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="subject-allocation" class="nav_js sidebar-submenu__link"> Subject Allocation </a>
                        </li>
                    </ul>
                    <!-- Submenu End -->
                </li>
                <li class="sidebar-menu__item">
                    <a href="payment-gateways" class="nav_js sidebar-menu__link">
                        <span class="icon"><i class="ph ph-list-checks"></i></span>
                        <span class="text">Payment Gateway</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<!-- ============================ Sidebar End  ============================ -->