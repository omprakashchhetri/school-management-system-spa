jQuery(document).ready(function () {

	const baseUrl = jQuery('#globalBaseUrl').val();

	/* -----------------------------------------
	   DataTable Init
	----------------------------------------- */
	function feesSlabTableInit() {
		jQuery('#feesSlabTable').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: {
				url: baseUrl + 'post-login-employee/fees/get-fees-slab-list',
				type: 'POST'
			},
			columns: [
				{ data: 'checkbox', orderable: false, searchable: false },
				{ data: 'class_name' },
				{ data: 'total_amount' },
				{ data: 'actions', orderable: false, searchable: false }
			]
		});
	}

	feesSlabTableInit();

	/* -----------------------------------------
	   Add Fees Slab
	----------------------------------------- */
	$(document).on('click', '#saveFeesSlabBtn', function () {

		const classId = $('#class_id').val();
		const totalAmount = $('#total_amount').val();

		if (!classId || !totalAmount) {
			alert('Class and Total Amount are required');
			return;
		}

		$.ajax({
			url: baseUrl + 'post-login-employee/fees/add-fees-slab',
			type: 'POST',
			dataType: 'json',
			data: {
				class: classId,
				total_amount: totalAmount
			},
			success: function (res) {

				if (res.error) {
					alert(res.error);
					return;
				}

				$('#addFeesSlabModal').modal('hide');
				$('#class_id').val('');
				$('#total_amount').val('');

				$('#feesSlabTable').DataTable().ajax.reload();
			},
			error: function () {
				alert('Error adding fees slab');
			}
		});
	});

	/* -----------------------------------------
	   Open Edit Modal
	----------------------------------------- */
	$(document).on('click', '.edit-fees-slab-js', function () {

		const id = $(this).data('id');
		const classId = $(this).data('class');
		const totalAmount = $(this).data('amount');

		$('#editFeesSlabModal').data('record-id', id);
		$('#edit_class_id').val(classId);
		$('#edit_total_amount').val(totalAmount);

		$('#editFeesSlabModal').modal('show');
	});

	/* -----------------------------------------
	   Update Fees Slab
	----------------------------------------- */
	$(document).on('click', '#updateFeesSlabBtn', function () {

		const id = $('#editFeesSlabModal').data('record-id');
		const classId = $('#edit_class_id').val();
		const totalAmount = $('#edit_total_amount').val();

		if (!id || !classId || !totalAmount) {
			alert('All fields are required');
			return;
		}

		$.ajax({
			url: baseUrl + 'post-login-employee/fees/edit-fees-slab',
			type: 'POST',
			dataType: 'json',
			data: {
				id: id,
				class: classId,
				total_amount: totalAmount
			},
			success: function (res) {

				if (res.error) {
					alert(res.error);
					return;
				}

				$('#editFeesSlabModal').modal('hide');
				$('#feesSlabTable').DataTable().ajax.reload();
			},
			error: function () {
				alert('Error updating fees slab');
			}
		});
	});

	/* -----------------------------------------
	   Delete Fees Slab
	----------------------------------------- */
	$(document).on('click', '.delete-fees-slab-js', function () {

		const id = $(this).data('id');

		if (!confirm('Are you sure you want to delete this fees slab?')) {
			return;
		}

		$.ajax({
			url: baseUrl + 'post-login-employee/fees/delete-fees-slab',
			type: 'POST',
			dataType: 'json',
			data: {
				id: id
			},
			success: function (res) {

				if (res.error) {
					alert(res.error);
					return;
				}

				$('#feesSlabTable').DataTable().ajax.reload();
			},
			error: function () {
				alert('Error deleting fees slab');
			}
		});
	});

});
