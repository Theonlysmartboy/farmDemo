<?php
require_once '../../model/Details.php';
$sale = new Details();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // get the transaction details by account number

  $details = $sale->saveDetails($_POST['fname'], $_POST['ppn'], $_POST['spn'],	$_POST['email'], $_POST['idno'], $_POST['bt'], $_POST['loc'], $_POST['mrev']);
  if ($dSaleDetails != false) {
      // transaction details found
          echo $details;
      } else {
          // transaction details not found for the account number
          $response["error"] = TRUE;
          $response["error_msg"] = "No sales Done yet!";
          echo json_encode($response);
      }
}