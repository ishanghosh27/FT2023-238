<?php

require_once('PhoneValidation.php');

class EmailValidation extends PhoneValidation {
  private $email;
  private $error = [];
  public function __construct() {
    parent::__construct();
    $this->email = $_POST['email'];
    $this->validateEmail();
  }

  public function validateEmail() {
    if (empty($this->email)) {
      $this->error['email'] = "Email Field Cannot Be Empty";
    } else {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->error['email'] = "Invalid Email Syntax";
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['emailerror' => $this->error]);
      header("Location: ../a6.php?" . $query_params);
      exit();
    }
    else {
      return TRUE;
    }
  }
}

?>
