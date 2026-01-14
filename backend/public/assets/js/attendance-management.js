$(document).ready(function () {

    const baseUrl = $('#globalBaseUrl').val();

    // Set today's date
    const today = new Date().toISOString().split('T')[0];
    $('#dateSelect').val(today);

    /* -----------------------------------------
       Fetch students + attendance
    ----------------------------------------- */
    function fetchAttendanceStudents() {

        const classId = $('#classSelect').val();
        const sectionId = $('#sectionSelect').val();
        const dateVal = $('#dateSelect').val();

        if (!classId || !sectionId || !dateVal) {
            resetAttendanceTable();
            return;
        }

        $.ajax({
            url: baseUrl + 'post-login-employee/attendance/get-attendance-list',
            type: 'POST',
            dataType: 'json',
            data: {
                class_id: classId,
                section_id: sectionId,
                date: dateVal
            },
            success: function (res) {

                if (res.attendance_taken && res.attendance_meta) {
                    $('#attendanceTakenAt').text(res.attendance_meta.taken_at);
                    $('#attendanceTakenBy').text(res.attendance_meta.taken_by);
                    $('#attendanceMeta').removeClass('d-none');
                } else {
                    console.log("Test");
                    $('#attendanceMeta').addClass('d-none');
                }

                if (!res || !Array.isArray(res.students)) {
                    showMessage('Invalid response from server');
                    return;
                }

                if (res.students.length === 0) {
                    showMessage('No students found');
                    return;
                }

                renderAttendanceTable(
                    res.students,
                    res.absentees || [],
                    res.attendance_taken === true
                );
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Error fetching attendance data');
            }
        });
    }

    /* -----------------------------------------
       Render table (attendance-aware)
    ----------------------------------------- */
    function renderAttendanceTable(students, absentees, attendanceTaken) {

        let html = '';
        const absentSet = new Set(absentees.map(id => String(id)));

        students.forEach(function (student) {

            const studentId = String(student.id);
            let checked = '';

            // 🔑 CORE CHANGE
            if (attendanceTaken) {
                checked = absentSet.has(studentId) ? '' : 'checked';
            } else {
                checked = ''; // attendance not taken → nobody present by default
            }

            html += `
                <tr>
                    <td>
                        <span class="h6 mb-0 fw-medium text-gray-300">
                            ${student.roll_no ?? '-'}
                        </span>
                    </td>
                    <td>
                        <span class="h6 mb-0 fw-medium text-gray-300">
                            ${student.name}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="form-check d-inline-block">
                            <input
                                class="form-check-input border-gray-200 rounded-4 attendance-checkbox"
                                type="checkbox"
                                value="${studentId}"
                                ${checked}
                            />
                        </div>
                    </td>
                </tr>
            `;
        });

        $('#attendanceTableBody').html(html);
        updateSelectAllCheckbox();
    }

    /* -----------------------------------------
       Save Attendance (Absentees only)
       Works for BOTH create & edit
    ----------------------------------------- */
    $(document).on('click', '#saveAttendanceBtn', function () {

        const classId = $('#classSelect').val();
        const sectionId = $('#sectionSelect').val();
        const dateVal = $('#dateSelect').val();
        const authToken = getAuthToken();

        if (!classId || !sectionId || !dateVal) {
            alert('Please select class, section and date');
            return;
        }

        if (!authToken) {
            alert('Authentication token missing. Please login again.');
            return;
        }

        const absentees = [];
        $('.attendance-checkbox').each(function () {
            if (!$(this).is(':checked')) {
                absentees.push($(this).val());
            }
        });

        $.ajax({
            url: $('#globalBaseUrl').val() +
                'post-login-employee/attendance/edit-attendance',
            type: 'POST',
            dataType: 'json',
            data: {
                class_id: classId,
                section_id: sectionId,
                date: dateVal,
                absentees: absentees,
                auth_token: authToken
            },
            success: function (res) {

                if (res.error) {
                    alert(res.error);
                    return;
                }

                alert('Attendance saved successfully');
                fetchAttendanceStudents();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Error saving attendance');
            }
        });
    });


    /* -----------------------------------------
       Helpers
    ----------------------------------------- */
    function resetAttendanceTable() {
        $('#attendanceTableBody').empty();
        $('#selectAllAttendance').prop('checked', false);
    }

    function showMessage(msg) {
        $('#attendanceTableBody').html(
            `<tr><td colspan="3" class="text-center text-muted">${msg}</td></tr>`
        );
        $('#selectAllAttendance').prop('checked', false);
    }

    function updateSelectAllCheckbox() {
        const total = $('.attendance-checkbox').length;
        const checked = $('.attendance-checkbox:checked').length;
        $('#selectAllAttendance').prop('checked', total > 0 && total === checked);
    }

    function getAuthToken() {
        // Prefer localStorage
        let token = localStorage.getItem('authToken');
        if (token) return token;

        // Fallback to cookie
        const match = document.cookie.match(new RegExp('(^| )authToken=([^;]+)'));
        return match ? match[2] : null;
    }


    /* -----------------------------------------
       Events
    ----------------------------------------- */
    $('#classSelect, #sectionSelect, #dateSelect')
        .on('change', fetchAttendanceStudents);

    $(document).on('change', '#selectAllAttendance', function () {
        $('.attendance-checkbox').prop('checked', this.checked);
    });

    $(document).on('change', '.attendance-checkbox', updateSelectAllCheckbox);

});
