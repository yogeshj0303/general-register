@extends('layouts.master')
@section('title')
    @lang('translation.category')
@endsection

@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- List Categories -->
        <div class="col-xxl-6">
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
                    <h4 class="card-title mb-0 flex-grow-1">Categories</h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="categoryTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr id="categoryRow{{ $category->id }}">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category_name }}</td>
                                        <td>
                                           <!-- Edit Button -->
                                           <button class="btn btn-sm btn-primary editCategory" data-id="{{ $category->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
<button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="{{ $category->id }}">
    Delete
 </button>
 
 
<button class="btn btn-sm btn-success viewCategory" data-id="{{ $category->id }}">
    <i class="fa fa-eye"></i> View
</button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No categories found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($categories->isNotEmpty())
                            <div class="d-flex justify-content-center">
                                {!! $categories->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="category_name" placeholder="Enter Category Name">
                            @error('category_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
    

<!-- View Category Modal -->
<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCategoryModalLabel">View Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="viewName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="viewName" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                  @csrf
    @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editName" name="category_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
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




<script>
    $(document).on('click', '.viewCategory', function() {
    const categoryId = $(this).data('id');

    // Fetch category data via AJAX
    $.ajax({
        url: `/categories/${categoryId}`, 
        method: 'GET',
        success: function(response) {
            $('#viewName').val(response.category_name);

            // Show the modal
            $('#viewCategoryModal').modal('show');
        },
        error: function() {
            alert('Failed to fetch category details.');
        }
    });
});

</script>





<script>
$(document).ready(function () {
    // Open Edit Modal and Load Data
    $('.editCategory').click(function () {
        var id = $(this).data('id');

        // Fetch category data via AJAX
        $.get('/category/' + id + '/edit', function (data) {
            $('#editCategoryModal').modal('show'); // Show modal
            $('#editName').val(data.category_name); // Fill input field
            $('#editCategoryForm').attr('action', '/category/' + id); // Set form action URL
        });
    });

    // Handle Edit Form Submission
    $('#editCategoryForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        var form = $(this);
        var actionUrl = form.attr('action'); // Get form action URL
        var formData = form.serialize(); // Serialize form data

        // Perform AJAX request
        $.ajax({
            url: actionUrl,
            type: 'PUT',
            data: formData,
            success: function (response) {
                // Update table row dynamically
                var id = response.id;
                $('#categoryRow' + id + ' .categoryName').text(response.category_name);

                // Close modal and show success alert
                $('#editCategoryModal').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: 'Category updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload(); // Reload page
                });
            },
            error: function () {
                alert('An error occurred while updating the category.');
            }
        });
    });
});
</script>





<script>
     // Handle Delete Gram
        $('.remove-item-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/categories/' + id);
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
                    $('#categoryRow' + id).remove();
                    $('#deleteRecordModal').modal('hide');
                       Swal.fire(
                            'Deleted!',
                            'Category has been deleted successfully.',
                            'success'
                        );
                },
                error: function(response) {
                      Swal.fire(
                            'Error!',
                            'An error occurred while deleting the category.',
                            'error'
                        ); 
                        
                    
                }
            });
        });

</script>









@endsection
