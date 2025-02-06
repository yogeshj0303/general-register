<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Gram;
use App\Models\GramBill;
use App\Models\Taluka;
use App\Models\SchoolDetails;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\AnnualMaintenance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;


class MasterController extends Controller
{
    
 public function gramprint(Request $request , $id)
{
    // Fetch the Gram by ID
    $gram = Gram::find($id);

    if (!$gram) {
        return redirect()->back()->with('error', 'Gram not found');
    }
     $currentUrl = $request->fullUrl();
    $exportDate = Carbon::now()->format('d-m-Y H:i:s'); 
    

    // Fetch category-wise counts from the `register_to_gram` table
   $categoryCounts = DB::table('register_to_grams')
    ->join('files', 'files.register_to_gram_id', '=', 'register_to_grams.id') // Join the files table
    ->where('register_to_grams.gram', $gram->gram_name) // Filter by gram_name
    ->selectRaw('register_to_grams.category, COUNT(files.id) as count') // Select category and count
    ->groupBy('register_to_grams.category') // Group by category
    ->get();

           $pdf = Pdf::loadView('master.gramprint', compact('gram', 'categoryCounts', 'exportDate', 'currentUrl'));

 

    // Render PDF
    $pdf->render();
      $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0, 0, 0));


    // Add footer with page number
    
  
    // Stream PDF to browser
    return $pdf->stream('gram-print.pdf');
    
       
       
       
        }



    public function getTehsils(Request $request)
    {
        $state = $request->input('state');
        $district = $request->input('district');
    
        // Validate input
        if (!$state || !$district) {
            return response()->json([], 400); // Return empty array if validation fails
        }
    
        $tehsils = Taluka::where('state', $state)
                         ->where('district', $district)
                         ->pluck('taluka_name');
    
        return response()->json($tehsils);
    }
    public function getGrams(Request $request)
    {

        $state = $request->input('state');
        $district = $request->input('district');
        $taluka = $request->input('taluka');
        // Validate input
        if (!$state || !$district || !$taluka) {
            return response()->json([], 400); // Return empty array if validation fails
        }
    
        $grams = Gram::where('state', $state)
                         ->where('district', $district)
                         ->where('taluka', $taluka)
                         ->pluck('gram_name' , 'id');

                         
                         
                        
    
        return response()->json($grams);
    }
    
    
    
     public function gramshow($id)
{
    $gram = Gram::find($id);
     $schoolDetails = json_decode($gram->school_details_id);
$schoolLogoPath = asset('/' . $gram->school_logo);

    $schoolDetailsData = [];
    foreach ($schoolDetails as $schoolDetailId) {
        $schoolDetail = SchoolDetails::find($schoolDetailId);
        if ($schoolDetail) {
            $schoolDetailsData[] = $schoolDetail; 
        }
    }

    return response()->json([
        'gram' => $gram,
        'schoolDetails' => $schoolDetailsData,
                    'schoolLogoPath' => $schoolLogoPath,

    ]);


}

    
    
    
    
    public function getByGram(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
    ]);

    // Fetch users based on the provided gram
    $users = User::where('state', $request->state)
        ->where('district', $request->district)
        ->where('taluka', $request->taluka)
        ->where('gram', $request->gram)
        ->get(['id', 'name', 'gharpatti_annual', 'panipatti_annual', 'created_at']);

    $results = $users->map(function ($user) {
        // Fetch gharpatti_panipattis entries for this user
        $entries = DB::table('gharpatti_panipattis')
            ->where('username', $user->id) // Assuming username refers to user ID
            ->get(['type', 'paid_amount', 'created_at']);

        $gharpattiEntries = $entries->where('type', 'gharpatti');
        $panipattiEntries = $entries->where('type', 'panipatti');

        $currentYear = now()->year;
        $createdYear = Carbon::parse($user->created_at)->year;
        $totalYears = $currentYear - $createdYear + 1; // Include the start year

        $totalGharpattiDue = $totalYears * $user->gharpatti_annual;
        $totalGharpattiPaid = $gharpattiEntries->sum('paid_amount');
        $gharpattiPending = $totalGharpattiDue - $totalGharpattiPaid;

        $totalPanipattiDue = $totalYears * $user->panipatti_annual;
        $totalPanipattiPaid = $panipattiEntries->sum('paid_amount');
        $panipattiPending = $totalPanipattiDue - $totalPanipattiPaid;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'gharpatti' => [
                'annual' => $user->gharpatti_annual,
                'total_due' => $totalGharpattiDue,
                'total_paid' => $totalGharpattiPaid,
                'pending' => $gharpattiPending,
            ],
            'panipatti' => [
                'annual' => $user->panipatti_annual,
                'total_due' => $totalPanipattiDue,
                'total_paid' => $totalPanipattiPaid,
                'pending' => $panipattiPending,
            ],
        ];
    });


    // Return the processed data as a JSON response
    return response()->json($results);
}


    // public function getByGram(Request $request)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'state' => 'required|string',
    //         'district' => 'required|string',
    //         'taluka' => 'required|string',
    //         'gram' => 'required|string',
    //     ]);

    //     // Fetch users based on the provided gram
    //     $users = User::where('state', $request->state)
    //         ->where('district', $request->district)
    //         ->where('taluka', $request->taluka)
    //         ->where('gram', $request->gram)
    //         ->get(['id', 'name','gharpatti_annual','panipatti_annual']); // Only get ID and username
            
            
            

    //     // Return the users as a JSON response
    //     return response()->json($users);
    // }

    //
    public function index(){
     $categories = Category::orderBy('id', 'desc')->paginate(10);
    return view('master.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category); // Return the category data as JSON
    }
    
    public function show($id)
{
    $category = Category::find($id);

    if ($category) {
        return response()->json($category);
    }

    return response()->json(['message' => 'Category not found'], 404);
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
    
        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
        ]);
    
        return response()->json([
            'message' => 'Category updated successfully.',
            'category' => $category,
        ]);
    }
    

    public function destroy($id)
    {
        $category = Category::find($id);
    
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        }
    
        return response()->json(['message' => 'Category not found'], 404);
    }
    
// Display the Gram page
public function gramIndex()
{
    $grams = Gram::orderBy('id' , 'desc')->paginate(10);
    $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
    return view('master.gram', compact('grams','statesData'));
}

// Store a new Gram
public function gramStore(Request $request)
{
  
        $request->validate([
            'gram_name' => 'required|string|max:255|unique:grams,gram_name',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'taluka' => 'required|string|max:255',
            'village' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'pin_code' => 'required|numeric|digits:6',
            'school_contact_no' => 'required',
            'school_gmail' => 'required|email|max:255',
            'school_gram_no' => 'required',
            'school_management' => 'required|string|max:255',
            'school_level' => 'required|string|max:255',
            'school_udash_no' => 'required',
            'school_board' => 'required|string|max:255',
 'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
 'class_name.*' => 'required|string|max:255',
    'class_teacher_name.*' => 'required|string|max:255',
    'whatsapp_no.*' => 'required|digits_between:10,12',
            'principal_name' => 'required|string|max:255',
            'principal_type' => 'required|string|max:255',
            'principle_whatsapp_no' => 'required|string|max:10',
            'clerk_name' => 'required|string|max:255',
            'clerk_whatspp_no' => 'required|string|max:10',
        ]);
        
      
    $schoolDetailsIds = [];
    if ($request->has('class_name')) {
        foreach ($request->class_name as $key => $class_name) {
            $schoolDetail = SchoolDetails::create([
                'class_name' => $class_name,
                'class_teacher_name' => $request->class_teacher_name[$key],
                'whatsapp_no' => $request->whatsapp_no[$key],
            ]);

            // Store the school detail id
            $schoolDetailsIds[] = $schoolDetail->id;
        }
    }
    
    
    $state = str_replace(' ', '-', $request->state);
    $district = str_replace(' ', '-', $request->district);
    $taluka = str_replace(' ', '-', $request->taluka);
    $gram_name = str_replace(' ', '-', $request->gram_name);
    $folderPath = 'school-logo/' . $state . '/' . $district . '/' . $taluka . '/' . $gram_name;

    // Initialize image path variable
    $imagePath = null;

    // Check if there's a file uploaded
    if ($request->hasFile('school_logo')) {
        $image = $request->file('school_logo');
        
        $fileName = time() . '_' . $image->getClientOriginalName();
         $image->move(public_path('assets/' . $folderPath), $fileName);
    
    $imagePath = 'assets/' . $folderPath . '/' . $fileName;
        
    }
        $gramData = $request->all();

 if ($imagePath) {
        $gramData['school_logo'] = $imagePath;  // Store the image path in the database
    }
    
    
    

    $gramData['school_details_id'] = json_encode($schoolDetailsIds); // Attach school details IDs

    $gram = Gram::create($gramData);


    // Redirect with a success message
    return redirect()->route('grams.index')->with('success', 'Gram added successfully.');
}

public function gramEdit($id)
{
    $gram = Gram::findOrFail($id);
    
    $schoolDetails = json_decode($gram->school_details_id);
$schoolLogoPath = asset('/' . $gram->school_logo);
    $schoolDetailsData = [];
    foreach ($schoolDetails as $schoolDetailId) {
        $schoolDetail = SchoolDetails::find($schoolDetailId);
        if ($schoolDetail) {
            $schoolDetailsData[] = $schoolDetail; 
        }
    }
    return response()->json([
        'gram' => $gram,
        'schoolDetails' => $schoolDetailsData,
            'schoolLogoPath' => $schoolLogoPath,

    ]);
}
public function gramUpdate(Request $request, $id)
{
    $request->validate([
        'gram_name' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'required|string|max:255',
        'village' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'pin_code' => 'nullable|numeric|digits:6',
        'school_contact_no' => 'required|string|digits_between:10,12',
        'school_gmail' => 'nullable|email|max:255',
        'school_gram_no' => 'nullable',
        'school_management' => 'nullable|string|max:255',
        'school_level' => 'nullable|string|max:255',
        'school_udash_no' => 'nullable',
        'school_board' => 'nullable|string|max:255',
        'class_name' => 'required|array',
        'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        'class_teacher_name' => 'required|array',
        'whatsapp_no' => 'required|array',
        'whatsapp_no.*' => 'digits_between:10,12',
        'principal_name' => 'required|string|max:255',
        'principal_type' => 'required|string|max:255',
        'principle_whatsapp_no' => 'required|digits_between:10,12',
        'clerk_name' => 'required|string|max:255',
        'clerk_whatspp_no' => 'required|string|digits_between:10,12',
    ]);

    try {
        // Find the Gram record
        $gram = Gram::findOrFail($id);

        // Prepare the school details IDs array
        $schoolDetailsIds = [];

        if ($request->has('class_name')) {
            foreach ($request->class_name as $key => $class_name) {
                $schoolDetail = SchoolDetails::updateOrCreate(
                    ['id' => $request->school_details_id[$key] ?? null], // Use the provided ID for update or create a new one
                    [
                        'class_name' => $class_name,
                        'class_teacher_name' => $request->class_teacher_name[$key],
                        'whatsapp_no' => $request->whatsapp_no[$key],
                    ]
                );
                $schoolDetailsIds[] = $schoolDetail->id; // Store the ID
            }
        }

        // Prepare the Gram data
        $gramData = $request->except('school_details_id', 'school_logo'); // Remove school_logo initially
        
        $state = str_replace(' ', '-', $request->state);
        $district = str_replace(' ', '-', $request->district);
        $taluka = str_replace(' ', '-', $request->taluka);
        $gram_name = str_replace(' ', '-', $request->gram_name);
        $folderPath = 'school-logo/' . $state . '/' . $district . '/' . $taluka . '/' . $gram_name;

        // If new file is uploaded, update school_logo
        if ($request->hasFile('school_logo')) {
            // Delete old file if exists
            if (!empty($gram->school_logo) && file_exists(public_path($gram->school_logo))) {
                unlink(public_path($gram->school_logo));
            }

            $image = $request->file('school_logo');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/' . $folderPath), $fileName);

            $gramData['school_logo'] = 'assets/' . $folderPath . '/' . $fileName;
        } else {
            // Retain the old file if no new file is uploaded
            $gramData['school_logo'] = $gram->school_logo;
        }

        $gramData['school_details_id'] = json_encode($schoolDetailsIds); // Store the school details IDs

        // Update the Gram record
        $gram->update($gramData);

        // Return a success response
        return response()->json([
            'message' => 'Gram updated successfully.',
            'gram' => $gram,
        ]);
    } catch (\Exception $e) {
        // Return error response in case of failure
        return response()->json([
            'message' => 'Error updating Gram.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


// Delete a Gram
public function gramDestroy($id)
{
    $gram = Gram::find($id);

    if ($gram) {
        $gram->delete();
        return response()->json(['message' => 'Gram deleted successfully']);
    }

    return response()->json(['message' => 'Gram not found'], 404);
}

    // taluka methods
    public function talukaIndex(){
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);

        $talukas = Taluka::orderBy('id', 'desc')->paginate(10);
        return view('master.taluka', compact('talukas','statesData'));
        }
    
        public function talukaStore(Request $request)
        {
            $request->validate([
                'taluka_name' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'district' => 'required|string|max:255',
            ]);
        
            Taluka::create([
                'taluka_name' => $request->taluka_name,
                'state' => $request->state,
                'district' => $request->district,
            ]);
        
            return redirect()->route('talukas.index')->with('success', 'Taluka added successfully.');
        }
        
   public function talukaEdit($id)
{
    // Find the Taluka
    $taluka = Taluka::findOrFail($id);
  
    return response()->json([
        'id' => $taluka->id,
        'taluka_name' => $taluka->taluka_name,
        'state' => $taluka->state,
        'district' => $taluka->district,
    ]);
}

public function talukaUpdate(Request $request, $id)
{
    $request->validate([
        'taluka_name' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
    ]);

    $taluka = Taluka::findOrFail($id);
    $taluka->update([
        'taluka_name' => $request->taluka_name,
        'state' => $request->state,
        'district' => $request->district,
    ]);

    return response()->json([
        'id' => $taluka->id,
        'taluka_name' => $taluka->taluka_name,
        'state' => $taluka->state,
        'district' => $taluka->district,
    ]);
}



 public function talukashow($id)
{
    $Taluka = Taluka::find($id);

    if ($Taluka) {
        return response()->json($Taluka);
    }

    return response()->json(['message' => 'Taluka not found'], 404);
}

 
        public function talukaDestroy($id)
        {
            $taluka = Taluka::find($id);
        
            if ($taluka) {
                $taluka->delete();
                return response()->json(['message' => 'Taluka deleted successfully']);
            }
        
            return response()->json(['message' => 'Taluka not found'], 404);
        }
        
//       public function getMaintenanceAmount(Request $request)
// {
//     $gram = $request->input('gram');
//     $year = $request->input('year');

//     // If year is selected, fetch amount for gram and year
//     if ($year) {
//         $maintenanceAmount = GramBill::where('gram', $gram)
//             ->whereYear('quatation_date', $year)
//             ->value('maintenance_amount');

//         if ($maintenanceAmount) {
//             return response()->json([
//                 'success' => true,
//                 'maintenance_amount' => $maintenanceAmount,
//             ]);
//         }

//         return response()->json(['success' => false, 'message' => 'Maintenance amount not found for the selected year.']);
//     }

//     // Fetch years if no year is provided
//     $maintenanceYears = GramBill::where('gram', $gram)
//         ->pluck('quatation_date')
//         ->map(function ($date) {
//             return \Carbon\Carbon::parse($date)->year;
//         })
//         ->unique()
//         ->values();

//     if ($maintenanceYears->isNotEmpty()) {
//         return response()->json([
//             'success' => true,
//             'maintenance_years' => $maintenanceYears,
//         ]);
//     }

//     return response()->json(['success' => false, 'message' => 'No data found for the selected gram.']);
// }

      
// public function getMaintenanceAmount(Request $request)
// {
//     $gram = $request->input('gram');
//     $year = $request->input('year');

//     if ($year) {
//         // Check for the latest entry in the annual_maintenances table
//         $latestEntry = AnnualMaintenance::where('gram', $gram)
//             ->where('maintenance_year', $year)
//             ->orderBy('created_at', 'desc') // Get the most recent entry
//             ->first();

//         if ($latestEntry) {
//             // Logic based on the remaining amount in the latest entry
//             if ($latestEntry->remaining_amount == 0) {
//                 return response()->json([
//                     'success' => true,
//                     'maintenance_amount' => 0,
//                 ]);
//             }

//             if ($latestEntry->remaining_amount > 0) {
//                 return response()->json([
//                     'success' => true,
//                     'maintenance_amount' => $latestEntry->remaining_amount,
//                 ]);
//             }
//         }

//         // If no matching entry in annual_maintenances, fallback to gram_bills
//         $maintenanceAmount = GramBill::where('gram', $gram)
//             ->whereYear('quatation_date', $year)
//             ->value('maintenance_amount');

//         if ($maintenanceAmount) {
//             return response()->json([
//                 'success' => true,
//                 'maintenance_amount' => $maintenanceAmount,
//             ]);
//         }

//         return response()->json(['success' => false, 'message' => 'Maintenance amount not found for the selected year.']);
//     }

//     // Fetch years if no year is provided
//     $maintenanceYears = GramBill::where('gram', $gram)
//         ->pluck('quatation_date')
//         ->map(function ($date) {
//             return \Carbon\Carbon::parse($date)->year;
//         })
//         ->unique()
//         ->values();

//     if ($maintenanceYears->isNotEmpty()) {
//         return response()->json([
//             'success' => true,
//             'maintenance_years' => $maintenanceYears,
//         ]);
//     }

//     return response()->json(['success' => false, 'message' => 'No data found for the selected gram.']);
// }
public function getMaintenanceAmount(Request $request)
{
    $gram = $request->input('gram');
    $year = $request->input('year');

    if ($year) {
        // Check for the latest entry in `annual_maintenances` for the given gram and year
        $latestEntry = AnnualMaintenance::where('gram', $gram)
            ->where('maintenance_year', $year)
            ->latest('id') // Assuming 'id' determines the latest entry
            ->first();

        if ($latestEntry) {
            if ($latestEntry->remaining_amount == 0) {
                // If remaining_amount is 0, return maintenance amount as 0
                return response()->json([
                    'success' => true,
                    'maintenance_amount' => 0,
                    'reference_number' => null,
                    
                ]);
            } else {
                // If remaining_amount > 0, use it as the maintenance amount
                return response()->json([
                    'success' => true,
                    'maintenance_amount' => $latestEntry->remaining_amount,
                    'reference_number'=>$latestEntry->reference_number,
                ]);
            }
        }

        // If no entry in `annual_maintenances`, fetch from `gram_bills`
        $maintenanceAmount = GramBill::where('gram', $gram)
            ->whereYear('quatation_date', $year)
            ->value('maintenance_amount');
        $maintenanceNumber = GramBill::where('gram', $gram)
            ->whereYear('quatation_date', $year)
            ->value('reference_number');

        if ($maintenanceAmount) {
            return response()->json([
                'success' => true,
                'maintenance_amount' => $maintenanceAmount,
                'reference_number'=>$maintenanceNumber,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Maintenance amount not found for the selected year.']);
    }

    // If no year is provided, fetch maintenance years
    $maintenanceYearsFromBills = GramBill::where('gram', $gram)
        ->pluck('quatation_date')
        ->map(function ($date) {
            return \Carbon\Carbon::parse($date)->year;
        })
        ->unique()
        ->values();

    // Exclude years from `annual_maintenances` where remaining_amount is 0
    $excludedYears = AnnualMaintenance::where('gram', $gram)
        ->where('remaining_amount', 0)
        ->pluck('maintenance_year')
        ->unique()
        ->toArray();

    $availableYears = $maintenanceYearsFromBills->filter(function ($year) use ($excludedYears) {
        return !in_array($year, $excludedYears);
    });

    if ($availableYears->isNotEmpty()) {
        return response()->json([
            'success' => true,
            'maintenance_years' => $availableYears->values(),
        ]);
    }

    return response()->json(['success' => false, 'message' => 'No data found for the selected gram.']);
}



}
