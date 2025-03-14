@extends('layouts.master-without-nav')
@section('title')
@lang('translation.two-step-verification')
@endsection
@section('content')

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
                    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="index" class="d-inline-block auth-logo">
                                   <img src="{{ URL::asset('build/images/gram.png') }}" alt="" width="150">
                                    </a>
                                </div>
                                {{-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> --}}
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
<form autocomplete="off" id="otpForm" method="POST" action="{{ route('verify.otp') }}">
    @csrf
<div class="row">
    <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="digit1-input" class="visually-hidden">Digit 1</label>
                    <input type="text"
                        class="form-control form-control-lg bg-light border-light text-center"
                        maxlength="1"
                        id="digit1-input" name="digit1"
                        oninput="moveToNext(this, 'digit2-input')"
                        onkeydown="moveToPrevious(event, this, null)">
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="digit2-input" class="visually-hidden">Digit 2</label>
                    <input type="text"
                        class="form-control form-control-lg bg-light border-light text-center"
                        maxlength="1"
                        id="digit2-input" name="digit2"
                        oninput="moveToNext(this, 'digit3-input')"
                        onkeydown="moveToPrevious(event, this, 'digit1-input')">
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="digit3-input" class="visually-hidden">Digit 3</label>
                    <input type="text"
                        class="form-control form-control-lg bg-light border-light text-center"
                        maxlength="1"
                        id="digit3-input" name="digit3"
                        oninput="moveToNext(this, 'digit4-input')"
                        onkeydown="moveToPrevious(event, this, 'digit2-input')">
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="digit4-input" class="visually-hidden">Digit 4</label>
                    <input type="text"
                        class="form-control form-control-lg bg-light border-light text-center"
                        maxlength="1"
                        id="digit4-input" name="digit4"
                        oninput="moveToNext(this, null)"
                        onkeydown="moveToPrevious(event, this, 'digit3-input')">
                </div>
            </div>
        </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-success w-100">Confirm</button>
    </div>
</form>


                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="mt-4 text-center">
                                <p class="mb-0">Didn't receive a OTP  ? <div id="timer"><span id="countdown">01:00</span></div> <a href="" class="fw-semibold text-primary text-decoration-underline" id="resendButton" style="display:none;" onclick="resendOTP()">Resend</a> </p>
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
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script>General Register - Developed & Managed By TUSHAR  SURYAWANSHI  MANAGEMENT </p>
                    </div> 
                </div>
            </div>
        </div>
    </footer>
        </div>
        <!-- end auth-page-wrapper -->


@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}"></script>
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
    


<script>
function moveToNext(currentInput, nextInputId) {
            // Allow only single-digit numbers
            currentInput.value = currentInput.value.replace(/[^0-9]/g, '');

            if (currentInput.value.length === 1 && nextInputId) {
                document.getElementById(nextInputId).focus();
            }
        }

        function moveToPrevious(event, currentInput, previousInputId) {
            // Check if the Backspace key is pressed and the input is empty
            if (event.key === 'Backspace' && currentInput.value === '' && previousInputId) {
                document.getElementById(previousInputId).focus();
            }
        }
    </script
</script>

@endsection