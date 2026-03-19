jQuery(document).ready(function () {
    const baseUrl = jQuery("#globalBaseUrl").val();

    function subjectAllocationInit() {
        jQuery("#classTeacherTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + "post-login-employee/admin/get-subject-allocation-list",
                type: "POST",
            },
            columns: [
                { data: "checkbox", orderable: false, searchable: false },
                { data: "teacher" },
                { data: "class" },
                { data: "section" },
                { data: "subject" },
                { data: "created_at" },
                { data: "actions", orderable: false, searchable: false },
            ],
            order: [[5, "desc"]],
        });
    }

    subjectAllocationInit();


    // Add Subject Allocation
	$(document).on('click', '#saveSubjectAllocationBtn', function () {
		let classVal = $('#class').val();
		let section = $('#section').val();
		let teacher = $('#teacher').val();
		let subject = $('#subject').val();

		if (!classVal || !section || !teacher || !subject) {
			alert("All fields are required.");
			return;
		}

		$.ajax({
			url: baseUrl + "post-login-employee/admin/add-subject-allocation",
			type: "POST",
			data: { class: classVal, section, teacher, subject },
			success: function () {
				$('#addSubjectAllocationModal').modal('hide');
				$('#classTeacherTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Error while adding subject allocation.");
			}
		});
	});

	// Open Edit Modal
	$(document).on('click', '.edit-subject-allocation-js', function () {
		let id = $(this).data('id');
		let classVal = $(this).data('class');
		console.log(classVal);
		let section = $(this).data('section');
		let teacher = $(this).data('teacher');
		let subject = $(this).data('subject');

		$('#editSubjectAllocationModal').data('record-id', id);
		$('#edit_class').val(classVal);
		$('#edit_section').val(section);
		$('#edit_teacher').val(teacher);
		$('#edit_subject').val(subject);

		$('#editSubjectAllocationModal').modal('show');
	});

	// Update Subject Allocation
	$(document).on('click', '#updateSubjectAllocationBtn', function () {
		let id = $('#editSubjectAllocationModal').data('record-id');
		let classVal = $('#edit_class').val();
		let section = $('#edit_section').val();
		let teacher = $('#edit_teacher').val();
		let subject = $('#edit_subject').val();

		$.ajax({
			url: baseUrl + "post-login-employee/admin/edit-subject-allocation",
			type: "POST",
			data: { id, class: classVal, section, teacher, subject },
			success: function () {
				$('#editSubjectAllocationModal').modal('hide');
				$('#classTeacherTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Error while updating subject allocation.");
			}
		});
	});

	// Delete Subject Allocation
	$(document).on('click', '.delete-subject-allocation-js', function () {
		let id = $(this).data('id');

		if (!confirm("Are you sure you want to delete this subject allocation?")) return;

		$.ajax({
			url: baseUrl + "post-login-employee/admin/delete-subject-allocation",
			type: "POST",
			data: { id },
			success: function () {
				$('#classTeacherTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Error while deleting subject allocation.");
			}
		});
	});


});
