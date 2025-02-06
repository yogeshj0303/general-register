<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.list-js2'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .file-item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .file-item span {
            font-size: 14px;
        }

        .file-item button {
            margin-left: 10px;
        }
    </style>
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
                    <h4 class="card-title mb-0 flex-grow-1">About Gram</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="gramTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>Gram Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                                            <?php if((isset($permissions)) && (  
    ($permissions['about_gram_viewown'] == 2) ||  ($permissions['about_gram_viewall'] == 2) 
)): ?>
                            <tbody>
                                <?php $__currentLoopData = $aboutGrams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($gram->id); ?></td>
                                        <td><?php echo e($gram->state); ?></td>
                                        <td><?php echo e($gram->district); ?></td>
                                        <td><?php echo e($gram->taluka); ?></td>
                                        <td><?php echo e($gram->gram); ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <!-- Edit Button (Trigger Modal) -->
                                               <?php if((isset($permissions)) && (  
    ($permissions['about_gram_edit'] == 2)
)): ?>
        <button class="btn btn-sm btn-primary editGram" data-id="<?php echo e($gram->id); ?>">
            <i class="fa fa-edit"></i> Edit
        </button>
        <?php endif; ?>
         <?php if((isset($permissions)) && (  
    ($permissions['about_gram_delete'] == 2)
)): ?>

                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal" data-id="<?php echo e($gram->id); ?>">
                                                Delete
                                            </button>
                                            <?php endif; ?>


  <button class="btn btn-sm btn-success viewuser" data-id="<?php echo e($gram->id); ?>">
    <i class="fa fa-eye"></i> View
</button>
 <?php if((isset($permissions)) && (  
    ($permissions['about_gram_print'] == 2)
)): ?>
 <button class="btn btn-sm btn-warning remove-item-btn " onclick="printAffidavit(<?php echo e($gram->id); ?>)">
    Print
</button>
<?php endif; ?>
<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/aboutgramprint/' + userId, '_blank');
      
}

</script>


                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                            <?php endif; ?>
                        </table>
                         <?php if((isset($permissions)) && (  
    ($permissions['about_gram_viewown'] == 2) ||  ($permissions['about_gram_viewall'] == 2) 
)): ?>
                        <?php if($aboutGrams->isNotEmpty()): ?>
                            <div class="d-flex justify-content-center">
                                <?php echo $aboutGrams->links(); ?>

                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <?php if((isset($permissions)) && (  
    ($permissions['about_gram_add'] == 2)
)): ?>
        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add About Gram</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('about-gram.store')); ?>"  id="registerForm" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
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
                                        <?php echo e(old('state') == $state['state'] ? 'selected' : ''); ?>><?php echo e($state['state']); ?>

                                    </option>
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
                        <div class="col-md-12">
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



                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Gram Name</label>
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


                        <div class="col-md-12 mb-3">
                            <label for="gram" class="form-label">About Gram</label>
                            <textarea id="aboutGram" class="form-control" name="about_gram" rows="5" maxlength="5000"></textarea>
                            <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                            <?php $__errorArgs = ['about_gram'];
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
                            <label for="pdf" class="form-label">Select PDF</label>
                            <input type="file" class="form-control <?php $__errorArgs = ['pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pdf"
                                name="pdf" onchange="handleFileSelect(event)">
                        </div>

                        <div id="fileList" class="mt-3"></div>





                        <div class="col-12">
                            <div class="text-end">
<button id="submitButton" type="submit" class="btn btn-primary" >Submit</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
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
    
            <div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editGramForm" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editGramModalLabel">Edit Gram</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- State Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="state" class="form-label">State</label>
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
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
        
                            <!-- District Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="district" class="form-label">District</label>
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
                                    <div class="invalid-feedback">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
        
                            <!-- Taluka Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="taluka" class="form-label">Taluka</label>
                                <select name="taluka" id="editTaluka" class="form-select">
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
        
                            <!-- Gram Name Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="gram" class="form-label">Gram Name</label>
                                <select class="form-control <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="editGramName" name="gram">
                                    <option value="">Select Gram</option>
                                    <!-- Gram options will be added dynamically -->
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
        
                            
                                                    <div class="col-md-12 mb-3">
                            <label for="gram" class="form-label">About Gram</label>
                            <textarea id="aboutGramedit" class="form-control" name="about_gram" rows="5" maxlength="5000"></textarea>
                            <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                            <?php $__errorArgs = ['about_gram'];
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

        
                         <div class="col-md-12 mb-3">
    <label for="pdf" class="form-label">Select PDF </label>
    <input type="file" class="form-control <?php $__errorArgs = ['pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pdfedit" name="pdf[]" multiple onchange="handleFileSelectEdit(event)">
</div>

<div id="filePreview" class="mt-3">
    
   
</div>


<div id="fileListedit" class="mt-3"></div>


                            <div class="col-md-12">
                        <label for="viewPdf" class="form-label"></label>
                        <div id="pdfViewerContaineredit">
                        </div>
                    </div>


                        </div>
                        
                   
                        <div class="modal-footer">
                            <div class="text-end">
<button type="submit" class="btn btn-primary" id="updateButton" >Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
<div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="progressModalLabel">Uploading...</h5>
            </div>
            <div class="modal-body">
                <div id="totalFileSizeDisplay" class="mb-3"></div>
                <div class="progress">
                    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>
                <div id="remainingDisplay"></div>
                <div id="timeDisplay"></div>
                <div id="speedDisplay"></div>
                <p class="mt-3 text-center" id="progressText">Please wait while we upload your data.</p>
            </div>
        </div>
    </div>
</div>

    <!--<div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">-->
    <!--    <div class="modal-dialog">-->
    <!--        <div class="modal-content">-->
    <!--            <form id="editGramForm" method="POST" enctype="multipart/form-data">-->
    <!--                <?php echo csrf_field(); ?>-->
    <!--                <?php echo method_field('PUT'); ?>-->
    <!--                <div class="modal-header">-->
    <!--                    <h5 class="modal-title" id="editGramModalLabel">Edit About Gram</h5>-->
    <!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--                </div>-->
    <!--                <div class="modal-body">-->
                        <!-- State Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="state" class="form-label">State</label>-->
    <!--                        <select name="state" id="state"-->
    <!--                            class="form-control js-example-basic-single <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">-->
    <!--                            <option value="">Select State</option>-->
    <!--                            <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
    <!--                                <option value="<?php echo e($state['state']); ?>"-->
    <!--                                    <?php echo e(old('state') == $state['state'] ? 'selected' : ''); ?>><?php echo e($state['state']); ?>-->
    <!--                                </option>-->
    <!--                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
    <!--                        </select>-->
    <!--                        <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                <?php echo e($message); ?>-->
    <!--                            </div>-->
    <!--                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
    <!--                    </div>-->

                        <!-- District Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="district" class="form-label">District</label>-->
    <!--                        <select name="district" id="district"-->
    <!--                            class="form-control <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">-->
    <!--                            <option value="">Select District</option>-->
                                <!-- District options will be populated dynamically -->
    <!--                        </select>-->
    <!--                        <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                <?php echo e($message); ?>-->
    <!--                            </div>-->
    <!--                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
    <!--                    </div>-->

                        <!-- Taluka Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="taluka" class="form-label">Taluka</label>-->
    <!--                        <select name="taluka" id="taluka"-->
    <!--                            class="form-select <?php $__errorArgs = ['taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">-->
    <!--                            <option value="">Select Taluka</option>-->
                                <!-- Taluka options will be populated dynamically -->
    <!--                        </select>-->
    <!--                        <?php $__errorArgs = ['taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                <?php echo e($message); ?>-->
    <!--                            </div>-->
    <!--                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
    <!--                    </div>-->

                        <!-- Gram Name Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="gram" class="form-label">Gram Name</label>-->
    <!--                        <select class="form-control <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gram-field"-->
    <!--                            name="gram">-->
    <!--                            <option value="">Select Gram</option>-->
                                <!-- Gram options will be added dynamically -->
    <!--                        </select>-->
    <!--                        <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                <?php echo e($message); ?>-->
    <!--                            </div>-->
    <!--                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
    <!--                    </div>-->

    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="gram" class="form-label">About Gram</label>-->
    <!--                        <textarea id="aboutGram" class="form-control" name="about_gram" rows="5" maxlength="5000"></textarea>-->
    <!--                        <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>-->
    <!--                        <?php $__errorArgs = ['about_gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                <?php echo e($message); ?>-->
    <!--                            </div>-->
    <!--                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>-->
    <!--                    </div>-->




                        <!-- PDF Upload -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="pdf" class="form-label">Select PDF (Multiple)</label>-->
    <!--                        <input type="file" class="form-control <?php $__errorArgs = ['pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pdf"-->
    <!--                            name="pdf[]" multiple onchange="handleFileSelect(event)">-->
    <!--                    </div>-->

                        <!-- File Preview -->
    <!--                    <div id="fileList" class="mt-3"></div>-->

    <!--                </div>-->
    <!--                <div class="modal-footer">-->
    <!--                    <div class="text-end">-->
    <!--                        <button type="submit" class="btn btn-primary">Submit</button>-->
    <!--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    
    
    
    
            <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">About Gram</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- State -->
                    <div class="col-md-12">
                        <label for="viewState" class="form-label">State</label>
                        <input type="text" class="form-control" id="viewState" readonly>
                    </div>

                    <!-- District -->
                    <div class="col-md-12">
                        <label for="viewDistrict" class="form-label">District</label>
                        <input type="text" class="form-control" id="viewDistrict" readonly>
                    </div>

                    <!-- Taluka Name -->
                    <div class="col-md-12">
                        <label for="viewName" class="form-label">Taluka Name</label>
                        <input type="text" class="form-control" id="viewName" readonly>
                    </div>

                    <!-- Gram -->
                    <div class="col-md-12">
                        <label for="viewGram" class="form-label">Gram</label>
                        <input type="text" class="form-control" id="viewGram" readonly>
                    </div>
                    
                    
               <div class="col-md-12">
                        <label for="viewaboutGram" class="form-label">About Gram</label>
                        <input type="text" class="form-control" id="viewaboutGram" readonly>
                    </div>
                 
                                     <div class="col-md-12">
                        <label for="viewPdf" class="form-label"></label>
                        <div id="pdfViewerContainer">
                        </div>
                    </div>

                   

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
    $(document).on('click', '.viewuser', function() {
        const id = $(this).data('id'); // Fetch the user ID from the data-id attribute

        $.ajax({
            url: `/about-gram/${id}`, 
            method: 'GET',
            success: function(response) {
                                const gramBill = response.AboutGram || {};

                console.log(response);
                              $('#viewState').val(gramBill.state || 'N/A');
                $('#viewDistrict').val(gramBill.district || 'N/A');
                $('#viewName').val(gramBill.taluka || 'N/A');
                $('#viewGram').val(gramBill.gram || 'N/A');
                              $('#viewaboutGram').val(gramBill.about_gram || 'N/A');
                              
                              
                              
                              
                              
                              
                              
                                              const pdfPath = gramBill.path || ''; 

                if (pdfPath) {
const fileLink =  pdfPath;
    
    
    console.log(fileLink);
    
    const pdfElement = `
        <div>
            <a href="${fileLink}" target="_blank">View PDF</a>
        </div>
    `;
    $('#pdfViewerContainer').html(pdfElement); 

                } else {
                    $('#pdfViewerContainer').html('<p>No PDF available</p>'); 
                }
                
                
                

                $('#viewCategoryModal').modal('show');

            },
            error: function() {
                alert('Failed to fetch user details.');
            }
            
            
            
            
            
        });
        
        
        
        
        
        
        
        
    });
    
    
    
    
    
    
</script>









<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
    var id = $(this).data('id');
    
                $.get('/about-gram/' + id + '/edit', function(data) {
        console.log(data);

        $('#editGramModal').modal('show');
                $('#editState').val(data.gram.state).change(); 
            $('#editDistrict').val(data.gram.district).change();
             
$('#editTaluka').data('selected-taluka', data.gram.taluka).trigger('change'); 
$('#editTaluka').val(data.gram.taluka); 

        var talukaa = $('#editTaluka').val();
        console.log('taluka after set' + talukaa);


        $('#editGramName').data('selected-gram', data.gram.gram); 

console.log('About Gram:', data.gram.about_gram);

$('#aboutGramedit').val(data.gram.about_gram);

const pdfPath = data.gram.path || ''; 
                if (pdfPath) {
    const fileLink =  pdfPath;
    const pdfElement = `
        <div>
            <a href="${fileLink}" target="_blank">View PDF</a>
        </div>
    `;
    $('#pdfViewerContaineredit').html(pdfElement); 

                } else {
                    $('#pdfViewerContaineredit').html('<p>No PDF available</p>'); 
                }
                






        
        $('#editGramForm').attr('action', '/about-gram/' + id); // Set the form action URL
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
        
        console.log('selectedState' + selectedState);

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
                    $('#editTaluka').val(selectedTaluka).trigger('change');
        console.log('Taluka after setting in dropdown:', $('#editTaluka').val());
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }

        });

    
    
    
    
$('#editTaluka').change(function () {
    console.log('enterrrrr');
    var state = $('#editState').val(); // Get selected state
    var district = $('#editDistrict').val(); // Get selected district
    var taluka = $('#editTaluka').val(); // Get selected district

    
    console.log('taluka' + taluka);

    if (state && district && taluka) {
        $.ajax({
            url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
            type: 'GET',
            data: { state: state, district: district, taluka: taluka },
            success: function (response) {
                console.log(response);
                var gramDropdown = $('#editGramName'); // Target gram dropdown
                gramDropdown.empty().append('<option value="">Select Gram</option>');

                // Populate the gram dropdown
                response.forEach(function (gram) {
                    gramDropdown.append($('<option>', {
                        value: gram.id, // Assuming each gram has an `id` in the response
                        text: gram // Assuming each gram has a `name` in the response
                    }));
                });

                // Set the selected gram if available
var selectedGram = $('#editGramName').data('selected-gram');
if (selectedGram) {
    console.log('Setting selected gram:', selectedGram);
    $('#editGramName').val(selectedGram).trigger('change');
                        console.log('Gram after setting:', gramDropdown.val());

    
    
}            },
            error: function (xhr) {
                console.error('Error fetching grams:', xhr.responseText);
            }
        });
    } else {
        // Clear Gram dropdown if dependencies are not selected
        $('#editGramName').empty().append('<option value="">Select Gram</option>');
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


$('#editGramName').select2({
        placeholder: 'Select gram',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

$('#editcategory').select2({
        placeholder: 'Select category',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });






    $('#editGramForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var actionUrl = form.attr('action');

        // Prepare form data
        var formData = new FormData(this);

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false, // For FormData
            contentType: false, // For FormData
            success: function(response) {
                var id = response.id;
                // Update the table with the new data (example)
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name);
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
            $('#gramRow' + id + ' td:nth-child(6)').text(response.about_gram);
            $('#gramRow' + id + ' td:nth-child(7)').text(response.pdf_files); 

                // Hide the modal
                $('#editGramModal').modal('hide');

                // Success message with SweetAlert
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
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while trying to update the gram.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });


       
    });
</script>
    
    
  <script>
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', '/about-gram/' + id);
    });

    // Handle Delete Gram Form Submission
    $('#deleteForm').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');
        var id = actionUrl.split('/').pop(); // Extract ID from URL
        var deleteButton = $('#deleteForm button[type="submit"]'); // Target the submit button

        // Show loading spinner on the button
        deleteButton.html('<i class="fa fa-spinner fa-spin"></i> Deleting...').prop('disabled', true);

        $.ajax({
            url: actionUrl,
            type: 'DELETE',
            data: form.serialize(),
            success: function(response) {
                $('#gramRow' + id).remove();
                $('#deleteRecordModal').modal('hide');
                Swal.fire({ // Use SweetAlert2 for better notifications
                    title: 'Deleted!',
                    text: 'About Gram deleted successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload(); // Reload page after user acknowledges the notification
                });
            },
            error: function(response) {
                alert('An error occurred while trying to delete the gram.');
            },
            complete: function() {
                // Reset the button state after the process
                deleteButton.html('Delete').prop('disabled', false);
            }
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
        //         var state = $(this).val();
        //         var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        //         var districtDropdown = $('#district');
        //         districtDropdown.empty().append(
        //         '<option value="">Select District</option>'); // Clear existing options

        //         var selectedState = statesData.find(function(item) {
        //             return item.state === state;
        //         });

        //         if (selectedState) {
        //             selectedState.districts.forEach(function(district) {
        //                 districtDropdown.append($('<option>', {
        //                     value: district,
        //                     text: district
        //                 }));
        //             });
        //         }

        //         $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
        //         $('#name').empty().append(
        //         '<option value="">Select Profile Name</option>'); // Clear existing options
        //         $('#gram-field').empty().append(
        //         '<option value="">Select Gram</option>'); // Clear grams dropdown
        //     });

        //     // Handle district selection change
        //     $('#district').change(function() {
        //         var state = $('#state').val();
        //         var district = $(this).val();

        //         if (state && district) {
        //             $.ajax({
        //                 url: '<?php echo e(route('tehsils.get')); ?>', // Ensure this matches your route
        //                 type: 'GET',
        //                 data: {
        //                     state: state,
        //                     district: district
        //                 },
        //                 success: function(response) {
        //                     var talukaDropdown = $('#taluka-field');
        //                     talukaDropdown.empty().append(
        //                         '<option value="">Select Taluka</option>');

        //                     response.forEach(function(taluka) {
        //                         talukaDropdown.append($('<option>', {
        //                             value: taluka,
        //                             text: taluka
        //                         }));
        //                     });
        //                 },
        //                 error: function(xhr) {
        //                     console.error('Error fetching talukas:', xhr.responseText);
        //                 }
        //             });
        //         }
        //         $('#gram-field').empty().append(
        //         '<option value="">Select Gram</option>'); // Clear grams dropdown
        //     });

        //     // Handle taluka selection change
        //     $('#taluka-field').change(function() {
        //         var state = $('#state').val();
        //         var district = $('#district').val();
        //         var taluka = $(this).val();

        //         if (state && district && taluka) {
        //             $.ajax({
        //                 url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
        //                 type: 'GET',
        //                 data: {
        //                     state: state,
        //                     district: district,
        //                     taluka: taluka
        //                 },
        //                 success: function(response) {
        //                     var gramDropdown = $('#gram-field');
        //                     gramDropdown.empty().append(
        //                     '<option value="">Select Gram</option>');

        //                     response.forEach(function(gram) {
        //                         gramDropdown.append($('<option>', {
        //                             value: gram,
        //                             text: gram
        //                         }));
        //                     });
        //                 },
        //                 error: function(xhr) {
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
    let fileUpload = null; // To store the upload data for the single file

    function handleFileSelect(event) {
        const file = event.target.files[0]; // Get the first (and only) file selected

        // Check if a file was selected
        if (!file) {
            return; // Do nothing if no file is selected
        }

        // If a file is already being uploaded, do not process another one
        if (fileUpload && fileUpload.isUploading) {
            return;
        }

        // If a file is already uploaded, remove the previous one
        if (fileUpload) {
            removeFile();
        }

        // Add the selected file to the fileUpload object
        fileUpload = {
            file: file,
            progressBar: null,
            percentageText: null,
            uploaded: 0,
            isUploading: false // Track whether the file is currently being uploaded
        };

        // Re-render the file list UI
        renderFileList();

        // Disable the submit button as the upload starts
        document.getElementById('submitButton').disabled = true;

        // Start uploading simulation (replace with actual upload logic)
        simulateFileUpload(file);
    }

    function renderFileList() {
        const fileListContainer = document.getElementById('fileList');
        fileListContainer.innerHTML = ''; // Clear the file listings before re-rendering

        if (fileUpload) {
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item', 'mb-3');

            // File name
            const fileName = document.createElement('span');
            fileName.textContent = `${fileUpload.file.name} (${(fileUpload.file.size / 1024).toFixed(2)} KB)`;
            fileItem.appendChild(fileName);

            // Progress Bar
            const progress = document.createElement('progress');
            progress.value = fileUpload.uploaded;
            progress.max = 100;
            progress.style.width = '100%';
            fileItem.appendChild(progress);

            // Percentage text
            const percentage = document.createElement('span');
            percentage.textContent = `${fileUpload.uploaded}%`;
            percentage.classList.add('ms-2', 'font-weight-bold');
            fileItem.appendChild(percentage);

            // Delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
            deleteButton.onclick = removeFile;
            fileItem.appendChild(deleteButton);

            // Store references to progress, percentage, and remaining size text for later updates
            fileUpload.progressBar = progress;
            fileUpload.percentageText = percentage;

            // Append file item to the container
            fileListContainer.appendChild(fileItem);
        }
    }

    function simulateFileUpload(file) {
        if (fileUpload.isUploading) return; // Prevent multiple uploads for the same file
        fileUpload.isUploading = true; // Mark file as uploading

        const totalSize = file.size;
        let uploaded = fileUpload.uploaded; // Start from the previously uploaded progress

        const interval = setInterval(() => {
            uploaded += totalSize / 10; // Simulate 10% increment per interval
            if (uploaded > totalSize) uploaded = totalSize;

            const progress = Math.min((uploaded / totalSize) * 100, 100);
            fileUpload.progressBar.value = progress;
            fileUpload.percentageText.textContent = `${Math.round(progress)}%`;

            if (progress >= 100) {
                clearInterval(interval);
                fileUpload.percentageText.textContent = `Upload complete!`;
                fileUpload.percentageText.classList.add('text-success');
                fileUpload.uploaded = 100; // Mark as fully uploaded
                fileUpload.isUploading = false; // Mark file as not uploading

                // Enable the submit button once upload is complete
                document.getElementById('submitButton').disabled = false;
            }
        }, 500); // Increase progress every 500ms
    }

    function removeFile() {
        // Mark the file as removed and reset fileUpload
        fileUpload = null;

        // Disable the submit button again
        document.getElementById('submitButton').disabled = true;

        // Re-render the file list UI
        renderFileList();
    }
</script>

    <script>
        const textarea = document.getElementById('aboutGram');
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
    let fileUploadsEdit = null; // To store the upload data for the single file

    function handleFileSelectEdit(event) {
        const fileList = event.target.files[0]; // Get the first (and only) file selected
        const fileListContainer = document.getElementById('fileListedit');
        const updateButton = document.getElementById('updateButton');

        // Check if a file was selected
        if (!fileList) return;

        if (fileUploadsEdit && fileUploadsEdit.isUploading) {
            return;
        }

        // Disable the "Update" button as soon as a file is selected
        updateButton.disabled = true;

        // If there's already a file uploaded, remove it before adding the new one
        if (fileUploadsEdit) {
            removeFileEdit();
        }

        // Only allow the first selected file
        const file = fileList;

        // Add the file to the upload data array (we'll just have one file in the array)
        fileUploadsEdit = [{
            file: file,
            progressBar: null,
            percentageText: null,
            uploaded: 0,
            isUploading: false // Track whether the file is currently being uploaded
        }];

        // Re-render the file list UI with the single file
        renderFileListEdit();

        // Start uploading simulation for the new file
        simulateFileUploadEdit(file, fileUploadsEdit[0]);
    }

    function renderFileListEdit() {
        const fileListContainer = document.getElementById('fileListedit');
        fileListContainer.innerHTML = ''; // Clear the file listings before re-rendering

        if (fileUploadsEdit && fileUploadsEdit.length > 0) {
            const uploadData = fileUploadsEdit[0]; // There should only be one file
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item', 'mb-3');

            // File name
            const fileName = document.createElement('span');
            fileName.textContent = `${uploadData.file.name} (${(uploadData.file.size / 1024).toFixed(2)} KB)`;
            fileItem.appendChild(fileName);

            // Progress Bar
            const progress = document.createElement('progress');
            progress.value = uploadData.uploaded;
            progress.max = 100;
            progress.style.width = '100%';
            fileItem.appendChild(progress);

            // Percentage text
            const percentage = document.createElement('span');
            percentage.textContent = `${uploadData.uploaded}%`;
            percentage.classList.add('ms-2', 'font-weight-bold');
            fileItem.appendChild(percentage);

            // Delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
            deleteButton.onclick = () => removeFileEdit(0); // Remove the single file
            fileItem.appendChild(deleteButton);

            // Store references to progress, percentage
            uploadData.progressBar = progress;
            uploadData.percentageText = percentage;

            fileListContainer.appendChild(fileItem);
        }
    }

    function simulateFileUploadEdit(file, uploadData) {
        const updateButton = document.getElementById('updateButton');

        if (uploadData.isUploading) return;
        uploadData.isUploading = true;

        const totalSize = file.size;
        let uploaded = uploadData.uploaded;

        uploadData.progressBar.value = uploaded;
        uploadData.percentageText.textContent = `${uploaded}%`;

        const interval = setInterval(() => {
            uploaded += totalSize / 10;
            if (uploaded > totalSize) uploaded = totalSize;

            const progress = Math.min((uploaded / totalSize) * 100, 100);
            uploadData.progressBar.value = progress;
            uploadData.percentageText.textContent = `${Math.round(progress)}%`;

            if (progress >= 100) {
                clearInterval(interval);
                uploadData.percentageText.textContent = `Upload complete!`;
                uploadData.percentageText.classList.add('text-success');
                uploadData.uploaded = 100;
                uploadData.isUploading = false;

                // Enable the "Update" button when upload completes
                updateButton.disabled = false;
            }
        }, 500);
    }

    function removeFileEdit(index) {
        fileUploadsEdit = null; // Clear the upload data

        // Disable the "Update" button if there are no files
        const updateButton = document.getElementById('updateButton');
        updateButton.disabled = true;

        renderFileListEdit();
    }

    // Attach the file input change event handler
    document.getElementById('fileInputEdit').addEventListener('change', handleFileSelectEdit);
</script>
    

<script>
document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const form = e.target;
    const formData = new FormData(form);

    // Show the progress modal and prevent closing during upload
    const progressModal = new bootstrap.Modal(document.getElementById('progressModal'), {
        backdrop: 'static', // Prevent closing on outside click
        keyboard: false // Prevent closing on Escape key
    });
    progressModal.show();

    const xhr = new XMLHttpRequest();
    let startTime = Date.now(); // Store start time for speed calculation
    let lastLoaded = 0; // To calculate speed
    const file = formData.get('pdf'); // Assume 'pdf' is the file input name
    const totalSize = file ? file.size : 0; // Get the total file size

    // Display total file size
    const totalFileSizeDisplay = document.getElementById('totalFileSizeDisplay');
    if (file) {
        const totalSizeMB = (totalSize / (1024 * 1024)).toFixed(2); // Convert bytes to MB
        totalFileSizeDisplay.textContent = `Total file size: ${totalSizeMB} MB`;
    }

    // Progress event
    xhr.upload.addEventListener('progress', function (e) {
        if (e.lengthComputable) {
            const percentComplete = Math.round((e.loaded / e.total) * 100);
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = percentComplete + '%';
            progressBar.setAttribute('aria-valuenow', percentComplete);
            progressBar.textContent = percentComplete + '%';

            // Calculate transfer speed (bytes per second)
            const elapsedTime = (Date.now() - startTime) / 1000; // In seconds
            const bytesUploaded = e.loaded - lastLoaded;
            const speed = bytesUploaded / elapsedTime; // Speed in bytes per second

            // Estimate remaining time
            const remainingBytes = e.total - e.loaded;
            const remainingTime = remainingBytes / speed; // Estimated time in seconds

            // Convert bytes to KB
            const remainingKB = remainingBytes / 1024; // KB
            const speedKB = speed / 1024; // KB/s
            const remainingTimeFormatted = formatTime(remainingTime);

            // Update progress with speed, remaining size, and time
            const remainingDisplay = document.getElementById('remainingDisplay');
            const timeDisplay = document.getElementById('timeDisplay');
            const speedDisplay = document.getElementById('speedDisplay');

            remainingDisplay.textContent = `Total remaining: ${remainingKB.toFixed(2)} KB (${percentComplete}%)`;
            timeDisplay.textContent = `Estimated time remaining: ${remainingTimeFormatted}`;
            speedDisplay.textContent = `Transfer rate: ${speedKB.toFixed(2)} KB/s`;

            lastLoaded = e.loaded; // Update last loaded for the next calculation
        }
    });

    // Load event (when the upload is complete)
    xhr.addEventListener('load', function () {
        progressModal.hide(); // Hide the modal after upload completes
        if (xhr.status === 200) {
            Swal.fire({
                title: 'Success!',
                text: 'Data uploaded successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload(); // Reload page after user acknowledges the notification
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while uploading data.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });

    // Error handling
    xhr.addEventListener('error', function () {
        progressModal.hide();
        Swal.fire({
            title: 'Error!',
            text: 'An error occurred while uploading data.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });

    // Send the request
    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    xhr.send(formData);

    // Format remaining time in HH:MM:SS
    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = Math.floor(seconds % 60);
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
});
</script>


    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/general-register.actthost.com/resources/views/about-gram/about_gram.blade.php ENDPATH**/ ?>