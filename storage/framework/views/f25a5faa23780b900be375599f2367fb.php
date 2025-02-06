<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.two-step-verification'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="index" class="d-inline-block auth-logo">
                                        <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="20">
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">

                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                                <i class="ri-mail-line"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-2 mt-4">
                                        <div class="text-muted text-center mb-4 mx-lg-3">
                                            <h4 class="">Verify Your OTP</h4>
                                            <p>Please enter the 4 digit code sent to <span class="fw-semibold">Your Whatspp 9131323213</span></p>
                                        </div>

                                        <form autocomplete="off">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                        <input type="number"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(1,event)" maxLength="1"
                                                            id="digit1-input">
                                                    </div>
                                                </div><!-- end col -->
                                        
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                        <input type="number"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(2,event)" maxLength="1"
                                                            id="digit2-input">
                                                    </div>
                                                </div><!-- end col -->
                                        
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                        <input type="number"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(3,event)" maxLength="1"
                                                            id="digit3-input">
                                                    </div>
                                                </div><!-- end col -->
                                        
                                                <div class="col-3">
                                                    <div class="mb-3">
                                                        <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                        <input type="number"
                                                            class="form-control form-control-lg bg-light border-light text-center"
                                                            onkeyup="moveToNext(4,event)" maxLength="1"
                                                            id="digit4-input">
                                                    </div>
                                                </div><!-- end col -->
                                            </div>
                                        
                                            
                                            
                                        </form>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-success w-100">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="mt-4 text-center">
                                <p class="mb-0">Didn't receive a OTP  ? <div id="timer"><span id="countdown">01:00</span></div> <a href="auth-pass-reset-basic" class="fw-semibold text-primary text-decoration-underline" id="resendButton" style="display:none;" onclick="resendOTP()">Resend</a> </p>
                            </div>

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
                                <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> E Gram. Crafted with <i class="mdi mdi-heart text-danger"></i> by ACT T CONNECT</p>
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
    <script src="<?php echo e(URL::asset('build/js/pages/two-step-verification.init.js')); ?>"></script>
    <script>
        // Timer Functionality
        let timeLeft = 60; // 1 minute
        const countdownElement = document.getElementById('countdown');
        const resendButton = document.getElementById('resendButton');
    
        const timer = setInterval(function() {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownElement.innerHTML = `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    
            if (timeLeft <= 0) {
                clearInterval(timer); // Stop the timer
                resendButton.style.display = 'inline-block'; // Show the Resend button
            }
        }, 1000);
    
        function moveToNext(digit, event) {
            const currentInput = document.getElementById('digit' + digit + '-input');
            if (event.keyCode === 8 && digit > 1) { // Backspace
                document.getElementById('digit' + (digit - 1) + '-input').focus();
            } else if (event.keyCode !== 8 && currentInput.value.length === 1) {
                document.getElementById('digit' + (digit + 1) + '-input').focus();
            }
        }
    
        function resendOTP() {
            alert("OTP Resent");
            // Reset the timer and hide the Resend button
            timeLeft = 60;
            countdownElement.innerHTML = "01:00";
            resendButton.style.display = 'none';
            startTimer();
        }
    
        function startTimer() {
            const timer = setInterval(function() {
                timeLeft--;
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                countdownElement.innerHTML = `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    
                if (timeLeft <= 0) {
                    clearInterval(timer); // Stop the timer
                    resendButton.style.display = 'inline-block'; // Show the Resend button
                }
            }, 1000);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/gram-project/resources/views/auth/otp-page.blade.php ENDPATH**/ ?>