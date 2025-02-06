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
                <h4 class="card-title mb-0">Bonafid</h4>
            </div><!-- end card header -->
            
              <div class="card-body">
                    <div class="listjs-table" id="">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                            
                                <a href="<?php echo e(route('bonafid.create')); ?>">
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
                        
                        

                  
                        <div class="table-responsive  mt-3 mb-1">
<table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>State</th>
            <th>District</th>
            <th>Taluka</th>
            <th>School Name</th>
            <th>School Address</th>
            <th>Student Name</th>
            <th>General Register Number</th>
            <th>Religion</th>
            <th>Caste</th>
            <th>Date of Birth</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $bonafids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonafid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="lcRow<?php echo e($bonafid->id); ?>">
                <td><?php echo e($bonafid->id); ?></td>
                <td><?php echo e(isset($bonafid->state) ? $bonafid->state : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->district) ? $bonafid->district : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->taluka) ? $bonafid->taluka : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->gram->gram_name) ? $bonafid->gram->gram_name : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->school_address) ? $bonafid->school_address : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->student_name) ? $bonafid->student_name : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->general_register_number) ? $bonafid->general_register_number : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->religion) ? $bonafid->religion : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->caste) ? $bonafid->caste : 'N/A'); ?></td>
                <td><?php echo e(isset($bonafid->dob) ? $bonafid->dob : 'N/A'); ?></td>
                <td>
                    <a href="<?php echo e(route('bonafid.edit' , $bonafid->id)); ?>" class="btn btn-sm btn-primary my-3">Edit</a>
<button class="btn btn-sm btn-success viewCategory my-3 " data-id="<?php echo e($bonafid->id); ?>">
    <i class="fa fa-eye"></i> View
</button>
<a href="#" class="btn btn-danger btn-sm remove-item-btn my-3" data-id="<?php echo e($bonafid->id); ?>" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Delete</a>
<a href="<?php echo e(route('bonafid.print', $bonafid->id)); ?>" class="btn btn-warning btn-sm" target="_blank" onclick="openAndPrintPage(event, '<?php echo e(route('bonafid.print', $bonafid->id)); ?>')">Print</a>

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
                    <!-- Row 1 -->
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

                    <!-- Row 2 -->
                    <div class="col-md-4">
                        <label for="view_school_name" class="form-label">School Name</label>
                        <input type="text" class="form-control" id="view_school_name" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_school_address" class="form-label">School Address</label>
                        <input type="text" class="form-control" id="view_school_address" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_student_name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="view_student_name" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_general_register_number" class="form-label">General Register Number</label>
                        <input type="text" class="form-control" id="view_general_register_number" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="view_religion" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_caste" class="form-label">Caste</label>
                        <input type="text" class="form-control" id="view_caste" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_dob" class="form-label">Date of Birth</label>
                        <input type="text" class="form-control" id="view_dob" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_dob_text" class="form-label">Date of Birth (Text)</label>
                        <input type="text" class="form-control" id="view_dob_text" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_birth_place" class="form-label">Birth Place</label>
                        <input type="text" class="form-control" id="view_birth_place" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_birth_place_taluka" class="form-label">Birth Place Taluka</label>
                        <input type="text" class="form-control" id="view_birth_place_taluka" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_birth_place_dist" class="form-label">Birth Place District</label>
                        <input type="text" class="form-control" id="view_birth_place_dist" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="view_certificate_issued_date" class="form-label">Date of Certificate Issued</label>
                        <input type="text" class="form-control" id="view_certificate_issued_date" readonly>
                    </div>

                    <!-- Add Submit and Back Buttons -->
                  
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                            
                  

                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
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
    var id = $(this).data('id');

    $.ajax({
        url: '/bonafid/' + id,  // Adjust the route to your backend API
        method: 'GET',
        success: function (response) {
            // Populate the modal fields with the dynamic data
            $('#view_state').val(response.state);
            $('#view_district').val(response.district);
            $('#view_taluka').val(response.taluka);
            $('#view_school_name').val(response.gram.gram_name);
            $('#view_school_address').val(response.school_address);
            $('#view_student_name').val(response.student_name);
            $('#view_general_register_number').val(response.general_register_number);
            $('#view_religion').val(response.religion);
            $('#view_caste').val(response.caste);
            $('#view_dob').val(response.dob);
            $('#view_dob_text').val(response.birth_in_text);
            $('#view_birth_place').val(response.birth_place);
            $('#view_birth_place_taluka').val(response.birth_place_taluka);
            $('#view_birth_place_dist').val(response.birth_place_dist);
            $('#view_certificate_issued_date').val(response.certificate_issued_date);

            // Open the modal
            $('#viewCategoryModal').modal('show');
        },
        error: function (err) {
            console.error("Error fetching data:", err);
        }
    });
});

</script>

<script>
$(document).ready(function () {
    // Trigger modal and set the correct ID for deletion
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');  // Get the ID from the data-id attribute
        $('#deleteForm').attr('action', '/bonafid/' + id);  // Set the form action with the correct ID
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/general-register.actthost.com/resources/views/bonafid/index.blade.php ENDPATH**/ ?>