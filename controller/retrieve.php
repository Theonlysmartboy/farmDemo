<?php
require_once '../model/Details.php';
$sale = new Details();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $details = $sale->getDetails();
  if ($details != false) {
          echo $details;
      } else {
          $response["error"] = TRUE;
          $response["error_msg"] = "No data in db!";
          echo json_encode($response);
      }
}else{
    $response["error"] = TRUE;
          $response["error_msg"] = "Invalid request!";
          echo json_encode($response);
}