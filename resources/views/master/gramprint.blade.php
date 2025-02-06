
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Report</title>
  <style>
        
      @page {
        margin-top: 60px; /* Space for header */
        margin-bottom:  0px; /* Space for footer */
        size: A4 portrait;
    }
    
  
 
@font-face {
        font-family: 'noto-sans-devanagari';
        src: url('{{ public_path('fonts/NotoSansDevanagari-Regular.ttf') }}') format('truetype');
     
            font-weight: normal;
            font-style: normal;
        }
        
        
        
        .footer-img {
        width: 113%; /* Ensure the footer image stretches across */
        height: auto; /* Maintain aspect ratio */
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
        
          .after-first-page {
    margin-top: 50px; /* Add margin for tables only after the first page */
  }
    @media print {   
        @page {
            margin-top: 60px; /* Space for header */
            margin-bottom: 40px; /* Space for footer */
            size: A4 portrait;
        }
    .after-first-page {
    margin-top: 50px; /* Add margin for tables only after the first page */
  }
      .container {
        width: 100%;   
        margin: 0;
        padding:0;
      }   
      .header img, .footer img {
        width: 100%;
      }
      .report-table {
        page-break-inside: avoid;
        margin-left: auto;  /* Centering the table */
        margin-right: auto; /* Centering the table */
        padding-left: 5%;    /* Adding space on left */
        padding-right: 5%;   /* Adding space on right */
        width: 88%;         /* Set table width to auto */
      }

      /* Ensure colors are preserved for print */
      .report-table th {
        background-color: #2874a6 !important;
        color: #ffffff !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }

      .report-table td {
        color: #333 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }

    body {

      font-family:  'noto-sans-devanagari' , Arial, sans-serif ;
      margin: 0;
      padding: 0;
      /background-color: #f9f9f9;/
      display: flex;   
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .header, .footer {
      text-align: center;
    }

    .header img{
      width: 113%;
      max-height: 200px;
      object-fit: cover;
      margin-top:-150px;
      /*margin-left:260px;*/
    }
    


    .container {
      max-width: 1000px;
      width: 100%;
      margin: 0;
      border:none;
      padding: 0;
      background-color: #fff;
      height:auto;
    }

    .title {
      font-size: 28px;
      color: #6b3b9a;
      font-weight: bold;
      margin-top: -100px;
      text-align: left;
      margin-left: 60px;
    }
  header {
            position: fixed;
            top: -40px; /* Place it at the top of the page */
            left: 0;
            right: 0;
            height: 30px;
            text-align: left;
            font-size: 13px;
        }
               footer {
        position: fixed;
        bottom: 250px; /* Place it exactly at the bottom */
        left: 0;
        right: 0;
        height: 60px; /* Fixed height for footer */
        text-align: center;
    }


    .marathi {
      font-family: 'Mangal', Arial, sans-serif , 'noto-sans-devanagari';

    }

    .address {
      font-size: 16px;
      color: #333;
      line-height: 1.6;
      text-align: left;
      margin-left: 60px;
      font-weight: 600;
      margin-top: -20px;
    }

    .report-title {
      font-size: 24px;
      font-weight: bolder;
      margin: 20px 0;
      color: black;
      text-transform: uppercase;
      text-align: center;
    }

    .report-table {
      width: 88%;
      margin-left:  auto;
            margin-right:  auto;
                  margin-top:  0px;
                        margin-bottom:  330px;
      border-collapse: collapse;
      background-color: #ffffff;
      text-align: center;  
    }

    .report-table th,
    .report-table td {
      border: 1px solid black; 
      padding: 12px;
    }

    .report-table th {
      background-color: #2874a6;
      color: #ffffff;
      font-size: 16px;
      text-transform: uppercase;
      text-align: center;
    }

    .report-table td {
      font-size: 18px;
      color: #333;
      font-weight: bold;
    }

    .report-table td:first-child {
      text-align: left;
      width: 70%; 
    }

    .report-table td:last-child {
      text-align: center;
      width: 30%; 
    }

    .total-row td {
      font-weight: bold;
      color: #1e8449;
      text-align: left;
    }

    .total-row td:first-child {
      text-align: right; 
    }
  </style>
</head>
<body>
    <header>
        <span>Export Date And Time: {{ $exportDate }}</span> 
        <span style="float: right;">{{ $currentUrl }}</span>
                </header>

  <!-- Content Section -->
   <footer>
        <!-- Footer Image -->
        <img src="{{ public_path('build/images/footer.png') }}" alt="Footer Image" class="footer-img">
    </footer>
          

  <div class="container" style="margin-top:160px">
    <!-- Header Section -->
  <div class="header" style="margin-top:-10px">
      <img src="{{ public_path('build/images/header.png') }}" alt="Header Image">
    </div>

    <h1 class="title"><span style="font-family: 'noto-sans-devanagari';">{{$gram->gram_name}}</span></h1>
    <p class="address">
      Address- {{$gram->address}},<br>
      State- {{$gram->state}}, Dist - {{$gram->district}} Taluka - {{$gram->taluka}}.
    </p>
    <h2 class="report-title">School Report</h2>
    <table class="report-table" style="margin-top:0px" >
      <thead>
        <tr>
          <th>Category Names</th>
          <th>Total Register</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categoryCounts as $category)
          <tr>
            <td style="font-weight:500">{{ $category->category }}</td>
            <td>{{ str_pad($category->count, 2, '0', STR_PAD_LEFT) }}</td>
          </tr>
        @endforeach
        <tr class="total-row">
          <td>Total</td>
          <td style="color:black">{{ str_pad($categoryCounts->sum('count'), 2, '0', STR_PAD_LEFT) }}</td>
        </tr>
      </tbody>
      
      
      

      
      
      
      
      
    </table>
    <!-- Footer Section -->
      <!-- Footer Section -->
   
  </div>
    
</body>
</html>