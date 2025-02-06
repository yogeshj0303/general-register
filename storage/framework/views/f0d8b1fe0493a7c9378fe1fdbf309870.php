<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.list-js7'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
         <div class="col-xxxl-6">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Gram Annual Maintenance</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                
                                    <a href="<?php echo e(route('annual-maintenance.create')); ?>">
                                    <button type="button" class="btn btn-success add-btn" ><i
                                            class="ri-add-line align-bottom me-1"></i> Add</button>
                                        </a>
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

                        <div class="table-responsive  mt-3 mb-1">
                            <table class="table table-bordered align-middle table-nowrap" id="">
                                <thead class="table-light">
                                    <tr>
                                           <th class="sort" data-sort="customer_name">ID</th>
                                        <th class="sort" data-sort="customer_name">State</th>
                                        <th class="sort" data-sort="email">District</th>
                                        <th class="sort" data-sort="phone">Taluka</th>
                                        <th class="sort" data-sort="date">Gram Name</th>
                                        <th class="sort" data-sort="status">Population</th>
                                        <th class="sort" data-sort="status">Maintenance Amount</th>
                                        <th class="sort" data-sort="status">Description</th>
                                        <th class="sort" data-sort="status">Payment Mode</th>
                                        <th class="sort" data-sort="status">Status</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <?php $__currentLoopData = $annualMaintenance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($record->id); ?></td>
                                            <td><?php echo e($record->state); ?></td>
                                            <td><?php echo e($record->district); ?></td>
                                            <td><?php echo e($record->taluka); ?></td>
                                            <td><?php echo e($record->gram); ?></td>
                                            <td><?php echo e($record->current_population); ?></td>
                                            <td><?php echo e($record->maintenance_amount); ?></td>
                                            <td><?php echo e($record->description); ?></td>
                                            <td><span class="badge bg-success-subtle text-success text-uppercase"><?php echo e($record->payment_mode); ?></span></td>
                                            <td><span class="badge bg-success-subtle text-success text-uppercase"><?php echo e($record->bill_status); ?></span></td>
                                            <td>
                                                 <!-- Edit Button -->
            <a href="<?php echo e(route('annual-maintenance.edit', $record->id)); ?>" class="btn btn-sm btn-primary">Edit</a>

                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal" data-id="<?php echo e($record->id); ?>">
                                                Delete
                                            </button>
                                            
                                              <button class="btn btn-sm btn-success viewuser" data-id="<?php echo e($record->id); ?>">
    <i class="fa fa-eye"></i> View
</button>
 <button class="btn btn-sm btn-warning remove-item-btn" onclick="printAffidavit(<?php echo e($record->id); ?>)">
    Print
</button>
<script>
  function printAffidavit(userId) {
          const printWindow = window.open('/annualprint/' + userId, '_blank');
       

}

</script>


                                            
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>

      <!-- Delete Modal -->
      <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you Sure?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record?</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
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
                <h5 class="modal-title" id="viewCategoryModalLabel">Gram Annual Maintenance</h5>
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
                        <label for="viewGram" class="form-label">Gram</label>
                        <input type="text" class="form-control" id="viewGram" readonly>
                    </div>
                    <div class="col-md-6">
    <label for="viewMaintenanceYear" class="form-label">Maintenance Year</label>
    <input type="number" class="form-control" id="viewMaintenanceYear" readonly>
</div>

                    <div class="col-md-6">
    <label for="viewMaintenanceAmount" class="form-label">Maintenance Amount</label>
    <input type="number" class="form-control" id="viewMaintenanceAmount" readonly>
</div>

                    <div class="col-md-6">
    <label for="viewRemainingAmount" class="form-label">Remaining Amount</label>
    <input type="number" class="form-control" id="viewRemainingAmount" readonly>
</div>

                    <div class="col-md-6">
    <label for="viewPaymentMode" class="form-label">Payment Mode</label>
    <input type="text" class="form-control" id="viewPaymentMode" readonly>
</div>

                    <div class="col-md-6">
    <label for="viewDescription" class="form-label">Description</label>
    <textarea id="viewDescription" class="form-control" rows="5" maxlength="5000" readonly></textarea>
    <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
</div>

                    <div class="col-md-6">
    <label for="viewCurrentPopulation" class="form-label">Current Population</label>
    <input type="number" class="form-control" id="viewCurrentPopulation" readonly>
</div>

                    <div class="col-md-6">
    <label for="viewBillStatus" class="form-label">Bill Status</label>
    <input type="text" class="form-control" id="viewBillStatus" readonly>
</div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    
    <!-- end row -->

    <!-- end row -->

    <!--end modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>

<!-- listjs init -->
<script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    
    
    
    <script>
    $(document).on('click', '.viewuser', function() {
        const id = $(this).data('id'); // Fetch the user ID from the data-id attribute

        $.ajax({
            url: `/annual-maintenance/${id}`, 
            method: 'GET',
            success: function(response) {
                                const record = response.gram || {};

                console.log(response);
                             $('#viewState').val(record.state || 'N/A');
                $('#viewDistrict').val(record.district || 'N/A');
                $('#viewName').val(record.taluka || 'N/A');
                $('#viewGram').val(record.gram || 'N/A');
                $('#viewMaintenanceYear').val(record.maintenance_year || 'N/A');
                $('#viewMaintenanceAmount').val(record.maintenance_amount || 'N/A');
                $('#viewRemainingAmount').val(record.remaining_amount || 'N/A');
                $('#viewPaymentMode').val(record.payment_mode || 'N/A');
                $('#viewDescription').val(record.description || 'N/A');
                $('#viewCurrentPopulation').val(record.current_population || 'N/A');
                $('#viewBillStatus').val(record.bill_status || 'N/A');
                $('#viewCategoryModal').modal('show');


            },
            error: function() {
                alert('Failed to fetch user details.');
            }
        });
    });
</script>

    









    <script>
        $(document).ready(function() {
            // Handle Edit Gram Modal
        

            // Handle Delete Gram
            $('.remove-item-btn').click(function() {
                var id = $(this).data('id');
                $('#deleteForm').attr('action', '/annual-maintenance/' + id);
            });

            // Handle Delete Gram Form Submission
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
                        Swal.fire({ // Use SweetAlert2 for better notifications
                        title: 'Deleted!',
                        text: 'Annual Maintenance deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); // Reload page after user acknowledges the notification
                    });
                    },
                    error: function(response) {
                        alert('An error occurred while trying to delete the gram.');
                    }
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/egram/public_html/resources/views/annual-maintenance/index.blade.php ENDPATH**/ ?>