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
				{ data: 'fees_periodicity' },
				{ data: 'late_fee' },
				{ data: 'late_fee_periodicity' },
				{ data: 'actions', orderable: false, searchable: false }
			]
		});

	}

	feesSlabTableInit();


	/* -----------------------------------------
	   Add Fees Slab
	----------------------------------------- */
	$(document).off('click', '#saveFeesSlabBtn').on('click', '#saveFeesSlabBtn', function () {

		const classId = $('#class_id').val();
		const totalAmount = $('#total_amount').val();
		const lateFee = $('#late_fee').val();
		const feesPeriodicity = $('#fees_periodicity').val();
		const lateFeePeriodicity = $('#late_fee_periodicity').val();

		if (!classId || !totalAmount || !lateFee || !feesPeriodicity || !lateFeePeriodicity) {
			alert('All fields are required');
			return;
		}

		$.ajax({
			url: baseUrl + 'post-login-employee/fees/add-fees-slab',
			type: 'POST',
			dataType: 'json',
			data: {
				class: classId,
				total_amount: totalAmount,
				late_fee: lateFee,
				fees_periodicity: feesPeriodicity,
				late_fee_periodicity: lateFeePeriodicity
			},
			success: function (res) {

				if (res.error) {
					alert(res.error);
					return;
				}

				$('#addFeesSlabModal').modal('hide');

				$('#class_id').val('');
				$('#total_amount').val('');
				$('#late_fee').val('');
				$('#fees_periodicity').val('');
				$('#late_fee_periodicity').val('');

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
	$(document).off('click', '.edit-fees-slab-js').on('click', '.edit-fees-slab-js', function () {

		const id = $(this).data('id');
		const classId = $(this).data('class');
		const totalAmount = $(this).data('amount');
		const lateFee = $(this).data('late-fee');
		const feesPeriodicity = $(this).data('fees-periodicity');
		const lateFeePeriodicity = $(this).data('late-fee-periodicity');

		$('#editFeesSlabModal').data('record-id', id);

		$('#edit_class_id').val(classId);
		$('#edit_total_amount').val(totalAmount);
		$('#edit_late_fee').val(lateFee);
		$('#edit_fees_periodicity').val(feesPeriodicity);
		$('#edit_late_fee_periodicity').val(lateFeePeriodicity);

		$('#editFeesSlabModal').modal('show');

	});


	/* -----------------------------------------
	   Update Fees Slab
	----------------------------------------- */
	$(document).off('click', '#updateFeesSlabBtn').on('click', '#updateFeesSlabBtn', function () {

		const id = $('#editFeesSlabModal').data('record-id');

		const classId = $('#edit_class_id').val();
		const totalAmount = $('#edit_total_amount').val();
		const lateFee = $('#edit_late_fee').val();
		const feesPeriodicity = $('#edit_fees_periodicity').val();
		const lateFeePeriodicity = $('#edit_late_fee_periodicity').val();

		if (!id || !classId || !totalAmount || !lateFee || !feesPeriodicity || !lateFeePeriodicity) {
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
				total_amount: totalAmount,
				late_fee: lateFee,
				fees_periodicity: feesPeriodicity,
				late_fee_periodicity: lateFeePeriodicity
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
	$(document).off('click', '.delete-fees-slab-js').on('click', '.delete-fees-slab-js', function () {

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
	$(document).off('click', '#generateFeesBtn').on('click', '#generateFeesBtn', function () {
		$('#generateFeesModal').modal('show');
	});


	$(document).off('click', '#runFeesGeneration').on('click', '#runFeesGeneration', function () {

		const month = $('#feesMonth').val();
		const year = $('#feesYear').val();
		const dueDate = $('#feesDueDate').val();
		const lateStart = $('#lateFeeStartDate').val();

		if (!month || !year || !dueDate || !lateStart) {
			alert('All fields required');
			return;
		}

		$.ajax({

			url: baseUrl + 'post-login-employee/fees/generate-fees',

			type: 'POST',

			data: {
				month: month,
				year: year,
				due_date: dueDate,
				late_fee_start_date: lateStart
			},

			dataType: 'json',

			success: function (res) {

				if (res.error) {
					alert(res.error);
					return;
				}

				alert(res.message);

				$('#generateFeesModal').modal('hide');

			}

		});

	});


});