<?php

namespace App\Http\Controllers;
use App\Models\Population;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     
     
     
   public function populationprint(Request $request, $id)
{
    $Population = Population::findOrFail($id);
    $currentUrl = $request->fullUrl();
    $exportDate = Carbon::now()->format('d-m-Y H:i:s');
    
    $pdf = Pdf::loadView('population.population_print', compact('Population', 'exportDate', 'currentUrl'));
    $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0, 0, 0));
    
    return $pdf->stream('population-print.pdf');
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
      
       if($permissions['id']== 1 && $permissions['population_viewown'] == 2){
                  $populations = Population::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
       
         

        }elseif(($permissions['id'] == 1 && $permissions['population_viewall'] == 2) || 
        ($permissions['id'] == 2 && $permissions['population_viewown'] == 2) || ($permissions['id'] == 3 && $permissions['population_viewown'] == 2) 
        || ($permissions['id'] == 4  && $permissions['population_viewown'] == 2) || ($permissions['id'] == 5 && $permissions['population_viewown'] == 2)){
              $populations = Population::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
       
        
            }
        elseif($permissions['id'] == 2 && $permissions['population_viewall'] == 2 || $permissions['id'] == 3 && $permissions['population_viewall'] == 2
        || $permissions['id'] == 4  && $permissions['population_viewall'] == 2 || $permissions['id'] == 5 && $permissions['population_viewall'] == 2 ||
        $permissions['id'] == 6 && $permissions['population_viewown'] == 2){
           
    
       $populations = Population::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->orderBy('id','desc')->paginate(10);
       
         
               }
        elseif($permissions['id'] == 6 && $permissions['population_viewall'] == 2 || $permissions['id'] == 7  && $permissions['population_viewown'] == 2){
         $populations = Population::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->orderBy('id','desc')->paginate(10);
       
     
       
        }
        elseif($permissions['id'] == 7  && $permissions['population_viewall'] == 2 || $permissions['id'] == 8 && $permissions['population_viewown'] == 2){
         $populations = Population::Where('state', Auth::user()->state)->orderBy('id','desc')->paginate(10);
       
                  
        } elseif($permissions['id'] == 8 && $permissions['population_viewall'] == 2){
           $populations = Population::orderBy('id','desc')->paginate(10);       
      
        }
      
      else{
            $populations = collect();
            
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
          $populations =  collect();
        
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
      $populations = Population::orderBy('id','desc')->paginate(10);
  
     
      
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
      $populations = collect();
      
     
} 
        $users = User::where('is_admin','user')->get(); 
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
      
        return view('population.index', compact('populations','statesData','users','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'population' => 'required|integer|min:0',
            'year' => 'required|integer|digits:4',
            'confirm_by' => 'required|string', // Make confirmed_by required
        ]);
    
        Population::create($validated);
    
        return redirect()->route('population.index')->with('success', 'Population data saved successfully.');
    }
    

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $Population = Population::findOrFail($id);
    $confimed_name = DB::table('users')->where('id', $Population->confirm_by)->first();
    $role_name = DB::table('roles')->where('id', $confimed_name->user_type)->first();

    if ($Population && $confimed_name && $role_name) {
        return response()->json([
            'Population' => $Population,
            'ConfirmedBy' => $confimed_name->name,
            'RoleName' => $role_name->role_name,
        ]);
    }

    return response()->json(['message' => 'Population not found or invalid data'], 404);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
                $Population = Population::findOrFail($id);

        return response()->json([
            'Population' => $Population,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $validated = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'population' => 'required|integer|min:0',
        'year' => 'required|integer|digits:4',
        'confirm_by' => 'required|string',
    ]);

    $population = Population::findOrFail($id); // Find the specific record
    $population->update($validated); // Update the record

    return response()->json([
        'id' => $population->id,
        'state' => $population->state,
        'district' => $population->district,
        'taluka' => $population->taluka,
        'gram' => $population->gram,
        'population' => $population->population,
        'year' => $population->year,
        'confirm_by' => $population->confirm_by,
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Gram record by ID
        $gram = Population::find($id);
  
        if ($gram) {
            $gram->delete();
            return response()->json(['message' => 'Population deleted successfully']);
        }
    
        return response()->json(['message' => 'Gram not found'], 404);
    }
}
