<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.user'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row">
     <div class="col-xxxl-6">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">LC</h4>
            </div><!-- end card header -->
            
              <div class="card-body">
                    <div class="listjs-table" id="">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                            
                                <a href="<?php echo e(route('lc.create')); ?>">
                                    <button type="button" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Add
                                    </button>
                                </a>
                              
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        

            <!--<div class="card-body">-->
            <!--    <div class="listjs-table" id="customerList">-->
            <!--        <div class="row g-4 mb-3">-->
            <!--            <div class="col-sm-auto">-->
            <!--                <div>-->
                              
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-sm">-->
            <!--                <div class="d-flex justify-content-sm-end">-->
            <!--                    <div class="search-box ms-2">-->
            <!--                        <input type="text" class="form-control search" placeholder="Search...">-->
            <!--                        <i class="ri-search-line search-icon"></i>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

                  
                        <div class="table-responsive  mt-3 mb-1">
<table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
    <thead class="table-light">
        <tr>
            <th class="sort" data-sort="customer_name">ID</th>
            <th class="sort" data-sort="customer_name">State</th>
            <th class="sort" data-sort="email">District</th>
            <th class="sort" data-sort="phone">Taluka</th>
            <th class="sort" data-sort="date">School Name</th>
            <th class="sort" data-sort="status">Student ID</th>
                        <th class="sort" data-sort="status">Student Name</th>

            <th class="sort" data-sort="email">Adhar Number</th>
                        <th class="sort" data-sort="customer_name">Other Studies</th>

            <th class="sort" data-sort="customer_name">Mother's Name</th>
            <th class="sort" data-sort="email">Nationality</th>
            <!--<th class="sort" data-sort="status">Mother Tongue</th>-->
            <th class="sort" data-sort="action">Religion</th>
            <th class="sort" data-sort="action">Caste</th>
            <!--<th class="sort" data-sort="action">Sub Caste</th>-->
            <!--<th class="sort" data-sort="action">Birth Place</th>-->
            <!--<th class="sort" data-sort="action">Birth Place Taluka</th>-->
            <!--<th class="sort" data-sort="action">Birth Place District</th>-->
            <!--<th class="sort" data-sort="action">Birth Place State</th>-->
            <!--<th class="sort" data-sort="action">Birth Place Country</th>-->
            <!--<th class="sort" data-sort="action">Date of Birth</th>-->
            <!--<th class="sort" data-sort="action">Birth in Text</th>-->
            <!--<th class="sort" data-sort="action">Previous School</th>-->
            <!--<th class="sort" data-sort="action">Standard</th>-->
            <!--<th class="sort" data-sort="action">Date of Admission</th>-->
            <!--<th class="sort" data-sort="action">Academic Progress</th>-->
            <!--<th class="sort" data-sort="action">Behavior</th>-->
            <!--<th class="sort" data-sort="action">Date of Leaving School</th>-->
            <!--<th class="sort" data-sort="action">Reason for Leaving School</th>-->
            <!--<th class="sort" data-sort="action">Comments</th>-->
            <!--<th class="sort" data-sort="action">Certificate Date</th>-->
            <!--<th class="sort" data-sort="action">Certificate Month</th>-->
            <!--<th class="sort" data-sort="action">Certificate Year</th>-->
            <th class="sort" data-sort="action">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $lcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="lcRow<?php echo e($lc->id); ?>">
                <td><?php echo e(isset($lc->id) ? $lc->id : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->state) ? $lc->state : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->district) ? $lc->district : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->taluka) ? $lc->taluka : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->grams->gram_name) ? $lc->grams->gram_name : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->student_id) ? $lc->student_id : 'N/A'); ?></td>
                                <td><?php echo e(isset($lc->student_first_name) && isset($lc->student_middle_name) && isset($lc->student_last_name) ? $lc->student_first_name . ' ' . $lc->student_middle_name . ' ' . $lc->student_last_name : 'N/A'); ?></td>

                <td><?php echo e(isset($lc->adhar_number) ? $lc->adhar_number : 'N/A'); ?></td>
                                <td><?php echo e(isset($lc->other_studies) ? $lc->other_studies : 'N/A'); ?></td>

                <td><?php echo e(isset($lc->mother_name) ? $lc->mother_name : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->nationality) ? $lc->nationality : 'N/A'); ?></td>
                <!--<td><?php echo e(isset($lc->mother_tongue) ? $lc->mother_tongue : 'N/A'); ?></td>-->
                <td><?php echo e(isset($lc->religion) ? $lc->religion : 'N/A'); ?></td>
                <td><?php echo e(isset($lc->caste) ? $lc->caste : 'N/A'); ?></td>
                <!--<td><?php echo e(isset($lc->sub_caste) ? $lc->sub_caste : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->birth_place) ? $lc->birth_place : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->birth_place_taluka) ? $lc->birth_place_taluka : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->birth_place_dist) ? $lc->birth_place_dist : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->birth_place_state) ? $lc->birth_place_state : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->birth_place_country) ? $lc->birth_place_country : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->dob) ? \Carbon\Carbon::parse($lc->dob)->format('d-m-Y') : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->birth_in_text) ? $lc->birth_in_text : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->previous_school) ? $lc->previous_school : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->standard) ? $lc->standard : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->date_of_admission) ? \Carbon\Carbon::parse($lc->date_of_admission)->format('d-m-Y') : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->academic_progress) ? $lc->academic_progress : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->behavior) ? $lc->behavior : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->comments) ? $lc->comments : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->certificate_date) ? $lc->certificate_date : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->certificate_month) ? $lc->certificate_month : 'N/A'); ?></td>-->
                <!--<td><?php echo e(isset($lc->certificate_year) ? $lc->certificate_year : 'N/A'); ?></td>-->
                <td>

                    <a href="<?php echo e(route('lc.edit' ,$lc->id )); ?>" class="btn btn-primary btn-sm">Edit</a>
<button class="btn btn-sm btn-success viewCategory my-3 " data-id="<?php echo e($lc->id); ?>">
    <i class="fa fa-eye"></i> View
</button>
<a href="#" class="btn btn-danger btn-sm remove-item-btn" data-id="<?php echo e($lc->id); ?>" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Delete</a>
<!-- Button to Print -->
<a href="<?php echo e(route('lc.print', $lc->id)); ?>" class="btn btn-warning btn-sm" target="_blank" onclick="openAndPrintPage(event, '<?php echo e(route('lc.print', $lc->id)); ?>')">Print</a>

<script>
    function openAndPrintPage(event, url) {
        event.preventDefault();
        // Open the URL in a new window
        var printWindow = window.open(url, '_blank');
        
        // Wait until the page is fully loaded before triggering print
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>

                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
                            
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Orders but couldn't find any matching records.</p>
                            </div>
                        </div>
                    </div>



                    <!--<div class="d-flex justify-content-end">-->
                    <!--    <div class="pagination-wrap hstack gap-2">-->
                    <!--        <?php if(!empty($users)): ?>-->

                    <!--        <?php echo e($users->links()); ?>-->
                           
                    <!--        <?php endif; ?>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>



<!-- end row -->
<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                    <h4>Are you Sure?</h4>
                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record?</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-light">Yes, delete it</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View LC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <div class="row gy-4">
                                                        
                                                 <div class="col-md-4">
    <label for="view_state" class="form-label">State</label>
    <input type="text" class="form-control" id="view_state" readonly>
</div>

<div class="col-md-4">
    <label for="view_district" class="form-label">District</label>
    <input type="text" class="form-control" id="view_district" readonly>
</div>

<div class="col-md-4">
    <label for="view_taluka" class="form-label">Taluka</label>
    <input type="text" class="form-control" id="view_taluka" readonly>
</div>

<div class="col-md-4">
    <label for="view_gram" class="form-label">School</label>
    <input type="text" class="form-control" id="view_gram" readonly>
</div>

<div class="col-md-4">
    <label for="view_student_id" class="form-label">Student ID</label>
    <input type="number" class="form-control" id="view_student_id" readonly>
</div>

<div class="col-md-4">
    <label for="view_adhar_number" class="form-label">Udash UID Number (Aadhar Number)</label>
    <input type="number" class="form-control" id="view_adhar_number" readonly>
</div>

<div class="col-md-4">
    <label for="view_student_first_name" class="form-label">Student First Name</label>
    <input type="text" class="form-control" id="view_student_first_name" readonly>
</div>

<div class="col-md-4">
    <label for="view_student_middle_name" class="form-label">Student Middle Name</label>
    <input type="text" class="form-control" id="view_student_middle_name" readonly>
</div>

<div class="col-md-4">
    <label for="view_student_last_name" class="form-label">Student Last Name</label>
    <input type="text" class="form-control" id="view_student_last_name" readonly>
</div>

<div class="col-md-4">
    <label for="view_mother_name" class="form-label">Mother's Name</label>
    <input type="text" class="form-control" id="view_mother_name" readonly>
</div>

<!-- Nationality -->
<div class="col-md-4">
    <label for="view_nationality" class="form-label">Nationality</label>
    <input type="text" class="form-control" id="view_nationality" readonly>
</div>

<!-- Mother Tongue -->
<div class="col-md-4">
    <label for="view_mother_tongue" class="form-label">Mother Tongue (मातृभाषा)</label>
    <input type="text" class="form-control" id="view_mother_tongue" readonly>
</div>

<!-- Religion -->
<div class="col-md-4">
    <label for="view_religion" class="form-label">Religion (धर्म)</label>
    <input type="text" class="form-control" id="view_religion" readonly>
</div>

<!-- Caste -->
<div class="col-md-4">
    <label for="view_caste" class="form-label">Caste (जात)</label>
    <input type="text" class="form-control" id="view_caste" readonly>
</div>

<!-- Sub-caste -->
<div class="col-md-4">
    <label for="view_sub_caste" class="form-label">Sub-caste (पोट जात)</label>
    <input type="text" class="form-control" id="view_sub_caste" readonly>
</div>

<!-- Birth Place -->
<div class="col-md-4">
    <label for="view_birth_place" class="form-label">Birth Place (Village/City)</label>
    <input type="text" class="form-control" id="view_birth_place" readonly>
</div>

<!-- Birth Place Taluka -->
<div class="col-md-4">
    <label for="view_birth_place_taluka" class="form-label">Birth Place Taluka</label>
    <input type="text" class="form-control" id="view_birth_place_taluka" readonly>
</div>

<div class="col-md-4">
    <label for="view_birth_place_dist" class="form-label">Birth Place District</label>
    <input type="text" class="form-control" id="view_birth_place_dist" readonly>
</div>

<!-- Birth Place State -->
<div class="col-md-4">
    <label for="view_birth_place_state" class="form-label">Birth Place State</label>
    <input type="text" class="form-control" id="view_birth_place_state" readonly>
</div>

<!-- Birth Place Country -->
<div class="col-md-4">
    <label for="view_birth_place_country" class="form-label">Birth Place Country</label>
    <input type="text" class="form-control" id="view_birth_place_country" readonly>
</div>

<!-- Date of Birth -->
<div class="col-md-4">
    <label for="view_dob" class="form-label">Date of Birth</label>
    <input type="date" class="form-control" id="view_dob" readonly>
</div>

<!-- Date of Birth (Text) -->
<div class="col-md-4">
    <label for="view_dob_text" class="form-label">Date of Birth (Text)</label>
    <input type="text" class="form-control" id="view_dob_text" readonly>
</div>

<!-- Previous School -->
<div class="col-md-4">
    <label for="view_previous_school" class="form-label">Previous School</label>
    <input type="text" class="form-control" id="view_previous_school" readonly>
</div>

<!-- Standard -->
<div class="col-md-4">
    <label for="view_standard" class="form-label">Standard</label>
    <input type="text" class="form-control" id="view_standard" readonly>
</div>

<!-- Date of Admission -->
<div class="col-md-4">
    <label for="view_date_of_admission" class="form-label">Date of Admission</label>
    <input type="date" class="form-control" id="view_date_of_admission" readonly>
</div>

     <div class="col-md-4">
    <label for="view_academic_progress" class="form-label">Academic Progress</label>
    <textarea class="form-control" id="view_academic_progress" name="academic_progress" readonly></textarea>
</div>

<div class="col-md-4">
    <label for="view_behavior" class="form-label">Behavior</label>
    <textarea class="form-control" id="view_behavior" name="behavior" readonly></textarea>
</div>

<div class="col-md-4">
    <label for="view_date_of_leaving_school" class="form-label">Date of Leaving School</label>
    <textarea class="form-control" id="view_date_of_leaving_school" name="date_of_leaving_school" readonly></textarea>
</div>

<div class="col-md-4">
    <label for="view_other_studies" class="form-label">Any other studies attended and since (alpha and number)</label>
    <textarea class="form-control" id="view_other_studies" name="other_studies" readonly></textarea>
</div>

<div class="col-md-4">
    <label for="view_reason_for_leaving_school" class="form-label">Reason for Leaving School</label>
    <textarea class="form-control" id="view_reason_for_leaving_school" name="reason_for_leaving_school" readonly></textarea>
</div>

<div class="col-md-4">
    <label for="view_comments" class="form-label">Comments (शेरा)</label>
    <textarea class="form-control" id="view_comments" name="comments" readonly></textarea>
</div>

<!-- Row 12 -->
<div class="col-md-4">
    <label for="view_certificate_date" class="form-label">Date of Certificate Issued</label>
    <input type="text" class="form-control" id="view_certificate_date" name="certificate_date" readonly>
</div>

<div class="col-md-4">
    <label for="view_certificate_month" class="form-label">Month of Certificate</label>
    <input type="text" class="form-control" id="view_certificate_month" name="certificate_month" readonly>
</div>

<div class="col-md-4">
    <label for="view_certificate_year" class="form-label">Year of Certificate</label>
    <input type="text" class="form-control" id="view_certificate_year" name="certificate_year" readonly>
</div>

</div>
               

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>



<script>
$(document).on('click', '.viewCategory', function () {
    const gramId = $(this).data('id');

    // Fetch category data via AJAX
    $.ajax({
        url: `/lc/${gramId}`,
        method: 'GET',
        success: function (response) {
            console.log('response', response);

            // Populate the modal fields with the response data
            $('#view_state').val(response.gram.state);
            $('#view_district').val(response.gram.district);
            $('#view_taluka').val(response.gram.taluka);
            $('#view_gram').val(response.gram.grams.gram_name);
            $('#view_student_id').val(response.gram.student_id);
            $('#view_adhar_number').val(response.gram.adhar_number);
            $('#view_student_first_name').val(response.gram.student_first_name);
            $('#view_student_middle_name').val(response.gram.student_middle_name);
            $('#view_student_last_name').val(response.gram.student_last_name);
            $('#view_mother_name').val(response.gram.mother_name);
            $('#view_nationality').val(response.gram.nationality);
            $('#view_mother_tongue').val(response.gram.mother_tongue);
            $('#view_religion').val(response.gram.religion);
            $('#view_caste').val(response.gram.caste);
            $('#view_sub_caste').val(response.gram.sub_caste);
            $('#view_birth_place').val(response.gram.birth_place);
            $('#view_birth_place_taluka').val(response.gram.birth_place_taluka);
            $('#view_birth_place_dist').val(response.gram.birth_place_dist);
            $('#view_birth_place_state').val(response.gram.birth_place_state);
            $('#view_birth_place_country').val(response.gram.birth_place_country);
            $('#view_dob').val(response.gram.dob);
            $('#view_dob_text').val(response.gram.birth_in_text);
            $('#view_previous_school').val(response.gram.previous_school);
            $('#view_standard').val(response.gram.standard);
            $('#view_date_of_admission').val(response.gram.date_of_admission);
            $('#view_academic_progress').val(response.gram.academic_progress);
            $('#view_behavior').val(response.gram.behavior);
            $('#view_date_of_leaving_school').val(response.gram.date_of_leaving_school);
            $('#view_other_studies').val(response.gram.other_studies);
            $('#view_reason_for_leaving_school').val(response.gram.reason_for_leaving_school);
            $('#view_comments').val(response.gram.comments);
            $('#view_certificate_date').val(response.gram.certificate_date);
            $('#view_certificate_month').val(response.gram.certificate_month);
            $('#view_certificate_year').val(response.gram.certificate_year);

            
            // Show the modal
            $('#viewCategoryModal').modal('show');
        },
        error: function (error) {
            console.error('Error fetching gram details:', error);
            alert('Failed to fetch category details.');
        },
    });
});
</script>














<script>
$(document).ready(function () {
    // Trigger modal and set the correct ID for deletion
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');  // Get the ID from the data-id attribute
        $('#deleteForm').attr('action', '/lc/' + id);  // Set the form action with the correct ID
    });

    // Handle form submission for delete
    $('#deleteForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        var form = $(this);
        var actionUrl = form.attr('action');  // Get the form action URL

        $.ajax({
            url: actionUrl,
            type: 'DELETE',  // Ensure this is a DELETE request
            data: form.serialize(),  // Send the form data with the CSRF token
            success: function(response) {
                // On success, remove the corresponding row from the table (if applicable)
                $('#lcRow' + actionUrl.split('/').pop()).remove();
                $('#deleteRecordModal').modal('hide');  // Hide the modal
                
                // Success message with SweetAlert
                Swal.fire({
                    title: 'Success!',
                    text: 'Record deleted successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(); // Reload the page after success
                    }
                });
            },
            error: function(response) {
                alert('An error occurred while deleting the record.');
            }
        });
    });
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/general-register.actthost.com/resources/views/LC/index.blade.php ENDPATH**/ ?>