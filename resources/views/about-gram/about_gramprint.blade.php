<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT GRAM REPORT</title>
    
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
            font-family: Arial, Helvetica, sans-serif ,  'noto-sans-devanagari';
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
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
            border-collapse: collapse;
            font-size: 14px;
            margin: 0 auto;
        }
        .info-table, .info-table th, .info-table td {
            border: 1px solid black;
        }
        .info-table th, .info-table td {
            padding: 8px;
            text-align: left;
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

        /* Print styles */
        @media print {
            body, .container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                font-size: 12px;
            }
            .container {
                page-break-inside: avoid;
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
        <span class="right" style="margin-left:100px">{{ $currentUrl }}</span>

    </div>
    
    <div class="container">
        
        <h1 class="page-title">ABOUT GRAM REPORT</h1>
                    <div class="header-info">
                <h1 class="username" style="font-family: 'noto-sans-devanagari';">{{ $user->gram }}  </h1>
<p style="font-size: 1.2rem; line-height: 1.8; text-align: center;">
    <strong style="margin-right: 10px; color: #fff;">State:-</strong> {{ $user->state }}
    <strong style="margin: 0 10px; color: #fff;">District:-</strong> {{ $user->district }}
    <strong style="margin-left: 10px; color: #fff;">Taluka:-</strong> {{ $user->taluka }}
</p>

            </div>


        <table class="info-table" style="margin-top:40px">
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
                    <td>About Gram</td>
                    <td>{{ $user->about_gram }}</td>
                </tr>

               
            </tbody>
        </table>
    </div>
</body>
</html>