<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.dashboards'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<link href="<?php echo e(URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
<h4 class="fs-16 mb-1">Good Morning, <?php echo e(Auth::user()->name); ?>, <?php if(Auth::user()->is_admin != 'admin'): ?>(<?php echo e($permissions['role_name']); ?>)  <?php endif; ?> </h4><p class ="text-muted mb-0" id="current-time" class="fs-14"></p>



                        </div>
                      
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <?php if(Auth::user()): ?>
                 <?php if(($permissions['id'] != 1 && $permissions['id'] != 2) || Auth::user()->is_admin == "admin"): ?>  
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                   
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Register To Gram</p>
                                </div>
                               
                            </div>
                            <div class="mt-4">
                                <div class = "mt-4">
                                
                                       <select id="categoryDropdown" name="category_id" class="form-select js-example-basic-single mb-2" >
                                    <option value="" selected>Select Category</option>
                                    <?php if(!empty($categories)): ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                  <?php
                                  $getRegisterGramNew = DB::table('files')->count();
                                  ?>
                                
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4" style="margin-top:12px">
                                    <span id="categoryCount" class="text-primary"><?php echo e($getRegisterGramNew); ?></span>
                                </h4>
                                <?php if($getRegisterGram != 0  &&  $permissions['registered_gram_viewown'] == 2 || $permissions['registered_gram_viewall'] == 2 ): ?>
                                    <a href="<?php echo e(route('register-to-gram.index')); ?>" class="text-decoration-none text-muted">View All</a>
                                    <?php else: ?>
                                    <a href="" class="text-decoration-none text-muted">View All</a>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        </div><!-- end card body -->
                    </div>
                   <!-- end card -->
                </div><!-- end col -->
                 <?php endif; ?>
                 <?php endif; ?>
            <?php if(Auth::user()->is_admin == "admin" ): ?>
            <div class="col-xl-3 col-md-6">
    <!-- Card -->
    <div class="card card-animate">
        <div class="card-body">
            <!-- Header Section -->
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 overflow-hidden">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                        Total Gram Bills By Status
                    </p>
                </div>
            </div>

            <!-- Content Section -->
            <div class="mt-4">
                <!-- Gram Dropdown -->
                <div class="mb-4">
                    <select id="gramDropdown" class="form-select js-example-basic-single">
                        <option value="" selected>Select Gram</option>
                        <?php $__currentLoopData = $grams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gram->gram_name); ?>">
                            <?php echo e($gram->gram_name); ?>-<?php echo e($gram->taluka); ?>-<?php echo e($gram->district); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Status Sections -->
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Pending Section -->
                    <div class="text-center mx-2">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span id="pendingCount" class="text-primary"><?php echo e($pendingCount); ?></span>
                        </h4>
                        <a href="<?php echo e(route('gram-bills.index')); ?>" class="text-decoration-none text-muted">Pending</a>
                    </div>

                    <!-- Completed Section -->
                    <div class="text-center mx-2">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span id="completeCount" class="text-success"><?php echo e($completedCount); ?></span>
                        </h4>
                        <a href="<?php echo e(route('gram-bills.index')); ?>" class="text-decoration-none text-muted">Completed</a>
                    </div>

                    <!-- Total Amount Section -->
                    <div class="text-center mx-2">
                        <h4 class="fs-22 fw-semibold ff-secondary mb-2">
                            <span id="totalAmount" class="text-danger"><?php echo e($totalAmount); ?></span>
                        </h4>
                        <a href="<?php echo e(route('gram-bills.index')); ?>" class="text-decoration-none text-muted">Total Amount</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            <?php endif; ?>
            <!-- end col -->
  <?php if(Auth::user()->is_admin == "admin"): ?>
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                 <div class="card card-animate">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 overflow-hidden">
                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                    Total Pending Property / Water Annual
                </p>
            </div>
        </div>

        <div class="d-flex align-items-end justify-content-between mt-4">
            <div class="d-flex">
                <!-- Pending Section -->
                <div class="text-center mx-2">
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                        <span id="pendingGharPattiCount" class="text-primary">0</span>
                    </h4>
                    <a href="" class="text-decoration-none text-muted" id="showGharPattiUsers">total property annual users</a>
                </div>

                <!-- Completed Section -->
                <div class="text-center mx-2">
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                        <span id="pendingPaniPattiCount" class="text-success">0</span>
                    </h4>
                    <a href="" class="text-decoration-none text-muted" id="showPanipattiUsers">total water  annual user</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end card body -->
</div>

<!-- Modal for displaying users -->
<div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersModalLabel">Users List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="userList" class="list-group">
                    <!-- Users will be displayed here -->
                </ul>
            </div>
        </div>
    </div>
</div>

                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
    <div class="card-body">
    <div class="d-flex align-items-center">
        <div class="flex-grow-1 overflow-hidden">
            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                Total Gram Bill</p>
        </div>
    </div>

    <!-- Container for filters and bill count -->
    <div class="d-flex align-items-end justify-content-between mt-3">
        <!-- Dropdown for Gram Type (e.g., Gharpatti, Panipatti) -->
        <select class="form-select js-example-basic-single mb-2" id="billType" aria-label="Bill Type" style="width: auto;">
            <option value="" selected>Select Gram Type</option>
            <?php if(!empty($grams)): ?>
            <?php $__currentLoopData = $grams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($gram->gram_name); ?>"><?php echo e($gram->gram_name); ?>-<?php echo e($gram->taluka); ?>-<?php echo e($gram->district); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select><br>

   
    </div>
     <div class="d-flex align-items-end justify-content-between mt-2">
         <!-- From Date Selector -->
         <input type="date" id="fromDate" class="form-control mb-2" placeholder="From Date" style="width: 48%;">

        <!-- To Date Selector -->
        <input type="date" id="toDate" class="form-control mb-2" placeholder="To Date" style="width: 48%;">
    </div>
    <!-- Display Total Gram Bill Count -->
    <div>
        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
            <span id="totalGramBillCount" class="text-primary"><?php echo e($allGramCount); ?></span>
        </h4>
        <a href="<?php echo e(route('gram-bills.index')); ?>" class="text-decoration-none text-muted">
            See All Bills
        </a>
    </div>
</div>


                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                  
<div class="col-xl-3 col-md-6">
    <!-- card -->
    <div class="card card-animate">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 overflow-hidden">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                        Total Gram Annual Maintenance
                    </p>
                </div>
            </div>

            <!-- Add margin-bottom here to separate the dropdown from the sections -->
          <div class="d-flex align-items-end justify-content-between mt-4">
    <div class="d-flex align-items-center flex-wrap">
        
        <!-- Gram Dropdown -->
        <!--<select id="gramDropdownNew" class="form-select js-example-basic-single mb-4">-->
        <!--    <option value="" selected>Select Gram</option>-->
        <!--    <?php $__currentLoopData = $grams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
        <!--        <option value="<?php echo e($gram->gram_name); ?>">-->
        <!--            <?php echo e($gram->gram_name); ?> - <?php echo e($gram->taluka); ?> - <?php echo e($gram->district); ?>-->
        <!--        </option>-->
        <!--    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
        <!--</select>-->
        
        
  <div class="text-center mx-2 mb-4">
            <h4 class="fs-22 fw-semibold ff-secondary" style="margin-top:12px">
                <span id="withoutMaintenanceCount" class="text-primary"><?php echo e($gramsWithoutMaintenance->count()); ?></span>
            </h4>
            <a href="#" class="text-decoration-none text-muted">Paid</a>
        </div>

        <!-- Grams With Unpaid Maintenance -->
        <div class="text-center mx-2 mb-4">
            <h4 class="fs-22 fw-semibold ff-secondary" style="margin-top:12px">
                <span id="unpaidMaintenanceCount" class="text-success"><?php echo e($gramsWithUnpaidMaintenance->count()); ?></span>
            </h4>
            <a href="#" class="text-decoration-none text-muted">Unpaid</a>
        </div>
    </div>
</div>
<!-- end d-flex -->
        </div><!-- end card body -->
    </div><!-- end card -->
</div>
<?php endif; ?>

                </div><!-- end col -->
                
                <div class="row">
    <div class="col-xl-6 col-md-12">
        <!-- Card for Pending Gharpatti Users -->
     <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Pending Annual Taxation Users</h5>
        <?php if((isset($permissions)) && (  
    ($permissions['p_w_bill_viewown'] == 2 || $permissions['p_w_bill_viewall'] == 2) 
)): ?>

        <button class="btn btn-primary btn-sm">Total Pending Amount: ₹ <?php if(!empty($gharPattiUsers)): ?> <?php echo e($gharPattiUsers->sum('gharpatti_annual')); ?> <?php endif; ?></button>
        <?php endif; ?>

    </div>
    <div class="card-body"style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Assigned Amount</th>
                        <th>Pending Amount Year</th>
                        <th>Gram Name</th>
                        <th>Taluka</th>
                        <th>District</th>
                        <th>State</th>
                    </tr>
                </thead>
                 <?php if((isset($permissions)) && (  
    ($permissions['p_w_bill_viewown'] == 2 || $permissions['p_w_bill_viewall'] == 2) 
)): ?>
                <tbody>
                      <?php if(!empty($gharPattiUsers)): ?>
                    <?php $__currentLoopData = $gharPattiUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->gharpatti_annual); ?></td>
                        <td><?php echo e(now()->year); ?></td>
                        <td><?php echo e($user->gram); ?></td>
                        <td><?php echo e($user->taluka); ?></td>
                        <td><?php echo e($user->district); ?></td>
                        <td><?php echo e($user->state); ?></td>
                    </tr>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

    </div>

   
    <div class="col-xl-6 col-md-12">
    <!-- Card for Pending Panipatti Users -->
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Pending Water Annual Users</h4>
              <?php if((isset($permissions)) && (  
    ($permissions['p_w_bill_viewown'] == 2 || $permissions['p_w_bill_viewall'] == 2) 
)): ?>
            <button class="btn btn-primary btn-sm">Total Pending Amount: ₹ <?php if(!empty($paniPattiUsers)): ?><?php echo e($paniPattiUsers->sum('panipatti_annual')); ?> <?php else: ?> 0 <?php endif; ?></button>
            <?php endif; ?>
        </div>

        <div class="card-body" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Assigned Amount</th>
                            <th>Pending Amount Year</th>
                            <th>Gram Name</th>
                            <th>Taluka</th>
                            <th>District</th>
                            <th>State</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($paniPattiUsers)): ?>
                        <?php $__currentLoopData = $paniPattiUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->panipatti_annual); ?></td>
                            <td><?php echo e(now()->year); ?></td>
                            <td><?php echo e($user->gram); ?></td>
                            <td><?php echo e($user->taluka); ?></td>
                            <td><?php echo e($user->district); ?></td>
                            <td><?php echo e($user->state); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

  <?php if(Auth::user()->is_admin == "admin"): ?>
  <div class="row">
    <div class="col-xl-6 col-md-12">
        <!-- Card for Pending Gharpatti Users -->
     <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Paid Annual Maintenance Grams</h5>
        <button class="btn btn-primary btn-sm">Total Amount: <?php echo e($paidMaintenanceSum); ?></button>

    </div>
    <div class="card-body" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gram Name</th>
                        <th>Gram Detail</th>
                        <th>No.</th>
                        <th> Amount Year</th>
                        
                        <th>Amount</th>
                        <th>Pay mode</th>
                      
                        
                    </tr>
                </thead>
                <tbody>
                   
                       <?php if(!empty($gramsWithoutMaintenance)): ?>
                    <?php $__currentLoopData = $gramsWithoutMaintenance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
    <td><?php echo e($loop->iteration); ?></td>
    <td><?php echo e($user->gram_name ? $user->gram_name : 'NA'); ?></td>
    <td><?php echo e($user->gram_name && $user->taluka && $user->district && $user->state && $user->pin_code ? $user->gram_name . ' ' . $user->taluka . ' ' . $user->district . ' ' . $user->state . ' ' . $user->pin_code : 'NA'); ?></td>
    <td><?php echo e($user->invoice_no ? $user->invoice_no : 'NA'); ?></td>
    <td><?php echo e($user->maintenance_year ? $user->maintenance_year : 'NA'); ?></td>
    <td><?php echo e($user->maintenance_amount ? $user->maintenance_amount : 'NA'); ?></td>
    <td><?php echo e($user->payment_mode ? $user->payment_mode : 'NA'); ?></td>
</tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>

    <div class="col-xl-6 col-md-12">
        <!-- Card for Pending Panipatti Users -->
    <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Pending Payment Annual Maintenance Grams</h4>
                    <button class="btn btn-primary btn-sm"> Pending Amount: <?php echo e($unpaidMaintenanceSum); ?></button>

                </div>

                <div class="card-body" style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
                    <div class="table-responsive">
                     <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gram Name</th>
                        <th>Gram Detail</th>
                        <th>No.</th>
                        <th> Amount Year</th>
                        <th> Maintenance Date</th>
                        <th>Remaining Amount</th>
                      
                        <th>Pay mode</th>
                      
                        
                    </tr>
                </thead>
                <tbody>
                      <?php if(!empty($gramsWithUnpaidMaintenance)): ?>
                    <?php $__currentLoopData = $gramsWithUnpaidMaintenance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
    <td><?php echo e($loop->iteration); ?></td>
    <td><?php echo e($user->gram_name ? $user->gram_name : 'NA'); ?></td>
    <td><?php echo e($user->gram_name && $user->taluka && $user->district && $user->state && $user->pin_code ? $user->gram_name . ' ' . $user->taluka . ' ' . $user->district . ' ' . $user->state . ' ' . $user->pin_code : 'NA'); ?></td>
    <td><?php echo e($user->invoice_no ? $user->invoice_no : 'NA'); ?></td>
    <td><?php echo e($user->maintenance_year ? $user->maintenance_year : 'NA'); ?></td>
     <td><?php echo e($user->next_maintenance_date ? $user->next_maintenance_date : 'NA'); ?></td>
    <td><?php echo e($user->remaining_amount ? $user->remaining_amount : $user->maintenance_amount); ?></td>
    <td><?php echo e($user->payment_mode ? $user->payment_mode : 'NA'); ?></td>
</tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->

</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('build/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/jsvectormap/maps/world-merc.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.js')); ?>"></script>
<!-- dashboard init -->
<script src="<?php echo e(URL::asset('build/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
    
<script>
$('#gramDropdownNew').on('change', function () {
    const gramName = $(this).val();

    if (gramName) {
        $.ajax({
            url: '/get-gram-counts',
            type: 'GET',
            data: { gram: gramName },
            success: function (data) {
                $('#withoutMaintenanceCount').text(data.gramsWithoutMaintenance);
                $('#unpaidMaintenanceCount').text(data.gramsWithUnpaidMaintenance);
            },
            error: function (error) {
                console.error('Error fetching counts:', error);
            }
        });
    }
});

</script>
<script>
    function updateCurrentTime() {
        const now = new Date();

        // Get date components
        const day = String(now.getDate()).padStart(2, '0'); // Two-digit day
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const month = monthNames[now.getMonth()]; // Month as name
        const year = now.getFullYear();

        // Get time components
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // Convert to 12-hour format

        // Format date and time
        const formattedDateTime = `${day} ${month} ${year} ${hours}:${minutes} ${ampm}`;

        // Display the formatted date and time
        document.getElementById('current-time').innerText = formattedDateTime;
    }

    // Update the time every minute
    setInterval(updateCurrentTime, 60000);

    // Initial call to display time immediately
    updateCurrentTime();
</script>


<script>
    $(document).ready(function() {
        $('#gramDropdown').change(function() {
            var selectedGram = $(this).val();  // Get the selected gram

            // Check if a gram is selected
            if (selectedGram) {
                $.ajax({
                    url: '<?php echo e(route("get.gram.details")); ?>',  // Use the route defined above
                    type: 'POST',
                    data: {
                        gram_name: selectedGram,
                        _token: '<?php echo e(csrf_token()); ?>'  // Include CSRF token
                    },
                    success: function(response) {
                        // Update the counts and total amount with the response data
                        $('#pendingCount').text(response.pendingCount);
                        $('#completeCount').text(response.completedCount);
                        $('#totalAmount').text(response.totalAmount);
                    },
                    error: function() {
                        alert('Error fetching data.');
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Fetch counts for the current year
        $.ajax({
            url: '<?php echo e(route("get.ghar-panipatti.counts")); ?>',
            type: 'GET',
            success: function(response) {
                // Update the counts
                $('#pendingGharPattiCount').text(response.gharPattiNotRegisteredCount);
                $('#pendingPaniPattiCount').text(response.panipattiNotRegisteredCount);
            },
            error: function() {
                alert('Error fetching data.');
            }
        });

     
    });
</script>

<script>
    $(document).ready(function() {
    // Trigger AJAX on change of any filter (dropdown or date)
    $('#billType, #fromDate, #toDate').change(function() {
        var billType = $('#billType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        // Make an AJAX call with the selected filters
        $.ajax({
            url: '<?php echo e(route("get.gram-bills.count")); ?>', // Define the route for fetching filtered data
            type: 'GET',
            data: {
                billType: billType,
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(response) {
                // Update the displayed count based on the response
                $('#totalGramBillCount').text(response.totalGramBillCount);
            },
            error: function() {
                alert('Error fetching data.');
            }
        });
    });
});

</script>
<script>
    $(document).ready(function () {
        $('#categoryDropdown').on('change', function () {
            const categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: "<?php echo e(route('get.category.count')); ?>",
                    type: "POST",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        category_id: categoryId
                    },
                    success: function (response) {
                        $('#categoryCount').text(response.count);
                    },
                    error: function () {
                        alert('An error occurred while fetching the category count.');
                    }
                });
            } else {
                $('#categoryCount').text(0); // Reset count if no category selected
            }
        });
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/egram/public_html/resources/views/index.blade.php ENDPATH**/ ?>