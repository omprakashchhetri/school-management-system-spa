jQuery(document).ready(function () {
	const baseUrl = jQuery("#globalBaseUrl").val();
	function employeeTableInit() {
		jQuery("#employeeTable").DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: baseUrl + "post-login-employee/admin/get-employee-list",
				type: "POST",
			},
			columns: [
				{ data: "checkbox", orderable: false, searchable: false },
				{ data: "name" },
				{ data: "email" },
				{ data: "phone" },
				{ data: "role" },
				{ data: "created_at" },
				{ data: "actions", orderable: false, searchable: false },
			],
		});
	}
	
	employeeTableInit();
	
	

	// Add Employee
	$(document).on('click', '#saveEmployeeBtn', function () {
		let firstname = $('#firstname').val();
		let lastname = $('#lastname').val();
		let email = $('#email1').val();
		let phone = $('#contact_number1').val();
		let role = $('#role_id').val();

		if (!firstname || !email || !role) {
			alert("Firstname, Email and Role are required.");
			return;
		}

		$.ajax({
			url: baseUrl + "post-login-employee/admin/add-employee",
			type: "POST",
			data: { firstname, lastname, email1: email, contact_number1: phone, role_id: role },
			success: function () {
				$('#addEmployeeModal').modal('hide');
				$('#employeeTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Error while adding employee.");
			}
		});
	});

	// Open Edit Modal
	$(document).on('click', '.edit-employee-js', function () {
		let id = $(this).data('id');
		let firstname = $(this).data('firstname');
		let lastname = $(this).data('lastname');
		let email = $(this).data('email');
		let phone = $(this).data('phone');
		let role = $(this).data('role');

		$('#editEmployeeModal').data('record-id', id);
		$('#edit_firstname').val(firstname);
		$('#edit_lastname').val(lastname);
		$('#edit_email1').val(email);
		$('#edit_contact_number1').val(phone);
		$('#edit_role_id').val(role);

		$('#editEmployeeModal').modal('show');
	});

	// Update Employee
	$(document).on('click', '#updateEmployeeBtn', function () {
		let id = $('#editEmployeeModal').data('record-id');
		let firstname = $('#edit_firstname').val();
		let lastname = $('#edit_lastname').val();
		let email = $('#edit_email1').val();
		let phone = $('#edit_contact_number1').val();
		let role = $('#edit_role_id').val();

		$.ajax({
			url: baseUrl + "post-login-employee/admin/edit-employee",
			type: "POST",
			data: { id, firstname, lastname, email1: email, contact_number1: phone, role_id: role },
			success: function () {
				$('#editEmployeeModal').modal('hide');
				$('#employeeTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Error while updating employee.");
			}
		});
	});

	// Delete Employee
	$(document).on('click', '.delete-employee-js', function () {
		let id = $(this).data('id');

		if (!confirm("Are you sure you want to delete this employee?")) return;

		$.ajax({
			url: baseUrl + "post-login-employee/admin/delete-employee",
			type: "POST",
			data: { id },
			success: function () {
				$('#employeeTable').DataTable().ajax.reload();
			},
			error: function () {
				alert("Error while deleting employee.");
			}
		});
	});

		
	
});
