<?php

namespace App\Http\Controllers;
use App\Models\RegisterToGram;
use App\Models\Category;
use App\Models\File;
 use Aws\S3\S3Client;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class RegisterToGramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     
     
    public function registertogramprint(Request $request ,$id)
{
    $registerToGrams = RegisterToGram::findOrFail($id);
     $currentUrl = $request->fullUrl();

    $exportDate = Carbon::now()->format('d-m-Y H:i:s');
    
    $pdf = Pdf::loadView('register-to-gram.registergramprint', compact('registerToGrams', 'exportDate' , 'currentUrl'));
    $canvas = $pdf->getCanvas();
    $canvas->page_text(500, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 12, array(0, 0, 0));

    return $pdf->stream('register-gram-print.pdf');
}
     
     
     
     
    public function index()
    {
        //
        $registerToGrams = RegisterToGram::orderBy('id','desc')->paginate(10);
        $getCategory = Category::all();
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('register-to-gram.index',compact('statesData','registerToGrams','getCategory'));
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
        'category' => 'required|string',
        'pdf.*' => 'nullable|mimes:pdf', // Validate PDF files
    ]);

    // Create a new RegisterToGram record
    $registerToGram = RegisterToGram::create([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'category' => $request->category,
    ]);

    // Prepare the folder path by replacing spaces with hyphens
    $state = str_replace(' ', '-', $request->state);
    $district = str_replace(' ', '-', $request->district);
    $taluka = str_replace(' ', '-', $request->taluka);
    $gram = str_replace(' ', '-', $request->gram);
    $folderPath = 'uploads/' . $state . '/' . $district . '/' . $taluka . '/' . $gram;

// Check if the "Create Only File Path" checkbox is checked
if ($request->has('create_only_path') && $request->create_only_path) {
    // Ensure the folder path exists on S3 (if you still want to create the folder)
    if (!Storage::disk('s3')->exists($folderPath)) {
        Storage::disk('s3')->makeDirectory($folderPath);
    }

    // Get the file names from the request
    $fileNames = $request->input('file_names', []); // Default to an empty array if file_names is not provided

    // Iterate through each file name and save it in the database
    foreach ($fileNames as $fileName) {
        // Save the file path and file name in the database
        $registerToGram->files()->create([
            'path' => $folderPath . '/' . $fileName, // Store the file path in the database
            'url' => null, // No URL as the file is not uploaded
            'original_file_name' => $fileName, // Store the original file name
        ]);
    }

}


    // If "Create Only File Path" is not checked, upload the files to S3
    if ($request->hasFile('pdf')) {
        foreach ($request->file('pdf') as $file) {
            // Get the original file name
            $originalFileName = $file->getClientOriginalName();
            
            // Directly store the file in the folder path on S3
            $filePath = $file->storeAs($folderPath, $originalFileName, 's3');

            // Optionally retrieve the public URL
            $fileUrl = Storage::disk('s3')->url($filePath);

            // Store the file path and original file name in the database
            $registerToGram->files()->create([
                'path' => $filePath, // Store the path of the file in S3
                'url' => $fileUrl, // Store the public URL of the file
                'original_file_name' => $originalFileName, // Store the original file name
            ]);
        }
    }

    return redirect()->route('register-to-gram.index')->with('success', 'Registration saved successfully!');
}

    
    

    /**
     * Display the specified resource.
     */
  


public function show(string $id)
{
    $registerToGram = RegisterToGram::find($id);
    $files = File::where('register_to_gram_id', $registerToGram->id)->get();

    // Initialize the S3 client
    $s3Client = new \Aws\S3\S3Client([
        'version' => 'latest',
        'region' => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);

    // Generate presigned URLs for each file
    $fileUrls = [];
    foreach ($files as $file) {
        // Get the full file path stored in your database
        $filePath = $file->path; // Path to the file in S3

        // Generate presigned URL for the file
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $filePath,
        ]);

        // Create presigned request valid for 5 minutes
        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $fileUrls[] = [
            'url' => (string) $request->getUri(),
            'name' => basename($filePath) // Extract the file name from the path
        ]; 
    }

    if ($registerToGram) {
        return response()->json([
            'RegisterToGram' => $registerToGram,
            'files' => $fileUrls, // Return the file URLs with names
        ]);
    }

    return response()->json(['error' => 'RegisterToGram not found'], 404);
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $registerToGrams = RegisterToGram::findOrFail($id);
        $getCategory = Category::all();
        
            $File = File::where('register_to_gram_id', $registerToGrams->id)->get();

    // Initialize the S3 client
    $s3Client = new \Aws\S3\S3Client([
        'version' => 'latest',
        'region' => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID','AKIA4MTWMH3DD3HGDESL'),
            'secret' => env('AWS_SECRET_ACCESS_KEY','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'),
        ],
    ]);

    // Generate presigned URLs for each file
    $fileUrls = [];
    foreach ($File as $file) {
        // Get the full file path stored in your database
        $filePath = $file->path; // Path to the file in S3

        // Generate presigned URL for the file
        $cmd = $s3Client->getCommand('GetObject', [
            'Bucket' => env('AWS_BUCKET','general-ragister'),
            'Key' => $filePath,
        ]);

        // Create presigned request valid for 5 minutes
        $request = $s3Client->createPresignedRequest($cmd, '+5 minutes');
        $fileUrls[] = [
            'url' => (string) $request->getUri(),
            'name' => basename($filePath) // Extract the file name from the path
        ]; 
    }

        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return response()->json([
            'gram' => $registerToGrams,
            'statesData' => $statesData,
            'categories' => $getCategory,
             'File' => $fileUrls,
             'file_id' =>$id,

        ]);
    }
    
    
public function destroyfile($id)
{
   

    $file = File::where('original_file_name',$id)->first(); // Find the file by ID
    
    if ($file) {
        // Check if file exists in storage (S3 or local disk)
        $disk = Storage::disk('s3'); // Use your storage disk, e.g., 's3' or 'local'

        // Delete file from storage
        if ($disk->exists($file->path)) {
            $disk->delete($file->path);
        }

        // Delete the file record from the database
        $file->delete();

        return response()->json(['message' => 'File deleted successfully.'], 200);
    }

    return response()->json(['message' => 'File not found.'], 404);
}



    
    

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    // Validate the request data
    $validated = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'category' => 'required|string',
        'pdf.*' => 'nullable|mimes:pdf', // Validate PDF files
    ]);
    
    $registerToGram = RegisterToGram::findOrFail($id);
    
    // Update the record
    $registerToGram->update([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'category' => $request->category,
    ]);
    
    // Define the folder path
    // $folderPath = 'uploads/' . $request->state . '/' . $request->district . '/' . $request->taluka .'/' . $request->gram;
    
    // // Check if the folder exists, create it if it doesn't
    // if (!Storage::disk('public')->exists($folderPath)) {
    //     Storage::disk('public')->makeDirectory($folderPath);
    // }
    
    // // Handle file uploads
    // if ($request->hasFile('pdf')) {
    //     foreach ($request->file('pdf') as $file) {
    //         // Store the file in the existing or newly created folder
    //         $filePath = $file->store($folderPath, 'public');
            
    //         // Store the file path in the database associated with the RegisterToGram record
    //         $registerToGram->files()->create(['path' => $filePath]);
    //     }
    // }
    
$state = str_replace(' ', '-', $request->state);
$district = str_replace(' ', '-', $request->district);
$taluka = str_replace(' ', '-', $request->taluka);
$gram = str_replace(' ', '-', $request->gram);

$folderPath = 'uploads/' . $state . '/' . $district . '/' . $taluka . '/' . $gram;

// Check if the "Create Only File Path" checkbox is checked
if ($request->has('create_only_path') && $request->create_only_path) {
    // Ensure the folder path exists on S3 (if you still want to create the folder)
    if (!Storage::disk('s3')->exists($folderPath)) {
        Storage::disk('s3')->makeDirectory($folderPath);
    }

    // Get the file names from the request
    $fileNames = $request->input('file_names', []); // Default to an empty array if file_names is not provided

    // Iterate through each file name and save it in the database
    foreach ($fileNames as $fileName) {
        // Save the file path and file name in the database
        $registerToGram->files()->create([
            'path' => $folderPath . '/' . $fileName, // Store the file path in the database
            'url' => null, // No URL as the file is not uploaded
            'original_file_name' => $fileName, // Store the original file name
        ]);
    }

}


if ($request->hasFile('pdf')) {
    foreach ($request->file('pdf') as $file) {
        // Get the original file name
        $originalFileName = $file->getClientOriginalName();
        
        // Directly store the file in the folder path on S3
        $filePath = $file->storeAs($folderPath, $originalFileName, 's3');

        // Optionally retrieve the public URL
        $fileUrl = Storage::disk('s3')->url($filePath);

        // Store the file path and original file name in the database
        $registerToGram->files()->create([
            'path' => $filePath,         // Store the path of the file in S3
            'url' => $fileUrl,           // Store the public URL of the file
            'original_file_name' => $originalFileName // Store the original file name
        ]);
    }
}



    // You can return a response or redirect after the update
        return response()->json(['success' => 'update successfully']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Gram record by ID
        $gram = RegisterToGram::find($id);
        
        if ($gram) {
       
            // Get all files related to the Gram record
        $files = File::where('register_to_gram_id', $gram->id)->get();

       
        // Check if there are any files to delete
        if ($files->isNotEmpty()) {
            // Use the S3 disk
            $disk = Storage::disk('s3');

            foreach ($files as $file) {
                // Check if the file exists in S3
                if ($disk->exists($file->path)) {
                    // Delete the file from S3
                    $disk->delete($file->path);
                }

                // Optionally, delete the file record from the database
                $file->delete();
            }
        }
          
            // Delete the Gram record
            $gram->delete();
    
            return response()->json(['message' => 'Gram and associated files deleted successfully']);
        }
    
        return response()->json(['message' => 'Gram not found'], 404);
    }
    
}
