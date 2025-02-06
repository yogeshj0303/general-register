<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\RegisterToGram;
use App\Models\Gram;
use App\Models\GharpattiPanipatti;
use App\Models\GramBill;
use App\Models\AnnualMaintenance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
  
    {
        
        if (view()->exists($request->path())) {
            
                $currentDate = Carbon::now()->toDateString();
        
               if (Auth::user()->is_admin === 'user' ) {
    // Fetch permissions for 'staff' from the database as an array
    $permission = DB::table('roles')
        ->where('id', Auth::user()->user_type)
        ->first();

    // Check if permissions are found
    if ($permission) {
        // Convert the object to an associative array
        $permissions = (array) $permission;
        
         if($permissions['id']== 1 && $permissions['p_w_bill_viewown'] == 2){
            $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $getRegisterGram = 0; $categories = Category::all(); $grams = null;
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('id', Auth::id()) // Ensure we are fetching only the logged-in user's data
              ->whereNotIn('id', function ($query) {
                  $query->select('username') // Assuming `username` matches `id` in `users`
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('id', Auth::id()) // Ensure we are fetching only the logged-in user's data
                ->whereNotIn('id', function ($query) {
                    $query->select('username') // Assuming `username` matches `id` in `users`
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();

        }elseif($permissions['id'] == 1 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 2 && $permissions['p_w_bill_viewown'] == 2 || $permissions['id'] == 3 && $permissions['p_w_bill_viewown'] == 2 || $permissions['id'] == 4  && $permissions['p_w_bill_viewown'] == 2 || $permissions['id'] == 5 && $permissions['p_w_bill_viewown'] == 2){
             $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $getRegisterGram = 0; $categories = Category::all(); $grams = null;     $allGramCount = 0;   
             $currentYear = Carbon::now()->year; 
             $latestAnnualMaintenance =0;
             $gramsWithoutMaintenance = null;
             $gramsWithUnpaidMaintenance = null;
             $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0;
            $pendingCount = 0;
           $completedCount = 0;
              $totalAmount = 0; 
           $getRegisterGram = 0;
          
           $grams = null;
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
              ->where('gram', Auth::user()->gram) 
              ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
              ->where('gram', Auth::user()->gram) 
                ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();
            }
        elseif($permissions['id'] == 2 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 3 && $permissions['p_w_bill_viewall'] == 2
        || $permissions['id'] == 4  && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 5 && $permissions['p_w_bill_viewall'] == 2 ||
        $permissions['id'] == 6 && $permissions['p_w_bill_viewown'] == 2){
            
             $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $getRegisterGram = 0; $categories = Category::all(); $grams = null;
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
              
              ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
               
                ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();
               }
       
      elseif($permissions['id'] == 6 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 7  && $permissions['p_w_bill_viewown'] == 2){
               $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $getRegisterGram = 0; $categories = Category::all(); $grams = null;
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              
              
              ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
             
               
                ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();
       
        }
       
         elseif($permissions['id'] == 7  && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 8 && $permissions['p_w_bill_viewown'] == 2){
               $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $getRegisterGram = 0; $categories = Category::all(); $grams = null;
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
             ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
             ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();     
        }
        
       
         elseif($permissions['id'] == 8 && $permissions['p_w_bill_viewall'] == 2){
                  $allGramCount = GramBill::count();
    $pendingCount = GramBill::where('bill_status', 'pending')->count();
    $completedCount = GramBill::where('bill_status', 'completed')->count();
    $totalAmount = GramBill::sum('first_time_bill_amount'); // Assuming 'amount' is the column for total bill amount
  // Current year
    $currentYear = Carbon::now()->year;

$latestAnnualMaintenance = DB::table('annual_maintenances as am1')
    ->select('am1.*')
    ->where('am1.maintenance_year', '=', $currentYear)
    ->whereRaw('am1.id = (SELECT MAX(am2.id) 
                           FROM annual_maintenances as am2 
                           WHERE am2.gram = am1.gram 
                             AND am2.maintenance_year = am1.maintenance_year)');

// Fetch grams with "paid" status
$gramsWithoutMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'am.maintenance_year', 'gb.maintenance_amount', 'am.payment_mode', 'am.remaining_amount')
    ->whereYear('gb.created_at', '=', $currentYear)
    ->where(function ($query) {
        $query->where('am.remaining_amount', '=', 0); // Fully paid
    })
    ->distinct()
    ->get();

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'gb.bill_date as maintenance_year', 'gb.maintenance_amount', 'gb.payment_mode', 'am.remaining_amount', 'gb.next_maintenance_date')
       ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->distinct()
    ->get();
    
   $paidMaintenanceSum = DB::table('gram_bills as gb')
        ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
        ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
            $join->on('am.gram', '=', 'g.gram_name');
        })
        ->whereYear('gb.created_at', '=', $currentYear)
        ->where('am.remaining_amount', '=', 0) // Fully paid
        ->sum('gb.maintenance_amount');

    // Calculate unpaid maintenance sum
 $unpaidMaintenanceSum = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->sum(DB::raw('CASE 
                      WHEN am.remaining_amount IS NULL THEN gb.maintenance_amount 
                      ELSE am.remaining_amount 
                   END'));

 $getRegisterGram = RegisterToGram::count();
           $categories = Category::all();
           $grams = Gram::all(['id', 'gram_name','district','taluka']);
           
           $gharPattiUsers = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'gharpatti');
        })
        ->get();
        
            $paniPattiUsers = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'panipatti');
        })
        ->get();
   
            
        }else{
               $allGramCount = 0;    
               
  // Current year
    $currentYear = Carbon::now()->year;


// Subquery for latest annual maintenance record per gram and year
$latestAnnualMaintenance =0;

// Fetch grams with "paid" status
$gramsWithoutMaintenance = null;

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = null;
 $paidMaintenanceSum = 0;

    // Calculate unpaid maintenance sum
   $unpaidMaintenanceSum = 0;
  
         
               // Assuming your GramBill model is related to the gram name
    $pendingCount = 0;
    $completedCount = 0;
    $totalAmount = 0; // Assuming 'amount' is the column for total bill amount

             
        $getRegisterGram = 0;
         $categories = Category::all();
        $grams = null;
           $gharPattiUsers = null;
        
            $paniPattiUsers = null;
            
        }
        
      
        
       
        
    } else {
        // Create an array to hold the modified permissions
        $permissions = [];

        // List of modules and permission suffixes
        $modules = [
               'id',
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
    
     $allGramCount = GramBill::count();    
               
  // Current year
    $currentYear = Carbon::now()->year;
    $currentDate = Carbon::now()->toDateString();


// Subquery for latest annual maintenance record per gram and year
$latestAnnualMaintenance = DB::table('annual_maintenances as am1')
    ->select('am1.*')
    ->where('am1.maintenance_year', '=', $currentYear)
    ->whereRaw('am1.id = (SELECT MAX(am2.id) 
                           FROM annual_maintenances as am2 
                           WHERE am2.gram = am1.gram 
                             AND am2.maintenance_year = am1.maintenance_year)');

// Fetch grams with "paid" status
$gramsWithoutMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'am.maintenance_year', 'gb.maintenance_amount', 'am.payment_mode', 'am.remaining_amount')
    ->whereYear('gb.created_at', '=', $currentYear)
    ->where(function ($query) {
        $query->where('am.remaining_amount', '=', 0); // Fully paid
    })
    ->distinct()
    ->get();

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
     ->select('g.*', 'gb.invoice_no', 'gb.bill_date as maintenance_year', 'gb.maintenance_amount', 'gb.payment_mode', 'am.remaining_amount', 'gb.next_maintenance_date')
       ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->distinct()
    ->get();
 $paidMaintenanceSum = DB::table('gram_bills as gb')
        ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
        ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
            $join->on('am.gram', '=', 'g.gram_name');
        })
        ->whereYear('gb.created_at', '=', $currentYear)
        ->where('am.remaining_amount', '=', 0) // Fully paid
        ->sum('gb.maintenance_amount');

    // Calculate unpaid maintenance sum
   $unpaidMaintenanceSum = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->sum(DB::raw('CASE 
                      WHEN am.remaining_amount IS NULL THEN gb.maintenance_amount 
                      ELSE am.remaining_amount 
                   END'));
  
         
               // Assuming your GramBill model is related to the gram name
    $pendingCount = GramBill::where('bill_status', 'pending')->count();
    $completedCount = GramBill::where('bill_status', 'completed')->count();
    $totalAmount = GramBill::sum('first_time_bill_amount'); // Assuming 'amount' is the column for total bill amount

             
        $getRegisterGram = RegisterToGram::count();
           $categories = Category::all();
        $grams = Gram::all(['id', 'gram_name','district','taluka']);
           $gharPattiUsers = User::where('is_admin', 'user')
    ->where('id', Auth::id()) // Ensure we are fetching only the logged-in user's data
    ->whereNotIn('id', function ($query) {
        $query->select('username') // Assuming `username` matches `id` in `users`
              ->from('gharpatti_panipattis')
              ->where('type', 'gharpatti');
    })
    ->get();

$paniPattiUsers = User::where('is_admin', 'user')
    ->where('id', Auth::id()) // Ensure we are fetching only the logged-in user's data
    ->whereNotIn('id', function ($query) {
        $query->select('username') // Assuming `username` matches `id` in `users`
              ->from('gharpatti_panipattis')
              ->where('type', 'panipatti');
    })
    ->get();

    // Create an array to hold the modified permissions
    $permissions = [];

    // List of modules and permission suffixes
    $modules = [
           'id',
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
     $allGramCount = 0;    
               
  // Current year
    $currentYear = Carbon::now()->year;


// Subquery for latest annual maintenance record per gram and year
$latestAnnualMaintenance =0;

// Fetch grams with "paid" status
$gramsWithoutMaintenance = null;

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = null;
 $paidMaintenanceSum = 0;

    // Calculate unpaid maintenance sum
   $unpaidMaintenanceSum = 0;
  
         
               // Assuming your GramBill model is related to the gram name
    $pendingCount = 0;
    $completedCount = 0;
    $totalAmount = 0; // Assuming 'amount' is the column for total bill amount

             
        $getRegisterGram = 0;
         $categories = Category::all();
        $grams = null;
           $gharPattiUsers = null;
        
            $paniPattiUsers = null;
    // Create an array to hold the modified permissions
    $permissions = null;

    // List of modules and permission suffixes
    $modules = [
           'id',
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
            return view($request->path(),compact('permissions','paidMaintenanceSum','unpaidMaintenanceSum','getRegisterGram','categories','grams','gharPattiUsers','paniPattiUsers','pendingCount','completedCount','totalAmount','allGramCount','gramsWithoutMaintenance', 'gramsWithUnpaidMaintenance'));
        }
        return abort(404);
    }

    public function root()
    {
        
        
  
         if (Auth::user()->is_admin === 'user' ) {
              
    // Fetch permissions for 'staff' from the database as an array
    $permission = DB::table('roles')
        ->where('id', Auth::user()->user_type)
        ->first();

    // Check if permissions are found
    if ($permission) {
         $currentDate = Carbon::now()->toDateString();
        // Convert the object to an associative array
        $permissions = (array) $permission;
      
        if($permissions['id']== 1 && $permissions['p_w_bill_viewown'] == 2){
    $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $categories = Category::all(); $grams = null;   
            
                $getRegisterGram = RegisterToGram::Where('register_to_grams.state', Auth::user()->state)
            ->where('register_to_grams.district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram) 
            ->count();
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('id', Auth::id()) // Ensure we are fetching only the logged-in user's data
              ->whereNotIn('id', function ($query) {
                  $query->select('username') // Assuming `username` matches `id` in `users`
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('id', Auth::id()) // Ensure we are fetching only the logged-in user's data
                ->whereNotIn('id', function ($query) {
                    $query->select('username') // Assuming `username` matches `id` in `users`
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();

        }elseif(($permissions['id'] == 1 && $permissions['p_w_bill_viewall'] == 2) || ($permissions['id'] == 2 && $permissions['p_w_bill_viewown'] == 2) || ($permissions['id'] == 3 && $permissions['p_w_bill_viewown'] == 2) || ($permissions['id'] == 4  && $permissions['p_w_bill_viewown'] == 2) || ($permissions['id'] == 5 && $permissions['p_w_bill_viewown'] == 2)){
             $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $categories = Category::all(); $grams = null;     
           
             $getRegisterGram = RegisterToGram::Where('register_to_grams.state', Auth::user()->state)
            ->where('register_to_grams.district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram) 
            ->count();
            
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
              ->where('gram', Auth::user()->gram) 
              ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
              ->where('gram', Auth::user()->gram) 
                ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();
            }
        elseif($permissions['id'] == 2 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 3 && $permissions['p_w_bill_viewall'] == 2
        || $permissions['id'] == 4  && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 5 && $permissions['p_w_bill_viewall'] == 2 ||
        $permissions['id'] == 6 && $permissions['p_w_bill_viewown'] == 2){
            
             $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $categories = Category::all(); $grams = null;
            
             $getRegisterGram = RegisterToGram::Where('register_to_grams.state', Auth::user()->state)
            ->where('register_to_grams.district', Auth::user()->district)->where('taluka', Auth::user()->taluka)
            ->count();
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
              
              ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              ->where('taluka', Auth::user()->taluka)
               
                ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();
               }
       
      elseif($permissions['id'] == 6 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 7  && $permissions['p_w_bill_viewown'] == 2){
               $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $categories = Category::all(); $grams = null;
             $getRegisterGram = RegisterToGram::Where('register_to_grams.state', Auth::user()->state)
            ->where('register_to_grams.district', Auth::user()->district)
            ->count();
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
              
              
              ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
              ->where('district', Auth::user()->district)
             
               
                ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();
       
        }
       
         elseif($permissions['id'] == 7  && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 8 && $permissions['p_w_bill_viewown'] == 2){
               $allGramCount = 0; $currentYear = Carbon::now()->year;  $latestAnnualMaintenance =0; $gramsWithoutMaintenance = null; $gramsWithUnpaidMaintenance = null; $paidMaintenanceSum = 0;
            $unpaidMaintenanceSum = 0; $pendingCount = 0; $completedCount = 0; $totalAmount = 0;  $categories = Category::all(); $grams = null;
            
            
 $getRegisterGram = RegisterToGram::Where('register_to_grams.state', Auth::user()->state)
            ->count();
 
           $gharPattiUsers = User::where('is_admin', 'user')
              ->where('state', Auth::user()->state)
             ->whereNotIn('id', function ($query) {
                  $query->select('username') 
                        ->from('gharpatti_panipattis')
                        ->where('type', 'gharpatti');
              })
              ->get();

            $paniPattiUsers = User::where('is_admin', 'user')
                ->where('state', Auth::user()->state)
             ->whereNotIn('id', function ($query) {
                    $query->select('username') 
                          ->from('gharpatti_panipattis')
                          ->where('type', 'panipatti');
                })
                ->get();     
        }
        
       
         elseif($permissions['id'] == 8 && $permissions['p_w_bill_viewall'] == 2){
                  $allGramCount = GramBill::count();
    $pendingCount = GramBill::where('bill_status', 'pending')->count();
    $completedCount = GramBill::where('bill_status', 'completed')->count();
    $totalAmount = GramBill::sum('first_time_bill_amount'); // Assuming 'amount' is the column for total bill amount
  // Current year
    $currentYear = Carbon::now()->year;
 $currentDate = Carbon::now()->toDateString();
$latestAnnualMaintenance = DB::table('annual_maintenances as am1')
    ->select('am1.*')
    ->where('am1.maintenance_year', '=', $currentYear)
    ->whereRaw('am1.id = (SELECT MAX(am2.id) 
                           FROM annual_maintenances as am2 
                           WHERE am2.gram = am1.gram 
                             AND am2.maintenance_year = am1.maintenance_year)');

// Fetch grams with "paid" status
$gramsWithoutMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'am.maintenance_year', 'gb.maintenance_amount', 'am.payment_mode', 'am.remaining_amount')
    ->whereYear('gb.created_at', '=', $currentYear)
    ->where(function ($query) {
        $query->where('am.remaining_amount', '=', 0); // Fully paid
    })
    ->distinct()
    ->get();

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'gb.bill_date as maintenance_year', 'gb.maintenance_amount', 'gb.payment_mode', 'am.remaining_amount', 'gb.next_maintenance_date')
       ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->distinct()
    ->get();
    
   $paidMaintenanceSum = DB::table('gram_bills as gb')
        ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
        ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
            $join->on('am.gram', '=', 'g.gram_name');
        })
        ->whereYear('gb.created_at', '=', $currentYear)
        ->where('am.remaining_amount', '=', 0) // Fully paid
        ->sum('gb.maintenance_amount');

    // Calculate unpaid maintenance sum
 $unpaidMaintenanceSum = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->sum(DB::raw('CASE 
                      WHEN am.remaining_amount IS NULL THEN gb.maintenance_amount 
                      ELSE am.remaining_amount 
                   END'));

 $getRegisterGram = RegisterToGram::count();
           $categories = Category::all();
           $grams = Gram::all(['id', 'gram_name','district','taluka']);
           
           $gharPattiUsers = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'gharpatti');
        })
        ->get();
        
            $paniPattiUsers = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'panipatti');
        })
        ->get();
   
            
        }else{$allGramCount = 0;    
               
  // Current year
    $currentYear = Carbon::now()->year;


// Subquery for latest annual maintenance record per gram and year
$latestAnnualMaintenance =0;

// Fetch grams with "paid" status
$gramsWithoutMaintenance = null;

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = null;
 $paidMaintenanceSum = 0;

    // Calculate unpaid maintenance sum
   $unpaidMaintenanceSum = 0;
  
         
               // Assuming your GramBill model is related to the gram name
    $pendingCount = 0;
    $completedCount = 0;
    $totalAmount = 0; // Assuming 'amount' is the column for total bill amount

        $currentDate = Carbon::now()->toDateString();      
        $getRegisterGram = 0;
          $categories = Category::all();
        $grams = null;
           $gharPattiUsers = null;
        
            $paniPattiUsers = null;
            
        }
        
       
        
    } else {
        // Create an array to hold the modified permissions
        $permissions = [];

        // List of modules and permission suffixes
        $modules = [
            'id',
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
     $currentDate = Carbon::now()->toDateString();
      $allGramCount = GramBill::count();
    $pendingCount = GramBill::where('bill_status', 'pending')->count();
    $completedCount = GramBill::where('bill_status', 'completed')->count();
    $totalAmount = GramBill::sum('first_time_bill_amount'); // Assuming 'amount' is the column for total bill amount
  // Current year
    $currentYear = Carbon::now()->year;

$latestAnnualMaintenance = DB::table('annual_maintenances as am1')
    ->select('am1.*')
    ->where('am1.maintenance_year', '=', $currentYear)
    ->whereRaw('am1.id = (SELECT MAX(am2.id) 
                           FROM annual_maintenances as am2 
                           WHERE am2.gram = am1.gram 
                             AND am2.maintenance_year = am1.maintenance_year)');

// Fetch grams with "paid" status
$gramsWithoutMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'am.maintenance_year', 'gb.maintenance_amount', 'am.payment_mode', 'am.remaining_amount')
    ->whereYear('gb.created_at', '=', $currentYear)
    ->where(function ($query) {
        $query->where('am.remaining_amount', '=', 0); // Fully paid
    })
    ->distinct()
    ->get();

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
    ->select('g.*', 'gb.invoice_no', 'gb.bill_date as maintenance_year', 'gb.maintenance_amount', 'gb.payment_mode', 'am.remaining_amount', 'gb.next_maintenance_date')
       ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->distinct()
    ->get();
    
   $paidMaintenanceSum = DB::table('gram_bills as gb')
        ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
        ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
            $join->on('am.gram', '=', 'g.gram_name');
        })
        ->whereYear('gb.created_at', '=', $currentYear)
        ->where('am.remaining_amount', '=', 0) // Fully paid
        ->sum('gb.maintenance_amount');

    // Calculate unpaid maintenance sum
 $unpaidMaintenanceSum = DB::table('gram_bills as gb')
    ->join('grams as g', 'gb.gram', '=', 'g.gram_name')
    ->leftJoinSub($latestAnnualMaintenance, 'am', function ($join) {
        $join->on('am.gram', '=', 'g.gram_name');
    })
   ->whereDate('gb.next_maintenance_date', '<=', $currentDate) 
    ->where(function ($query) {
        $query->whereNull('am.remaining_amount') // No entry in annual maintenance
              ->orWhere('am.remaining_amount', '!=', 0); // Not fully paid
    })
    ->sum(DB::raw('CASE 
                      WHEN am.remaining_amount IS NULL THEN gb.maintenance_amount 
                      ELSE am.remaining_amount 
                   END'));

 $getRegisterGram = RegisterToGram::count();
           $categories = Category::all();
           $grams = Gram::all(['id', 'gram_name','district','taluka']);
           
           $gharPattiUsers = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'gharpatti');
        })
        ->get();
        
            $paniPattiUsers = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'panipatti');
        })
        ->get();
    $permissions = [];

    // List of modules and permission suffixes
    $modules = [
           'id',
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
        $allGramCount = 0;    
               
  // Current year
    $currentYear = Carbon::now()->year;
 $currentDate = Carbon::now()->toDateString();

// Subquery for latest annual maintenance record per gram and year
$latestAnnualMaintenance =0;

// Fetch grams with "paid" status
$gramsWithoutMaintenance = null;

// Fetch grams with "unpaid" status
$gramsWithUnpaidMaintenance = null;
 $paidMaintenanceSum = 0;

    // Calculate unpaid maintenance sum
   $unpaidMaintenanceSum = 0;
  
         
               // Assuming your GramBill model is related to the gram name
    $pendingCount = 0;
    $completedCount = 0;
    $totalAmount = 0; // Assuming 'amount' is the column for total bill amount

             
        $getRegisterGram = 0;
     $categories = Category::all();
        $grams = null;
           $gharPattiUsers = null;
        
            $paniPattiUsers = null;
    // Create an array to hold the modified permissions
    $permissions = null;

    // List of modules and permission suffixes
    $modules = [
           'id',
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
        
        return view('index',compact('permissions','paidMaintenanceSum','unpaidMaintenanceSum','getRegisterGram','categories','grams','gharPattiUsers','paniPattiUsers','pendingCount','completedCount','totalAmount','allGramCount','gramsWithoutMaintenance', 'gramsWithUnpaidMaintenance'));
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();

        }
    }

    public function updatePassword(Request $request, $id)
    {
        
       try {
    $validate = $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);
} catch (ValidationException $e) {
    dd($e->errors());
} catch (\Exception $e) {
    dd($e->getMessage()); 
}


    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }
    else{

    $user->password = Hash::make($request->password);
    }
    
    $user->save();
    return back()->with('success', 'Password changed successfully!');
}

public function getCategoryCount(Request $request)
{
    $categoryId = $request->category_id;

    $count =\DB::table('register_to_grams')
    ->join('files', 'files.register_to_gram_id', '=', 'register_to_grams.id')
    ->where('register_to_grams.category', $categoryId)
    ->count('files.id');

    return response()->json(['count' => $count]);
}

// In GramBillController.php
public function getGramDetails(Request $request)
{
    $gramName = $request->input('gram_name');

    // Assuming your GramBill model is related to the gram name
    $pendingCount = GramBill::where('gram', $gramName)->where('bill_status', 'pending')->count();
    $completedCount = GramBill::where('gram', $gramName)->where('bill_status', 'completed')->count();
    $totalAmount = GramBill::where('gram', $gramName)->sum('first_time_bill_amount'); // Assuming 'amount' is the column for total bill amount

    return response()->json([
        'pendingCount' => $pendingCount,
        'completedCount' => $completedCount,
        'totalAmount' => $totalAmount,
    ]);
}

// app/Http/Controllers/GharPattiPanipattiController.php

public function getCounts()
{
    $currentYear = now()->year;

    // Count users who are not registered as 'gharpatti' in GharPattiPanipatti table
    $gharPattiNotRegisteredCount = User::where('is_admin', 'user')->whereNotIn('id', function($query) {
        $query->select('username')
              ->from('gharpatti_panipattis')
              ->where('type', 'gharpatti');
    })
    ->count();

    // Count users who are not registered as 'panipatti' in GharPattiPanipatti table
    $panipattiNotRegisteredCount = User::where('is_admin', 'user')->whereNotIn('id', function($query) {
        $query->select('username')
              ->from('gharpatti_panipattis')
              ->where('type', 'panipatti');
    })
    ->count();

    return response()->json([
        'gharPattiNotRegisteredCount' => $gharPattiNotRegisteredCount,
        'panipattiNotRegisteredCount' => $panipattiNotRegisteredCount
    ]);
}



public function getGramBillsCount(Request $request)
{
    $query = GramBill::query(); // Initialize the query

    // Filter by gram name if provided
    if ($request->has('billType') && $request->billType) {
        $query->where('gram', $request->billType);
    }

    // Filter by 'fromDate' if provided
    if ($request->has('fromDate') && $request->fromDate) {
        $query->whereDate('created_at', '>=', $request->fromDate);
    }

    // Filter by 'toDate' if provided
    if ($request->has('toDate') && $request->toDate) {
        $query->whereDate('created_at', '<=', $request->toDate);
    }

    // Get the total count of matching records
    $totalGramBillCount = $query->count();

    // Return the response with the count
    return response()->json([
        'totalGramBillCount' => $totalGramBillCount
    ]);
}

public function getGramCounts(Request $request)
{
    $currentYear = Carbon::now()->year;
    $gramName = $request->gram;

    // Check if the gram exists in maintenance
    $gramsWithoutMaintenance = Gram::where('gram_name', $gramName)
        ->whereNotIn('gram_name', function ($query) use ($currentYear) {
            $query->select('gram')
                  ->from('annual_maintenances')
                  ->where('bill_status', 'complete')
                  ->whereYear('maintenance_year', $currentYear);
        })->count();

    $gramsWithUnpaidMaintenance = Gram::where('gram_name', $gramName)
        ->whereIn('gram_name', function ($query) use ($currentYear) {
            $query->select('gram')
                  ->from('annual_maintenances')
                  
                  ->whereYear('maintenance_year', $currentYear);
        })->count();

    return response()->json([
        'gramsWithoutMaintenance' => $gramsWithoutMaintenance,
        'gramsWithUnpaidMaintenance' => $gramsWithUnpaidMaintenance,
    ]);
}


}