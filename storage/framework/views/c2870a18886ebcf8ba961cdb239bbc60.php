<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.update-user'); ?>
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
                    <h4 class="card-title mb-0 flex-grow-1">View LC</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        
                                                    <div class="row gy-4">
                                                        
                                                   <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" value="<?php echo e($lc->state); ?>" readonly>
        </div>
        <div class="col-md-4">
            <label for="district" class="form-label">District</label>
            <input type="text" class="form-control" id="district" value="<?php echo e($lc->district); ?>" readonly>
        </div>
        <div class="col-md-4">
            <label for="taluka" class="form-label">Taluka</label>
            <input type="text" class="form-control" id="taluka" value="<?php echo e($lc->taluka); ?>" readonly>
        </div>
        
        <div class="col-md-4">
            <label for="gram" class="form-label">School</label>
            <input type="text" class="form-control" id="gram" value="<?php echo e($lc->grams->gram_name); ?>" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="number" class="form-control" id="student_id" value="<?php echo e($lc->student_id); ?>" readonly>
        </div>

        <div class="col-md-4">
            <label for="adhar_number" class="form-label">Udash UID Number (Aadhar Number)</label>
            <input type="number" class="form-control" id="adhar_number" value="<?php echo e($lc->adhar_number); ?>" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_first_name" class="form-label">Student First Name</label>
            <input type="text" class="form-control" id="student_first_name" value="<?php echo e($lc->student_first_name); ?>" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_middle_name" class="form-label">Student Middle Name</label>
            <input type="text" class="form-control" id="student_middle_name" value="<?php echo e($lc->student_middle_name); ?>" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_last_name" class="form-label">Student Last Name</label>
            <input type="text" class="form-control" id="student_last_name" value="<?php echo e($lc->student_last_name); ?>" readonly>
        </div>
        
         <div class="col-md-4">
            <label for="mother_name" class="form-label">Mother's Name</label>
            <input type="text" class="form-control" id="mother_name" value="<?php echo e($lc->mother_name); ?>" readonly>
        </div>

        <!-- Nationality -->
        <div class="col-md-4">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" id="nationality" value="<?php echo e($lc->nationality); ?>" readonly>
        </div>

        <!-- Mother Tongue -->
        <div class="col-md-4">
            <label for="mother_tongue" class="form-label">Mother Tongue (मातृभाषा)</label>
            <input type="text" class="form-control" id="mother_tongue" value="<?php echo e($lc->mother_tongue); ?>" readonly>
        </div>

        <!-- Religion -->
        <div class="col-md-4">
            <label for="religion" class="form-label">Religion (धर्म)</label>
            <input type="text" class="form-control" id="religion" value="<?php echo e($lc->religion); ?>" readonly>
        </div>

        <!-- Caste -->
        <div class="col-md-4">
            <label for="caste" class="form-label">Caste (जात)</label>
            <input type="text" class="form-control" id="caste" value="<?php echo e($lc->caste); ?>" readonly>
        </div>

        <!-- Sub-caste -->
        <div class="col-md-4">
            <label for="sub_caste" class="form-label">Sub-caste (पोट जात)</label>
            <input type="text" class="form-control" id="sub_caste" value="<?php echo e($lc->sub_caste); ?>" readonly>
        </div>

        <!-- Birth Place -->
        <div class="col-md-4">
            <label for="birth_place" class="form-label">Birth Place (Village/City)</label>
            <input type="text" class="form-control" id="birth_place" value="<?php echo e($lc->birth_place); ?>" readonly>
        </div>

        <!-- Birth Place Taluka -->
        <div class="col-md-4">
            <label for="birth_place_taluka" class="form-label">Birth Place Taluka</label>
            <input type="text" class="form-control" id="birth_place_taluka" value="<?php echo e($lc->birth_place_taluka); ?>" readonly>
        </div>
        
         <div class="col-md-4">
            <label for="birth_place_dist" class="form-label">Birth Place District</label>
            <input type="text" class="form-control" id="birth_place_dist" value="<?php echo e($lc->birth_place_dist); ?>" readonly>
        </div>

        <!-- Birth Place State -->
        <div class="col-md-4">
            <label for="birth_place_state" class="form-label">Birth Place State</label>
            <input type="text" class="form-control" id="birth_place_state" value="<?php echo e($lc->birth_place_state); ?>" readonly>
        </div>

        <!-- Birth Place Country -->
        <div class="col-md-4">
            <label for="birth_place_country" class="form-label">Birth Place Country</label>
            <input type="text" class="form-control" id="birth_place_country" value="<?php echo e($lc->birth_place_country); ?>" readonly>
        </div>

        <!-- Date of Birth -->
        <div class="col-md-4">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" value="<?php echo e($lc->dob); ?>" readonly>
        </div>

        <!-- Date of Birth (Text) -->
        <div class="col-md-4">
            <label for="dob_text" class="form-label">Date of Birth (Text)</label>
            <input type="text" class="form-control" id="dob_text" value="<?php echo e($lc->birth_in_text); ?>" readonly>
        </div>

        <!-- Previous School -->
        <div class="col-md-4">
            <label for="previous_school" class="form-label">Previous School</label>
            <input type="text" class="form-control" id="previous_school" value="<?php echo e($lc->previous_school); ?>" readonly>
        </div>

        <!-- Standard -->
        <div class="col-md-4">
            <label for="standard" class="form-label">Standard</label>
            <input type="text" class="form-control" id="standard" value="<?php echo e($lc->standard); ?>" readonly>
        </div>

        <!-- Date of Admission -->
        <div class="col-md-4">
            <label for="date_of_admission" class="form-label">Date of Admission</label>
            <input type="date" class="form-control" id="date_of_admission" value="<?php echo e($lc->date_of_admission); ?>" readonly>
        </div>
        
      <div class="col-md-4">
    <label for="academic_progress" class="form-label">Academic Progress</label>
    <textarea class="form-control" id="academic_progress" name="academic_progress" readonly><?php echo e($lc->academic_progress ?? 'Not Provided'); ?></textarea>
</div>

<div class="col-md-4">
    <label for="behavior" class="form-label">Behavior</label>
    <textarea class="form-control" id="behavior" name="behavior" readonly><?php echo e($lc->behavior ?? 'Not Provided'); ?></textarea>
</div>

<div class="col-md-4">
    <label for="date_of_leaving_school" class="form-label">Date of Leaving School</label>
    <textarea class="form-control" id="date_of_leaving_school" name="date_of_leaving_school" readonly><?php echo e($lc->date_of_leaving_school ?? 'Not Provided'); ?></textarea>
</div>

<div class="col-md-4">
    <label for="other_studies" class="form-label">Any other studies attended and since (alpha and number)</label>
    <textarea class="form-control" id="other_studies" name="other_studies" readonly><?php echo e($lc->other_studies ?? 'Not Provided'); ?></textarea>
</div>

<div class="col-md-4">
    <label for="reason_for_leaving_school" class="form-label">Reason for Leaving School</label>
    <textarea class="form-control" id="reason_for_leaving_school" name="reason_for_leaving_school" readonly><?php echo e($lc->reason_for_leaving_school ?? 'Not Provided'); ?></textarea>
</div>

<div class="col-md-4">
    <label for="comments" class="form-label">Comments (शेरा)</label>
    <textarea class="form-control" id="comments" name="comments" readonly><?php echo e($lc->comments ?? 'Not Provided'); ?></textarea>
</div>


<!-- Row 12 -->
<div class="col-md-4">
    <label for="certificate_date" class="form-label">Date of Certificate Issued</label>
    <input type="text" class="form-control" id="certificate_date" name="certificate_date" value="<?php echo e($lc->certificate_date ?? 'Not Provided'); ?>" readonly>
</div>

<div class="col-md-4">
    <label for="certificate_month" class="form-label">Month of Certificate</label>
    <input type="text" class="form-control" id="certificate_month" name="certificate_month" value="<?php echo e($lc->certificate_month ? date('F', mktime(0, 0, 0, $lc->certificate_month, 10)) : 'Not Provided'); ?>" readonly>
</div>

<div class="col-md-4">
    <label for="certificate_year" class="form-label">Year of Certificate</label>
    <input type="text" class="form-control" id="certificate_year" name="certificate_year" value="<?php echo e($lc->certificate_year ?? 'Not Provided'); ?>" readonly>
</div>
                                                  
       <div class="row mt-4">
                                <div class="col-md-6">
                                    <a href="<?php echo e(route('lc.index')); ?>" class="btn btn-secondary">Back</a>
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
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/general-register.actthost.com/resources/views/LC/show.blade.php ENDPATH**/ ?>