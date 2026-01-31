$(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();
  const employeeId = jQuery("#employeeId").val();
  const page = jQuery("#pageType").val() || "details";
  let route = "admin/employee-details/" + employeeId;
  if (page == "profile") {
    route = "employee/profile";
  }

  // Unbind all events first to prevent multiplication
  $("#profileImageUpload").off("change");
  $("#coverImageUpload").off("change");
  $("#editPersonalBtn").off("click");
  $("#editProfessionalBtn").off("click");
  $(".btn-cancel-personal").off("click");
  $(".btn-cancel-professional").off("click");
  $("#personalInfoForm").off("submit");
  $("#professionalInfoForm").off("submit");
  $("#uploadDocumentBtn").off("click");
  $("#uploadDocumentModal").off("hidden.bs.modal");
  $(document).off("click", ".delete-document-js");
  $(document).off("click", ".update-status-js");
  $(document).off("click", "#saveSubjectAllocationBtn");
  $(document).off("click", ".edit-subject-allocation-js");
  $(document).off("click", "#updateSubjectAllocationBtn");
  $(document).off("click", ".delete-subject-allocation-js");

  // Profile Image Upload
  $("#profileImageUpload").on("change", function (e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validate file type
    const validTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    if (!validTypes.includes(file.type)) {
      Swal.fire({
        icon: "error",
        title: "Invalid File Type",
        text: "Please upload a valid image file (JPEG, JPG, PNG, or GIF)",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    // Validate file size (2MB max)
    if (file.size > 2048 * 1024) {
      Swal.fire({
        icon: "error",
        title: "File Too Large",
        text: "Please upload an image smaller than 2MB",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    // Show preview
    const reader = new FileReader();
    reader.onload = function (event) {
      $("#profileImageDisplay").attr("src", event.target.result);
    };
    reader.readAsDataURL(file);

    // Upload image
    const formData = new FormData();
    formData.append("image", file);
    formData.append("employee_id", employeeId);

    $.ajax({
      url: baseUrl + "post-login-employee/admin/upload-employee-profile-image",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      beforeSend: function () {
        Swal.fire({
          title: "Uploading...",
          text: "Please wait while we upload your image",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
      },
      success: function (response) {
        if (response.message && response.url) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonColor: "#487FFF",
          }).then(() => {
            $("#profileImageDisplay").attr("src", response.url);
          });
        } else if (response.error) {
          Swal.fire({
            icon: "error",
            title: "Upload Failed",
            text:
              typeof response.error === "object"
                ? Object.values(response.error).join(", ")
                : response.error,
            confirmButtonColor: "#487FFF",
          });
          $("#profileImageUpload").val("");
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Upload Failed",
          text: "An error occurred while uploading the image",
          confirmButtonColor: "#487FFF",
        });
        $("#profileImageUpload").val("");
      },
    });
  });

  // Cover Image Upload
  $("#coverImageUpload").on("change", function (e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validate file type
    const validTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    if (!validTypes.includes(file.type)) {
      Swal.fire({
        icon: "error",
        title: "Invalid File Type",
        text: "Please upload a valid image file (JPEG, JPG, PNG, or GIF)",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    // Validate file size (2MB max)
    if (file.size > 2048 * 1024) {
      Swal.fire({
        icon: "error",
        title: "File Too Large",
        text: "Please upload an image smaller than 2MB",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    // Show preview
    const reader = new FileReader();
    reader.onload = function (event) {
      $("#coverImagePreview").css(
        "background-image",
        "url(" + event.target.result + ")",
      );
    };
    reader.readAsDataURL(file);

    // Upload image
    const formData = new FormData();
    formData.append("image", file);
    formData.append("employee_id", employeeId);

    $.ajax({
      url: baseUrl + "post-login-employee/admin/upload-employee-cover-image",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      beforeSend: function () {
        Swal.fire({
          title: "Uploading...",
          text: "Please wait while we upload your image",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
      },
      success: function (response) {
        if (response.message && response.url) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonColor: "#487FFF",
          }).then(() => {
            $("#coverImagePreview").css(
              "background-image",
              "url(" + response.url + ")",
            );
          });
        } else if (response.error) {
          Swal.fire({
            icon: "error",
            title: "Upload Failed",
            text:
              typeof response.error === "object"
                ? Object.values(response.error).join(", ")
                : response.error,
            confirmButtonColor: "#487FFF",
          });
          $("#coverImageUpload").val("");
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Upload Failed",
          text: "An error occurred while uploading the image",
          confirmButtonColor: "#487FFF",
        });
        $("#coverImageUpload").val("");
      },
    });
  });

  // Edit Mode Toggle for Personal Information
  $("#editPersonalBtn").on("click", function () {
    $("#personalInfoForm input").each(function () {
      $(this).prop("readonly", false);
      $(this).removeClass("form-control-plaintext").addClass("form-control");
    });
    $(".personal-form-actions").show();
    $(this).hide();
  });

  // Edit Mode Toggle for Professional Information
  $("#editProfessionalBtn").on("click", function () {
    $("#professionalInfoForm select").prop("disabled", false);
    $(".professional-form-actions").show();
    $(this).hide();
  });

  // Cancel Personal Info Edit
  $(".btn-cancel-personal").on("click", function (e) {
    e.preventDefault();
    navigateTo(route, false);
  });

  // Cancel Professional Info Edit
  $(".btn-cancel-professional").on("click", function (e) {
    e.preventDefault();
    navigateTo(route, false);
  });

  // Handle Personal Information Form Submit
  $("#personalInfoForm").on("submit", function (e) {
    e.preventDefault();

    const formData = {
      employee_id: employeeId,
      firstname: $("#fname").val(),
      lastname: $("#lname").val(),
      middlename: $("#mname").val(),
      email1: $("#email").val(),
      email2: $("#email2").val(),
      contact_number1: $("#phone").val(),
      contact_number2: $("#phone2").val(),
      street: $("#street").val(),
      city: $("#city").val(),
      district: $("#district").val(),
      pincode: $("#pincode").val(),
      country: $("#country").val(),
    };

    $.ajax({
      url: baseUrl + "post-login-employee/admin/update-employee-details",
      type: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        $('#personalInfoForm button[type="submit"]')
          .prop("disabled", true)
          .html(
            '<span class="spinner-border spinner-border-sm me-2"></span>Saving...',
          );
      },
      success: function (response) {
        if (response.message) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonColor: "#487FFF",
          }).then(() => {
            navigateTo(route, false);
          });
        } else if (response.error) {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.error,
            confirmButtonColor: "#487FFF",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Failed to update employee details",
          confirmButtonColor: "#487FFF",
        });
      },
      complete: function () {
        $('#personalInfoForm button[type="submit"]')
          .prop("disabled", false)
          .text("Save Changes");
      },
    });
  });

  // Handle Professional Information Form Submit
  $("#professionalInfoForm").on("submit", function (e) {
    e.preventDefault();

    const formData = {
      employee_id: employeeId,
      role_id: $("#role_id").val(),
    };

    $.ajax({
      url: baseUrl + "post-login-employee/admin/update-employee-details",
      type: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        $('#professionalInfoForm button[type="submit"]')
          .prop("disabled", true)
          .html(
            '<span class="spinner-border spinner-border-sm me-2"></span>Saving...',
          );
      },
      success: function (response) {
        if (response.message) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonColor: "#487FFF",
          }).then(() => {
            navigateTo(route, false);
          });
        } else if (response.error) {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.error,
            confirmButtonColor: "#487FFF",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Failed to update professional information",
          confirmButtonColor: "#487FFF",
        });
      },
      complete: function () {
        $('#professionalInfoForm button[type="submit"]')
          .prop("disabled", false)
          .text("Save Changes");
      },
    });
  });

  // Initialize - Make fields readonly on page load
  function initializeReadonlyState() {
    $("#personalInfoForm input").each(function () {
      $(this).prop("readonly", true);
      $(this).removeClass("form-control").addClass("form-control-plaintext");
    });
    $("#professionalInfoForm select").prop("disabled", true);
    $(".personal-form-actions").hide();
    $(".professional-form-actions").hide();
  }

  initializeReadonlyState();

  // Upload Document
  $("#uploadDocumentBtn").on("click", function () {
    const documentType = $("#documentType").val();
    const documentName = $("#documentName").val();
    const documentFile = $("#documentFile")[0].files[0];

    if (!documentType || !documentName || !documentFile) {
      Swal.fire({
        icon: "warning",
        title: "Missing Information",
        text: "Please fill all required fields",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    // Validate file size (5MB)
    if (documentFile.size > 5120 * 1024) {
      Swal.fire({
        icon: "error",
        title: "File Too Large",
        text: "Please upload a document smaller than 5MB",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    const formData = new FormData();
    formData.append("document", documentFile);
    formData.append("employee_id", employeeId);
    formData.append("document_type", documentType);
    formData.append("document_name", documentName);

    $.ajax({
      url: baseUrl + "post-login-employee/admin/upload-employee-document",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "json",
      beforeSend: function () {
        $("#uploadDocumentBtn")
          .prop("disabled", true)
          .html(
            '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...',
          );
      },
      success: function (response) {
        if (response.message) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
            confirmButtonColor: "#487FFF",
          }).then(() => {
            $("#uploadDocumentModal").modal("hide");
            navigateTo(route);
          });
        } else if (response.error) {
          Swal.fire({
            icon: "error",
            title: "Upload Failed",
            text:
              typeof response.error === "object"
                ? Object.values(response.error).join(", ")
                : response.error,
            confirmButtonColor: "#487FFF",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Upload Failed",
          text: "An error occurred while uploading the document",
          confirmButtonColor: "#487FFF",
        });
      },
      complete: function () {
        $("#uploadDocumentBtn")
          .prop("disabled", false)
          .html('<i class="ph ph-upload me-8"></i>Upload Document');
      },
    });
  });

  // Reset modal on close
  $("#uploadDocumentModal").on("hidden.bs.modal", function () {
    $("#uploadDocumentForm")[0].reset();
  });

  // Delete Document (using event delegation)
  $(document).on("click", ".delete-document-js", function () {
    const documentId = $(this).data("document-id");
    const row = $('tr[data-document-id="' + documentId + '"]');

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#487FFF",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: baseUrl + "post-login-employee/admin/delete-employee-document",
          type: "POST",
          data: { document_id: documentId },
          dataType: "json",
          success: function (response) {
            if (response.message) {
              Swal.fire({
                icon: "success",
                title: "Deleted!",
                text: response.message,
                confirmButtonColor: "#487FFF",
              }).then(() => {
                row.fadeOut(300, function () {
                  $(this).remove();
                  if ($("#documentsTable tbody tr").length === 0) {
                    navigateTo(route, false);
                  }
                });
              });
            } else if (response.error) {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: response.error,
                confirmButtonColor: "#487FFF",
              });
            }
          },
          error: function (xhr, status, error) {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Failed to delete document",
              confirmButtonColor: "#487FFF",
            });
          },
        });
      }
    });
  });

  // Update Document Status (using event delegation)
  $(document).on("click", ".update-status-js", function () {
    const documentId = $(this).data("document-id");
    const status = $(this).data("status");
    const row = $('tr[data-document-id="' + documentId + '"]');

    $.ajax({
      url: baseUrl + "post-login-employee/admin/update-document-status",
      type: "POST",
      data: {
        document_id: documentId,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        if (response.message) {
          let statusClass = "warning";
          let statusText = "Pending";

          if (status === "verified") {
            statusClass = "success";
            statusText = "Verified";
          } else if (status === "rejected") {
            statusClass = "danger";
            statusText = "Rejected";
          }

          row
            .find(".document-status")
            .removeClass(
              "text-success-600 bg-success-100 text-warning-600 bg-warning-100 text-danger-600 bg-danger-100",
            )
            .addClass("text-" + statusClass + "-600 bg-" + statusClass + "-100")
            .text(statusText);

          Swal.fire({
            icon: "success",
            title: "Updated!",
            text: response.message,
            confirmButtonColor: "#487FFF",
            timer: 1500,
            showConfirmButton: false,
          });
        } else if (response.error) {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.error,
            confirmButtonColor: "#487FFF",
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Failed to update document status",
          confirmButtonColor: "#487FFF",
        });
      },
    });
  });

  // Add Subject Allocation (using event delegation)
  $(document).on("click", "#saveSubjectAllocationBtn", function () {
    let classVal = $("#classSubAllo").val();
    let section = $("#sectionSubAllo").val();
    let teacher = $("#teacherSubAllo").val();
    let subject = $("#subjectSubAllo").val();

    if (!classVal || !section || !teacher || !subject) {
      Swal.fire({
        icon: "warning",
        title: "Missing Fields",
        text: "All fields are required.",
        confirmButtonColor: "#487FFF",
      });
      return;
    }

    $.ajax({
      url: baseUrl + "post-login-employee/admin/add-subject-allocation",
      type: "POST",
      data: { class: classVal, section, teacher, subject },
      beforeSend: function () {
        Swal.fire({
          title: "Adding...",
          text: "Please wait",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
      },
      success: function (response) {
        $("#addSubjectAllocationModal").modal("hide");
        Swal.fire({
          icon: "success",
          title: "Success",
          text: "Subject allocation added successfully",
          confirmButtonColor: "#487FFF",
          timer: 2000,
        }).then(() => {
          navigateTo(route, false);
        });
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Error while adding subject allocation.",
          confirmButtonColor: "#487FFF",
        });
      },
    });
  });

  // Open Edit Modal for Subject Allocation (using event delegation)
  $(document).on("click", ".edit-subject-allocation-js", function () {
    let id = $(this).data("id");
    let classVal = $(this).data("class");
    let section = $(this).data("section");
    let teacher = $(this).data("teacher");
    let subject = $(this).data("subject");

    $("#editSubjectAllocationModal").data("record-id", id);
    $("#edit_class").val(classVal);
    $("#edit_section").val(section);
    $("#edit_teacher").val(teacher);
    $("#edit_subject").val(subject);

    $("#editSubjectAllocationModal").modal("show");
  });

  // Update Subject Allocation (using event delegation)
  $(document).on("click", "#updateSubjectAllocationBtn", function () {
    let id = $("#editSubjectAllocationModal").data("record-id");
    let classVal = $("#edit_class").val();
    let section = $("#edit_section").val();
    let teacher = $("#edit_teacher").val();
    let subject = $("#edit_subject").val();

    $.ajax({
      url: baseUrl + "post-login-employee/admin/edit-subject-allocation",
      type: "POST",
      data: { id, class: classVal, section, teacher, subject },
      beforeSend: function () {
        Swal.fire({
          title: "Updating...",
          text: "Please wait",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });
      },
      success: function (response) {
        $("#editSubjectAllocationModal").modal("hide");
        Swal.fire({
          icon: "success",
          title: "Success",
          text: "Subject allocation updated successfully",
          confirmButtonColor: "#487FFF",
          timer: 2000,
        }).then(() => {
          navigateTo(route, false);
        });
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Error while updating subject allocation.",
          confirmButtonColor: "#487FFF",
        });
      },
    });
  });

  // Delete Subject Allocation (using event delegation)
  $(document).on("click", ".delete-subject-allocation-js", function () {
    let id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#487FFF",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: baseUrl + "post-login-employee/admin/delete-subject-allocation",
          type: "POST",
          data: { id: id },
          beforeSend: function () {
            Swal.fire({
              title: "Deleting...",
              text: "Please wait",
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              },
            });
          },
          success: function (response) {
            Swal.fire({
              icon: "success",
              title: "Deleted!",
              text: "Subject allocation has been deleted.",
              confirmButtonColor: "#487FFF",
              timer: 2000,
            }).then(() => {
              navigateTo(route, false);
            });
          },
          error: function () {
            Swal.fire({
              icon: "error",
              title: "Error!",
              text: "Error while deleting subject allocation.",
              confirmButtonColor: "#487FFF",
            });
          },
        });
      }
    });
  });
});
