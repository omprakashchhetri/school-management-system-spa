jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();

  // Hold the DataTable instance so we can destroy & reinit cleanly
  let ledgerTable = null;

  /* -----------------------------------------
	   Init (or reinit) the ledger DataTable.
	   Called every time a new student is selected.
	   Destroying first prevents event bubbling
	   from stale instances.
	----------------------------------------- */
  function initLedgerTable(data) {
    // Destroy existing instance before reinit
    if (ledgerTable !== null) {
      ledgerTable.destroy();
      ledgerTable = null;
      $("#feesLedgerBody").empty();
    }

    ledgerTable = $("#feesLedgerTable").DataTable({
      data: data,
      columns: [
        { data: "month" },
        { data: "year" },
        {
          data: "amount",
          render: (val) => "₹ " + parseFloat(val).toFixed(2),
        },
        {
          data: null,
          render: (row) => {
            let text = "₹ " + parseFloat(row.late_fee).toFixed(2);
            if (row.days_late > 0) {
              text += ` <small class="text-muted">(${row.days_late} days)</small>`;
            }
            return `<span class="text-danger">${text}</span>`;
          },
        },
        {
          data: "discount",
          render: (val) =>
            `<span class="text-success">₹ ${parseFloat(val).toFixed(2)}</span>`,
        },
        {
          data: "paid",
          render: (val) =>
            `<span class="text-primary">₹ ${parseFloat(val).toFixed(2)}</span>`,
        },
        {
          data: "balance",
          render: (val) =>
            `<span class="fw-bold text-danger">₹ ${parseFloat(val).toFixed(2)}</span>`,
        },
        {
          data: null,
          render: (row) => {
            if (row.balance > 0) {
              return '<span class="badge bg-warning text-dark">Pending</span>';
            }
            const receiptUrl = row.payment_id
              ? `${baseUrl}fees/receipt/${row.payment_id}`
              : "#";
            return `
                    <div class="d-flex align-items-center gap-8">
                        <span class="badge bg-success">Paid</span>
                        <a href="${receiptUrl}" target="_blank"
                           title="View Receipt"
                           class="text-main-600 d-flex align-items-center gap-4 text-sm">
                            <i class="ph ph-receipt"></i> Receipt
                        </a>
                    </div>
                `;
          },
        },
      ],
      order: [[0, "asc"]],
      pageLength: 10,
      language: {
        emptyTable: "No fees generated for this student.",
        zeroRecords: "No matching fee records found.",
      },
      columnDefs: [{ orderable: false, targets: [3, 4, 5, 6, 7] }],
    });
  }

  /* -----------------------------------------
	   Show empty state without a DataTable
	   (used when student is deselected)
	----------------------------------------- */
  function clearLedger() {
    if (ledgerTable !== null) {
      ledgerTable.destroy();
      ledgerTable = null;
    }

    $("#feesLedgerBody").html(`
			<tr>
				<td colspan="8" class="text-center text-muted py-20">
					Select a student to view ledger
				</td>
			</tr>
		`);
  }

  /* -----------------------------------------
	   Load Sections when Class changes
	----------------------------------------- */
  $(document)
    .off("change", "#classSelect")
    .on("change", "#classSelect", function () {
      const classId = $(this).val();

      $("#sectionSelect").html('<option value="">Select Section</option>');
      $("#studentSelect").html('<option value="">Select Student</option>');
      clearLedger();

      if (!classId) return;

      $.ajax({
        url: baseUrl + "post-login-employee/fees/get-sections-by-class",
        type: "POST",
        dataType: "json",
        data: { class_id: classId },

        success: function (res) {
          if (!res.sections) return;

          let options = '<option value="">Select Section</option>';

          res.sections.forEach(function (sec) {
            options += `<option value="${sec.id}">${sec.section_label}</option>`;
          });

          $("#sectionSelect").html(options);
        },
      });
    });

  /* -----------------------------------------
	   Load Students when Section changes
	----------------------------------------- */
  $(document)
    .off("change", "#sectionSelect")
    .on("change", "#sectionSelect", function () {
      const classId = $("#classSelect").val();
      const sectionId = $(this).val();

      $("#studentSelect").html('<option value="">Select Student</option>');
      clearLedger();

      if (!classId || !sectionId) return;

      $.ajax({
        url: baseUrl + "post-login-employee/fees/get-students-by-class-section",
        type: "POST",
        dataType: "json",
        data: {
          class_id: classId,
          section_id: sectionId,
        },

        success: function (res) {
          if (!res.students) return;

          let options = '<option value="">Select Student</option>';

          res.students.forEach(function (student) {
            options += `<option value="${student.id}">${student.roll_no} - ${student.name}</option>`;
          });

          $("#studentSelect").html(options);
        },
      });
    });

  /* -----------------------------------------
	   Fetch Ledger when Student changes
	----------------------------------------- */
  $(document)
    .off("change", "#studentSelect")
    .on("change", "#studentSelect", function () {
      const studentId = $(this).val();

      if (!studentId) {
        clearLedger();
        return;
      }

      fetchLedger(studentId);
    });

  /* -----------------------------------------
	   Fetch Ledger Function
	----------------------------------------- */
  function fetchLedger(studentId) {
    $.ajax({
      url: baseUrl + "post-login-employee/fees/get-student-fees-ledger",
      type: "POST",
      dataType: "json",
      data: { student_id: studentId },

      success: function (res) {
        if (!res.ledger || res.ledger.length === 0) {
          clearLedger();
          return;
        }

        initLedgerTable(res.ledger);
      },

      error: function () {
        clearLedger();
      },
    });
  }

  /* -----------------------------------------
	   Record Payment
	----------------------------------------- */
  $(document)
    .off("click", "#recordPaymentBtn")
    .on("click", "#recordPaymentBtn", function () {
      const studentId = $("#studentSelect").val();
      const amount = $("#paymentAmount").val();
      const mode = $("#paymentMode").val();
      const date = $("#paymentDate").val();

      if (!studentId) {
        alert("Please select a student.");
        return;
      }
      if (!amount || amount <= 0) {
        alert("Enter a valid payment amount.");
        return;
      }
      if (!mode) {
        alert("Select a payment mode.");
        return;
      }
      if (!date) {
        alert("Select a payment date.");
        return;
      }

      const $btn = $(this);
      $btn
        .prop("disabled", true)
        .html('<i class="ph ph-spinner me-4"></i> Processing...');

      $.ajax({
        url: baseUrl + "post-login-employee/fees/record-payment",
        type: "POST",
        dataType: "json",
        data: {
          student_id: studentId,
          amount: amount,
          payment_mode: mode,
          payment_date: date,
        },

        success: function (res) {
          if (res.error) {
            alert(res.error);
            return;
          }

          alert("Payment recorded successfully.");

          $("#paymentAmount").val("");
          $("#paymentMode").val("");
          $("#paymentDate").val("");

          // Refresh ledger for the same student
          fetchLedger(studentId);
        },

        error: function () {
          alert("Error recording payment. Please try again.");
        },

        complete: function () {
          $btn
            .prop("disabled", false)
            .html('<i class="ph ph-floppy-disk me-4"></i> Record Payment');
        },
      });
    });
});
