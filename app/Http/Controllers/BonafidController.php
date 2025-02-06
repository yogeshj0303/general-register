<?php

namespace App\Http\Controllers;
use App\Models\Lc;
use App\Models\Gram;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\Bonafid;

use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;


class BonafidController extends Controller
{
    
    
    
    public function getAddress(Request $request)
{
    $schoolId = $request->input('school_id');

    if (!$schoolId) {
        return response()->json([], 400);
    }

    $school = Gram::where('id', $schoolId)->first();
    

    if (!$school) {
        return response()->json([], 404);
    }

    return response()->json([
        'address' => $school->address,
    ]);
}





public function show($id)
{
    $bonafid = Bonafid::with('gram')->find($id);

    return response()->json($bonafid);
}

    public function bonafidprint($id){
                $bonafid = Bonafid::with('gram')->find($id);
                
                        return view('bonafid.print' , compact('bonafid'));


    }    
    
    public function destroy($id)
{
    // Find the record by ID
    $bonafid = Bonafid::findOrFail($id);

    // Delete the record
    $bonafid->delete();

    // Return a success response
    return response()->json(['success' => true]);
}

    
    
    public function create(){
          $filePath = storage_path('data/states_districts.json');
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('bonafid.create' , compact('statesData'));
    }
    
    public function edit($id){
          $filePath = storage_path('data/states_districts.json');
        $statesData = json_decode(file_get_contents($filePath), true);
        $bonafid = Bonafid::findOrFail($id); // Get the record to edit
        return view('bonafid.edit' , compact('statesData' , 'bonafid'));
        
    }
    
    public function index(){
         $bonafids = Bonafid::with('gram')->get(); 
    return view('bonafid.index', compact('bonafids'));
    }
    
    
    
     public function store(Request $request)
    {
       
      
    $request->validate([
        'state' => 'required|string|max:250',
        'district' => 'required|string|max:250',
        'taluka' => 'required|string|max:250',
        'school_name' => 'required|max:250',
        'school_address' => 'required|string|max:250',
        'student_name' => 'required|string|max:250',
        'general_register_number' => 'required|string|max:250',
        'religion' => 'nullable|string|max:250',
        'caste' => 'nullable|string|max:250',
        'dob' => 'required|date',
        'birth_in_text' => 'required|string|max:250',
        'birth_place' => 'required|string|max:250',
        'birth_place_taluka' => 'required|string|max:250',
        'birth_place_dist' => 'required|string|max:250',
        'certificate_issued_date' => 'nullable|date',
    ]);


        // Handle file upload if present
     
        // Create a new Bonafid record
        $bonafid = Bonafid::create([
            'state' => $request->input('state'),
            'district' => $request->input('district'),
            'taluka' => $request->input('taluka'),
            'school_name' => $request->input('school_name'),
            'school_address' => $request->input('school_address'),
            'student_name' => $request->input('student_name'),
            'general_register_number' => $request->input('general_register_number'),
            'religion' => $request->input('religion'),
            'caste' => $request->input('caste'),
            'dob' => $request->input('dob'),
            'birth_in_text' => $request->input('birth_in_text'),
            'birth_place' => $request->input('birth_place'),
            'birth_place_taluka' => $request->input('birth_place_taluka'),
            'birth_place_dist' => $request->input('birth_place_dist'),
            'certificate_issued_date' => $request->input('certificate_issued_date'),
        ]);

        // Redirect back or to another page with success message
        return redirect()->route('bonafid.index')->with('success', 'Bonafid record created successfully!');
    }
    
    public function update(Request $request, $id)
{
    // Find the Bonafid record by ID
    $bonafid = Bonafid::findOrFail($id);

    // Validate the incoming request data
    $request->validate([
        'state' => 'required|string|max:250',
        'district' => 'required|string|max:250',
        'taluka' => 'required|string|max:250',
        'school_name' => 'required|max:250',
        'school_address' => 'required|string|max:250',
        'student_name' => 'required|string|max:250',
        'general_register_number' => 'required|string|max:250',
        'religion' => 'nullable|string|max:250',
        'caste' => 'nullable|string|max:250',
        'dob' => 'required|date',
        'birth_in_text' => 'required|string|max:250',
        'birth_place' => 'required|string|max:250',
        'birth_place_taluka' => 'required|string|max:250',
        'birth_place_dist' => 'required|string|max:250',
        'certificate_issued_date' => 'nullable|date',
    ]);

    $bonafid->update([
        'state' => $request->input('state'),
        'district' => $request->input('district'),
        'taluka' => $request->input('taluka'),
        'school_name' => $request->input('school_name'),
        'school_address' => $request->input('school_address'),
        'student_name' => $request->input('student_name'),
        'general_register_number' => $request->input('general_register_number'),
        'religion' => $request->input('religion'),
        'caste' => $request->input('caste'),
        'dob' => $request->input('dob'),
        'birth_in_text' => $request->input('birth_in_text'),
        'birth_place' => $request->input('birth_place'),
        'birth_place_taluka' => $request->input('birth_place_taluka'),
        'birth_place_dist' => $request->input('birth_place_dist'),
        'certificate_issued_date' => $request->input('certificate_issued_date'),
    ]);

    // Redirect back or to another page with success message
    return redirect()->route('bonafid.index')->with('success', 'Bonafid record updated successfully!');
}

    
    
}