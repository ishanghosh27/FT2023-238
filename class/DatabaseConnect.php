<?php

include_once('../config/DataConfig.php');

/**
 * DatabaseConnect - This class inherits data from DataConfig class and connects to database
 */
class DatabaseConnect extends DataConfig {
  private $conn;
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
   *  Checks whether database already exists or not, and then creates database and displays success/failure response in browser window
   */
  public function createDatabase() {
    $result = $this->conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $this->getName() . "'");
    if ($result->num_rows > 0) {
      echo " Database already exists! ";
      return $this->createTable();
    }
    else {
      $sql = "CREATE DATABASE" .$this->getName();
      if ($this->conn->query($sql) === TRUE) {
        return $this->createTable();
      }
      else {
        echo " Error creating database: " . $this->conn->error;
      }
      $this->conn->close();
    }
  }
  /**
   * Method createTable
   *
   * @return void
   *  Creates table with all the input data from signup page inside the database and displays success/failure response in browser window
   */
  public function createTable() {
    $result = $this->conn->query("SHOW TABLES LIKE 'mytable'");
    if ($result->num_rows > 0) {
      echo " Table already exists! ";
    }
    else {
      $sql = "CREATE TABLE mytable (
              userId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
              userName VARCHAR(120) NOT NULL,
              firstName VARCHAR(30) NOT NULL,
              lastName VARCHAR(30) NOT NULL,
              userEmail VARCHAR(80) NOT NULL,
              userPass VARCHAR(120) NOT NULL
          )";
      if ($this->conn->query($sql) === TRUE) {
        echo " Table created successfully ";
      }
      else {
        echo " Error creating table: " . $this->conn->error;
      }
      $this->conn->close();
    }
  }

}

?>
