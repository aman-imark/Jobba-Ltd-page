<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

include("../../../../wp-config.php");

global $wpdb;

$file_tmp= $_FILES['contract']['tmp_name'];
$type = pathinfo($file_tmp, PATHINFO_EXTENSION);
$data = file_get_contents($file_tmp);
$b64Doc = base64_encode($data);
$feedback = array();

/*** Get canditate info ***/
$candidateId = $_POST['candidate_row_id'];
$candidateData = $wpdb->get_results("SELECT * FROM save_candidate WHERE ID=$candidateId");

$cdata = unserialize($candidateData[0]->candidate_data);
$cemail = $cdata['email'];
//$cemail = 'kamal.bamola@imarkinfotech.com';
$cname = $cdata['name'];

/*** Get offer data ***/
$offerId = $_POST['offer_id'];
$offerData = get_post($offerId);

$docuData = $wpdb->get_results("SELECT * FROM docusign_data");
$accessToken = $docuData[0]->accesstoken;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://demo.docusign.net/restapi/v2.1/accounts/17296685/envelopes',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "documents": [
    {
      "documentBase64": "'.$b64Doc.'",
      "documentId": "1",
      "fileExtension": "pdf",
      "name": "Contract.pdf"
    }
  ],
  "emailSubject": "Please sign the Contract",
  "recipients": {
    "signers": [
      {
        "email": "'.$cemail.'",
        "name": "'.$cname.'",
        "recipientId": "1",
        "routingOrder": "1",
        "tabs": {
          "signHereTabs": [
            {
              "anchorString": "signer1sig",
              "anchorUnits": "mms",
              "anchorXOffset": "0",
              "anchorYOffset": "0",
              "name": "Please sign here",
              "optional": "false",
              "recipientId": "1",
              "scaleValue": 1,
              "tabLabel": "signer1sig"
            }
          ]
        }
      }
    ]
  },
  "status": "sent"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJNVCIsImFsZyI6IlJTMjU2Iiwia2lkIjoiNjgxODVmZjEtNGU1MS00Y2U5LWFmMWMtNjg5ODEyMjAzMzE3In0.AQoAAAABAAUABwAAote1s6LaSAgAAOL6w_ai2kgCAKb2WzHsxipPv8Q2T8ilA2cVAAEAAAAYAAEAAAAFAAAADQAkAAAAY2VjNWM3OWItM2ZjMS00YWUyLWFhNTYtNmQyNTE1MTU2ZjBlIgAkAAAAY2VjNWM3OWItM2ZjMS00YWUyLWFhNTYtNmQyNTE1MTU2ZjBlMAAA2jNaNqHaSDcAKbDgtkKdp0GI7b9DjRm-7g.AmBGJLp_pFdC3NErpbOUbItEV_SXw7HAKFq74OZgFFpS-pCBetITMztUjKEjsOazxQtztssQO2W6IH77bsyCyEf-HBMZkDGeLhIWKGIw3U-C43ytFqUPIJZMyDbjNlSV99qk-9vg7L8TQACG0yH0GKMHAa8o5pP-NuBlpqw_XvFH6NYX5RdHkS2yYD7Jn-zuTUihZQR8yBat2GeooOJxFj3xYzJYgXxzocdc8xkZgeKnRJgn00u9NUa4uL5Me1bGqLwkACBAye0B3yetaRbDGCKMoA-T8bptGOFzz-m2X29CjDdRQ8QswQqL8EtywtA9NBVjDBJaLVLrsQh4kfCBUA',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

echo $response;

curl_close($curl);

$res = json_decode($response);
$evnID = $res->envelopeId;
$dateTime = date('Y-m-d H:i:s');

$result = $wpdb->insert("contract_data_api",array(
        "envelopeId"=>$evnID,
        "date_time"=>$dateTime,
        "data"=>$response,
        "status"=>"sent",
        "candidate_id"=>$candidateId,
        "offer_id"=>$offerId,
));

if($result){
    $feedback['status'] = 1;
    $feedback['message'] = 'Message sent successfully!';
}else{
    $feedback['status'] = 0;
    $feedback['message'] = 'ERROR sending';
}
    
echo json_encode($feedback);
?>