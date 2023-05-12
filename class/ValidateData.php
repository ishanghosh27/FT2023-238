<?php

include_once('DatabaseConnect.php');
/**
 * SignUp - This class validates whether the entered fields have correct format and are NON empty.
 */
class ValidateData extends DatabaseConnect{

  private $userName;
  private $firstName;
  private $lastName;
  private $email;
  private $pwd;
  private $repwd;

  public $errorCount = 0;

  public $errorArray = [];
  /**
   * Method __construct
   *
   * @return array
   *  Initializes input data
   */
  public function __construct() {
    $this->userName = $_POST['username'];
    $this->firstName = $_POST['fname'];
    $this->lastName = $_POST['lname'];
    $this->email = $_POST['email'];
    $this->pwd = $_POST['pass'];
    $this->repwd = $_POST['repass'];
  }

  public function validateForm() {
    $this->validateUsername();
  }

  /**
   * Method validateUsername
   *
   * @return void
   *  Validates input data in username field and throws error in the URL. Also, calls the function to validate First & Last Name.
   */
  public function validateUsername() {
    if (empty($this->userName)) {
      $this->errorCount += 1;
      array_push($this->errorArray, "Username Cannot be Empty");
      // header('location: ../signup.php?username=Username Cannot Be Empty');
    }
    else {

      // if (!preg_match('/^[a-zA-Z][0-9a-zA-Z_]{2,23}[0-9a-zA-Z]$/', ($this->userName))) {
      if (strlen($this->userName) < 2) {
        header('location: ../signup.php?username=Invalid Username Format');
      }
      else {
        return $this->validateName();
      }
    }
  }

  /**
   * Method validateName
   *
   * @return void
   *  Validates input data in first name and last name field and throws error in the URL. Also, calls the function to validate email.
   */
  public function validateName() {
    if (empty($this->firstName) || empty($this->lastName)) {
      header('location: ../signup.php?name=Name Fields Cannot Be Empty');
    }
    else {
      if (!preg_match('/^[a-zA-Z ]*$/', ($this->firstName))) {
        header('location: ../signup.php?fname=invalidfirstname');
      }
      elseif (!preg_match('/^[a-zA-Z ]*$/', ($this->lastName))) {
        header('location: ../signup.php?lname=invalidlastname');
      }
      return $this->validateEmail();
    }
  }

  /**
   * Method validateEmail
   *
   * @return void
   *  Validates input data in email field and throws error in the URL. Also, calls the function to validate password.
   */
  public function validateEmail() {
    if (empty($this->email)) {
      header('location: ../signup.php?email=Email Cannot Be Empty');
    }
    else {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        header('location: ../signup.php?email=Invalid Email Format');
      }
      return $this->validatePassword();
    }
  }

  /**
   * Method validatePassword
   *
   * @return void
   *  Validates input data in password field and throws error in the URL.
   */
  public function validatePassword() {
    if (empty($this->pwd) || empty($this->repwd)) {
      header('location: ../signup.php?pass=Password Cannot Be Empty');
    }
    else {
      if ($this->pwd <> $this->repwd) {
        header('location: ../signup.php?pass=Passwords Do Not Match');
      }
    }
  }

}

if (isset($_POST['submit'])) {
  $signup = new ValidateData();
  $signup->validateForm();
  $connection = new DatabaseConnect();
  $connection->createDatabase();
}
