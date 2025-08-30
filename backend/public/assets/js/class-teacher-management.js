jQuery(document).ready(function () {
	const baseUrl = jQuery("#globalBaseUrl").val();
	function classTeacherTableInit() {
		jQuery("#classTeacherTable").DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: baseUrl + "post-login-employee/admin/get-class-teacher-list/",
				type: "POST",
			},
			columns: [
				{ data: "checkbox", orderable: false, searchable: false },
				{ data: "teacher" },
				{ data: "class" },
				{ data: "section" },
				{ data: "created_at" },
				{ data: "updated_at" },
				{ data: "actions", orderable: false, searchable: false },
			],
		});
	}
	classTeacherTableInit();

	$(document).on('click', '#saveNewSectionBtn', function (e) {
		e.preventDefault();
	
		let classId    = $('#addClassTeacherModal #classSelect').val();
		let sectionId  = $('#addClassTeacherModal #sectionSelect').val();
		let employeeId = $('#addClassTeacherModal #employeeSelect').val();
	
		if (!classId || !sectionId || !employeeId) {
			alert("Please select class, section and teacher.");
			return;
		}
	
		$.ajax({
			url: baseUrl + "post-login-employee/admin/add-class-teacher", // adjust controller path
			type: "POST",
			data: {
				class: classId,
				section: sectionId,
				teacher: employeeId
			},
			success: function (response) {
				$('#addClassTeacherModal').modal('hide');
				$('#classTeacherTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Something went wrong while saving.");
			}
		});
	});

	// Open Edit Modal & Pre-fill Data
	$(document).on('click', '.edit-class-js', function () {
		let id        = $(this).data('id');
		let classId   = $(this).data('class-id');
		let sectionId = $(this).data('section-id');
		let employeeId= $(this).data('employee-id');

		// Store record id in modal for later save
		$('#editClassTeacherModal').data('record-id', id);

		// Pre-fill dropdowns
		$('#editClassTeacherModal #classSelect').val(classId);
		$('#editClassTeacherModal #sectionSelect').val(sectionId);
		$('#editClassTeacherModal #employeeSelect').val(employeeId);

		// Show modal
		$('#editClassTeacherModal').modal('show');
	});

	$(document).on('click', '#editSectionBtn', function (e) {
		e.preventDefault();
	
		let recordId  = $('#editClassTeacherModal').data('record-id');
		let classId   = $('#editClassTeacherModal #classSelect').val();
		let sectionId = $('#editClassTeacherModal #sectionSelect').val();
		let employeeId= $('#editClassTeacherModal #employeeSelect').val();
	
		if (!classId || !sectionId || !employeeId) {
			alert("Please select class, section and teacher.");
			return;
		}
	
		$.ajax({
			url: baseUrl + "post-login-employee/admin/edit-class-teacher",
			type: "POST",
			data: {
				id: recordId,
				class: classId,
				section: sectionId,
				teacher: employeeId
			},
			success: function (response) {
				$('#editClassTeacherModal').modal('hide');
				$('#classTeacherTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Something went wrong while updating.");
			}
		});
	});
	
	$(document).on('click', '.delete-class-js', function () {
		let id = $(this).data('id');
	
		if (!confirm("Are you sure you want to delete this class teacher assignment?")) {
			return;
		}
	
		$.ajax({
			url: baseUrl + "post-login-employee/admin/delete-class-teacher",
			type: "POST",
			data: { id: id },
			success: function (response) {
				$('#classTeacherTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Something went wrong while deleting.");
			}
		});
	});
	
	
});
