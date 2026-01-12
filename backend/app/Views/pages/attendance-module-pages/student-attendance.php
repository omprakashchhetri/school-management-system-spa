<div class="dashboard-body">

    <!-- Breadcrumb -->
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
                    <span class="text-main-600 fw-normal text-15">Mark Attendance</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Select Class</label>
                    <select id="classSelect" class="form-select">
                        <option value="">Select Class</option>
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
                <div class="col-md-4">
                    <label class="form-label">Select Section</label>
                    <select id="sectionSelect" class="form-select">
                        <option value="">Select Section</option>
                        <option value="A">Section A</option>
                        <option value="B">Section B</option>
                        <option value="C">Section C</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Select Date</label>
                    <input type="date" id="dateSelect" class="form-control py-8 rounded" value="">
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Table Card -->
    <div class="card overflow-hidden">
        <div class="card-header">
            <h5 class="mb-0">Student Attendance</h5>
        </div>
        <div class="card-body p-0 px-10 pb-10">
            <table class="table style-two table-border mb-0">
                <thead>
                    <tr>
                        <th class="h6 text-gray-300">Roll No</th>
                        <th class="h6 text-gray-300">Student Name</th>
                        <th class="h6 text-gray-300 text-center">
                            <div class="form-check d-inline-flex align-items-center justify-content-center w-100">
                                <input class="form-check-input border-gray-200 rounded-4 " type="checkbox"
                                    id="selectAllAttendance" />
                                <label class="form-check-label ms-2 w-auto" for="selectAllAttendance">
                                    Present
                                </label>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="attendanceTableBody">
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">001</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">John Smith</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="1" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">002</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Emma Johnson</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="2" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">003</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Michael Brown</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="3" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">004</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Sarah Davis</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="4" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">005</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">David Wilson</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="5" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">006</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Lisa Anderson</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="6" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">007</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">James Martinez</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="7" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">008</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Sophia Garcia</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="8" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">009</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">William Taylor</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="9" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">010</span></td>
                        <td><span class="h6 mb-0 fw-medium text-gray-300">Olivia Thomas</span></td>
                        <td class="text-center">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                    type="checkbox" value="10" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end py-10">
            <button type="button" id="saveAttendanceBtn"
                class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2 ms-auto">
                <i class="ph ph-floppy-disk me-4"></i>
                Save Attendance
            </button>
        </div>
    </div>

</div>

<!-- Page Script -->
<script>
$(document).ready(function() {
    // Set today's date
    const today = new Date().toISOString().split('T')[0];
    $('#dateSelect').val(today);

    // Select all checkbox functionality
    $('#selectAllAttendance').on('change', function() {
        $('.attendance-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Individual checkbox change
    $('.attendance-checkbox').on('change', function() {
        const total = $('.attendance-checkbox').length;
        const checked = $('.attendance-checkbox:checked').length;
        $('#selectAllAttendance').prop('checked', total === checked);
    });

    // Save attendance button
    $('#saveAttendanceBtn').on('click', function() {
        const classVal = $('#classSelect').val();
        const sectionVal = $('#sectionSelect').val();
        const dateVal = $('#dateSelect').val();

        if (!classVal || !sectionVal || !dateVal) {
            alert('Please select class, section and date');
            return;
        }

        const attendanceData = [];
        $('.attendance-checkbox').each(function() {
            attendanceData.push({
                student_id: $(this).val(),
                status: $(this).is(':checked') ? 'present' : 'absent'
            });
        });

        // AJAX call to save attendance
        $.ajax({
            url: $('#globalBaseUrl').val() +
                'post-login-employee/attendance/save-bulk-attendance',
            type: 'POST',
            data: {
                class_id: classVal,
                section_id: sectionVal,
                date: dateVal,
                attendance: JSON.stringify(attendanceData)
            },
            success: function(response) {
                if (response.success) {
                    alert('Attendance saved successfully!');
                } else {
                    alert(response.message || 'Error saving attendance');
                }
            },
            error: function() {
                alert('Error saving attendance');
            }
        });
    });
});
</script>