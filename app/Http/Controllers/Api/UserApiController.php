<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class UserApiController extends Controller
{
    public function loginViaOTP(Request $request)
    {
 
        $mobileNumber = $request->input('mobile_number');

        // Check if the mobile number exists in the `users` table
        $user = User::where('contact_no', $mobileNumber)->first();

        if ($user) {
            // Revoke all existing tokens for this user (force logout from all devices)
            $user->tokens()->delete();

            // Generate a 4-digit random OTP
            $otp = random_int(1000, 9999);
			
          
        // Generate OTP
        if ($mobileNumber == '8888888888') {
            $otp = 8888; // Specific OTP for this number
        } else {
            $otp = random_int(1000, 9999); // Generate a random 4-digit OTP
        }

          
            // Update the OTP and expiry in the users table
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(1); // Set OTP expiration time
            $user->save();

            // Send OTP via WhatsApp
            $this->sendOtpMessage($mobileNumber, $otp);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to your mobile number.',
                'otp_expires_at' => $user->otp_expires_at,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Mobile number not found.'
            ], 200);
        }
    }
    
    public function verifyOTP(Request $request)
{
    $request->validate([
        'mobile_number' => 'required|digits:10',
        'otp' => 'required|digits:4',
    ]);
    
    
      


    $user = User::where('contact_no', $request->mobile_number)
                ->where('otp', $request->otp)
                ->where('otp_expires_at', '>', now())
                ->first();
                
                 if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid OTP or OTP expired.',
        ], 200);
    }
                
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
    


    if ($user) {
        // Clear the OTP after verification
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Revoke existing tokens
        $user->tokens()->delete();

        // Create a new token
        $token = $user->createToken('authToken')->plainTextToken;
        $gram = \DB::table('grams')->where('gram_name', $user->gram)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
            'token' => $token,
            'user' => array_merge(
                $user->toArray(), // Include all user data as an array
                [
                    'gram_id' => $gram ? $gram->id : null, // Add gram_id
                    'gram_name' => $gram ? $gram->gram_name : null, // Add gram_name from the `grams` table
                     'profile_pic' => $presignedUrl,
                ]
            ),
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid OTP or OTP expired.',
        ], 200);
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
    

public function getAboutGrams(Request $request)
{
    // Check if the Authorization token exists in the request header
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization token is missing.'
        ], 200);
    }

    // Try to authenticate the user using the token
    try {
        // Validate the token and retrieve user information
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // Fetch details from the about_grams table
            $aboutGrams = DB::table('about_grams')->get();

            // Add the base URL to the 'path' field
            $baseUrl = "egramofficial.in"; // Get the base URL from config

            $aboutGrams->transform(function ($item) use ($baseUrl) {
                $item->path = $baseUrl . '/' . $item->path;
                return $item;
            });

            // Return the response as JSON
            return response()->json([
                'status' => 'success',
                'message' => 'About grams details fetched successfully.',
                'data' => $aboutGrams
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.'
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization failed. ' . $e->getMessage()
        ], 200);
    }
}


public function getGramProfile(Request $request)
{
    // Check if the Authorization token exists in the request header
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization token is missing.'
        ], 200);
    }

    // Try to authenticate the user using the token
    try {
        // Validate the token and retrieve user information
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // Fetch details from the about_grams table
            $aboutGrams = DB::table('grams')->where('gram_name',$request->gram_name)->get();

            // Return the response as JSON
            return response()->json([
                'status' => 'success',
                'message' =>  'Gram Peofile fetched successfully.',
                'data' => $aboutGrams
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.'
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization failed. ' . $e->getMessage()
        ], 200);
    }
}


public function getBill(Request $request)
{
    // Check if the Authorization token exists in the request header
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization token is missing.'
        ], 200);
    }

    // Try to authenticate the user using the token
    try {
        // Validate the token and retrieve user information
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // Fetch details from the about_grams table
            $aboutGrams = DB::table('gharpatti_panipattis')->where('username',$request->user_id)->get();
 // Add the 'bill_path' to each item in the result
            $aboutGrams = $aboutGrams->map(function($item) {
                $item->bill_path = 'https://egramofficial.in/api/generate-bill-pdf/' . $item->id;
                return $item;
            });

            // Return the response as JSON
            return response()->json([
                'status' => 'success',
                'message' =>  'Bills fetched successfully.',
                'data' => $aboutGrams
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.'
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization failed. ' . $e->getMessage()
        ], 200);
    }
}


public function getRegisterToGrams(Request $request)
{
    // Check if the Authorization token exists in the request header
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization token is missing.'
        ], 200);
    }

    try {
        // Authenticate the user
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // Fetch records from the register_to_grams table
            $aboutGrams = DB::table('register_to_grams')
                ->where('gram', $request->gram_name)
                ->orderBy('id','DESC')
                ->get();

            // Initialize the S3 client
            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID', 'AKIA4MTWMH3DD3HGDESL'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY', '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'),
                ],
            ]);

            // Attach files with presigned URLs to each gram
            $aboutGramsWithFiles = $aboutGrams->map(function ($gram) use ($s3Client) {
                $files = DB::table('files')
                    ->where('register_to_gram_id', $gram->id)
                    ->select('id', 'original_file_name', 'path', 'created_at')
                    ->get();

                $filesWithPresignedUrls = $files->map(function ($file) use ($s3Client) {
                    try {
                        // Generate presigned URL for the file
                        $cmd = $s3Client->getCommand('GetObject', [
                            'Bucket' => env('AWS_BUCKET', 'general-ragister'),
                            'Key' => $file->path,
                        ]);

                        // Create presigned request valid for 5 minutes
                        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');

                        return [
                            'id' => $file->id,
                            'name' => $file->original_file_name,
                            'path' => $file->path,
                            'created_at' => $file->created_at,
                            'aws_url' => (string)$request->getUri(),
                        ];
                    } catch (\Exception $e) {
                        // Handle errors in generating presigned URL
                        return [
                            'id' => $file->id,
                            'name' => $file->original_file_name,
                            'path' => $file->path,
                            'created_at' => $file->created_at,
                            'error' => 'Failed to generate URL: ' . $e->getMessage(),
                        ];
                    }
                });

                $gram->files = $filesWithPresignedUrls;
                return $gram;
            });

            // Return response with grams and files
            return response()->json([
                'status' => 'success',
                'message' => 'Register grams details fetched successfully.',
                'data' => $aboutGramsWithFiles
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.'
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization failed. ' . $e->getMessage()
        ], 200);
    }
}



public function getAboutGramByName(Request $request)
{
    // Check if the Authorization token exists in the request header
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization token is missing.'
        ], 401);
    }

    try {
        // Authenticate the user
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            // Fetch records from the register_to_grams table
        $aboutGrams = DB::table('about_grams')
                ->where('gram', $request->gram_name)
                ->orderBy('id', 'DESC')
                ->get()
                ->map(function ($gram) {
                    // Add the full storage path for each file
                    $gram->path = $gram->path ? asset('assets/' . $gram->path) : null;
                    return $gram;
                });

            
            // Return response with grams and files
            return response()->json([
                'status' => 'success',
                'message' => 'About grams details fetched successfully.',
                'data' => $aboutGrams
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.'
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Authorization failed. ' . $e->getMessage()
        ], 200);
    }
}



public function generateBillPdf(Request $request, $billId)
{
    // Fetch bill data
    $data = DB::table('gharpatti_panipattis')->where('id', $billId)->first();

    if (!$data) {
        return response()->json([
            'status' => 'error',
            'message' => 'Bill not found.'
        ], 200);
    }

    // Fetch user data
    $user = User::find($data->username);
    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User not found.'
        ], 200);
    }

    // Fetch entries for calculations
    $entries = DB::table('gharpatti_panipattis')
        ->where('username', $user->id)
        ->get(['type', 'paid_amount', 'created_at']);

    // Separate gharpatti and panipatti entries
    $gharpattiEntries = $entries->where('type', 'gharpatti');
    $panipattiEntries = $entries->where('type', 'panipatti');

    // Calculate pending amounts
    $currentYear = now()->year;
    $createdYear = Carbon::parse($user->created_at)->year;
    $previousYears = max($currentYear - $createdYear, 0);

    $totalGharpattiDue = $previousYears * $user->gharpatti_annual;
    $totalGharpattiPaid = $gharpattiEntries->sum('paid_amount');
    $gharpattiPending = max($totalGharpattiDue - $totalGharpattiPaid, 0);

    $totalPanipattiDue = $previousYears * $user->panipatti_annual;
    $totalPanipattiPaid = $panipattiEntries->sum('paid_amount');
    $panipattiPending = max($totalPanipattiDue - $totalPanipattiPaid, 0);

    // Prepare additional data
    $currentUrl = $request->fullUrl();
    $exportDate = Carbon::now()->format('d-m-Y H:i:s');

    // Generate PDF
    $pdf = Pdf::loadView('gharpatti-panipatti.gharpattiprint', compact(
        'user', 'data', 'gharpattiPending', 'panipattiPending', 'exportDate', 'currentUrl'
    ));

    $pdf->setPaper('A4', 'portrait');

    $canvas = $pdf->getDomPDF()->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0, 0, 0));

    return $pdf->stream('bill-' . $billId . '.pdf', ['Attachment' => 0]);
}


    
}