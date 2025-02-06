<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Annual Taxation/ Water Annual Bills REPORT</title>
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
    color: #333;
    display: flex; /* Enables flexbox layout */
    justify-content: center; /* Centers the container horizontally */
    align-items: flex-start; /* Aligns the container at the top */
    min-height: 100vh; /* Ensures body takes full height for proper alignment */
}

.container {
    width: 96%;
    max-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}


.header-info {
    padding: 5px;
    background-color: #224C98; /* Visible for both print and screen */
    color: white;
    text-align: center;
    margin-top: 20px;
    width:90%;
    margin-left:30px;
}

.header-info h1 {
    margin: 0;
    font-size: 30px;
}

.page-title {
    text-align: center;
    margin: 20px 0;
    font-size: 22px;
    color: #333;
}

.info-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    margin-top: 0px;
}

.info-table th, .info-table td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}

.print-group {
    margin-bottom: 20px;
    page-break-inside: avoid; /* Ensures print groups stay together */
}

/* Ensure screen and print styles overlap */
@media print {
    .container {
        
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                font-size: 12px;
            }

    body {
            font-family: Arial, sans-serif ,  'Noto Sans Devanagari', 'Noto Sans Tamil';

        background-color: white;
    }

    .print-group {
        margin-bottom: 20px;
    }

    .info-table th, .info-table td {
        border: 1px solid black;
    }
}

    </style>
</head>
<body>
    
            <div class=""  style="margin-top:-30px; font-size:13px">
        <span>Export Date And Time : {{ $exportDate }}</span> 
        <span class="right" style="margin-left:100px">{{ $currentUrl }}</span>

    </div>

    
    <div class="container">
       
        <div class="print-group">
         
            <div class="header-info">
                <h1 class="username" style="font-family: 'noto-sans-devanagari';">{{ $data->gram }}</h1>
<p style="font-size: 1.2rem; line-height: 1.8; text-align: center;">
    <strong style="margin-right: 10px; color: #fff;">State:-</strong> {{ $data->state }}
    <strong style="margin: 0 10px; color: #fff;">District:-</strong> {{ $data->district }}
    <strong style="margin-left: 10px; color: #fff;">Taluka:-</strong> {{ $data->taluka }}
</p>

            </div>

            @if($data->type == 'gharpatti')
            <h1 class="page-title">Property Annual Taxation</h1>
            @else
            <h1 class="page-title">Water Annual Taxation</h1>
            @endif

            <table class="info-table">
                <thead style="background-color: #2874a6; color: white;">
                    <tr>
                        <th style="width: 3%;">SR</th>
                        <th style="width: 48%;">HEADERS</th>
                        <th style="width: 49%;">DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rowNumber = 1; @endphp
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Profile Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Type</td>
                        <td>@if($data->type == 'gharpatti') Property Annual Taxation @else Water Annual Taxation @endif</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Annual Amount</td>
                        <td>{{ $data->amount_type }}</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Paid Type</td>
                        <td>{{ $data->paid_type }}</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Paid Amount</td>
                        <td>{{ $data->paid_amount }}</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Paid Date</td>
                        <td>{{ $data->paid_date }}</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>Remaining Amount</td>
                        <td>{{ $data->remaining_amount }}</td>
                    </tr>
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        
                        <td>Previous Year Pending Amount</td>
                        <td>
    @if($data->type == 'gharpatti')
        {{ $gharpattiPending >= 0 ? $gharpattiPending : 0 }}
    @elseif($data->type == 'panipatti')
        {{ $panipattiPending >= 0 ? $panipattiPending : 0 }}
    @endif
</td>

                    </tr>
                </tbody>
            </table>
     
        </div>
     
    </div>
</body>
</html>
