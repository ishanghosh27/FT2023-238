<?php

include_once('DatabaseConnect.php');
include_once('../nav.php');

/**
 * SignUp - This class validates whether the entered fields have correct format and are NON empty. And if all validation checks out, entered data in added into table to be later used while loggin in.
 */
class ValidateData extends DatabaseConnect {

  private $userName;
  private $fName;
  private $lName;
  private $email;
  private $phone;
  private $pwd;
  private $repwd;
  public $error = [];

  public function __construct() {
    parent::__construct();
    $this->userName = $_POST['username'];
    $this->fName = $_POST['fname'];
    $this->lName = $_POST['lname'];
    $this->email = $_POST['email'];
    $this->phone = $_POST['phone'];
    $this->pwd = $_POST['pass'];
    $this->repwd = $_POST['repass'];
    $this->validateForm();
  }

  public function validateForm() {
    $this->validateUsername();
  }

  public function validateUsername() {
    if (empty($this->userName)) {
      $this->error['username'] = "Username Cannot Be Empty";
    }
    else {
      if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $this->userName)) {
        $this->error['username'] = "Invalid Username Format";
      }
      else {
        return $this->validateName();
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['uiderror' => $this->error]);
      header("Location: ../signup.php?" . $query_params);
      exit();
    } else {
      return $this->validateName();
    }
  }

  public function validateName()
  {
    if (empty($this->fName)) {
      $this->error['fname'] = "First Name Cannot Be Empty";
    }
    if (empty($this->lName)) {
      $this->error['lname'] = "Last Name Cannot Be Empty";
    } else {
      if ((!preg_match("/^[a-zA-Z-']*$/", $this->fName))) {
        $this->error['fname'] = "First Name Can Only Contain Alphabets";
      }
      if ((!preg_match("/^[a-zA-Z-']*$/", $this->lName))) {
        $this->error['lname'] = "Last Name Can Only Contain Alphabets";
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['nameerror' => $this->error]);
      header("Location: ../signup.php?" . $query_params);
      exit();
    } else {
      return $this->validatePhone();
    }
  }

  public function validatePhone() {
    if (empty($this->phone)) {
      $this->error['phone'] = "Phone Number Cannot Be Empty";
    }
    else {
      if (!preg_match('/^[6-9]\d{9}$/', $this->phone)) {
        $this->error['phone'] = "Please Enter A Valid 10 Digit Indian Phone Number";
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['phoneerror' => $this->error]);
      header("Location: ../signup.php?" . $query_params);
      exit();
    } else {
      return $this->validateEmail();
    }
  }
  public function validateEmail() {
    if (empty($this->email)) {
      $this->error['email'] = "Email ID Cannot Be Empty";
    }
    else {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->error['email'] = "Invalid Email ID Syntax";
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['emailerror' => $this->error]);
      header("Location: ../signup.php?" . $query_params);
      exit();
    }
    else {
      return $this->validatePassword();
    }
  }
  public function validatePassword() {
    if (empty($this->pwd) || empty($this->repwd)) {
      $this->error['pass'] = "Password Cannot Be Empty";
    }
    else {
      if ($this->pwd <> $this->repwd) {
        $this->error['pass'] = "Passwords Do Not Match";
      }
        else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])\S{8,}$/', $this->pwd)) {
          $this->error['pass'] = "Password Must Have At Least 1 Lowercase Letter, 1 Uppercase Letter, 1 Digit, 1 Special Character, And Be A Minimum Of 8 Characters Long";
        }
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['passerror' => $this->error]);
      header("Location: ../signup.php?" . $query_params);
      exit();
    }
  }
  public function enterData($userName, $fName, $lName, $phone, $email, $pwd) {
    $this->insertData($userName, $fName, $lName, $phone, $email, $pwd);
    $this->error['submit'] = "Signed Up Successfully!";
    if (!empty($this->error)) {
      $query_params = http_build_query(['signedup' => $this->error]);
      header("Location: ../signup.php?" . $query_params);
      exit();
    }
    else {
      header("Location: ../signup.php");
      exit();
    }
  }

}

if (isset($_POST['submit'])) {
  $userName = $_POST['username'];
  $fName = $_POST['fname'];
  $lName = $_POST['lname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $pwd = $_POST['pass'];
  $connection = new DatabaseConnect();
  $connection->createDatabase();
  $signup = new ValidateData();
  $signup->enterData($userName, $fName, $lName, $phone, $email, $pwd);
}
