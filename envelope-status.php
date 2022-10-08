<?php
$data = file_get_contents("php://input");

include('wp-config.php');
global $wpdb;



//$events = json_decode($data, true);
//$serData = serialize($events);

//$d = unserialize($serData);

$eveid = $d['data']['envelopeId'];
//$eveid = '1b7232e9-d6a5-4ab7-8beb-7f5b05a09c3d';
$wpdb->query("UPDATE contract_data_api SET status='complete' WHERE envelopeId LIKE '".$eveid."'");

$getData = $wpdb->get_results("SELECT * FROM contract_data_api WHERE envelopeId LIKE '".$eveid."'");

$candidate_id = $getData[0]->candidate_id;
$emaildata = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidate_id");
$offerID = $getData[0]->offer_id;

$basicSalary = get_field('offer_basic_salary',$offerID);
$jobID = get_field('offer_job_id',$offerID);
$percentage = get_field('fee_level',$jobID);
$percentage = preg_replace('/[^A-Za-z0-9\-]/', '', $percentage).' ';
$amountToPay = ($basicSalary/100)*$percentage;
$amountToPay = number_format($amountToPay, 2);

$emp_id = $emaildata[0]->emp_id;
$rec_id = $emaildata[0]->rec_id;
$cd = unserialize($emaildata[0]->candidate_data);

$candidateName = $cd['name'];

$emp_name = get_user_meta($emp_id,'first_name',true);
$emp_email = get_user_meta($emp_id,'email',true);

$rec_name = get_user_meta($rec_id,'first_name',true);
$rec_email = get_user_meta($rec_id,'email',true);

$siteurl = site_url();
$paymentLink = get_the_permalink(913).'?a='base64_encode($amountToPay);

$confirmhtml = '<head>
<title>Contract Accepted Confirmation</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
   <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
       <tr>
           <td>
               <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                   <tr align="center" >
                       <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                            <a href="'.$siteurl.'" target="_blank">
                            <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                          </strong></td>
                   </tr>
               </table>
               <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                   <tr>
<td style="padding: 0px 0 15px;">
        <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$emp_name.'</h4>
                       </td>
                   </tr>
                   <tr>
                      <td style="padding: 0px 0 15px;">
                           <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                            This is confirmation mail that your offer and contract has been signed by the candidate.You have to make the payment within 30 calender days of the candidate starting the job.
                            </p>
                            <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                            Please check the below payment details.
                            </p>
                            <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                <strong>Pay amount:</strong> $'.$amountToPay.'
                            </p>
                            <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                                <a href="'.$paymentLink.'">Pay Now</a>
                            </p>
                       </td>
                   </tr>
               </table>
           </td>
       </tr>
   </table>
</body>';

//         Always set content-type when sending HTML email
$cand_headers  = "MIME-Version: 1.0" . "\r\n";
$cand_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$cand_headers .= 'From:<info@heyjobba.customerdevsites.com>' . "\r\n";

wp_mail($emp_email,'Confirmation Contract',$confirmhtml,$cand_headers);

/************Mail to recruiter********************/

$confirmrechtml = '<head>
<title>Contract Accepted Confirmation</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
   <table cellspacing="0" border="0" align="center" cellpadding="0" width="600" style="border:1px solid #efefef; margin-top:10px; margin-bottom: 30px;">
       <tr>
           <td>
               <table cellspacing="0" border="0" align="center" cellpadding="20" width="100%">
                   <tr align="center" >
                       <td style="font-family:arial; padding:20px;"><strong style="display:inline-block;">
                            <a href="'.$siteurl.'" target="_blank">
                            <img src="https://i.postimg.cc/d0Zvf8d1/logo.png" border="0" alt="logo" style="width: 200px; height: auto;"/></a>
                          </strong></td>
                   </tr>
               </table>
               <table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding:40px;">
                   <tr>
<td style="padding: 0px 0 15px;">
        <h4 style="font-weight:normal; margin-top: 0px; margin-bottom: 15px; font-size: 16px;">Hello, '.$rec_name.'</h4>
                       </td>
                   </tr>
                   <tr>
                      <td style="padding: 0px 0 15px;">
                           <p style="font-family: "Roboto", sans-serif; font-weight: 400; margin-top: 0px; margin-bottom: 15px; line-height: 1.7; font-size: 15px;">
                            This is confirmation mail that your candidate - ('.$candidateName.') has accepted the offer and contract has been signed.
                            </p>
                       </td>
                   </tr>
               </table>
           </td>
       </tr>
   </table>
</body>';

//         Always set content-type when sending HTML email
$cand_recheaders  = "MIME-Version: 1.0" . "\r\n";
$cand_recheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$cand_recheaders .= 'From:<info@heyjobba.customerdevsites.com>' . "\r\n";

wp_mail($rec_email,'Confirmation Contract',$confirmrechtml,$cand_recheaders);
?>