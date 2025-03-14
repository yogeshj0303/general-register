<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.taluka'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- List Categories -->
        <div class="col-xxl-6">
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

            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Taluka</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="talukaTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $talukas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taluka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr id="talukaRow<?php echo e($taluka->id); ?>">
                                        <td><?php echo e($taluka->id); ?></td>
                                        <td><?php echo e($taluka->state); ?></td>
                                        <td><?php echo e($taluka->district); ?></td>
                                        <td><?php echo e($taluka->taluka_name); ?></td>
                                        <td>
                                            <!-- Edit Button -->
<button class="btn btn-sm btn-primary editTaluka" data-id="<?php echo e($taluka->id); ?>">
    <i class="fa fa-edit"></i> Edit
</button>
                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal" data-id="<?php echo e($taluka->id); ?>">
                                                Delete
                                            </button>
                                            
                                            <button class="btn btn-sm btn-success viewtaluka" data-id="<?php echo e($taluka->id); ?>">
    <i class="fa fa-eye"></i> View
</button>


                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Talukas found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if($talukas->isNotEmpty()): ?>
                            <div class="d-flex justify-content-center">
                                <?php echo $talukas->links(); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Taluka -->
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Taluka</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('talukas.store')); ?>" method="POST" class="row g-3">
                        <?php echo csrf_field(); ?>

                        <!-- Select for State -->
                        <div class="col-md-6">
                            <label for="state" class="form-label">State</label>
                            <select name="state" id="state" class="form-control js-example-basic-single
                                <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select State</option>
                                <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state['state']); ?>"><?php echo e($state['state']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Select for District -->
                        <div class="col-md-6">
                            <label for="district" class="form-label">District</label>
                            <select name="district" id="district"
                                class="form-control <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select District</option>
                                <!-- District options will be populated based on state selection -->
                            </select>
                            <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>


                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Taluka Name</label>
                            <input type="text" name="taluka_name"
                                class="form-control <?php $__errorArgs = ['taluka_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="taluka_name"
                                placeholder="Enter Taluka Name">
                            <?php $__errorArgs = ['taluka_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
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


<!-- Edit Modal -->
<div class="modal fade" id="editTalukaModal" tabindex="-1" aria-labelledby="editTalukaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php if(isset($taluka)): ?>
<form id="editTalukaForm" method="POST" action="<?php echo e(url('taluka/' . $taluka->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>
                <input type="hidden" name="id" id="edittalukaid">

                <div class="modal-header">
                    <h5 class="modal-title" id="editTalukaModalLabel">Edit Taluka</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Select for State -->
                    <div class="mb-3">
                        <label for="editState" class="form-label">State</label>
                        <select id="editState" name="state" class="form-select mb-3" required>
                            <option value="">Select state</option>
                            <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state['state']); ?>"><?php echo e($state['state']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback" style="color: red;">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Select for District -->
                    <div class="mb-3">
                        <label for="editDistrict" class="form-label">District</label>
                        <select name="district" id="editDistrict" class="form-control <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Select District</option>
                            <!-- District options will be populated based on state selection -->
                        </select>
                        <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback" style="color: red;">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="editName" class="form-label">Taluka Name</label>
                        <input type="text" name="taluka_name" class="form-control <?php $__errorArgs = ['taluka_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="editName" required>
                        <?php $__errorArgs = ['taluka_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback" style="color: red;">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View Taluka</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- State -->
                <div class="mb-3">
                    <label for="viewState" class="form-label">State</label>
                    <input type="text" class="form-control" id="viewState" readonly>
                </div>

                <!-- District -->
                <div class="mb-3">
                    <label for="viewDistrict" class="form-label">District</label>
                    <input type="text" class="form-control" id="viewDistrict" readonly>
                </div>

                <!-- Taluka Name -->
                <div class="mb-3">
                    <label for="viewName" class="form-label">Taluka Name</label>
                    <input type="text" class="form-control" id="viewName" readonly>
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
    <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>
   
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
<script>
    $(document).on('click', '.viewtaluka', function() {
    const Talukaid = $(this).data('id');

    // Fetch category data via AJAX
    $.ajax({
        url: `/talukashow/${Talukaid}`, 
        method: 'GET',
        success: function(response) {
             $('#viewState').val(response.state);
    $('#viewDistrict').val(response.district);

            $('#viewName').val(response.taluka_name);

            // Show the modal
            $('#viewCategoryModal').modal('show');
        },
        error: function() {
            alert('Failed to fetch category details.');
        }
    });
});

</script>

    <script>
        $(document).ready(function() {
    // Open modal and populate data on edit button click
    $('.editTaluka').click(function() {
        var id = $(this).data('id');
                $.get('/talukas/' + id + '/edit', function(data) {
            $('#editTalukaModal').modal('show');
            $('#edittalukaid').val(data.id); // Set Taluka ID
            $('#editName').val(data.taluka_name); // Set Taluka Name

            // Set state and trigger change
            $('#editState').val(data.state).change();
            $('#editDistrict').val(data.district).change();

            // Set district based on state (you may need to load this from the server)
            populateDistricts(data.state, data.district);
        });
    });

              $('#editState').change(function() {
        var state = $(this).val();
        var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        var districtDropdown = $('#editDistrict');
        districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

        var selectedState = statesData.find(function(item) {
            return item.state === state;
        });

        if (selectedState) {
            selectedState.districts.forEach(function(district) {
                districtDropdown.append($('<option>', {
                    value: district,
                    text: district
                }));
            });
        }

        // Clear taluka and organization dropdowns
        $('#editName').empty().append('<option value="">Select Taluka</option>');
    });

    // Initialize Select2 for better dropdowns
    $('#editState').select2({
        placeholder: 'Select state',
        allowClear: true,
        dropdownParent: $('#editTalukaModal')
    });

    $('#editDistrict').select2({
        placeholder: 'Select district',
        allowClear: true,
        dropdownParent: $('#editTalukaModal')
    });

    // Handle form submission (AJAX)
    $('#editTalukaForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
    var actionUrl = '/taluka/' + $('#edittalukaid').val();
        var formData = form.serialize();

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            success: function(response) {
                // Update table or UI as needed
                $('#editTalukaModal').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: 'Taluka updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(); // Reload page after success
                    }
                });
            },
            error: function(response) {
                alert('An error occurred while trying to update the Taluka.');
            }
        });
    });
});

    </script>
    
    <script>
        $(document).ready(function() {

            
            
            
            // Handle Delete Checklist
            $('.remove-item-btn').click(function() {
                var id = $(this).data('id');
                $('#deleteForm').attr('action', '/talukas/' + id);
            });

            // Handle Delete Checklist Form Submission
            $('#deleteForm').submit(function(event) {
                event.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');
                var id = actionUrl.split('/').pop(); // Extract ID from URL

                $.ajax({
                    url: actionUrl,
                    type: 'DELETE',
                    data: form.serialize(),
                    success: function(response) {
                        $('#talukaRow' + id).remove();
                        $('#deleteRecordModal').modal('hide');
                          Swal.fire(
                            'Deleted!',
                            'Taluka has been deleted successfully.',
                            'success'
                        );
                    },
                    error: function(response) {
                           Swal.fire(
                            'Error!',
                            'An error occurred while deleting the Taluka.',
                            'error'
                        );                    }
                });
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            $('#district').select2({
                placeholder: 'Select District',
                allowClear: true
            });
        });



        $(document).ready(function() {
            $('#state').select2({
                placeholder: 'Select state',
                allowClear: true
            });
        });
    </script>

    <script>
        // $(document).ready(function() {
        //     // Handle state selection change
        //     $('#state').change(function() {
        //         var state = $(this).val(); // Get the selected state value
        //         var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        //         var districtDropdown = $('#district');
        //         districtDropdown.empty().append(
        //         '<option value="">Select District</option>'); // Clear existing options

        //         // Find the selected state object from the statesData array
        //         var selectedState = statesData.find(function(item) {
        //             return item.state === state; // Match the selected state
        //         });

        //         // Check if the selected state is found
        //         if (selectedState) {
        //             // Populate the district dropdown with the districts of the selected state
        //             selectedState.districts.forEach(function(district) {
        //                 districtDropdown.append($('<option>', {
        //                     value: district, // Use the district name as the value
        //                     text: district // Display the district name as the option text
        //                 }));
        //             });
        //         } else {
        //             districtDropdown.append('<option value="">No districts available</option>');
        //         }

        //         // Clear the taluka field dropdown
        //         $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
        //     });
        // });
    </script>
    <script>
    $(document).ready(function() {
        // Fetch user information from Blade variables
        var isAdmin = <?php echo json_encode(Auth::user()->is_admin === 'admin', 15, 512) ?>;
        var userState = <?php echo json_encode(Auth::user()->state, 15, 512) ?>;
        var userDistrict = <?php echo json_encode(Auth::user()->district, 15, 512) ?>;
        
       
        var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        var stateDropdown = $('#state');
        var districtDropdown = $('#district');
 
       

        // Populate dropdowns based on user role
        if (!isAdmin) {
            // Non-admin: show only the user's state, district, taluka, and gram
            stateDropdown.empty().append($('<option>', {
                value: userState,
                text: userState,
                selected: true
            }));

            districtDropdown.empty().append($('<option>', {
                value: userDistrict,
                text: userDistrict,
                selected: true
            }));

            
          
        } else {
            // Admin: populate all states and handle change events
            // statesData.forEach(function(item) {
            //     stateDropdown.append($('<option>', {
            //         value: item.state,
            //         text: item.state
            //     }));
            // });

            stateDropdown.change(function() {
                var selectedState = $(this).val();
                districtDropdown.empty().append('<option value="">Select District</option>');
               
                var stateData = statesData.find(function(item) {
                    return item.state === selectedState;
                });

                if (stateData) {
                    stateData.districts.forEach(function(district) {
                        districtDropdown.append($('<option>', {
                            value: district,
                            text: district
                        }));
                    });
                }
            });

        

           
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/egram/public_html/resources/views/master/taluka.blade.php ENDPATH**/ ?>