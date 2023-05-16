<?php

include_once('DatabaseConnect.php');
include_once('../nav.php');
require_once('../../vendor/autoload.php');

class ForgotPassword extends DatabaseConnect {
  private $email;
  public function __construct() {
    parent::__construct();
    $this->email = $_POST['email'];
    $this->forgotPass();
  }
  public function forgotPass() {
    $sql = "SELECT userEmail FROM signup WHERE userEmail = '$this->email'";
    $result = $this->conn->query($sql);
    $value = $result->num_rows;
    if ($value === 1) {
      header("location: SendMail.php?email=" . urlencode($this->email));
      exit();
    }
    else {
      $forgotError = "Please Enter Signed Up User's Email ID";
      header('Location: ../forgotpass.php?forgoterror=' . urlencode($forgotError));
    }
  }
}

$forgotPass = new ForgotPassword();

?>
