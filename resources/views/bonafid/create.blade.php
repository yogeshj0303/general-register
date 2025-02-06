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
                    <h4 class="card-title mb-0 flex-grow-1">Add Bonafid</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                    <form action="{{ route('bonafid.store') }}" method="POST" enctype="multipart/form-data">
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
            <select class="form-control @error('school_name') is-invalid @enderror" id="gram-field" name="school_name">
                <option value="">Select Gram</option>
                <!-- Add options dynamically -->
            </select>
            @error('school_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

<div class="col-md-4">
    <label for="school_address" class="form-label">School Address</label>
    <select class="form-control @error('school_address') is-invalid @enderror" id="school_address" name="school_address">
        <option value="">Select Address</option>
        <!-- Add options dynamically -->
    </select>
    @error('school_address')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="student_name" class="form-label">Student Name</label>
    <input type="text" class="form-control @error('student_name') is-invalid @enderror" id="student_name" name="student_name" placeholder="Enter Student Name" value="{{ old('student_name') }}">
    @error('student_name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

      <div class="col-md-4">
    <label for="general_register_number" class="form-label">General Register Number</label>
    <input type="number" class="form-control @error('general_register_number') is-invalid @enderror" id="general_register_number" name="general_register_number" placeholder="General Register Number" value="{{ old('general_register_number') }}" maxlength="12" >
    @error('general_register_number')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="religion" class="form-label">Religion (धर्म)</label>
    <input type="text" class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion" placeholder="Religion" value="{{ old('religion') }}" >
    @error('religion')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="caste" class="form-label">Caste (जात)</label>
    <input type="text" class="form-control @error('caste') is-invalid @enderror" id="caste" name="caste" placeholder="Caste" value="{{ old('caste') }}" >
    @error('caste')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

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

<div class="col-md-4">
    <label for="birth_place" class="form-label">Birth Place (Village/City)</label>
    <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="birth_place" name="birth_place" placeholder="Birth Place" value="{{ old('birth_place') }}" >
    @error('birth_place')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="birth_place_taluka" class="form-label">Birth Place Taluka</label>
    <input type="text" class="form-control @error('birth_place_taluka') is-invalid @enderror" id="birth_place_taluka" name="birth_place_taluka" placeholder="Birth Place Taluka" value="{{ old('birth_place_taluka') }}" >
    @error('birth_place_taluka')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="birth_place_dist" class="form-label">Birth Place District</label>
    <input type="text" class="form-control @error('birth_place_dist') is-invalid @enderror" id="birth_place_dist" name="birth_place_dist" placeholder="Birth Place District" value="{{ old('birth_place_dist') }}" >
    @error('birth_place_dist')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="certificate_issued_date" class="form-label">Date of Certificate Issued</label>
    <input type="date" class="form-control @error('certificate_issued_date') is-invalid @enderror" id="certificate_issued_date" name="certificate_issued_date" placeholder="Date of Certificate Issued" value="{{ old('certificate_issued_date') ?: now()->toDateString() }}" >
    @error('certificate_issued_date')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<!--<div class="col-md-4">-->
<!--    <label for="principal_signature" class="form-label">Principal's Signature</label>-->
<!--    <input type="text" class="form-control @error('principal_signature') is-invalid @enderror" id="principal_signature" name="principal_signature" placeholder="Principal's Signature" value="{{ old('principal_signature') }}" >-->
<!--    @error('principal_signature')-->
<!--        <div class="invalid-feedback">-->
<!--            {{ $message }}-->
<!--        </div>-->
<!--    @enderror-->
<!--</div>-->


        <!-- Add Submit and Back Buttons -->
        <div class="row mt-4">
            <div class="col-md-6 text-start">
                <a href="{{ route('bonafid.index') }}" class="btn btn-secondary">Back</a>
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
     $(document).ready(function() {
        $('#school_address').select2({
            placeholder: 'Select address',
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
        var addressDropdown = $('#school_address');


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
             addressDropdown.empty().append($('<option>', {
                value: address,
                text: address,
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
                            console.log('response' , response);
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
            
            
            
             gramDropdown.change(function () {
        var selectedSchoolId = $(this).val();
        console.log('selectedSchoolId' , selectedSchoolId);
        
        addressDropdown.empty().append('<option value="">Select Address</option>');

        if (selectedSchoolId) {
            $.ajax({
                url: '{{ route('schools.getAddress') }}',
                type: 'GET',
                data: { school_id: selectedSchoolId },
                success: function (response) {
                    if (response.address) {
                        addressDropdown.append($('<option>', {
                            value: response.address,
                            text: response.address
                        }));
                    } else {
                        console.warn('No address found for the selected school.');
                    }
                },
                error: function (xhr) {
                    console.error('Error fetching address:', xhr.responseText);
                }
            });
        }
    });
        }
    });
</script>
@endsection
