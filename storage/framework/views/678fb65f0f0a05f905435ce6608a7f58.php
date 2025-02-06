<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.basic-elements'); ?>
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
                    <h4 class="card-title mb-0 flex-grow-1">Add Property Annual Taxation/ Water Annual Bill</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="<?php echo e(route('gharpatti-panipatti.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row gy-4">
                                <!-- Row 1 -->
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select name="state" id="state"
                                        class="form-control js-example-basic-single <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select State</option>
                                        <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($state['state']); ?>"
                                                <?php echo e(old('state') == $state['state'] ? 'selected' : ''); ?>>
                                                <?php echo e($state['state']); ?></option>
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
                                    <select name="district" id="district"
                                        class="form-control js-example-basic-single <?php $__errorArgs = ['district'];
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
                                    <select name="taluka" id="taluka-field"
                                        class="form-select js-example-basic-single <?php $__errorArgs = ['taluka'];
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
unset($__errorArgs, $__bag); ?>"
                                        id="gram-field" name="gram">
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
                                    <label for="username" class="form-label">Select User Name</label>
                                    <select class="form-control js-example-basic-single" id="username" name="username">
                                       <?php if(Auth::user()->is_admin === 'admin'): ?> <option value="">Select User Name</option> <?php endif; ?>
                                        <!-- Add options dynamically -->
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="type" class="form-label">Select Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="">--Select Type--</option>
                                        <option value="gharpatti">Property Annual Taxation</option>
                                        <option value="panipatti">Water Annual Bill</option>
                                    </select>
                                </div>
                            
                                <!-- Amount Type Input -->
                                <div class="col-md-4">
                                    <label for="amount_type" class="form-label">Assigned Amount </label>
                                    <input type="text" name="amount_type" id="amount_type" class="form-control" placeholder="Assigned Amount" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="paid_type" class="form-label">Amount Paid Type</label>
                                    <select class="form-control" id="paid_type" name="paid_type">
                                        <option value="cash">Cash</option>
                                        <option value="online">Online</option>
                                        <option value="rtgs">RTGS</option>
                                        <option value="check">Check</option>
                                    </select>
                                </div>
                                
                                  <div class="col-md-4">
                                    <label for="due_amount" class="form-label">Previous Year Pending Amount </label>
                                    <input type="text"  id="due_amount" class="form-control" placeholder="Pending Amount" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="paid_amount" class="form-label">Paid Amount</label>
                                    <input type="number" class="form-control" id="paid_amount" name="paid_amount"
                                        placeholder="Enter Paid Amount">
                                </div>

                                <!-- Row 4 -->
                                <div class="col-md-4">
                                    <label for="paid_date" class="form-label">Paid Date</label>
                                    <input type="datetime-local" class="form-control" id="paid_date" name="paid_date">
                                </div>
                                <div class="col-md-4">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="number" class="form-control" id="remaining_amount"
                                        name="remaining_amount" placeholder="Enter Remaining Amount">
                                </div>
                                <div class="col-md-4">
                                    <label for="send_bill" class="form-label">Send Bill On WhatsApp</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="send_bill" value="1">
                                        <label class="form-check-label" for="send_bill">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <a href="<?php echo e(route('gharpatti-panipatti.index')); ?>" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form>
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
    <?php if(Auth::user()->is_admin == 'admin'): ?>
    <script>
        $(document).ready(function() {
            // Handle state selection change
            $('#state').change(function() {
                var state = $(this).val();
                var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript
    
                var districtDropdown = $('#district');
                districtDropdown.empty().append(
                    '<option value="">Select District</option>'); // Clear existing options
    
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
    
                // Clear dependent dropdowns
                $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
                $('#gram-field').empty().append('<option value="">Select Gram</option>');
                $('#username').empty().append('<option value="">Select User Name</option>'); // Clear user dropdown
            });
    
            // Handle district selection change
            $('#district').change(function() {
                var state = $('#state').val();
                var district = $(this).val();
    
                if (state && district) {
                    $.ajax({
                        url: '<?php echo e(route('tehsils.get')); ?>', // Ensure this matches your route
                        type: 'GET',
                        data: {
                            state: state,
                            district: district
                        },
                        success: function(response) {
                            var talukaDropdown = $('#taluka-field');
                            talukaDropdown.empty().append(
                                '<option value="">Select Taluka</option>');
    
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
                // Clear dependent dropdowns
                $('#gram-field').empty().append('<option value="">Select Gram</option>');
                $('#username').empty().append('<option value="">Select User Name</option>'); // Clear user dropdown
            });
    
            // Handle taluka selection change
            $('#taluka-field').change(function() {
                var state = $('#state').val();
                var district = $('#district').val();
                var taluka = $(this).val();
    
                if (state && district && taluka) {
                    $.ajax({
                        url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
                        type: 'GET',
                        data: {
                            state: state,
                            district: district,
                            taluka: taluka
                        },
                        success: function(response) {
                            var gramDropdown = $('#gram-field');
                            gramDropdown.empty().append(
                                '<option value="">Select Gram</option>');
    
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
                // Clear user dropdown
                $('#username').empty().append('<option value="">Select User Name</option>');
            });
    
            // Handle gram selection change
            $('#gram-field').change(function() {
                var state = $('#state').val();
                var district = $('#district').val();
                var taluka = $('#taluka-field').val();
                var gram = $(this).val();
          if (state && district && taluka && gram) {
    $.ajax({
        url: '<?php echo e(route('users.getByGram')); ?>', // Route for fetching users based on gram
        type: 'GET',
        data: {
            state: state,
            district: district,
            taluka: taluka,
            gram: gram
        },
        success: function(response) {
            var usernameDropdown = $('#username');
            usernameDropdown.empty().append('<option value="">Select User Name</option>'); // Clear existing options
console.log(response);
            response.forEach(function(user) {
                usernameDropdown.append($('<option>', {
                    value: user.id, // Assuming each user has an ID
                    text: user.name, // Assuming each user has a 'username' field
                    'data-gharpatti-annual': user.gharpatti.annual, 
                    'data-gharpatti-pending': user.gharpatti.pending,
                    'data-gharpatti-total_due': user.gharpatti.total_due,
                    'data-gharpatti-total_paid': user.gharpatti.total_paid,
                    
                    'data-panipatti-annual': user.panipatti.annual, 
                    'data-panipatti-pending': user.panipatti.pending,
                    'data-panipatti-total_due': user.panipatti.total_due,
                    'data-panipatti-total_paid': user.panipatti.total_paid,
                    
                    // 'data-panipatti-annual': user.panipatti_annual // Store panipatti_annual as data attribute
                }));
            });
        },
        error: function(xhr) {
            console.error('Error fetching users:', xhr.responseText);
        }
    });
}

// Update fields when type or username changes
$('#type, #username').on('change', function () {
    var selectedType = $('#type').val();
    var selectedUser = $('#username').find(':selected');

    var gharpattiAnnual = selectedUser.data('gharpatti-annual'); 
    var gharpattiDue = selectedUser.data('gharpatti-pending');// Get gharpatti_annual
    var panipattiAnnual = selectedUser.data('panipatti-annual'); // Get panipatti_annual
    var panipattiDue = selectedUser.data('panipatti-pending');
    
    
    var amountTypeInput = $('#amount_type');
    var paidAmountInput = $('#paid_amount');
      var DueAmountInput = $('#due_amount');
    var remainingAmountInput = $('#remaining_amount');

    var totalAmount = 0;

    // Update the amount type value and calculate the total amount
    if (selectedType === 'gharpatti') {
        totalAmount = gharpattiDue || 0;
        amountTypeInput.val(gharpattiAnnual || '');
    DueAmountInput.val((gharpattiDue - gharpattiAnnual) >= 0 ? gharpattiDue - gharpattiAnnual : '');
 if (totalAmount === 0) {
        Swal.fire({
            title: "No Dues!",
            text: "This bill has already been paid.",
            icon: "info",
            confirmButtonText: "OK"
        }).then(() => {
            window.location.href = '<?php echo e(route("gharpatti-panipatti.index")); ?>';
        });
        return; // Exit function to prevent further updates
    }
        
    } else if (selectedType === 'panipatti') {
        totalAmount = panipattiDue || 0;
        amountTypeInput.val(panipattiAnnual || '');
        DueAmountInput.val((panipattiDue - panipattiAnnual) >= 0 ? panipattiDue - panipattiAnnual : '');
 if (totalAmount === 0) {
        Swal.fire({
            title: "No Dues!",
            text: "This bill has already been paid.",
            icon: "info",
            confirmButtonText: "OK"
        }).then(() => {
            window.location.href = '<?php echo e(route("gharpatti-panipatti.index")); ?>';
        });
        return; // Exit function to prevent further updates
    }
         
    } else {
        amountTypeInput.val('');
    }

 
    // By default, set Paid Amount to Total Amount
    paidAmountInput.val(totalAmount);
    
    

    // Calculate the remaining amount
    var remainingAmount = totalAmount - parseFloat(paidAmountInput.val() || 0);
    remainingAmountInput.val(remainingAmount >= 0 ? remainingAmount : 0);
    
   
});

// Recalculate remaining amount when paid amount is manually updated
$('#paid_amount').on('input', function () {
    var selectedType = $('#type').val();
    var selectedUser = $('#username').find(':selected');

    var gharpattiAnnual = selectedUser.data('gharpatti-annual');
    var panipattiAnnual = selectedUser.data('panipatti-annual');
      var gharpattiDue = selectedUser.data('gharpatti-pending');
        var panipattiDue = selectedUser.data('panipatti-pending');

    var totalAmount = selectedType === 'gharpatti' ? gharpattiDue : 
                      selectedType === 'panipatti' ? panipattiDue : 0;

    var paidAmount = parseFloat($(this).val()) || 0;
    var remainingAmount = totalAmount - paidAmount;

    $('#remaining_amount').val(remainingAmount >= 0 ? remainingAmount : 0);
});

            });
        });
    </script>
    <?php else: ?>
    <script>
    $(document).ready(function() {
        var user = <?php echo json_encode(Auth::user(), 15, 512) ?>; // Pass Auth::user() data to JavaScript

        // Initialize dropdowns based on user role
        var stateDropdown = $('#state');
        var districtDropdown = $('#district');
        var talukaDropdown = $('#taluka-field');
        var gramDropdown = $('#gram-field');
        var usernameDropdown = $('#username');

        if (user.is_admin !== 'admin') {
            // Non-admin user: Restrict to user's state, district, taluka, and gram
            stateDropdown.empty().append(
                `<option value="${user.state}">${user.state}</option>`
            );

            districtDropdown.empty().append(
                `<option value="${user.district}">${user.district}</option>`
            );

            talukaDropdown.empty().append(
                `<option value="${user.taluka}">${user.taluka}</option>`
            );

            gramDropdown.empty().append(
                `<option value="${user.gram}">${user.gram}</option>`
            );

            // Fetch and populate user-specific data
            $.ajax({
                url: '<?php echo e(route("users.getByGram")); ?>',
                type: 'GET',
                data: {
                    state: user.state,
                    district: user.district,
                    taluka: user.taluka,
                    gram: user.gram
                },
               success: function(response) {
    // usernameDropdown.empty().append('<option value="">Select User Name</option>'); // Clear existing options
    response.forEach(function(userData) {
         // Check if the user ID matches Auth::user()->id
            usernameDropdown.append($('<option>', {
                value: userData.id,
                text: userData.name,
                'data-gharpatti-annual': userData.gharpatti.annual,
                'data-gharpatti-pending': userData.gharpatti.pending,
                'data-gharpatti-total_due': userData.gharpatti.total_due,
                'data-gharpatti-total_paid': userData.gharpatti.total_paid,
                'data-panipatti-annual': userData.panipatti.annual,
                'data-panipatti-pending': userData.panipatti.pending,
                'data-panipatti-total_due': userData.panipatti.total_due,
                'data-panipatti-total_paid': userData.panipatti.total_paid,
            }));
        
    });
},

                error: function(xhr) {
                    console.error('Error fetching users:', xhr.responseText);
                }
            });
        } else {
            // Admin user: Allow all options to be selected
            stateDropdown.prop('disabled', false);
            districtDropdown.prop('disabled', false);
            talukaDropdown.prop('disabled', false);
            gramDropdown.prop('disabled', false);

            // Populate states dropdown
            var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data
            statesData.forEach(function(item) {
                stateDropdown.append($('<option>', {
                    value: item.state,
                    text: item.state
                }));
            });
        }

        // Handle type and username selection for both admin and non-admin
        $('#type, #username').on('change', function() {
            var selectedType = $('#type').val();
            var selectedUser = usernameDropdown.find(':selected');

            var gharpattiAnnual = selectedUser.data('gharpatti-annual');
            var gharpattiDue = selectedUser.data('gharpatti-pending');
            var panipattiAnnual = selectedUser.data('panipatti-annual');
            var panipattiDue = selectedUser.data('panipatti-pending');

            var amountTypeInput = $('#amount_type');
            var paidAmountInput = $('#paid_amount');
            var dueAmountInput = $('#due_amount');
            var remainingAmountInput = $('#remaining_amount');

            var totalAmount = 0;

            if (selectedType === 'gharpatti') {
                totalAmount = gharpattiDue || 0;
                amountTypeInput.val(gharpattiAnnual || '');
                dueAmountInput.val(gharpattiDue || '');
                if (totalAmount === 0) {
                    Swal.fire({
                        title: "No Dues!",
                        text: "This bill has already been paid.",
                        icon: "info",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = '<?php echo e(route("gharpatti-panipatti.index")); ?>';
                    });
                    return;
                }
            } else if (selectedType === 'panipatti') {
                totalAmount = panipattiDue || 0;
                amountTypeInput.val(panipattiAnnual || '');
                dueAmountInput.val(panipattiDue || '');
                if (totalAmount === 0) {
                    Swal.fire({
                        title: "No Dues!",
                        text: "This bill has already been paid.",
                        icon: "info",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = '<?php echo e(route("gharpatti-panipatti.index")); ?>';
                    });
                    return;
                }
            } else {
                amountTypeInput.val('');
            }

            paidAmountInput.val(totalAmount);
            var remainingAmount = totalAmount - parseFloat(paidAmountInput.val() || 0);
            remainingAmountInput.val(remainingAmount >= 0 ? remainingAmount : 0);
        });

        // Update remaining amount when paid amount changes
        $('#paid_amount').on('input', function() {
            var selectedType = $('#type').val();
            var selectedUser = usernameDropdown.find(':selected');

            var gharpattiDue = selectedUser.data('gharpatti-pending');
            var panipattiDue = selectedUser.data('panipatti-pending');

            var totalAmount = selectedType === 'gharpatti' ? gharpattiDue :
                selectedType === 'panipatti' ? panipattiDue : 0;

            var paidAmount = parseFloat($(this).val()) || 0;
            var remainingAmount = totalAmount - paidAmount;

            $('#remaining_amount').val(remainingAmount >= 0 ? remainingAmount : 0);
        });
    });
</script>

<?php endif; ?>



    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/gharpatti-panipatti/create.blade.php ENDPATH**/ ?>