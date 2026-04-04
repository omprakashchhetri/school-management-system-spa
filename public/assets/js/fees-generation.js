jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();

  /* -----------------------------------------
       Initialise DataTable
    ----------------------------------------- */
  const table = $("#feesGenerationTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: baseUrl + "post-login-employee/fees/get-fees-generation-list",
      type: "POST",
      data: function (d) {
        d.filter_class = $("#filterClass").val();
        d.filter_section = $("#filterSection").val();
        d.filter_month = $("#filterMonth").val();
        d.filter_year = $("#filterYear").val();
      },
    },
    columns: [
      { data: "checkbox", orderable: false, searchable: false, width: "40px" },
      { data: "student" },
      { data: "class_section" },
      { data: "period" },
      { data: "amount" },
      { data: "due_date" },
      { data: "late_fee_start_date" },
      { data: "status", orderable: false },
    ],
    order: [[5, "desc"]],
    pageLength: 25,
    language: {
      emptyTable: "No fees generated yet.",
      zeroRecords: "No records match your filters.",
      processing: '<div class="text-center py-20 text-muted">Loading...</div>',
    },
  });

  /* -----------------------------------------
       Re-draw table when any filter changes
    ----------------------------------------- */
  $("#filterClass, #filterSection, #filterMonth, #filterYear").on(
    "change",
    function () {
      table.ajax.reload();
    },
  );

  /* -----------------------------------------
       Select All Checkbox
    ----------------------------------------- */
  $(document)
    .off("change", "#selectAllRows")
    .on("change", "#selectAllRows", function () {
      const checked = $(this).is(":checked");
      $('#feesGenerationTable tbody input[type="checkbox"]').prop(
        "checked",
        checked,
      );
    });

  /* -----------------------------------------
       Generate Fees — Submit
    ----------------------------------------- */
  $(document)
    .off("click", "#generateFeesBtn")
    .on("click", "#generateFeesBtn", function () {
      const month = $("#genMonth").val();
      const year = $("#genYear").val();
      const dueDate = $("#genDueDate").val();
      const lateStart = $("#genLateFeeStartDate").val();

      if (!month) {
        alert("Please select a month.");
        return;
      }

      if (!year) {
        alert("Please select a year.");
        return;
      }

      if (!dueDate) {
        alert("Please select a due date.");
        return;
      }

      if (!lateStart) {
        alert("Please select a late fee start date.");
        return;
      }

      if (lateStart <= dueDate) {
        alert("Late fee start date must be after the due date.");
        return;
      }

      const $btn = $(this);
      $btn
        .prop("disabled", true)
        .html('<i class="ph ph-spinner me-4"></i> Generating...');

      $.ajax({
        url: baseUrl + "post-login-employee/fees/generate-fees",
        type: "POST",
        dataType: "json",
        data: {
          month: month,
          year: year,
          due_date: dueDate,
          late_fee_start_date: lateStart,
        },

        success: function (res) {
          if (res.error) {
            alert(res.error);
            return;
          }

          // Close modal, reset form, refresh table
          $("#generateFeesModal").modal("hide");
          resetGenerateForm();
          table.ajax.reload();
        },

        error: function () {
          alert("Something went wrong. Please try again.");
        },

        complete: function () {
          $btn
            .prop("disabled", false)
            .html('<i class="ph ph-check me-4"></i> Generate Fees');
        },
      });
    });

  /* -----------------------------------------
       Reset modal form on close
    ----------------------------------------- */
  $("#generateFeesModal").on("hidden.bs.modal", function () {
    resetGenerateForm();
  });

  function resetGenerateForm() {
    $("#genMonth").val("");
    $("#genDueDate").val("");
    $("#genLateFeeStartDate").val("");
    // Keep year at current year (already pre-selected)
  }
});
