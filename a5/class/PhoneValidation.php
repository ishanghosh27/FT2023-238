<?php

require_once('MarksValidation.php');

class PhoneValidation extends MarksValidation {
  private $phone;
  private $error = [];
  public function __construct()
  {
    parent::__construct();
    $this->phone = $_POST['phone'];
    $this->validatePhone();
  }

  public function validatePhone() {
    if (empty($this->phone)) {
      $this->error['phone'] = "Phone Number Field Cannot Be Empty";
    }
    else {
      if (!preg_match('/^[6-9]\d{9}$/', $this->phone)) {
        $this->error['phone'] = "Please Enter A Valid 10 Digit Indian Phone Number";
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['phoneerror' => $this->error]);
      header("Location: ../a5.php?" . $query_params);
      exit();
    }
    else {
      return $this->displayPhone();
    }
  }

  public function displayPhone() {
    $phoneIndia = " This is my phone number - " . $this->phone;
    ?>
    <div class="container">
      <div class="row my-2">
        <div class="col-sm-12">
          <h5 class="display-5">
            <?php echo $phoneIndia; ?>
          </h5>
        </div>
      </div>
    </div>
    <?php
  }
}



?>
