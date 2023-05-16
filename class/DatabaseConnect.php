<?php

require_once(dirname(__FILE__) . '/../config/DataConfig.php');

/**
 * DatabaseConnect - This class inherits data from DataConfig class and connects
 * to database
 */
class DatabaseConnect extends DataConfig {
  protected $conn;

  /**
   * Method __construct
   *
   *   @return void
   *     Connects to mysql database and throws error if failed
   */
  public function __construct() {
    $this->conn = new mysqli($this->getHost(), $this->getUsername(), $this->getPassword(), $this->getName());
    if ($this->conn->connect_error) {
      die(" Connection Failed: " . $this->conn->connect_error);
    }
    else {
      echo " Connected Successfully! ";
    }
  }

  /**
   * Method createDatabase
   *
   *   @return void
   *     Checks whether database already exists or not, and then creates database
   *     and displays success/failure response in browser window.
   */
  public function createDatabase() {
    $result = $this->conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->getName() . "'");
    if ($result->num_rows > 0) {
      echo " Database already exists! ";
      return $this->createTable();
    }
    $sql = "CREATE DATABASE " . $this->getName();
    if ($this->conn->query($sql)) {
      return $this->createTable();
    }
    echo " Error creating database: " . $this->conn->error;
  }

  /**
   * This function is used to create signup table if not created then error will
   * be shown.
   *
   *   @return void
   *     Creates table with all the input data from signup page inside the database
   *     and displays success/failure response in browser window.
   */
  public function createTable() {
    $result = $this->conn->query("SHOW TABLES LIKE 'signup'");
    if ($result->num_rows > 0) {
      echo " Table already exists! ";
    }
    else {
      $sql = "CREATE TABLE signup (
              userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              userName VARCHAR(120) NOT NULL,
              firstName VARCHAR(60) NOT NULL,
              lastName VARCHAR(60) NOT NULL,
              phoneNum VARCHAR(60) NOT NULL,
              userEmail VARCHAR(120) NOT NULL,
              userPass VARCHAR(120) NOT NULL
          )";
      if ($this->conn->query($sql)) {
        echo " Table created successfully ";
      }
      else {
        echo " Error creating table: " . $this->conn->error;
      }
    }
  }

  /**
   * Method insertData
   *
   *   @param string $userName
   *     Stores the username.
   *   @param string $fName
   *     Stores the first name.
   * @param string $lName [explicite description]
   * @param $phone $phone [explicite description]
   * @param string $email [explicite description]
   * @param string $pwd [explicite description]
   *
   * @return void
   */
  public function insertData(string $userName, string $fName, string $lName, string $phone, string $email, string $pwd) {
    $sql_in = "INSERT INTO signup (userName, firstName, lastName, phoneNum, userEmail, userPass) VALUES ('$userName', '$fName', '$lName', '$phone', '$email', '$pwd')";
    if ($this->conn->query($sql_in) == TRUE) {
      echo " Data Inserted Successfully ";
    }
    else {
      echo " Unable To Insert Data " . $this->conn->error;
    }
  }

}

?>
