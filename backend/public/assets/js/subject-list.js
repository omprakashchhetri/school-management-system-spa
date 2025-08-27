jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();

  // ============================
  // DELETE SUBJECT
  // ============================
  jQuery(document)
    .off("click", ".delete-subject-js")
    .on("click", ".delete-subject-js", function () {
      let subjectId = jQuery(this).attr("data-id");
      if (confirm("Do you want to delete this subject?")) {
        jQuery.ajax({
          url: baseUrl + "post-login-employee/admin/delete-subject",
          type: "POST",
          data: { id: subjectId },
          success: function (res) {
            res = JSON.parse(res);
            alert(res.message);
            window.location.reload();
          },
        });
      }
    });

  // ============================
  // ADD SUBJECT
  // ============================
  jQuery(document)
    .off("click", "#saveNewSubjectBtn")
    .on("click", "#saveNewSubjectBtn", function () {
      jQuery(".text-danger").remove();
      jQuery("#newSubjectName").removeClass("border-danger");

      let newSubjectName = jQuery("#newSubjectName").val().trim();
      if (newSubjectName === "") {
        jQuery("#newSubjectName")
          .parent()
          .append('<span class="text-danger">Enter Subject Name!</span>');
        jQuery("#newSubjectName").addClass("border-danger");
        return;
      }

      let subjectName = newSubjectName.trim();

      jQuery(".preloader").show();
      jQuery.ajax({
        url: baseUrl + "post-login-employee/admin/add-subject",
        type: "POST",
        data: {
          subject_name: subjectName,
        },
        success: function (res) {
          res = JSON.parse(res);
          alert(res.message);
          window.location.reload();
        },
        complete: function () {
          jQuery(".preloader").hide();
        },
      });
    });

  // ============================
  // OPEN EDIT MODAL
  // ============================
  jQuery(document)
    .off("click", ".edit-subject-js")
    .on("click", ".edit-subject-js", function () {
      let subjectId = jQuery(this).attr("data-subject-id");
      let subjectName = jQuery(this).attr("data-subject-name");

      // set values in modal
      jQuery("#editSubjectId").val(subjectId);
      jQuery("#subjectName").val(subjectName);

      jQuery("#editSubjectModal").modal("show");
    });

  // ============================
  // EDIT SUBJECT
  // ============================
  jQuery(document)
    .off("click", "#editNewSubjectBtn")
    .on("click", "#editNewSubjectBtn", function () {
      jQuery(".text-danger").remove();
      jQuery("#subjectName").removeClass("border-danger");

      let editSubjectId = jQuery("#editSubjectId").val();
      let newSubjectName = jQuery("#subjectName").val().trim();

      if (newSubjectName === "") {
        jQuery("#subjectName")
          .parent()
          .append('<span class="text-danger">Enter Subject Name!</span>');
        jQuery("#subjectName").addClass("border-danger");
        return;
      }

      // regenerate label + short_form
      let subjectName = newSubjectName.trim();

      jQuery(".preloader").show();
      jQuery.ajax({
        url: baseUrl + "post-login-employee/admin/edit-subject",
        type: "POST",
        data: {
          id: editSubjectId,
          subject_name: subjectName,
        },
        success: function (res) {
          res = JSON.parse(res);
          alert(res.message);
          window.location.reload();
        },
        complete: function () {
          jQuery(".preloader").hide();
        },
      });
    });
});
