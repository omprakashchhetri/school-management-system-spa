jQuery(document).ready(function () {

	const baseUrl = jQuery('#globalBaseUrl').val();


	/* -----------------------------------------
	   Load Sections when Class changes
	----------------------------------------- */
	$(document)
		.off('change', '#classSelect')
		.on('change', '#classSelect', function () {

			const classId = $(this).val();

			$('#sectionSelect').html('<option value="">Select Section</option>');
			$('#studentSelect').html('<option value="">Select Student</option>');
			$('#feesLedgerBody').html('');

			if (!classId) return;

			$.ajax({
				url: baseUrl + 'post-login-employee/fees/get-sections-by-class',
				type: 'POST',
				dataType: 'json',
				data: { class_id: classId },

				success: function (res) {

					if (!res.sections) return;

					let options = '<option value="">Select Section</option>';

					res.sections.forEach(function (sec) {
						options += `<option value="${sec.id}">${sec.section_label}</option>`;
					});

					$('#sectionSelect').html(options);
				}
			});

		});



	/* -----------------------------------------
	   Load Students when Section changes
	----------------------------------------- */
	$(document)
		.off('change', '#sectionSelect')
		.on('change', '#sectionSelect', function () {

			const classId = $('#classSelect').val();
			const sectionId = $(this).val();

			$('#studentSelect').html('<option value="">Select Student</option>');
			$('#feesLedgerBody').html('');

			if (!classId || !sectionId) return;

			$.ajax({
				url: baseUrl + 'post-login-employee/fees/get-students-by-class-section',
				type: 'POST',
				dataType: 'json',
				data: {
					class_id: classId,
					section_id: sectionId
				},

				success: function (res) {

					if (!res.students) return;

					let options = '<option value="">Select Student</option>';

					res.students.forEach(function (student) {
						options += `<option value="${student.id}">${student.roll_no} - ${student.name}</option>`;
					});

					$('#studentSelect').html(options);
				}
			});

		});



	/* -----------------------------------------
	   Fetch Student Ledger
	----------------------------------------- */
	$(document)
		.off('change', '#studentSelect')
		.on('change', '#studentSelect', function () {

			const studentId = $(this).val();

			if (!studentId) {
				$('#feesLedgerBody').html('');
				return;
			}

			fetchLedger(studentId);

		});



	/* -----------------------------------------
	   Fetch Ledger Function
	----------------------------------------- */
	function fetchLedger(studentId) {

		$.ajax({

			url: baseUrl + 'post-login-employee/fees/get-student-fees-ledger',
			type: 'POST',
			dataType: 'json',
			data: {
				student_id: studentId
			},

			success: function (res) {

				if (!res.ledger || res.ledger.length === 0) {

					$('#feesLedgerBody').html(`
                        <tr>
                            <td colspan="7" class="text-center text-muted py-20">
                                No fees generated for this student
                            </td>
                        </tr>
                    `);

					return;
				}

				renderLedger(res.ledger);
			}

		});

	}



	/* -----------------------------------------
	   Render Ledger Table
	----------------------------------------- */
	function renderLedger(ledger) {

		let html = '';

		ledger.forEach(function (row) {

			let status = row.balance > 0
				? '<span class="badge bg-warning">Pending</span>'
				: '<span class="badge bg-success">Paid</span>';

			html += `
            <tr>
                <td class="text-gray-700">${row.month}</td>

                <td class="text-gray-700">${row.year}</td>

                <td class="text-gray-700">
                    ₹ ${row.amount}
                </td>

                <td class="text-danger">
                    ₹ ${row.late_fee}
                    ${row.days_late > 0 ? `(${row.days_late} days)` : ''}
                </td>

                <td class="text-success">
                    ₹ ${row.discount}
                </td>

                <td class="text-primary">
                    ₹ ${row.paid}
                </td>

                <td class="fw-bold text-danger">
                    ₹ ${row.balance}
                </td>

                <td>
                    ${status}
                </td>

            </tr>
        `;
		});

		$('#feesLedgerBody').html(html);
	}




	/* -----------------------------------------
	   Record Payment
	----------------------------------------- */
	$(document)
		.off('click', '#recordPaymentBtn')
		.on('click', '#recordPaymentBtn', function () {

			const studentId = $('#studentSelect').val();
			const amount = $('#paymentAmount').val();
			const mode = $('#paymentMode').val();
			const date = $('#paymentDate').val();

			if (!studentId) {
				alert('Please select a student');
				return;
			}

			if (!amount || amount <= 0) {
				alert('Enter valid payment amount');
				return;
			}

			if (!mode) {
				alert('Select payment mode');
				return;
			}

			if (!date) {
				alert('Select payment date');
				return;
			}


			$.ajax({

				url: baseUrl + 'post-login-employee/fees/record-payment',
				type: 'POST',
				dataType: 'json',

				data: {
					student_id: studentId,
					amount: amount,
					payment_mode: mode,
					payment_date: date
				},

				success: function (res) {

					if (res.error) {
						alert(res.error);
						return;
					}

					alert('Payment recorded successfully');

					$('#paymentAmount').val('');
					$('#paymentMode').val('');
					$('#paymentDate').val('');

					fetchLedger(studentId);
				},

				error: function () {
					alert('Error recording payment');
				}

			});

		});

});