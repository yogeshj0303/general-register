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
                    <h4 class="card-title mb-0 flex-grow-1">Add User</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                      <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                <option value="">Select School</option>
                <!-- Add options dynamically -->
            </select>
            @error('gram')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="user_name" class="form-label">User Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   placeholder="User Name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="contact_no" class="form-label">Contact No</label>
            <input type="number" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no"
                   placeholder="Contact Number" value="{{ old('contact_no') }}">
            @error('contact_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 3 -->
        <div class="col-md-4">
            <label for="profile_pic" class="form-label">Profile Photo</label>
            <input type="file" class="form-control @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
            @error('profile_pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 4 -->
        <div class="col-md-4">
            <label for="dob" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob') }}">
            @error('dob')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age"
                   placeholder="Enter Age" value="{{ old('age') }}">
            @error('age')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 5 -->
        <div class="col-md-4">
            <label for="email" class="form-label">Gmail</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   placeholder="Enter Gmail" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Row 6 -->
        <div class="col-md-4">
            <label for="user_type" class="form-label">User Type</label>
            <select class="form-control @error('user_type') is-invalid @enderror" id="user_type" name="user_type">
                <option value="">Select User Type</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{ old('user_type') == $role->id ? 'selected' : '' }}>{{$role->role_name}}</option>
                @endforeach
            </select>
            @error('user_type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Add Submit and Back Buttons -->
        <div class="row mt-4">
            <div class="col-md-6 text-start">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
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
                gramDropdown.empty().append('<option value="">Select School</option>');

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
                gramDropdown.empty().append('<option value="">Select School</option>');

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

                gramDropdown.empty().append('<option value="">Select School</option>');

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
