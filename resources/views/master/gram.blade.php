@extends('layouts.master')
@section('title')
    @lang('translation.Grams')
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
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
                    <h4 class="card-title mb-0 flex-grow-1">School</h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="gramTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>School Name</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>School Address</th>
                                    <th>Pin Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($grams as $gram)
                                <tr id="gramRow{{ $gram->id }}">
                                    <td>{{ $gram->id }}</td>
                                    <td>{{ $gram->gram_name }}</td>
                                    <td>{{ $gram->state }}</td>
                                    <td>{{ $gram->district }}</td>
                                    <td>{{ $gram->taluka }}</td>
                                    <td>{{ $gram->address }}</td>
                                    <td>{{ $gram->pin_code }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-primary editGram my-3" data-id="{{ $gram->id }}">
                                         <i class="fa fa-edit"></i> Edit
                                     </button>
<button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="{{ $gram->id }}">
 Delete
</button>

<button class="btn btn-sm btn-success viewCategory my-3 " data-id="{{ $gram->id }}">
    <i class="fa fa-eye"></i> View
</button>
  <button class="btn btn-sm btn-warning remove-item-btn" onclick="printAffidavit({{ $gram->id }})">
    Print
</button>
<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/gramprint/' + userId, '_blank');
    
}

</script>




                                     </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No School found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        @if($grams->isNotEmpty())
                            <div class="d-flex justify-content-center">
                                {!! $grams->links() !!}
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
            <h4 class="card-title mb-0 flex-grow-1">Add School</h4>
        </div>
        <div class="card-body">
<form action="{{ route('grams.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
               <div class="col-md-12">
        <label for="state" class="form-label">State</label>
        <select name="state" id="state" class="form-control js-example-basic-single @error('state') is-invalid @enderror">
            <option value="">Select State</option>
            @foreach ($statesData['states'] as $state)
                <option value="{{ $state['state'] }}" {{ old('state') == $state['state'] ? 'selected' : '' }}>
                    {{ $state['state'] }}
                </option>
            @endforeach
        </select>
        @error('state')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="district" class="form-label">District</label>
        <select name="district" id="district" class="form-control @error('district') is-invalid @enderror">
            <option value="">Select District</option>
        </select>
        @error('district')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="taluka" class="form-label">Taluka</label>
        <select name="taluka" id="taluka-field" class="form-select">
            <option value="">Select Taluka</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="gram_name" class="form-label">School Name</label>
        <input type="text" name="gram_name" class="form-control @error('gram_name') is-invalid @enderror" id="gram_name" value="{{ old('gram_name') }}" placeholder="Enter Gram Name">
        @error('gram_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="pincode" class="form-label">Pin Code</label>
        <input type="text" name="pin_code" class="form-control" id="pincode" value="{{ old('pin_code') }}" placeholder="Enter Pin Code">
        @error('pin_code')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

<div class="col-md-6 mb-3">
    <label for="school_contact_no" class="form-label">School Contact No</label>
    <input type="text" name="school_contact_no" class="form-control" id="school_contact_no" 
        value="{{ old('school_contact_no') }}" placeholder="Enter School Contact No" 
        maxlength="10" onkeypress="return isNumber(event)">
    @error('school_contact_no')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<script>
    function isNumber(evt) {
        var charCode = evt.which ? evt.which : evt.keyCode;
        if (charCode < 48 || charCode > 57) {
            return false; // Only allow numbers (0-9)
        }
        return true;
    }
</script>


    <div class="col-md-6 mb-3">
        <label for="school_gmail" class="form-label">School Gmail</label>
        <input type="text" name="school_gmail" class="form-control" id="school_gmail" value="{{ old('school_gmail') }}" placeholder="Enter School Gmail">
        @error('school_gmail')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="address" class="form-label">School Address</label>
        <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter Address">{{ old('address') }}</textarea>
        @error('address')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="school_gram_no" class="form-label">School Grant Number</label>
        <input type="text" name="school_gram_no" class="form-control" id="school_gram_no" value="{{ old('school_gram_no') }}" placeholder="Enter School Grant Number">
        @error('school_gram_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="school_management" class="form-label">School Management</label>
        <input type="text" name="school_management" class="form-control" id="school_management" value="{{ old('school_management') }}" placeholder="Enter School Management">
        @error('school_management')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="school_level" class="form-label">School Level</label>
        <input type="text" name="school_level" class="form-control" id="school_level" value="{{ old('school_level') }}" placeholder="Enter School Level">
        @error('school_level')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="school_udash_no" class="form-label">School UDASH Number</label>
        <input type="text" name="school_udash_no" class="form-control" id="school_udash_no" value="{{ old('school_udash_no') }}" placeholder="Enter School UDASH Number">
        @error('school_udash_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="school_board" class="form-label">School Board</label>
        <input type="text" name="school_board" class="form-control" id="school_board" value="{{ old('school_board') }}" placeholder="Enter School Board">
        @error('school_board')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
  <div class="col-md-6 mb-3">
    <label for="school_logo" class="form-label">School Logo</label>
    <input type="file" name="school_logo" class="form-control" id="school_logo" accept="image/*" onchange="previewImage(event)">
    
    <!-- Image preview container -->
    <div id="imagePreviewContainer" class="mt-3" style="display: none;">
        <img id="imagePreview" src="" alt="School Logo Preview" class="img-fluid" width="200px">
    </div>
    
    @error('school_logo')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


    <div class="col-md-12 mb-3" id="dynamic-fields">
        <div class="row mb-2" id="row-1">
            <div class="col-md-4">
                <label for="class_name_1" class="form-label">Class Name</label>
                <input type="text" name="class_name[]" class="form-control" id="class_name_1" value="{{ old('class_name.0') }}" placeholder="Enter Class Name">
                @error('class_name.0') 
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="class_teacher_name_1" class="form-label">Class Teacher Name</label>
                <input type="text" name="class_teacher_name[]" class="form-control" id="class_teacher_name_1" value="{{ old('class_teacher_name.0') }}" placeholder="Enter Class Teacher Name">
                @error('class_teacher_name.0')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="whatsapp_no_1" class="form-label">Whatsapp No</label>
                <input type="number" name="whatsapp_no[]" class="form-control" id="whatsapp_no_1" value="{{ old('whatsapp_no.0') }}" placeholder="Enter Whatsapp No">
                @error('whatsapp_no.0')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <button type="button" class="btn btn-success" id="add-row">
            <i class="fa fa-plus"></i> +
        </button>
    </div>
  <div class="row mb-2" id="principal-details">
    <div class="col-md-4">
        <label for="principal_name" class="form-label">Principal Name</label>
        <input type="text" name="principal_name" class="form-control" id="principal_name" placeholder="Enter Principal Name" value="{{ old('principal_name') }}">
        @error('principal_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="principal_type" class="form-label">Principal Type</label>
        <input type="text" name="principal_type" class="form-control" id="principal_type" placeholder="Enter Principal Type" value="{{ old('principal_type') }}">
        @error('principal_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="principal_whatsapp_no" class="form-label">Principal Whatsapp No</label>
        <input type="number" name="principle_whatsapp_no" class="form-control" id="principal_whatsapp_no" placeholder="Enter Principal Whatsapp No" value="{{ old('principle_whatsapp_no') }}">
        @error('principle_whatsapp_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Clerk Details -->
<div class="row mb-2" id="clerk-details">
    <div class="col-md-4">
        <label for="clerk_name" class="form-label">Clerk Name</label>
        <input type="text" name="clerk_name" class="form-control" id="clerk_name" placeholder="Enter Clerk Name" value="{{ old('clerk_name') }}">
        @error('clerk_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="clerk_whatsapp_no" class="form-label">Clerk Whatsapp No</label>
        <input type="number" name="clerk_whatspp_no" class="form-control" id="clerk_whatsapp_no" placeholder="Enter Clerk Whatsapp No" value="{{ old('clerk_whatspp_no') }}">
        @error('clerk_whatspp_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
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
            <form id="editGramForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editGramModalLabel">Edit School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- State -->
                    <div class="mb-3">
                        <label for="editState" class="form-label">State</label>
                        <select id="editState" name="state" class="form-select" required>
                            <option value="">Select state</option>
                            @foreach($statesData['states'] as $state)
                                <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- District -->
                    <div class="mb-3">
                        <label for="editDistrict" class="form-label">District</label>
                        <select name="district" id="editDistrict" class="form-control">
                            <option value="">Select District</option>
                            <!-- District options will be populated dynamically -->
                        </select>
                    </div>
                    
                    <!-- Taluka -->
                    <div class="mb-3">
                        <label for="editTaluka" class="form-label">Taluka</label>
                        <select name="taluka" id="editTaluka" class="form-select">
                            <option value="">Select Taluka</option>
                            <!-- Populate dynamically -->
                        </select>
                    </div>

                    <!-- School Name -->
                    <div class="mb-3">
                        <label for="editGramName" class="form-label">School Name</label>
                        <input type="text" name="gram_name" class="form-control" id="editGramName" >
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">School Address</label>
                        <textarea name="address" id="editAddress" class="form-control" rows="2" ></textarea>
                    </div>

                    <!-- Pin Code -->
                    <div class="mb-3">
                        <label for="editPincode" class="form-label">Pin Code</label>
                        <input type="text" name="pin_code" class="form-control" id="editPincode" >
                    </div>

                    <!-- School Contact No -->
                    <div class="mb-3">
                        <label for="editSchoolContactNo" class="form-label">School Contact No</label>
                        <input type="number" name="school_contact_no" class="form-control" id="editSchoolContactNo">
                    </div>

                    <!-- School Gmail -->
                    <div class="mb-3">
                        <label for="editSchoolGmail" class="form-label">School Gmail</label>
                        <input type="email" name="school_gmail" class="form-control" id="editSchoolGmail">
                    </div>

                    <!-- School Gram Number -->
                    <div class="mb-3">
                        <label for="editSchoolGramNo" class="form-label">School Grant Number</label>
                        <input type="text" name="school_gram_no" class="form-control" id="editSchoolGramNo">
                    </div>

                    <!-- School Management -->
                    <div class="mb-3">
                        <label for="editSchoolManagement" class="form-label">School Management</label>
                        <input type="text" name="school_management" class="form-control" id="editSchoolManagement">
                    </div>

                    <!-- School Level -->
                    <div class="mb-3">
                        <label for="editSchoolLevel" class="form-label">School Level</label>
                        <input type="text" name="school_level" class="form-control" id="editSchoolLevel">
                    </div>

                    <!-- School UDASH Number -->
                    <div class="mb-3">
                        <label for="editSchoolUdashNo" class="form-label">School UDASH Number</label>
                        <input type="text" name="school_udash_no" class="form-control" id="editSchoolUdashNo">
                    </div>

                    <!-- School Board -->
                    <div class="mb-3">
                        <label for="editSchoolBoard" class="form-label">School Board</label>
                        <input type="text" name="school_board" class="form-control" id="editSchoolBoard">
                    </div>
                     <div class="col-md-6 mb-3">
    <label for="school_logo" class="form-label">School Logo</label>
    <input type="file" name="school_logo" class="form-control" id="editschool_logo" accept="image/*" onchange="editpreviewImage(event)">
    
    <!-- Image preview container -->
    <div id="editimagePreviewContainer" class="mt-3" style="display: none;">
        <img id="editimagePreview" src="" alt="School Logo Preview" class="img-fluid" width="150px">
    </div>
</div>


                    
                      
  <div id="schoolDetailsContainer">

                    </div>
<!-- Principal Details -->

<div class="row mb-2" id="principal-details">
    <div class="col-md-4">
        <label for="principal_name" class="form-label">Principal Name</label>
        <input type="text" name="principal_name" class="form-control" id="edit_principal_name"  placeholder="Enter Principal Name">
        @error('principal_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="principal_type" class="form-label">Principal Type</label>
        <input type="text" name="principal_type" class="form-control" id="edit_principal_type"  placeholder="Enter Principal Type">
        @error('principal_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="principal_whatsapp_no" class="form-label">Principal Whatsapp No</label>
        <input type="number" name="principle_whatsapp_no" class="form-control" id="edit_principal_whatsapp_no"  placeholder="Enter Principal Whatsapp No">
       
    </div>
</div>

<!-- Clerk Details -->
<div class="row mb-2" id="clerk-details">
    <div class="col-md-4">
        <label for="clerk_name" class="form-label">Clerk Name</label>
        <input type="text" name="clerk_name" class="form-control" id="edit_clerk_name"  placeholder="Enter Clerk Name">
        @error('clerk_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="clerk_whatsapp_no" class="form-label">Clerk Whatsapp No</label>
        <input type="number" name="clerk_whatspp_no" class="form-control" id="edit_clerk_whatsapp_no" placeholder="Enter Clerk Whatsapp No">
        @error('clerk_whatspp_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
  
<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
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
                </div>

                <div class="row mb-3">
                    <!-- Taluka -->
                    <div class="col-md-6">
                        <label for="viewTaluka" class="form-label">Taluka</label>
                        <input type="text" class="form-control" id="viewTaluka" readonly>
                    </div>
                    <!-- School Name -->
                    <div class="col-md-6">
                        <label for="viewGram" class="form-label">School Name</label>
                        <input type="text" class="form-control" id="viewGram" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- School Address -->
                    <div class="col-md-4">
                        <label for="viewaddress" class="form-label">School Address</label>
                        <input type="text" class="form-control" id="viewaddress" readonly>
                    </div>
                    <!-- Pin Code -->
                    <div class="col-md-4">
                        <label for="viewpin_code" class="form-label">Pin Code</label>
                        <input type="text" class="form-control" id="viewpin_code" readonly>
                    </div>
                     <div class="col-md-4">
                        <label for="viewSchoolContactNo" class="form-label">School Contact No</label>
                        <input type="text" class="form-control" id="viewSchoolContactNo" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- School Contact No -->
                   
                    <!-- School Gmail -->
                    <div class="col-md-4">
                        <label for="viewSchoolGmail" class="form-label">School Gmail</label>
                        <input type="email" class="form-control" id="viewSchoolGmail" readonly>
                    </div>
                      <div class="col-md-4">
                        <label for="viewSchoolGramNo" class="form-label">School Grant Number</label>
                        <input type="text" class="form-control" id="viewSchoolGramNo" readonly>
                    </div>
                    <!-- School Management -->
                    <div class="col-md-4">
                        <label for="viewSchoolManagement" class="form-label">School Management</label>
                        <input type="text" class="form-control" id="viewSchoolManagement" readonly>
                    </div>
                </div>



                <div class="row mb-3">
                    <!-- School Level -->
                    <div class="col-md-4">
                        <label for="viewSchoolLevel" class="form-label">School Level</label>
                        <input type="text" class="form-control" id="viewSchoolLevel" readonly>
                    </div>
                    <!-- School UDASH No -->
                    <div class="col-md-4">
                        <label for="viewSchoolUdashNo" class="form-label">School UDASH Number</label>
                        <input type="text" class="form-control" id="viewSchoolUdashNo" readonly>
                    </div>
                      <div class="col-md-4">
                        <label for="viewSchoolBoard" class="form-label">School Board</label>
                        <input type="text" class="form-control" id="viewSchoolBoard" readonly>
                    </div>
                </div>
                 <div class="col-md-6 mb-3">
    <label for="school_logo" class="form-label">School Logo</label>

    <!-- Image preview container -->
    <div id="viewimagePreviewContainer" class="mt-3" style="display: none;">
        <img id="viewimagePreview" src="" alt="School Logo Preview" class="img-fluid" width="150px">
    </div>
</div>


               

<div id="viewschoolDetailsContainer">

                    </div>
                <!-- Principal Details -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="principal_name" class="form-label">Principal Name</label>
                        <input type="text" class="form-control" id="view_principal_name" placeholder="Enter Principal Name" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="principal_type" class="form-label">Principal Type</label>
                        <input type="text" class="form-control" id="view_principal_type" placeholder="Enter Principal Type" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="principal_whatsapp_no" class="form-label">Principal Whatsapp No</label>
                        <input type="text" class="form-control" id="view_principal_whatsapp_no" placeholder="Enter Principal Whatsapp No" readonly>
                    </div>
                </div>

                <!-- Clerk Details -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="clerk_name" class="form-label">Clerk Name</label>
                        <input type="text" class="form-control" id="view_clerk_name" placeholder="Enter Clerk Name" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="clerk_whatsapp_no" class="form-label">Clerk Whatsapp No</label>
                        <input type="text" class="form-control" id="view_clerk_whatsapp_no" placeholder="Enter Clerk Whatsapp No" readonly>
                    </div>
                </div>
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
function editpreviewImage(event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    // When the file is loaded, set the image preview
    reader.onload = function(e) {
        var imagePreview = document.getElementById('editimagePreview');
        imagePreview.src = e.target.result;

        // Show the image preview container
        document.getElementById('editimagePreviewContainer').style.display = 'block';
    };

    // If a file is selected, read it
    if (file) {
        reader.readAsDataURL(file);
    }
}

    function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        // When the file is loaded, set the image preview
        reader.onload = function(e) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;

            // Show the image preview container
            document.getElementById('imagePreviewContainer').style.display = 'block';
        };

        // If a file is selected, read it
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<script>
$(document).on('click', '.viewCategory', function () {
    const gramId = $(this).data('id');

    // Fetch category data via AJAX
    $.ajax({
        url: `/gramshow/${gramId}`,
        method: 'GET',
        success: function (response) {
            console.log('response' ,response );
            
            // Populate the modal fields with the response data
            $('#viewState').val(response.gram.state);
            $('#viewDistrict').val(response.gram.district);
            $('#viewTaluka').val(response.gram.taluka);
            $('#viewGram').val(response.gram.gram_name);
            $('#viewaddress').val(response.gram.address);
            $('#viewpin_code').val(response.gram.pin_code);

            $('#viewSchoolContactNo').val(response.gram.school_contact_no);
            $('#viewSchoolGmail').val(response.gram.school_gmail);
            $('#viewSchoolGramNo').val(response.gram.school_gram_no);
            $('#viewSchoolManagement').val(response.gram.school_management);
            $('#viewSchoolLevel').val(response.gram.school_level);
            $('#viewSchoolUdashNo').val(response.gram.school_udash_no);
            $('#viewSchoolBoard').val(response.gram.school_board);
var schoolLogoPath = response.schoolLogoPath || '/assets/default-logo.png'; // Use default logo if not available
        
        $('#viewimagePreview').attr('src', schoolLogoPath);

        // Show the image preview container
        $('#viewimagePreviewContainer').show();
            // Populate Principal and Clerk details
            $('#view_principal_name').val(response.gram.principal_name);
            $('#view_principal_type').val(response.gram.principal_type);
            $('#view_principal_whatsapp_no').val(response.gram.principle_whatsapp_no);
            $('#view_clerk_name').val(response.gram.clerk_name);
            $('#view_clerk_whatsapp_no').val(response.gram.clerk_whatspp_no);

            // Populate school details
            let schoolDetailsContainer = $('#viewschoolDetailsContainer');
            schoolDetailsContainer.empty(); // Clear any existing rows

            if (response.schoolDetails.length > 0) {
                response.schoolDetails.forEach((schoolDetail, index) => {
                    let row = `
                        <div class="row mb-2" id="row-${index + 1}">
                            <div class="col-md-4">
                                <label for="class_name_${index + 1}" class="form-label">Class Name</label>
                                <input type="text" name="class_name[]" class="form-control" id="class_name_${index + 1}" value="${schoolDetail.class_name}" placeholder="Enter Class Name">
                            </div>
                            <div class="col-md-4">
                                <label for="class_teacher_name_${index + 1}" class="form-label">Class Teacher Name</label>
                                <input type="text" name="class_teacher_name[]" class="form-control" id="class_teacher_name_${index + 1}" value="${schoolDetail.class_teacher_name}" placeholder="Enter Class Teacher Name">
                            </div>
                            <div class="col-md-4">
                                <label for="whatsapp_no_${index + 1}" class="form-label">Whatsapp No</label>
                                <div class="input-group">
                                    <input type="number" name="whatsapp_no[]" class="form-control" id="whatsapp_no_${index + 1}" value="${schoolDetail.whatsapp_no}" placeholder="Enter Whatsapp No">
                                </div>
                            </div>
                        </div>`;
                    schoolDetailsContainer.append(row);
                });
            }

            // Show the modal
            $('#viewCategoryModal').modal('show');
        },
        error: function (error) {
            console.error('Error fetching gram details:', error);
            alert('Failed to fetch category details.');
        },
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
     $(document).ready(function() {
        $('#taluka-field').select2({
            placeholder: 'Select taluka',
            allowClear: true
        });
    });
</script>
<script>
    //  $(document).ready(function() {
    //         // Handle state selection change
    //         $('#state').change(function() {
    //             var state = $(this).val(); // Get the selected state value
    //             var statesData = @json($statesData['states']); // Pass states data to JavaScript

    //             var districtDropdown = $('#district');
    //             districtDropdown.empty().append(
    //             '<option value="">Select District</option>'); // Clear existing options

    //             // Find the selected state object from the statesData array
    //             var selectedState = statesData.find(function(item) {
    //                 return item.state === state; // Match the selected state
    //             });

    //             // Check if the selected state is found
    //             if (selectedState) {
    //                 // Populate the district dropdown with the districts of the selected state
    //                 selectedState.districts.forEach(function(district) {
    //                     districtDropdown.append($('<option>', {
    //                         value: district, // Use the district name as the value
    //                         text: district // Display the district name as the option text
    //                     }));
    //                 });
    //             } else {
    //                 districtDropdown.append('<option value="">No districts available</option>');
    //             }

    //             // Clear the taluka field dropdown
    //             $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
    //         });
        
    //         $('#district').change(function() {
    //             var state = $('#state').val();
    //             var district = $(this).val();

    //             if (state && district) {
    //                 $.ajax({
    //                     url: '{{ route('tehsils.get') }}',
    //                     type: 'GET',
    //                     data: { state: state, district: district },
    //                     success: function(response) {
    //                         var talukaDropdown = $('#taluka-field');
    //                         talukaDropdown.empty().append('<option value="">Select Taluka</option>'); 

    //                         response.forEach(function(taluka) {
    //                             talukaDropdown.append($('<option>', {
    //                                 value: taluka,
    //                                 text: taluka
    //                             }));
    //                         });
    //                     },
    //                     error: function(xhr) {
    //                         console.error('Error fetching talukas:', xhr.responseText);
    //                     }
                        
                        
    //                 });
                
                    
                    
                    
    //             }
                
                
                
                
                
                
                        
                
                
    //         });

          
    //     });
</script>
<script>
    $(document).ready(function() {
        // Fetch user information from Blade variables
        var isAdmin = @json(Auth::user()->is_admin === 'admin');
        var userState = @json(Auth::user()->state);
        var userDistrict = @json(Auth::user()->district);
        var userTaluka = @json(Auth::user()->taluka);
       
        var statesData = @json($statesData['states']); // Pass states data to JavaScript

        var stateDropdown = $('#state');
        var districtDropdown = $('#district');
        var talukaDropdown = $('#taluka-field');
       

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

           
        }
    });
</script>
<script>
$(document).ready(function() {
    // Handle Edit Gram Modal
    $('.editGram').click(function() {
        var id = $(this).data('id');

        // Fetch gram data via AJAX
        $.get('/gram/' + id + '/edit', function(data) {
            console.log(data);

            // Show the edit modal
            $('#editGramModal').modal('show');

            // Populate the static fields
            $('#editGramName').val(data.gram.gram_name);
            $('#editState').val(data.gram.state).change();
            $('#editDistrict').val(data.gram.district).change();
            $('#editTaluka').data('selected-taluka', data.gram.taluka);
            $('#editAddress').val(data.gram.address);
            $('#editPincode').val(data.gram.pin_code);
            $('#editSchoolContactNo').val(data.gram.school_contact_no);
            $('#editSchoolGmail').val(data.gram.school_gmail);
            $('#editSchoolGramNo').val(data.gram.school_gram_no);
            $('#editSchoolManagement').val(data.gram.school_management);
            $('#editSchoolLevel').val(data.gram.school_level);
            $('#editSchoolUdashNo').val(data.gram.school_udash_no);
            $('#editSchoolBoard').val(data.gram.school_board);
 var schoolLogoPath = data.schoolLogoPath || '/assets/default-logo.png'; // Use default logo if not available
        
        // Set the image preview source
        $('#editimagePreview').attr('src', schoolLogoPath);

        // Show the image preview container
        $('#editimagePreviewContainer').show();

        // Show the image preview container
        $('#editimagePreviewContainer').show();
            // Populate Principal details
            $('#edit_principal_name').val(data.gram.principal_name);
            $('#edit_principal_type').val(data.gram.principal_type);
            $('#edit_principal_whatsapp_no').val(data.gram.principle_whatsapp_no);

            // Populate Clerk details
            $('#edit_clerk_name').val(data.gram.clerk_name);
            $('#edit_clerk_whatsapp_no').val(data.gram.clerk_whatspp_no);

            let schoolDetailsContainer = $('#schoolDetailsContainer');
            schoolDetailsContainer.empty(); // Clear any existing rows

           if (data.schoolDetails.length > 0) {
    data.schoolDetails.forEach((schoolDetail, index) => {
        let addButton = index === 0 ? `<button type="button" id="addRowButton" class="btn btn-primary btn-sm mx-2">+</button>` : '';
        let removeButton = index !== 0 ? `<button type="button" class="btn btn-danger btn-sm removeRow">-</button>` : '';

        let row = `
            <div class="row mb-2" id="row-${index}">
                <div class="col-md-4">
                    <label for="class_name_${index}" class="form-label">Class Name</label>
                    <input type="text" name="class_name[]" class="form-control" id="class_name_${index}" value="${schoolDetail.class_name}" placeholder="Enter Class Name">
                </div>
                <div class="col-md-4">
                    <label for="class_teacher_name_${index}" class="form-label">Class Teacher Name</label>
                    <input type="text" name="class_teacher_name[]" class="form-control" id="class_teacher_name_${index}" value="${schoolDetail.class_teacher_name}" placeholder="Enter Class Teacher Name">
                </div>
                <div class="col-md-4">
                    <label for="whatsapp_no_${index}" class="form-label">Whatsapp No</label>
                    <div class="input-group">
                        <input type="number" name="whatsapp_no[]" class="form-control" id="whatsapp_no_${index}" value="${schoolDetail.whatsapp_no}" placeholder="Enter Whatsapp No">
                        ${addButton}
                        ${removeButton}
                    </div>
                </div>
            </div>`;
        schoolDetailsContainer.append(row);
    });
}



            // Add new row button
            $('#addRowButton').click(function() {
                let rowCount = $('#schoolDetailsContainer .row').length + 1;
                let newRow = `
                    <div class="row mb-2" id="row-${rowCount}">
                        <div class="col-md-4">
                            <label for="class_name_${rowCount}" class="form-label">Class Name</label>
                            <input type="text" name="class_name[]" class="form-control" id="class_name_${rowCount}" placeholder="Enter Class Name">
                        </div>
                        <div class="col-md-4">
                            <label for="class_teacher_name_${rowCount}" class="form-label">Class Teacher Name</label>
                            <input type="text" name="class_teacher_name[]" class="form-control" id="class_teacher_name_${rowCount}" placeholder="Enter Class Teacher Name">
                        </div>
                        <div class="col-md-4">
                            <label for="whatsapp_no_${rowCount}" class="form-label">Whatsapp No</label>
                            <div class="input-group">
                                <input type="number" name="whatsapp_no[]" class="form-control" id="whatsapp_no_${rowCount}" placeholder="Enter Whatsapp No">
                                <button type="button" class="btn btn-danger btn-sm removeRow">-</button>

                            </div>
                        </div>
                    </div>`;
                schoolDetailsContainer.append(newRow);
            });

            // Handle row removal
            $(document).on('click', '.removeRow', function() {
                $(this).closest('.row').remove();
            });

            // Update the form's action URL
            $('#editGramForm').attr('action', '/gram/' + id);
        });
    });
});

</script>

<script>
    $(document).ready(function() {
        
      $('#editState').change(function() {
        var state = $(this).val();
        var statesData = @json($statesData['states']); // Pass states data to JavaScript

        var districtDropdown = $('#editDistrict');
        districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

        var selectedState = statesData.find(function(item) {
            return item.state === state;
        });

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
                        $('#editTaluka').val(selectedTaluka);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
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


$('#editGramForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    var form = $(this);
    var actionUrl = form.attr('action');
    var formData = new FormData(this);
    formData.append('_method', 'PUT'); 
    
    var fileInput = $('#editschool_logo')[0].files;
     console.log('fileInput' , fileInput);
    $.ajax({
        url: actionUrl,
        type: 'POST', 
        data: formData,
        contentType: false, 
        processData: false, 
        cache: false,
        success: function(response) {
            var id = response.id;

            // Update the corresponding table row with new data
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name); // School Name
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state); // State
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district); // District
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka); // Taluka
            $('#gramRow' + id + ' td:nth-child(6)').text(response.address); // Address
            $('#gramRow' + id + ' td:nth-child(7)').text(response.pin_code); // Pin Code
            $('#gramRow' + id + ' td:nth-child(8)').text(response.school_contact_no); // School Contact No
            $('#gramRow' + id + ' td:nth-child(9)').text(response.school_gmail); // School Gmail
            $('#gramRow' + id + ' td:nth-child(10)').text(response.school_gram_no); // School Gram Number
            $('#gramRow' + id + ' td:nth-child(11)').text(response.school_management); // School Management
            $('#gramRow' + id + ' td:nth-child(12)').text(response.school_level); // School Level
            $('#gramRow' + id + ' td:nth-child(13)').text(response.school_udash_no); // School UDASH Number
            $('#gramRow' + id + ' td:nth-child(14)').text(response.school_board); // School Board
            
            // File upload update
            if (response.school_logo) {
                $('#gramRow' + id + ' td:nth-child(15)').html('<img src="' + response.school_logo + '" width="50">'); // Show new logo
            }

            // Hide the modal
            $('#editGramModal').modal('hide');

            // Show success alert with SweetAlert2
            Swal.fire({
                title: 'Success!',
                text: 'School updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload(); // Reload the page after closing the success alert
                }
            });
        },
        error: function(xhr) {
            // Handle validation errors
            var errors = xhr.responseJSON.errors;
            console.log('errors', errors);

            $('.form-group .text-danger').remove();
           $.each(errors, function(field, messages) {
    var fieldParts = field.split('.');
    var fieldName = fieldParts[0];
    var index = fieldParts[1] ? fieldParts[1] : 0;

    var modalSelector = "#editGramModal";

    var dynamicFieldName = modalSelector + ` #${fieldName}_${index}`;
    if ($(dynamicFieldName).length) {
        $(dynamicFieldName).next('small.text-danger').remove();
        $(dynamicFieldName).after('<small class="text-danger d-block">' + messages[0] + '</small>');
    } else {
        var fieldNameFallback = modalSelector + ` [name='${field}']`;
        if ($(fieldNameFallback).length) {
            $(fieldNameFallback).next('small.text-danger').remove();
            $(fieldNameFallback).after('<small class="text-danger d-block">' + messages[0] + '</small>');
        }
    }
});

        }
    });
});


           });
</script>


<script>
     // Handle Delete Gram
        $('.remove-item-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/grams/' + id);
        });

        // Handle Delete Gram Form Submission
        $('#deleteForm').submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');
            var id = actionUrl.split('/').pop(); // Extract ID from URL

            $.ajax({
                url: actionUrl,
                type: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    $('#gramRow' + id).remove();
                    $('#deleteRecordModal').modal('hide');
                    Swal.fire(
                            'Deleted!',
                            'School has been deleted successfully.',
                            'success'
                        );
                },
                error: function(response) {
                          Swal.fire(
                            'Error!',
                            'An error occurred while deleting the School.',
                            'error'
                        );                }
            });
        });

</script>

<script>
$(document).ready(function() {
    let rowCount = 1;  // Initialize the row counter

    // Add new row
    $('#add-row').click(function() {
        rowCount++;
        let newRow = `
            <div class="row mb-2" id="row-${rowCount}">
                <div class="col-md-4">
                    <label for="class_name_${rowCount}" class="form-label">Class Name</label>
                    <input type="text" name="class_name[]" class="form-control" id="class_name_${rowCount}" placeholder="Enter Class Name">
                </div>
                <div class="col-md-4">
                    <label for="class_teacher_name_${rowCount}" class="form-label">Class Teacher Name</label>
                    <input type="text" name="class_teacher_name[]" class="form-control" id="class_teacher_name_${rowCount}" placeholder="Enter Class Teacher Name">
                </div>
                <div class="col-md-4">
                    <label for="whatsapp_no_${rowCount}" class="form-label">Whatsapp No</label>
                    <input type="number" name="whatsapp_no[]" class="form-control" id="whatsapp_no_${rowCount}" placeholder="Enter Whatsapp No">
                </div>
                <div class="col-md-12">
                    <button type="button" class="btn btn-danger remove-row" data-row-id="row-${rowCount}">
                        <i class="fa fa-minus"></i> -
                    </button>
                </div>
            </div>
        `;
        $('#dynamic-fields').append(newRow);
    });

    // Remove row
    $(document).on('click', '.remove-row', function() {
        let rowId = $(this).data('row-id');
        $(`#${rowId}`).remove();
    });
});
</script>








@endsection
