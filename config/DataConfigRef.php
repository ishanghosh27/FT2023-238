<?php

class DataConfig {

  private $dBHost = "Name Of Host";
  private $dBUsername = "Username Of Database";
  private $dBPassword = "Password Of Database";
  private $dBName = "Name Of Table";

  public function getHost() {
    return $this->dBHost;
  }
  public function getUsername() {
    return $this->dBUsername;
  }
  public function getPassword() {
    return $this->dBPassword;
  }
  public function getName() {
    return $this->dBName;
  }

}

?>
