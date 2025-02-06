<?php

namespace App\Http\Controllers;
use App\Models\GramBill;
use App\Models\Gram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Http\Request;

class GramBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     
     public function grambillsprint($id){
         
                 $gramBill = GramBill::findOrFail($id);
                    $currentUrl = url()->full(); // Alternative way to fetch full URL

    $exportDate = Carbon::now()->format('d-m-Y H:i:s'); 
                     $pdf = Pdf::loadView('gram-bills.grambills_print', compact('gramBill' , 'currentUrl', 'exportDate'));
                         $pdf->render();
  $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0, 0, 0));

                   return $pdf->stream('gram_bill.pdf'); 


     } 
     
     
     
    public function index()
    {
            if (Auth::user()->is_admin === 'user' ) {
    // Fetch permissions for 'staff' from the database as an array
    $permission = DB::table('roles')
        ->where('id', Auth::user()->user_type)
        ->first();

    // Check if permissions are found
    if ($permission) {
        // Convert the object to an associative array
        $permissions = (array) $permission;
      
        
        if($permissions['id']== 1 && $permissions['gram_bill_viewown'] == 2){
                  $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
            
        }elseif($permissions['id'] == 1 && $permissions['gram_bill_viewall'] == 2){
                        $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
        }
        elseif($permissions['id'] == 2 && $permissions['gram_bill_viewown'] == 2){
                  $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
          
         } elseif($permissions['id'] == 2 && $permissions['gram_bill_viewall'] == 2){
                 $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
        }elseif($permissions['id'] == 3 && $permissions['gram_bill_viewown'] == 2){
                  $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);  $users = User::where('is_admin','user')->where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->with('role')->orderBy('id','desc')->paginate(10);
   
        }elseif($permissions['id'] == 3 && $permissions['gram_bill_viewall'] == 2){
                  $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
       }
        elseif($permissions['id'] == 4  && $permissions['gram_bill_viewown'] == 2){
                $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
        }
          elseif($permissions['id'] == 4  && $permissions['gram_bill_viewall'] == 2){
                $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
            
        }
        elseif($permissions['id'] == 5 && $permissions['gram_bill_viewown'] == 2){
              $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
            
        }
        elseif($permissions['id'] == 5 && $permissions['gram_bill_viewall'] == 2){
                 $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->orderBy('id','desc')->paginate(10);
            
        }
        elseif($permissions['id'] == 6 && $permissions['gram_bill_viewown'] == 2){
                $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->orderBy('id','desc')->paginate(10);
            
        }
         elseif($permissions['id'] == 6 && $permissions['gram_bill_viewall'] == 2){
                  $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->orderBy('id','desc')->paginate(10);
            
        }
         elseif($permissions['id'] == 7  && $permissions['gram_bill_viewown'] == 2){
                 $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->orderBy('id','desc')->paginate(10);
            
        }
         elseif($permissions['id'] == 7  && $permissions['gram_bill_viewall'] == 2){
                  $gramBills = GramBill::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->orderBy('id','desc')->paginate(10);
            
        }
        
         elseif($permissions['id'] == 8 && $permissions['gram_bill_viewown'] == 2){
                     $gramBills = GramBill::Where('state', Auth::user()->state)->orderBy('id','desc')->paginate(10);
   
            
        }
         elseif($permissions['id'] == 8 && $permissions['gram_bill_viewall'] == 2){
                  $gramBills = GramBill::orderBy('id','desc')->paginate(10);
            
        }else{
              $gramBills = collect();
            
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
        
        // Set permissions for the allowed actions to 0 (default)
        foreach ($modules as $module) {
        
                $permissions["{$module}"] = 1;
            
        }
          $gramBills = collect();
        
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
    
   $gramBills = GramBill::orderBy('id','desc')->paginate(10);
     
      
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
  $gramBills = collect();
     
} 
        
        //
      
        return view('gram-bills.index',compact('gramBills','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('gram-bills.create',compact('statesData'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'taluka' => 'required|string|max:255',
            'gram' => 'required|string|max:255',
            'population' => 'required|integer|min:0',
            'first_time_bill_amount' => 'required|numeric|min:0',
            'quatation_date' => 'required|date',
            'bill_date' => 'required|date',
            'reference_number' => 'required|string|max:255',
             'paid_amount' => 'required|numeric|min:0',
            'maintenance_amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:5000',
            'payment_mode' => 'required',
            'next_maintenance_date' => 'required|date',
            'bill_status' => 'required|string|in:pending,complete',
        ]);
        
         $validated['owner_id'] = Auth::user()->id;
         // Generate auto-incrementing invoice number
    $lastInvoice = GramBill::max('invoice_no');
   
    $nextInvoice = str_pad(($lastInvoice ? $lastInvoice + 1 : 1), 5, '0', STR_PAD_LEFT);
   
     
    $validated['invoice_no'] = $nextInvoice;


        GramBill::create($validated);

        return redirect()->route('gram-bills.index')->with('success', 'Gram Bill saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gramBill = GramBill::findOrFail($id);

       if ($gramBill) {
        return response()->json([
            'gramBill' => $gramBill,
        ]);
       }
        
            return response()->json(['message' => 'gram bill not found'], 404);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $gramBill = GramBill::findOrFail($id);
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('gram-bills.edit',compact('statesData','gramBill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
    $validated = $request->validate([
        'state' => 'required',
        'district' => 'required',
        'taluka' => 'required',
        'gram' => 'required',
        'population' => 'required|numeric',
        'first_time_bill_amount' => 'required|numeric',
        'quatation_date' => 'required|date',
        'bill_date' => 'required|date',
        'reference_number' => 'required|string|max:255',
         'paid_amount' => 'required|numeric|min:0',
        'maintenance_amount' => 'required|numeric',
        'description' => 'required|string|max:5000',
        'payment_mode' => 'required',
        'next_maintenance_date' => 'required|date',
        'bill_status' => 'required',
    ]);
} catch (ValidationException $e) {
    // Dump the validation errors and stop execution
    dd($e->errors());
}

        $gramBill = GramBill::findOrFail($id);
        $gramBill->update($request->all());
    
        return redirect()->route('gram-bills.index')->with('success', 'Gram Bill updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
         // Find the Gram record by ID
         $gram = GramBill::find($id);
        
         if ($gram) {
        
     
             // Delete the Gram record
             $gram->delete();
     
             return response()->json(['message' => 'Gram Bill deleted successfully']);
         }
     
         return response()->json(['message' => 'Gram Bill not found'], 404);
    }
}
