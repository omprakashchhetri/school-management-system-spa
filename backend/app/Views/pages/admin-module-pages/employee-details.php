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
                <a href="employees.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Employees</a>
            </li>
            <li>
                <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
            </li>
            <li>
                <span class="text-main-600 fw-normal text-15">Employee Details</span>
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
                  background-image: url('<?=base_url()?>assets/images/thumbs/setting-cover-img.png');
                "></div>
                    </div>
                </div>
            </div>

            <div class="setting-profile px-24">
                <div class="flex-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap mb-20 gap-24">
                        <img src="<?=base_url()?>assets/images/thumbs/setting-profile-img.jpg" alt=""
                            class="w-120 h-120 rounded-circle border border-white" />
                        <div>
                            <h4 class="mb-8">John Smith</h4>
                            <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i class="ph ph-briefcase"></i></span>
                                    <span class="text-gray-600 d-flex text-15">Mathematics Teacher</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i
                                            class="ph ph-identification-card"></i></span>
                                    <span class="text-gray-600 d-flex text-15">EMP-2024-001</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span class="text-gray-600 d-flex text-lg"><i
                                            class="ph ph-calendar-dots"></i></span>
                                    <span class="text-gray-600 d-flex text-15">Joined March 2024</span>
                                </div>
                                <div class="flex-align gap-6">
                                    <span
                                        class="badge badge-sm bg-success-50 text-success-600 d-flex text-15">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-align gap-8 my-15 align-items-end w-lg-auto w-xl-auto w-md-100 w-xs-100 w-sm-100">
                        <button class="btn btn-outline-main rounded-pill py-9">Edit Employee</button>
                    </div>
                </div>
                <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                            aria-selected="true">
                            Personal Details
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-professional-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-professional" type="button" role="tab"
                            aria-controls="pills-professional" aria-selected="false">
                            Professional Info
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-attendance-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-attendance" type="button" role="tab" aria-controls="pills-attendance"
                            aria-selected="false">
                            Attendance
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-subjects-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-subjects" type="button" role="tab" aria-controls="pills-subjects"
                            aria-selected="false">
                            Subject Allocation
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-classes-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-classes" type="button" role="tab" aria-controls="pills-classes"
                            aria-selected="false">
                            Class Teacher
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
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
                        Employee personal details and contact information
                    </p>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="fname" class="form-label mb-8 h6">First Name</label>
                                <input type="text" class="form-control py-11" id="fname" value="John"
                                    placeholder="Enter First Name" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="lname" class="form-label mb-8 h6">Last Name</label>
                                <input type="text" class="form-control py-11" id="lname" value="Smith"
                                    placeholder="Enter Last Name" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="email" class="form-label mb-8 h6">Email</label>
                                <input type="email" class="form-control py-11" id="email" value="john.smith@school.edu"
                                    placeholder="Enter Email" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                                <input type="tel" class="form-control py-11" id="phone" value="+1 234 567 8900"
                                    placeholder="Enter Phone Number" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="dob" class="form-label mb-8 h6">Date of Birth</label>
                                <input type="date" class="form-control py-11" id="dob" value="1985-06-15" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="gender" class="form-label mb-8 h6">Gender</label>
                                <select class="form-control form-select py-11" id="gender">
                                    <option value="male" selected>Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="address" class="form-label mb-8 h6">Address</label>
                                <textarea class="form-control py-11" id="address" rows="3"
                                    placeholder="Enter Address">123 Main Street, New York, NY 10001</textarea>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="emergency_contact" class="form-label mb-8 h6">Emergency Contact</label>
                                <input type="text" class="form-control py-11" id="emergency_contact" value="Jane Smith"
                                    placeholder="Enter Emergency Contact Name" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="emergency_phone" class="form-label mb-8 h6">Emergency Phone</label>
                                <input type="tel" class="form-control py-11" id="emergency_phone"
                                    value="+1 234 567 8901" placeholder="Enter Emergency Phone" />
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

        <!-- Professional Info Tab Start -->
        <div class="tab-pane fade" id="pills-professional" role="tabpanel" aria-labelledby="pills-professional-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <h4 class="mb-4">Professional Information</h4>
                    <p class="text-gray-600 text-15">
                        Employment details and qualifications
                    </p>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="row gy-4">
                            <div class="col-sm-6 col-xs-6">
                                <label for="emp_id" class="form-label mb-8 h6">Employee ID</label>
                                <input type="text" class="form-control py-11" id="emp_id" value="EMP-2024-001"
                                    readonly />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="designation" class="form-label mb-8 h6">Designation</label>
                                <select class="form-control form-select py-11" id="designation">
                                    <option value="teacher" selected>Teacher</option>
                                    <option value="senior_teacher">Senior Teacher</option>
                                    <option value="head_teacher">Head Teacher</option>
                                    <option value="principal">Principal</option>
                                    <option value="admin">Admin Staff</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="department" class="form-label mb-8 h6">Department</label>
                                <select class="form-control form-select py-11" id="department">
                                    <option value="mathematics" selected>Mathematics</option>
                                    <option value="science">Science</option>
                                    <option value="english">English</option>
                                    <option value="social_studies">Social Studies</option>
                                    <option value="arts">Arts</option>
                                    <option value="physical_education">Physical Education</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="join_date" class="form-label mb-8 h6">Joining Date</label>
                                <input type="date" class="form-control py-11" id="join_date" value="2024-03-15" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="salary" class="form-label mb-8 h6">Monthly Salary</label>
                                <input type="number" class="form-control py-11" id="salary" value="5000"
                                    placeholder="Enter Monthly Salary" />
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <label for="employment_type" class="form-label mb-8 h6">Employment Type</label>
                                <select class="form-control form-select py-11" id="employment_type">
                                    <option value="full_time" selected>Full Time</option>
                                    <option value="part_time">Part Time</option>
                                    <option value="contract">Contract</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="qualifications" class="form-label mb-8 h6">Qualifications</label>
                                <textarea class="form-control py-11" id="qualifications" rows="4"
                                    placeholder="Enter Qualifications">Master's in Mathematics, Bachelor of Education (B.Ed), Teaching License - State Certified</textarea>
                            </div>
                            <div class="col-12">
                                <label for="experience" class="form-label mb-8 h6">Experience</label>
                                <textarea class="form-control py-11" id="experience" rows="3"
                                    placeholder="Enter Previous Experience">8 years of teaching experience in secondary education, specialized in advanced mathematics and calculus</textarea>
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
        <!-- Professional Info Tab End -->

        <!-- Attendance Tab Start -->
        <div class="tab-pane fade" id="pills-attendance" role="tabpanel" aria-labelledby="pills-attendance-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Attendance Record</h4>
                            <p class="text-gray-600 text-15">
                                Employee attendance tracking and statistics
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
                                <span
                                    class="text-white bg-main-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
                                    <i class="ph ph-calendar-check"></i>
                                </span>
                                <div>
                                    <h4 class="mb-0">22</h4>
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
                                    <h4 class="mb-0">2</h4>
                                    <span class="fw-medium text-warning-600">Absent Days</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-6">
                            <div class="statistics-card p-xl-4 p-16 flex-align gap-10 rounded-8 bg-info-50">
                                <span
                                    class="text-white bg-info-600 w-36 h-36 rounded-circle flex-center text-xl flex-shrink-0">
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
                                    <h4 class="mb-0">92%</h4>
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
                                    <th class="h6 text-dark fw-bold">Check In</th>
                                    <th class="h6 text-dark fw-bold">Check Out</th>
                                    <th class="h6 text-dark fw-bold">Working Hours</th>
                                    <th class="h6 text-dark fw-bold">Status</th>
                                    <th class="h6 text-dark fw-bold">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-dark">Sep 18, 2024</td>
                                    <td class="text-dark">08:32 AM</td>
                                    <td class="text-dark">04:45 PM</td>
                                    <td class="text-dark">8h 13m</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                                    </td>
                                    <td class="text-muted">Completed project tasks</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 17, 2024</td>
                                    <td class="text-dark">09:05 AM</td>
                                    <td class="text-dark">04:20 PM</td>
                                    <td class="text-dark">7h 15m</td>
                                    <td><span
                                            class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">Late</span>
                                    </td>
                                    <td class="text-muted">Traffic congestion</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 16, 2024</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="text-dark">0h 00m</td>
                                    <td><span
                                            class="badge badge-sm text-danger-600 bg-danger-100 py-1 px-10 rounded-pill">Absent</span>
                                    </td>
                                    <td class="text-muted">Sick leave (doctor’s note)</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 15, 2024</td>
                                    <td class="text-dark">08:25 AM</td>
                                    <td class="text-dark">12:30 PM</td>
                                    <td class="text-dark">4h 05m</td>
                                    <td><span
                                            class="badge badge-sm text-info-600 bg-info-100 py-1 px-10 rounded-pill">Half
                                            Day</span>
                                    </td>
                                    <td class="text-muted">Left early for appointment</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 14, 2024</td>
                                    <td class="text-dark">08:40 AM</td>
                                    <td class="text-dark">05:10 PM</td>
                                    <td class="text-dark">8h 30m</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                                    </td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 13, 2024</td>
                                    <td class="text-dark">08:45 AM</td>
                                    <td class="text-dark">04:15 PM</td>
                                    <td class="text-dark">7h 30m</td>
                                    <td>
                                        <span
                                            class="badge badge-sm text-primary-600 bg-primary-100 py-1 px-10 rounded-pill">WFH</span>
                                    </td>
                                    <td class="text-muted">Worked remotely</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 12, 2024</td>
                                    <td class="text-dark">08:20 AM</td>
                                    <td class="text-dark">05:00 PM</td>
                                    <td class="text-dark">8h 40m</td>
                                    <td><span
                                            class="badge badge-sm text-success-600 bg-success-100 py-1 px-10 rounded-pill">Present</span>
                                    </td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Sep 11, 2024</td>
                                    <td class="text-dark">09:10 AM</td>
                                    <td class="text-dark">04:25 PM</td>
                                    <td class="text-dark">7h 15m</td>
                                    <td>
                                        <span
                                            class="badge badge-sm text-warning-600 bg-warning-100 py-1 px-10 rounded-pill">Late</span>
                                    </td>
                                    <td class="text-muted">Overslept</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Attendance Tab End -->

        <!-- Subject Allocation Tab Start -->
        <div class="tab-pane fade" id="pills-subjects" role="tabpanel" aria-labelledby="pills-subjects-tab"
            tabindex="0">
            <div class="card mt-24 shadow-sm">
                <div class="card-header border-bottom bg-light">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-2 text-dark">Subject Allocations</h4>
                            <p class="text-gray-600 text-15 mb-0">
                                Subjects and classes currently assigned to this teacher
                            </p>
                        </div>
                        <button class="btn btn-main rounded-pill py-8 px-16">
                            <i class="ph ph-plus me-8"></i>
                            Assign Subject
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4">

                        <!-- Mathematics -->
                        <div class="col-lg-4 col=md-6">
                            <div class="card border border-gray-100 shadow-sm h-100">
                                <div
                                    class="card-header border-bottom border-gray-100 bg-main-50 d-flex align-items-center py-10">
                                    <i class="ph ph-calculator text-main-600 me-8 fs-5"></i>
                                    <h6 class="mb-0 text-main-600">Mathematics - Grade 10</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Classes:</span>
                                                <span class="text-dark">10A, 10B, 10C</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Students:</span>
                                                <span class="badge-md badge bg-info-100 text-dark">75</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Weekly Hours:</span>
                                                <span class="badge-md badge bg-info-100 text-dark">15</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Room:</span>
                                                <span class="text-dark">Math Lab 1</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8 mt-16">
                                                <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-pencil-line me-6"></i> Edit
                                                </button>
                                                <button class="btn btn-outline-danger rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-trash me-6"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Mathematics -->
                        <div class="col-lg-4 col=md-6">
                            <div class="card border border-gray-100 shadow-sm h-100">
                                <div
                                    class="card-header border-bottom border-gray-100 bg-main-50 d-flex align-items-center py-10">
                                    <i class="ph ph-function text-main-600 me-8 fs-5"></i>
                                    <h6 class="mb-0 text-main-600">Advanced Mathematics - Grade 11</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Classes:</span>
                                                <span class="text-dark">11A, 11B</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Students:</span>
                                                <span class="badge-md badge bg-info-100 text-dark">50</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Weekly Hours:</span>
                                                <span class="badge-md badge bg-info-100 text-dark">10</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Room:</span>
                                                <span class="text-dark">Math Lab 2</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8 mt-16">
                                                <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-pencil-line me-6"></i> Edit
                                                </button>
                                                <button class="btn btn-outline-danger rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-trash me-6"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calculus -->
                        <div class="col-lg-4 col=md-6">
                            <div class="card border border-gray-100 shadow-sm h-100">
                                <div
                                    class="card-header border-bottom border-gray-100 bg-main-50 d-flex align-items-center py-10">
                                    <i class="ph ph-sigma text-main-600 me-8 fs-5"></i>
                                    <h6 class="mb-0 text-main-600">Calculus - Grade 12</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Classes:</span>
                                                <span class="text-dark">12A</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Students:</span>
                                                <span class="badge-md badge bg-info-100 text-dark">25</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Weekly Hours:</span>
                                                <span class="badge-md badge bg-info-100 text-dark">8</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-700 fw-medium">Room:</span>
                                                <span class="text-dark">Math Lab 2</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-end gap-8 mt-16">
                                                <button class="btn btn-outline-main rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-pencil-line me-6"></i> Edit
                                                </button>
                                                <button class="btn btn-outline-danger rounded-pill py-6 px-12 text-13">
                                                    <i class="ph ph-trash me-6"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- Subject Allocation Tab End -->

        <!-- Class Teacher Tab Start -->
        <div class="tab-pane fade" id="pills-classes" role="tabpanel" aria-labelledby="pills-classes-tab" tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Class Teacher Assignments</h4>
                            <p class="text-gray-600 text-15">
                                Classes where this teacher serves as the primary class teacher
                            </p>
                        </div>
                        <button class="btn btn-main rounded-pill py-9">
                            <i class="ph ph-plus me-8"></i>
                            Assign Class
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div class="card border border-main-300 bg-main-25">
                                <div class="card-header border-bottom border-main-200 bg-main-50">
                                    <div class="flex-between">
                                        <h6 class="mb-0 text-main-600">Class 10A - Primary Class Teacher</h6>
                                        <span
                                            class="text-success-600 bg-success-100 py-1 px-8 rounded-pill text-13">Active</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 text-sm fw-medium">Total Students:</span>
                                                <span class="text-gray-900 fw-semibold">28</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 text-sm fw-medium">Academic Year:</span>
                                                <span class="text-gray-900">2024-25</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 text-sm fw-medium">Room Number:</span>
                                                <span class="text-gray-900">Room 201</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="flex-align gap-6">
                                                <span class="text-gray-600 text-sm fw-medium">Assigned Since:</span>
                                                <span class="text-gray-900">March 2024</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="flex-align justify-content-between mt-16">
                                                <div class="flex-align gap-8">
                                                    <button
                                                        class="btn btn-outline-main rounded-pill py-6 px-12 text-13">View
                                                        Students</button>
                                                    <button
                                                        class="btn btn-outline-info rounded-pill py-6 px-12 text-13">Class
                                                        Details</button>
                                                </div>
                                                <button
                                                    class="btn btn-outline-danger rounded-pill py-6 px-12 text-13">Remove
                                                    Assignment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border border-gray-100">
                                <div class="card-header border-bottom border-gray-100">
                                    <div class="flex-between">
                                        <h6 class="mb-0">Class Responsibilities</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="flex-align gap-8 mb-12">
                                            <span class="text-main-600 d-flex"><i class="ph ph-check-circle"></i></span>
                                            <span class="text-gray-600">Monitor student attendance daily</span>
                                        </li>
                                        <li class="flex-align gap-8 mb-12">
                                            <span class="text-main-600 d-flex"><i class="ph ph-check-circle"></i></span>
                                            <span class="text-gray-600">Coordinate parent-teacher meetings</span>
                                        </li>
                                        <li class="flex-align gap-8 mb-12">
                                            <span class="text-main-600 d-flex"><i class="ph ph-check-circle"></i></span>
                                            <span class="text-gray-600">Maintain class discipline and order</span>
                                        </li>
                                        <li class="flex-align gap-8 mb-12">
                                            <span class="text-main-600 d-flex"><i class="ph ph-check-circle"></i></span>
                                            <span class="text-gray-600">Communicate with other subject teachers</span>
                                        </li>
                                        <li class="flex-align gap-8 mb-12">
                                            <span class="text-main-600 d-flex"><i class="ph ph-check-circle"></i></span>
                                            <span class="text-gray-600">Handle administrative tasks for the class</span>
                                        </li>
                                        <li class="flex-align gap-8 mb-12">
                                            <span class="text-main-600 d-flex"><i class="ph ph-check-circle"></i></span>
                                            <span class="text-gray-600">Organize class events and activities</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Class Teacher Tab End -->

        <!-- Documents Tab Start -->
        <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
            tabindex="0">
            <div class="card mt-24">
                <div class="card-header border-bottom">
                    <div class="flex-between flex-wrap gap-16">
                        <div>
                            <h4 class="mb-4">Employee Documents</h4>
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
                                        <span class="text-dark fw-semibold">ID Card Copy</span>
                                    </div>
                                </td>
                                <td class="text-dark">john_smith_id.pdf</td>
                                <td class="text-dark">March 15, 2024</td>
                                <td class="text-dark">2.3 MB</td>
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
                                        <span class="text-dark fw-semibold">Education Certificate</span>
                                    </div>
                                </td>
                                <td class="text-dark">masters_degree.pdf</td>
                                <td class="text-dark">March 15, 2024</td>
                                <td class="text-dark">4.1 MB</td>
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
                                                class="ph ph-certificate"></i></span>
                                        <span class="text-dark fw-semibold">Teaching License</span>
                                    </div>
                                </td>
                                <td class="text-dark">teaching_license.pdf</td>
                                <td class="text-dark">March 15, 2024</td>
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
                                        <span class="text-dark fw-semibold">Resume/CV</span>
                                    </div>
                                </td>
                                <td class="text-dark">john_smith_cv.pdf</td>
                                <td class="text-dark">March 15, 2024</td>
                                <td class="text-dark">856 KB</td>
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
                                <td class="text-dark">medical_clearance.pdf</td>
                                <td class="text-dark">March 15, 2024</td>
                                <td class="text-dark">1.2 MB</td>
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