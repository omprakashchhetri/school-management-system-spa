<div class="dashboard-body">

    <!-- Breadcrumb + Action Button -->
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">

        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex">
                        <i class="ph ph-caret-right"></i>
                    </span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Attendance</span>
                </li>
            </ul>
        </div>

        <a href="mark-attendance"
            class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2">
            <i class="ph ph-plus me-4"></i>
            Mark Attendance
        </a>

    </div>

    <!-- Filter Section -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Select Class</label>
                    <select id="classFilter" class="form-select">
                        <option value="">All Classes</option>
                        <option value="1">Class 1</option>
                        <option value="2">Class 2</option>
                        <option value="3">Class 3</option>
                        <option value="4">Class 4</option>
                        <option value="5">Class 5</option>
                        <option value="6">Class 6</option>
                        <option value="7">Class 7</option>
                        <option value="8">Class 8</option>
                        <option value="9">Class 9</option>
                        <option value="10">Class 10</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Select Section</label>
                    <select id="sectionFilter" class="form-select">
                        <option value="">All Sections</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Select Date</label>
                    <input type="date" id="dateFilter" class="form-control py-8 rounded" value="">
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" id="filterBtn" class="btn btn-primary w-100 py-9 rounded">
                        <i class="ph ph-funnel me-2"></i>
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card overflow-hidden">
        <div class="card-body p-0">

            <table id="attendanceTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                    id="selectAll" />
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Roll No</th>
                        <th class="h6 text-gray-300">Student Name</th>
                        <th class="h6 text-gray-300">Class</th>
                        <th class="h6 text-gray-300">Section</th>
                        <th class="h6 text-gray-300">Date</th>
                        <th class="h6 text-gray-300">Status</th>
                        <th class="h6 text-gray-300">Time In</th>
                        <th class="h6 text-gray-300">Time Out</th>
                        <th class="h6 text-gray-300">Remarks</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody id="attendanceTableBody">
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="1" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">001</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">John Smith</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 5</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section A</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-success">Present</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">08:30</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:00</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(1)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(1)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="2" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">002</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Emma Johnson</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 5</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section A</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-success">Present</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">08:25</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:05</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(2)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(2)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="3" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">003</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Michael Brown</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 5</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section A</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-warning text-dark">Late</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">09:15</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:00</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Late due to traffic</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(3)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(3)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="4" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">004</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Sarah Davis</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 5</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section A</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-danger">Absent</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Sick leave</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(4)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(4)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="5" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">005</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">David Wilson</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 6</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section B</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-success">Present</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">08:20</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:10</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(5)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(5)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="6" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">006</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Lisa Anderson</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 6</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section B</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-info">Excused</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">10:00</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:00</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Doctor appointment</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(6)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(6)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="7" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">007</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">James Martinez</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 7</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section C</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-success">Present</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">08:35</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">13:55</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(7)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(7)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="8" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">008</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Sophia Garcia</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 7</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section C</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-warning text-dark">Late</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">09:30</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:05</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Bus delay</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(8)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(8)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="9" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">009</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">William Taylor</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 8</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section A</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-success">Present</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">08:15</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">14:15</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(9)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(9)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" value="10" />
                            </div>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">010</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Olivia Thomas</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Class 8</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Section A</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Jan 13, 2026</span></td>
                        <td>
                            <span class="badge bg-danger">Absent</span>
                        </td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">-</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Family emergency</span></td>
                        <td>
                            <button
                                class="bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="editAttendance(10)">
                                <i class="ph ph-pencil-simple"></i>
                                Edit
                            </button>
                            <button
                                class="delete-class-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5"
                                onclick="deleteAttendance(10)">
                                <i class="ph ph-trash"></i>
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Mark Attendance Modal -->
    <div class="modal fade" id="markAttendanceModal" tabindex="-1" aria-labelledby="markAttendanceLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header">
                    <h5 class="modal-title" id="markAttendanceLabel">Mark Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- Class -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Class</label>
                            <select id="modal_class" class="form-select">
                                <option value="">Select Class</option>
                                <option value="1">Class 1</option>
                                <option value="2">Class 2</option>
                                <option value="3">Class 3</option>
                                <option value="4">Class 4</option>
                                <option value="5">Class 5</option>
                            </select>
                        </div>

                        <!-- Section -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Section</label>
                            <select id="modal_section" class="form-select">
                                <option value="">Select Section</option>
                                <option value="A">Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" id="modal_date" class="form-control">
                        </div>

                        <!-- Student -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Student</label>
                            <select id="modal_student" class="form-select">
                                <option value="">Select Student</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Status</label>
                            <select id="modal_status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                                <option value="excused">Excused</option>
                            </select>
                        </div>

                        <!-- Time In -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Time In</label>
                            <input type="time" id="modal_time_in" class="form-control">
                        </div>

                        <!-- Time Out -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Time Out</label>
                            <input type="time" id="modal_time_out" class="form-control">
                        </div>

                        <!-- Remarks -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea id="modal_remarks" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" id="saveAttendanceBtn" class="btn btn-primary px-4">
                                Save
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Attendance Modal -->
    <div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="editAttendanceLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-top">
            <div class="modal-content radius-16 bg-base">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAttendanceLabel">Edit Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" id="edit_attendance_id">

                        <!-- Status -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Status</label>
                            <select id="edit_status" class="form-select">
                                <option value="">Select Status</option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                                <option value="excused">Excused</option>
                            </select>
                        </div>

                        <!-- Time In -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Time In</label>
                            <input type="time" id="edit_time_in" class="form-control">
                        </div>

                        <!-- Time Out -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Time Out</label>
                            <input type="time" id="edit_time_out" class="form-control">
                        </div>

                        <!-- Remarks -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea id="edit_remarks" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" id="updateAttendanceBtn" class="btn btn-primary px-4">
                                Update
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Page Script -->
<script>
// const baseUrl = jQuery("#globalBaseUrl").val();

function attendanceTableInit() {

    // Prevent reinitialization issues
    if ($.fn.DataTable.isDataTable('#attendanceTable')) {
        $('#attendanceTable').DataTable().destroy();
    }

    // $('#attendanceTable').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     pageLength: 10,
    //     lengthMenu: [10, 25, 50, 100],
    //     ajax: {
    //         url: baseUrl + "post-login-employee/attendance/get-attendance-list",
    //         type: "POST",
    //         data: function(d) {
    //             d.class_filter = $('#classFilter').val();
    //             d.section_filter = $('#sectionFilter').val();
    //             d.date_filter = $('#dateFilter').val();
    //         }
    //     },
    //     columns: [{
    //             data: "checkbox",
    //             orderable: false,
    //             searchable: false
    //         },
    //         {
    //             data: "roll_no"
    //         },
    //         {
    //             data: "student_name"
    //         },
    //         {
    //             data: "class"
    //         },
    //         {
    //             data: "section"
    //         },
    //         {
    //             data: "date"
    //         },
    //         {
    //             data: "status"
    //         },
    //         {
    //             data: "time_in"
    //         },
    //         {
    //             data: "time_out"
    //         },
    //         {
    //             data: "remarks"
    //         },
    //         {
    //             data: "actions",
    //             orderable: false,
    //             searchable: false
    //         }
    //     ],
    //     order: [
    //         [5, "desc"]
    //     ]
    // });
    $('#attendanceTable').DataTable();
}

// Initialize DataTable on page load
$(document).ready(function() {
    // Set today's date
    const today = new Date().toISOString().split('T')[0];
    $('#dateFilter').val(today);
    $('#modal_date').val(today);

    attendanceTableInit();

    // Filter button - reload table with filters
    $('#filterBtn').on('click', function() {
        $('#attendanceTable').DataTable().ajax.reload();
    });

    // Select all checkbox
    $('#selectAll').on('change', function() {
        $('#attendanceTable tbody input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });

    // Save attendance button
    $('#saveAttendanceBtn').on('click', function() {
        saveAttendance();
    });

    // Update attendance button
    $('#updateAttendanceBtn').on('click', function() {
        updateAttendance();
    });

    // Load students when class/section changes
    $('#modal_class, #modal_section').on('change', function() {
        loadStudents();
    });
});

function loadStudents() {
    const classVal = $('#modal_class').val();
    const sectionVal = $('#modal_section').val();

    if (classVal && sectionVal) {
        $.ajax({
            url: baseUrl + "post-login-employee/attendance/get-students",
            type: "POST",
            data: {
                class_id: classVal,
                section_id: sectionVal
            },
            success: function(response) {
                const select = $('#modal_student');
                select.html('<option value="">Select Student</option>');

                if (response.success && response.data) {
                    $.each(response.data, function(index, student) {
                        select.append(
                            `<option value="${student.id}">${student.roll_no} - ${student.name}</option>`
                        );
                    });
                }
            }
        });
    }
}

function saveAttendance() {
    const formData = {
        class_id: $('#modal_class').val(),
        section_id: $('#modal_section').val(),
        date: $('#modal_date').val(),
        student_id: $('#modal_student').val(),
        status: $('#modal_status').val(),
        time_in: $('#modal_time_in').val(),
        time_out: $('#modal_time_out').val(),
        remarks: $('#modal_remarks').val()
    };

    if (!formData.class_id || !formData.section_id || !formData.date || !formData.student_id || !formData.status) {
        alert('Please fill all required fields');
        return;
    }

    $.ajax({
        url: baseUrl + "post-login-employee/attendance/save-attendance",
        type: "POST",
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#markAttendanceModal').modal('hide');
                $('#modal_class').val('');
                $('#modal_section').val('');
                $('#modal_student').val('');
                $('#modal_status').val('');
                $('#modal_time_in').val('');
                $('#modal_time_out').val('');
                $('#modal_remarks').val('');

                $('#attendanceTable').DataTable().ajax.reload();
                alert('Attendance marked successfully!');
            } else {
                alert(response.message || 'Error saving attendance');
            }
        },
        error: function() {
            alert('Error saving attendance');
        }
    });
}

function editAttendance(id) {
    $.ajax({
        url: baseUrl + "post-login-employee/attendance/get-attendance",
        type: "POST",
        data: {
            id: id
        },
        success: function(response) {
            if (response.success && response.data) {
                const record = response.data;
                $('#edit_attendance_id').val(record.id);
                $('#edit_status').val(record.status);
                $('#edit_time_in').val(record.time_in);
                $('#edit_time_out').val(record.time_out);
                $('#edit_remarks').val(record.remarks);

                $('#editAttendanceModal').modal('show');
            }
        }
    });
}

function updateAttendance() {
    const formData = {
        id: $('#edit_attendance_id').val(),
        status: $('#edit_status').val(),
        time_in: $('#edit_time_in').val(),
        time_out: $('#edit_time_out').val(),
        remarks: $('#edit_remarks').val()
    };

    $.ajax({
        url: baseUrl + "post-login-employee/attendance/update-attendance",
        type: "POST",
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#editAttendanceModal').modal('hide');
                $('#attendanceTable').DataTable().ajax.reload();
                alert('Attendance updated successfully!');
            } else {
                alert(response.message || 'Error updating attendance');
            }
        },
        error: function() {
            alert('Error updating attendance');
        }
    });
}

function deleteAttendance(id) {
    if (confirm('Are you sure you want to delete this attendance record?')) {
        $.ajax({
            url: baseUrl + "post-login-employee/attendance/delete-attendance",
            type: "POST",
            data: {
                id: id
            },
            success: function(response) {
                if (response.success) {
                    $('#attendanceTable').DataTable().ajax.reload();
                    alert('Attendance deleted successfully!');
                } else {
                    alert(response.message || 'Error deleting attendance');
                }
            },
            error: function() {
                alert('Error deleting attendance');
            }
        });
    }
}
</script>