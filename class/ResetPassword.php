<?php

include_once('DatabaseConnect.php');
include_once('../nav.php');

class ResetPassword extends DatabaseConnect {
  private $pass;
  private $email;
  private $error = [];
  public function __construct() {
    parent::__construct();
    $pass = $_POST['pass'];
    $this->pass = base64_encode($pass);
    $this->email = $_POST['email'];
    $this->validateResetPass();
  }
  public function validateResetPass() {
  {
    if (empty($this->pass)) {
      $this->error['pass'] = "New Password Cannot Be Empty";
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/', $this->pass)) {
          $this->error['pass'] = "New Password Must Have At Least 1 Lowercase Letter, 1 Uppercase Letter, 1 Digit, 1 Special Character, And Be A Minimum Of 8 Characters Long";
        }
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['resetpasserror' => $this->error]);
      header("Location: ../resetpass.php?" . $query_params);
      exit();
    }
    else {
      return $this->resetPass();
    }
  }
  public function resetPass() {
    $sql = "UPDATE signup SET userPass='$this->pass' WHERE userEmail='$this->email'";
    $result = $this->conn->query($sql);
    if ($result == TRUE) {
      $resetSuccess = "New Password Has Been Set";
      header("location: ../login.php?passreset=" . urlencode($resetSuccess));
      exit();
    } else {
      $this->error['pass'] = "Unable To Reset Password";
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['resetpasserror' => $this->error]);
      header("Location: ../resetpass.php?" . $query_params);
      exit();
    }
  }
}

$resetPass = new ResetPassword();

?>
