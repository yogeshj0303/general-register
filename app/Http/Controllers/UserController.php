<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Role;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     
     
     public function userprint(Request $request , $id){
                 $user = User::with('role')->find($id);
                      $s3Client = new S3Client([
        'version' => 'latest',
        'region' =>env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);
                 $profile_pic = $user->profile_pic;

    // Generate a presigned URL for the user's profile picture
    if ($profile_pic) {
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $profile_pic,
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $presignedUrl = (string) $request->getUri();
    } else {
        $presignedUrl = null; // Handle case where no profile picture exists
    }
          
          
    $currentUrl = url()->full(); // Alternative way to fetch full URL

    $exportDate = Carbon::now()->format('d-m-Y H:i:s'); 

    
$pdf = Pdf::loadView('users.userprint', compact('user', 'presignedUrl' , 'exportDate' , 'currentUrl'));


    // Add footer with page number
    $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0, 0, 0));

    // Stream PDF to browser
    return $pdf->stream('user-print.pdf');         
     }
     
     
     
     
     
     
     
     
     
     

public function profileuser(){
      $filePath = storage_path('data/states_districts.json');
          
                            $s3Client = new S3Client([
        'version' => 'latest',
        'region' =>env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);
                 $profile_pic = Auth::user()->profile_pic;

    // Generate a presigned URL for the user's profile picture
    if ($profile_pic) {
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $profile_pic,
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $presignedUrl = (string) $request->getUri();
    } else {
        $presignedUrl = null; // Handle case where no profile picture exists
    }
        $statesData = json_decode(file_get_contents($filePath), true);
    return view('profile' , compact('statesData','presignedUrl'));
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
      
       if($permissions['id']== 1 && $permissions['manage_user_viewown'] == 2){
                 $users = User::where('is_admin','user')->where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->with('role')->orderBy('id','desc')->paginate(10);
            
         

        }elseif(($permissions['id'] == 1 && $permissions['manage_user_viewall'] == 2) || 
        ($permissions['id'] == 2 && $permissions['manage_user_viewown'] == 2) || ($permissions['id'] == 3 && $permissions['manage_user_viewown'] == 2) 
        || ($permissions['id'] == 4  && $permissions['manage_user_viewown'] == 2) || ($permissions['id'] == 5 && $permissions['manage_user_viewown'] == 2)){
             $users = User::where('is_admin','user')->where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->where('gram', Auth::user()->gram)->with('role')->orderBy('id','desc')->paginate(10);
            
        
            }
        elseif($permissions['id'] == 2 && $permissions['manage_user_viewall'] == 2 || $permissions['id'] == 3 && $permissions['manage_user_viewall'] == 2
        || $permissions['id'] == 4  && $permissions['manage_user_viewall'] == 2 || $permissions['id'] == 5 && $permissions['manage_user_viewall'] == 2 ||
        $permissions['id'] == 6 && $permissions['manage_user_viewown'] == 2){
           
    
     $users = User::where('is_admin','user')->where('state', Auth::user()->state)->where('district', Auth::user()->district)->where('taluka', Auth::user()->taluka)->with('role')->orderBy('id','desc')->paginate(10);
            
         
               }
        elseif($permissions['id'] == 6 && $permissions['manage_user_viewall'] == 2 || $permissions['id'] == 7  && $permissions['manage_user_viewown'] == 2){
         $users = User::where('is_admin','user')->where('state', Auth::user()->state)->where('district', Auth::user()->district)->with('role')->orderBy('id','desc')->paginate(10);
            
     
       
        }
        elseif($permissions['id'] == 7  && $permissions['manage_user_viewall'] == 2 || $permissions['id'] == 8 && $permissions['manage_user_viewown'] == 2){
      $users = User::where('is_admin','user')->where('state', Auth::user()->state)->where('gram', Auth::user()->gram)->with('role')->orderBy('id','desc')->paginate(10);
            
       
       
                  
        } elseif($permissions['id'] == 8 && $permissions['manage_user_viewall'] == 2){
           $users = User::where('is_admin','user')->with('role')->orderBy('id','desc')->paginate(10);
            
                 
      
        }
      
      else{
               $users = collect();
            
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
       
}
      else if (Auth::user()->is_admin === 'admin') {
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
    
     $users = User::where('is_admin','user')->with('role')->orderBy('id','desc')->paginate(10);
      
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
        'about_gram_edit', 'about_gram_delete', 'manage_user_viewown', 'about_gram_viewall', 'about_gram_print',
        'population_add', 'population_edit', 'population_delete', 'population_viewown', 'population_viewall',
        'population_print', 'gram_bill_add', 'gram_bill_edit', 'gram_bill_delete', 'gram_bill_viewown',
        'gram_bill_viewall', 'gram_bill_print', 'gram_annual_add', 'gram_annual_edit', 'gram_annual_delete',
        'gram_annual_viewown', 'gram_annual_viewall', 'gram_annual_print', 'dash_pending_taxation_user',
        'dash_pending_water_user', 'paid_annual_m_gram', 'pending_annual_m_gram'
      
    ];
 foreach ($modules as $module) {
        
            $permissions["{$module}"] = 1;
        
    }
     $users = collect();
     
}

           
            return view('users.index', compact('users','permissions'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        $filePath = storage_path('data/states_districts.json');
          $roles=Role::get();
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('users.create',compact('statesData','roles'));
    }

    /**
     * Store a newly created resource in stora
     * ge.
     */
  public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'state' => 'required',
        'district' => 'required',
        'taluka' => 'required',
        'gram' => 'required',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|numeric',
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gender' => 'required',
        'dob' => 'required|date',
        'age' => 'required|numeric',
        'email' => 'nullable|email|max:255', // Gmail field added
        'user_type' => 'required|string',
    ]);

    $profilePicPath = null;
    if ($request->hasFile('profile_pic')) {
        // Upload the file to the S3 bucket
        $profilePicPath = $request->file('profile_pic')->store('profile_pics', 's3');
        
        // Get the public URL of the uploaded file
    }

    // Save data to the database
    User::create([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'name' => $request->name,
        'contact_no' => $request->contact_no,
        'profile_pic' => $profilePicPath,
        'gender' => $request->gender,
        'dob' => $request->dob,
        'age' => $request->age,
        'email' => $request->email, // Gmail field added
        'user_type' => $request->user_type,
    ]);

    // Redirect back with success message
    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

    /**
     * Display the specified resource.
     */
     
     
  public function show(string $id)
    {
        $user = User::find($id);
$roles = Role::where('id', $user->user_type)->pluck('role_name')->first();

    // Initialize the S3 client
    $s3Client = new S3Client([
        'version' => 'latest',
        'region' =>env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);



    // Generate a presigned URL for the user's profile picture
    if ($user->profile_pic) {
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $user->profile_pic,
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $presignedUrl = (string) $request->getUri();
    } else {
        $presignedUrl = null; // Handle case where no profile picture exists
    }

    if ($user) {
return response()->json([
    'user' => $user,
    'roles' => $roles,
    'presignedUrl' =>$presignedUrl
]);
    }

    return response()->json(['message' => 'user not found'], 404);
    }



    /**
     * Show the form for editing the specified resource.
     */

public function edit(string $id)
{
    $user = User::find($id);


    // Load states data
    $filePath = storage_path('data/states_districts.json');
    $statesData = json_decode(file_get_contents($filePath), true);

 $roles=Role::get();
    // Initialize the S3 client
    $s3Client = new S3Client([
        'version' => 'latest',
        'region' =>env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);



    // Generate a presigned URL for the user's profile picture
    if ($user->profile_pic) {
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $user->profile_pic,
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $presignedUrl = (string) $request->getUri();
    } else {
        $presignedUrl = null; // Handle case where no profile picture exists
    }

    return view('users.edit', compact('user', 'statesData', 'presignedUrl','roles'));
}



    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|string|max:20',
        'gender' => 'nullable|in:Male,Female',
        'dob' => 'nullable|date',
        'age' => 'nullable|integer',
        'email' => 'nullable|email|max:255', // Gmail field added
        'user_type' => 'required',
        'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    
    $user = User::findOrFail($id);

    // Update fields
    $user->state = $request->state;
    $user->district = $request->district;
    $user->taluka = $request->taluka;
    $user->name = $request->name;
    $user->contact_no = $request->contact_no;
    $user->gender = $request->gender;
    $user->dob = $request->dob;
    $user->age = $request->age;
    $user->email = $request->email;  // Gmail field added
    $user->user_type = $request->user_type;

    // Handle profile picture upload
    if ($request->hasFile('profile_pic')) {
        // Delete the old profile picture from S3 if it exists
        if ($user->profile_pic && \Storage::disk('s3')->exists($user->profile_pic)) {
            \Storage::disk('s3')->delete($user->profile_pic);
        }

        // Upload the new profile picture to S3
        $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 's3');
    }

    // Save updated user details
    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully!');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
    
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }

    public function getOTP(){
        return view('auth.otp-page');
    }

    
    public function userLogin(){
        return view('auth.users-login');
    }
    

public function loginWithOTP(Request $request)
{
    // Validate the mobile number input
    $request->validate([
        'mobile_number' => 'required|digits:10', // Assuming a 10-digit mobile number
    ]);

    $mobileNumber = $request->input('mobile_number');

    // Check if the mobile number exists in the `users` table
    $user = User::where('contact_no', $mobileNumber)->first();

    if ($user) {
        // Generate a 4-digit random OTP
        $otp = random_int(1000, 9999);

        // Update the OTP and expiry in the users table
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(1); // Set OTP expiration time
        $user->save();
        
          // Send OTP via WhatsApp (Your existing method for sending OTP)
    $this->sendOtpMessage($mobileNumber, $otp);


        // Optionally, send the OTP to the user via SMS (use an SMS service provider)
        // Example: SMS::send($mobileNumber, "Your OTP is: $otp");

        return redirect()->route('otp.page.view')->with('success', 'OTP sent to your mobile number.');
    } else {
        return redirect()->back()->withErrors(['mobile_number' => 'Mobile number not found.']);
    }
}

   private function sendOtpMessage($mobile, $otp)
    {
        $message = "Your OTP for login is *$otp*. Please do not share it with anyone.\n\nThank you!";
        
        // WhatsApp API integration (use your API key)
        $apikey = '9b27317c95af48b281c9bea373bbb889';
        $response = Http::get('http://web.cloudwhatsapp.com/wapp/api/send', [
            'apikey' => $apikey,
            'mobile' => '91' . $mobile,
            'msg' => $message,
        ]);

        $jsonData = $response->json();
        if ($jsonData['status'] != 'success') {
            // Log or handle API error
        }
    }


public function verifyOtp(Request $request)
{
    // Validate OTP digits
    $request->validate([
        'digit1' => 'required|digits:1',
        'digit2' => 'required|digits:1',
        'digit3' => 'required|digits:1',
        'digit4' => 'required|digits:1',
    ]);

    // Combine the OTP digits into a single string
    $otp = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;

    // Find the user with the OTP
    $user = User::where('otp', $otp)
                ->where('otp_expires_at', '>', now()) // Ensure OTP is still valid
                ->first();

    if ($user) {
        // OTP is valid, proceed with login or other actions
        $user->otp = null;  // Clear OTP
        $user->otp_expires_at = null;  // Clear OTP expiration time
        $user->save();

        Auth::login($user);  // Log in the user

        return redirect()->route('root')->with('success', 'OTP verified successfully!');
    }

    // OTP is invalid or expired
    return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP. Please try again.']);
}





 public function updatePassword(Request $request)
{
 
    $validate = $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);




    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        dd("not match");
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }
    else{

    $user->password = Hash::make($request->password);
            dd(" match");
    }

    $user->save();

    return back()->with('success', 'Password changed successfully!');
}



public function editprofile(Request $request , $id)
{
    
        $user = User::find($id);
        $s3Client = new S3Client([
        'version' => 'latest',
        'region' =>env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);
                 $profile_pic = $user->profile_pic;

    // Generate a presigned URL for the user's profile picture
    if ($profile_pic) {
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $profile_pic,
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $presignedUrl = (string) $request->getUri();
    } else {
        $presignedUrl = null; // Handle case where no profile picture exists
    }
                return response()->json([
            'user' => $user,
            'presignedUrl' =>$presignedUrl
        ]);


}


public function profileupdate(Request $request, $id)
{
    
    // Validate the request data
    $request->validate([
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|string|max:20',
        'gender' => 'nullable|in:Male,Female',
        'dob' => 'nullable|date',
        'gram' => 'nullable|string|max:255',
        'age' => 'nullable|integer',
        'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = User::findOrFail($id);

    // Update user attributes with request data
    $user->state = $request->input('state');
    $user->district = $request->input('district');
    $user->taluka = $request->input('taluka');
    $user->name = $request->input('name');
    $user->contact_no = $request->input('contact_no');
    $user->gender = $request->input('gender');
    $user->dob = $request->input('dob');
    $user->email = $request->input('email');
    $user->gram = $request->input('gram');
    $user->age = $request->input('age');

    // Handle profile picture upload
    if ($request->hasFile('profile_pic')) {
        // Delete the old profile picture from S3 if it exists
        if ($user->profile_pic && \Storage::disk('s3')->exists($user->profile_pic)) {
            \Storage::disk('s3')->delete($user->profile_pic);
        }

        // Upload the new profile picture to S3
        $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 's3');
    }

   $user->save();

    return response()->json([
        'id' => $user->id,
        'state' => $user->state,
        'district' => $user->district,
        'taluka' => $user->taluka,
        'name' => $user->name,
        'contact_no' => $user->contact_no,
        'gender' => $user->gender,
        'dob' => $user->dob,
        'age' => $user->age,
    ]);
}





}
