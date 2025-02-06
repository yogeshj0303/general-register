<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.create-user'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Bonafid</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
<form action="<?php echo e(route('bonafid.update', $bonafid->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?> <!-- Add PUT method for editing -->

    <div class="row gy-4">
        <!-- Row 1 -->
        <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-control select2 <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="state" name="state">
                                        <option value="">Select State</option>
                                        <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($state['state']); ?>" <?php echo e($bonafid->state === $state['state'] ? 'selected' : ''); ?>>
                                                <?php echo e($state['state']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['state'];
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
                                    <label for="district" class="form-label">District</label>
                                    <select id="district" name="district" class="form-control select2">
                                        <option value="<?php echo e($bonafid->district); ?>"><?php echo e($bonafid->district); ?></option>
                                    </select>
                                    <?php $__errorArgs = ['district'];
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
                                    <label for="taluka" class="form-label">Taluka</label>
                                    <select id="taluka-field" name="taluka" class="form-control select2">
                                        <option value="<?php echo e($bonafid->taluka); ?>"><?php echo e($bonafid->taluka); ?></option>
                                    </select>
                                    <?php $__errorArgs = ['taluka'];
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
                                
       <!-- Row 2 -->
        <div class="col-md-4">
    <label for="gram" class="form-label">Select School</label>
    <select class="form-control select2 <?php $__errorArgs = ['school_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gram-field" name="school_name">
        <option value="">Select Gram</option>
        <!-- Add options dynamically -->
    </select>
    <?php $__errorArgs = ['school_name'];
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
    <label for="school_address" class="form-label">School Address</label>
    <select class="form-control <?php $__errorArgs = ['school_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> select2" id="edit_school_address" name="school_address">
        <!-- Default value (empty initially) -->
        <option value="">Select Address</option>
    </select>
    <?php $__errorArgs = ['school_address'];
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
            <label for="student_name" class="form-label">Student Name</label>
            <input type="text" class="form-control <?php $__errorArgs = ['student_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="student_name" name="student_name" placeholder="Enter Student Name" value="<?php echo e(old('student_name', $bonafid->student_name)); ?>">
            <?php $__errorArgs = ['student_name'];
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
            <label for="general_register_number" class="form-label">General Register Number</label>
            <input type="number" class="form-control <?php $__errorArgs = ['general_register_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="general_register_number" name="general_register_number" placeholder="General Register Number" value="<?php echo e(old('general_register_number', $bonafid->general_register_number)); ?>" maxlength="12">
            <?php $__errorArgs = ['general_register_number'];
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
            <label for="religion" class="form-label">Religion (धर्म)</label>
            <input type="text" class="form-control <?php $__errorArgs = ['religion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="religion" name="religion" placeholder="Religion" value="<?php echo e(old('religion', $bonafid->religion)); ?>">
            <?php $__errorArgs = ['religion'];
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
            <label for="caste" class="form-label">Caste (जात)</label>
            <input type="text" class="form-control <?php $__errorArgs = ['caste'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="caste" name="caste" placeholder="Caste" value="<?php echo e(old('caste', $bonafid->caste)); ?>">
            <?php $__errorArgs = ['caste'];
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
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="dob" name="dob" value="<?php echo e(old('dob', $bonafid->dob)); ?>" onchange="updateDateInText()">
            <?php $__errorArgs = ['dob'];
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
            <label for="dob_text" class="form-label">Date of Birth (Text)</label>
            <input type="text" class="form-control" id="dob_text" name="birth_in_text" readonly value="<?php echo e(old('birth_in_text', $bonafid->birth_in_text)); ?>">
        </div>

        <div class="col-md-4">
            <label for="birth_place" class="form-label">Birth Place (Village/City)</label>
            <input type="text" class="form-control <?php $__errorArgs = ['birth_place'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="birth_place" name="birth_place" placeholder="Birth Place" value="<?php echo e(old('birth_place', $bonafid->birth_place)); ?>">
            <?php $__errorArgs = ['birth_place'];
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
            <label for="birth_place_taluka" class="form-label">Birth Place Taluka</label>
            <input type="text" class="form-control <?php $__errorArgs = ['birth_place_taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="birth_place_taluka" name="birth_place_taluka" placeholder="Birth Place Taluka" value="<?php echo e(old('birth_place_taluka', $bonafid->birth_place_taluka)); ?>">
            <?php $__errorArgs = ['birth_place_taluka'];
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
            <label for="birth_place_dist" class="form-label">Birth Place District</label>
            <input type="text" class="form-control <?php $__errorArgs = ['birth_place_dist'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="birth_place_dist" name="birth_place_dist" placeholder="Birth Place District" value="<?php echo e(old('birth_place_dist', $bonafid->birth_place_dist)); ?>">
            <?php $__errorArgs = ['birth_place_dist'];
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
            <label for="certificate_issued_date" class="form-label">Date of Certificate Issued</label>
            <input type="date" class="form-control <?php $__errorArgs = ['certificate_issued_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="certificate_issued_date" name="certificate_issued_date" placeholder="Date of Certificate Issued" value="<?php echo e(old('certificate_issued_date', $bonafid->certificate_issued_date ?: now()->toDateString())); ?>">
            <?php $__errorArgs = ['certificate_issued_date'];
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

        <!-- Add Submit and Back Buttons -->
        <div class="row mt-4">
            <div class="col-md-6 text-start">
                <a href="<?php echo e(route('bonafid.index')); ?>" class="btn btn-secondary">Back</a>
            </div>
            <div class="col-md-6 text-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
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


<script>
    function numberToWords(num) {
        const ones = [
            "", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", 
            "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"
        ];
        const tens = [
            "", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"
        ];

        if (num < 20) return ones[num];
        if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 === 0 ? "" : "-" + ones[num % 10]);
        return "";
    }

    function yearToWords(year) {
        if (year >= 2000 && year <= 2099) {
            // For years in the 2000s (e.g., 2025 -> "two thousand twenty-five")
            const thousands = "two thousand";
            const remainder = year % 100;
            return remainder === 0 ? thousands : `${thousands} ${numberToWords(remainder)}`;
        }
        // Handle other cases as needed (e.g., older years)
        return numberToWords(Math.floor(year / 1000)) + " thousand " + numberToWords(year % 100);
    }

    function updateDateInText() {
        const dobInput = document.getElementById('dob').value; // Get the selected date
        const dobTextInput = document.getElementById('dob_text');

        if (dobInput) {
            const dob = new Date(dobInput);

            const day = dob.getDate();
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            const month = monthNames[dob.getMonth()];
            const year = dob.getFullYear();

            const dayText = numberToWords(day);
            const yearText = yearToWords(year);

            dobTextInput.value = `${dayText} ${month} ${yearText}`; // Set formatted date in the text field
        } else {
            dobTextInput.value = ''; // Clear the field if no date is selected
        }
    }
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
    
     $(document).ready(function() {
        $('#taluka-field').select2({
            placeholder: 'Select Taluka',
            allowClear: true
        });
    });
      $(document).ready(function() {
        $('#gram-field').select2({
            placeholder: 'Select Gram',
            allowClear: true
        });
    });
    
</script>

<script>
$(document).ready(function() {
    // Initialize Select2 for all select elements
    $('.select2').select2({ placeholder: 'Select an option', allowClear: true });

    // Load dropdown values
    function loadDropdowns() {
        loadInitialDistricts();
        loadInitialTalukas();
        loadInitialGram();
    }

    // Function to load districts based on selected state
    function loadInitialDistricts() {
        var state = $('#state').val();
        if (state) {
            var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>;
            var selectedState = statesData.find(item => item.state === state);
            var districtDropdown = $('#district');
            
            districtDropdown.empty().append('<option value="">Select District</option>');
            if (selectedState) {
                selectedState.districts.forEach(district => {
                    districtDropdown.append($('<option>', { value: district, text: district }));
                });
                $('#district').val('<?php echo e($bonafid->district); ?>').trigger('change'); // Pre-select district
            }
        }
    }

    // Function to load talukas based on selected state and district
    function loadInitialTalukas() {
        var state = $('#state').val();
        var district = $('#district').val();
        if (state && district) {
            $.ajax({
                url: '<?php echo e(route('tehsils.get')); ?>', // Route for fetching talukas
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    var talukaDropdown = $('#taluka-field');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');
                    response.forEach(taluka => {
                        talukaDropdown.append($('<option>', { value: taluka, text: taluka }));
                    });
                    $('#taluka-field').val('<?php echo e($bonafid->taluka); ?>').trigger('change'); // Pre-select taluka
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }
    }

    // Function to load gram (school) based on selected state, district, and taluka
    function loadInitialGram() {
        var state = $('#state').val();
        var district = $('#district').val();
        var taluka = $('#taluka-field').val();

        if (state && district && taluka) {
            $.ajax({
                url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams (schools)
                type: 'GET',
                data: { state: state, district: district, taluka: taluka },
                success: function(response) {
                    var gramDropdown = $('#gram-field');
                    gramDropdown.empty().append('<option value="">Select Gram</option>');

                    // Assuming the response is an object with 'id' as the key and 'gram_name' as the value
                    if (response && typeof response === 'object') {
                        Object.entries(response).forEach(function([id, gram_name]) {
                            gramDropdown.append($('<option>', {
                                value: id,
                                text: gram_name
                            }));
                        });
                    }

                    // Pre-select gram if available in $bonafid data
                    $('#gram-field').val('<?php echo e($bonafid->school_name); ?>').trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching grams:', xhr.responseText);
                }
            });
        } else {
            // Clear Gram dropdown if any dependencies (state, district, taluka) are not selected
            $('#gram-field').empty().append('<option value="">Select Gram</option>');
        }

        // Clear the username dropdown as Gram changes
        $('#username').empty().append('<option value="">Select User Name</option>');
    }

    function loadSchoolAddress() {
    var selectedSchoolId = $('#gram-field').val();
    var addressDropdown = $('#edit_school_address');

    // Reset address dropdown
    addressDropdown.empty().append('<option value="">Select Address</option>');

    if (selectedSchoolId) {
        $.ajax({
            url: '<?php echo e(route('schools.getAddress')); ?>', // Route for fetching school address
            type: 'GET',
            data: { school_id: selectedSchoolId },
            success: function(response) {
                console.log('Response is:', response);

                // Check if the response contains the address property
                if (response && response.address) {
                    var address = response.address; // Extract the address value
                    console.log('address' , address);
                    
                    // Append the address as an option to the dropdown
                    addressDropdown.append($('<option>', {
                        value: address,
                        text: address
                    }));

                    // Set the selected value if applicable
                    var selectedAddress = '<?php echo e($bonafid->school_address); ?>';
                    console.log('Selected Address:', selectedAddress);

                    if (selectedAddress) {
                        addressDropdown.val(selectedAddress).trigger('change');
                    }
                } else {
                    console.warn('No address found for the selected school.');
                }
            },
            error: function(xhr) {
                console.error('Error fetching address:', xhr.responseText);
            }
        });
    } else {
        console.log("No selected school ID");
    }
}

    
    
    



    // Call the function to load initial dropdowns
    loadDropdowns();

    // Event listener for state change to load districts
    $('#state').change(function() {
        loadInitialDistricts();
        $('#taluka-field').empty().append('<option value="">Select Taluka</option>'); // Reset Taluka dropdown
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Reset Gram dropdown
        $('#school_address').empty().append('<option value="">Select Address</option>'); // Reset Address dropdown
    });

    // Event listener for district change to load talukas
    $('#district').change(function() {
        loadInitialTalukas();
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Reset Gram dropdown
        $('#school_address').empty().append('<option value="">Select Address</option>'); // Reset Address dropdown
    });

    // Event listener for taluka change to load grams
    $('#taluka-field').change(function() {
        loadInitialGram();
    });

    // Event listener for gram (school) change to load school address
    $('#gram-field').change(function() {
        loadSchoolAddress();
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/general-register.actthost.com/resources/views/bonafid/edit.blade.php ENDPATH**/ ?>