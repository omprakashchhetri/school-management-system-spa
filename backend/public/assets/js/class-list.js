jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();

  // ============================
  // DELETE CLASS
  // ============================
  jQuery(document)
    .off("click", ".delete-class-js")
    .on("click", ".delete-class-js", function () {
      let classId = jQuery(this).attr("data-id");
      if (confirm("Do you want to delete this class?")) {
        jQuery.ajax({
          url: baseUrl + "post-login-employee/admin/delete-class",
          type: "POST",
          data: { id: classId },
          success: function (res) {
            res = JSON.parse(res);
            alert(res.message);
            window.location.reload();
          },
        });
      }
    });

  // ============================
  // ADD CLASS
  // ============================
  jQuery(document)
    .off("click", "#saveNewClassBtn")
    .on("click", "#saveNewClassBtn", function () {
      jQuery(".text-danger").remove();
      jQuery("#newClassName").removeClass("border-danger");

      let newClassName = jQuery("#newClassName").val().trim();
      if (newClassName === "") {
        jQuery("#newClassName")
          .parent()
          .append('<span class="text-danger">Enter Class Name!</span>');
        jQuery("#newClassName").addClass("border-danger");
        return;
      }

      // Generate label + short_form
      let label = newClassName.replace(/class/i, "").trim(); // remove "Class"
      let className = newClassName.toLowerCase().replace(/\s+/g, "_"); // for DB
      let shortForm = label; // just the number or short text

      jQuery(".preloader").show();
      jQuery.ajax({
        url: baseUrl + "post-login-employee/admin/add-class",
        type: "POST",
        data: {
          class_name: className,
          label: label,
          short_form: shortForm,
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
    .off("click", ".edit-class-js")
    .on("click", ".edit-class-js", function () {
      let classId = jQuery(this).attr("data-class-id");
      let classLabel = jQuery(this).attr("data-class-label");

      // set values in modal
      jQuery("#editClassId").val(classId);
      jQuery("#className").val(classLabel);

      jQuery("#editClassModal").modal("show");
    });

  // ============================
  // EDIT CLASS
  // ============================
  jQuery(document)
    .off("click", "#editNewRoleBtn")
    .on("click", "#editNewRoleBtn", function () {
      jQuery(".text-danger").remove();
      jQuery("#className").removeClass("border-danger");

      let editClassId = jQuery("#editClassId").val();
      let newClassName = jQuery("#className").val().trim();

      if (newClassName === "") {
        jQuery("#className")
          .parent()
          .append('<span class="text-danger">Enter Class Name!</span>');
        jQuery("#className").addClass("border-danger");
        return;
      }

      // regenerate label + short_form
      let label = newClassName.replace(/class/i, "").trim();
      let className = newClassName.toLowerCase().replace(/\s+/g, "_");
      let shortForm = label;

      jQuery(".preloader").show();
      jQuery.ajax({
        url: baseUrl + "post-login-employee/admin/edit-class",
        type: "POST",
        data: {
          id: editClassId,
          class_name: className,
          label: label,
          short_form: shortForm,
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
