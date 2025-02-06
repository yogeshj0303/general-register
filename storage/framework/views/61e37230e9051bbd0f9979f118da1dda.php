<?php $__env->startSection('title'); ?>
   <?php echo app('translator')->get('translation.list-js8'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Gram Annual Maintenance</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="<?php echo e(route('annual-maintenance.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select name="state" id="state" class="form-control js-example-basic-single <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select State</option>
                                        <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($state['state']); ?>" <?php echo e(old('state') == $state['state'] ? 'selected' : ''); ?>><?php echo e($state['state']); ?></option>
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
                                <div class="col-md-4">
                                    <label for="district" class="form-label">District</label>
                                    <select name="district" id="district" class="form-control js-example-basic-single <?php $__errorArgs = ['district'];
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
                                <div class="col-md-4">
                                    <label for="taluka" class="form-label">Taluka</label>
                                    <select name="taluka" id="taluka-field" class="form-select js-example-basic-single <?php $__errorArgs = ['taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select Taluka</option>
                                        <!-- Populate dynamically -->
                                    </select>
                                    <?php $__errorArgs = ['taluka'];
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
                               
                               <div class="col-md-4">
    <label for="category_name" class="form-label">Select Gram</label>
    <select class="form-control js-example-basic-single <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gram-field" name="gram">
        <option value="">Select Gram</option>
        <!-- Add options dynamically -->
    </select>
    <?php $__errorArgs = ['gram'];
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
<div class="col-md-4">
    <label for="maintenance_year" class="form-label">Maintenance Year</label>
    <select class="form-control js-example-basic-single <?php $__errorArgs = ['maintenance_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="maintenance_year" name="maintenance_year">
        <option value="">Select maintenance year</option>
        <!-- Options will be dynamically added here -->
    </select>
    <?php $__errorArgs = ['maintenance_year'];
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
                                <input type="hidden" id="reference_number" name="reference_number" value="">
                                <div class="col-md-4">
                                    <label for="maintenance_amount" class="form-label">Maintenance Amount</label>
                                    <input type="number"
                                        class="form-control <?php $__errorArgs = ['maintenance_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="maintenance_amount" name="maintenance_amount"
                                        placeholder="Enter Maintenance Amount">
                                    <?php $__errorArgs = ['maintenance_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="number"
                                        class="form-control <?php $__errorArgs = ['remaining_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="remaining_amount" name="remaining_amount"
                                        placeholder="Enter Remaining Amount" readonly>
                                    <?php $__errorArgs = ['remaining_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                               
                                <div class="col-md-4">
                                    <label for="payment_mode" class="form-label">Payment Mode</label>
                                    <select class="form-control <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="payment_mode" name="payment_mode">
                                        <option value="">Select Payment Mode</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Online">Online</option>
                                        <option value="RTGS">RTGS</option>
                                         <option value="Cheque">Cheque</option>
                                    </select>
                                    <?php $__errorArgs = ['payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description"
                                        rows="5" maxlength="5000"></textarea>
                                    <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="current_population" class="form-label">Current Population</label>
                                    <input type="number"
                                        class="form-control <?php $__errorArgs = ['current_population'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="current_population" name="current_population">
                                    <?php $__errorArgs = ['current_population'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4">
                                    <label for="bill_status" class="form-label">Bill Status</label>
                                    <select class="form-control <?php $__errorArgs = ['bill_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="bill_status" name="bill_status">
                                         <option value="complete">Complete</option>
                                        <option value="pending">Pending</option>
                                       
                                    </select>
                                    <?php $__errorArgs = ['bill_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <a href="<?php echo e(route('annual-maintenance.index')); ?>" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
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
        const textarea = document.getElementById('description');
        const charCountIndicator = document.getElementById('charCountIndicator');
        const maxChars = 5000;

        textarea.addEventListener('input', function() {
            const charCount = textarea.value.length;

            if (charCount > maxChars) {
                textarea.value = textarea.value.substring(0, maxChars); // Limit to maxChars
            }

            charCountIndicator.textContent = `Characters: ${charCount} / ${maxChars}`;
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
//   $(document).ready(function () {
//     // Handle state selection change
//     $('#state').change(function () {
//         var state = $(this).val();
//         var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

//         var districtDropdown = $('#district');
//         districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

//         var selectedState = statesData.find(function (item) {
//             return item.state === state;
//         });

//         if (selectedState) {
//             selectedState.districts.forEach(function (district) {
//                 districtDropdown.append($('<option>', {
//                     value: district,
//                     text: district
//                 }));
//             });
//         }

//         $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
//         $('#name').empty().append('<option value="">Select Profile Name</option>'); // Clear existing options
//         $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Clear grams dropdown
//     });

//     // Handle district selection change
//     $('#district').change(function () {
//         var state = $('#state').val();
//         var district = $(this).val();

//         if (state && district) {
//             $.ajax({
//                 url: '<?php echo e(route('tehsils.get')); ?>', // Ensure this matches your route
//                 type: 'GET',
//                 data: { state: state, district: district },
//                 success: function (response) {
//                     var talukaDropdown = $('#taluka-field');
//                     talukaDropdown.empty().append('<option value="">Select Taluka</option>');

//                     response.forEach(function (taluka) {
//                         talukaDropdown.append($('<option>', {
//                             value: taluka,
//                             text: taluka
//                         }));
//                     });
//                 },
//                 error: function (xhr) {
//                     console.error('Error fetching talukas:', xhr.responseText);
//                 }
//             });
//         }
//         $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Clear grams dropdown
//     });

//     // Handle taluka selection change
//     $('#taluka-field').change(function () {
//         var state = $('#state').val();
//         var district = $('#district').val();
//         var taluka = $(this).val();

//         if (state && district && taluka) {
//             $.ajax({
//                 url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
//                 type: 'GET',
//                 data: { state: state, district: district, taluka: taluka },
//                 success: function (response) {
//                     var gramDropdown = $('#gram-field');
//                     gramDropdown.empty().append('<option value="">Select Gram</option>');

//                     response.forEach(function (gram) {
//                         gramDropdown.append($('<option>', {
//                             value: gram,
//                             text: gram
//                         }));
//                     });
//                 },
//                 error: function (xhr) {
//                     console.error('Error fetching grams:', xhr.responseText);
//                 }
//             });
//         }
//     });
// });
</script>
<script>
    $(document).ready(function() {
        // Fetch user information from Blade variables
        var isAdmin = <?php echo json_encode(Auth::user()->is_admin === 'admin', 15, 512) ?>;
        var userState = <?php echo json_encode(Auth::user()->state, 15, 512) ?>;
        var userDistrict = <?php echo json_encode(Auth::user()->district, 15, 512) ?>;
        var userTaluka = <?php echo json_encode(Auth::user()->taluka, 15, 512) ?>;
        var userGram = <?php echo json_encode(Auth::user()->gram, 15, 512) ?>;
        var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        var stateDropdown = $('#state');
        var districtDropdown = $('#district');
        var talukaDropdown = $('#taluka-field');
        var gramDropdown = $('#gram-field');

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

            gramDropdown.empty().append($('<option>', {
                value: userGram,
                text: userGram,
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
                gramDropdown.empty().append('<option value="">Select Gram</option>');

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
                gramDropdown.empty().append('<option value="">Select Gram</option>');

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

            talukaDropdown.change(function() {
                var selectedState = stateDropdown.val();
                var selectedDistrict = districtDropdown.val();
                var selectedTaluka = $(this).val();

                gramDropdown.empty().append('<option value="">Select Gram</option>');

                if (selectedState && selectedDistrict && selectedTaluka) {
                    $.ajax({
                        url: '<?php echo e(route('grams.get')); ?>',
                        type: 'GET',
                        data: { state: selectedState, district: selectedDistrict, taluka: selectedTaluka },
                        success: function(response) {
                            response.forEach(function(gram) {
                                gramDropdown.append($('<option>', {
                                    value: gram,
                                    text: gram
                                }));
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching grams:', xhr.responseText);
                        }
                    });
                }
            });
        }
    });
</script>
<script>
    $(document).ready(function () {
        let originalMaintenanceAmount = 0; // Variable to store the fetched maintenance amount
        let isAdmin = <?php echo json_encode(Auth::user()->is_admin === 'admin', 15, 512) ?>; // Check if the user is an admin
        let userGram = <?php echo json_encode(Auth::user()->gram, 15, 512) ?>; // Get the gram value for non-admin users

        // If not admin, set the gram dropdown to the user's gram and disable it
        if (!isAdmin) {
            $('#gram-field').val(userGram); // Set and disable gram field for non-admin
            fetchMaintenanceData(userGram); // Fetch maintenance data for the user's gram
        }

        // Handle Gram selection (For Admin Users)
        $('#gram-field').on('change', function () {
            let selectedGram = $(this).val();
            if (selectedGram) {
                fetchMaintenanceData(selectedGram); // Fetch maintenance data based on selected gram
            } else {
                resetFields(); // Reset fields if no gram is selected
            }
        });

        // Function to fetch maintenance data
        function fetchMaintenanceData(gram) {
            $.ajax({
                url: "<?php echo e(route('get.maintenance.amount')); ?>",
                type: "POST",
                data: {
                    gram: gram,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function (response) {
                    if (response.success) {
                        // Populate Maintenance Years Dropdown
                        let yearOptions = '<option value="">Select maintenance year</option>';
                        response.maintenance_years.forEach(function (year) {
                            yearOptions += `<option value="${year}">${year}</option>`;
                        });
                        $('#maintenance_year').html(yearOptions);
                        $('#maintenance_amount').val(''); // Clear amount field
                        $('#remaining_amount').val(''); // Clear remaining amount field
                    } else {
                        alert(response.message);
                        resetFields(); // Reset fields if error occurs
                    }
                },
                error: function () {
                    alert('Error fetching maintenance details.');
                    resetFields(); // Reset fields on error
                }
            });
        }

        // Function to reset fields
        function resetFields() {
            $('#maintenance_year').html('<option value="">Select maintenance year</option>');
            $('#maintenance_amount').val('');
            $('#remaining_amount').val('');
             $('#bill_status').val('complete');
        }

        // Handle Year selection
        $('#maintenance_year').on('change', function () {
            let selectedGram = $('#gram-field').val();
            let selectedYear = $(this).val();

            if (selectedGram && selectedYear) {
                $.ajax({
                    url: "<?php echo e(route('get.maintenance.amount')); ?>",
                    type: "POST",
                    data: {
                        gram: selectedGram,
                        year: selectedYear,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#reference_number').val(response.reference_number);
                            // Populate Maintenance Amount
                            originalMaintenanceAmount = parseFloat(response.maintenance_amount);
                            $('#maintenance_amount').val(originalMaintenanceAmount);
                            $('#remaining_amount').val(0); // Reset remaining amount
                        } else {
                            alert(response.message);
                            resetFields(); // Reset fields if error occurs
                        }
                    },
                    error: function () {
                        alert('Error fetching maintenance amount.');
                        resetFields(); // Reset fields on error
                    }
                });
            } else {
                resetFields(); // Reset if no gram or year is selected
            }
        });

        // Handle Maintenance Amount input changes
        $('#maintenance_amount').on('input', function () {
            let inputAmount = parseFloat($(this).val());
            if (!isNaN(inputAmount)) {
                let remainingAmount = Math.max(0, originalMaintenanceAmount - inputAmount); // Calculate remaining amount
                $('#remaining_amount').val(remainingAmount);
                if (remainingAmount === 0) {
                $('#bill_status').val('complete');
            } else {
                $('#bill_status').val('pending');
            }
            } else {
                $('#remaining_amount').val(originalMaintenanceAmount); 
                if(originalMaintenanceAmount != 0){
                 $('#bill_status').val('pending');   
                }else{
                    $('#bill_status').val('complete');  
                }
                 
                // Reset to original value if input is invalid
            }
        });
    });
</script>

<script>


// $(document).ready(function () {
//     let originalMaintenanceAmount = 0; // Variable to store the fetched maintenance amount

//     // Handle Gram selection
//     $('#gram-field').on('change', function () {
//         let selectedGram = $(this).val();
//         if (selectedGram) {
//             $.ajax({
//                 url: "<?php echo e(route('get.maintenance.amount')); ?>",
//                 type: "POST",
//                 data: {
//                     gram: selectedGram,
//                     _token: "<?php echo e(csrf_token()); ?>"
//                 },
//                 success: function (response) {
//                     if (response.success) {
//                         // Populate Maintenance Years Dropdown
//                         let yearOptions = '<option value="">Select maintenance year</option>';
//                         response.maintenance_years.forEach(function (year) {
//                             yearOptions += `<option value="${year}">${year}</option>`;
//                         });
//                         $('#maintenance_year').html(yearOptions);
//                         $('#maintenance_amount').val(''); // Clear amount field
//                         $('#remaining_amount').val(''); // Clear remaining amount field
//                     } else {
//                         alert(response.message);
//                         $('#maintenance_year').html('<option value="">Select maintenance year</option>');
//                         $('#maintenance_amount').val('');
//                         $('#remaining_amount').val('');
//                     }
//                 },
//                 error: function () {
//                     alert('Error fetching maintenance details.');
//                     $('#maintenance_year').html('<option value="">Select maintenance year</option>');
//                     $('#maintenance_amount').val('');
//                     $('#remaining_amount').val('');
//                 }
//             });
//         } else {
//             $('#maintenance_year').html('<option value="">Select maintenance year</option>');
//             $('#maintenance_amount').val('');
//             $('#remaining_amount').val('');
//         }
//     });

//     // Handle Year selection
//     $('#maintenance_year').on('change', function () {
//         let selectedGram = $('#gram-field').val();
//         let selectedYear = $(this).val();

//         if (selectedGram && selectedYear) {
//             $.ajax({
//                 url: "<?php echo e(route('get.maintenance.amount')); ?>",
//                 type: "POST",
//                 data: {
//                     gram: selectedGram,
//                     year: selectedYear,
//                     _token: "<?php echo e(csrf_token()); ?>"
//                 },
//                 success: function (response) {
//                     if (response.success) {
//                         $('#reference_number').val(response.reference_number);
//                         // Populate Maintenance Amount
//                         originalMaintenanceAmount = parseFloat(response.maintenance_amount);
//                         $('#maintenance_amount').val(originalMaintenanceAmount);
//                         $('#remaining_amount').val(0); // Reset remaining amount
//                     } else {
//                         alert(response.message);
//                         $('#maintenance_amount').val('');
//                         $('#remaining_amount').val('');
//                     }
//                 },
//                 error: function () {
//                     alert('Error fetching maintenance amount.');
//                     $('#maintenance_amount').val('');
//                     $('#remaining_amount').val('');
//                 }
//             });
//         } else {
//             $('#maintenance_amount').val('');
//             $('#remaining_amount').val('');
//         }
//     });

//     // Handle Maintenance Amount input changes
//     $('#maintenance_amount').on('input', function () {
//         let inputAmount = parseFloat($(this).val());
//         if (!isNaN(inputAmount)) {
//             let remainingAmount = Math.max(0, originalMaintenanceAmount - inputAmount); // Calculate remaining amount
//             $('#remaining_amount').val(remainingAmount);
//         } else {
//             $('#remaining_amount').val(originalMaintenanceAmount); // Reset to original value if input is invalid
//         }
//     });
// });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/annual-maintenance/create.blade.php ENDPATH**/ ?>