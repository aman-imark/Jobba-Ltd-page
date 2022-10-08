<?php
include('wp-config.php');
global $wpdb;

$docuData = $wpdb->get_results("SELECT * FROM docusign_data");

if($docuData[0]->accesstoken != ''){

echo "if ";
$curl = curl_init();
$refreshToken = $docuData[0]->refreshtoken;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://account-d.docusign.com/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=refresh_token&refresh_token='.$refreshToken.'',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic Y2VjNWM3OWItM2ZjMS00YWUyLWFhNTYtNmQyNTE1MTU2ZjBlOmZmMDU5NDE4LTAzYjAtNDlmNy04ZThjLTk1ZjY4YjQxYmE1ZQ==',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: __RequestVerificationToken=AU2SzJH_8XOOAZGFLfNeOnIB0'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$tokenData = json_decode($response);
    
print_r($tokenData);
    
$act = $tokenData->access_token;
$rft = $tokenData->refresh_token;
$id = $docuData[0]->ID;
//
//$result = $wpdb->query("UPDATE docusign_data SET accesstoken='".$act."', refreshtoken='".$rft."' WHERE ID=$id");
////    
//echo $result;


}else{
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://account-d.docusign.com/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'grant_type=authorization_code&code=eyJ0eXAiOiJNVCIsImFsZyI6IlJTMjU2Iiwia2lkIjoiNjgxODVmZjEtNGU1MS00Y2U5LWFmMWMtNjg5ODEyMjAzMzE3In0.AQoAAAABAAYABwCAsk7_NqHaSAgAgD7VRjeh2kgCAKb2WzHsxipPv8Q2T8ilA2cVAAEAAAAYAAEAAAAFAAAADQAkAAAAY2VjNWM3OWItM2ZjMS00YWUyLWFhNTYtNmQyNTE1MTU2ZjBlIgAkAAAAY2VjNWM3OWItM2ZjMS00YWUyLWFhNTYtNmQyNTE1MTU2ZjBlNwApsOC2Qp2nQYjtv0ONGb7uMAAA2jNaNqHaSA.furX-5oGnBTlFO4wTEeLiXujkOPqJAXSc58vfs5gfkFKKxR3XTSZsn3tbUQrogrzie3JyIjnds_NVv7oxCNeznawJJrGwGdG6I7zw3ni5EmMqwJaVopI4NiF622dfJmOfwVMCm0FvZ549fojvc5_GHtwIsc-8dO6ylRW6t-kF6NXjsgGeeJzb6PQd-28d4zY7bV1I4UbNzrMXnShZwjgZBBcFjICxI9i_8-jwfjYmgYlHkn7pfTvm9mhC9JnKFJUWIBSK3JgwWb3fPNiPsBhFJx2_Fstfh6R0IJ0Lka4FhixDxIgtJ4-PwvpLFbSY8efx63cEkzC-ynFDpVGIzrJcw',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic Y2VjNWM3OWItM2ZjMS00YWUyLWFhNTYtNmQyNTE1MTU2ZjBlOmZmMDU5NDE4LTAzYjAtNDlmNy04ZThjLTk1ZjY4YjQxYmE1ZQ==',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

$tokenData = json_decode($response);
echo "else "; 
print_r($tokenData);

$wpdb->insert("docusign_data",array(
    "accesstoken"=>$tokenData->access_token,
    "refreshtoken"=>$tokenData->refresh_token
));
    
}


?>
