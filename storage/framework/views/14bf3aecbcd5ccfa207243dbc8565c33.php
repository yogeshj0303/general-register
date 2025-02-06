 <style>
     #sidebarMore{
         display:none;
     }
 </style>
 
 
 <?php 
 if (Auth::user()->is_admin === 'user' ) {
    // Fetch permissions for 'staff' from the database as an array
    $permission = DB::table('roles')
        ->where('id', Auth::user()->user_type)
        ->first();

    // Check if permissions are found
    if ($permission) {
        // Convert the object to an associative array
        $permissions = (array) $permission;
    } else {
        // Create an array to hold the modified permissions
        $permissions = [];

        // List of modules and permission suffixes
        $modules = [
            'm_cat_viewown', 'm_cat_viewall', 'm_cat_edit', 'm_cat_delete', 'm_cat_add', 
        'm_taluka_add', 'm_taluka_edit', 'm_taluka_delete', 'm_taluka_viewown', 'm_taluka_viewall',
        'm_gram_add', 'm_gram_edit', 'm_gram_delete', 'm_gram_viewown', 'm_gram_viewall',
        'registered_gram_add', 'registered_gram_edit', 'registered_gram_delete', 'registered_gram_viewown', 
        'registered_gram_viewall', 'registered_gram_print', 'manage_user_add', 'manage_user_edit',
        'manage_user_delete', 'manage_user_viewown', 'manage_user_viewall', 'p_w_bill_add', 'p_w_bill_edit',
        'p_w_bill_delete', 'p_w_bill_viewown', 'p_w_bill_viewall', 'p_w_bill_print', 'about_gram_add', 
        'about_gram_edit', 'about_gram_delete', 'about_gram_viewown', 'about_gram_viewall', 'about_gram_print',
        'population_add', 'population_edit', 'population_delete', 'population_viewown', 'population_viewall',
        'population_print', 'gram_bill_add', 'gram_bill_edit', 'gram_bill_delete', 'gram_bill_viewown',
        'gram_bill_viewall', 'gram_bill_print', 'gram_annual_add', 'gram_annual_edit', 'gram_annual_delete',
        'gram_annual_viewown', 'gram_annual_viewall', 'gram_annual_print', 'dash_pending_taxation_user',
        'dash_pending_water_user', 'paid_annual_m_gram', 'pending_annual_m_gram'
        
     
        ];
        
        // Set permissions for the allowed actions to 0 (default)
        foreach ($modules as $module) {
        
                $permissions["{$module}"] = 1;
            
        }
    }
       
} else if (Auth::user()->is_admin === 'admin') {
    // Create an array to hold the modified permissions
    $permissions = [];

    // List of modules and permission suffixes
    $modules = [
        'm_cat_viewown', 'm_cat_viewall', 'm_cat_edit', 'm_cat_delete', 'm_cat_add', 
        'm_taluka_add', 'm_taluka_edit', 'm_taluka_delete', 'm_taluka_viewown', 'm_taluka_viewall',
        'm_gram_add', 'm_gram_edit', 'm_gram_delete', 'm_gram_viewown', 'm_gram_viewall',
        'registered_gram_add', 'registered_gram_edit', 'registered_gram_delete', 'registered_gram_viewown', 
        'registered_gram_viewall', 'registered_gram_print', 'manage_user_add', 'manage_user_edit',
        'manage_user_delete', 'manage_user_viewown', 'manage_user_viewall', 'p_w_bill_add', 'p_w_bill_edit',
        'p_w_bill_delete', 'p_w_bill_viewown', 'p_w_bill_viewall', 'p_w_bill_print', 'about_gram_add', 
        'about_gram_edit', 'about_gram_delete', 'about_gram_viewown', 'about_gram_viewall', 'about_gram_print',
        'population_add', 'population_edit', 'population_delete', 'population_viewown', 'population_viewall',
        'population_print', 'gram_bill_add', 'gram_bill_edit', 'gram_bill_delete', 'gram_bill_viewown',
        'gram_bill_viewall', 'gram_bill_print', 'gram_annual_add', 'gram_annual_edit', 'gram_annual_delete',
        'gram_annual_viewown', 'gram_annual_viewall', 'gram_annual_print', 'dash_pending_taxation_user',
        'dash_pending_water_user', 'paid_annual_m_gram', 'pending_annual_m_gram'
       
    ];
// Set permissions for the allowed actions to 2 (admin level)
    foreach ($modules as $module) {
       
        $permissions["{$module}"] = 2;
        
    }
      
} else {
    // Create an array to hold the modified permissions
    $permissions = [];

    // List of modules and permission suffixes
    $modules = [
        'm_cat_viewown', 'm_cat_viewall', 'm_cat_edit', 'm_cat_delete', 'm_cat_add', 
        'm_taluka_add', 'm_taluka_edit', 'm_taluka_delete', 'm_taluka_viewown', 'm_taluka_viewall',
        'm_gram_add', 'm_gram_edit', 'm_gram_delete', 'm_gram_viewown', 'm_gram_viewall',
        'registered_gram_add', 'registered_gram_edit', 'registered_gram_delete', 'registered_gram_viewown', 
        'registered_gram_viewall', 'registered_gram_print', 'manage_user_add', 'manage_user_edit',
        'manage_user_delete', 'manage_user_viewown', 'manage_user_viewall', 'p_w_bill_add', 'p_w_bill_edit',
        'p_w_bill_delete', 'p_w_bill_viewown', 'p_w_bill_viewall', 'p_w_bill_print', 'about_gram_add', 
        'about_gram_edit', 'about_gram_delete', 'about_gram_viewown', 'about_gram_viewall', 'about_gram_print',
        'population_add', 'population_edit', 'population_delete', 'population_viewown', 'population_viewall',
        'population_print', 'gram_bill_add', 'gram_bill_edit', 'gram_bill_delete', 'gram_bill_viewown',
        'gram_bill_viewall', 'gram_bill_print', 'gram_annual_add', 'gram_annual_edit', 'gram_annual_delete',
        'gram_annual_viewown', 'gram_annual_viewall', 'gram_annual_print', 'dash_pending_taxation_user',
        'dash_pending_water_user', 'paid_annual_m_gram', 'pending_annual_m_gram'
      
    ];
 foreach ($modules as $module) {
        
            $permissions["{$module}"] = 1;
        
    }
     
}

 ?>

 <!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
          <a href="<?php echo e(route('root')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(route('root')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    
    
    
<!-- ========== App Menu ========== -->


    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            
           <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link"  href="<?php echo e(route('root')); ?>" >
                        <i class="bx bxs-dashboard"></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                   
                </li> <!-- end Dashboard Menu -->
                  <?php if((isset($permissions)) && (
                  ($permissions['m_cat_viewown'] == 2) || ($permissions['m_cat_viewall'] == 2) || ($permissions['m_cat_edit'] == 2) || ($permissions['m_cat_delete'] == 2) || ($permissions['m_cat_add'] == 2) || 
                  ($permissions['m_taluka_add'] == 2) || ($permissions['m_taluka_edit'] == 2) || ($permissions['m_taluka_delete'] == 2) || ($permissions['m_taluka_viewown'] == 2) || ($permissions['m_taluka_viewall'] == 2) || 
                  ($permissions['m_gram_add'] == 2) || ($permissions['m_gram_edit'] == 2) || ($permissions['m_gram_delete'] == 2) || ($permissions['m_gram_viewown'] == 2) || ($permissions['m_gram_viewall'] == 2) || 
                  ($permissions['registered_gram_add'] == 2) || ($permissions['registered_gram_edit'] == 2) || ($permissions['registered_gram_delete'] == 2) || ($permissions['registered_gram_viewown'] == 2) || ($permissions['registered_gram_viewall'] == 2) ||($permissions['registered_gram_print'] == 2) ||  
                  ($permissions['manage_user_add'] == 2) || ($permissions['manage_user_edit'] == 2) || ($permissions['manage_user_delete'] == 2) || ($permissions['manage_user_viewown'] == 2) || ($permissions['manage_user_viewall'] == 2)  
                  ) ): ?>
                  <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                         <i class="bx bx-layer"></i> <span> Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                           <?php if((isset($permissions)) && (
                  ($permissions['m_cat_viewown'] == 2) || ($permissions['m_cat_viewall'] == 2) || ($permissions['m_cat_edit'] == 2) || ($permissions['m_cat_delete'] == 2) || ($permissions['m_cat_add'] == 2)  ) ): ?>
                             <li class="nav-item">
                                <a href="<?php echo e(route('categories.index')); ?>" class="nav-link">Manage Category</a>
                            </li>
                            <?php endif; ?>
                             <?php if((isset($permissions)) && (
               ($permissions['m_taluka_add'] == 2) || ($permissions['m_taluka_edit'] == 2) || ($permissions['m_taluka_delete'] == 2) || ($permissions['m_taluka_viewown'] == 2) || ($permissions['m_taluka_viewall'] == 2) 
             ) ): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('talukas.index')); ?>" class="nav-link">Manage Taluka</a>
                            </li>
                            <?php endif; ?>
                             <?php if((isset($permissions)) && (
                  ($permissions['m_gram_add'] == 2) || ($permissions['m_gram_edit'] == 2) || ($permissions['m_gram_delete'] == 2) || ($permissions['m_gram_viewown'] == 2) || ($permissions['m_gram_viewall'] == 2)  
                     ) ): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('grams.index')); ?>" class="nav-link">Manage School</a>
                            </li>
                            <?php endif; ?>
                             <?php if((isset($permissions)) && (
                  ($permissions['registered_gram_add'] == 2) || ($permissions['registered_gram_edit'] == 2) || ($permissions['registered_gram_delete'] == 2) || ($permissions['registered_gram_viewown'] == 2) || ($permissions['registered_gram_viewall'] == 2) ||($permissions['registered_gram_print'] == 2)  
                    ) ): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('register-to-gram.index')); ?>" class="nav-link">Add Register To School</a>
                            </li>
                            <?php endif; ?>
                 
                        </ul>
                    </div>
                </li> 
                  
                <!--<li class="nav-item">-->
                <!--    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">-->
                <!--    <i class="bx bx-layer"></i> <span> Master</span>-->
                <!--    </a>-->
                <!--    <div class="collapse menu-dropdown" id="sidebarApps">-->
                <!--        <ul class="nav nav-sm flex-column">-->
                            
                <!--        </ul>-->
                <!--    </div>-->
                <!--</li>-->
                <?php endif; ?>
           
          <?php if((isset($permissions)) && (
                  ($permissions['manage_user_add'] == 2) || ($permissions['manage_user_edit'] == 2) || ($permissions['manage_user_delete'] == 2) || ($permissions['manage_user_viewown'] == 2) || ($permissions['manage_user_viewall'] == 2)  
                  ) ): ?>
               <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('users.index')); ?>" >
                        <i class="bx bx-doughnut-chart"></i> <span>Manage Users</span>
                    </a>
                    
                </li>
           
                <?php endif; ?>
                
                   <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('lc.index')); ?>" >
                        <i class="bx bx-layer"></i> <span>Add LC</span>
                    </a>
                    
                </li>
              
                
           
              <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('bonafid.index')); ?>" >
                        <i class="bx bx-tone"></i> <span>Add Bonafid</span>
                    </a>
                    
                </li>
              
                
           
                
                 <?php if((isset($permissions)) && (
                ($permissions['gram_bill_add'] == 2) || ($permissions['gram_bill_edit'] == 2) || ($permissions['gram_bill_delete'] == 2) || ($permissions['gram_bill_viewall'] == 2) || ($permissions['gram_bill_viewown'] == 2) ||($permissions['gram_bill_print'] == 2)  
              ) ): ?>

              <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('gram-bills.index')); ?>" >
                        <i class="bx bx-sitemap"></i> <span>School Bills</span>
                    </a>
                    
                </li>
                <?php endif; ?>
                    <?php if((isset($permissions)) && (
                ($permissions['gram_annual_add'] == 2) || ($permissions['gram_annual_edit'] == 2) || ($permissions['gram_annual_delete'] == 2) || ($permissions['gram_annual_viewown'] == 2) || ($permissions['gram_annual_viewall'] == 2) ||($permissions['gram_annual_print'] == 2)   
              ) ): ?>
               <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo e(route('annual-maintenance.index')); ?>">
                        <i class="bx bx-sitemap"></i> <span>School Annual Maintenance</span>
                    </a>
                    
                </li>
                <?php endif; ?>
            </ul> 
           
        </div>
          
    </div>
    <div class="sidebar-background">
        
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay">
    
</div>

<?php /**PATH /home1/actthgku/general-register.actthost.com/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>