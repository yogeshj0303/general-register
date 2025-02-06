<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Bonafid Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
                -webkit-print-color-adjust: exact; /* For Chrome and Safari */
                print-color-adjust: exact; /* For other browsers */
        }
        
        td{
            font-size:20px;
        }

      
        .header {
            display: flex; 
            /* align-items: center; */
            /* justify-content: space-between; */
            gap: 30px;
            margin-bottom: 20px;
            position: relative;
        }
        .header img {
            height: 80px;
            width: 110px;
        }
        .container {
            width: 210mm;
            height: 277mm;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;

        }
        .table-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
             margin-top:10px;
        }
        .table {
            width: 49%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 2px solid #000;
            padding: 8px;
            font-size: 14px;
            text-align: right;
            font-weight: 550;
        }
        .table th {
            color: #fff;
        }
        
        /**/
                .wrapper {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin: auto;
            padding: 0px;

        }
        .column-left, .column-right {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .item {
            padding: 1px;
            font-weight:600;
            text-align: left;
            font-size:20px;


        }
        
        
        /* Print-specific CSS */
        @media print {
            .content {
                background-image: url('https://your-checkmark-image-url.com/check.png'); /* Replace with your checkmark image URL */
                background-size: cover;
                background-position: center;
                width: 150px;
                height: 100px;
            }
            
       

            .content div {
                color: black; /* Adjust text color if needed */
            }
        }
   
    </style>
</head>
<body>
    <div class="container">   
    <!-- Box with Two Lines -->
    <div style="border: 1px solid #000; padding: 5px; margin-top: 10px; text-align: center; margin-bottom:5px; ">
        <!-- First Line (School Name) -->
        <p style=" font-size: 18px; font-weight: 500; margin: 0;">No change in any entry is to be made except by the authority issuing the leaving certificate that infrigement of this rule will be punished with rustication .</p>

    </div>

<div class="header">
    <!-- School Logo -->
    <img src="{{$bonafid->gram->school_logo}}" alt="School Logo" style="width: 120px; height: 124px; border-radius: 50%; object-fit: cover;">

    <!-- School Name Above -->


    <!-- Gram Name Box Under School Name -->
    <div style="padding: 10px; margin-top: 0px; text-align: center;width:100%;">
            <h6 style=" font-size: 18px; font-weight: bold; margin-top: -10px; margin-left:-40px">{{$bonafid->gram->school_management}}</h6>
        <p style="font-size: 30px; font-weight: bold; margin-top: -40px; width: 96%; border-bottom: 1px solid black; margin-left:-10px">{{$bonafid->gram->gram_name}}</p>
                <p style="margin-top:-20px; margin-right:40px; font-size: 22px">{{$bonafid->gram->address}}</p>
    </div>
</div>

           


    
    
<div style="font-size: 22px; margin-top: -40px; display: flex; flex-wrap: wrap; justify-content: center; text-align: center;margin-left:36px;">

    <p style="margin: 0 15px;">Dist:- {{$bonafid->gram->district}}</p>
    <p style="margin: 0 15px; margin-top:-3px">Taluka:- {{$bonafid->gram->taluka}}</p>
    <p style="margin: 0 15px;">Pincode:- {{$bonafid->gram->pin_code}}</p>
</br>
    <p style="margin: 0 15px; width: 100%; margin-top:10px; margin-left:40px">Email Id :- {{$bonafid->gram->school_gmail}}</p>
</div>





    <h2 style= " margin-left:290px; font-size:25px;" >BONAFID CERTIFICATE</h2>

    <div class="wrapper">
        <div class="column-left">
            <div class="item">Board Kolhapur No. :- j22.07.009</div>
            <div class="item">Rrgd. No of Student :- {{$bonafid->general_register_number}}  </div>
            <div class="item">Student Id :-  00000{{$bonafid->id}} </div>
        </div>
        <div class="column-right">
            <div class="item">UDASH NO.- {{$bonafid->gram->school_udash_no}}</div>
            <div class="item">SR No.:- 57</div>
            <div class="item">U.I.D NO.:- {{$bonafid->general_register_number}}</div>
        </div>
    </div>
        <!---->
        <table style="width: 100%; border: 2px solid black; border-collapse: collapse; margin-top:10px">
            <tbody>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">1</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Student Name</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->student_name}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">2</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>General Register Number</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->general_register_number}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">3</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Religion (धर्म)</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->religion}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">4</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Caste (जात)</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->caste}}l</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">5</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Date of Birth</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->dob}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">6</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Date of Birth (Text)</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->birth_in_text}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">7</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Birth Place (Village/City)</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->birth_place}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">8</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Birth Place Taluka</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->birth_place_taluka}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">9</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Birth Place District</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->birth_place_dist}}</td></tr>
                <tr><td style="width: 4%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">10</td><td style="width: 45%; padding: 12px; text-align: left; border: 2px solid black;"><strong>Date of Certificate Issued</strong></td><td style="width: 50%; padding: 12px; text-align: left; border: 2px solid black; font-weight:550">{{$bonafid->certificate_issued_date}}</td></tr>
            </tbody>
        </table>
        <p style="text-align:center; font-weight:550; margin-top:5px">Certified that the above information is in accordance with the School Register.</p>
<div style="display: flex; margin-left: 600px; text-align: center; margin-top: 50px; position: relative; background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_9CR_BW88VEq4krqc5O3-73LO7AH2i1Dm4g&s'); background-size: cover; background-position: center; width: 100px; height: 70px;">
    <div style="width: 100%; text-align: center; padding: 15px; font-family: Arial, sans-serif; position: absolute; top: 50%; transform: translateY(-50%); color: white;">
       
        <p style="font-size: 16px; font-weight: bold;  margin-top:5px; color:#333">Shilla Misra</p>
        <p style="font-size: 16px; font-weight: bold; margin-top:5px; color:#333; width:max-content;">03-02-2025:12:00</p>
        <p style="font-size: 16px; font-weight: bold; margin-top:5px; color:#333">Principal</p>
    </div>
</div>





    </div>
</body>
</html>
