<?php

namespace App\Http\Controllers;
use App\Models\AboutGram;
use App\Models\User;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class AboutGramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    
    
     
     
     public function aboutgramprint(Request $request ,$id)
{
    $user = AboutGram::findOrFail($id);
            $data = User::where('id', $user->username)->first();
 $currentUrl = $request->fullUrl();

    $exportDate = Carbon::now()->format('d-m-Y H:i:s');
    $pdf = Pdf::loadView('about-gram.about_gramprint', compact('user', 'data', 'exportDate' , 'currentUrl'));
    $pdf->setPaper('A4', 'portrait');
    // Ensure the font subsetting and rendering options are enabled
$pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
$pdf->getDomPDF()->set_option('isFontSubsettingEnabled', true);
    $pdf->render();
    $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
    return $pdf->stream('about-gram-print.pdf');
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
      
       if($permissions['id']== 1 && $permissions['about_gram_viewown'] == 2){
                 $aboutGrams = AboutGram::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
       
         

        }elseif(($permissions['id'] == 1 && $permissions['about_gram_viewall'] == 2) || 
        ($permissions['id'] == 2 && $permissions['about_gram_viewown'] == 2) || ($permissions['id'] == 3 && $permissions['about_gram_viewown'] == 2) 
        || ($permissions['id'] == 4  && $permissions['about_gram_viewown'] == 2) || ($permissions['id'] == 5 && $permissions['about_gram_viewown'] == 2)){
             $aboutGrams = AboutGram::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->orderBy('id','desc')->paginate(10);
       
        
            }
        elseif($permissions['id'] == 2 && $permissions['about_gram_viewall'] == 2 || $permissions['id'] == 3 && $permissions['about_gram_viewall'] == 2
        || $permissions['id'] == 4  && $permissions['about_gram_viewall'] == 2 || $permissions['id'] == 5 && $permissions['about_gram_viewall'] == 2 ||
        $permissions['id'] == 6 && $permissions['about_gram_viewown'] == 2){
           
    
      $aboutGrams = AboutGram::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->orderBy('id','desc')->paginate(10);
       
         
               }
        elseif($permissions['id'] == 6 && $permissions['about_gram_viewall'] == 2 || $permissions['id'] == 7  && $permissions['about_gram_viewown'] == 2){
        $aboutGrams = AboutGram::Where('state', Auth::user()->state)->where('district', Auth::user()->district)->orderBy('id','desc')->paginate(10);
       
     
       
        }
        elseif($permissions['id'] == 7  && $permissions['about_gram_viewall'] == 2 || $permissions['id'] == 8 && $permissions['about_gram_viewown'] == 2){
       $aboutGrams = AboutGram::Where('state', Auth::user()->state)->orderBy('id','desc')->paginate(10);
       
       
                  
        } elseif($permissions['id'] == 8 && $permissions['about_gram_viewall'] == 2){
          $aboutGrams = AboutGram::orderBy('id','desc')->paginate(10);
                 
      
        }
      
      else{
               $aboutGrams = collect();
            
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
        $aboutGrams = collect();
        
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
    
   $aboutGrams = AboutGram::orderBy('id','desc')->paginate(10);
     
      
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
      $aboutGrams = collect();
     
} 
        
     
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('about-gram/about_gram',compact('statesData','aboutGrams','permissions'));
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
        
      
        // Validate the form data
        $validated = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'about_gram' => 'required',
            'pdf' => 'nullable|mimes:pdf', 

        ]);
    
    $folderPath = 'about-gram/' . $request->state . '/' . $request->district . '/' . $request->taluka . '/' . $request->gram;
$directoryPath = public_path('assets/' . $folderPath);

if (!file_exists($directoryPath)) {
    mkdir($directoryPath, 0755, true);
}

$filePath = null;

if ($request->hasFile('pdf')) {
    $file = $request->file('pdf');
    $fileName = $file->getClientOriginalName();
    $file->move($directoryPath, $fileName);
    $filePath = 'assets/' . $folderPath . '/' . $fileName;
}


    
        // Create a new RegisterToGram record
        $registerToGram = AboutGram::create([
            'state' => $request->state,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'gram' => $request->gram,
            'about_gram' => $request->about_gram,
            'path' => $filePath, 
            'owner_id'=>Auth::user()->id,// Store the file path if a file is uploaded
        ]);
    
        // Redirect back with success message
        return redirect()->route('about-gram.index')->with('success', 'About gram saved successfully!');
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $AboutGram = AboutGram::findOrFail($id);

       if ($AboutGram) {
        return response()->json([
            'AboutGram' => $AboutGram,
        ]);
    }

    return response()->json(['message' => 'AboutGram not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $registerToGrams = AboutGram::findOrFail($id);
        $getCategory = Category::all();
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return response()->json([
            'gram' => $registerToGrams,
            'statesData' => $statesData,
            'categories' => $getCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'about_gram' => 'required',
        'pdf.*' => 'nullable|mimes:pdf', // Validate PDF files
    ]);

    // Find the existing record to update
    $registerToGram = AboutGram::findOrFail($id);

    // Create folder path based on state, district, taluka, and gram
    // $folderPath = 'about-gram/' . $request->state . '/' . $request->district . '/' . $request->taluka . '/' . $request->gram;

    // // Check if the folder exists, create it if it doesn't
    // if (!Storage::disk('public')->exists($folderPath)) {
    //     Storage::disk('public')->makeDirectory($folderPath);
    // }

    // // Initialize filePath to null (in case no file is uploaded)
    // $filePath = $registerToGram->path; // Keep the old file path if no new file is uploaded

    // // Check if a new PDF file is uploaded
    // if ($request->hasFile('pdf')) {
    //     $file = $request->file('pdf');
        
    //     // If it's an array of files (multiple uploads)
    //     if (is_array($file)) {
    //         foreach ($file as $f) {
    //             // Store each file and return the file path (this will need handling for multiple files if required)
    //             $filePath = $f->store($folderPath, 'public');
    //         }
    //     } else {
    //         // Handle the single file upload
    //         // Delete the old file if exists
    //         if ($filePath && Storage::disk('public')->exists($filePath)) {
    //             Storage::disk('public')->delete($filePath);
    //         }
    //         // Store the new file and update the file path
    //         $filePath = $file->store($folderPath, 'public');
    //     }
    // }

$folderPath = 'about-gram/' . $request->state . '/' . $request->district . '/' . $request->taluka . '/' . $request->gram;
$directoryPath = public_path('assets/' . $folderPath);

if (!file_exists($directoryPath)) {
    mkdir($directoryPath, 0755, true);
}

$filePath = $registerToGram->path;

if ($request->hasFile('pdf')) {
    $files = $request->file('pdf');
    
    if (is_array($files)) {
        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $file->move($directoryPath, $fileName);
            $filePath = 'assets/' . $folderPath . '/' . $fileName;
        }
    } else {
        $fileName = $files->getClientOriginalName();
        $files->move($directoryPath, $fileName);
        $filePath = 'assets/' . $folderPath . '/' . $fileName;
    }
}









    // Update the existing record with new data
    $registerToGram->update([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'about_gram' => $request->about_gram,
        'path' => $filePath,
        'owner_id'=> $registerToGram->owner_id,
    ]);

    return response()->json(['success' => 'Updated successfully']);
}








    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Gram record by ID
        $gram = AboutGram::find($id);
        
        if ($gram) {
         
                // Delete the file from the storage disk
                Storage::disk('public')->delete($gram->path);
           
            // Delete the Gram record
            $gram->delete();
    
            return response()->json(['message' => 'Gram and associated files deleted successfully']);
        }
    
        return response()->json(['message' => 'Gram not found'], 404);
    }
    
}
