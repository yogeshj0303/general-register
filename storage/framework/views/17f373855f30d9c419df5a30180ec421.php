<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.signin'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <!-- end row -->
<div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <!--<div>-->
                                <!--    <a href="index" class="d-inline-block auth-logo">-->
                                <!--   <img src="<?php echo e(URL::asset('build/images/gram.png')); ?>" alt="" width="150">-->
                                <!--    </a>-->
                                <!--</div>-->
                                
                            </div>
                        </div>
                    </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                  <div>
                                    <a href="index" class="d-inline-block auth-logo">
                                   <img src="<?php echo e(URL::asset('build/images/gram.png')); ?>" alt="" width="150">
                                    </a>
                                </div>
                                    <p class="text-muted" style="margin-top:20px">Sign in to continue to E Gram.</p>
                                </div>
                                <div class="p-2 mt-4">
                                 <div class="p-2 mt-4">
    <form action="<?php echo e(route('login.otp')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
    <label for="username" class="form-label">Mobile Number</label>
    <input 
        type="number" 
        class="form-control" 
        id="username" 
        name="mobile_number" 
        placeholder="Enter mobile number" 
        required 
        minlength="10" 
        maxlength="10" 
        oninput="validateMobileNumber(this)">
    <div class="invalid-feedback">
        Mobile number must be exactly 10 digits.
    </div>
</div>


        <div class="mt-4">
            <button class="btn btn-success w-100" type="submit">Sign In with OTP</button>
            
        </div>
         <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                        </div>
                                        <div>
                                            <a href="<?php echo e(route('root')); ?>" >
                                            <button type="button" class="btn btn-primary "><i class="ri-user-fill fs-16"></i>Login as a Admin</button>
                                        </a>
                                        </div>
                                    </div>
    </form>
</div>


                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> E Gram.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/particles.js/particles.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/particles.app.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/password-addon.init.js')); ?>"></script>
    <script>
        function validateMobileNumber(input) {
    const value = input.value;
    
    // Ensure the number is 10 digits
    if (value.length > 10) {
        input.value = value.slice(0, 10); // Limit to 10 characters
    }
}

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/auth/users-login.blade.php ENDPATH**/ ?>