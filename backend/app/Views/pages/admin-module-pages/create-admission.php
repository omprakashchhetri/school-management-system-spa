<!-- file upload -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/file-upload.css" />

<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li>
                    <a href="<?=base_url()?>" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a>
                </li>
                <li>
                    <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                </li>
                <li>
                    <span class="text-main-600 fw-normal text-15">Student Admission</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->
    </div>

    <!-- Success/Error Message -->
    <div id="message-alert" style="display: none;" class="alert alert-dismissible fade show" role="alert">
        <span id="message-text"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Admission Form Start -->
    <div class="card">
        <div class="card-header border-bottom border-gray-100 flex-align gap-8">
            <h5 class="mb-0">Student Admission Form</h5>
        </div>
        <div class="card-body">
            <form id="admissionForm" enctype="multipart/form-data">
                <div class="row gy-20">

                    <!-- Profile Image -->
                    <div class="col-12">
                        <h6 class="mb-16 fw-bold">Profile Image</h6>
                    </div>
                    <div class="col-xxl-3 col-md-4 col-sm-5">
                        <label class="h5 fw-semibold font-heading mb-8">Profile Photo</label>
                        <!-- Add data-input-name attribute -->
                        <div id="profileImageUpload" class="fileUpload image-upload" data-input-name="profile_image">
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="col-12">
                        <h6 class="mb-16 fw-bold border-top pt-16">Personal Information</h6>
                    </div>

                    <div class="col-sm-4">
                        <label for="firstname" class="h5 mb-8 fw-semibold font-heading">First Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control py-11" name="firstname" required />
                    </div>

                    <div class="col-sm-4">
                        <label for="middlename" class="h5 mb-8 fw-semibold font-heading">Middle Name</label>
                        <input type="text" class="form-control py-11" name="middlename" />
                    </div>

                    <div class="col-sm-4">
                        <label for="lastname" class="h5 mb-8 fw-semibold font-heading">Last Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control py-11" name="lastname" required />
                    </div>

                    <div class="col-sm-4">
                        <label class="h5 mb-8 fw-semibold font-heading">Blood Group</label>
                        <select name="blood_group" class="form-select py-9 text-15">
                            <option value="">Select blood group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="h5 mb-8 fw-semibold font-heading">Religion</label>
                        <select class="form-control py-11" name="student_religion">
                            <option value="">Select Religion</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Christian">Christian</option>
                            <option value="Sikh">Sikh</option>
                            <option value="Buddhist">Buddhist</option>
                            <option value="Jain">Jain</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Caste</label>
                        <select class="form-control py-11" name="student_caste">
                            <option value="">Select Caste</option>
                            <option value="General">General</option>
                            <option value="OBC">OBC</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>


                    <!-- Contact Information -->
                    <div class="col-12">
                        <h6 class="mb-16 fw-bold border-top pt-16">Contact Information</h6>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Contact Number <span
                                class="text-danger">*</span></label>
                        <input type="tel" class="form-control py-11" name="student_contact_no" required />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Email Address <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control py-11" name="student_email" required />
                    </div>

                    <!-- Address Information -->
                    <div class="col-12">
                        <h6 class="mb-16 fw-bold border-top pt-16">Address Information</h6>
                    </div>

                    <div class="col-sm-12">
                        <label class="h5 mb-8 fw-semibold font-heading">Street Address</label>
                        <input type="text" class="form-control py-11" name="street" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">City</label>
                        <input type="text" class="form-control py-11" name="city" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">District</label>
                        <input type="text" class="form-control py-11" name="district" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Pincode</label>
                        <input type="text" class="form-control py-11" name="pincode" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Country</label>
                        <input type="text" class="form-control py-11" name="country" value="India" />
                    </div>

                    <!-- Academic Information -->
                    <div class="col-12">
                        <h6 class="mb-16 fw-bold border-top pt-16">Academic Information</h6>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Class <span class="text-danger">*</span></label>
                        <select name="related_class" id="related_class" class="form-select py-9 text-15" required>
                            <option value="">Select class</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Section <span
                                class="text-danger">*</span></label>
                        <select name="related_section" id="related_section" class="form-select py-9 text-15" required>
                            <option value="">Select section</option>
                        </select>
                    </div>

                    <!-- Parent Information -->
                    <div class="col-12">
                        <h6 class="mb-16 fw-bold border-top pt-16">Parent/Guardian Information</h6>
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Father's Name</label>
                        <input type="text" class="form-control py-11" name="father_name" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Father's Contact</label>
                        <input type="tel" class="form-control py-11" name="father_contact_no" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Mother's Name</label>
                        <input type="text" class="form-control py-11" name="mother_name" />
                    </div>

                    <div class="col-sm-6">
                        <label class="h5 mb-8 fw-semibold font-heading">Mother's Contact</label>
                        <input type="tel" class="form-control py-11" name="mother_contact_no" />
                    </div>

                    <!-- Form Actions -->
                    <div class="col-12 border-top pt-16">
                        <div class="flex-align justify-content-end gap-8">
                            <button type="reset" class="btn btn-outline-danger rounded-pill py-9">Reset</button>
                            <button type="submit" class="btn btn-main rounded-pill py-9">
                                <span class="btn-text">Submit Admission</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url()?>assets/js/file-upload.js"></script>
<script src="<?= base_url('assets/plugins/sweetalert/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('assets/js/student-admission.js') ?>"></script>