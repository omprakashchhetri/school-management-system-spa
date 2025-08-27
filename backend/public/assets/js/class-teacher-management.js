jQuery(document).ready(function () {
  const baseUrl = jQuery("#globalBaseUrl").val();
  jQuery("#classTeacherTable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: baseUrl + "post-login-employee/admin/get-class-teacher-list/",
      type: "POST",
    },
    columns: [
      { data: "checkbox", orderable: false, searchable: false },
      { data: "teacher" },
      { data: "class" },
      { data: "section" },
      { data: "created_at" },
      { data: "updated_at" },
      { data: "actions", orderable: false, searchable: false },
    ],
  });
});
