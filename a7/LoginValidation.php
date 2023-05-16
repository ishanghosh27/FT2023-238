<?php

require_once(dirname(__FILE__) . '/../class/DatabaseConnect.php');

class LoginValidation extends DatabaseConnect {
  private $username;
  private $email;
  private $password;
  public function __construct() {
    parent::__construct();
    $this->username = $_POST['username'];
    $this->email = $_POST['email'];
    $this->password = $_POST['pass'];
    $this->getLoginData();
  }

  public function getLoginData() {
    $sql = "SELECT * FROM signup WHERE userName = '$this->username' AND userEmail = '$this->email' AND userPass = '$this->password'";
    $result = $this->conn->query($sql);
    if ($result->num_rows == 1) {
      session_start();
      $_SESSION['username'] = $this->username;
      $_SESSION['email'] = $this->email;
      $_SESSION['pass'] = $this->password;
      header("location: ../index.php"); 
      exit();
    } else {
      $loginError = "Invalid Username, Email, or Password.";
      header("location: ../login.php?loginerror=" . urlencode($loginError));
      exit();
    }
  }
}

$loginVal = new LoginValidation();

?>
