<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">View Class Routine</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-outline-main text-sm btn-sm px-24 py-12 rounded-8">
                <i class="ph ph-printer me-8"></i>
                Print Routine
            </button>
            <button class="nav_js btn btn-main text-sm btn-sm px-24 py-12 rounded-8" data-route="academic/create-class-routine">
                <i class="ph ph-calendar-plus me-8"></i>
                Add Routine
            </button>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Filter Section Start -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Select Class</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-chalkboard-teacher"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="classSelect">
                            <option value="" selected disabled>Choose Class</option>
                            <option value="1">Class 1</option>
                            <option value="2">Class 2</option>
                            <option value="3">Class 3</option>
                            <option value="4">Class 4</option>
                            <option value="5">Class 5</option>
                            <option value="6">Class 6</option>
                            <option value="7" selected>Class 7</option>
                            <option value="8">Class 8</option>
                            <option value="9">Class 9</option>
                            <option value="10">Class 10</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-gray-900">Select Section</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-users-three"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4"
                            id="sectionSelect">
                            <option value="" selected disabled>Choose Section</option>
                            <option value="A" selected>Section A</option>
                            <option value="B">Section B</option>
                            <option value="C">Section C</option>
                            <option value="D">Section D</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-main w-100 py-16 rounded-4">
                        <i class="ph ph-magnifying-glass me-8"></i>
                        View Routine
                    </button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-main w-100 py-16 rounded-4">
                        <i class="ph ph-arrows-clockwise me-8"></i>
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Section End -->

    <!-- Routine Info Card Start -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="flex-align gap-8">
                        <div class="w-44 h-44 flex-center bg-main-50 rounded-circle">
                            <i class="ph ph-chalkboard-teacher text-main-600 text-xl"></i>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Class</span>
                            <h6 class="mb-0">Class 7 - Section A</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="flex-align gap-8">
                        <div class="w-44 h-44 flex-center bg-success-50 rounded-circle">
                            <i class="ph ph-clock text-success-600 text-xl"></i>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Total Periods</span>
                            <h6 class="mb-0">7 Periods/Day</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="flex-align gap-8">
                        <div class="w-44 h-44 flex-center bg-warning-50 rounded-circle">
                            <i class="ph ph-timer text-warning-600 text-xl"></i>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">Period Duration</span>
                            <h6 class="mb-0">45 Minutes</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="flex-align gap-8">
                        <div class="w-44 h-44 flex-center bg-info-50 rounded-circle">
                            <i class="ph ph-calendar text-info-600 text-xl"></i>
                        </div>
                        <div>
                            <span class="text-gray-400 text-sm">School Days</span>
                            <h6 class="mb-0">Monday - Saturday</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Routine Info Card End -->

    <!-- Routine Table Section Start -->
    <div class="card overflow-hidden">
        <div class="card-header flex-between flex-wrap gap-8">
            <h6 class="text-lg mb-0">Weekly Class Routine - Class 7 (Section A)</h6>
            <div class="flex-align gap-8">
                <span class="badge bg-main-600 text-white py-8 px-16 rounded-pill">
                    <i class="ph ph-calendar-check me-4"></i>
                    Academic Year 2025-2026
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive px-4">
                <table class="table table-striped dataTable mb-0">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300 bg-main-50">Day</th>
                            <th class="h6 text-gray-300">
                                Period 1
                                <br><small class="text-gray-200 fw-normal">08:00 - 08:45</small>
                            </th>
                            <th class="h6 text-gray-300">
                                Period 2
                                <br><small class="text-gray-200 fw-normal">08:45 - 09:30</small>
                            </th>
                            <th class="h6 text-gray-300">
                                Period 3
                                <br><small class="text-gray-200 fw-normal">09:30 - 10:15</small>
                            </th>
                            <th class="h6 text-gray-300">
                                Period 4
                                <br><small class="text-gray-200 fw-normal">10:15 - 11:00</small>
                            </th>
                            <th class="h6 text-gray-300 bg-warning-50">
                                Lunch Break
                                <br><small class="text-gray-200 fw-normal">11:00 - 11:30</small>
                            </th>
                            <th class="h6 text-gray-300">
                                Period 5
                                <br><small class="text-gray-200 fw-normal">11:30 - 12:15</small>
                            </th>
                            <th class="h6 text-gray-300">
                                Period 6
                                <br><small class="text-gray-200 fw-normal">12:15 - 01:00</small>
                            </th>
                            <th class="h6 text-gray-300">
                                Period 7
                                <br><small class="text-gray-200 fw-normal">01:00 - 01:45</small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Monday -->
                        <tr>
                            <td class="bg-main-50">
                                <span class="h6 mb-0 fw-semibold text-main-600">Monday</span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">Mathematics</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Sharma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-success-50 text-success-600 py-8 px-16 rounded-pill fw-medium">English</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Gupta</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-info-50 text-info-600 py-8 px-16 rounded-pill fw-medium">Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Dr. Verma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-warning-50 text-warning-600 py-8 px-16 rounded-pill fw-medium">Social
                                        Studies</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Kumar</p>
                                </div>
                            </td>
                            <td class="bg-warning-50 text-center align-middle">
                                <span class="badge bg-warning-600 text-white py-12 px-20 fw-semibold">
                                    <i class="ph ph-fork-knife me-4"></i>
                                    Lunch
                                </span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-danger-50 text-danger-600 py-8 px-16 rounded-pill fw-medium">Hindi</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Patel</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-purple-50 text-purple-600 py-8 px-16 rounded-pill fw-medium">Computer
                                        Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Singh</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill fw-medium">Physical
                                        Education</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Coach Reddy</p>
                                </div>
                            </td>
                        </tr>

                        <!-- Tuesday -->
                        <tr>
                            <td class="bg-main-50">
                                <span class="h6 mb-0 fw-semibold text-main-600">Tuesday</span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-success-50 text-success-600 py-8 px-16 rounded-pill fw-medium">English</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Gupta</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">Mathematics</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Sharma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-danger-50 text-danger-600 py-8 px-16 rounded-pill fw-medium">Hindi</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Patel</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-info-50 text-info-600 py-8 px-16 rounded-pill fw-medium">Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Dr. Verma</p>
                                </div>
                            </td>
                            <td class="bg-warning-50 text-center align-middle">
                                <span class="badge bg-warning-600 text-white py-12 px-20 fw-semibold">
                                    <i class="ph ph-fork-knife me-4"></i>
                                    Lunch
                                </span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-warning-50 text-warning-600 py-8 px-16 rounded-pill fw-medium">Social
                                        Studies</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Kumar</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span class="badge bg-pink-50 text-pink-600 py-8 px-16 rounded-pill fw-medium">Art &
                                        Craft</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Ms. Desai</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-purple-50 text-purple-600 py-8 px-16 rounded-pill fw-medium">Computer
                                        Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Singh</p>
                                </div>
                            </td>
                        </tr>

                        <!-- Wednesday -->
                        <tr>
                            <td class="bg-main-50">
                                <span class="h6 mb-0 fw-semibold text-main-600">Wednesday</span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">Mathematics</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Sharma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-info-50 text-info-600 py-8 px-16 rounded-pill fw-medium">Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Dr. Verma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-success-50 text-success-600 py-8 px-16 rounded-pill fw-medium">English</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Gupta</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-purple-50 text-purple-600 py-8 px-16 rounded-pill fw-medium">Computer
                                        Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Singh</p>
                                </div>
                            </td>
                            <td class="bg-warning-50 text-center align-middle">
                                <span class="badge bg-warning-600 text-white py-12 px-20 fw-semibold">
                                    <i class="ph ph-fork-knife me-4"></i>
                                    Lunch
                                </span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-danger-50 text-danger-600 py-8 px-16 rounded-pill fw-medium">Hindi</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Patel</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-warning-50 text-warning-600 py-8 px-16 rounded-pill fw-medium">Social
                                        Studies</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Kumar</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-teal-50 text-teal-600 py-8 px-16 rounded-pill fw-medium">Music</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Iyer</p>
                                </div>
                            </td>
                        </tr>

                        <!-- Thursday -->
                        <tr>
                            <td class="bg-main-50">
                                <span class="h6 mb-0 fw-semibold text-main-600">Thursday</span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-info-50 text-info-600 py-8 px-16 rounded-pill fw-medium">Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Dr. Verma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-danger-50 text-danger-600 py-8 px-16 rounded-pill fw-medium">Hindi</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Patel</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">Mathematics</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Sharma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-success-50 text-success-600 py-8 px-16 rounded-pill fw-medium">English</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Gupta</p>
                                </div>
                            </td>
                            <td class="bg-warning-50 text-center align-middle">
                                <span class="badge bg-warning-600 text-white py-12 px-20 fw-semibold">
                                    <i class="ph ph-fork-knife me-4"></i>
                                    Lunch
                                </span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill fw-medium">Physical
                                        Education</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Coach Reddy</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-warning-50 text-warning-600 py-8 px-16 rounded-pill fw-medium">Social
                                        Studies</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Kumar</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-purple-50 text-purple-600 py-8 px-16 rounded-pill fw-medium">Computer
                                        Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Singh</p>
                                </div>
                            </td>
                        </tr>

                        <!-- Friday -->
                        <tr>
                            <td class="bg-main-50">
                                <span class="h6 mb-0 fw-semibold text-main-600">Friday</span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-success-50 text-success-600 py-8 px-16 rounded-pill fw-medium">English</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Gupta</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">Mathematics</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Sharma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-warning-50 text-warning-600 py-8 px-16 rounded-pill fw-medium">Social
                                        Studies</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Kumar</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-info-50 text-info-600 py-8 px-16 rounded-pill fw-medium">Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Dr. Verma</p>
                                </div>
                            </td>
                            <td class="bg-warning-50 text-center align-middle">
                                <span class="badge bg-warning-600 text-white py-12 px-20 fw-semibold">
                                    <i class="ph ph-fork-knife me-4"></i>
                                    Lunch
                                </span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span class="badge bg-pink-50 text-pink-600 py-8 px-16 rounded-pill fw-medium">Art &
                                        Craft</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Ms. Desai</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-danger-50 text-danger-600 py-8 px-16 rounded-pill fw-medium">Hindi</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Patel</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill fw-medium">Library</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Librarian</p>
                                </div>
                            </td>
                        </tr>

                        <!-- Saturday -->
                        <tr>
                            <td class="bg-main-50">
                                <span class="h6 mb-0 fw-semibold text-main-600">Saturday</span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-primary-50 text-primary-600 py-8 px-16 rounded-pill fw-medium">Mathematics</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Sharma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-info-50 text-info-600 py-8 px-16 rounded-pill fw-medium">Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Dr. Verma</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-success-50 text-success-600 py-8 px-16 rounded-pill fw-medium">English</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Gupta</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-purple-50 text-purple-600 py-8 px-16 rounded-pill fw-medium">Computer
                                        Science</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mr. Singh</p>
                                </div>
                            </td>
                            <td class="bg-warning-50 text-center align-middle">
                                <span class="badge bg-warning-600 text-white py-12 px-20 fw-semibold">
                                    <i class="ph ph-fork-knife me-4"></i>
                                    Lunch
                                </span>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-teal-50 text-teal-600 py-8 px-16 rounded-pill fw-medium">Music</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Mrs. Iyer</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-main-50 text-main-600 py-8 px-16 rounded-pill fw-medium">Physical
                                        Education</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Coach Reddy</p>
                                </div>
                            </td>
                            <td>
                                <div class="text-center py-2">
                                    <span
                                        class="badge bg-indigo-50 text-indigo-600 py-8 px-16 rounded-pill fw-medium">Activity
                                        Hour</span>
                                    <p class="text-xs text-gray-400 mb-0 mt-1">Class Teacher</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="flex-between flex-wrap gap-8">
                <div class="text-gray-600">
                    <i class="ph ph-info me-4"></i>
                    <span class="text-sm">Class Teacher: <strong>Mrs. Mehra</strong> | Contact: +91 98765 43210</span>
                </div>
                <div class="text-gray-600 text-sm">
                    Last Updated: <strong>January 15, 2026</strong>
                </div>
            </div>
        </div>
    </div>
    <!-- Routine Table Section End -->

    <!-- Notes Section Start -->
    <div class="card mt-24">
        <div class="card-header">
            <h6 class="text-lg mb-0">Important Notes</h6>
        </div>
        <div class="card-body">
            <ul class="list-inside text-gray-600">
                <li class="mb-2">
                    <i class="ph ph-dot text-main-600 me-4"></i>
                    Students must arrive at least 10 minutes before the first period begins.
                </li>
                <li class="mb-2">
                    <i class="ph ph-dot text-main-600 me-4"></i>
                    Lunch break is from 11:00 AM to 11:30 AM for all classes.
                </li>
                <li class="mb-2">
                    <i class="ph ph-dot text-main-600 me-4"></i>
                    Physical Education requires appropriate sports attire.
                </li>
                <li class="mb-2">
                    <i class="ph ph-dot text-main-600 me-4"></i>
                    Computer Science classes are held in the computer lab (Room 204).
                </li>
                <li class="mb-0">
                    <i class="ph ph-dot text-main-600 me-4"></i>
                    Any changes to the routine will be notified at least 24 hours in advance.
                </li>
            </ul>
        </div>
    </div>
    <!-- Notes Section End -->
</div>