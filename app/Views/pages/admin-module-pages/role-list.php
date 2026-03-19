<?php //require_once APPPATH . 'Views/partials/common-functions.php'; ?>
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
					<span class="text-main-600 fw-normal text-15">Role List</span>
				</li>
			</ul>
		</div>
		<!-- Breadcrumb End -->
	</div>

	<!-- Role List Start -->
	<div class="card mt-24">
		<div class="card-body">
			<div class="mb-20 flex-between flex-wrap gap-8">
				<h4 class="mb-0">Roles</h4>
				<div class="flex-align gap-8 flex-wrap">
					<div class="position-relative text-gray-500 flex-align gap-4 text-13">
						<span class="text-inherit">Sort by: </span>
						<div
							class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-8 focus-border-main-600">
							<span class="text-lg"><i class="ph ph-funnel-simple"></i></span>
							<select class="form-control px-8 py-12 border-0 text-inherit rounded-4 text-center" id="sortRoles">
								<option value="" selected disabled>Select Option</option>
								<option value="DESC">Latest To Oldest</option>
								<option value="ASC">Oldest To Latest</option>
								
							</select>
						</div>
					</div>
					<button type="button" class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addRoleModal">
						<i class="ph ph-plus me-4"></i>
						Add Role 
					</button>
				</div>
			</div>

			<div class="row g-20">
				<?php foreach($roles as $role) : ?>
				<div class="col-xxl-3 col-lg-4 col-sm-6">
					<div class="card border border-gray-100">
						<div class="card-body p-8">

							<div class="p-8">
								<span
									class="text-13 py-2 px-10 rounded-pill bg-success-50 text-success-600 mb-16 d-none">Authetication</span>
								<h5 class="mb-8">
									<a href="role-details/<?=$role['id']?>" class="hover-text-main-600"><?=$role['role_name']?></a>
								</h5>

								<div class="flex-align gap-8">
									<div class="flex-align gap-4">
										<span class="text-sm text-main-600 d-flex"><i class="ph ph-clock"></i></span>
										<span class="text-13 text-gray-600"><?=formatDateTime($role['created_at'])?></span>
									</div>
									<div class="flex-align gap-4 d-none">
										<span class="text-sm text-main-600 d-flex"><i class="ph ph-user"></i></span>
										<span class="text-13 text-gray-600">Created by</span>
									</div>
								</div>

								<div class="flex-between gap-4 flex-wrap mt-20">
									<button class="btn btn-danger  rounded-pill py-9 flex-align gap-4 delete-role-btn" data-id="<?=$role['id']?>">
										<span class="d-flex text-md"><i class="ph ph-trash"></i></span>
										Delete
									</button>
									<a href="role-details/<?=$role['id']?>"
										class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
										<span class="d-flex text-md"><i class="ph ph-note-pencil"></i></span>
										Edit
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

			
			<!-- Modal Add Role -->
			<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
					<div class="modal-content radius-16 bg-base">
						<div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body p-24">
							<div class="row">   
								<div class="col-12 mb-20">
									<label class="form-label fw-semibold text-primary-light text-sm mb-8">Role Name : </label>
									<input type="text" class="form-control radius-8" placeholder="Enter Role Name " id="newRoleName">
								</div>
								
								<div class="d-flex align-items-center justify-content-center gap-8 mt-24">
									<button type="submit" id="saveNewRoleBtn" class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8"> 
										Save
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="flex-between flex-wrap gap-8 mt-20 d-none">
				<a href="library.html#" class="btn btn-outline-gray rounded-pill py-9 flex-align gap-4">
					<span class="d-flex text-xl"><i class="ph ph-arrow-left"></i></span>
					Previous
				</a>

				<ul class="pagination flex-align flex-wrap">
					<li class="page-item active">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">1</a>
					</li>
					<li class="page-item">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">2</a>
					</li>
					<li class="page-item">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">3</a>
					</li>
					<li class="page-item">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">...</a>
					</li>
					<li class="page-item">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">8</a>
					</li>
					<li class="page-item">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">9</a>
					</li>
					<li class="page-item">
						<a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
							href="library.html#">10</a>
					</li>
				</ul>

				<a href="library.html#" class="btn btn-outline-main rounded-pill py-9 flex-align gap-4">
					Next
					<span class="d-flex text-xl"><i class="ph ph-arrow-right"></i></span>
				</a>
			</div>
		</div>
	</div>
	<!-- Role List End -->
</div>

<script src="<?=base_url()?>assets/js/role-management.js"></script>