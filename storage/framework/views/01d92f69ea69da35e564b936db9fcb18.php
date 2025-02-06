<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.list-js3'); ?>
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
                    <h4 class="card-title mb-0 flex-grow-1">Population</h4>
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
                                    <th>Population</th>
                                    <th>year</th>
                                       <th>Confirmed by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php if((isset($permissions)) && (  
    ($permissions['population_viewown'] == 2) ||($permissions['population_viewall'] == 2) )): ?>
                            <tbody>
                                <?php $__currentLoopData = $populations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($gram->id); ?></td>
                                    <td><?php echo e($gram->state); ?></td>
                                    <td><?php echo e($gram->district); ?></td>
                                    <td><?php echo e($gram->taluka); ?></td>
                                    <td><?php echo e($gram->gram); ?></td> 
                                    <td><?php echo e($gram->population); ?></td>
                                    <td><?php echo e($gram->year); ?></td>
                                    <td><?php $confimed_name=DB::table('users')->where('id',$gram->confirm_by)->first();
                                     $role_name=DB::table('roles')->where('id',$confimed_name->user_type)->first();?> <?php echo e($confimed_name->name); ?> (<?php echo e($role_name->role_name); ?>)</td>
                                   
                                    <td>
                                        <!-- Edit Button -->
                                         <!-- Edit Button (Trigger Modal) -->
                                          <?php if((isset($permissions)) && (  
    ($permissions['population_edit'] == 2) )): ?>
        <button class="btn btn-sm btn-primary editGram my-3" data-id="<?php echo e($gram->id); ?>">
            <i class="fa fa-edit"></i> Edit
        </button>
        <?php endif; ?>
            <?php if((isset($permissions)) && (  
    ($permissions['population_delete'] == 2) )): ?>
        
                                        <button class="btn btn-sm btn-danger remove-item-btn " data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal" data-id="<?php echo e($gram->id); ?>">
                                            Delete
                                        </button>
                                        <?php endif; ?>
                                        
                                        
<button class="btn btn-sm btn-success viewuser my-2" data-id="<?php echo e($gram->id); ?>">
    <i class="fa fa-eye"></i> View
</button>
    <?php if((isset($permissions)) && (  
    ($permissions['population_print'] == 2) )): ?>
  <button class="btn btn-sm btn-warning   " onclick="printAffidavit(<?php echo e($gram->id); ?>)">
    Print
</button>
<?php endif; ?>
<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/populationprint/' + userId, '_blank');
      

}

</script>


                                    </td>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            </tbody>
                            <?php endif; ?>
                        </table>
                        <?php if($populations->isNotEmpty()): ?>
                         <?php if((isset($permissions)) && (  
    ($permissions['population_viewown'] == 2) ||($permissions['population_viewall'] == 2) )): ?>
                            <div class="d-flex justify-content-center">
                                <?php echo $populations->links(); ?>

                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
         <?php if((isset($permissions)) && (  
    ($permissions['population_add'] == 2) )): ?>
        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Population</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('population.store')); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
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
                        <div class="col-md-12">
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
                        <div class="col-md-12">
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
                       
                       

                        <div class="col-md-12">
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


                        <div class="col-md-12 mb-3">
                            <label for="gram" class="form-label">Population</label>
                            <input type="number" id="population" class="form-control" name="population">
                            <?php $__errorArgs = ['population'];
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
                            <label for="gram" class="form-label">Year</label>
                            <input type="number" id="year" class="form-control" name="year">
                            <?php $__errorArgs = ['year'];
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
                            <label for="confirmed_by" class="form-label">Confirmed By</label>
                            <select id="confirmed_by" class="form-control js-example-basic-single <?php $__errorArgs = ['confirmed_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="confirm_by">
                                <!--<option value="">Select User</option>-->
<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php 
        $role_name = DB::table('roles')->where('id', $user->user_type)->first();
    ?>
    <?php if(Auth::user()->is_admin === 'admin' || Auth::user()->id === $user->id): ?>
        <option value="<?php echo e($user->id); ?>" <?php echo e(old('confirmed_by') == $user->user_type ? 'selected' : ''); ?>>
            <?php echo e($user->name); ?> (<?php echo e($role_name->role_name); ?>)
        </option>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                            <?php $__errorArgs = ['confirmed_by'];
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
        <?php endif; ?>
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
        
                            <!-- Category Selection -->

                            <!-- PDF Upload -->
                        <div class="col-md-12 mb-3">
                            <label for="population" class="form-label">Population</label>
                            <input type="text" id="editpopulation" class="form-control" name="population">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" id="edityear" class="form-control" name="year">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="confirmed_by" class="form-label">Confirmed By</label>
                            <select id="confirm_by" class="form-control js-example-basic-single <?php $__errorArgs = ['confirm_by'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="confirm_by">
                                <!--<option value="">Select User</option>-->
                            
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $role_name =DB::table('roles')->where('id',$user->user_type)->first()?>
                                 <?php if(Auth::user()->is_admin === 'admin' || Auth::user()->id === $user->id): ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e(old('confirm_by') === $user->id ? 'selected' : ''); ?>><?php echo e($user->name); ?> <?php echo e($role_name->role_name); ?></option>
                               <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['confirmed_by'];
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
                        
                      
                        </div>
                        <div class="modal-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
       
        
        
              <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel"> View Population</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- State -->
                    <div class="col-md-6">
                        <label for="viewState" class="form-label">State</label>
                        <input type="text" class="form-control" id="viewState" readonly>
                    </div>

                    <!-- District -->
                    <div class="col-md-6">
                        <label for="viewDistrict" class="form-label">District</label>
                        <input type="text" class="form-control" id="viewDistrict" readonly>
                    </div>

                    <!-- Taluka Name -->
                    <div class="col-md-6">
                        <label for="viewName" class="form-label">Taluka Name</label>
                        <input type="text" class="form-control" id="viewName" readonly>
                    </div>

                    <!-- Gram -->
                    <div class="col-md-6">
                        <label for="viewGram" class="form-label">Gram</label>
                        <input type="text" class="form-control" id="viewGram" readonly>
                    </div>
                    
                     <div class="col-md-6">
                        <label for="viewGram" class="form-label">Population</label>
                        <input type="text" class="form-control" id="viewpopulation" readonly>
                    </div>
                   
                    <div class="col-md-6">
                        <label for="viewGram" class="form-label">Year</label>
                        <input type="text" class="form-control" id="viewyear" readonly>
                    </div>
                         
                         
                     <div class="col-md-6">
                        <label for="viewGram" class="form-label">Confirm BY</label>
                        <input type="text" class="form-control" id="viewconfirmby" readonly>
                    </div>
                    
                        
                   
                    <!--<div class="col-md-6">-->
                    <!--    <label for="viewGram" class="form-label">Confirm By</label>-->
                      
                    <!--    <input type="text" class="form-control" id="viewconfirmby" readonly>-->
                    <!--</div>-->
                   
                    
                   

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
            url: `/population/${id}`, 
            method: 'GET',
            success: function(response) {
                                const gramBill = response.Population || {};

                console.log(response);
                              $('#viewState').val(gramBill.state || 'N/A');
                $('#viewDistrict').val(gramBill.district || 'N/A');
                $('#viewName').val(gramBill.taluka || 'N/A');
                $('#viewGram').val(gramBill.gram || 'N/A');
                              $('#viewaboutGram').val(gramBill.about_gram || 'N/A');
                                                            $('#viewpopulation').val(gramBill.population || 'N/A');
                              $('#viewyear').val(gramBill.year || 'N/A');
                              
$('#viewconfirmby').val(response.ConfirmedBy + ' (' + response.RoleName + ')' || 'N/A');

                              
                              
                              
                              
                              
                              

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
    
    $.get('/population/' + id + '/edit', function(data) {


        $('#editGramModal').modal('show');
                $('#editState').val(data.Population.state).change(); 
            $('#editDistrict').val(data.Population.district).change();
             
$('#editTaluka').data('selected-taluka', data.Population.taluka).trigger('change'); // Set selected taluka in memory
$('#editTaluka').val(data.Population.taluka); // Set dropdown value and trigger change

        var talukaa = $('#editTaluka').val();


        $('#editGramName').data('selected-gram', data.Population.gram); 

                $('#editpopulation').val(data.Population.population);
                $('#edityear').val(data.Population.year);

            $('#confirm_by').val(data.Population.confirm_by).change();


        $('#editGramForm').attr('action', '/population/' + id); 
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




// Handle Edit Gram Form Submission
$('#editGramForm').submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    var form = $(this);
    var actionUrl = form.attr('action');
    
    // Prepare form data
    var formData = new FormData(this);

    // Set up CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // Perform the AJAX request
    $.ajax({
        url: actionUrl,
        type: 'POST', // Use POST with Laravel PUT methods
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting content type
        success: function (response) {
            // Update table row
            var id = response.id; 
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram);
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
            $('#gramRow' + id + ' td:nth-child(6)').text(response.population);
            $('#gramRow' + id + ' td:nth-child(7)').text(response.year);
            $('#gramRow' + id + ' td:nth-child(8)').text(response.confirm_by);

            // Hide modal and reload page
            $('#editGramModal').modal('hide');
            Swal.fire({
                title: 'Success!',
                text: 'Population updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        },
        error: function (response) {
            // Handle errors
            var errors = response.responseJSON.errors;
            var errorMessage = 'An error occurred.\n\n';
            if (errors) {
                for (var field in errors) {
                    errorMessage += `${field}: ${errors[field].join(', ')}\n`;
                }
            } else {
                errorMessage += 'Unknown error.';
            }
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK',
            });
        },
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
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', '/population/' + id);
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
                    text: 'Population deleted successfully.',
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



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/population/index.blade.php ENDPATH**/ ?>