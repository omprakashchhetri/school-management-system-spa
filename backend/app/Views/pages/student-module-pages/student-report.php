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
                    <span class="text-main-600 fw-normal text-15">Report Card</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                <span class="text-inherit">Filter by Class: </span>
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-funnel-simple"></i></span>
                    <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center"
                        id="classFilter">
                        <option value="all" selected>All Classes</option>
                        <option value="class-10">Class 10</option>
                        <option value="class-9">Class 9</option>
                        <option value="class-8">Class 8</option>
                        <option value="class-7">Class 7</option>
                    </select>
                </div>
            </div>
            <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                <span class="text-inherit">Filter by Exam: </span>
                <div
                    class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-graduation-cap"></i></span>
                    <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center"
                        id="examFilter">
                        <option value="all" selected>All Exams</option>
                        <option value="midterm">Mid Term</option>
                        <option value="final">Final Exam</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="unit-test">Unit Test</option>
                    </select>
                </div>
            </div>
            <div
                class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-download-simple"></i></span>
                <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center"
                    id="exportOptions">
                    <option value="" selected disabled>Export</option>
                    <option value="csv">CSV</option>
                    <option value="pdf">PDF</option>
                    <option value="json">JSON</option>
                </select>
            </div>
        </div>
        <!-- Breadcrumb Right End -->
    </div>

    <div class="card overflow-hidden">
        <div class="card-body p-0 overflow-x-auto">
            <table id="reportCardTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                    id="selectAll" />
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Student Name</th>
                        <th class="h6 text-gray-300">Class</th>
                        <th class="h6 text-gray-300">Roll No</th>
                        <th class="h6 text-gray-300">Exam Type</th>
                        <th class="h6 text-gray-300">Mathematics</th>
                        <th class="h6 text-gray-300">Science</th>
                        <th class="h6 text-gray-300">English</th>
                        <th class="h6 text-gray-300">Total Marks</th>
                        <th class="h6 text-gray-300">Percentage</th>
                        <th class="h6 text-gray-300">Grade</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img1.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Jane Cooper</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 10</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">101</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Mid Term</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">85</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">92</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">88</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">265/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">88.3%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                A+
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img2.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Guy Hawkins</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 10</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">102</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Mid Term</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">78</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">82</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">75</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">235/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">78.3%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                B+
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img3.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Dianne Russell</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 9</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">201</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Final Exam</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">95</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">98</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">94</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">287/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">95.7%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                A+
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img4.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Ronald Richards</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 8</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">301</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Quarterly</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">65</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">72</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">68</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">205/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">68.3%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                C+
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img5.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Jenny Wilson</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 10</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">103</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Final Exam</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">90</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">88</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">92</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">270/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">90.0%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                A+
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img1.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Devon Lane</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 9</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">202</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Unit Test</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">82</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">79</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">85</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">246/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">82.0%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                A
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img2.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Eleanor Pena</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 7</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">401</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Mid Term</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">88</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">91</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">87</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">266/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">88.7%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                A+
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img3.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Robert Fox</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 8</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">302</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Mid Term</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">58</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">62</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">55</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">175/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">58.3%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-danger-600 rounded-circle flex-shrink-0"></span>
                                D
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img4.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Jacob Jones</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 10</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">104</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Quarterly</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">76</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">80</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">73</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">229/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">76.3%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                B
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="assets/images/thumbs/student-img5.png" alt=""
                                    class="w-40 h-40 rounded-circle" />
                                <span class="h6 mb-0 fw-medium text-gray-300">Courtney Henry</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Class 9</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">203</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">Final Exam</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">84</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">86</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">81</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">251/300</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">83.7%</span>
                        </td>
                        <td>
                            <span
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                A
                            </span>
                        </td>
                        <td>
                            <a href="#"
                                class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View
                                Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer flex-between flex-wrap">
            <span class="text-gray-900">Showing 1 to 10 of 45 entries</span>
            <ul class="pagination flex-align flex-wrap">
                <li class="page-item active">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">5</a>
                </li>
            </ul>
        </div>
    </div>
</div>