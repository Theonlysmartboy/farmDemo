<?php

/*
 * This source code belongs to Otema technologies.
 * All rights reserved.
 * No modification of this or any part of this system is allowed without written permission from Otema Technologies.
 */

/**
 * Description of User
 *
 * @author Joseph Odhiambo <tosby@otemainc.com>
 */
class Details {
  public $conn;
  // constructor
  function __construct() {
      require_once '../app/Connect.php';
      $db = new Db_Connect();
      $this->conn = $db->connect();
  }
  // destructor
  function __destruct() {
  }
  public function storeDetails($fname,	$ppn, $spn,	$email, $idno,	$bt, $loc, $mrev){
    $stmt = $this->conn->prepare("INSERT INTO user_details(fname, ppn,	spn, email, idno, bt, loc, mrev, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, 1");
    /* checking whether the prepare() succeeded */
    if ($stmt === false) {
        return false;
    }
    $stmt->bind_param("sssssssss", $fname,	$ppn, $spn,	$email, $idno,	$bt, $loc, $mrev);
    $result = $stmt->execute();
    $stmt->close();
    // check for successful store
    if ($result) {
        $stmt = $this->conn->prepare("SELECT * FROM user_details WHERE email = ?");
        /* checking whether the prepare() succeeded */
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $user;
    } else {
        return false;
    }

  }
  public function getDetails(){
    $stmt = $this->conn->prepare("SELECT * FROM user_details");
  /* checking whether the prepare() succeeded */
  if ($stmt === false) {
      trigger_error($this->conn->error, E_USER_ERROR);
      return false;
  }
  $status = $stmt->execute();
  /* BK: checking whether the execute() succeeded */
  if ($status === false) {
      trigger_error($stmt->error, E_USER_ERROR);
      return false;
  }
      //binding results to the query
      $stmt->bind_result($id, $fname,	$ppn, $spn,	$email, $idno,	$bt, $loc, $mrev, $status);
      $result = array();
        while($stmt->fetch()){
            // transaction details found
            $details["id"] = $id;
            $details["name"] = $fname;
            $details["primaryphone"] = $ppn;
            $details["secondaryphone"] = $spn;
            $details["email"] = $email;
            $details["idno"] = $idno;
            $details["businesstype"] = $bt;
            $details["location"] = $loc;
            $details["monthlyrevenue"] = $mrev;
            $details["status"] = $status;
            array_push($result, $details);
        }
      return json_encode($result);
      $stmt->close();

}
}
