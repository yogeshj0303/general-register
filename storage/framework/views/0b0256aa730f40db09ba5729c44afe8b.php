<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.profile'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.10/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="<?php echo e(URL::asset('build/images/profile-bg.jpg')); ?>" alt="" class="profile-wid-img" />
        </div>
    </div>

    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
              
                    <img src="<?php if(Auth::user()->profile_pic != ''): ?> <?php echo e($presignedUrl); ?> <?php else: ?><?php echo e(URL::asset('build/icons/user.png')); ?> <?php endif; ?>" alt="user-img" class="img-thumbnail rounded-circle"  style="height:112px !important"/>
                </div>
            </div>
            <!--end col-->
            <?php
            $getRoleName = DB::table('roles')->where('id',Auth::user()->user_type)->first();
            ?>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1"><?php echo e(Auth::user()->name); ?></h3>
                    <p class="text-white text-opacity-75"><?php echo e($getRoleName->role_name ?? ''); ?></p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i><?php echo e(Auth::user()->state); ?>,
                            <?php echo e(Auth::user()->district); ?>,<?php echo e(Auth::user()->taluka); ?></div>
                        
                    </div>
                </div>
            </div>
          
        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex profile-wrapper">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        <?php if(Auth::user()->is_admin == "admin"): ?>
                                                <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#password-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Change Password</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        </ul>
                        
                        
                    
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                          
                            <div class="col-xxxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Profile Details</h5>
                                        <?php if(Auth::user()->is_admin == "admin"): ?>
                                               <div class="d-flex justify-content-end"> 
        <button class="btn btn-primary editGram" data-id="<?php echo e(Auth::user()->id); ?>">
            <i class="fa fa-edit"></i> Edit
        </button>
    </div>
    <?php endif; ?>

                                       
                                        <div class="row">
                                           
    <!-- State -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-2-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">State:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->state); ?></h6>
            </div>
        </div>
    </div>
    <!-- District -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-range-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">District:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->district); ?></h6>
            </div>
        </div>
    </div>
    <!-- Taluka -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-range-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Taluka:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->taluka); ?></h6>
            </div>
        </div>
    </div>
        <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-range-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Gram:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->gram); ?></h6>
            </div>
        </div>
    </div>
    <!-- Name -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-user-2-fill"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Name:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->name); ?></h6>
            </div>
        </div>
    </div>
    <!-- Contact Number -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-phone-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Contact No:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->contact_no); ?></h6>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
    <div class="d-flex mt-4">
        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                <i class="ri-door-open-line"></i> <!-- Icon for Gate No -->
            </div>
        </div>
        <div class="flex-grow-1 overflow-hidden">
            <p class="mb-1">Gate No:</p>
            <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->gate_no); ?></h6>
        </div>
    </div>
</div>

    <!-- Gender -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-range-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Gender:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->gender); ?></h6>
            </div>
        </div>
    </div>
    <!-- DOB -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Date of Birth:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->dob); ?></h6>
            </div>
        </div>
    </div>
    <!-- Age -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-user-star-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Age:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->age); ?></h6>
            </div>
        </div>
    </div>
    <!-- Land Area -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-landscape-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Land Area:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->land_area); ?></h6>
            </div>
        </div>
    </div>
    
</div>

                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->
                                
                                

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    
                    
                    
                    
                    
                                        <div class="tab-pane" id="password-tab" role="tabpanel">
    <!-- Card for Change Password -->
    <div class="card" style="width:40rem;">
        <div class="card-header">
            <h5 class="card-title mb-0">Change Password</h5>
        </div>
        <div class="card-body ">
<form action="<?php echo e(route('updatePassword', Auth::user()->id)); ?>" method="post">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="currentPassword" class="form-label">Current Password</label>
        <div class="input-group">
            <input type="password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="currentPassword" name="current_password" required>
            <button type="button" class="btn" onclick="togglePasswordVisibility('currentPassword', 'toggleCurrentPasswordIcon')">
                <i id="toggleCurrentPasswordIcon" class="fa fa-eye"></i>
            </button>
            <?php $__errorArgs = ['current_password'];
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

    <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <div class="input-group">
            <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="newPassword" name="password" required>
            <button type="button" class="btn" onclick="togglePasswordVisibility('newPassword', 'toggleNewPasswordIcon')">
                <i id="toggleNewPasswordIcon" class="fa fa-eye"></i>
            </button>
            <?php $__errorArgs = ['password'];
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

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <div class="input-group">
            <input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password_confirmation" name="password_confirmation" required>
            <button type="button" class="btn" onclick="togglePasswordVisibility('password_confirmation', 'toggleConfirmPasswordIcon')">
                <i id="toggleConfirmPasswordIcon" class="fa fa-eye"></i>
            </button>
            <?php $__errorArgs = ['password_confirmation'];
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

    <button type="submit" class="btn btn-primary">Change Password</button>
</form>
        </div>
    </div>
</div>
 <script>
    function togglePasswordVisibility(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>


                   
                    <!--end tab-pane-->
                </div>

                
                
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    
    
<div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editGramForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editGramModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select id="editState" name="state" class="form-select" required>
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
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <!-- District -->
                        <div class="col-md-6 mb-3">
                            <label for="district" class="form-label">District</label>
                            <select id="editDistrict" name="district" class="form-select">
                                <option value="">Select District</option>
                                <!-- Dynamically populated -->
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
                        
                        <!-- Taluka -->
                        <div class="col-md-6 mb-3">
                            <label for="taluka" class="form-label">Taluka</label>
                            <select id="editTaluka" name="taluka" class="form-select">
                                <option value="">Select Taluka</option>
                                <!-- Dynamically populated -->
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
                        <div class="col-md-6 mb-3">
                                    <label for="gram" class="form-label">Gram</label>
                                    <select name="gram" id="editGramName"
                                        class="form-control select2 <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select Gram</option>
                                       
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
    

                        <!-- User Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" id="name" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="">
                            <?php $__errorArgs = ['name'];
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
                        
                        <!-- Contact No -->
                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">Contact No</label>
                            <input type="text" id="contact_no" name="contact_no" class="form-control <?php $__errorArgs = ['contact_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="">
                            <?php $__errorArgs = ['contact_no'];
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
                        
                        <!-- Gate Number -->
                        <div class="col-md-6 mb-3">
                            <label for="gate_no" class="form-label">Gate Number</label>
                            <input type="text" id="gate_no" name="gate_no" class="form-control <?php $__errorArgs = ['gate_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="">
                            <?php $__errorArgs = ['gate_no'];
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
                        
                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select Gender</option>
                                <option >Male</option>
                                <option >Female</option>
                            </select>
                            <?php $__errorArgs = ['gender'];
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
                        
                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="form-control <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="">
                            <?php $__errorArgs = ['dob'];
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
                        
                        <!-- Age -->
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" id="age" name="age" class="form-control <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="">
                            <?php $__errorArgs = ['age'];
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
                        
                        <!-- Land Area -->
                        <div class="col-md-6 mb-3">
                            <label for="land_area" class="form-label">Land Area</label>
                            <input type="text" id="land_area" name="land_area" class="form-control <?php $__errorArgs = ['land_area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="">
                            <?php $__errorArgs = ['land_area'];
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
                              
                           <div class="mb-3">
    <label for="profile_pic" class="form-label">Profile Image</label>
    <!-- File input -->
    <input type="file" name="profile_pic" class="form-control <?php $__errorArgs = ['profile_pic'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
        id="profile_pic" accept="image/*" onchange="previewProfilePic(event)">

    <!-- Preview Area -->
    <div class="mb-2">
        <img 
            id="profile_pic_preview" 
            src="" 
            alt="Profile Picture" 
            class="img-thumbnail" 
            style="width: 150px; height: 150px;"
        >
    </div>
</div>

<script>
    function previewProfilePic(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('profile_pic_preview');
        output.src = reader.result; 
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>


                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


    
    <!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/profile.init.js')); ?>"></script>
    
    

   
   <script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<?php if(session('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?php echo e(session('success')); ?>'
        });
    </script>
<?php endif; ?>


<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
    var id = $(this).data('id');
    
    $.get('/editprofile/' + id, function(data) {

        $('#editGramModal').modal('show');
        var stateValue = data.user.state;
        $('#editState').val(stateValue).trigger('change');
            $('#editDistrict').val(data.user.district).change();
             
$('#editTaluka').data('selected-taluka', data.user.taluka).trigger('change'); // Set selected taluka in memory
$('#editTaluka').val(data.taluka); // Set dropdown value and trigger change

        var talukaa = $('#editTaluka').val();
         console.log('gram name' + data.user.gram);
                    $('#editGramName').data('selected-gram', data.user.gram).trigger('change'); // Set selected taluka in memory


                $('#name').val(data.user.name);
        $('#contact_no').val(data.user.contact_no);
        $('#gate_no').val(data.user.gate_no);
        $('#gender').val(data.user.gender);
        $('#dob').val(data.user.dob);
        $('#age').val(data.user.age);
        $('#land_area').val(data.user.land_area);
            var profilePicUrl = `${data.presignedUrl}`;
    $('#profile_pic_preview').attr('src', profilePicUrl);
console.log(profilePicUrl);

        $('#editGramForm').attr('action', '/profileupdate/' + id); 


    });
});


   $('#editState').change(function() {
        var state = $(this).val();
        console.log('state issss' +state );
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
    var state = $('#editState').val(); // Get state value
    var district = $('#editDistrict').val(); // Get district value
    var taluka = $(this).val(); // Get selected taluka value

    console.log('Selected State:', state);
    console.log('Selected District:', district);
    console.log('Selected Taluka:', taluka);

    if (state && district && taluka) {
        $.ajax({
            url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
            type: 'GET',
            data: { state: state, district: district, taluka: taluka },
            success: function (response) {
                console.log('Grams Response:', response); // Log response

                var gramDropdown = $('#editGramName');
                gramDropdown.empty().append('<option value="">Select Gram</option>');

                if (response && response.length > 0) {
                    response.forEach(function (gram) {
                        gramDropdown.append($('<option>', { value: gram, text: gram }));
                    });

                    // Set the pre-selected value
                    var selectedGram = $('#editGramName').data('selected-gram'); // Get selected value
                    console.log('selectedGram' , selectedGram);
                    if (selectedGram) {
                        $('#editGramName').val(selectedGram).trigger('change'); // Set value
                    }
                } else {
                    console.log('No grams found');
                    gramDropdown.append('<option value="">No Gram Found</option>');
                }
            },
            error: function (xhr) {
                console.error('Error fetching grams:', xhr.responseText);
            }
        });
    } else {
        console.log('State, District, or Taluka missing.');
        $('#editGramName').empty().append('<option value="">Select Gram</option>');
    }

    // Clear username dropdown
    $('#username').empty().append('<option value="">Select User Name</option>');
});

    


    
    $('#editGramForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission

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
        type: 'POST', // Use POST for compatibility with Laravel's PUT
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting content type
        success: function (response) {
            // Update table row with the new data
            var id = response.id; // Ensure the response includes the ID
            $(`#gramRow${id} td:nth-child(2)`).text(response.gram);
            $(`#gramRow${id} td:nth-child(3)`).text(response.state);
            $(`#gramRow${id} td:nth-child(4)`).text(response.district);
            $(`#gramRow${id} td:nth-child(5)`).text(response.taluka);
                        $(`#gramRow${id} td:nth-child(6)`).text(response.gram);

            $(`#gramRow${id} td:nth-child(7)`).text(response.name);
            $(`#gramRow${id} td:nth-child(8)`).text(response.contact_no);
            $(`#gramRow${id} td:nth-child(9)`).text(response.gender);
            $(`#gramRow${id} td:nth-child(10)`).text(response.dob);
            $(`#gramRow${id} td:nth-child(11)`).text(response.age);
            $(`#gramRow${id} td:nth-child(12)`).text(response.land_area);

            // Hide modal
            $('#editGramModal').modal('hide');

            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'Profile updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: Reload page if necessary
                    window.location.reload();
                }
            });
        },
        error: function (response) {
            // Handle validation errors
            var errors = response.responseJSON.errors || {};
            var errorMessage = 'An error occurred.\n\n';

            for (var field in errors) {
                errorMessage += `${field}: ${errors[field].join(', ')}\n`;
            }

            Swal.fire({
                title: 'Error!',
                text: errorMessage || 'Unknown error.',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        },
    });
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


       
    });
</script>















        <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the stored active tab from localStorage
        var activeTab = localStorage.getItem('activeTab');
        
        // If an active tab is stored, show it
        if (activeTab) {
            // Use the correct selector to find the tab link and show it
            var tabLink = document.querySelector('a[href="' + activeTab + '"]');
            if (tabLink) {
                var tab = new bootstrap.Tab(tabLink);
                tab.show();
            }
        }

        // Add event listener to store the active tab in localStorage when a tab is clicked
        document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function (tabLink) {
            tabLink.addEventListener('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', e.target.getAttribute('href'));
            });
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/egram/public_html/resources/views/profile.blade.php ENDPATH**/ ?>