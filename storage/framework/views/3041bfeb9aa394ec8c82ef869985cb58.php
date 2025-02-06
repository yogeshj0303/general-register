<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRAM BILLS REPORT</title>
    <style>
      @page {
            margin-top: 40px; /* Adjust top margin to make space for the header */
            margin-bottom: 0px; /* Adjust bottom margin to make space for footer */
                        size: A4 portrait;

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





@font-face {
        font-family: 'noto-sans-devanagari';
        src: url('<?php echo e(public_path('fonts/NotoSansDevanagari-Regular.ttf')); ?>') format('truetype');
     
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
            margin: 2px auto;
            /*padding: 20px;*/
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
            margin-top:0px;
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
            margin: 10px 0;
            position: relative;
        }
        .top-image img{
           width: 126%;
            height: auto;
            margin-top:-10px  !important;
        }

        
        .single-header th {
            background-color: #f1c40f;
            color: black;
            text-align: center;
            font-size: 16px;
        }
           /* Adjust column widths for second table */
        .info-table.single-header tbody tr td:first-child {
            width: 48%;
        }
        .info-table.single-header tbody tr td:last-child {
            width: 55%;
        }
        
        /**/
        /* Adjust column widths for the first table */
.info-table tbody tr td:nth-child(2) {
    width: 40%; /* Second column */
}
.info-table tbody tr td:nth-child(3) {
    width: 60%; /* Third column */
}

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
    <div class=""  style="margin-top:-30px; font-size:13px">
        <span style="margin-left:10px">Export Date And Time : <?php echo e($exportDate); ?></span> 
        <span class="right" style="margin-left:150px"><?php echo e($currentUrl); ?></span>

    </div>
    <div class="container">

        <!-- Top Image -->
        <div class="top-image">
            <img src="<?php echo e(public_path('build/images/header.png')); ?>" alt="Top Image">
        </div>
  
        <!-- Invoice Header -->
        <div style="padding: 0px 10px;">
            <div style="font-size: 20px; font-weight: bold; text-align: center; margin-top:-10px; font-family: 'Source Sans Pro', sans-serif;" >
                Invoice No. <?php echo e($gramBill->invoice_no); ?>

            </div>
            <div style="display: flex; font-size: 12px; float:right;">
                   <div>
                       <div style="margin-bottom: 15px; margin-top:-20px; margin-left:55px; color: #333;font-size:15px; font-family: 'Source Sans Pro', sans-serif;"><b>Quotation Date</b> - <?php echo e($gramBill->quatation_date); ?></div>
                        <div style="margin-bottom: 7px; color:#333; font-size:15px; font-family: 'Source Sans Pro', sans-serif; margin-left:95px"><b>Bill Date</b>: <?php echo e($gramBill->bill_date); ?></div>
                        <div style="margin-bottom: 7px;color: #333; font-size:15px; font-family: 'Source Sans Pro', sans-serif; margin-left:95px"><b>Reference No.</b> <?php echo e($gramBill->reference_number); ?></div>
                        <div style="color: green; font-weight: bold; font-size:15px; font-family: 'Source Sans Pro', sans-serif; margin-bottom:7px; margin-left:95px"><b>Billing No. <?php echo e($gramBill->invoice_no); ?></b></div>
                    </div>
                </div>
        </div>

        <!-- Invoice To Section -->
        <div style="padding: 10px 20px; font-size: 14px; text-align: left; margin-top:-100px; margin-left:-10px">
            <div>
                <span style=" font-size: 24px;  font-family: 'Source Sans Pro', sans-serif;">Invoice to:</span>
                </br>
                <span style=" font-size: 28px; color: #7b1fa2; font-weight: bold font-family: 'Source Sans Pro', sans-serif , 'noto-sans-devanagari';"><?php echo e($gramBill->gram); ?></span>
            </div>
            <div style="font-size: 14px; color: #333; margin-top: 5px; font-family: 'Source Sans Pro', sans-serif , 'noto-sans-devanagari';">
                Tal- <?php echo e($gramBill->taluka); ?> Dist-<?php echo e($gramBill->district); ?>.
            </div>
        </div>
        
        

        <!-- First Table -->
        <table class="info-table">
            <thead>
                <tr>
                    <th>SR</th>
                    <th colspan="2" style="position: relative;">
    <span style="position: absolute; left: 50%; transform: translateX(-50%); margin-top:-5px;margin-left:-35px">DETAILS</span>
</th>
                </tr>
            </thead>
            <tbody>
                <?php $rowNumber = 1;
                $getGramCategory = DB::table('register_to_grams')->where('gram',$gramBill->gram)->get();
                ?>
                <tr>
                    <td><?php echo e($rowNumber++); ?></td>
                    <td>Complete Register's Types</td>
                    <td>
                          <?php if($getGramCategory->isNotEmpty()): ?>
                            <?php echo e($getGramCategory->pluck('category')->join(', ')); ?>

                        <?php else: ?>
                            No categories available
                        <?php endif; ?>
                      </td>
                </tr>
                <tr>
                    <td><?php echo e($rowNumber++); ?></td>
                    <td>Total Population</td>
                    <td><?php echo e($gramBill->population); ?></td>
                </tr>
                <tr>
                    <td><?php echo e($rowNumber++); ?></td>
                    <td>First Time Bill Amount</td>
                    <td><?php echo e($gramBill->first_time_bill_amount); ?></td>
                </tr>
                <tr>
                    <td><?php echo e($rowNumber++); ?></td>
                    <td>Maintenance Amount</td>
                    <td><?php echo e($gramBill->maintenance_amount); ?></td>
                </tr>
                <tr>
                    <td><?php echo e($rowNumber++); ?></td>
                    <td>Next Maintenance Date</td>
                    <td><?php echo e($gramBill->next_maintenance_date); ?></td>
                </tr>
                <tr>
                    <td><?php echo e($rowNumber++); ?></td>
                    <td>Bill Status</td>
                    <td><?php echo e($gramBill->bill_status); ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Second Table -->
        <table class="info-table single-header">
            <thead>
                <tr>
                    <th colspan="2">GRAM BILLS PAYMENT RECIVERD DETAILS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>First Time Bill Amount</td>
                    <td><?php echo e($gramBill->first_time_bill_amount); ?></td>
                </tr>
                <tr>
                    <td>Paid Amount</td>
                    <td><?php echo e($gramBill->paid_amount); ?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo e($gramBill->description); ?></td>
                </tr>
                <tr>
                    <td>Payment Mode</td>
                    <td><?php echo e($gramBill->payment_mode); ?></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Paid Image -->
        <div class="paid-image" style="text-align:right;margin-top:-138px;z-index:-10;">
            <img src="<?php echo e(public_path('build/images/paidlogo.png')); ?>" alt="Paid Logo" style="max-width: 150px; height: auto;">
        </div>

<!-- Bottom Image -->
<div class="bottom-image" style="position: relative;">
    <img src="<?php echo e(public_path('build/images/footer.png')); ?>" alt="Bottom Image" style=" height: 150px;">

    <!-- Text positioned over the image -->
    <p style="
        position: absolute; 
        top: 70px; 
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
<?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/gram-bills/grambills_print.blade.php ENDPATH**/ ?>