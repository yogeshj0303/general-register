<?php

namespace App\Http\Controllers;
use App\Models\Lc;
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


class LCController extends Controller
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
    $lcs = Lc::with('grams')->get(); // You can also use pagination like Lc::paginate(10)

    return view('LC.index', compact('lcs'));
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
        return view('LC.create',compact('statesData','roles'));
    }

    /**
     * Store a newly created resource in stora
     * ge.
     */
public function store(Request $request)
{
    
        // Validate the input
        $validatedData = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'student_id' => 'required|numeric|unique:lcs,student_id',
            'student_first_name' => 'required|string|max:255',
                     'adhar_number' => 'required|digits:12|unique:lcs,adhar_number',

            'student_middle_name' => 'nullable|string|max:255',
            'student_last_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'mother_tongue' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'caste' => 'required|string|max:255',
            'sub_caste' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_place_taluka' => 'nullable|string|max:255',
            'birth_place_dist' => 'required|string|max:255',
            'birth_place_state' => 'required|string|max:255',
            'birth_place_country' => 'required|string|max:255',
            'dob' => 'required|date',
            'birth_in_text' => 'nullable|string|max:255',
            'previous_school' => 'nullable|string|max:255',
            'standard' => 'nullable|string|max:255',
            'date_of_admission' => 'nullable|date',
            'academic_progress' => 'nullable|string|max:100',
            'behavior' => 'nullable|string|max:100',
            'date_of_leaving_school' => 'nullable|string|max:100',
            'other_studies' => 'nullable|string|max:100',
            'reason_for_leaving_school' => 'nullable|string|max:100',
            'comments' => 'nullable|string|max:100',
            'certificate_date' => 'nullable|integer|min:1|max:31',
            'certificate_month' => 'nullable|integer|min:1|max:12',
            'certificate_year' => 'nullable|integer|min:2001|max:' . date('Y'),
        ]);

         // Generate the next certificate number
    $lastCertificate = Lc::orderBy('certificate_no', 'desc')->first();
    $nextCertificateNo = $lastCertificate ? intval($lastCertificate->certificate_no) + 1 : 1;
    $formattedCertificateNo = str_pad($nextCertificateNo, 4, '0', STR_PAD_LEFT); // Format as 0001, 0002, etc.

    // Store the data in the database
    $lc = new Lc();
    $lc->fill($validatedData);
    $lc->certificate_no = $formattedCertificateNo; // Assign the generated certificate number
    $lc->save();

        // Redirect with a success message
    return redirect()->route('lc.index')->with('success', 'Student LC record has been successfully updated.');

   
}

    /**
     * Display the specified resource.
     */
     
     
  public function show( $id)
    {
           $gram = LC::with('grams')->find($id);
    return response()->json(['gram' => $gram]);
           

    }

public function lcprint($id){
     $lc = Lc::with('grams')->findOrFail($id);
   
    return view('LC.lcprint', compact('lc'));
    
}


    /**
     * Show the form for editing the specified resource.
     */

public function edit(string $id)
{
    $lc = LC::find($id);
    $filePath = storage_path('data/states_districts.json');
          $roles=Role::get();
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('LC.edit',compact('statesData','roles' , 'lc'));
   
}



   
 public function update(Request $request, $id)
{
    // Validate the input
    $validatedData = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'student_id' => 'required|numeric|unique:lcs,student_id,' . $id,  // Ensure the current record's student_id is excluded
        'student_first_name' => 'required|string|max:255',
        'student_middle_name' => 'nullable|string|max:255',
        'student_last_name' => 'required|string|max:255',
        'mother_name' => 'required|string|max:255',
        'nationality' => 'required|string|max:255',
        'mother_tongue' => 'required|string|max:255',
        'religion' => 'required|string|max:255',
         'adhar_number' => 'required|digits:12|unique:lcs,adhar_number',

        'caste' => 'required|string|max:255',
        'sub_caste' => 'required|string|max:255',
        'birth_place' => 'required|string|max:255',
        'birth_place_taluka' => 'nullable|string|max:255',
        'birth_place_dist' => 'required|string|max:255',
        'birth_place_state' => 'required|string|max:255',
        'birth_place_country' => 'required|string|max:255',
        'dob' => 'required|date',
        'birth_in_text' => 'nullable|string|max:255',
        'previous_school' => 'nullable|string|max:255',
        'standard' => 'nullable|string|max:255',
        'date_of_admission' => 'nullable|date',
        'academic_progress' => 'nullable|string|max:100',
        'behavior' => 'nullable|string|max:100',
        'date_of_leaving_school' => 'nullable|string|max:100',
        'other_studies' => 'nullable|string|max:100',
        'reason_for_leaving_school' => 'nullable|string|max:100',
        'comments' => 'nullable|string|max:100',
        'certificate_date' => 'nullable|integer|min:1|max:31',
        'certificate_month' => 'nullable|integer|min:1|max:12',
        'certificate_year' => 'nullable|integer|min:2001|max:' . date('Y'),
    ]);

    // Find the LC record by ID
    $lc = Lc::findOrFail($id);

    // Update the record with validated data
    $lc->update($validatedData);

    // Redirect with a success message
    return redirect()->route('lc.index')->with('success', 'Student LC record has been successfully updated.');
}


    /**
     * Remove the specified resource from storage.
     */
  public function destroy($id)
{
    try {
        $lc = Lc::findOrFail($id);

        $lc->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error deleting the record'], 500);
    }
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
    // Validate the request data          profile_pic
    $request->validate([
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|string|max:20',
        'gender' => 'nullable|in:Male,Female',
        'dob' => 'nullable|date',
                'gate_no' => 'nullable',
                                'gram' => 'nullable',


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
     if ($request->hasFile('profile_pic')) {
        // Check and delete the old profile picture if it exists
        // if ($user->profile_pic && \Storage::disk('s3')->exists($user->profile_pic)) {
        //     \Storage::disk('s3')->delete($user->profile_pic);
        // }

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
                'gate_no' => $user->gate_no,

        'age' => $user->age,
        'land_area' => $user->land_area,
    ]);
}





}
