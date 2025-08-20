<div class="dashboard-body">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb mb-24">
        <ul class="flex-align gap-4">
            <li>
                <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
            </li>
            <li>
                <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
            </li>
            <li><span class="text-main-600 fw-normal text-15">Library</span></li>
        </ul>
    </div>
    <!-- Breadcrumb End -->

    <!-- Recommended Start -->
    <div class="card mt-24">
        <div class="card-body">
            <form action="library.html#" class="search-input-form">
                <div class="search-input">
                    <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Category</option>
                        <option value="">Web Development</option>
                        <option value="">Web Design</option>
                        <option value="">UX/UI Design</option>
                        <option value="">SEO</option>
                        <option value="">Content Writing</option>
                        <option value="">WordPress Development</option>
                    </select>
                </div>
                <div class="search-input">
                    <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Design Level</option>
                        <option value="">Authentication</option>
                        <option value="">Meta</option>
                        <option value="">System</option>
                    </select>
                </div>
                <div class="search-input">
                    <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Duration</option>
                        <option value="">1 Hour</option>
                        <option value="">2 Hour</option>
                        <option value="">3 Hour</option>
                        <option value="">4 Hour</option>
                    </select>
                </div>
                <div class="search-input">
                    <select class="form-control form-select h6 rounded-4 mb-0 py-6 px-8">
                        <option value="" selected disabled>Type</option>
                        <option value="">Authentication</option>
                        <option value="">Meta</option>
                        <option value="">System</option>
                    </select>
                </div>
                <div class="search-input custom--range range-slider px-8">
                    <div id="slider-range"></div>
                    <div class="custom--range__content mt-4">
                        <input type="text" class="custom--range__prices text-gray-600 text-13 fw-semibold" id="amount"
                            readonly />
                    </div>
                </div>
                <div class="search-input">
                    <button type="submit" class="btn btn-main rounded-pill py-9 w-100">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Recommended End -->

    <!-- Recommended Start -->
    <div class="card mt-24">
        <div class="card-body">
            <div class="mb-20 flex-between flex-wrap gap-8">
                <h4 class="mb-0">Recommended For You</h4>
                <div class="flex-align gap-8 flex-wrap">
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-8 focus-border-main-600">
                        <span class="text-lg"><i class="ph ph-layout"></i></span>
                        <select class="form-control px-8 py-12 border-0 text-inherit rounded-4 text-center">
                            <option value="1" selected disabled>Category</option>
                            <option value="1">Web</option>
                            <option value="1">Design</option>
                            <option value="1">App</option>
                            <option value="1">SEO</option>
                        </select>
                    </div>
                    <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                        <span class="text-inherit">Sort by: </span>
                        <div
                            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-8 focus-border-main-600">
                            <span class="text-lg"><i class="ph ph-funnel-simple"></i></span>
                            <select class="form-control px-8 py-12 border-0 text-inherit rounded-4 text-center">
                                <option value="1" selected>Popular</option>
                                <option value="1">Latest</option>
                                <option value="1">Trending</option>
                                <option value="1">Matches</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-20">
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img1.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span
                                    class="text-13 py-2 px-10 rounded-pill bg-success-50 text-success-600 mb-16">Authetication</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Security Management</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img1.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Albert
                                                James</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img2.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span class="text-13 py-2 px-10 rounded-pill bg-main-50 text-main-600 mb-16">Meta</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Meta Verse Method</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img2.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Rober
                                                Fox</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img3.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span
                                    class="text-13 py-2 px-10 rounded-pill bg-warning-50 text-warning-600 mb-16">System</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Hook Methodology</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img3.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Sara
                                                Wilson</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img4.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span
                                    class="text-13 py-2 px-10 rounded-pill bg-success-50 text-success-600 mb-16">Authetication</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Security Management</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img4.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Albert
                                                James</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img5.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span
                                    class="text-13 py-2 px-10 rounded-pill bg-success-50 text-success-600 mb-16">Authetication</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Data Base System</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img5.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Alizabeth
                                                Doe</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img6.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span class="text-13 py-2 px-10 rounded-pill bg-main-50 text-main-600 mb-16">Meta</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Design Volt</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img6.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Ronald
                                                Edwads</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img7.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span
                                    class="text-13 py-2 px-10 rounded-pill bg-warning-50 text-warning-600 mb-16">System</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Printing Design Theory</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img7.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Esther
                                                Howard</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="card border border-gray-100">
                        <div class="card-body p-8">
                            <a href="course-details.html"
                                class="bg-main-100 rounded-16 overflow-hidden text-center mb-8 h-164 flex-center">
                                <img src="<?=base_url()?>assets/images/thumbs/library-img8.png" alt="Course Image"
                                    class="cover-img" />
                            </a>
                            <div class="p-8">
                                <span
                                    class="text-13 py-2 px-10 rounded-pill bg-success-50 text-success-600 mb-16">Authetication</span>
                                <h5 class="mb-8">
                                    <a href="course-details.html" class="hover-text-main-600">Digital Marketing</a>
                                </h5>

                                <div class="flex-align gap-8">
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
                                        <span class="text-13 text-gray-600">15 min read</span>
                                    </div>
                                    <div class="flex-align gap-4">
                                        <span class="text-sm text-main-600 d-flex"><i
                                                class="ph ph-chats-circle"></i></span>
                                        <span class="text-13 text-gray-600">15K</span>
                                    </div>
                                </div>

                                <div class="flex-align gap-8 flex-wrap mt-20">
                                    <img src="<?=base_url()?>assets/images/thumbs/user-img8.png"
                                        class="w-28 h-28 rounded-circle object-fit-cover" alt="User Image" />
                                    <div>
                                        <span class="text-gray-600 text-13">Writer
                                            <a href="https://html.themeholy.com/edmate/profile.html"
                                                class="fw-semibold text-gray-700 hover-text-main-600 hover-text-decoration-underline">Jacob
                                                Jones</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-between gap-4 flex-wrap mt-20">
                                    <div class="flex-align gap-4">
                                        <span class="text-15 fw-bold text-warning-600 d-flex"><i
                                                class="ph-fill ph-star"></i></span>
                                        <span class="text-13 fw-bold text-gray-600">4.8</span>
                                        <span class="text-13 fw-bold text-gray-600">(17k)</span>
                                    </div>
                                    <a href="course-details.html"
                                        class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                                        Read Now
                                        <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-between flex-wrap gap-8 mt-20">
                <a href="library.html#" class="btn btn-outline-gray rounded-pill py-9 flex-align gap-4">
                    <span class="d-flex text-xl"><i class="ph ph-arrow-left"></i></span>
                    Previous
                </a>

                <ul class="pagination flex-align flex-wrap">
                    <li class="page-item active">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">8</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">9</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                            href="library.html#">10</a>
                    </li>
                </ul>

                <a href="library.html#" class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
                    Next
                    <span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </div>
    <!-- Recommended End -->
</div>