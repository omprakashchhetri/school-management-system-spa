// exam-routine.js
(function () {
  "use strict";

  // Configuration and State
  const Config = {
    baseUrl: "",
    editExamId: "0",
    classes: [],
    subjects: [],
    endpoints: {
      getAllExams: "post-login-employee/data/examination/get-all-exams",
      getOneExam: "post-login-employee/data/examination/get-one-exam",
      getExamItems: "post-login-employee/data/examination/get-exam-items",
      addExam: "post-login-employee/data/examination/add-exam",
      saveRoutine: "post-login-employee/data/examination/save-exam-routine",
    },
  };

  const State = {
    routineRows: [],
    selectedExam: null,
    rowCounter: 0,
    isEditMode: false,
  };

  // Initialize
  function init() {
    loadConfiguration();
    attachEventListeners();
    loadExams();

    // Check if in edit mode
    State.isEditMode = Config.editExamId !== "0";

    // Update button visibility if in edit mode
    if (State.isEditMode) {
      updateUIForEditMode();
    }

    // If editing, load exam data
    if (Config.editExamId !== "0") {
      loadExamItems(Config.editExamId);
    }
  }

  // Update UI elements for edit mode
  function updateUIForEditMode() {
    // Show the edit current exam button
    $("#editCurrentExamBtn").show();
  }

  // Load configuration from hidden inputs
  function loadConfiguration() {
    Config.baseUrl = $("#baseUrl").val() || "";
    Config.editExamId = $("#pageEditExamId").val() || "0";

    try {
      Config.classes = JSON.parse($("#classesData").val() || "[]");
      Config.subjects = JSON.parse($("#subjectsData").val() || "[]");
    } catch (e) {
      console.error("Error parsing configuration data:", e);
      Config.classes = [];
      Config.subjects = [];
    }
  }

  // Get full URL
  function getUrl(endpoint) {
    return Config.baseUrl + endpoint;
  }

  // Attach event listeners
  function attachEventListeners() {
    // Exam selection change
    $("#examSelect").on("change", handleExamChange);

    // Add date row
    $("#addDateRowBtn").on("click", handleAddDateRow);

    // Add new exam modal (always creates new)
    $("#addExamBtn").on("click", handleAddNewExamClick);

    // Edit current exam modal (only in edit mode)
    $("#editCurrentExamBtn").on("click", handleEditCurrentExamClick);

    $("#confirmAddExamBtn").on("click", handleConfirmAddExam);

    // Save routine
    $("#saveRoutineBtn").on("click", handleSaveRoutine);

    // Dynamic row events (delegated)
    $(document).on("change", ".row-date", handleRowDateChange);
    $(document).on("change", ".row-time", handleRowTimeChange);
    $(document).on("change", ".row-marks", handleRowMarksChange);
    $(document).on("change", ".row-subject", handleRowSubjectChange);
    $(document).on("click", ".delete-row", handleDeleteRow);
  }

  // Load all exams
  function loadExams() {
    $.ajax({
      url: getUrl(Config.endpoints.getAllExams),
      method: "POST",
      dataType: "json",
      success: function (response) {
        if (response && response.length > 0) {
          let options =
            '<option value="" selected disabled>Choose Examination</option>';
          response.forEach(function (exam) {
            const selected = exam.id == Config.editExamId ? "selected" : "";
            options += `<option value="${exam.id}" ${selected}>${exam.exam_title}</option>`;
          });
          $("#examSelect").html(options);

          // Trigger change if editing
          if (Config.editExamId !== "0") {
            $("#examSelect").trigger("change");
          }
        } else {
          $("#examSelect").html(
            '<option value="" disabled>No exams available - Click "Add Exam" to create</option>',
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error loading exams:", error);
        showToast("Error loading exams", "error");
      },
    });
  }

  // Handle exam selection change
  function handleExamChange() {
    const examId = $(this).val();
    if (!examId) return;
    loadExamItems(examId);
  }

  // Load exam details and items
  function loadExamItems(examId) {
    $.ajax({
      url: getUrl(Config.endpoints.getOneExam),
      method: "POST",
      dataType: "json",
      data: { exam_id: examId },
      success: function (response) {
        if (response.error) {
          showToast(response.error, "error");
          return;
        }

        State.selectedExam = response;

        // Display exam details
        $("#displayExamTitle").text(response.exam_title);
        $("#displayStartDate").text(formatDate(response.exam_startdate));
        $("#displayEndDate").text(formatDate(response.exam_enddate));
        $("#displayDescription").text(response.exam_description || "N/A");
        $("#examDetailsDisplay").show();

        // Initialize routine table
        initializeRoutineTable();

        // Load existing routine if any
        loadExistingRoutine(examId);
      },
      error: function (xhr, status, error) {
        console.error("Error loading exam details:", error);
        showToast("Error loading exam details", "error");
      },
    });
  }

  // Initialize routine table with class columns
  function initializeRoutineTable() {
    let headerHtml = `
            <tr>
                <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 130px;">Date</th>
                <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Day</th>
                <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Time</th>
                <th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 100px;">Max Marks</th>
        `;

    Config.classes.forEach(function (cls) {
      headerHtml += `<th class="px-16 py-16 text-gray-900 fw-semibold" style="min-width: 180px;">${cls.class_name}</th>`;
    });

    headerHtml += `<th class="px-16 py-16 text-gray-900 fw-semibold text-center" style="min-width: 80px;">Actions</th></tr>`;

    $("#routineTable thead").html(headerHtml);

    // Clear body
    State.routineRows = [];
    renderRoutineTable();
  }

  // Load existing routine
  function loadExistingRoutine(examId) {
    $.ajax({
      url: getUrl(Config.endpoints.getExamItems),
      method: "POST",
      dataType: "json",
      data: { exam_id: examId },
      success: function (response) {
        if (response && response.length > 0) {
          // Group items by date and time
          const grouped = {};

          response.forEach((item) => {
            const key = `${item.exam_date}_${item.exam_time}_${item.max_marks}`;
            if (!grouped[key]) {
              grouped[key] = {
                exam_date: item.exam_date,
                exam_time: item.exam_time,
                max_marks: item.max_marks,
                subjects: {},
              };
            }
            grouped[key].subjects[item.related_class] = item.related_subject;
          });

          // Convert to rows
          State.routineRows = Object.values(grouped).map((row, index) => ({
            id: State.rowCounter++,
            exam_date: row.exam_date,
            exam_time: row.exam_time,
            max_marks: row.max_marks,
            subjects: row.subjects,
          }));

          renderRoutineTable();
        }
      },
      error: function (xhr, status, error) {
        console.error("Error loading routine:", error);
      },
    });
  }

  // Handle add date row
  function handleAddDateRow() {
    if (!State.selectedExam) {
      showToast("Please select an examination first", "error");
      return;
    }

    const newRow = {
      id: State.rowCounter++,
      exam_date: State.selectedExam.exam_startdate,
      exam_time: "09:00",
      max_marks: 100,
      subjects: {},
    };

    State.routineRows.push(newRow);
    renderRoutineTable();
  }

  // Render routine table
  function renderRoutineTable() {
    if (State.routineRows.length === 0) {
      const colspan = 5 + Config.classes.length;
      $("#routineTableBody").html(`
                <tr class="empty-state">
                    <td colspan="${colspan}" class="text-center py-32">
                        <i class="ph ph-calendar-blank text-gray-300" style="font-size: 48px;"></i>
                        <p class="text-gray-500 mt-8 mb-0">Click "Add Date Row" to start building the routine</p>
                    </td>
                </tr>
            `);
      $("#totalRows").text("0");
      return;
    }

    // Sort by date and time
    State.routineRows.sort((a, b) => {
      const dateCompare = new Date(a.exam_date) - new Date(b.exam_date);
      if (dateCompare !== 0) return dateCompare;
      return a.exam_time.localeCompare(b.exam_time);
    });

    let html = "";
    State.routineRows.forEach(function (row) {
      const date = new Date(row.exam_date);
      const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

      html += `<tr data-row-id="${row.id}">`;

      // Date
      html += `
                <td class="px-16 py-12">
                    <input type="date" class="form-control form-control-sm row-date" 
                           data-row-id="${row.id}" value="${row.exam_date}"
                           min="${State.selectedExam.exam_startdate}" max="${State.selectedExam.exam_enddate}">
                </td>
            `;

      // Day
      html += `<td class="px-16 py-12"><span class="text-gray-600 text-sm">${dayName}</span></td>`;

      // Time
      html += `
                <td class="px-16 py-12">
                    <input type="time" class="form-control form-control-sm row-time" 
                           data-row-id="${row.id}" value="${row.exam_time}">
                </td>
            `;

      // Max Marks
      html += `
                <td class="px-16 py-12">
                    <input type="number" class="form-control form-control-sm row-marks" 
                           data-row-id="${row.id}" value="${row.max_marks}" min="1">
                </td>
            `;

      // Subject columns
      Config.classes.forEach(function (cls) {
        const selectedSubject = row.subjects[cls.id] || "";
        html += `
                    <td class="px-16 py-12">
                        <select class="form-control form-control-sm row-subject" 
                                data-row-id="${row.id}" data-class-id="${cls.id}">
                            <option value="">No Exam</option>
                `;

        Config.subjects.forEach(function (subj) {
          const selected = selectedSubject == subj.id ? "selected" : "";
          html += `<option value="${subj.id}" ${selected}>${subj.subject_name}</option>`;
        });

        html += `</select></td>`;
      });

      // Actions
      html += `
                <td class="px-16 py-12 text-center">
                    <button class="bg-danger-50 text-danger-600 py-4 px-12 rounded-pill hover-bg-danger-600 hover-text-white border-0 delete-row" 
                            data-row-id="${row.id}">
                        <i class="ph ph-trash"></i>
                    </button>
                </td>
            `;

      html += `</tr>`;
    });

    $("#routineTableBody").html(html);
    $("#totalRows").text(State.routineRows.length);
  }

  // Row change handlers
  function handleRowDateChange() {
    const rowId = parseInt($(this).data("row-id"));
    const row = State.routineRows.find((r) => r.id === rowId);
    if (row) {
      row.exam_date = $(this).val();
      renderRoutineTable();
    }
  }

  function handleRowTimeChange() {
    const rowId = parseInt($(this).data("row-id"));
    const row = State.routineRows.find((r) => r.id === rowId);
    if (row) row.exam_time = $(this).val();
  }

  function handleRowMarksChange() {
    const rowId = parseInt($(this).data("row-id"));
    const row = State.routineRows.find((r) => r.id === rowId);
    if (row) row.max_marks = $(this).val();
  }

  function handleRowSubjectChange() {
    const rowId = parseInt($(this).data("row-id"));
    const classId = $(this).data("class-id");
    const subjectId = $(this).val();

    const row = State.routineRows.find((r) => r.id === rowId);
    if (row) {
      if (subjectId) {
        row.subjects[classId] = subjectId;
      } else {
        delete row.subjects[classId];
      }
    }
  }

  function handleDeleteRow() {
    const rowId = parseInt($(this).data("row-id"));
    if (confirm("Are you sure you want to delete this row?")) {
      State.routineRows = State.routineRows.filter((r) => r.id !== rowId);
      renderRoutineTable();
      showToast("Row deleted successfully", "success");
    }
  }

  // Handle Add NEW Exam (always creates new)
  function handleAddNewExamClick() {
    $("#examModalTitle").text("Add New Examination");
    $("#confirmExamBtnText").text("Create Exam");
    $("#modalExamId").val("0");
    $("#newExamTitle").val("");
    $("#newExamDescription").val("");
    $("#newExamStartDate").val("");
    $("#newExamEndDate").val("");
    $("#addExamModal").modal("show");
  }

  // Handle Edit Current Exam (only in edit mode)
  function handleEditCurrentExamClick() {
    if (!State.selectedExam) {
      showToast("No exam selected to edit", "error");
      return;
    }

    $("#examModalTitle").text("Edit Examination");
    $("#confirmExamBtnText").text("Update Exam");
    $("#modalExamId").val(State.selectedExam.id);
    $("#newExamTitle").val(State.selectedExam.exam_title);
    $("#newExamDescription").val(State.selectedExam.exam_description || "");
    $("#newExamStartDate").val(State.selectedExam.exam_startdate);
    $("#newExamEndDate").val(State.selectedExam.exam_enddate);
    $("#addExamModal").modal("show");
  }

  function handleConfirmAddExam() {
    const title = $("#newExamTitle").val().trim();
    const description = $("#newExamDescription").val().trim();
    const startDate = $("#newExamStartDate").val();
    const endDate = $("#newExamEndDate").val();
    const examId = $("#modalExamId").val() || "0";

    if (!title || !startDate || !endDate) {
      showToast("Please fill all required fields", "error");
      return;
    }

    if (new Date(startDate) > new Date(endDate)) {
      showToast("Start date must be before end date", "error");
      return;
    }

    const examData = {
      exam_title: title,
      exam_description: description,
      exam_startdate: startDate,
      exam_enddate: endDate,
      exam_id: examId,
    };

    const $btn = $("#confirmAddExamBtn");
    const isUpdate = examId !== "0";
    const loadingText = isUpdate ? "Updating..." : "Creating...";
    const btnText = isUpdate ? "Update Exam" : "Create Exam";

    $btn
      .prop("disabled", true)
      .html(`<i class="ph ph-spinner ph-spin me-8"></i>${loadingText}`);

    $.ajax({
      url: getUrl(Config.endpoints.addExam),
      method: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify(examData),
      success: function (response) {
        if (response.error) {
          showToast(response.error, "error");
        } else {
          const successMsg = isUpdate
            ? "Exam updated successfully"
            : "Exam created successfully";
          showToast(response.message || successMsg, "success");
          $("#addExamModal").modal("hide");

          // Reload exams
          loadExams();

          // If we just updated the current exam, reload its details
          if (
            isUpdate &&
            State.selectedExam &&
            State.selectedExam.id == examId
          ) {
            setTimeout(() => {
              loadExamItems(examId);
            }, 500);
          }
        }
      },
      error: function (xhr, status, error) {
        console.error("Error saving exam:", error);
        showToast("Failed to save exam", "error");
      },
      complete: function () {
        $btn.prop("disabled", false).html(btnText);
      },
    });
  }

  // Save routine handler
  function handleSaveRoutine() {
    if (!State.selectedExam) {
      showToast("Please select an examination first", "error");
      return;
    }

    if (State.routineRows.length === 0) {
      showToast("Please add at least one routine row", "error");
      return;
    }

    const examItems = [];
    State.routineRows.forEach((row) => {
      Object.keys(row.subjects).forEach((classId) => {
        const subjectId = row.subjects[classId];
        if (subjectId) {
          examItems.push({
            related_class: parseInt(classId),
            related_subject: parseInt(subjectId),
            exam_date: row.exam_date,
            exam_time: row.exam_time,
            max_marks: parseInt(row.max_marks),
          });
        }
      });
    });

    if (examItems.length === 0) {
      showToast("Please select at least one subject for any class", "error");
      return;
    }

    const routineData = {
      exam_id: State.selectedExam.id,
      exam_items: examItems,
    };

    const $btn = $("#saveRoutineBtn");
    $btn
      .prop("disabled", true)
      .html('<i class="ph ph-spinner ph-spin me-8"></i>Saving...');

    $.ajax({
      url: getUrl(Config.endpoints.saveRoutine),
      method: "POST",
      dataType: "json",
      contentType: "application/json",
      data: JSON.stringify(routineData),
      success: function (response) {
        if (response.error) {
          showToast(response.error, "error");
        } else {
          showToast(
            response.message || "Routine saved successfully",
            "success",
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error saving routine:", error);
        showToast("Failed to save routine", "error");
      },
      complete: function () {
        $btn
          .prop("disabled", false)
          .html('<i class="ph ph-floppy-disk me-8"></i>Save Routine');
      },
    });
  }

  // Utility functions
  function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString("en-US", {
      month: "short",
      day: "2-digit",
      year: "numeric",
    });
  }

  function showToast(message, type = "info") {
    if (typeof toastr !== "undefined") {
      toastr[type](message);
    } else {
      alert(message);
    }
  }

  // Initialize on document ready
  $(document).ready(init);
})();
