<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER DETAILS REPORT</title>

    <meta charset="UTF-8">
    <style>
        @page {
            margin-top: 40px; /* Adjust top margin to make space for the header */
            margin-bottom: 50px; /* Adjust bottom margin to make space for footer */
                        size: A4 portrait;

        }
       @font-face {
        font-family: 'noto-sans-devanagari';
        src: url('{{ public_path('fonts/NotoSansDevanagari-Regular.ttf') }}') format('truetype');
     
            font-weight: normal;
            font-style: normal;
        }
        
           
        body {
        font-family:  sans-serif, 'noto-sans-devanagari';
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 10px auto;
            padding: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }
        .page-title {
            text-align: center;
            margin-bottom: 15px;
            font-size: 22px;
            font-weight: bold;
        }
        .info-table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            font-size: 14px;
        }
        .info-table th, .info-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .info-table th {
            background-color: #2874a6;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .header-info {
                        font-family: Arial, Helvetica, sans-serif,'noto-sans-devanagari';

            padding: 5px;
            background-color: #224C98;
            color: white;
            text-align: center;
            margin-top: 20px;
        }
        .header-info h1 {
            margin: 0;
            font-size: 30px;
        }
        .image-section img {
            width: 120px;
            height: 140px;
            object-fit: cover;
            margin-top: 10px;
        }
        .table-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-section .info-table {
            width: 70%;
            margin: 0;
        }
        .table-section .image-section {
            width: 30%;
            text-align: center;
        }
        /* Print styles */
        @media print {
              body {
        font-family:  sans-serif, 'noto-sans-devanagari';
            margin: 0;
            padding: 0;
        }
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                font-size: 12px;
            }
            .info-table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
        <div class=""  style="margin-top:-30px; font-size:13px">
        <span>Export Date And Time : {{ $exportDate }}</span> 
        <span class="right" style="margin-left:200px">{{ $currentUrl }}</span>

        <!--<span class="right" style="margin-left:100px">{{ $presignedUrl }}</span>-->
    </div>
    <div class="container">
        <!-- Header Information -->
        <div class="header-info">
            <h1 style="font-size:29px; font-family: 'noto-sans-devanagari';">{{ $user->gram }}</h1>
<p style="font-size: 1rem; line-height: 1.5;">
    <strong>State:-</strong> <span>{{ $user->state }}</span> 
    <span style="margin-right: 20px;"></span>
    <strong>District:-</strong> <span>{{ $user->district }}</span>
    <span style="margin-right: 20px;"></span>
    <strong>Taluka:-</strong> <span>{{ $user->taluka }}</span>
</p>


        </div>

        <!-- Page Title -->
        <h1 class="page-title">USER DETAILS REPORT</h1>

<!-- User Info Section -->











        <div style="width: 100%; margin: auto; margin-top:0px">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <!-- Table Section -->
            <td style="width: 100%; vertical-align: top;">
                <table class="info-table" style="width: 100%; border-collapse: collapse;">
                    <!-- Table Head -->
                 <!-- Table Head -->
  <thead style="background-color: #2874a6; color: white;">
            <tr>
                <th class="table-header" style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid black; width: 3%;">SR</th>
                <th class="table-header" style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid black; width: 43%;">TITLE</th>
                <th class="table-header" style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid black; width: 54%;">DETAILS</th>
            </tr>
        </thead>           <!-- Table Body -->
        <tbody>
            @php $rowNumber = 1; @endphp
            <tr>
                <td style="padding: 10px; text-align: center; border: 1px solid black;">{{ $rowNumber++ }}</td>
                <td style="padding: 10px; text-align: left; border: 1px solid black;">Profile Name</td>
                <td style="padding: 10px; text-align: left; border: 1px solid black;">{{ $user->name }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; text-align: center; border: 1px solid black;">{{ $rowNumber++ }}</td>
                <td style="padding: 10px; text-align: left; border: 1px solid black;">Contact No</td>
                <td style="padding: 10px; text-align: left; border: 1px solid black;">{{ $user->contact_no }}</td>
            </tr>
                        <tr>
                <td style="padding: 10px; text-align: center; border: 1px solid black;">{{ $rowNumber++ }}</td>
                <td style="padding: 10px; text-align: left; border: 1px solid black;">Gmail</td>
                <td style="padding: 10px; text-align: left; border: 1px solid black;">{{ $user->email }}</td>
            </tr>
        </tbody>
                </table>
            </td>

            <!-- Image Section -->
            <td style="width: 30%; text-align: center; vertical-align: top;">
                 @if($presignedUrl)
            @php
                $imageData = file_get_contents($presignedUrl);
                $base64Image = 'data:image/jpeg;base64,' . base64_encode($imageData);
            @endphp
            <img src="{{ $base64Image }}" alt="Profile Image" style="width: 118px; height: 140px; object-fit: cover; margin-top: 20px;">
        @else
            <img src="{{ public_path('default.jpg') }}" alt="Default Image" style="width: 118px; height: 140px; object-fit: cover; margin-top: 20px;">
        @endif
            </td>
        </tr>
    </table>
</div>


        <!-- Additional Info Section -->
        <h2 style="margin-left:30px; margin-top:-18px">1. Personal</h2>
        <table class="info-table" style="margin-top:0px width:90%">
                 <!-- Table Head -->
    <thead style="background-color: #2874a6; color: white;">
    <tr>
        <th class="table-header" colspan="1" style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid black; width:3%">SR</th>
        <th class="table-header" colspan="1" style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid black; width:33%">TITLE</th>
        <th class="table-header" style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid black; width:64%">DETAILS</th>
    </tr>
    </thead>
            <tbody>
                @php $rowNumber = 1; @endphp
               
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>School Name</td>
                    <td>{{ $user->gram }}</td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>User Type</td>
                    <td>{{ $user->role->role_name }}</td>
                </tr>
               
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Date of Birth</td>
                    <td>{{ $user->dob }}</td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Age</td>
                    <td>{{ $user->age }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
