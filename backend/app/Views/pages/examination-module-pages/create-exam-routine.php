<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Examination Routine</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-main text-sm btn-sm px-24 py-12 rounded-8">
                <i class="ph ph-plus me-8"></i>
                Save Routine
            </button>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <!-- Filter Section Start -->
    <div class="card mb-24">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gray-900">Select Examination</label>
                    <div
                        class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                        <span class="text-lg"><i class="ph ph-exam"></i></span>
                        <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4" id="examSelect">
                            <option value="" selected disabled>Choose Examination</option>
                            <option value="1">First Terminal Exam 2026</option>
                            <option value="2">Mid-Term Exam 2026</option>
                            <option value="3">Final Exam 2026</option>
                            <option value="4">Annual Exam 2026</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gray-900">Start Date</label>
                    <input type="date" class="form-control py-16 px-20 border border-gray-100 rounded-4" id="startDate">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-gray-900">End Date</label>
                    <input type="date" class="form-control py-16 px-20 border border-gray-100 rounded-4" id="endDate">
                </div>
            </div>
        </div>
    </div>
    <!-- Filter Section End -->

    <!-- Routine Table Section Start -->
    <div class="card overflow-hidden">
        <div class="card-header flex-between flex-wrap gap-8">
            <h6 class="text-lg mb-0">Examination Routine Builder</h6>
            <div class="flex-align gap-8 flex-wrap">
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-layout"></i></span>
                    <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center"
                        id="exportOptions">
                        <option value="" selected disabled>Export</option>
                        <option value="csv">CSV</option>
                        <option value="json">JSON</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body px-2">
            <div class="table-responsive">
                <table class="table table-striped dataTable" id="routineTable">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Date</th>
                            <th class="h6 text-gray-300">Day</th>
                            <th class="h6 text-gray-300">Class 1</th>
                            <th class="h6 text-gray-300">Class 2</th>
                            <th class="h6 text-gray-300">Class 3</th>
                            <th class="h6 text-gray-300">Class 4</th>
                            <th class="h6 text-gray-300">Class 5</th>
                            <th class="h6 text-gray-300">Class 6</th>
                            <th class="h6 text-gray-300">Class 7</th>
                            <th class="h6 text-gray-300">Class 8</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">Feb 01, 2026</span>
                            </td>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">Monday</span>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <button
                                    class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white border-0">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">Feb 02, 2026</span>
                            </td>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">Tuesday</span>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <button
                                    class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white border-0">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">Feb 03, 2026</span>
                            </td>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">Wednesday</span>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control py-8 px-12 border border-gray-100 rounded-4 text-13">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="1">Mathematics</option>
                                    <option value="2">English</option>
                                    <option value="3">Science</option>
                                    <option value="4">Social Studies</option>
                                    <option value="5">Hindi</option>
                                </select>
                            </td>
                            <td>
                                <button
                                    class="bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-danger-600 hover-text-white border-0">
                                    <i class="ph ph-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer flex-between flex-wrap">
            <button class="btn btn-outline-main text-sm btn-sm px-24 py-12 rounded-8">
                <i class="ph ph-plus me-8"></i>
                Add New Date
            </button>
            <span class="text-gray-900">Total Exam Days: 3</span>
        </div>
    </div>
    <!-- Routine Table Section End -->
</div>