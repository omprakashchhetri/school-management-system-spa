 <div class="dashboard-body">
     <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
         <!-- Breadcrumb Start -->
         <div class="breadcrumb mb-24">
             <ul class="flex-align gap-4">
                 <li>
                     <a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Subject
                         Management</a>
                 </li>
                 <li>
                     <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span>
                 </li>
                 <li>
                     <span class="text-main-600 fw-normal text-15">Subject List</span>
                 </li>
             </ul>
         </div>
         <!-- Breadcrumb End -->

         <!-- Breadcrumb Right Start -->
         <div class="flex-align gap-8 flex-wrap">
             <button type="button"
                 class="btn btn-main text-sm btn-sm px-24 rounded-pill py-12 d-flex align-items-center gap-5"
                 data-bs-toggle="modal" data-bs-target="#addSubjectModal"><span class="text-lg"><i
                         class="ph ph-plus"></i></span>Add Subject</button>
         </div>
         <!-- Breadcrumb Right End -->
     </div>

     <div class="card overflow-hidden">
         <div class="card-body p-0">
             <table id="assignmentTable" class="table table-striped">
                 <thead>
                     <tr>
                         <th class="fixed-width">
                             <div class="form-check">
                                 <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                     id="selectAll" />
                             </div>
                         </th>
                         <th class="h6 text-gray-300">Sl No.</th>
                         <th class="h6 text-gray-300">Subject Name</th>
                         <th class="h6 text-gray-300">Updated On</th>
                         <th class="h6 text-gray-300">Actions</th>
                     </tr>
                 </thead>
                 <tbody>

                     <?php if(!empty($subjectsDetails)) { 
                        $count = 0;
                    ?>

                     <?php foreach($subjectsDetails as $subject) { 
                        $count++;    
                    ?>
                     <tr>
                         <td class="fixed-width">
                             <div class="form-check">
                                 <input class="form-check-input border-gray-200 rounded-4" type="checkbox" />
                             </div>
                         </td>
                         <td>
                             <span class="h6 mb-0 fw-medium text-gray-300"><?=$count?></span>
                         </td>
                         <td>
                             <span class="h6 mb-0 fw-medium text-gray-300"><?=$subject['subject_name']?></span>
                         </td>
                         <td>
                             <span
                                 class="h6 mb-0 fw-medium text-gray-300"><?=formatDate($subject['updated_at'])?></span>
                         </td>
                         <td>
                             <div class="flex-align justify-content-start gap-10">
                                 <button data-subject-id="<?=$subject['id']?>"
                                     data-subject-name="<?=$subject['subject_name']?>"
                                     class="edit-subject-js bg-warning-50 text-warning-600 py-2 px-14 rounded-pill hover-bg-warning-600 hover-text-white flex-align justify-content-center gap-5">
                                     <i class="ph ph-pencil-simple"></i>Edit</button>
                                 <button data-id="<?=$subject['id']?>" data-name="<?=$subject['subject_name']?>"
                                     class="delete-subject-js bg-danger-50 text-danger-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white flex-align justify-content-center gap-5">
                                     <i class="ph ph-trash"></i>Delete</button>
                             </div>
                         </td>
                     </tr>
                     <?php } ?>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>

     <!-- Modal Add Subject -->
     <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-md modal-dialog modal-dialog-top">
             <div class="modal-content radius-16 bg-base">
                 <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                     <h1 class="modal-title fs-5" id="addSubjectModalLabel">Add New Subject</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body p-24">
                     <div class="row">
                         <div class="col-12 mb-20">
                             <label class="form-label fw-semibold text-primary-light text-sm mb-8">Subject Name :
                             </label>
                             <input type="text" class="form-control radius-8" placeholder="Enter Subject Name "
                                 id="newSubjectName">
                         </div>

                         <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                             <button type="submit" id="saveNewSubjectBtn"
                                 class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8">
                                 Save
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <!-- Modal Edit Subject -->
     <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel"
         aria-hidden="true">
         <div class="modal-dialog modal-md modal-dialog modal-dialog-top">
             <div class="modal-content radius-16 bg-base">
                 <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                     <h1 class="modal-title fs-5" id="editSubjectModalLabel">Edit Subject</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body p-24">
                     <input type="hidden" name="" id="editSubjectId">
                     <div class="row">
                         <div class="col-12 mb-20">
                             <label class="form-label fw-semibold text-primary-light text-sm mb-8">Subject Name :
                             </label>
                             <input type="text" class="form-control radius-8" placeholder="Enter Subject Name "
                                 id="subjectName">
                         </div>

                         <div class="d-flex align-items-center justify-content-center gap-8 mt-24">
                             <button type="submit" id="editNewSubjectBtn"
                                 class="btn bg-main-600 hover-bg-main-800 border-main-600 hover-border-main-800 text-md px-24 py-12 radius-8">
                                 Update
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 </div>
 <script src="<?=base_url()?>assets/js/subject-list.js"></script>