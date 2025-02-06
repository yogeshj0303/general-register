<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login-with-otp', [UserApiController::class, 'loginViaOTP']);

Route::post('/verify-otp', [UserApiController::class, 'verifyOTP']);

Route::get('/about-grams', [UserApiController::class, 'getAboutGrams']);

Route::get('/about-grams-by-name', [UserApiController::class, 'getAboutGramByName']);

Route::get('/register-to-grams', [UserApiController::class, 'getRegisterToGrams']);

Route::get('/gram-profile', [UserApiController::class, 'getGramProfile']);

Route::get('/generate-bill-pdf/{billId}', [UserApiController::class, 'generateBillPdf']);


Route::get('/get-bills', [UserApiController::class, 'getBill']);



Route::post('/upload-pdf', function (Request $request) {
    // Validate that the uploaded file is a PDF and has the right size
 
    // Get the file from the request
    $file = $request->file('file');

    // Define the file path where the file will be stored on S3
    $filePath = 'test-folder/' . uniqid() . '-' . $file->getClientOriginalName(); // Unique filename

    // Upload the file to S3 using the 'put' method
    Storage::disk('s3')->put($filePath, file_get_contents($file), 'public'); // Make the file public (optional)

    // Generate a temporary URL that expires in 10 minutes
    $url = Storage::disk('s3')->temporaryUrl(
        $filePath, 
        now()->addMinutes(10) // Expiration time of 10 minutes
    );

    // Return a success response with the file URL
    return response()->json([
        'message' => 'File uploaded successfully!',
        'url' => $url,
        'fileName' => $filePath,
    ], 200);
});


use Illuminate\Support\Facades\Log;

Route::get('/files/{filename}', function ($filename) {
    $filePath = "test-folder/$filename";

    try {
        // Attempt to get file URL
        if (Storage::disk('s3')->exists($filePath)) {
            $url = Storage::disk('s3')->url($filePath);
            return response()->json(['url' => $url], 200);
        }
    } catch (\Exception $e) {
        Log::error("S3 File Check Failed: " . $e->getMessage());
    }

    return response()->json(['message' => 'File not found or cannot check existence!'], 404);
});