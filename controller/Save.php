<?php
require_once '../model/Details.php';
$details = new Details();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // get the transaction details by account number
  $request = $details->storeDetails($_POST['fname'], $_POST['ppn'], $_POST['spn'],	$_POST['email'], $_POST['idno'], $_POST['bt'], $_POST['loc'], $_POST['mrev']);
  if ($request != false) {
      // transaction details found
      $response["error"] = FALSE;
      $response["error_msg"] = "Account creation successful!";
      echo json_encode($response);
      } else {
          // transaction details not found for the account number
          $response["error"] = TRUE;
          $response["error_msg"] = "No sales Done yet!";
          echo json_encode($response);
      }
}else{
    $response["error"] = TRUE;
          $response["error_msg"] = "Invalid request!";
          echo json_encode($response);
}