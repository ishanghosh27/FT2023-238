<?php

require_once('PhoneValidation.php');

class EmailValidation extends PhoneValidation
{
  private $email;
  private $error = [];
  public function __construct()
  {
    parent::__construct();
    $this->email = $_POST['email'];
    $this->validateEmail();
  }

  public function validateEmail()
  {
    if (empty($this->email)) {
      $this->error['email'] = "Email Field Cannot Be Empty";
    } else {
      if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->error['email'] = "Invalid Email Syntax";
      } else {
        return $this->emailGetApi();
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['emailerror' => $this->error]);
      header("Location: ../a5.php?" . $query_params);
      exit();
    }
  }
  public function emailGetApi()
  {
    $curl = curl_init();
    $emailId = $this->email;

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=$this->email",
      CURLOPT_HTTPHEADER => array(
        "apikey: dKK0sX4WHp19gRZRUiQHnYjkUc1c8h31"
      ),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $validationResult = json_decode($response);

    if (!($validationResult->format_valid) && !($validationResult->smtp_check)) {
      $this->error['email'] = "This Email ID Does Not Exist";
    }
    curl_close($curl);
    if (!empty($this->error)) {
      $query_params = http_build_query(['emailerror' => $this->error]);
      header("Location: ../a5.php?" . $query_params);
      exit();
    } else {
      return $this->displayEmail();
    }
  }

  public function displayEmail()
  {
    $emailID = " This is my Email ID - " . $this->email;
?>
    <div class="container">
      <div class="row my-2">
        <div class="col-sm-12">
          <h5 class="display-5">
            <?php echo $emailID; ?>
          </h5>
        </div>
      </div>
    </div>
<?php
  }
}

if (isset($_POST['submit'])) {
  $emailVal = new EmailValidation();
}

?>
