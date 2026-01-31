jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();
  let studentTable;

  // Load Classes and Sections for filters
  function loadFilters() {
    // Load Classes
    $.ajax({
      url: baseUrl + "post-login-employee/student/get-classes",
      type: "POST",
      success: function (response) {
        let options = '<option value="">All Classes</option>';
        response.forEach(function (cls) {
          options += `<option value="${cls.id}">${cls.class_name}</option>`;
        });
        $("#filterClass, #related_class, #edit_related_class").html(options);
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Failed to load classes. Please refresh the page.",
          confirmButtonColor: "#487FFF",
        });
      },
    });

    // Load Sections
    $.ajax({
      url: baseUrl + "post-login-employee/student/get-sections",
      type: "POST",
      success: function (response) {
        let options = '<option value="">All Sections</option>';
        response.forEach(function (section) {
          options += `<option value="${section.id}">${section.section_label}</option>`;
        });
        $("#filterSection, #related_section, #edit_related_section").html(
          options,
        );
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Failed to load sections. Please refresh the page.",
          confirmButtonColor: "#487FFF",
        });
      },
    });
  }

  // Initialize DataTable
  function studentTableInit() {
    studentTable = jQuery("#studentTable").DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + "post-login-employee/student/get-student-list",
        type: "POST",
        data: function (d) {
          d.class_id = $("#filterClass").val();
          d.section_id = $("#filterSection").val();
        },
        error: function (xhr, error, code) {
          Swal.fire({
            icon: "error",
            title: "Error Loading Data",
            text: "Failed to load student list. Please try again.",
            confirmButtonColor: "#487FFF",
          });
        },
      },
      columns: [
        { data: "checkbox", orderable: false, searchable: false },
        { data: "name" },
        { data: "roll_no" },
        { data: "class" },
        { data: "section" },
        { data: "email" },
        { data: "contact" },
        { data: "actions", orderable: false, searchable: false },
      ],
      order: [[1, "asc"]],
    });
  }

  // Initialize
  loadFilters();
  studentTableInit();

  // Apply Filter
  $(document).on("click", "#applyFilterBtn", function () {
    studentTable.ajax.reload();

    // Show filter applied message
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    });

    Toast.fire({
      icon: "success",
      title: "Filters applied successfully",
    });
  });

  // Reset Filter
  $(document).on("click", "#resetFilterBtn", function () {
    $("#filterClass").val("");
    $("#filterSection").val("");
    studentTable.ajax.reload();

    // Show filter reset message
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    });

    Toast.fire({
      icon: "info",
      title: "Filters reset",
    });
  });

  // Select All Checkbox
  $(document).on("change", "#selectAll", function () {
    $(".form-check-input").not(this).prop("checked", this.checked);
  });

  // Add Student
  $(document).on("click", "#saveStudentBtn", function () {
    let formData = {
      firstname: $("#firstname").val(),
      middlename: $("#middlename").val(),
      lastname: $("#lastname").val(),
      //   roll_no: $("#roll_no").val(),
      blood_group: $("#blood_group").val(),
      related_class: $("#related_class").val(),
      related_section: $("#related_section").val(),
      student_email: $("#student_email").val(),
      student_contact_no: $("#student_contact_no").val(),
      father_name: $("#father_name").val(),
      father_contact_no: $("#father_contact_no").val(),
      mother_name: $("#mother_name").val(),
      mother_contact_no: $("#mother_contact_no").val(),
      status: $("#status").val(),
      gender: $("#gender").val(),
    };

    if (
      !formData.firstname ||
      //   !formData.roll_no ||
      !formData.related_class ||
      !formData.related_section
    ) {
      Swal.fire({
        icon: "warning",
        title: "Missing Required Fields",
        text: "First Name, Roll No, Class and Section are required.",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    // Show loading
    Swal.fire({
      title: "Adding Student...",
      text: "Please wait",
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    $.ajax({
      url: baseUrl + "post-login-employee/student/add-student",
      type: "POST",
      data: formData,
      success: function (response) {
        $("#addStudentModal").modal("hide");
        $("#addStudentForm")[0].reset();
        studentTable.ajax.reload();

        Swal.fire({
          icon: "success",
          title: "Success!",
          text: response.message || "Student added successfully",
          confirmButtonColor: "#487FFF",
          timer: 2000,
        });
      },
      error: function (xhr) {
        let errorMessage = "Error while adding student.";
        if (xhr.responseJSON && xhr.responseJSON.error) {
          errorMessage = xhr.responseJSON.error;
        }

        Swal.fire({
          icon: "error",
          title: "Error",
          text: errorMessage,
          confirmButtonColor: "#487FFF",
        });
      },
    });
  });

  // Open Edit Modal
  $(document).on("click", ".edit-student-js", function () {
    let data = $(this).data();

    $("#editStudentModal").data("record-id", data.id);
    $("#edit_firstname").val(data.firstname);
    $("#edit_middlename").val(data.middlename);
    $("#edit_lastname").val(data.lastname);
    $("#edit_roll_no").val(data.rollno);
    $("#edit_blood_group").val(data.bloodgroup);
    $("#edit_related_class").val(data.class);
    $("#edit_related_section").val(data.section);
    $("#edit_student_email").val(data.email);
    $("#edit_student_contact_no").val(data.contact);
    $("#edit_gender").val(data.gender);
    $("#edit_status").val(data.status);
    $("#editStudentModal").modal("show");
  });

  // Update Student
  $(document).on("click", "#updateStudentBtn", function () {
    let id = $("#editStudentModal").data("record-id");
    let formData = {
      id: id,
      firstname: $("#edit_firstname").val(),
      middlename: $("#edit_middlename").val(),
      lastname: $("#edit_lastname").val(),
      roll_no: $("#edit_roll_no").val(),
      blood_group: $("#edit_blood_group").val(),
      related_class: $("#edit_related_class").val(),
      related_section: $("#edit_related_section").val(),
      student_email: $("#edit_student_email").val(),
      student_contact_no: $("#edit_student_contact_no").val(),
      status: $("#edit_status").val(),
      gender: $("#edit_gender").val(),
    };

    // Show loading
    Swal.fire({
      title: "Updating Student...",
      text: "Please wait",
      allowOutsideClick: false,
      allowEscapeKey: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    $.ajax({
      url: baseUrl + "post-login-employee/student/edit-student",
      type: "POST",
      data: formData,
      success: function (response) {
        $("#editStudentModal").modal("hide");
        studentTable.ajax.reload();

        Swal.fire({
          icon: "success",
          title: "Updated!",
          text: response.message || "Student updated successfully",
          confirmButtonColor: "#487FFF",
          timer: 2000,
        });
      },
      error: function (xhr) {
        let errorMessage = "Error while updating student.";
        if (xhr.responseJSON && xhr.responseJSON.error) {
          errorMessage = xhr.responseJSON.error;
        }

        Swal.fire({
          icon: "error",
          title: "Error",
          text: errorMessage,
          confirmButtonColor: "#487FFF",
        });
      },
    });
  });

  // Delete Student
  $(document).on("click", ".delete-student-js", function () {
    let id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "You want to delete this student? This action cannot be undone!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#487FFF",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        // Show loading
        Swal.fire({
          title: "Deleting...",
          text: "Please wait",
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });

        $.ajax({
          url: baseUrl + "post-login-employee/student/delete-student",
          type: "POST",
          data: { id: id },
          success: function (response) {
            studentTable.ajax.reload();

            Swal.fire({
              icon: "success",
              title: "Deleted!",
              text: response.message || "Student deleted successfully",
              confirmButtonColor: "#487FFF",
              timer: 2000,
            });
          },
          error: function (xhr) {
            let errorMessage = "Error while deleting student.";
            if (xhr.responseJSON && xhr.responseJSON.error) {
              errorMessage = xhr.responseJSON.error;
            }

            Swal.fire({
              icon: "error",
              title: "Error",
              text: errorMessage,
              confirmButtonColor: "#487FFF",
            });
          },
        });
      }
    });
  });

  // Export functionality
  $(document).on("change", "#exportOptions", function () {
    let format = $(this).val();
    if (format) {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });

      Toast.fire({
        icon: "info",
        title: "Exporting data...",
      });

      window.location.href =
        baseUrl +
        "post-login-employee/student/export-students?format=" +
        format +
        "&class_id=" +
        $("#filterClass").val() +
        "&section_id=" +
        $("#filterSection").val();
      $(this).val("");
    }
  });
});
