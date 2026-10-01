<div class="dashboard-main-wrapper">
    <div class="top-navbar flex-between gap-16">

        <div class="flex-align gap-16">
            <!-- Toggle Button Start -->
            <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i
                    class="ph ph-list"></i></button>
            <!-- Toggle Button End -->


            <form action="index.html#" class="w-350 d-none">
                <div class="position-relative">
                    <button type="submit" class="input-icon text-xl d-flex text-gray-100 pointer-event-none"><i
                            class="ph ph-magnifying-glass"></i></button>
                    <input type="text"
                        class="form-control ps-40 h-40 border-transparent focus-border-main-600 bg-main-50 rounded-pill placeholder-15"
                        placeholder="Search...">
                </div>
            </form>
        </div>

        <div class="flex-align gap-16">
            <div class="flex-align gap-8">
                <!-- Notification Start -->
                <div class="dropdown">
                    <button
                        class="dropdown-btn text-gray-500 w-40 h-40 bg-main-50 hover-bg-main-100 transition-2 rounded-circle text-xl flex-center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="position-relative">
                            <i class="ph ph-bell"></i>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom p-0 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="py-8 px-24 bg-main-600">
                                    <div class="flex-between">
                                        <h5 class="text-xl fw-semibold text-white mb-0">Notifications</h5>
                                        <button type="button"
                                            class="close-dropdown hover-scale-1 text-xl text-white"><i
                                                class="ph ph-x"></i></button>
                                    </div>
                                </div>
                                <div class="p-24 text-center text-gray-400">
                                    Notifications aren't set up yet.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Notification End -->

                <!-- Language Start -->
                <div class="dropdown d-none">
                    <button
                        class="text-gray-500 w-40 h-40 bg-main-50 hover-bg-main-100 transition-2 rounded-circle text-xl flex-center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ph ph-globe"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu--md border-0 bg-transparent p-0">
                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                            <div class="card-body">
                                <div class="max-h-270 overflow-y-auto scroll-sm pe-8">
                                    <div
                                        class="form-check form-radio d-flex align-items-center justify-content-between ps-0 mb-16">
                                        <label
                                            class="ps-0 form-check-label line-height-1 fw-medium text-secondary-light"
                                            for="arabic">
                                            <span
                                                class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-8">
                                                <img src="<?= base_url() ?>assets/images/thumbs/flag1.png" alt=""
                                                    class="w-32-px h-32-px border borde border-gray-100 rounded-circle flex-shrink-0">
                                                <span class="text-15 fw-semibold mb-0">Arabic</span>
                                            </span>
                                        </label>
                                        <input class="form-check-input" type="radio" name="language" id="arabic">
                                    </div>
                                    <div
                                        class="form-check form-radio d-flex align-items-center justify-content-between ps-0 mb-16">
                                        <label
                                            class="ps-0 form-check-label line-height-1 fw-medium text-secondary-light"
                                            for="germany">
                                            <span
                                                class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-8">
                                                <img src="<?= base_url() ?>assets/images/thumbs/flag2.png" alt=""
                                                    class="w-32-px h-32-px border borde border-gray-100 rounded-circle flex-shrink-0">
                                                <span class="text-15 fw-semibold mb-0">Germany</span>
                                            </span>
                                        </label>
                                        <input class="form-check-input" type="radio" name="language" id="germany">
                                    </div>
                                    <div
                                        class="form-check form-radio d-flex align-items-center justify-content-between ps-0 mb-16">
                                        <label
                                            class="ps-0 form-check-label line-height-1 fw-medium text-secondary-light"
                                            for="english">
                                            <span
                                                class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-8">
                                                <img src="<?= base_url() ?>assets/images/thumbs/flag3.png" alt=""
                                                    class="w-32-px h-32-px border borde border-gray-100 rounded-circle flex-shrink-0">
                                                <span class="text-15 fw-semibold mb-0">English</span>
                                            </span>
                                        </label>
                                        <input class="form-check-input" type="radio" name="language" id="english">
                                    </div>
                                    <div
                                        class="form-check form-radio d-flex align-items-center justify-content-between ps-0">
                                        <label
                                            class="ps-0 form-check-label line-height-1 fw-medium text-secondary-light"
                                            for="spanish">
                                            <span
                                                class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-8">
                                                <img src="<?= base_url() ?>assets/images/thumbs/flag4.png" alt=""
                                                    class="w-32-px h-32-px border borde border-gray-100 rounded-circle flex-shrink-0">
                                                <span class="text-15 fw-semibold mb-0">Spanish</span>
                                            </span>
                                        </label>
                                        <input class="form-check-input" type="radio" name="language" id="spanish">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Language Start -->
            </div>


            <!-- User Profile Start -->
            <div class="dropdown">
                <button
                    class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="position-relative">
                        <img src="<?= esc($currentUser['profile_image'] ?? base_url('assets/images/thumbs/user-img.png')) ?>" alt="Image"
                            class="h-32 w-32 rounded-circle">
                        <span
                            class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                    <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                        <div class="card-body">
                            <div class="flex-align gap-8 mb-20 pb-20 border-bottom border-gray-100">
                                <img src="<?= esc($currentUser['profile_image'] ?? base_url('assets/images/thumbs/user-img.png')) ?>" alt=""
                                    class="w-54 h-54 rounded-circle">
                                <div class="">
                                    <h4 class="mb-0"><?= esc($currentUser['name'] ?? '') ?: 'Student' ?></h4>
                                    <p class="fw-medium text-13 text-gray-200"><?= esc($currentUser['email'] ?? '') ?></p>
                                </div>
                            </div>
                            <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                                <li class="mb-4">
                                    <a href="profile" class="nav_js
                                        py-12 text-15 px-20 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium text-15">
                                        <span class="text-2xl text-primary-600 d-flex"><i class="ph ph-gear"></i></span>
                                        <span class="text">Account Settings</span>
                                    </a>
                                </li>
                                <li class="pt-8 border-top border-gray-100">
                                    <button onclick="logout()" id="logoutBtn"
                                        class="logout_btn py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                        <span class="text-2xl text-danger-600 d-flex"><i
                                                class="ph ph-sign-out"></i></span>
                                        <span class="text">Log Out</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Profile Start -->

        </div>
    </div>