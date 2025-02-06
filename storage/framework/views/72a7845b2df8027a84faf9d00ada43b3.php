<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Grams'); ?>
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
        <div class="col-xxl-7">
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
                    <h4 class="card-title mb-0 flex-grow-1">Gram</h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="gramTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gram Name</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>Village Address</th>
                                    <th>Pin Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $grams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr id="gramRow<?php echo e($gram->id); ?>">
                                    <td><?php echo e($gram->id); ?></td>
                                    <td><?php echo e($gram->gram_name); ?></td>
                                    <td><?php echo e($gram->state); ?></td>
                                    <td><?php echo e($gram->district); ?></td>
                                    <td><?php echo e($gram->taluka); ?></td>
                                    <td><?php echo e($gram->address); ?></td>
                                    <td><?php echo e($gram->pin_code); ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-primary editGram" data-id="<?php echo e($gram->id); ?>">
                                         <i class="fa fa-edit"></i> Edit
                                     </button>
<button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="<?php echo e($gram->id); ?>">
 Delete
</button>

<button class="btn btn-sm btn-success viewCategory my-3 " data-id="<?php echo e($gram->id); ?>">
    <i class="fa fa-eye"></i> View
</button>
  <button class="btn btn-sm btn-warning remove-item-btn" onclick="printAffidavit(<?php echo e($gram->id); ?>)">
    Print
</button>
<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/gramprint/' + userId, '_blank');
    
}

</script>




                                     </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center">No Grams found</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if($grams->isNotEmpty()): ?>
                            <div class="d-flex justify-content-center">
                                <?php echo $grams->links(); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Gram</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('grams.store')); ?>" method="POST" class="row g-3">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
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
                        <div class="col-md-12">
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
                            <label for="taluka" class="form-label">Taluka</label>
                            <select name="taluka" id="taluka-field" class="form-select">
                                <option value="">Select Taluka</option>
                                <!-- Populate dynamically -->
                            </select>
                        </div>
                       
                       

                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Gram Name</label>
                            <input type="text" name="gram_name" class="form-control <?php $__errorArgs = ['gram_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gram_name" placeholder="Enter Gram Name">
                            <?php $__errorArgs = ['gram_name'];
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
                            <label for="address" class="form-label">Village Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter Address"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="pincode" class="form-label">Pin Code</label>
                            <input type="text" name="pin_code" class="form-control" id="pincode" placeholder="Enter Pin Code">
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
        <div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editGramForm" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Gram</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                                <label for="editTaluka" class="form-label">Taluka</label>
                                <select name="taluka" id="editTaluka" class="form-select">
                                    <option value="">Select Taluka</option>
                                    <!-- Populate dynamically -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editGramName" class="form-label">Gram Name</label>
                                <input type="text" name="gram_name" class="form-control <?php $__errorArgs = ['gram_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="editGramName" required>
                                <?php $__errorArgs = ['gram_name'];
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
                                <label for="editAddress" class="form-label">Village Address</label>
                                <textarea name="address" id="editAddress" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editPincode" class="form-label">Pin Code</label>
                                <input type="text" name="pin_code" class="form-control" id="editPincode" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
  <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View Gram</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-3">
    <label for="viewState" class="form-label">State</label>
    <input type="text" class="form-control" id="viewState" readonly>
</div>

<!-- District -->
<div class="col-md-12 mb-3">
    <label for="viewDistrict" class="form-label">District</label>
    <input type="text" class="form-control" id="viewDistrict" readonly>
</div>

<!-- Taluka -->
<div class="col-md-12 mb-3">
    <label for="viewTaluka" class="form-label">Taluka</label>
    <input type="text" class="form-control" id="viewTaluka" readonly>
</div>


                <div class="mb-3">
                    <label for="viewName" class="form-label">Gram Name</label>
                    <input type="text" class="form-control" id="viewGram" readonly>
                </div>
                
                
                <div class="mb-3">
                    <label for="viewName" class="form-label">Village  Address</label>
                    <input type="text" class="form-control" id="viewvillage" readonly>
                </div>

                <div class="mb-3">
                    <label for="viewName" class="form-label">Pin code</label>
                    <input type="text" class="form-control" id="viewpincode" readonly>
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
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>




<script>
    $(document).on('click', '.viewCategory', function() {
    const gramid = $(this).data('id');

    // Fetch category data via AJAX
    $.ajax({
        url: `/gramshow/${gramid}`, 
        method: 'GET',
        success: function(response) {
 $('#viewState').val(response.state);
    $('#viewDistrict').val(response.district);
    $('#viewTaluka').val(response.taluka);
    $('#viewGram').val(response.gram_name);
        $('#viewvillage').val(response.address);
    $('#viewpincode').val(response.pin_code);



            // Show the modal
            $('#viewCategoryModal').modal('show');
        },
        error: function() {
            alert('Failed to fetch category details.');
        }
    });
});

</script>
<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="viewName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="viewName" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>







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
     $(document).ready(function() {
        $('#taluka-field').select2({
            placeholder: 'Select taluka',
            allowClear: true
        });
    });
</script>
<script>
    //  $(document).ready(function() {
    //         // Handle state selection change
    //         $('#state').change(function() {
    //             var state = $(this).val(); // Get the selected state value
    //             var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

    //             var districtDropdown = $('#district');
    //             districtDropdown.empty().append(
    //             '<option value="">Select District</option>'); // Clear existing options

    //             // Find the selected state object from the statesData array
    //             var selectedState = statesData.find(function(item) {
    //                 return item.state === state; // Match the selected state
    //             });

    //             // Check if the selected state is found
    //             if (selectedState) {
    //                 // Populate the district dropdown with the districts of the selected state
    //                 selectedState.districts.forEach(function(district) {
    //                     districtDropdown.append($('<option>', {
    //                         value: district, // Use the district name as the value
    //                         text: district // Display the district name as the option text
    //                     }));
    //                 });
    //             } else {
    //                 districtDropdown.append('<option value="">No districts available</option>');
    //             }

    //             // Clear the taluka field dropdown
    //             $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
    //         });
        
    //         $('#district').change(function() {
    //             var state = $('#state').val();
    //             var district = $(this).val();

    //             if (state && district) {
    //                 $.ajax({
    //                     url: '<?php echo e(route('tehsils.get')); ?>',
    //                     type: 'GET',
    //                     data: { state: state, district: district },
    //                     success: function(response) {
    //                         var talukaDropdown = $('#taluka-field');
    //                         talukaDropdown.empty().append('<option value="">Select Taluka</option>'); 

    //                         response.forEach(function(taluka) {
    //                             talukaDropdown.append($('<option>', {
    //                                 value: taluka,
    //                                 text: taluka
    //                             }));
    //                         });
    //                     },
    //                     error: function(xhr) {
    //                         console.error('Error fetching talukas:', xhr.responseText);
    //                     }
                        
                        
    //                 });
                
                    
                    
                    
    //             }
                
                
                
                
                
                
                        
                
                
    //         });

          
    //     });
</script>
<script>
    $(document).ready(function() {
        // Fetch user information from Blade variables
        var isAdmin = <?php echo json_encode(Auth::user()->is_admin === 'admin', 15, 512) ?>;
        var userState = <?php echo json_encode(Auth::user()->state, 15, 512) ?>;
        var userDistrict = <?php echo json_encode(Auth::user()->district, 15, 512) ?>;
        var userTaluka = <?php echo json_encode(Auth::user()->taluka, 15, 512) ?>;
       
        var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        var stateDropdown = $('#state');
        var districtDropdown = $('#district');
        var talukaDropdown = $('#taluka-field');
       

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

            talukaDropdown.empty().append($('<option>', {
                value: userTaluka,
                text: userTaluka,
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
                talukaDropdown.empty().append('<option value="">Select Taluka</option>');

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

            districtDropdown.change(function() {
                var selectedState = stateDropdown.val();
                var selectedDistrict = $(this).val();

                talukaDropdown.empty().append('<option value="">Select Taluka</option>');

                if (selectedState && selectedDistrict) {
                    $.ajax({
                        url: '<?php echo e(route('tehsils.get')); ?>',
                        type: 'GET',
                        data: { state: selectedState, district: selectedDistrict },
                        success: function(response) {
                            response.forEach(function(taluka) {
                                talukaDropdown.append($('<option>', {
                                    value: taluka,
                                    text: taluka
                                }));
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching talukas:', xhr.responseText);
                        }
                    });
                }
            });

           
        }
    });
</script>


<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
            var id = $(this).data('id');
            
         
            $.get('/gram/' + id + '/edit', function(data) {
                console.log(data);
                $('#editGramModal').modal('show');
               
                $('#editGramName').val(data.gram_name); // Correct ID
                $('#editState').val(data.state).change(); // Correct ID
            $('#editDistrict').val(data.district).change();
             
        $('#editTaluka').data('selected-taluka', data.taluka);
                $('#editAddress').val(data.address); // Correct ID
                $('#editPincode').val(data.pin_code); // Correct ID
                $('#editGramForm').attr('action', '/gram/' + id);
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
        $('#editTaluka').empty().append('<option value="">Select Taluka</option>');
    });
    
    
    
 $('#editDistrict').change(function() {
        var state = $('#editState').val();
        var district = $(this).val();

        if (state && district) {
            // Fetch Talukas
            $.ajax({
                url: '<?php echo e(route('tehsils.get')); ?>',
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    var talukaDropdown = $('#editTaluka');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');

                    response.forEach(function(taluka) {
                        talukaDropdown.append($('<option>', {
                            value: taluka,
                            text: taluka
                        }));
                    });

                    // Now set the selected taluka
                    var selectedTaluka = $('#editTaluka').data('selected-taluka');
                    console.log('selectedTaluka' + selectedTaluka);
                    if (selectedTaluka) {
                        $('#editTaluka').val(selectedTaluka);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }

        });

    
    
    
    
    
    
    

      $('#editState').select2({
        placeholder: 'Select state',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

    $('#editDistrict').select2({
        placeholder: 'Select district',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

  $('#editTaluka').select2({
        placeholder: 'Select Taluka',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });


        // Handle Edit Gram Form Submission
        $('#editGramForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = $(this);
            var actionUrl = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: actionUrl,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    var id = response.id;
                    $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name);
                    $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
                    $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
                    $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
                    $('#gramRow' + id + ' td:nth-child(6)').text(response.address);
                    $('#gramRow' + id + ' td:nth-child(7)').text(response.pin_code);
                    $('#editGramModal').modal('hide');
                    Swal.fire({
                        title: 'Success!',
                        text: 'Gram updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // Reload after closing the success alert
                        }
                    });
                },
                error: function(response) {
                    alert('An error occurred while trying to update the gram.');
                }
            });
        });

           });
</script>


<script>
     // Handle Delete Gram
        $('.remove-item-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/grams/' + id);
        });

        // Handle Delete Gram Form Submission
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
                    $('#gramRow' + id).remove();
                    $('#deleteRecordModal').modal('hide');
                    Swal.fire(
                            'Deleted!',
                            'Gram has been deleted successfully.',
                            'success'
                        );
                },
                error: function(response) {
                          Swal.fire(
                            'Error!',
                            'An error occurred while deleting the Gram.',
                            'error'
                        );                }
            });
        });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/master/gram.blade.php ENDPATH**/ ?>