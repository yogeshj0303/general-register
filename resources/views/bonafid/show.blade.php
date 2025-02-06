@extends('layouts.master')
@section('title')
    @lang('translation.create-user')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    @endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Bonafid</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
<form>
    @csrf
    @method('PUT')

    <div class="row gy-4">
        <!-- Row 1 -->
        <div class="col-md-4">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" id="state" value="{{ $bonafid->state }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="district" class="form-label">District</label>
            <input type="text" class="form-control" id="district" value="{{ $bonafid->district }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="taluka" class="form-label">Taluka</label>
            <input type="text" class="form-control" id="taluka" value="{{ $bonafid->taluka }}" readonly>
        </div>

        <!-- Row 2 -->
        <div class="col-md-4">
            <label for="school_name" class="form-label">School Name</label>
            <input type="text" class="form-control" id="school_name" value="{{ $bonafid->gram->gram_name }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="school_address" class="form-label">School Address</label>
            <input type="text" class="form-control" id="school_address" value="{{ $bonafid->school_address }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="student_name" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="student_name" value="{{ old('student_name', $bonafid->student_name) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="general_register_number" class="form-label">General Register Number</label>
            <input type="text" class="form-control" id="general_register_number" value="{{ old('general_register_number', $bonafid->general_register_number) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="religion" class="form-label">Religion</label>
            <input type="text" class="form-control" id="religion" value="{{ old('religion', $bonafid->religion) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="caste" class="form-label">Caste</label>
            <input type="text" class="form-control" id="caste" value="{{ old('caste', $bonafid->caste) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="text" class="form-control" id="dob" value="{{ old('dob', $bonafid->dob) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="dob_text" class="form-label">Date of Birth (Text)</label>
            <input type="text" class="form-control" id="dob_text" value="{{ old('birth_in_text', $bonafid->birth_in_text) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="birth_place" class="form-label">Birth Place</label>
            <input type="text" class="form-control" id="birth_place" value="{{ old('birth_place', $bonafid->birth_place) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="birth_place_taluka" class="form-label">Birth Place Taluka</label>
            <input type="text" class="form-control" id="birth_place_taluka" value="{{ old('birth_place_taluka', $bonafid->birth_place_taluka) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="birth_place_dist" class="form-label">Birth Place District</label>
            <input type="text" class="form-control" id="birth_place_dist" value="{{ old('birth_place_dist', $bonafid->birth_place_dist) }}" readonly>
        </div>

        <div class="col-md-4">
            <label for="certificate_issued_date" class="form-label">Date of Certificate Issued</label>
            <input type="text" class="form-control" id="certificate_issued_date" value="{{ old('certificate_issued_date', $bonafid->certificate_issued_date) }}" readonly>
        </div>

        <!-- Add Submit and Back Buttons -->
        <div class="row mt-4">
            <div class="col-md-6 text-start">
                <a href="{{ route('bonafid.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</form>

                        
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
