    <div class="dashboard-body">
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
                    <span class="text-main-600 fw-normal text-15">Profile</span>
                </li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="cover-img position-relative">
                    <label for="coverImageUpload"
                        class="btn border-gray-200 text-gray-200 fw-normal hover-bg-gray-400 rounded-pill py-4 px-14 position-absolute inset-block-start-0 inset-inline-end-0 mt-24 me-24">Edit
                        Cover</label>
                    <div class="avatar-upload">
                        <input type="file" id="coverImageUpload" accept=".png, .jpg, .jpeg" />
                        <div class="avatar-preview">
                            <div id="coverImagePreview" style="
                    background-image: url('<?=base_url()?>assets/images/thumbs/setting-cover-img.png');
                "></div>
                        </div>
                    </div>
                </div>

                <div class="setting-profile px-24">
                    <div class="flex-between">
                        <div class="d-flex align-items-end flex-wrap mb-32 gap-24">
                            <img src="<?=base_url()?>assets/images/thumbs/setting-profile-img.jpg" alt=""
                                class="w-120 h-120 rounded-circle border border-white" />
                            <div>
                                <h4 class="mb-8">Mohid Khan</h4>
                                <div class="setting-profile__infos flex-align flex-wrap gap-16">
                                    <div class="flex-align gap-6">
                                        <span class="text-gray-600 d-flex text-lg"><i class="ph ph-swatches"></i></span>
                                        <span class="text-gray-600 d-flex text-15">Class 10</span>
                                    </div>
                                    <div class="flex-align gap-6">
                                        <span class="text-gray-600 d-flex text-lg"><i class="ph ph-map-pin"></i></span>
                                        <span class="text-gray-600 d-flex text-15">Siliguri</span>
                                    </div>
                                    <div class="flex-align gap-6">
                                        <span class="text-gray-600 d-flex text-lg"><i
                                                class="ph ph-calendar-dots"></i></span>
                                        <span class="text-gray-600 d-flex text-15">Join August 2024</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav common-tab style-two nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-details-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                                aria-selected="true">
                                My Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password"
                                aria-selected="false">
                                Password
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- My Details Tab start -->
            <div class="tab-pane fade show active" id="pills-details" role="tabpanel"
                aria-labelledby="pills-details-tab" tabindex="0">
                <div class="card mt-24">
                    <div class="card-header border-bottom">
                        <h4 class="mb-4">My Details</h4>
                        <p class="text-gray-600 text-15">
                            Please fill full details about yourself
                        </p>
                    </div>
                    <div class="card-body">
                        <form action="setting.html#">
                            <div class="row gy-4">
                                <div class="col-sm-6 col-xs-6">
                                    <label for="fname" class="form-label mb-8 h6">First Name</label>
                                    <input type="text" class="form-control py-11" id="fname"
                                        placeholder="Enter First Name" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="lname" class="form-label mb-8 h6">Last Name</label>
                                    <input type="text" class="form-control py-11" id="lname"
                                        placeholder="Enter Last Name" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="email" class="form-label mb-8 h6">Email</label>
                                    <input type="email" class="form-control py-11" id="email"
                                        placeholder="Enter Email" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="phone" class="form-label mb-8 h6">Phone Number</label>
                                    <input type="number" class="form-control py-11" id="phone"
                                        placeholder="Enter Phone Number" />
                                </div>
                                <div class="col-12">
                                    <label for="imageUpload" class="form-label mb-8 h6">Your Photo</label>
                                    <div class="flex-align gap-22">
                                        <div class="avatar-upload flex-shrink-0">
                                            <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <div class="avatar-preview">
                                                <div id="profileImagePreview" style="
                            background-image: url('assets/images/thumbs/setting-profile-img.jpg');
                            "></div>
                                            </div>
                                        </div>
                                        <div
                                            class="avatar-upload-box text-center position-relative flex-grow-1 py-24 px-4 rounded-16 border border-main-300 border-dashed bg-main-50 hover-bg-main-100 hover-border-main-400 transition-2 cursor-pointer">
                                            <label for="imageUpload"
                                                class="position-absolute inset-block-start-0 inset-inline-start-0 w-100 h-100 rounded-16 cursor-pointer z-1"></label>
                                            <span class="text-32 icon text-main-600 d-inline-flex"><i
                                                    class="ph ph-upload"></i></span>
                                            <span class="text-13 d-block text-gray-400 text my-8">Click to upload or
                                                drag and drop</span>
                                            <span class="text-13 d-block text-main-600">SVG, PNG, JPEG OR GIF (max
                                                1080px1200px)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="role" class="form-label mb-8 h6">Role</label>
                                    <input type="text" class="form-control py-11" id="role" placeholder="Enter Role" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <label for="zip" class="form-label mb-8 h6">ZIP Code</label>
                                    <input type="number" class="form-control py-11" id="zip"
                                        placeholder="Enter ZIP Code" />
                                </div>
                                <div class="col-12">
                                    <div class="editor">
                                        <label class="form-label mb-8 h6">Bio</label>
                                        <div id="editor">
                                            <p>
                                                I'm a Product Designer based in Melbourne,
                                                Australia. I specialise in UX/UI design, brand
                                                strategy, and Webflow development.  It has survived
                                                not only five centuries, but also the leap into
                                                electronic typesetting, remaining essentially
                                                unchanged.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="flex-align justify-content-end gap-8">
                                        <button type="reset"
                                            class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-main rounded-pill py-9">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- My Details Tab End -->

            <!-- Password Tab Start -->
            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab"
                tabindex="0">
                <div class="card mt-24">
                    <div class="card-header border-bottom">
                        <h4 class="mb-4">Password Settings</h4>
                        <p class="text-gray-600 text-15">
                            Please fill full details about yourself
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="setting.html#">
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <label for="current-password" class="form-label mb-8 h6">Current
                                                Password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control py-11" id="current-password"
                                                    placeholder="Enter Current Password" />
                                                <span
                                                    class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                                    id="#current-password"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="new-password" class="form-label mb-8 h6">New Password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control py-11" id="new-password"
                                                    placeholder="Enter New Password" />
                                                <span
                                                    class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                                    id="#new-password"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="confirm-password" class="form-label mb-8 h6">Confirm
                                                Password</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control py-11" id="confirm-password"
                                                    placeholder="Enter Confirm Password" />
                                                <span
                                                    class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                                    id="#confirm-password"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mb-8 h6">Password Requirements:</label>
                                            <ul class="list-inside">
                                                <li class="text-gray-600 mb-4">
                                                    At least one lowercase character
                                                </li>
                                                <li class="text-gray-600 mb-4">
                                                    Minimum 8 characters long - the more, the better
                                                </li>
                                                <li class="text-gray-300 mb-4">
                                                    At least one number, symbol, or whitespace
                                                    character
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mb-8 h6">Two-Step Verification</label>
                                            <ul>
                                                <li class="text-gray-600 mb-4 fw-semibold">
                                                    Two-factor authentication is not enabled yet.
                                                </li>
                                                <li class="text-gray-600 mb-4 fw-medium">
                                                    Two-factor authentication adds a layer of security
                                                    to your account by requiring more than just a
                                                    password to log in. Learn more.
                                                </li>
                                            </ul>
                                            <button type="submit" class="btn btn-main rounded-pill py-9 mt-24">
                                                Enable two-factor authentication
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset"
                                        class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Password Tab End -->
        </div>
    </div>