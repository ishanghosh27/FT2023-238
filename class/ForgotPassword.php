<?php

include_once('DatabaseConnect.php');
include_once('../nav.php');

class ForgotPassword extends DatabaseConnect{
  private $email;
  public function __construct() {
    parent::__construct();
    $this->email = $_POST['email'];
    $this->forgotPass();
  }
  public function forgotPass() {
    $sql = "SELECT userEmail FROM signup WHERE userEmail = '$this->email'";
    $result = $this->conn->query($sql);
    if ($result->num_rows == 1) {
      session_start();

      header("location: ../login.php");
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
