@extends('layouts.master')
@section('title')
    @lang('translation.create-user')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    @endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add LC</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                    <form action="{{ route('lc.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row gy-4">
        <!-- Row 1 -->
        <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <select name="state" id="state" class="form-control js-example-basic-single @error('state') is-invalid @enderror">
                <option value="">Select State</option>
                @foreach ($statesData['states'] as $state)
                    <option value="{{ $state['state'] }}" {{ old('state') == $state['state'] ? 'selected' : '' }}>{{ $state['state'] }}</option>
                @endforeach
            </select>
            @error('state')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="district" class="form-label">District</label>
            <select name="district" id="district" class="form-control @error('district') is-invalid @enderror">
                <option value="">Select District</option>
                <!-- District options will be populated based on state selection -->
            </select>
            @error('district')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="taluka" class="form-label">Taluka</label>
            <select name="taluka" id="taluka-field" class="form-select @error('taluka') is-invalid @enderror">
                <option value="">Select Taluka</option>
                <!-- Populate dynamically -->
            </select>
            @error('taluka')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 2 -->
        <div class="col-md-4">
            <label for="gram" class="form-label">Select School</label>
            <select class="form-control @error('gram') is-invalid @enderror" id="gram-field" name="gram">
                <option value="">Select Gram</option>
                <!-- Add options dynamically -->
            </select>
            @error('gram')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 3 -->
        <div class="col-md-4">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="number" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" placeholder="Enter Student ID" value="{{ old('student_id') }}" maxlength="20">
            @error('student_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="adhar_number" class="form-label">Udash UID Number (Aadhar Number)</label>
            <input type="number" class="form-control @error('adhar_number') is-invalid @enderror" id="adhar_number" name="adhar_number" placeholder="Enter Aadhar Number" value="{{ old('adhar_number') }}" maxlength="12" >
            @error('adhar_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="student_name" class="form-label">Student First Name</label>
            <input type="text" class="form-control @error('student_first_name') is-invalid @enderror" id="student_name" name="student_first_name" placeholder="First Name" value="{{ old('student_first_name') }}">
            @error('student_first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
         <div class="col-md-4">
            <label for="student_name" class="form-label">Student Middle Name</label>
            <input type="text" class="form-control @error('student_middle_name') is-invalid @enderror" id="student_middle_name" name="student_middle_name" placeholder="Middle Name" value="{{ old('student_middle_name') }}">
            @error('student_middle_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
            <div class="col-md-4">
            <label for="student_name" class="form-label">Student Last Name</label>
            <input type="text" class="form-control @error('student_last_name') is-invalid @enderror" id="student_last_name" name="student_last_name" placeholder="Last Name" value="{{ old('student_last_name') }}">
            @error('student_last_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 4 -->
        <div class="col-md-4">
            <label for="mother_name" class="form-label">Mother's Name</label>
            <input type="text" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" name="mother_name" placeholder="Enter Full Name" value="{{ old('mother_name') }}">
            @error('mother_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control @error('nationality') is-invalid @enderror" id="nationality" name="nationality" placeholder="Enter Nationality" value="{{ old('nationality') }}">
            @error('nationality')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="mother_tongue" class="form-label">Mother Tongue (मातृभाषा)</label>
            <input type="text" class="form-control @error('mother_tongue') is-invalid @enderror" id="mother_tongue" name="mother_tongue" placeholder="Enter Mother Tongue" value="{{ old('mother_tongue') }}">
            @error('mother_tongue')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 5 -->
        <div class="col-md-4">
            <label for="religion" class="form-label">Religion (धर्म)</label>
            <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" placeholder="Enter Religion" value="{{ old('religion') }}">
            @error('religion')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="caste" class="form-label">Caste (जात)</label>
            <input type="text" class="form-control @error('caste') is-invalid @enderror" id="caste" name="caste" placeholder="Enter Caste" value="{{ old('caste') }}">
            @error('caste')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="sub_caste" class="form-label">Sub-caste (पोट जात)</label>
            <input type="text" class="form-control @error('sub_caste') is-invalid @enderror" id="sub_caste" name="sub_caste" placeholder="Enter Sub-caste" value="{{ old('sub_caste') }}">
            @error('sub_caste')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 6 -->
        <div class="col-md-4">
            <label for="birth_place" class="form-label">Birth Place (Village/City)</label>
            <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" placeholder="Enter Birth Place" value="{{ old('birth_place') }}">
            @error('birth_place')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="birth_place_taluka" class="form-label">Birth Place Taluka</label>
            <input type="text" class="form-control @error('birth_place_taluka') is-invalid @enderror" id="birth_place_taluka" name="birth_place_taluka" placeholder="Enter Taluka" value="{{ old('birth_place_taluka') }}">
            @error('birth_place_taluka')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="birth_place_dist" class="form-label">Birth Place District</label>
            <input type="text" class="form-control @error('birth_place_dist') is-invalid @enderror" id="birth_place_dist" name="birth_place_dist" placeholder="Enter District" value="{{ old('birth_place_dist') }}">
            @error('birth_place_dist')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 7 -->
        <div class="col-md-4">
            <label for="birth_place_state" class="form-label">Birth Place State</label>
            <input type="text" class="form-control @error('birth_place_state') is-invalid @enderror" id="birth_place_state" name="birth_place_state" placeholder="Enter State" value="{{ old('birth_place_state') }}">
            @error('birth_place_state')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="birth_place_country" class="form-label">Birth Place Country</label>
            <input type="text" class="form-control @error('birth_place_country') is-invalid @enderror" id="birth_place_country" name="birth_place_country" placeholder="Enter Country" value="{{ old('birth_place_country') }}">
            @error('birth_place_country')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 8 -->
  <div class="col-md-4">
    <label for="dob" class="form-label">Date of Birth</label>
    <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') }}" onchange="updateDateInText()">
    @error('dob')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-4">
    <label for="dob_text" class="form-label">Date of Birth (Text)</label>
    <input type="text" class="form-control" id="dob_text" name="birth_in_text" readonly>
</div>
        <!-- Row 9 -->
        <div class="col-md-4">
            <label for="previous_school" class="form-label">Previous School</label>
            <input type="text" class="form-control @error('previous_school') is-invalid @enderror" id="previous_school" name="previous_school" placeholder="Enter Previous School" value="{{ old('previous_school') }}">
            @error('previous_school')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="standard" class="form-label">Standard</label>
            <input type="text" class="form-control @error('standard') is-invalid @enderror" id="standard" name="standard" placeholder="Enter Standard" value="{{ old('standard') }}">
            @error('standard')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="date_of_admission" class="form-label">Date of Admission</label>
            <input type="date" class="form-control @error('date_of_admission') is-invalid @enderror" id="date_of_admission" name="date_of_admission" value="{{ old('date_of_admission') }}">
            @error('date_of_admission')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 10 -->
     <div class="col-md-4">
    <label for="academic_progress" class="form-label">Academic Progress</label>
    <textarea 
        class="form-control @error('academic_progress') is-invalid @enderror" 
        id="academic_progress" 
        name="academic_progress" 
        placeholder="Academic Progress (Maximum 100 characters)" 
        rows="3" 
        data-char-limit="100" 
        oninput="countCharacters(this)">{{ old('academic_progress') }}</textarea>
    <small id="academic_progress_char_count" class="text-muted">0/100 characters</small>
    @error('academic_progress')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


<div class="col-md-4">
    <label for="behavior" class="form-label">Behavior</label>
    <textarea class="form-control @error('behavior') is-invalid @enderror" 
              id="behavior" 
              name="behavior" 
              placeholder="Behavior (Maximum 100 characters)" 
              rows="3" 
              data-char-limit="100" 
              oninput="countCharacters(this)">{{ old('behavior') }}</textarea>
    <small id="behavior_char_count" class="text-muted">0/100 characters</small>
    @error('behavior')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="date_of_leaving_school" class="form-label">Date of Leaving School</label>
    <textarea class="form-control @error('date_of_leaving_school') is-invalid @enderror" 
              id="date_of_leaving_school" 
              name="date_of_leaving_school" 
              placeholder="Date of Leaving School (Maximum 100 characters)" 
              rows="3" 
              data-char-limit="100" 
              oninput="countCharacters(this)">{{ old('date_of_leaving_school') }}</textarea>
    <small id="date_of_leaving_school_char_count" class="text-muted">0/100 characters</small>
    @error('date_of_leaving_school')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="other_studies" class="form-label">Any other studies attended and since (alpha and number)</label>
    <textarea class="form-control @error('other_studies') is-invalid @enderror" 
              id="other_studies" 
              name="other_studies" 
              placeholder="Any other studies attended and since (Maximum 100 characters)" 
              rows="3" 
              data-char-limit="100" 
              oninput="countCharacters(this)">{{ old('other_studies') }}</textarea>
    <small id="other_studies_char_count" class="text-muted">0/100 characters</small>
    @error('other_studies')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="reason_for_leaving_school" class="form-label">Reason for Leaving School</label>
    <textarea class="form-control @error('reason_for_leaving_school') is-invalid @enderror" 
              id="reason_for_leaving_school" 
              name="reason_for_leaving_school" 
              placeholder="Reason for Leaving School (Maximum 100 characters)" 
              rows="3" 
              data-char-limit="100" 
              oninput="countCharacters(this)">{{ old('reason_for_leaving_school') }}</textarea>
    <small id="reason_for_leaving_school_char_count" class="text-muted">0/100 characters</small>
    @error('reason_for_leaving_school')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="comments" class="form-label">Comments (शेरा)</label>
    <textarea class="form-control @error('comments') is-invalid @enderror" 
              id="comments" 
              name="comments" 
              placeholder="Comments (Maximum 100 characters)" 
              rows="3" 
              data-char-limit="100" 
              oninput="countCharacters(this)">{{ old('comments') }}</textarea>
    <small id="comments_char_count" class="text-muted">0/100 characters</small>
    @error('comments')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


        <!-- Row 12 -->
       <div class="col-md-4">
    <label for="certificate_date" class="form-label">Date of Certificate Issued</label>
    <select class="form-control @error('certificate_date') is-invalid @enderror" id="certificate_date" name="certificate_date">
        <option value="">Select Date</option>
        @for ($i = 1; $i <= 31; $i++)
            <option value="{{ $i }}" {{ old('certificate_date') == $i ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
    </select>
    @error('certificate_date')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div class="col-md-4">
    <label for="certificate_month" class="form-label">Month of Certificate</label>
    <select class="form-control @error('certificate_month') is-invalid @enderror" id="certificate_month" name="certificate_month">
        <option value="">Select Month</option>
        @foreach ([
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ] as $index => $monthName)
            <option value="{{ $index + 1 }}" {{ old('certificate_month') == $index + 1 ? 'selected' : '' }}>
                {{ $monthName }}
            </option>
        @endforeach
    </select>
    @error('certificate_month')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


<div class="col-md-4">
    <label for="certificate_year" class="form-label">Year of Certificate</label>
    <select class="form-control @error('certificate_year') is-invalid @enderror" id="certificate_year" name="certificate_year">
        <option value="">Select Year</option>
        @for ($year = 2001; $year <= date('Y'); $year++)
            <option value="{{ $year }}" {{ old('certificate_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endfor
    </select>
    @error('certificate_year')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


        <!-- Row 13 -->
        <!--<div class="col-md-4">-->
        <!--    <label for="teacher_signature" class="form-label">Teacher's Signature</label>-->
        <!--    <input type="text" class="form-control @error('teacher_signature') is-invalid @enderror" id="teacher_signature" name="teacher_signature" placeholder="Teacher's Signature (with OTP)" value="{{ old('teacher_signature') }}">-->
        <!--    @error('teacher_signature')-->
        <!--        <div class="invalid-feedback">-->
        <!--            {{ $message }}-->
        <!--        </div>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-4">-->
        <!--    <label for="writer_signature" class="form-label">Writer's Signature</label>-->
        <!--    <input type="text" class="form-control @error('writer_signature') is-invalid @enderror" id="writer_signature" name="writer_signature" placeholder="Writer's Signature (with OTP)" value="{{ old('writer_signature') }}">-->
        <!--    @error('writer_signature')-->
        <!--        <div class="invalid-feedback">-->
        <!--            {{ $message }}-->
        <!--        </div>-->
        <!--    @enderror-->
        <!--</div>-->

        <!--<div class="col-md-4">-->
        <!--    <label for="principal_signature" class="form-label">Principal's Signature</label>-->
        <!--    <input type="text" class="form-control @error('principal_signature') is-invalid @enderror" id="principal_signature" name="principal_signature" placeholder="Principal's Signature (with OTP)" value="{{ old('principal_signature') }}">-->
        <!--    @error('principal_signature')-->
        <!--        <div class="invalid-feedback">-->
        <!--            {{ $message }}-->
        <!--        </div>-->
        <!--    @enderror-->
        <!--</div>-->

        <!-- Add Submit and Back Buttons -->
        <div class="row mt-4">
            <div class="col-md-6 text-start">
                <a href="{{ route('lc.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="col-md-6 text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
  
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

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
    function countCharacters(textarea) {
        const charLimit = 100; // Define the character limit
        const text = textarea.value; // Get the current text
        const charCount = text.length; // Count the number of characters

        // Update the character count display
        const charCountDisplay = document.getElementById(textarea.id + '_char_count');
        charCountDisplay.textContent = `${charCount}/${charLimit} characters`;

        // Prevent the user from typing beyond the character limit
        if (charCount > charLimit) {
            textarea.value = text.substring(0, charLimit); // Trim the text to the limit
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
//   $(document).ready(function () {
//     // Handle state selection change
//     $('#state').change(function () {
//         var state = $(this).val();
//         var statesData = @json($statesData['states']); // Pass states data to JavaScript

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
//                 url: '{{ route('tehsils.get') }}', // Ensure this matches your route
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
//                 url: '{{ route('grams.get') }}', // Route for fetching grams
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
        var isAdmin = @json(Auth::user()->is_admin === 'admin');
        var userState = @json(Auth::user()->state);
        var userDistrict = @json(Auth::user()->district);
        var userTaluka = @json(Auth::user()->taluka);
        var userGram = @json(Auth::user()->gram);
        var statesData = @json($statesData['states']); // Pass states data to JavaScript

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
                        url: '{{ route('tehsils.get') }}',
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
                        url: '{{ route('grams.get') }}',
                        type: 'GET',
                        data: { state: selectedState, district: selectedDistrict, taluka: selectedTaluka },
                        success: function(response) {
                         Object.entries(response).forEach(function ([id, gram_name]) {
                    gramDropdown.append($('<option>', {
                        value: id,
                        text: gram_name
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
@endsection
