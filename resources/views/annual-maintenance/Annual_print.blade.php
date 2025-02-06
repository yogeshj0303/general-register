<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annual Maintenance Report</title>
    <style>
     @page {
            margin-top: 10px; /* Adjust top margin to make space for the header */
            margin-bottom: 20px; /* Adjust bottom margin to make space for footer */
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
            width: 90%;
            margin: 10px auto;
            /*padding: 10px;*/
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Added to manage z-index */
            height:auto;
        }
        .page-title {
            text-align: center;
            margin-bottom: 15px;
            font-size: 22px;
            font-weight: bold;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin: 20px auto; /* Centered table */
            z-index: 5; /* Table should be above images */
            position: relative; /* Ensures table stays above images */
        }
        .info-table th {
            background-color: #2874a6;
            color: white;
            padding: 10px;
            text-align: left;
        }
        .info-table, .info-table th, .info-table td {
            border: 1px solid black;
        }
        .info-table td {
            padding: 10px;
            text-align: left;
        }
        .top-image, .bottom-image {
            text-align: center;
            margin: 5px 0;
            position: relative;
        }
        .top-image img{
            max-width: 126%;
            height: auto;
            margin-top:10px  !important;
        }

.bottom-image img {
    position: fixed; /* Fixes the image to the bottom of the viewport */
    bottom: 0; /* Ensures it stays at the very bottom */
    left: -100px; /* Aligns it to the left edge */
    width: 113%; /* Makes the image span the full width of the viewport */
    height: 150px; /* Keeps the specified height */
    
    margin: 40; /* Removes any extra margins */
    padding: 0; /* Removes padding to avoid gaps */
    z-index: 10; /* Ensures it is above other content if needed */
}

        .single-header th {
            background-color: #f1c40f;
            color: black;
            text-align: center;
            font-size: 16px;
        }
           /* Adjust column widths for second table */
        /*.info-table.single-header tbody tr td:first-child {*/
        /*    width: 48%;*/
        /*}*/
        /*.info-table.single-header tbody tr td:last-child {*/
        /*    width: 50%;*/
        /*}*/
        /**/
                   /* Adjust column widths for second table */
        .info-table.single-header tbody tr td:first-child {
            width: 49%;
        }
        .info-table.single-header tbody tr td:last-child {
            width: 51%;
        }
        
        /**/
        /* Adjust column widths for the first table */
.info-table tbody tr td:nth-child(2) {
    width: 45%; /* Second column */
}
.info-table tbody tr td:nth-child(3) {
    width: 60%; /* Third column */
}

        /**/
        /**/
        /* Print styles */
        @media print {
            body, .container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            .container {
                page-break-inside: avoid;
            }
            .info-table {
                width: 90%;
                border: 1px solid black;
            }
            .info-table th {
                background-color: #2874a6 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .info-table td {
                border-left: 1px solid black;
            }
            .single-header th {
                background-color: #f1c40f !important;
                color: black;
                text-align: center;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
 <div class=""  style="margin-top:-10px; font-size:13px">
        <span style=margin-left:20px>Export Date And Time : {{ $exportDate }}</span> 
        <span class="right" style="margin-left:100px">{{ $currentUrl }}</span>

    </div>
        <!-- Top Image -->
        <div class="top-image">
            <img src="{{ public_path('build/images/header.png')}}" alt="Top Image">
        </div>
  
        <!-- Invoice Header -->
        <div style="padding: 10px 10px;">
            <div style="font-size: 20px; font-weight: bold; text-align: center; margin-top:-10px; font-family: 'Source Sans Pro', sans-serif;" >
                Invoice No. {{$record->invoice_no}}
            </div>
            <div style="display: flex; font-size: 12px; float:right; ">
                   <div style="margin-right: -20px;">
                       <!--<div style="margin-bottom: 15px; margin-right:25px; color: #333;font-size:15px; font-family: 'Source Sans Pro', sans-serif;"><b>Quotation Date</b> - {{$record->quatation_date}}</div>-->
                        <div style="margin-bottom: 7px; color:#333; font-size:15px; font-family: 'Source Sans Pro', sans-serif;">
                               <b>Bill Date</b>: {{ \Carbon\Carbon::parse($record->bill_date)->format('d-m-y') }}
                          </div>

                        <!--<div style="margin-bottom: color: green; 7px;color: #333; font-size:15px; font-family: 'Source Sans Pro', sans-serif;"><b>Reference Billing No.</b> {{$record->reference_number}}</div>-->
                        <div style="color: #155402; font-weight: bold; font-size:15px; font-family: 'Source Sans Pro', sans-serif; margin-bottom:7px "><b>Reference Billing No.</b> {{$record->reference_number}}</div>
                    </div>
                </div>
        </div>

        <!-- Invoice To Section -->
        <div style="padding: 10px 20px; font-size: 14px; text-align: left; margin-top:-100px; margin-left:-20px">
            <div>
                <span style=" font-size: 24px;  font-family: 'Source Sans Pro', sans-serif;">Invoice to:</span>
                </br>
                <span style=" font-size: 28px; color: #7b1fa2; font-weight: bold font-family: 'Source Sans Pro', sans-serif , 'noto-sans-devanagari';">{{$record->gram}}</span>
            </div>
            <div style="font-size: 14px; color: #333; margin-top: 5px; font-family: 'Source Sans Pro', sans-serif , 'noto-sans-devanagari';">
                Tal- {{$record->taluka}} Dist-{{$record->district}}.
            </div>
        </div>
        
        

        <!-- First Table -->
        <table class="info-table" style="margin-top:-5px">
            <thead>
                <tr>
                    <th>SR</th>
 <th colspan="2" style="position: relative;">
    <span style="position: absolute; left: 50%; transform: translateX(-50%); margin-top:-5px;margin-left:-35px">DETAILS</span>
</th>

                    
                </tr>
            </thead>
            <tbody>
                @php $rowNumber = 1;
                $getGramCategory = DB::table('register_to_grams')->where('gram',$record->gram)->get();
                @endphp
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Complete Register's Types</td>
                    <td>
                          @if($getGramCategory->isNotEmpty())
                            {{ $getGramCategory->pluck('category')->join(', ') }}
                        @else
                            No categories available
                        @endif
                      </td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Total Population</td>
                    <td>{{ $record->current_population }}</td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>First Time Bill Amount</td>
                    <td>{{ $record->first_time_bill_amount }}</td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Maintenance Amount</td>
                    <td>{{ $record->maintenance_amount }}</td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Next Maintenance Date</td>
                    <td>{{ \Carbon\Carbon::parse($record->next_maintenance_date)->format('d-m-y') }}</td>
                </tr>
                <tr>
                    <td>{{ $rowNumber++ }}</td>
                    <td>Bill Status</td>
                    <td>{{ $record->bill_status }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Second Table -->
        <table class="info-table single-header">
            <thead>
                <tr>
                    <th colspan="2">SCHOOL ANNUAL MAINTENANCE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>First Time Bill Amount</td>
                    <td>{{ $record->first_time_bill_amount }}</td>
                </tr>
                <tr>
                    <td>Received Amount</td>
                    <td>{{ $record->maintenance_amount }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $record->description }}</td>
                </tr>
                <tr>
                    <td>Payment Mode</td>
                    <td>{{ $record->payment_mode }}</td>
                </tr>
            </tbody>
        </table>
           
        <!-- Paid Image -->
        <div class="paid-image" style="text-align:right;margin-top:-140px;z-index:-10;">
            <img src="{{ public_path('build/images/paidlogo.png')}}" alt="Paid Logo" style="max-width: 150px; height: auto;">
        </div>

        <!-- Bottom Image -->
        <div class="bottom-image" style="margin-top:0px; position:relative;">
            <img src="{{ public_path('build/images/footer.png')}}" alt="Bottom Image">
          
    <!-- Text positioned over the image -->
    <p style="
        position: absolute; 
        top: 80px; 
        left: 50%; 
        transform: translateX(-50%); 
        margin: 0; 
        color: #333; 
        font-size: 14px; 
        font-weight: bold; 
        text-align: center; 
        z-index: 10; /* Ensures text stays above the image */
        width: 100%;">
        <span style="font-weight: bold; font-size: 26px; margin-left:-500px">Thank's...</span>
        <br>
        This is an electronically generated document, no signature is required.
    </p>
        </div>

    </div>
</body>
</html> 
