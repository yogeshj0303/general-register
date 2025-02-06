
@extends('layouts.master')
@section('title')
    @lang('translation.user')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
     <div class="col-xxxl-6">
            @if (session('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Users</h4>
            </div><!-- end card header -->
            
              <div class="card-body">
                    <div class="listjs-table" id="">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                 @if((isset($permissions)) && (  
    ($permissions['manage_user_add'] == 2)
))
                                <a href="{{ route('users.create') }}">
                                    <button type="button" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Add
                                    </button>
                                </a>
                                @endif
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        

            <!--<div class="card-body">-->
            <!--    <div class="listjs-table" id="customerList">-->
            <!--        <div class="row g-4 mb-3">-->
            <!--            <div class="col-sm-auto">-->
            <!--                <div>-->
                              
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-sm">-->
            <!--                <div class="d-flex justify-content-sm-end">-->
            <!--                    <div class="search-box ms-2">-->
            <!--                        <input type="text" class="form-control search" placeholder="Search...">-->
            <!--                        <i class="ri-search-line search-icon"></i>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

                  
                        <div class="table-responsive  mt-3 mb-1">
                        <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                        <th class="sort" data-sort="customer_name">ID</th>
                                    <th class="sort" data-sort="customer_name">State</th>
                                    <th class="sort" data-sort="email">District</th>
                                    <th class="sort" data-sort="phone">Taluka</th>
                                    <th class="sort" data-sort="date">School Name</th>
                                    <th class="sort" data-sort="status">User Name</th>
                                    <th class="sort" data-sort="customer_name">Contact</th>
                                    <th class="sort" data-sort="email">User Type</th>
                                    <th class="sort" data-sort="status">Date Of Birth</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                             @if((isset($permissions)) && (  
    ($permissions['manage_user_viewown'] == 2) || ($permissions['manage_user_viewall'] == 2)
))
                            <tbody class="list form-check-all">
                                @forelse($users as $user)
                                <tr id="talukaRow{{ $user->id }}" data-id="{{ $user->id }}">
                                     <td class="customer_name">{{ $user->id }}</td>
                                    <td class="customer_name">{{ $user->state }}</td>
                                    <td class="email">{{ $user->district }}</td>
                                    <td class="phone">{{ $user->taluka }}</td>
                                    <td class="date">{{ $user->gram }}</td>
                                    <td class="customer_name">{{ $user->name }}</td>
                                    <td class="email">{{ $user->contact_no }}</td>
                                    <td class="phone">{{ $user->role->role_name }}</td>
                                    <td class="status">{{ $user->dob }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                             @if((isset($permissions)) && (  
    ($permissions['manage_user_edit'] == 2)
))
                                            <div class="edit">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            </div>
                                            @endif
                                             @if((isset($permissions)) && (  
    ($permissions['manage_user_delete'] == 2)
))
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="{{ $user->id }}">Delete</button>
                                            </div>
                                            @endif
                                            
                                                                                        <button class="btn btn-sm btn-success viewuser" data-id="{{ $user->id }}">
    <i class="fa fa-eye"></i> View
</button>


                                                                    <button class="btn btn-sm btn-warning remove-item-btn" onclick="printAffidavit({{ $user->id }})">
    Print
</button>

<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/userprint/' + userId, '_blank');
     

}

</script>




                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="12" class="text-center">No users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            @endif
                        </table>
                             @if((isset($permissions)) && (  
    ($permissions['manage_user_viewown'] == 2) || ($permissions['manage_user_viewall'] == 2)
)) 
                               @if ($users->isNotEmpty())
                            <div class="d-flex justify-content-center">
                               {!! $users->links() !!}
                            </div>
                        @endif
                        @endif
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Orders but couldn't find any matching records.</p>
                            </div>
                        </div>
                    </div>



                    <!--<div class="d-flex justify-content-end">-->
                    <!--    <div class="pagination-wrap hstack gap-2">-->
                    <!--        @if(!empty($users))-->

                    <!--        {{ $users->links() }}-->
                           
                    <!--        @endif-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>



<!-- end row -->
<!-- Delete Confirmation Modal -->
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

<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View User</h5>
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
                        <label for="viewGram" class="form-label">School Name</label>
                        <input type="text" class="form-control" id="viewGram" readonly>
                    </div>

                    <!-- User Name -->
                    <div class="col-md-6">
                        <label for="viewUserName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="viewUserName" readonly>
                    </div>

                    <!-- Contact No -->
                    <div class="col-md-6">
                        <label for="viewContactNo" class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="viewContactNo" readonly>
                    </div>

                    <!-- Gate Number -->
                    <div class="col-md-6">
                        <label for="viewGateNo" class="form-label">Gmail</label>
                        <input type="text" class="form-control" id="viewGmail" readonly>
                    </div>

                    <!-- Gender -->
                    <div class="col-md-6">
                        <label for="viewGender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="viewGender" readonly>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <label for="viewDob" class="form-label">Date of Birth</label>
                        <input type="text" class="form-control" id="viewDob" readonly>
                    </div>

                    <!-- Age -->
                    <div class="col-md-6">
                        <label for="viewAge" class="form-label">Age</label>
                        <input type="text" class="form-control" id="viewAge" readonly>
                    </div>

                   

                    <!-- User Type -->
                    
                    <div class="col-md-6">
                        <label for="viewUserType" class="form-label">User Type</label>
                        <input type="text" class="form-control" id="viewUserType" readonly>
                    </div>
                  <div class="col-md-6 mt-3"> <!-- Add some margin-top -->
    <label for="viewProfilePic" class="form-label">Profile Picture</label>
    <div>
        <img id="viewProfilePic" src="/images/default-profile.png" alt="Profile Picture" 
            class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
    </div>
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




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).on('click', '.viewuser', function() {
        const id = $(this).data('id'); // Fetch the user ID from the data-id attribute

        $.ajax({
            url: `/users/${id}`, // Use template literal to dynamically include the ID
            method: 'GET',
            success: function(response) {
                console.log(response);
            
                // Populate the modal fields with the response data
                $('#viewState').val(response.user.state);
                $('#viewDistrict').val(response.user.district);
                $('#viewName').val(response.user.taluka);
                               $('#viewGram').val(response.user.gram || 'N/A');
$('#viewUserName').val(response.user.name || 'N/A');
$('#viewContactNo').val(response.user.contact_no || 'N/A');
$('#viewGmail').val(response.user.email || 'N/A');
$('#viewGender').val(response.user.gender || 'N/A');
$('#viewDob').val(response.user.dob || 'N/A');
$('#viewAge').val(response.user.age || 'N/A');
                $('#viewUserType').val(response.roles || 'N/A');



$('#viewProfilePic').attr('src', response.presignedUrl
); // Update the src attribute

                // Show the modal
                $('#viewCategoryModal').modal('show');
            },
            error: function() {
                alert('Failed to fetch user details.');
            }
        });
    });
</script>


<script>
$(document).ready(function () {
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', '/users/' + id);  // Set the URL to the user ID for deletion
    });

    $('#deleteForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = $(this);
        var actionUrl = form.attr('action');  // Get the action URL

        $.ajax({
            url: actionUrl,
            type: 'DELETE',  // Ensure this is a DELETE request
            data: form.serialize(),  // Pass the form data with the CSRF token
            success: function(response) {
                // On success, remove the corresponding row from the table
                $('#talukaRow' + actionUrl.split('/').pop()).remove();
                $('#deleteRecordModal').modal('hide');
                    // Success message with SweetAlert
                Swal.fire({
                    title: 'Success!',
                    text: 'User delete successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(); // Reload after closing the success alert
                    }
                });
            },
            error: function(response) {
                alert('An error occurred while deleting the user.');
            }
        });
    });
});

</script>
@endsection
