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
            <li>
                <a href="students.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Students</a>
            </li>
            <li>
                <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
            </li>
            <li>
                <span class="text-main-600 fw-normal text-15">Student Details</span>
            </li>
        </ul>
    </div>
    <!-- Breadcrumb End -->

    <div class="card overflow-hidden">
        <div class="card-body p-0">
            <div class="cover-img position-relative">
                <label for="coverImageUpload"
                    class="btn border-gray-200 text-gray-200 fw-normal hover-bg-gray-400 rounded-pill py-4 px-14 position-absolute inset-block-start-0 inset-inline-end-0 mt-24 me-24">Edit
                    Cover</label>
                <div class="avatar-upload">
                    <input type="file" id="coverImageUpload" accept=".png, .jpg, .jpeg" />
                    <div class="avatar-preview">
                        <div id="coverImagePreview" style="
                  background-image: url('assets/images/thumbs/setting-cover-img.png');
                "></div>
                    </div>
                </div>
            </div>

            <div class="setting-profile px-24">
                <div class="flex-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap mb-20 gap-24">
                        <img src="assets/images/thumbs/student-profile-img.jpg" alt=""
                            class="w-120 h-120 rounded-circle border border-white" />
                        <div>
                            <h4 class="mb-8">Emily Johnson</h4>
                            <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-student"></i></span>
                                    <span class="text-gray-600 d-flex text-15">Grade 10A</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i
                                            class="ph ph-identification-card"></i></span>
                                    <span class="text-gray-600 d-flex text-15">STU-2024-156</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i
                                            class="ph ph-calendar-dots"></i></span>
                                    <span class="text-gray-600 d-flex text-15">Enrolled April 2024</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span
                                        class="badge badge-sm bg-success-50 text-success-600 d-flex text-15">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-align gap-8 my-15 align-items-end w-lg-auto w-xl-auto w-md-100 w-xs-100 w-sm-100">
                        <button class="btn btn-outline-main rounded-pill py-9">Edit Student</button>
                    </div>
                </div>
                <ul class="nav common-tab style-two nav-pills mb-0 flex-nowrap overflow-x-auto pb-5" id="pills-tab"
                    role="tablist">
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                            aria-selected="true">
                            Personal Details
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-fees-tab" data-bs-toggle="pill" data-bs-target="#pills-fees"
                            type="button" role="tab" aria-controls="pills-fees" aria-selected="false">
                            Fees History
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-attendance-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-attendance" type="button" role="tab" aria-controls="pills-attendance"
                            aria-selected="false">
                            Attendance
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-assignments-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-assignments" type="button" role="tab"
                            aria-controls="pills-assignments" aria-selected="false">
                            Assignments
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-marksheets-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-marksheets" type="button" role="tab" aria-controls="pills-marksheets"
                            aria-selected="false">
                            Marksheets
                        </button>
                    </li>
                    <li class="nav-item white-space-nowrap" role="presentation">
                        <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents"
                            aria-selected="false">
                            Documents
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <!-- Personal Details Tab start -->
        <div class="tab-pane fade show active" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Personal Information</h4>
                    <p class="text-gray-600 text-15">
                        Student personal details and contact information
                    </p>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">First Name</label>
                                <input type="text" class="form-control py-11" id="fname" value="Emily"
                                    placeholder="Enter First Name" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="lname" class="form-label mb-8 h6">Last Name</label>
                                <input type="text" class="form-control py-11" id="lname" value="Johnson"
                                    placeholder="Enter Last Name" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="email" class="form-control py-11" id="email"
                                    value="emily.johnson@student.edu" placeholder="Enter Email" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                                <input type="tel" class="form-control py-11" id="phone" value="+1 234 567 8902"
                                    placeholder="Enter Phone Number" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="dob" class="form-label mb-8 h6">Date of Birth</label>
                                <input type="date" class="form-control py-11" id="dob" value="2008-08-15" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="gender" class="form-label mb-8 h6">Gender</label>
                                <select class="form-control form-select py-11" id="gender">
                                    <option value="male">Male</option>
                                    <option value="female" selected>Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="class" class="form-label mb-8 h6">Class</label>
                                <select class="form-control form-select py-11" id="class">
                                    <option value="10a" selected>Grade 10A</option>
                                    <option value="10b">Grade 10B</option>
                                    <option value="10c">Grade 10C</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="roll_number" class="form-label mb-8 h6">Roll Number</label>
                                <input type="text" class="form-control py-11" id="roll_number" value="156"
                                    placeholder="Enter Roll Number" />
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label mb-8 h6">Address</label>
                                <textarea class="form-control py-11" id="address" rows="3"
                                    placeholder="Enter Address">456 Oak Avenue, Brooklyn, NY 11201</textarea>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="parent_name" class="form-label mb-8 h6">Parent/Guardian Name</label>
                                <input type="text" class="form-control py-11" id="parent_name" value="Robert Johnson"
                                    placeholder="Enter Parent Name" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="parent_phone" class="form-label mb-8 h6">Parent Phone</label>
                                <input type="tel" class="form-control py-11" id="parent_phone" value="+1 234 567 8903"
                                    placeholder="Enter Parent Phone" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="parent_email" class="form-label mb-8 h6">Parent Email</label>
                                <input type="email" class="form-control py-11" id="parent_email"
                                    value="robert.johnson@email.com" placeholder="Enter Parent Email" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="blood_group" class="form-label mb-8 h6">Blood Group</label>
                                <select class="form-control form-select py-11" id="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="a+" selected>A+</option>
                                    <option value="a-">A-</option>
                                    <option value="b+">B+</option>
                                    <option value="b-">B-</option>
                                    <option value="o+">O+</option>
                                    <option value="o-">O-</option>
                                    <option value="ab+">AB+</option>
                                    <option value="ab-">AB-</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset"
                                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Personal Details Tab End -->

        <!-- Fees History Tab Start -->
        <div class="tab-pane fade" id="pills-fees" role="tabpanel" aria-labelledby="pills-fees-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Fees History</h4>
                            <p class="text-gray-600 text-15">
                                Payment records and fee details
                            </p>
                        </div>
                        <div class="flex-align gap-8">
                            <select class="form-control form-select py-6">
                                <option>Academic Year 2024-25</option>
                                <option>Academic Year 2023-24</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4 mb-24">
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-main-50">
                                <span
                                    class="text-white bg-main-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-currency-dollar"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">$12,000</h4>
                                    <span class="fw-medium text-main-600">Total Fees</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-success-50">
                                <span
                                    class="text-white bg-success-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-check-circle"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">$9,000</h4>
                                    <span class="fw-medium text-success-600">Paid Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-warning-50">
                                <span
                                    class="text-white bg-warning-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-warning"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">$3,000</h4>
                                    <span class="fw-medium text-warning-600">Pending Amount</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-info-50">
                                <span
                                    class="text-white bg-info-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-calendar-blank"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">Dec 30</h4>
                                    <span class="fw-medium text-info-600">Next Due Date</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 overflow-x-auto">
                        <table class="table table-striped align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <td class="text-dark">Sep 14, 2024</td>
                                    <td class="text-dark">Saturday</td>
                                    <td><span
                                            class="badge badge-sm text-secondary-600 bg-secondary-100 py-1 px-10 rounded-pill">Holiday</span>
                                    </td>
                                    <td>-</td>
                                    <td class="text-muted">Weekend</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 13, 2024</td>
                                    <td class="text-dark">Friday</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                                    </td>
                                    <td class="text-dark">08:05 AM</td>
                                    <td class="text-muted">-</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 12, 2024</td>
                                    <td class="text-dark">Thursday</td>
                                    <td><span
                                            class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">Late</span>
                                    </td>
                                    <td class="text-dark">08:35 AM</td>
                                    <td class="text-muted">Arrived late due to traffic</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 11, 2024</td>
                                    <td class="text-dark">Wednesday</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                                    </td>
                                    <td class="text-dark">08:12 AM</td>
                                    <td class="text-muted">-</td>
                                </tr>
                                </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Attendance Tab End -->

        <!-- Assignments Tab Start -->
        <div class="tab-pane fade" id="pills-assignments" role="tabpanel" aria-labelledby="pills-assignments-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Assignments</h4>
                            <p class="text-gray-600 text-15">
                                Student assignments and submission status
                            </p>
                        </div>
                        <div class="flex-align gap-8">
                            <select class="form-control form-select py-6">
                                <option>All Subjects</option>
                                <option>Mathematics</option>
                                <option>Science</option>
                                <option>English</option>
                                <option>History</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4 mb-24">
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-main-50">
                                <span
                                    class="text-white bg-main-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-files"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">32</h4>
                                    <span class="fw-medium text-main-600">Total Assignments</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-success-50">
                                <span
                                    class="text-white bg-success-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-check-circle"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">28</h4>
                                    <span class="fw-medium text-success-600">Completed</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-warning-50">
                                <span
                                    class="text-white bg-warning-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-clock"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">3</h4>
                                    <span class="fw-medium text-warning-600">Pending</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-danger-50">
                                <span
                                    class="text-white bg-danger-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-warning"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">1</h4>
                                    <span class="fw-medium text-danger-600">Overdue</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0 overflow-x-auto">
                        <table class="table table-striped align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="h6 text-dark fw-bold">Subject</th>
                                    <th class="h6 text-dark fw-bold">Assignment Title</th>
                                    <th class="h6 text-dark fw-bold">Assigned Date</th>
                                    <th class="h6 text-dark fw-bold">Due Date</th>
                                    <th class="h6 text-dark fw-bold">Status</th>
                                    <th class="h6 text-dark fw-bold">Marks</th>
                                    <th class="h6 text-dark fw-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex-align gap-8">
                                            <span class="text-main-600 d-flex text-lg"><i
                                                    class="ph ph-calculator"></i></span>
                                            <span class="text-dark">Mathematics</span>
                                        </div>
                                    </td>
                                    <td class="text-dark">Quadratic Equations - Chapter 4</td>
                                    <td class="text-dark">Sep 10, 2024</td>
                                    <td class="text-dark">Sep 17, 2024</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Submitted</span>
                                    </td>
                                    <td class="text-dark">18/20</td>
                                    <td>
                                        <button class="btn btn-outline-info py-4 px-10 text-13">
                                            <i class="ph ph-eye me-6"></i>View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-align gap-8">
                                            <span class="text-success-600 d-flex text-lg"><i
                                                    class="ph ph-flask"></i></span>
                                            <span class="text-dark">Science</span>
                                        </div>
                                    </td>
                                    <td class="text-dark">Chemical Reactions Lab Report</td>
                                    <td class="text-dark">Sep 12, 2024</td>
                                    <td class="text-dark">Sep 20, 2024</td>
                                    <td><span
                                            class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">In
                                            Progress</span>
                                    </td>
                                    <td class="text-muted">-</td>
                                    <td>
                                        <button class="btn btn-main py-4 px-10 text-13">
                                            <i class="ph ph-upload me-6"></i>Submit
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-align gap-8">
                                            <span class="text-info-600 d-flex text-lg"><i
                                                    class="ph ph-book-open"></i></span>
                                            <span class="text-dark">English</span>
                                        </div>
                                    </td>
                                    <td class="text-dark">Essay on Climate Change</td>
                                    <td class="text-dark">Sep 08, 2024</td>
                                    <td class="text-dark">Sep 15, 2024</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Submitted</span>
                                    </td>
                                    <td class="text-dark">15/15</td>
                                    <td>
                                        <button class="btn btn-outline-info py-4 px-10 text-13">
                                            <i class="ph ph-eye me-6"></i>View
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-align gap-8">
                                            <span class="text-warning-600 d-flex text-lg"><i
                                                    class="ph ph-globe"></i></span>
                                            <span class="text-dark">History</span>
                                        </div>
                                    </td>
                                    <td class="text-dark">World War II Analysis</td>
                                    <td class="text-dark">Sep 05, 2024</td>
                                    <td class="text-dark">Sep 12, 2024</td>
                                    <td><span
                                            class="badge badge-sm text-danger-600 bg-danger-100 py-1 px-10 rounded-pill">Overdue</span>
                                    </td>
                                    <td class="text-muted">-</td>
                                    <td>
                                        <button class="btn btn-danger py-4 px-10 text-13">
                                            <i class="ph ph-upload me-6"></i>Submit Now
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-align gap-8">
                                            <span class="text-main-600 d-flex text-lg"><i
                                                    class="ph ph-calculator"></i></span>
                                            <span class="text-dark">Mathematics</span>
                                        </div>
                                    </td>
                                    <td class="text-dark">Trigonometry Practice Problems</td>
                                    <td class="text-dark">Sep 14, 2024</td>
                                    <td class="text-dark">Sep 21, 2024</td>
                                    <td><span
                                            class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">In
                                            Progress</span>
                                    </td>
                                    <td class="text-muted">-</td>
                                    <td>
                                        <button class="btn btn-main py-4 px-10 text-13">
                                            <i class="ph ph-upload me-6"></i>Submit
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex-align gap-8">
                                            <span class="text-success-600 d-flex text-lg"><i
                                                    class="ph ph-flask"></i></span>
                                            <span class="text-dark">Science</span>
                                        </div>
                                    </td>
                                    <td class="text-dark">Physics - Laws of Motion</td>
                                    <td class="text-dark">Sep 11, 2024</td>
                                    <td class="text-dark">Sep 18, 2024</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Submitted</span>
                                    </td>
                                    <td class="text-dark">19/20</td>
                                    <td>
                                        <button class="btn btn-outline-info py-4 px-10 text-13">
                                            <i class="ph ph-eye me-6"></i>View
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Assignments Tab End -->

        <!-- Marksheets Tab Start -->
        <div class="tab-pane fade" id="pills-marksheets" role="tabpanel" aria-labelledby="pills-marksheets-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Examination Results</h4>
                            <p class="text-gray-600 text-15">
                                Student marksheets and academic performance
                            </p>
                        </div>
                        <div class="flex-align gap-8">
                            <select class="form-control form-select py-6">
                                <option>Academic Year 2024-25</option>
                                <option>Academic Year 2023-24</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Term 1 Results -->
                    <div class="card border border-main-200 mb-24">
                        <div class="card-header border-bottom border-main-100 bg-main-50">
                            <div class="flex-between">
                                <h5 class="mb-0 text-main-600">Term 1 Examination - April 2024</h5>
                                <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                    <i class="ph ph-download me-6"></i>Download Marksheet
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 overflow-x-auto">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="h6 text-dark fw-bold">Subject</th>
                                        <th class="h6 text-dark fw-bold text-center">Total Marks</th>
                                        <th class="h6 text-dark fw-bold text-center">Marks Obtained</th>
                                        <th class="h6 text-dark fw-bold text-center">Grade</th>
                                        <th class="h6 text-dark fw-bold text-center">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark fw-semibold">Mathematics</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">85</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A</span>
                                        </td>
                                        <td class="text-center text-muted">Excellent</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">Science</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">78</td>
                                        <td class="text-center">
                                            <span class="badge bg-info-100 text-info-600 py-2 px-12">B+</span>
                                        </td>
                                        <td class="text-center text-muted">Very Good</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">English</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">82</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A</span>
                                        </td>
                                        <td class="text-center text-muted">Excellent</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">History</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">75</td>
                                        <td class="text-center">
                                            <span class="badge bg-info-100 text-info-600 py-2 px-12">B</span>
                                        </td>
                                        <td class="text-center text-muted">Good</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">Geography</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">80</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A</span>
                                        </td>
                                        <td class="text-center text-muted">Very Good</td>
                                    </tr>
                                    <tr class="bg-main-25">
                                        <td class="text-dark fw-bold">Total</td>
                                        <td class="text-center text-dark fw-bold">500</td>
                                        <td class="text-center text-dark fw-bold">400</td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-success-100 text-success-600 py-2 px-12 fw-bold">80%</span>
                                        </td>
                                        <td class="text-center text-dark fw-bold">First Division</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Term 2 Results -->
                    <div class="card border border-main-200">
                        <div class="card-header border-bottom border-main-100 bg-main-50">
                            <div class="flex-between">
                                <h5 class="mb-0 text-main-600">Term 2 Examination - August 2024</h5>
                                <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                    <i class="ph ph-download me-6"></i>Download Marksheet
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 overflow-x-auto">
                            <table class="table table-bordered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="h6 text-dark fw-bold">Subject</th>
                                        <th class="h6 text-dark fw-bold text-center">Total Marks</th>
                                        <th class="h6 text-dark fw-bold text-center">Marks Obtained</th>
                                        <th class="h6 text-dark fw-bold text-center">Grade</th>
                                        <th class="h6 text-dark fw-bold text-center">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-dark fw-semibold">Mathematics</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">88</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A+</span>
                                        </td>
                                        <td class="text-center text-muted">Outstanding</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">Science</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">82</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A</span>
                                        </td>
                                        <td class="text-center text-muted">Excellent</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">English</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">80</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A</span>
                                        </td>
                                        <td class="text-center text-muted">Excellent</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">History</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">78</td>
                                        <td class="text-center">
                                            <span class="badge bg-info-100 text-info-600 py-2 px-12">B+</span>
                                        </td>
                                        <td class="text-center text-muted">Very Good</td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-semibold">Geography</td>
                                        <td class="text-center text-dark">100</td>
                                        <td class="text-center text-dark">84</td>
                                        <td class="text-center">
                                            <span class="badge bg-success-100 text-success-600 py-2 px-12">A</span>
                                        </td>
                                        <td class="text-center text-muted">Excellent</td>
                                    </tr>
                                    <tr class="bg-main-25">
                                        <td class="text-dark fw-bold">Total</td>
                                        <td class="text-center text-dark fw-bold">500</td>
                                        <td class="text-center text-dark fw-bold">412</td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-success-100 text-success-600 py-2 px-12 fw-bold">82.4%</span>
                                        </td>
                                        <td class="text-center text-dark fw-bold">First Division</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Marksheets Tab End -->

        <!-- Documents Tab Start -->
        <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Student Documents</h4>
                            <p class="text-gray-600 text-15">
                                Important documents and certificates
                            </p>
                        </div>
                        <button class="btn btn-main rounded-pill py-9">
                            <i class="ph ph-upload me-8"></i>
                            Upload Document
                        </button>
                    </div>
                </div>
                <div class="card-body p-0 overflow-x-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="h6 text-gray-600">Document Type</th>
                                <th class="h6 text-gray-600">File Name</th>
                                <th class="h6 text-gray-600">Upload Date</th>
                                <th class="h6 text-gray-600">File Size</th>
                                <th class="h6 text-gray-600 text-center">Status</th>
                                <th class="h6 text-gray-600 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg"><i
                                                class="ph ph-identification-card"></i></span>
                                        <span class="text-dark fw-semibold">Birth Certificate</span>
                                    </div>
                                </td>
                                <td class="text-dark">emily_birth_certificate.pdf</td>
                                <td class="text-dark">April 10, 2024</td>
                                <td class="text-dark">1.8 MB</td>
                                <td class="text-center">
                                    <span
                                        class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Verified</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <button class="btn btn-outline-main py-6 px-12 text-13">View</button>
                                        <button class="btn btn-outline-info py-6 px-12 text-13">Download</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg"><i
                                                class="ph ph-file-text"></i></span>
                                        <span class="text-dark fw-semibold">Transfer Certificate</span>
                                    </div>
                                </td>
                                <td class="text-dark">tc_previous_school.pdf</td>
                                <td class="text-dark">April 10, 2024</td>
                                <td class="text-dark">956 KB</td>
                                <td class="text-center">
                                    <span
                                        class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Verified</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <button class="btn btn-outline-main py-6 px-12 text-13">View</button>
                                        <button class="btn btn-outline-info py-6 px-12 text-13">Download</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg"><i
                                                class="ph ph-graduation-cap"></i></span>
                                        <span class="text-dark fw-semibold">Grade 9 Marksheet</span>
                                    </div>
                                </td>
                                <td class="text-dark">grade9_marksheet.pdf</td>
                                <td class="text-dark">April 10, 2024</td>
                                <td class="text-dark">1.2 MB</td>
                                <td class="text-center">
                                    <span
                                        class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Verified</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <button class="btn btn-outline-main py-6 px-12 text-13">View</button>
                                        <button class="btn btn-outline-info py-6 px-12 text-13">Download</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg"><i
                                                class="ph ph-user-circle"></i></span>
                                        <span class="text-dark fw-semibold">Student Photo</span>
                                    </div>
                                </td>
                                <td class="text-dark">student_photo.jpg</td>
                                <td class="text-dark">April 10, 2024</td>
                                <td class="text-dark">245 KB</td>
                                <td class="text-center">
                                    <span
                                        class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Verified</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <button class="btn btn-outline-main py-6 px-12 text-13">View</button>
                                        <button class="btn btn-outline-info py-6 px-12 text-13">Download</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg"><i class="ph ph-heart"></i></span>
                                        <span class="text-dark fw-semibold">Medical Certificate</span>
                                    </div>
                                </td>
                                <td class="text-dark">medical_report.pdf</td>
                                <td class="text-dark">April 10, 2024</td>
                                <td class="text-dark">1.5 MB</td>
                                <td class="text-center">
                                    <span
                                        class="text-success-600 bg-success-100 py-2 px-10 rounded-pill">Verified</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <button class="btn btn-outline-main py-6 px-12 text-13">View</button>
                                        <button class="btn btn-outline-info py-6 px-12 text-13">Download</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="flex-align gap-10">
                                        <span class="text-main-600 d-flex text-lg"><i
                                                class="ph ph-house-line"></i></span>
                                        <span class="text-dark fw-semibold">Address Proof</span>
                                    </div>
                                </td>
                                <td class="text-dark">address_proof.pdf</td>
                                <td class="text-dark">April 10, 2024</td>
                                <td class="text-dark">2.1 MB</td>
                                <td class="text-center">
                                    <span class="text-warning-600 bg-warning-100 py-2 px-10 rounded-pill">Pending</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex-align justify-content-center gap-8">
                                        <button class="btn btn-outline-main py-6 px-12 text-13">View</button>
                                        <button class="btn btn-outline-info py-6 px-12 text-13">Download</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="flex-align justify-content-end gap-8">
                        <button type="reset"
                            class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-main rounded-pill py-9">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Documents Tab End -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Cover image preview
    $("#coverImageUpload").change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#coverImagePreview").css('background-image', 'url(' + e.target.result + ')');
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
<th class="h6 text-dark fw-bold">Fee Type</th>
<th class="h6 text-dark fw-bold">Amount</th>
<th class="h6 text-dark fw-bold">Due Date</th>
<th class="h6 text-dark fw-bold">Payment Date</th>
<th class="h6 text-dark fw-bold">Status</th>
<th class="h6 text-dark fw-bold">Receipt</th>
</tr>
</thead>
<tbody>
    <tr>
        <td class="text-dark">Tuition Fee - Term 1</td>
        <td class="text-dark">$3,000</td>
        <td class="text-dark">Apr 30, 2024</td>
        <td class="text-dark">Apr 25, 2024</td>
        <td><span class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
        </td>
        <td>
            <button class="btn btn-outline-info py-4 px-10 text-13">
                <i class="ph ph-download me-6"></i>Download
            </button>
        </td>
    </tr>
    <tr>
        <td class="text-dark">Tuition Fee - Term 2</td>
        <td class="text-dark">$3,000</td>
        <td class="text-dark">Aug 30, 2024</td>
        <td class="text-dark">Aug 28, 2024</td>
        <td><span class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
        </td>
        <td>
            <button class="btn btn-outline-info py-4 px-10 text-13">
                <i class="ph ph-download me-6"></i>Download
            </button>
        </td>
    </tr>
    <tr>
        <td class="text-dark">Tuition Fee - Term 3</td>
        <td class="text-dark">$3,000</td>
        <td class="text-dark">Dec 30, 2024</td>
        <td class="text-muted">-</td>
        <td><span class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">Pending</span>
        </td>
        <td>
            <button class="btn btn-main py-4 px-10 text-13">
                <i class="ph ph-credit-card me-6"></i>Pay Now
            </button>
        </td>
    </tr>
    <tr>
        <td class="text-dark">Library Fee</td>
        <td class="text-dark">$500</td>
        <td class="text-dark">Apr 30, 2024</td>
        <td class="text-dark">Apr 25, 2024</td>
        <td><span class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
        </td>
        <td>
            <button class="btn btn-outline-info py-4 px-10 text-13">
                <i class="ph ph-download me-6"></i>Download
            </button>
        </td>
    </tr>
    <tr>
        <td class="text-dark">Lab Fee</td>
        <td class="text-dark">$800</td>
        <td class="text-dark">Apr 30, 2024</td>
        <td class="text-dark">Apr 25, 2024</td>
        <td><span class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
        </td>
        <td>
            <button class="btn btn-outline-info py-4 px-10 text-13">
                <i class="ph ph-download me-6"></i>Download
            </button>
        </td>
    </tr>
    <tr>
        <td class="text-dark">Sports Fee</td>
        <td class="text-dark">$400</td>
        <td class="text-dark">Apr 30, 2024</td>
        <td class="text-dark">Apr 25, 2024</td>
        <td><span class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
        </td>
        <td>
            <button class="btn btn-outline-info py-4 px-10 text-13">
                <i class="ph ph-download me-6"></i>Download
            </button>
        </td>
    </tr>
    <tr>
        <td class="text-dark">Activity Fee</td>
        <td class="text-dark">$300</td>
        <td class="text-dark">Apr 30, 2024</td>
        <td class="text-dark">Apr 25, 2024</td>
        <td><span class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
        </td>
        <td>
            <button class="btn btn-outline-info py-4 px-10 text-13">
                <i class="ph ph-download me-6"></i>Download
            </button>
        </td>
    </tr>
</tbody>
</table>
</div>

</div>
</div>
</div>
<!-- Fees History Tab End -->

<!-- Attendance Tab Start -->
<div class="tab-pane fade" id="pills-attendance" role="tabpanel" aria-labelledby="pills-attendance-tab" tabindex="0">
    <div class="card mt-24">
        <div class="card-header border-bottom">
            <div class="flex-between flex-wrap gap-16">
                <div>
                    <h4 class="mb-4">Attendance Record</h4>
                    <p class="text-gray-600 text-15">
                        Student attendance tracking and statistics
                    </p>
                </div>
                <div class="flex-align gap-8">
                    <select class="form-control form-select py-6">
                        <option>This Month</option>
                        <option>Last Month</option>
                        <option>Last 3 Months</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row gy-4 mb-24">
                <div class="col-xxl-3 col-sm-6">
                    <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-main-50">
                        <span class="text-white bg-main-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                            <i class="ph ph-calendar-check"></i>
                        </span>
                        <div>
                            <h4 class="mb-0">20</h4>
                            <span class="fw-medium text-main-600">Present Days</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-warning-50">
                        <span
                            class="text-white bg-warning-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                            <i class="ph ph-calendar-x"></i>
                        </span>
                        <div>
                            <h4 class="mb-0">3</h4>
                            <span class="fw-medium text-warning-600">Absent Days</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-info-50">
                        <span class="text-white bg-info-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                            <i class="ph ph-clock"></i>
                        </span>
                        <div>
                            <h4 class="mb-0">1</h4>
                            <span class="fw-medium text-info-600">Late Arrivals</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-success-50">
                        <span
                            class="text-white bg-success-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                            <i class="ph ph-percent"></i>
                        </span>
                        <div>
                            <h4 class="mb-0">87%</h4>
                            <span class="fw-medium text-success-600">Attendance Rate</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="h6 text-dark fw-bold">Date</th>
                            <th class="h6 text-dark fw-bold">Day</th>
                            <th class="h6 text-dark fw-bold">Status</th>
                            <th class="h6 text-dark fw-bold">Check In Time</th>
                            <th class="h6 text-dark fw-bold">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-dark">Sep 18, 2024</td>
                            <td class="text-dark">Wednesday</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                            </td>
                            <td class="text-dark">08:15 AM</td>
                            <td class="text-muted">-</td>
                        </tr>
                        <tr>
                            <td class="text-dark">Sep 17, 2024</td>
                            <td class="text-dark">Tuesday</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                            </td>
                            <td class="text-dark">08:10 AM</td>
                            <td class="text-muted">-</td>
                        </tr>
                        <tr>
                            <td class="text-dark">Sep 16, 2024</td>
                            <td class="text-dark">Monday</td>
                            <td><span
                                    class="badge badge-sm text-danger-600 bg-danger-100 py-1 px-10 rounded-pill">Absent</span>
                            </td>
                            <td>-</td>
                            <td class="text-muted">Sick leave (parent informed)</td>
                        </tr>
                        <tr>
                            <td class="text-dark">Sep 15, 2024</td>
                            <td class="text-dark">Sunday</td>
                            <td><span
                                    class="badge badge-sm text-secondary-600 bg-secondary-100 py-1 px-10 rounded-pill">Holiday</span>
                            </td>
                            <td>-</td>
                            <td class="text-muted">Weekend</td>
                        </tr>
                        <tr>
                            <th class="h6 text-dark fw-bold">Fee Type</th>
                            <th class="h6 text-dark fw-bold">Amount</th>
                            <th class="h6 text-dark fw-bold">Due Date</th>
                            <th class="h6 text-dark fw-bold">Payment Date</th>
                            <th class="h6 text-dark fw-bold">Status</th>
                            <th class="h6 text-dark fw-bold">Receipt</th>
                        </tr>
                        </thead>
                    <tbody>
                        <tr>
                            <td class="text-dark">Tuition Fee - Term 1</td>
                            <td class="text-dark">$3,000</td>
                            <td class="text-dark">Apr 30, 2024</td>
                            <td class="text-dark">Apr 25, 2024</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info py-4 px-10 text-13">
                                    <i class="ph ph-download me-6"></i>Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark">Tuition Fee - Term 2</td>
                            <td class="text-dark">$3,000</td>
                            <td class="text-dark">Aug 30, 2024</td>
                            <td class="text-dark">Aug 28, 2024</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info py-4 px-10 text-13">
                                    <i class="ph ph-download me-6"></i>Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark">Tuition Fee - Term 3</td>
                            <td class="text-dark">$3,000</td>
                            <td class="text-dark">Dec 30, 2024</td>
                            <td class="text-muted">-</td>
                            <td><span
                                    class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">Pending</span>
                            </td>
                            <td>
                                <button class="btn btn-main py-4 px-10 text-13">
                                    <i class="ph ph-credit-card me-6"></i>Pay Now
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark">Library Fee</td>
                            <td class="text-dark">$500</td>
                            <td class="text-dark">Apr 30, 2024</td>
                            <td class="text-dark">Apr 25, 2024</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info py-4 px-10 text-13">
                                    <i class="ph ph-download me-6"></i>Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark">Lab Fee</td>
                            <td class="text-dark">$800</td>
                            <td class="text-dark">Apr 30, 2024</td>
                            <td class="text-dark">Apr 25, 2024</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info py-4 px-10 text-13">
                                    <i class="ph ph-download me-6"></i>Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark">Sports Fee</td>
                            <td class="text-dark">$400</td>
                            <td class="text-dark">Apr 30, 2024</td>
                            <td class="text-dark">Apr 25, 2024</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info py-4 px-10 text-13">
                                    <i class="ph ph-download me-6"></i>Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark">Activity Fee</td>
                            <td class="text-dark">$300</td>
                            <td class="text-dark">Apr 30, 2024</td>
                            <td class="text-dark">Apr 25, 2024</td>
                            <td><span
                                    class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Paid</span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info py-4 px-10 text-13">
                                    <i class="ph ph-download me-6"></i>Download
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Fees History Tab End -->