@extends('layouts.master')
@section('title')
    @lang('translation.Register-to-gram')
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <style>
#editProgressModal {
    z-index: 1061; /* Higher than Bootstrap's default modal z-index (1055) */
}
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
    @endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- List Categories -->
        <div class="col-xxl-7">
            @if(session('success'))
            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
@endif
@if(session('error'))
 
    <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
        <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Register To School</h4>
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
                                    <th>School Name</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registerToGrams as $gram)
                                <tr>
                                    <td>{{ $gram->id }}</td>
                                    <td>{{ $gram->state }}</td>
                                    <td>{{ $gram->district }}</td>
                                    <td>{{ $gram->taluka }}</td>
                                    <td>{{ $gram->gram }}</td>
                                    <td>{{ $gram->category }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                         <!-- Edit Button (Trigger Modal) -->
        <button class="btn btn-sm btn-primary editGram" data-id="{{ $gram->id }}">
            <i class="fa fa-edit"></i> Edit
        </button>
        
                                        <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal" data-id="{{ $gram->id }}">
                                            Delete
                                        </button>
                                        
                                        
                                        
<button class="btn btn-sm btn-success viewCategory my-3" data-id="{{ $gram->id }}">
    <i class="fa fa-eye"></i> View
</button>

   <button class="btn btn-sm btn-warning remove-item-btn " onclick="printAffidavit({{ $gram->id }})">
    Print
</button>







<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/register-to-gram-print/' + userId, '_blank');
      
}

</script>




                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        @if ($registerToGrams->isNotEmpty())
                            <div class="d-flex justify-content-center">
                                {!! $registerToGrams->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Register To School</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('register-to-gram.store') }}" method="POST"  id="registerForm"  class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <label for="district" class="form-label">District</label>
                            <select name="district" id="district" class="form-control js-example-basic-single @error('district') is-invalid @enderror">
                                <option value="">Select District</option>
                                <!-- District options will be populated based on state selection -->
                            </select>
                            @error('district')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="taluka" class="form-label">Taluka</label>
                            <select name="taluka" id="taluka-field" class="form-select js-example-basic-single @error('taluka') is-invalid @enderror">
                                <option value="">Select Taluka</option>
                                <!-- Populate dynamically -->
                            </select>
                            @error('taluka')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                       

                        <div class="col-md-12">
                            <label for="category_name" class="form-label">School Name</label>
                            <select class="form-control js-example-basic-single @error('gram') is-invalid @enderror" id="gram-field" name="gram">
                                <option value="">Select School</option>
                                <!-- Add options dynamically -->
                            </select>
                            @error('gram')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Select Category</label>
                            <select class="form-control js-example-basic-single @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Select Category</option>
                                <!-- Add options dynamically -->
                                @foreach ($getCategory as $temp)
                                    <option value="{{ $temp->category_name }}">{{ $temp->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="pdf" class="form-label">Select PDF (Multiple)</label>
                            <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf[]" multiple onchange="handleFileSelect(event)" >
                        </div>
                        
                        <div id="fileList" class="mt-3"></div>
                        
                    <!-- Checkbox to create only file path -->
                    <div class="col-md-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="createOnlyPath" name="create_only_path">
                            <label class="form-check-label" for="createOnlyPath">
                                Create only file path
                            </label>
                        </div>
                    </div>


                        
                        
                        <div class="col-12">
                            <div class="text-end">
                                <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                <!-- Total file size display -->
                <div id="totalFileSizeDisplay" class="mb-3"></div>
                
                <!-- Uploaded files display -->
                <div id="uploadedFilesDisplay" class="mb-3"></div>
                
                <!-- Progress bar -->
                <div class="progress">
                    <div class="progress-bar" id="progressBar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>
                
                <!-- Remaining display -->
                <div id="remainingDisplay" class="mt-2"></div>
                
                <!-- Time display -->
                <div id="timeDisplay"></div>
                
                <!-- Speed display -->
                <div id="speedDisplay"></div>
                
                <!-- Progress text -->
                <p class="mt-3 text-center" id="progressText">Please wait while we upload your data.</p>
                
                <!-- OK Button -->
                <div class="d-flex justify-content-center mt-3">
    <button id="okButton" class="btn btn-primary" style="display: none;">OK</button>
</div>

            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="editProgressModal" tabindex="-1" aria-labelledby="editProgressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProgressModalLabel">Upload...</h5>
            </div>
            <div class="modal-body">
                <div id="totalFileSizeEditDisplay" class="mb-3"></div>
                <div id="uploadedFilesEditDisplay" class="mb-3"></div> <!-- Show uploaded files -->
                <div class="progress">
                    <div class="progress-bar" id="editProgressBar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        0%
                    </div>
                </div>
                <div id="remainingEditDisplay"></div>
                <div id="timeEditDisplay"></div>
                <div id="speedEditDisplay"></div>
                <p class="mt-3 text-center" id="editProgressText">Please wait while we edit your data.</p>
            </div>
        </div>
    </div>
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
                            @csrf
                            @method('DELETE')
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
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editGramModalLabel">Edit School</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- State Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="state" class="form-label">State</label>
                        <select id="editState" name="state" class="form-select mb-3" required>
                            <option value="">Select state</option>
                            @foreach($statesData['states'] as $state)
                                <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                            @endforeach
                        </select>
                                @error('state')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- District Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="district" class="form-label">District</label>
                        <select name="district" id="editDistrict" class="form-control @error('district') is-invalid @enderror">
                            <option value="">Select District</option>
                            <!-- District options will be populated based on state selection -->
                        </select>
                                @error('district')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- Taluka Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="taluka" class="form-label">Taluka</label>
                                <select name="taluka" id="editTaluka" class="form-select">
                                    <option value="">Select Taluka</option>
                                    <!-- Populate dynamically -->
                                </select>
                                @error('taluka')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- Gram Name Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="gram" class="form-label">School Name</label>
                                <select class="form-control @error('gram') is-invalid @enderror" id="editGramName" name="gram">
                                    <option value="">Select School</option>
                                    <!-- Gram options will be added dynamically -->
                                </select>
                                @error('gram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- Category Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="category" class="form-label">Select Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" id="editcategory" name="category">
                                    <option value="">Select Category</option>
                                    @foreach ($getCategory as $temp)
        <option 
            value="{{ $temp->category_name }}" >
            {{ $temp->category_name }}
        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
        <div class="col-md-12 mb-3">
    <label for="pdf" class="form-label">Select PDF (Multiple)</label>
    <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdfedit" name="pdf[]" multiple onchange="handleFileSelectEdit(event)">
</div>

<div id="fileListedit" class="mt-3"></div>
  <!-- Checkbox to create only file path -->
                    <div class="col-md-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="createOnlyPath" name="create_only_path">
                            <label class="form-check-label" for="createOnlyPath">
                                Create only file path
                            </label>
                        </div>
                    </div>
 <table class="table table-bordered">
    <thead>
        <tr>
            <th style="width:50%;">File Name</th>
            <th style="width:50%;">Action</th>
        </tr>
    </thead>
    <tbody id="fileViewerContainer">
        <!-- Data will be appended here dynamically -->
    </tbody>
</table>


  


                        </div>
                     

                        <div class="modal-footer">
                            <div class="text-end">
                                <button  type="submit" id="updateButton" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
       <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">Register To Gram</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
<!-- State -->
<div class="col-md-12 mb-3">
    <label for="viewState" class="form-label">State</label>
    <input type="text" class="form-control" id="viewState" readonly>
</div>

<!-- District -->
<div class="col-md-12 mb-3">
    <label for="viewDistrict" class="form-label">District</label>
    <input type="text" class="form-control" id="viewDistrict" readonly>
</div>

<!-- Taluka -->
<div class="col-md-12 mb-3">
    <label for="viewTaluka" class="form-label">Taluka</label>
    <input type="text" class="form-control" id="viewTaluka" readonly>
</div>

<!-- Gram Name -->
<div class="col-md-12 mb-3">
    <label for="viewGram" class="form-label">School Name</label>
    <input type="text" class="form-control" id="viewGram" readonly>
</div>

<!-- Category -->
<div class="col-md-12 mb-3">
    <label for="viewCategory" class="form-label">Category</label>
    <input type="text" class="form-control" id="viewCategory" readonly>
</div>

                     <table class="table table-bordered">
    <thead>
        <tr>
            <th>File Name</th>
                        <th>View pdf</th>

        </tr>
    </thead>
    <tbody id="fileViewerContainerview">
        <!-- Data will be appended here dynamically -->
    </tbody>
</table>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    $(document).on('click', '.viewCategory', function() {
        const categoryId = $(this).data('id');

        $.ajax({
            url: `/register-to-gram/${categoryId}`,
            method: 'GET',
            success: function(response) {
                console.log(response);

                // Set form values
                $('#viewState').val(response.RegisterToGram.state);
                $('#viewDistrict').val(response.RegisterToGram.district);
                $('#viewTaluka').val(response.RegisterToGram.taluka);
                $('#viewGram').val(response.RegisterToGram.gram);
                $('#viewCategory').val(response.RegisterToGram.category);

                // Handle files
                const files = response.files || []; // Files array from the response
                const fileContainer = $('#fileViewerContainerview');
                fileContainer.empty();

                if (files.length > 0) {
                    files.forEach(function(file) {
                        const fileName = file.name; // Use the file name from the response
                        const fileUrl = file.url; // Use the presigned URL from the response

                        const fileElement = `
                            <tr>
                                <td>${fileName}</td> 
                                <td><a href="${fileUrl}" target="_blank">View PDF</a></td>
                            </tr>
                        `;
                        fileContainer.append(fileElement); // Append the file link to the table
                    });
                } else {
                    fileContainer.html('<p>No files available</p>'); // Show message if no files
                }

                // Show the modal with category details
                $('#viewCategoryModal').modal('show');
            },
            error: function() {
                alert('Failed to fetch category details.');
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
<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
  $('.editGram').click(function() {
    var id = $(this).data('id');
    
    $.get('/register-to-gram/' + id + '/edit', function(data) {
        console.log(data);

        // Show the modal
        $('#editGramModal').modal('show');
        
        // Fill the form fields with the data from the backend
        $('#editState').val(data.gram.state).change(); 
        $('#editDistrict').val(data.gram.district).change();
        $('#editTaluka').data('selected-taluka', data.gram.taluka).trigger('change'); // Set selected taluka in memory
        $('#editTaluka').val(data.gram.taluka); // Set dropdown value and trigger change

        console.log('taluka after set: ' + $('#editTaluka').val());

        $('#editGramName').data('selected-gram', data.gram.gram);
        $('#editcategory').val(data.gram.category).trigger('change');

        const files = data.File || []; // If files exist

        const fileContainer = $('#fileViewerContainer');
        fileContainer.empty(); // Clear previous files

        if (files.length > 0) {
            files.forEach(function(file) {
                const fileLink = file.url;  // Using presigned URL from backend
                const fileName = file.name;

                // Create file element with delete button
                const fileElement = `
                    <tr>
                        <td class="text-truncate" style="max-width: 300px;">${fileName}</td>
                        <td class="text-center">
                            <a href="${fileLink}" target="_blank" class="btn btn-primary btn-sm" aria-label="View PDF">View PDF</a>
                            <button class="btn btn-danger btn-sm delete-file" data-file-id="${fileName}" aria-label="Delete File">
                                Delete
                            </button>
                        </td>
                    </tr>
                `;
                fileContainer.append(fileElement); // Append each file to the container
            });
        } else {
            fileContainer.html('<tr><td colspan="3">No files available</td></tr>');
        }

        // Set the form action URL
        $('#editGramForm').attr('action', '/register-to-gram/' + id);
    });
});


   $('#editState').change(function() {
        var state = $(this).val();
        var statesData = @json($statesData['states']); // Pass states data to JavaScript

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
                url: '{{ route('tehsils.get') }}',
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
            url: '{{ route('grams.get') }}', // Route for fetching grams
            type: 'GET',
            data: { state: state, district: district, taluka: taluka },
            success: function (response) {
                console.log(response);
                var gramDropdown = $('#editGramName'); // Target gram dropdown
                gramDropdown.empty().append('<option value="">Select School</option>');

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
        $('#editGramName').empty().append('<option value="">Select School</option>');
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
        placeholder: 'Select School',
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

    // Validate all required fields
    var isValid = true;
    form.find('input, select, textarea').each(function() {
        if ($(this).prop('required') && !$(this).val()) {
            isValid = false;
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').show();
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').hide();
        }
    });

    if (!isValid) {
        Swal.fire({
            title: 'Error!',
            text: 'Please fill in all required fields.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    var formData = new FormData(this);

    // Check if "Create Only File Path" checkbox is checked
    const createOnlyPathCheckbox = form.find('[name="create_only_path"]');
    if (createOnlyPathCheckbox.prop('checked')) {
        // If checked, only store file names, no file uploads, and bypass progress modal
        const fileNames = Array.from(form.find('[name="pdf[]"]')[0].files).map(file => file.name); // Get only file names
        formData.delete('pdf[]'); // Remove the actual files from FormData
        fileNames.forEach(name => formData.append('file_names[]', name)); // Add only file names to FormData

        // Send the form via AJAX without the files and bypass the progress modal
        sendFormData(formData, actionUrl, 'File paths created successfully without uploading files.');
        return; // Stop further execution
    }

    // If not "Create Only File Path", proceed with the progress modal
    const progressModal = new bootstrap.Modal(document.getElementById("editProgressModal"));
    progressModal.show();

    const progressBar = document.getElementById("editProgressBar");
    const totalFileSizeDisplay = document.getElementById("totalFileSizeEditDisplay");
    const uploadedFilesDisplay = document.getElementById("uploadedFilesEditDisplay");
    const remainingDisplay = document.getElementById("remainingEditDisplay");
    const timeDisplay = document.getElementById("timeEditDisplay");
    const speedDisplay = document.getElementById("speedEditDisplay");

    let startTime = new Date();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function() {
            var xhr = new window.XMLHttpRequest();

            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percentComplete + "%";
                    progressBar.setAttribute("aria-valuenow", percentComplete);
                    progressBar.textContent = percentComplete + "%";

                    const totalFileSize = (event.total / 1024 / 1024).toFixed(2) + " MB";
                    const uploadedFileSize = (event.loaded / 1024 / 1024).toFixed(2) + " MB";
                    const remainingFileSize = ((event.total - event.loaded) / 1024 / 1024).toFixed(2) + " MB";
                    const elapsedTime = (new Date() - startTime) / 1000;
                    const uploadSpeed = (event.loaded / 1024 / elapsedTime).toFixed(2) + " KB/s";
                    const estimatedTime = ((event.total - event.loaded) / (event.loaded / elapsedTime)).toFixed(2) + " s";

                    totalFileSizeDisplay.textContent = "Total File Size: " + totalFileSize;
                    uploadedFilesDisplay.textContent = "Uploaded: " + uploadedFileSize;
                    remainingDisplay.textContent = "Remaining: " + remainingFileSize;
                    speedDisplay.textContent = "Speed: " + uploadSpeed;
                    timeDisplay.textContent = "Estimated Time Left: " + estimatedTime;
                }
            }, false);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    progressModal.hide();
                    Swal.fire({
                        title: 'Success!',
                        text: 'School updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            };

            return xhr;
        },
        success: function(response) {
            var id = response.id;
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name);
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
            $('#gramRow' + id + ' td:nth-child(6)').text(response.address);
            $('#gramRow' + id + ' td:nth-child(7)').text(response.pin_code);

            $('#editGramModal').modal('hide');
        },
        error: function() {
            progressModal.hide();
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while trying to update the School.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload();
            });
        }
    });
});

// Function to send form data without progress modal
function sendFormData(formData, actionUrl, successMessage) {
    const xhr = new XMLHttpRequest();

    xhr.addEventListener('load', function () {
        if (xhr.status === 200) {
            Swal.fire({
                title: 'Success!',
                text: successMessage,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload(); // Reload the page
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while processing the data on the server.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });

    xhr.addEventListener('error', function () {
        Swal.fire({
            title: 'Error!',
            text: 'An error occurred during submission.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });

    xhr.open('POST', actionUrl, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    xhr.send(formData);
}



       
    });
</script>

<script>
$(document).on('click', '.delete-file', function(event) {
    event.preventDefault(); // Prevent default button action (e.g., form submission)

    const fileId = $(this).data('file-id'); // Get file ID from button's data attribute
    console.log(fileId);
    const fileRow = $(this).closest('tr'); // Get the parent row to remove it after deletion

    // SweetAlert2 confirmation dialog
    Swal.fire({
        title: 'Are you sure you want to delete this file?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Make AJAX DELETE request to remove the file
            $.ajax({
                url: `/delete-file/${fileId}`, // Backend route to handle file deletion
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token for Laravel security
                },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'The file has been deleted.',
                        'success'
                    );
                    fileRow.remove(); // Remove the file row from the UI
                },
                error: function(xhr) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the file.',
                        'error'
                    );
                }
            });
        }
    });
});
</script>




<script>
    // Handle Delete Gram
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', '/register-to-gram/' + id);
    });

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
                Swal.fire(
                    'Deleted!',
                    'This Record has been deleted.',
                    'success'
                ).then(() => {
                    // Reload the page after the confirmation
                    location.reload();
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
    // File Upload Handling for Submit Button
    let fileUploads = [];
    const submitButton = document.getElementById('submitButton');

    function handleFileSelect(event) {
        const fileList = event.target.files;

        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i];

            if (fileUploads.some(upload => upload.file.name === file.name)) {
                continue;
            }

            fileUploads.push({
                file: file
            });
        }

        renderFileList();

        // Simulate upload without progress bar or completion message
        Array.from(fileList).forEach((file) => {
            const uploadData = fileUploads.find(f => f.file === file);
            simulateFileUpload(file, uploadData);
        });
    }

    function renderFileList() {
        const fileListContainer = document.getElementById('fileList');
        fileListContainer.innerHTML = '';

        fileUploads.forEach((uploadData, index) => {
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item', 'mb-3');

            const fileName = document.createElement('span');
            fileName.textContent = `${uploadData.file.name} (${(uploadData.file.size / 1024).toFixed(2)} KB)`;
            fileItem.appendChild(fileName);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
            deleteButton.onclick = () => removeFile(index);
            fileItem.appendChild(deleteButton);

            fileListContainer.appendChild(fileItem);
        });
    }

    function simulateFileUpload(file, uploadData) {
        // Simulate file upload without progress or completion message
        // You can adjust the interval to simulate faster or slower uploads if necessary
        const totalSize = file.size;
        let uploaded = 0;

        const interval = setInterval(() => {
            uploaded += totalSize / 10;
            if (uploaded >= totalSize) {
                clearInterval(interval);
                // No progress indicator or completion message
            }
        }, 500);
    }

    function removeFile(index) {
        fileUploads.splice(index, 1);
        renderFileList();
    }
</script>

<script>
    // File Upload Handling for Update Button
    let fileUploadsEdit = [];
    const updateButton = document.getElementById('updateButton');

    function handleFileSelectEdit(event) {
        const fileList = event.target.files;

        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i];

            if (fileUploadsEdit.some(upload => upload.file.name === file.name)) {
                continue;
            }

            fileUploadsEdit.push({
                file: file
            });
        }

        renderFileListEdit();

        // Simulate upload without progress bar or completion message
        Array.from(fileList).forEach((file) => {
            const uploadData = fileUploadsEdit.find(f => f.file === file);
            simulateFileUploadEdit(file, uploadData);
        });
    }

    function renderFileListEdit() {
        const fileListContainer = document.getElementById('fileListedit');
        fileListContainer.innerHTML = '';

        fileUploadsEdit.forEach((uploadData, index) => {
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item', 'mb-3');

            const fileName = document.createElement('span');
            fileName.textContent = `${uploadData.file.name} (${(uploadData.file.size / 1024).toFixed(2)} KB)`;
            fileItem.appendChild(fileName);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
            deleteButton.onclick = () => removeFileEdit(index);
            fileItem.appendChild(deleteButton);

            fileListContainer.appendChild(fileItem);
        });
    }

    function simulateFileUploadEdit(file, uploadData) {
        // Simulate file upload without progress or completion message
        // You can adjust the interval to simulate faster or slower uploads if necessary
        const totalSize = file.size;
        let uploaded = 0;

        const interval = setInterval(() => {
            uploaded += totalSize / 10;
            if (uploaded >= totalSize) {
                clearInterval(interval);
                // No progress indicator or completion message
            }
        }, 500);
    }

    function removeFileEdit(index) {
        fileUploadsEdit.splice(index, 1);
        renderFileListEdit();
    }
</script>

<script>
document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const form = e.target;
    const formData = new FormData(form);

    // Validate the fields before submission
    const state = form.querySelector('[name="state"]');
    const district = form.querySelector('[name="district"]');
    const taluka = form.querySelector('[name="taluka"]');
    const gram = form.querySelector('[name="gram"]');
    const category = form.querySelector('[name="category"]');
    const pdfFiles = form.querySelector('[name="pdf[]"]');
    const createOnlyPathCheckbox = form.querySelector('[name="create_only_path"]'); // Get the checkbox

    let isValid = true;
    let errorMessage = '';

    // Check if state is selected
    if (!state.value) {
        isValid = false;
        errorMessage = 'Please select a state.';
        state.classList.add('is-invalid');
    } else {
        state.classList.remove('is-invalid');
    }

    // Check if district is selected
    if (!district.value) {
        isValid = false;
        errorMessage = 'Please select a district.';
        district.classList.add('is-invalid');
    } else {
        district.classList.remove('is-invalid');
    }

    // Check if taluka is selected
    if (!taluka.value) {
        isValid = false;
        errorMessage = 'Please select a taluka.';
        taluka.classList.add('is-invalid');
    } else {
        taluka.classList.remove('is-invalid');
    }

    // Check if gram is selected
    if (!gram.value) {
        isValid = false;
        errorMessage = 'Please select a School.';
        gram.classList.add('is-invalid');
    } else {
        gram.classList.remove('is-invalid');
    }

    // Check if category is selected
    if (!category.value) {
        isValid = false;
        errorMessage = 'Please select a category.';
        category.classList.add('is-invalid');
    } else {
        category.classList.remove('is-invalid');
    }

    // Check if PDF files are selected (only if "Create Only File Path" is not checked)
    if (!createOnlyPathCheckbox.checked && !pdfFiles.files.length) {
        isValid = false;
        errorMessage = 'Please select at least one PDF file.';
        pdfFiles.classList.add('is-invalid');
    } else {
        pdfFiles.classList.remove('is-invalid');
    }

    if (!isValid) {
        // Show error message and stop submission
        Swal.fire({
            title: 'Error!',
            text: errorMessage,
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return; // Stop form submission
    }

    // If "Create Only File Path" is checked, process only file names
    if (createOnlyPathCheckbox.checked) {
        const fileNames = Array.from(pdfFiles.files).map(file => file.name); // Get only file names
        formData.delete('pdf[]'); // Remove the actual files from FormData
        fileNames.forEach(name => formData.append('file_names[]', name)); // Add only the file names to FormData

        // Send the form via AJAX without the files and bypass the progress modal
        sendFormData(formData, form.action, 'File paths created successfully without uploading files.');
        return; // Stop further execution
    }

    // If form is valid and "Create Only File Path" is not checked, proceed with showing progress modal
    const progressModal = new bootstrap.Modal(document.getElementById('progressModal'), {
        backdrop: 'static', // Prevent closing on outside click
        keyboard: false // Prevent closing on Escape key
    });
    progressModal.show();

    const okButton = document.createElement('button');
    okButton.textContent = 'OK';
    okButton.classList.add('btn', 'btn-primary', 'mt-3');
    okButton.style.display = 'none'; // Hide initially
    const modalBody = document.querySelector('#progressModal .modal-body');
    modalBody.appendChild(okButton);

    const xhr = new XMLHttpRequest();
    let startTime = Date.now(); // Store start time for speed calculation
    let lastLoaded = 0; // To calculate speed
    const files = formData.getAll('pdf[]'); // Get all uploaded PDFs
    const totalSize = files.reduce((acc, file) => acc + file.size, 0); // Total size of all files

    // Display total file size
    const totalFileSizeDisplay = document.getElementById('totalFileSizeDisplay');
    const totalSizeMB = (totalSize / (1024 * 1024)).toFixed(2); // Convert bytes to MB
    totalFileSizeDisplay.textContent = `Total file size: ${totalSizeMB} MB`;

    // Show uploaded file names and sizes
    const uploadedFilesDisplay = document.getElementById('uploadedFilesDisplay');
    uploadedFilesDisplay.innerHTML = ''; // Clear previous display
    files.forEach(file => {
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2); // Convert to MB
        const fileElement = document.createElement('div');
        fileElement.textContent = `${file.name} - ${fileSizeMB} MB`;
        uploadedFilesDisplay.appendChild(fileElement);
    });

    // Progress event
    xhr.upload.addEventListener('progress', function (e) {
        if (e.lengthComputable) {
            const percentComplete = Math.round((e.loaded / e.total) * 100);
            const progressBar = document.getElementById('progressBar');
            progressBar.style.width = percentComplete + '%';
            progressBar.setAttribute('aria-valuenow', percentComplete);
            progressBar.textContent = percentComplete + '%';

            // Calculate transfer speed and remaining time
            const elapsedTime = (Date.now() - startTime) / 1000; // In seconds
            const bytesUploaded = e.loaded - lastLoaded;
            const speed = bytesUploaded / elapsedTime; // Speed in bytes per second
            const remainingBytes = e.total - e.loaded;
            const remainingTime = remainingBytes / speed; // Estimated time in seconds
            const remainingMB = remainingBytes / (1024 * 1024); // MB
            const speedKB = speed / 1024; // KB/s
            const remainingTimeFormatted = formatTime(remainingTime);

            // Update progress with speed, remaining size, and time
            const remainingDisplay = document.getElementById('remainingDisplay');
            const timeDisplay = document.getElementById('timeDisplay');
            const speedDisplay = document.getElementById('speedDisplay');

            remainingDisplay.textContent = `Total remaining: ${remainingMB.toFixed(2)} MB (${percentComplete}%)`;
            timeDisplay.textContent = `Estimated time remaining: ${remainingTimeFormatted}`;
            speedDisplay.textContent = `Transfer rate: ${speedKB.toFixed(2)} KB/s`;

            lastLoaded = e.loaded; // Update last loaded for the next calculation
        }
    });

    // Load event (when the server responds)
    xhr.addEventListener('load', function () {
        if (xhr.status === 200) {
            // Enable OK button
            okButton.style.display = 'block';
            okButton.addEventListener('click', function () {
                window.location.reload(); // Reload page
            });
        } else {
            progressModal.hide();
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while processing the data on the server.',
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
            text: 'An error occurred during data upload.',
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

// Function to send form data without progress modal
function sendFormData(formData, actionUrl, successMessage) {
    const xhr = new XMLHttpRequest();

    xhr.addEventListener('load', function () {
        if (xhr.status === 200) {
            Swal.fire({
                title: 'Success!',
                text: successMessage,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload(); // Reload the page
            });
        } else {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while processing the data on the server.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });

    xhr.addEventListener('error', function () {
        Swal.fire({
            title: 'Error!',
            text: 'An error occurred during submission.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });

    xhr.open('POST', actionUrl, true);
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    xhr.send(formData);
}
</script>

@endsection
