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
   * @return void
   *  Connects to mysql database and throws error if failed
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
   * @return void
   *  Checks whether database already exists or not, and then creates database
   * and displays success/failure response in browser window
   */
  public function createDatabase() {
    $result = $this->conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->getName() . "'");
    if ($result->num_rows > 0) {
      echo " Database already exists! ";
      return $this->createTable();
    }
    else {
      $sql = "CREATE DATABASE " .$this->getName();
      if ($this->conn->query($sql) === TRUE) {
        return $this->createTable();
      }
      else {
        echo " Error creating database: " . $this->conn->error;
      }
    }
  }
  /**
   * Method createTable
   *
   * @return void
   *  Creates table with all the input data from signup page inside the database
   * and displays success/failure response in browser window
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
      if ($this->conn->query($sql) === TRUE) {
        echo " Table created successfully ";
      }
      else {
        echo " Error creating table: " . $this->conn->error;
      }
    }
  }

  public function insertData($userName, $fName, $lName, $phone, $email, $pwd) {
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
