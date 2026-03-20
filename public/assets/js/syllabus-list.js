jQuery(document).ready(function () {

    const baseUrl = jQuery("#globalBaseUrl").val();

    function syllabusTableInit() {

        // Prevent reinitialization issues
        if ($.fn.DataTable.isDataTable('#syllabusTable')) {
            $('#syllabusTable').DataTable().destroy();
        }

        $('#syllabusTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            ajax: {
                url: baseUrl + "post-login-employee/academic/get-syllabus-list",
                type: "POST"
            },
            columns: [
                { data: "checkbox", orderable: false, searchable: false },
                { data: "class" },
                { data: "section" },
                { data: "subject" },
                { data: "teacher" },
                { data: "file", orderable: false, searchable: false },
                { data: "created_at" },
                { data: "actions", orderable: false, searchable: false }
            ],
            order: [[6, "desc"]]
        });
    }

    syllabusTableInit();

    /* ---------- Delete Syllabus ---------- */
    jQuery(document).on('click', '.delete-syllabus-js', function () {

        let id = jQuery(this).data('id');

        if (!confirm("Are you sure you want to delete this syllabus?")) {
            return;
        }

        jQuery.ajax({
            url: baseUrl + "post-login-employee/academic/delete-syllabus",
            type: "POST",
            data: { id },
            success: function () {
                jQuery('#syllabusTable').DataTable().ajax.reload(null, false);
            },
            error: function () {
                alert("Error while deleting syllabus.");
            }
        });
    });

    // Add Syllabus
    $(document).on('click', '#saveSyllabusBtn', function () {

        let classId = $('#class').val();
        let sectionId = $('#section').val();
        let teacherId = $('#teacher').val();
        let subjectId = $('#subject').val();
        let desc = $('#description').val();
        let fileInput = $('#syllabus_file')[0];

        if (!classId || !sectionId || !teacherId || !subjectId) {
            alert('Class, Section, Teacher and Subject are required');
            return;
        }

        if (!fileInput.files.length) {
            alert('Please upload syllabus file');
            return;
        }

        let formData = new FormData();
        formData.append('class_id', classId);
        formData.append('section_id', sectionId);
        formData.append('teacher_id', teacherId);
        formData.append('subject_id', subjectId);
        formData.append('description', desc);
        formData.append('syllabus_file', fileInput.files[0]);

        $.ajax({
            url: baseUrl + 'post-login-employee/academic/add-syllabus',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {

                if (res.error) {
                    alert(res.error);
                    return;
                }

                $('#addSyllabusModal').modal('hide');
                $('#addSyllabusModal').find('form')[0]?.reset();

                $('#syllabusTable').DataTable().ajax.reload(null, false);
            },
            error: function () {
                alert('Error while adding syllabus');
            }
        });
    });

    // Open Edit Modal
    $(document).on('click', '.edit-syllabus-js', function () {

        let btn = $(this);

        $('#editSyllabusModal').data('id', btn.data('id'));

        $('#edit_class').val(btn.data('class-id'));
        $('#edit_section').val(btn.data('section-id'));
        $('#edit_teacher').val(btn.data('teacher-id'));
        $('#edit_subject').val(btn.data('subject-id'));

        $('#edit_description').val(btn.data('description'));

        // Clear file input
        $('#edit_syllabus_file').val('');

        $('#editSyllabusModal').modal('show');
    });

    // Update Syllabus
    $(document).on('click', '#updateSyllabusBtn', function () {

        let id = $('#editSyllabusModal').data('id');
        let classId = $('#edit_class').val();
        let sectionId = $('#edit_section').val();
        let teacherId = $('#edit_teacher').val();
        let subjectId = $('#edit_subject').val();
        let desc = $('#edit_description').val();
        let fileInput = $('#edit_syllabus_file')[0];

        if (!id) {
            alert('Invalid syllabus record');
            return;
        }

        if (!classId || !sectionId || !teacherId || !subjectId) {
            alert('Class, Section, Teacher and Subject are required');
            return;
        }

        let formData = new FormData();
        formData.append('id', id);
        formData.append('class_id', classId);
        formData.append('section_id', sectionId);
        formData.append('teacher_id', teacherId);
        formData.append('subject_id', subjectId);
        formData.append('description', desc);

        // File is optional on edit
        if (fileInput.files.length) {
            formData.append('syllabus_file', fileInput.files[0]);
        }

        $.ajax({
            url: baseUrl + 'post-login-academics/admin/edit-syllabus',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {

                if (res.error) {
                    alert(res.error);
                    return;
                }

                $('#editSyllabusModal').modal('hide');
                $('#syllabusTable').DataTable().ajax.reload(null, false);
            },
            error: function () {
                alert('Error while updating syllabus');
            }
        });
    });


});
