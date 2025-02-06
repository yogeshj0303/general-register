<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\GharpattiPanipatti;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class GharpattiPanipattiController extends Controller
{
    
    
    // public function gharpattiprint($id){
    //             $data = DB::table('gharpatti_panipattis')->where('id', $id)->first();
    //           if($data){
    //             $user = User::where('id' , $data->username)->first();

    //             return view('gharpatti-panipatti.gharpattiprint' , compact('user','data'));
    //           }else{
    //                 return redirect()->route('gharpatti-panipatti.index')->with('error', 'data no fund!');
    //           }

    // }
//     public function gharpattiprint($id)
// {
//     // Fetch the record from the 'gharpatti_panipattis' table
//     $data = DB::table('gharpatti_panipattis')->where('id', $id)->first();

//     if ($data) {
//         // Fetch the related user
//         $user = User::where('id', $data->username)->first();

//         if ($user) {
//             // Fetch all entries for the user from 'gharpatti_panipattis'
//             $entries = DB::table('gharpatti_panipattis')
//                 ->where('username', $user->id)
//                 ->get(['type', 'paid_amount', 'created_at']);

//             // Separate entries by type
//             $gharpattiEntries = $entries->where('type', 'gharpatti');
//             $panipattiEntries = $entries->where('type', 'panipatti');

//             // Calculate years since user creation
//             $currentYear = now()->year;
//             $createdYear = Carbon::parse($user->created_at)->year;
//             $totalYears = $currentYear - $createdYear + 1; // Include the start year

//             // Calculate gharpatti dues and pending amounts
//             $totalGharpattiDue = $totalYears * $user->gharpatti_annual;
//             $totalGharpattiPaid = $gharpattiEntries->sum('paid_amount');
//             $gharpattiPending = $totalGharpattiDue - $totalGharpattiPaid;

//             // Calculate panipatti dues and pending amounts
//             $totalPanipattiDue = $totalYears * $user->panipatti_annual;
//             $totalPanipattiPaid = $panipattiEntries->sum('paid_amount');
//             $panipattiPending = $totalPanipattiDue - $totalPanipattiPaid;

//             // Pass the calculated data to the view
//             return view('gharpatti-panipatti.gharpattiprint', compact(
//                 'user',
//                 'data',
//                 'gharpattiPending',
//                 'panipattiPending'
//             ));
//         }
//     }

//     return redirect()->route('gharpatti-panipatti.index')->with('error', 'Data not found!');
// }

    
    public function gharpattiprint(Request $request , $id)
{
    // Fetch the record from the 'gharpatti_panipattis' table
    $data = DB::table('gharpatti_panipattis')->where('id', $id)->first();

    if ($data) {
        // Fetch the related user
        $user = User::where('id', $data->username)->first();

        if ($user) {
            // Fetch all entries for the user from 'gharpatti_panipattis'
            $entries = DB::table('gharpatti_panipattis')
                ->where('username', $user->id)
                ->get(['type', 'paid_amount', 'created_at']);

            // Separate entries by type
            $gharpattiEntries = $entries->where('type', 'gharpatti');
            $panipattiEntries = $entries->where('type', 'panipatti');

            // Calculate years since user creation excluding the current year
            $currentYear = now()->year;
            $createdYear = Carbon::parse($user->created_at)->year;
            $previousYears = $currentYear - $createdYear; // Exclude the current year

            // Calculate gharpatti dues and pending amounts for previous years
            $totalGharpattiDue = $previousYears * $user->gharpatti_annual;
            $totalGharpattiPaid = $gharpattiEntries->sum('paid_amount');
            $gharpattiPending = $totalGharpattiDue - $totalGharpattiPaid;

            // Calculate panipatti dues and pending amounts for previous years
            $totalPanipattiDue = $previousYears * $user->panipatti_annual;
            $totalPanipattiPaid = $panipattiEntries->sum('paid_amount');
            $panipattiPending = $totalPanipattiDue - $totalPanipattiPaid;

            // Ensure no negative pending amounts
            $gharpattiPending = max($gharpattiPending, 0);
            $panipattiPending = max($panipattiPending, 0);
 $currentUrl = $request->fullUrl();
    $exportDate = Carbon::now()->format('d-m-Y H:i:s'); 
    
    
    
        $pdf = Pdf::loadView('gharpatti-panipatti.gharpattiprint', compact( 'user',
                'data',
                'gharpattiPending',
                'panipattiPending',
                 'exportDate', 
                 'currentUrl'));
  
 

    // Render PDF
    $pdf->render();

    // Add footer with page number
    
    $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0,0,0));

    // Stream PDF to browser
    return $pdf->stream('salary-print.pdf');
    
       
        }
    }

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
      
      
      
       if($permissions['id']== 1 && $permissions['p_w_bill_viewown'] == 2){
                 $records = GharpattiPanipatti::Where('username', Auth::id())->select('gharpatti_panipattis.*', 'users.name as user_name')
               ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);
         

        }elseif(($permissions['id'] == 1 && $permissions['p_w_bill_viewall'] == 2) || 
        ($permissions['id'] == 2 && $permissions['p_w_bill_viewown'] == 2) || ($permissions['id'] == 3 && $permissions['p_w_bill_viewown'] == 2) 
        || ($permissions['id'] == 4  && $permissions['p_w_bill_viewown'] == 2) || ($permissions['id'] == 5 && $permissions['p_w_bill_viewown'] == 2)){
            $records = GharpattiPanipatti::Where('gharpatti_panipattis.state', Auth::user()->state)
            ->where('gharpatti_panipattis.district', Auth::user()->district)->where('gharpatti_panipattis.taluka', Auth::user()->taluka)->where('gharpatti_panipattis.gram', Auth::user()->gram)
            ->select('gharpatti_panipattis.*', 'users.name as user_name')
    ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10); 
        
            }
        elseif($permissions['id'] == 2 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 3 && $permissions['p_w_bill_viewall'] == 2
        || $permissions['id'] == 4  && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 5 && $permissions['p_w_bill_viewall'] == 2 ||
        $permissions['id'] == 6 && $permissions['p_w_bill_viewown'] == 2){
            $records = GharpattiPanipatti::Where('gharpatti_panipattis.state', Auth::user()->state)
            ->where('gharpatti_panipattis.district', Auth::user()->district)->where('gharpatti_panipattis.taluka', Auth::user()->taluka)
            ->select('gharpatti_panipattis.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);
         
               }
        elseif($permissions['id'] == 6 && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 7  && $permissions['p_w_bill_viewown'] == 2){
       $records = GharpattiPanipatti::Where('gharpatti_panipattis.state', Auth::user()->state)
            ->where('gharpatti_panipattis.district', Auth::user()->district)
            ->select('gharpatti_panipattis.*', 'users.name as user_name')
    ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);
       
        }
        elseif($permissions['id'] == 7  && $permissions['p_w_bill_viewall'] == 2 || $permissions['id'] == 8 && $permissions['p_w_bill_viewown'] == 2){
          $records = GharpattiPanipatti::Where('gharpatti_panipattis.state', Auth::user()->state)
           ->select('gharpatti_panipattis.*', 'users.name as user_name')->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);   
                  
        } elseif($permissions['id'] == 8 && $permissions['p_w_bill_viewall'] == 2){
            $records = GharpattiPanipatti::select('gharpatti_panipattis.*', 'users.name as user_name')
    ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);
                 
      
        }
      
      else{
              $records = collect();  
            
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
        $records = collect();  
        
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
    
    $records = GharpattiPanipatti::select('gharpatti_panipattis.*', 'users.name as user_name')
    ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);
    
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
     $records = collect();
     
}    
        
        

        return view('gharpatti-panipatti.gharpatti_panipatti', compact('records','permissions'));
    }

    public function create()
    {
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('gharpatti-panipatti.create',compact('statesData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'username' => 'required|string',
            'type' => 'required|string|in:gharpatti,panipatti',
            'amount_type' => 'required|string',
            'paid_type' => 'required|string|in:cash,online,rtgs,check',
            'paid_amount' => 'required|numeric|min:1',
            'paid_date' => 'required|date',
            'remaining_amount' => 'nullable|numeric|min:0',
            'send_bill' => 'nullable|boolean',
        ]);

      $data = $request->all();
    $data['owner_id'] = Auth::id();

    // Create the record in the database
    $record = GharpattiPanipatti::create($data);

          // If send_bill is true, generate and send the PDF bill
          
  if ($request->send_bill) {
    $currentUrl = $request->fullUrl();
    $exportDate = Carbon::now()->format('d-m-Y H:i:s');
    
    $pdfPath = $this->generatePdfBill($record, $currentUrl, $exportDate); 

    $mobile = $this->getMobileNumber($record->username); // Replace with actual logic
    
    // Pass $exportDate properly
    
    $this->sendBillMessage($mobile, $pdfPath, $currentUrl, $exportDate);
}


        return redirect()->route('gharpatti-panipatti.index')->with('success', 'Record added successfully!');
    }
    

    
    public function show(string $id)
    {
        $record = GharpattiPanipatti::findOrFail($id);
        $user = User::where('id' , $record->username)->first();

       if ($record) {
        return response()->json([
            'record' => $record,
            'user' => $user
        ]);
    }

    return response()->json(['message' => 'user not found'], 404);
    }



    public function edit($id)
    {
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        $record = GharpattiPanipatti::findOrFail($id);
        return view('gharpatti-panipatti.edit', compact('record','statesData'));
    }

    public function update(Request $request, $id)
    {
    
       try {
    $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'type' => 'required|string|in:gharpatti,panipatti',
        'amount_type' => 'required|string',
        'paid_type' => 'required|string|in:cash,online,rtgs,check',
        'paid_amount' => 'required|numeric|min:0',
        'paid_date' => 'required|date',
        'remaining_amount' => 'nullable|numeric|min:0',
        'send_bill' => 'nullable|boolean',
    ]);
} catch (ValidationException $e) {
    dd($e->errors());
}
        $record = GharpattiPanipatti::findOrFail($id);
        $record->update($request->all());

        return redirect()->route('gharpatti-panipatti.index')->with('success', 'Record updated successfully!');
    }

    public function destroy($id)
    {
        
        $record = GharpattiPanipatti::findOrFail($id);
        
        $record->delete();

        return redirect()->route('gharpatti-panipatti.index')->with('success', 'Record deleted successfully!');
    }
    
    
    private function generatePdfBill($record , $currentUrl, $exportDate)
{
    
     $user = User::where('id', $record->username)->first();

        if ($user) {
            // Fetch all entries for the user from 'gharpatti_panipattis'
            $entries = DB::table('gharpatti_panipattis')
                ->where('username', $user->id)
                ->get(['type', 'paid_amount', 'created_at']);

            // Separate entries by type
            $gharpattiEntries = $entries->where('type', 'gharpatti');
            $panipattiEntries = $entries->where('type', 'panipatti');

            // Calculate years since user creation excluding the current year
            $currentYear = now()->year;
            $createdYear = Carbon::parse($user->created_at)->year;
            $previousYears = $currentYear - $createdYear; // Exclude the current year

            // Calculate gharpatti dues and pending amounts for previous years
            $totalGharpattiDue = $previousYears * $user->gharpatti_annual;
            $totalGharpattiPaid = $gharpattiEntries->sum('paid_amount');
            $gharpattiPending = $totalGharpattiDue - $totalGharpattiPaid;

            // Calculate panipatti dues and pending amounts for previous years
            $totalPanipattiDue = $previousYears * $user->panipatti_annual;
            $totalPanipattiPaid = $panipattiEntries->sum('paid_amount');
            $panipattiPending = $totalPanipattiDue - $totalPanipattiPaid;

            // Ensure no negative pending amounts
            $gharpattiPending = max($gharpattiPending, 0);
            $panipattiPending = max($panipattiPending, 0);

           
                $pdfContent = \PDF::loadView('gharpatti-panipatti.gharpattiprint', ['data' => $record,'user' =>$user, 'gharpattiPending' =>$gharpattiPending , 'panipattiPending' =>$panipattiPending ,  'currentUrl' => $currentUrl, // Pass current URL
    'exportDate' => $exportDate ])->output();

    $filePath = storage_path('app/public/bills/') . 'bill_' . $record->id . '.pdf';
    file_put_contents($filePath, $pdfContent);

    return $filePath;
        }

}

/**
 * Send the PDF bill via WhatsApp.
 */
private function sendBillMessage($mobile, $pdfPath)
{
       // Read the PDF file contents
    $pdfContent = file_get_contents($pdfPath);
    $pdfName = basename($pdfPath);
    
$message = "Your bill is ready. Please find the attached PDF: https://e-gram.actthost.com/storage/bills/" . $pdfName;



    $apikey = '9b27317c95af48b281c9bea373bbb889';
        $response = Http::get('http://web.cloudwhatsapp.com/wapp/api/send', [
            'apikey' => $apikey,
            'mobile' => '91' . $mobile,
            'msg' => $message,
        ]);

        $jsonData = $response->json();

    if ($jsonData['status'] != 'success') {
        // Log or handle API error
        \Log::error('Failed to send bill via WhatsApp: ' . $jsonData['message']);
    }
}
/**
 * Retrieve the mobile number from the username or other fields.
 */
private function getMobileNumber($username)
{
  
    // Replace with logic to fetch mobile number, e.g., querying the database
    $getUser = User::where('id',$username)->select('contact_no')->first();
    $mobileNo = $getUser->contact_no;
    return $mobileNo;
}

}
