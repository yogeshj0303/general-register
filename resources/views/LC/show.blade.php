@extends('layouts.master')
@section('title')
    @lang('translation.update-user')
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View LC</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        
                                                    <div class="row gy-4">
                                                        
                                                   <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" value="{{ $lc->state }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="district" class="form-label">District</label>
            <input type="text" class="form-control" id="district" value="{{ $lc->district }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="taluka" class="form-label">Taluka</label>
            <input type="text" class="form-control" id="taluka" value="{{ $lc->taluka }}" readonly>
        </div>
        
        <div class="col-md-4">
            <label for="gram" class="form-label">School</label>
            <input type="text" class="form-control" id="gram" value="{{ $lc->grams->gram_name }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="number" class="form-control" id="student_id" value="{{ $lc->student_id }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="adhar_number" class="form-label">Udash UID Number (Aadhar Number)</label>
            <input type="number" class="form-control" id="adhar_number" value="{{ $lc->adhar_number }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_first_name" class="form-label">Student First Name</label>
            <input type="text" class="form-control" id="student_first_name" value="{{ $lc->student_first_name }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_middle_name" class="form-label">Student Middle Name</label>
            <input type="text" class="form-control" id="student_middle_name" value="{{ $lc->student_middle_name }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_last_name" class="form-label">Student Last Name</label>
            <input type="text" class="form-control" id="student_last_name" value="{{ $lc->student_last_name }}" readonly>
        </div>
        
         <div class="col-md-4">
            <label for="mother_name" class="form-label">Mother's Name</label>
            <input type="text" class="form-control" id="mother_name" value="{{ $lc->mother_name }}" readonly>
        </div>

        <!-- Nationality -->
        <div class="col-md-4">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" id="nationality" value="{{ $lc->nationality }}" readonly>
        </div>

        <!-- Mother Tongue -->
        <div class="col-md-4">
            <label for="mother_tongue" class="form-label">Mother Tongue (मातृभाषा)</label>
            <input type="text" class="form-control" id="mother_tongue" value="{{ $lc->mother_tongue }}" readonly>
        </div>

        <!-- Religion -->
        <div class="col-md-4">
            <label for="religion" class="form-label">Religion (धर्म)</label>
            <input type="text" class="form-control" id="religion" value="{{ $lc->religion }}" readonly>
        </div>

        <!-- Caste -->
        <div class="col-md-4">
            <label for="caste" class="form-label">Caste (जात)</label>
            <input type="text" class="form-control" id="caste" value="{{ $lc->caste }}" readonly>
        </div>

        <!-- Sub-caste -->
        <div class="col-md-4">
            <label for="sub_caste" class="form-label">Sub-caste (पोट जात)</label>
            <input type="text" class="form-control" id="sub_caste" value="{{ $lc->sub_caste }}" readonly>
        </div>

        <!-- Birth Place -->
        <div class="col-md-4">
            <label for="birth_place" class="form-label">Birth Place (Village/City)</label>
            <input type="text" class="form-control" id="birth_place" value="{{ $lc->birth_place }}" readonly>
        </div>

        <!-- Birth Place Taluka -->
        <div class="col-md-4">
            <label for="birth_place_taluka" class="form-label">Birth Place Taluka</label>
            <input type="text" class="form-control" id="birth_place_taluka" value="{{ $lc->birth_place_taluka }}" readonly>
        </div>
        
         <div class="col-md-4">
            <label for="birth_place_dist" class="form-label">Birth Place District</label>
            <input type="text" class="form-control" id="birth_place_dist" value="{{ $lc->birth_place_dist }}" readonly>
        </div>

        <!-- Birth Place State -->
        <div class="col-md-4">
            <label for="birth_place_state" class="form-label">Birth Place State</label>
            <input type="text" class="form-control" id="birth_place_state" value="{{ $lc->birth_place_state }}" readonly>
        </div>

        <!-- Birth Place Country -->
        <div class="col-md-4">
            <label for="birth_place_country" class="form-label">Birth Place Country</label>
            <input type="text" class="form-control" id="birth_place_country" value="{{ $lc->birth_place_country }}" readonly>
        </div>

        <!-- Date of Birth -->
        <div class="col-md-4">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" value="{{ $lc->dob }}" readonly>
        </div>

        <!-- Date of Birth (Text) -->
        <div class="col-md-4">
            <label for="dob_text" class="form-label">Date of Birth (Text)</label>
            <input type="text" class="form-control" id="dob_text" value="{{ $lc->birth_in_text }}" readonly>
        </div>

        <!-- Previous School -->
        <div class="col-md-4">
            <label for="previous_school" class="form-label">Previous School</label>
            <input type="text" class="form-control" id="previous_school" value="{{ $lc->previous_school }}" readonly>
        </div>

        <!-- Standard -->
        <div class="col-md-4">
            <label for="standard" class="form-label">Standard</label>
            <input type="text" class="form-control" id="standard" value="{{ $lc->standard }}" readonly>
        </div>

        <!-- Date of Admission -->
        <div class="col-md-4">
            <label for="date_of_admission" class="form-label">Date of Admission</label>
            <input type="date" class="form-control" id="date_of_admission" value="{{ $lc->date_of_admission }}" readonly>
        </div>
        
      <div class="col-md-4">
    <label for="academic_progress" class="form-label">Academic Progress</label>
    <textarea class="form-control" id="academic_progress" name="academic_progress" readonly>{{ $lc->academic_progress ?? 'Not Provided' }}</textarea>
</div>

<div class="col-md-4">
    <label for="behavior" class="form-label">Behavior</label>
    <textarea class="form-control" id="behavior" name="behavior" readonly>{{ $lc->behavior ?? 'Not Provided' }}</textarea>
</div>

<div class="col-md-4">
    <label for="date_of_leaving_school" class="form-label">Date of Leaving School</label>
    <textarea class="form-control" id="date_of_leaving_school" name="date_of_leaving_school" readonly>{{ $lc->date_of_leaving_school ?? 'Not Provided' }}</textarea>
</div>

<div class="col-md-4">
    <label for="other_studies" class="form-label">Any other studies attended and since (alpha and number)</label>
    <textarea class="form-control" id="other_studies" name="other_studies" readonly>{{ $lc->other_studies ?? 'Not Provided' }}</textarea>
</div>

<div class="col-md-4">
    <label for="reason_for_leaving_school" class="form-label">Reason for Leaving School</label>
    <textarea class="form-control" id="reason_for_leaving_school" name="reason_for_leaving_school" readonly>{{ $lc->reason_for_leaving_school ?? 'Not Provided' }}</textarea>
</div>

<div class="col-md-4">
    <label for="comments" class="form-label">Comments (शेरा)</label>
    <textarea class="form-control" id="comments" name="comments" readonly>{{ $lc->comments ?? 'Not Provided' }}</textarea>
</div>


<!-- Row 12 -->
<div class="col-md-4">
    <label for="certificate_date" class="form-label">Date of Certificate Issued</label>
    <input type="text" class="form-control" id="certificate_date" name="certificate_date" value="{{ $lc->certificate_date ?? 'Not Provided' }}" readonly>
</div>

<div class="col-md-4">
    <label for="certificate_month" class="form-label">Month of Certificate</label>
    <input type="text" class="form-control" id="certificate_month" name="certificate_month" value="{{ $lc->certificate_month ? date('F', mktime(0, 0, 0, $lc->certificate_month, 10)) : 'Not Provided' }}" readonly>
</div>

<div class="col-md-4">
    <label for="certificate_year" class="form-label">Year of Certificate</label>
    <input type="text" class="form-control" id="certificate_year" name="certificate_year" value="{{ $lc->certificate_year ?? 'Not Provided' }}" readonly>
</div>
                                                  
       <div class="row mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('lc.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                               
                            </div>                                                  
                                                        
                                                        

</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
    
@endsection
