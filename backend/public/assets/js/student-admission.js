jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();

  // Initialize the file upload plugin
  $("#profileImageUpload").fileUpload();

  // Sync the plugin's file input to our named input
  $(document).on(
    "change",
    '#profileImageUpload input[type="file"]',
    function () {
      console.log("File changed in plugin:", this.files[0]);
      // This will be picked up by FormData automatically
    },
  );

  // Load classes on page load
  loadClasses();

  // Load sections when class is selected
  $("#related_class").on("change", function () {
    loadSections($(this).val());
  });

  // Form submission
  $("#admissionForm").on("submit", function (e) {
    e.preventDefault();
    e.stopPropagation();

    var formData = new FormData(this);

    // MANUALLY ADD THE FILE FROM THE PLUGIN
    var pluginFileInput = $("#profileImageUpload").find(
      'input[type="file"]',
    )[0];
    if (pluginFileInput && pluginFileInput.files[0]) {
      formData.set("profile_image", pluginFileInput.files[0]);
      console.log("Added file manually:", pluginFileInput.files[0]);
    }

    // Remove the empty array entry
    formData.delete("[]");

    // DEBUG: Check formData contents
    console.log("=== FORM DATA DEBUG ===");
    for (let [key, value] of formData.entries()) {
      console.log(key, value);
    }
    console.log("=== END DEBUG ===");

    // Show loading state
    const submitBtn = $(this).find('button[type="submit"]');
    const originalText = submitBtn.html();
    submitBtn
      .prop("disabled", true)
      .html(
        '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...',
      );

    $.ajax({
      url: baseUrl + "post-login-employee/add-student",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        submitBtn.prop("disabled", false).html(originalText);

        console.log("Server response:", response);

        try {
          var result = JSON.parse(response);

          if (result.success || result.message) {
            let messageText = result.message || "Student admitted successfully";
            if (result.image_uploaded) {
              messageText += " with profile image!";
            }

            Swal.fire({
              icon: "success",
              title: "Success!",
              text: messageText,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "OK",
            }).then((result) => {
              if (result.isConfirmed) {
                $("#admissionForm")[0].reset();
                // Reinitialize the upload widget
                $("#profileImageUpload").fileUpload();
              }
            });
          } else if (result.error) {
            Swal.fire({
              icon: "error",
              title: "Error!",
              text: result.error,
              confirmButtonColor: "#d33",
              confirmButtonText: "OK",
            });
          }
        } catch (e) {
          console.error("Parse error:", e);
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "An unexpected error occurred",
            confirmButtonColor: "#d33",
            confirmButtonText: "OK",
          });
        }
      },
      error: function (xhr, status, error) {
        submitBtn.prop("disabled", false).html(originalText);
        console.error("AJAX Error:", error);

        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "An error occurred. Please try again.",
          confirmButtonColor: "#d33",
          confirmButtonText: "OK",
        });
      },
    });

    return false;
  });

  function loadClasses() {
    $.ajax({
      url: baseUrl + "post-login-employee/get-classes",
      type: "POST",
      success: function (response) {
        var classes = JSON.parse(response);
        var options = '<option value="">Select class</option>';
        classes.forEach(function (cls) {
          options +=
            '<option value="' + cls.id + '">' + cls.class_name + "</option>";
        });
        $("#related_class").html(options);
      },
    });
  }

  function loadSections(classId) {
    if (!classId) {
      $("#related_section").html('<option value="">Select section</option>');
      return;
    }

    $.ajax({
      url: baseUrl + "post-login-employee/get-sections",
      type: "POST",
      data: {
        class_id: classId,
      },
      success: function (response) {
        var sections = JSON.parse(response);
        var options = '<option value="">Select section</option>';
        sections.forEach(function (sec) {
          options +=
            '<option value="' + sec.id + '">' + sec.section_label + "</option>";
        });
        $("#related_section").html(options);
      },
    });
  }
});
