<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Student Living Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            width: 210mm; /* A4 width */
            height: 277mm; /* A4 height */
            margin: 0 auto;
            padding: 20px;
            /*border: 1px solid #000;*/
            box-sizing: border-box;
        }
        .watermark {
    position: absolute;
    top: 30%;
    left: 45%;
    transform: translate(-50%, -50%);
    font-size: 60px;
    color: rgba(0, 0, 0, 0.2); 
    white-space: nowrap;
    z-index: -1;
    font-weight: 400;
    text-transform: uppercase;
    pointer-events: none;
    user-select: none;
    rotate: -35deg; 
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
        .header h1 {
            font-size: 35px;
            margin: 0;
            /* text-align: center; */
            flex: 1;
            /* border-bottom: 1px solid #000; */
            font-weight: 800;
            height: 50px;
             border-bottom: 1px solid;
        }
        .header-bottom {
              position: absolute;
                bottom: 0px;
                left: 68px;
                width: 100%;
                text-align: center;
                font-size: 17px;
           
        }
        .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        }
        .table {
            width: 49%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 2px solid #000;
               padding: 5px;
                font-size: 16px;
               text-align: right;
               font-weight: 550;
        }
        .table th {
           
            text-align: right;
            color:#fff;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            /* margin-top: 30px; */
            position: relative;
        }
        .signature div {
            text-align: center;
            font-size: 15px;
            width: 92%;
            font-weight: 600;
        }
        .signature img {
            position: absolute;
            top: -40px;
            height: 50px;
            /* left: calc(10% - 25px); */
            
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
        }
        .header-bottom span{
            padding: 0px 60px;
        }
        .signature-container {
    text-align: center;
    display: inline-block;
    margin: 10px;
}

.signature-box {
    position: relative;
    width: 100px; /* Adjust size as needed */
    height: 60px; /* Adjust size as needed */
    background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqYKWYDtF_ovKm10S7y-rxdOaY1cuj3JD-sQ&s') no-repeat center center;
    background-size: contain;
    display: flex;
    justify-content: center;
    align-items: center;
}

.text-overlay {
    position: absolute;
   
    color: black;
    font-weight: bold;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.class-text {
    font-size: 12px;
    margin: 2px 0;
    text-align: center;
}

.teacher-name {
    font-size: 10px;
    margin: 2px 0;
    text-align: left !important;

}

.date {
    font-size: 12px;
    margin: 2px 0;
    text-align: left !important;
    margin-right: 0px;
}

.small-icon {
    width: 30px; /* Adjust the small image size */
    height: auto;
    margin-top: 3px;
}

.signature-text {
    margin-top: 5px;
    font-weight: bold;
    font-size: 14px;
}

.class-text{
     text-align: center;
}
.teacher-name .date{
    text-align: left;
}
.custom-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    /* width: 105px; */
    padding: 0px;
    background-color: #fff;
    color: black;
    border: 1px sloid #3F51B5;
    /* border-radius: 5px; */
    position: relative;
    text-align: center;
    margin: 5px 30px;
    
}
.custom-btn span .i {
    font-size: 10px;
    margin-right: 5px;
    background: #3F51B5;
    padding: 1px;
    color: #fff;

}
.custom-btn span .p {
    flex-grow: 1;
    text-align: center;
    /* border-left: 1px solid #000; */
    padding-left: 5px;
    font-size: 10px;
}
.top-header {
            background-color: #d7edea;
            padding: 5px;
            text-align: right;
            font-weight: 400;
  top: 0;
        }
        .footer {
            background-color: #d7edea;;
            padding: 5px;
            display: flex;
            justify-content: space-between;
            font-weight:400;
            bottom: 0;
       
        }


    </style>
</head>
<body>
    <div class="container">
       <div class="top-header" style="font-size:20px">
            Certificate Number -  {{ $lc->certificate_no }} 
        </div><br>
        <div class="watermark">Certificate Number - {{ $lc->certificate_no }} </div>
        <div class="header">
         <img src="{{$lc->grams->school_logo}}" alt="School Logo" style="width: 100px; height: 94px; border-radius: 50%; object-fit: cover;">

            <h1>STUDENT LIVING CERTIFICATE</h1>
            <!-- <p style="text-align: right;">Certificate Number - 0001</p> -->
            <div class="header-bottom">
                <p>Date of Certificate Issued- {{ $lc->certificate_date }}    <span>Month-  {{ $lc->certificate_month }}     </span> <span>Year- {{ $lc->certificate_year }}    </span></p>
            </div>
        </div>


      

        <div class="table-container">
            <table class="table">
                <tr style="background-color: rgb(31, 31, 129);">
                    <th style = "font-weight: bold;">SR</th>
                    <th style = "font-weight: bold;">SCHOOL DETAILS</th>
                    <th style = "font-weight: bold;">DETAILS</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td style = "font-weight: bold;">School Name</td>
                    <td>{{ $lc->grams->gram_name }}</td>
                </tr>
                <tr>
                    <td>02</td>
                    <td style = "font-weight: bold;">School Address</td>
                    <td>{{ $lc->grams->address }}</td>
                </tr>
                <tr>
                    <td>03</td>
                    <td style = "font-weight: bold;">Taluka</td>
                    <td>{{ $lc->grams->taluka }}</td>
                </tr>
                <tr>
                    <td>04</td>
                    <td style = "font-weight: bold;">District</td>
                    <td>{{ $lc->grams->district }}</td>
                </tr>
                <tr>
                    <td>05</td>
                    <td style = "font-weight: bold;">School Board</td>
                    <td>{{ $lc->grams->school_board }}</td>
                </tr>
                <tr>
                    <td>06</td>
                    <td style = "font-weight: bold;">School Management</td>      
                    <td>{{ $lc->grams->school_management }}</td>
                </tr>
                <tr>
                    <td>07</td>
                    <td style = "font-weight: bold;">School UDASH Number</td>
                    <td>{{ $lc->grams->school_udash_no }}</td>
                </tr>
                <tr>
                    <td>08</td>
                    <td style = "font-weight: bold;">School Grant Number</td>
                    <td>{{ $lc->grams->school_gram_no }}</td>
                </tr>
            </table>

            <table class="table">
                <tr style="background-color: rgb(18, 18, 114);">
                      <th style = "font-weight: bold;">SR</th>
                    <th style = "font-weight: bold;">SCHOOL DETAILS</th>
                    <th style = "font-weight: bold;">DETAILS</th>
                </tr>
                <tr>
                    <td>09</td>
                    <td style = "font-weight: bold;">General Register SR Number</td>
                    <td>001</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td style = "font-weight: bold;">General Register Number</td>
                    <td>56789</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td style = "font-weight: bold;">School Level/Medium</td>
                    <td>{{ $lc->grams->school_level }}</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td style = "font-weight: bold;">Student ID</td>
                    <td>{{ $lc->student_id }}</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td style = "font-weight: bold;">UID/Aadhar Number</td>
                    <td>{{ $lc->adhar_number }}</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td style = "font-weight: bold;">Certificate Number</td>
                    <td> {{ $lc->certificate_no }}</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td style = "font-weight: bold;">School Gmail</td>
                    <td>{{ $lc->grams->school_gmail }}</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td style = "font-weight: bold;">School Contacts</td>
                    <td>{{ $lc->grams->school_contact_no }}</td>
                </tr>
            </table>

            <table class="table">
                <tr style="background-color: rgb(231, 143, 96);">
                  <th style = "font-weight: bold;">SR</th>
                    <th style = "font-weight: bold;">SCHOOL DETAILS</th>
                    <th style = "font-weight: bold;">DETAILS</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td style = "font-weight: bold;">Student First Name</td>
                    <td>{{ $lc->student_first_name }}</td>
                </tr>
                <tr>
                    <td>02</td>
                    <td style = "font-weight: bold;">Student Middle Name</td>
                    <td>{{ $lc->student_middle_name }}</td>
                </tr>
                <tr>
                    <td>03</td>
                    <td style = "font-weight: bold;">Student Last Name</td>
                    <td>{{ $lc->student_last_name }}</td>
                </tr>
                <tr>
                    <td>04</td>
                    <td style = "font-weight: bold;">Mother's Name</td>
                    <td>{{ $lc->mother_name }}</td>
                </tr>
                <tr>
                    <td>05</td>
                    <td style = "font-weight: bold;">Nationality</td>
                    <td>{{ $lc->nationality }}</td>
                </tr>
                <tr>
                    <td>06</td>
                    <td style = "font-weight: bold;">Mother Tongue</td>
                    <td>{{ $lc->mother_tongue }}</td>
                </tr>
                <tr>
                    <td>07</td>
                    <td style = "font-weight: bold;">Religion</td>
                    <td>{{ $lc->religion }}</td>
                </tr>
                <tr>
                    <td>08</td>
                    <td style = "font-weight: bold;">Caste</td>
                    <td>{{ $lc->caste }}</td>
                </tr>
                <tr>
                    <td>09</td>
                    <td style = "font-weight: bold;">SUB-CASTE</td>
                    <td>{{ $lc->sub_caste }}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td style = "font-weight: bold;">Birth Place</td>
                    <td>{{ $lc->birth_place }}</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td style = "font-weight: bold;">Birth Place Taluka</td>
                    <td>{{ $lc->birth_place_taluka }}</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td style = "font-weight: bold;">Birth place District</td>
                    <td>{{ $lc->birth_place_dist }}</td>
                </tr>
               
            </table>

            <table class="table">
                <tr style="background-color: rgb(231, 143, 96);">
                      <th style = "font-weight: bold;">SR</th>
                    <th style = "font-weight: bold;">SCHOOL DETAILS</th>
                    <th style = "font-weight: bold;">DETAILS</th>
                </tr>
                <tr>
                    <td>13</td>
                    <td style = "font-weight: bold;">Birth Place State</td>
                    <td>{{ $lc->birth_place_state }}</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td style = "font-weight: bold;">Birth Place Country</td>
                    <td>{{ $lc->birth_place_country }}</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td style = "font-weight: bold;">Date of Birth</td>
                    <td>{{ $lc->dob }}</td>
                </tr>
                 <tr>
                    <td>16</td>
                    <td style = "font-weight: bold;">Date of Birth(Text)</td>
                    <td>{{ $lc->birth_in_text }}</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td style = "font-weight: bold;">Previous School</td>
                    <td>{{ $lc->previous_school }}</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td style = "font-weight: bold;">Standard</td>
                    <td>{{ $lc->standard }}</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td style = "font-weight: bold;">Date of Admission</td>
                    <td>{{ $lc->date_of_admission }}</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td style = "font-weight: bold;">Academic Progress</td>
                    <td>{{ $lc->academic_progress }}</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td style = "font-weight: bold;">Behavior</td>
                    <td>{{ $lc->behavior }}</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td style = "font-weight: bold;">Date of Leaving School</td>
                    <td>{{ $lc->date_of_leaving_school }}</td>
                </tr>
               
                <tr>
                    <td>23</td>
                    <td style = "font-weight: bold;">Any other studies attended and
                        since</td>
                    <td>NA</td>
                </tr>
                <tr>
                    <td>24</td>
                    <td style = "font-weight: bold;">Reason for Leaving School</td>
                    <td>{{ $lc->reason_for_leaving_school }}</td>
                </tr>
                <tr>
                    <td>25</td>
                    <td style = "font-weight: bold;">Comments (शेरा )</td>
                    <td>{{ $lc->comments }}</td>
                </tr>
            </table>
        </div>

        <div class="signature">
            <div class="signature-container">
                <div class="signature-box">
                    <div class="text-overlay">
                        <p class="class-text">Class 10TH</p>
                        <p class="teacher-name">Tanushri</p>
                        <p class="date">1/30/25 12:10</p>
                    </div>         
                </div>
                <button class="custom-btn">
                  
                    <span class="i" style="background: #3F51B5;color: #fff; padding: 0px 2px; ">100%</span>
                    <span class="p" style="font-size: 10px;">GUARANTEE</span>
                </button>
                <p class="signature-text">CLASS TEACHER SIGNATURE</p>
            </div>
            <div class="signature-container">
                <div class="signature-box">
                    <div class="text-overlay">
                        <p class="class-text">Class 12TH</p>
                        <p class="teacher-name">Yogesh</p>
                        <p class="date">1-30-25 12:10:23 </p>
                    </div>         
                </div>
                <button class="custom-btn">
                  
                    <span class="i" style="background: #3F51B5;color: #fff; padding: 0px 2px; ">100%</span>
                    <span class="p" style="font-size: 10px;">GUARANTEE</span>
                </button>
                <p class="signature-text">CERTIFICATE WRITER SIGNATURE</p>
            </div>
            <div class="signature-container">
                <div class="signature-box">
                    <div class="text-overlay">
                        <p class="class-text">PRINCIPAL</p>
                        <p class="teacher-name">Tarun Kumar</p>
                        <p class="date">1/30/25 12:10:22 </p>
                    </div>         
                </div>
                <button class="custom-btn">
                  
                    <span class="i" style="background: #3F51B5;color: #fff; padding: 0px 2px; ">100%</span>
                    <span class="p" style="font-size: 10px;">GUARANTEE</span>
                </button>
                <p class="signature-text">SCHOOL PRINCIPAL SIGNATURE</p>
            </div>
            <div class="signature-container">   
                   
              
                <p class="signature-text"  style="margin-top: 90px;">SCHOOL STAMP</p>
            </div>
        </div>
         <div class="footer">
            <div style="font-size:16px"> {{ now()->format('d-m-Y H:i:s') }}</div>
            <div style="font-size:16px">Certificate Number -  {{ $lc->certificate_no }} </div>
        </div>
    </div>
</body>
</html>