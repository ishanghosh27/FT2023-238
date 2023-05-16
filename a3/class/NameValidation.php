<?php

include_once('../../anav.php');

/**
 *     Class to validate input first name and last name. If there
 *     are errors in input value, user will be redirected back to the main form
 *     and errors will be shown in an alert box. If all validations are successful,
 *     full name will be displayed in this page.
 */
class NameValidation
{
  /**
   *   fname
   *
   *   @var mixed
   *     This variable initializes the input field of First Name.
   */
  private $fname;
  /**
   *   lname
   *
   *   @var mixed
   *     This variable initializes the input field of Last Name.
   */
  private $lname;
  /**
   *   error
   *
   *   @var array
   *     This variable stores all the error messages and displays in the main
   *     form in an alert box.
   */
  private $error = [];

  /**
   *   Initializes First Name & Last Name. And calls validateNames function.
   *
   *   @return void
   *     Input data from First Name & Last Name fields are stored in 'fname' &
   *     'lname' variables respectively. And function 'validateNames()' is called.
   */
  public function __construct()
  {
    $this->fname = $_POST['fname'];
    $this->lname = $_POST['lname'];
    $this->validateNames();
  }

  /**
   *   Validates whether input data of First & Last Names are as intended and
   *   redirects to the main form if there are any errors. And if all checks out,
   *   full name is displayed in this page itself.
   *
   *   @return mixed
   *     This function checks whether input fields of First & Last Names are empty
   *     or not. If they are not empty, it checks whether there are ONLY alphabets
   *     present in the input field. If there are errors, user is redirected to the
   *     main page with errors displayed in an alert box right under the input
   *     fields. If there are no errors, and all validation checks out, full name
   *     is displayed in this page itself as "Hello, I am <Full Name>."
   */
  public function validateNames()
  {
    if (empty($this->fname)) {
      $this->error['fname'] = "First Name Cannot Be Empty";
    }
    if (empty($this->lname)) {
      $this->error['lname'] = "Last Name Cannot Be Empty";
    } else {
      if ((!preg_match("/^[a-zA-Z-']*$/", $this->fname))) {
        $this->error['fname'] = "First Name Can Only Contain Alphabets";
      }
      if ((!preg_match("/^[a-zA-Z-']*$/", $this->lname))) {
        $this->error['lname'] = "Last Name Can Only Contain Alphabets";
      }
    }
    if (!empty($this->error)) {
      $query_params = http_build_query(['error' => $this->error]);
      header("Location: ../a3.php?" . $query_params);
      exit();
    } else {
      $fullname = " Hello, I am " . $this->fname . " " . $this->lname . ".";
?>
      <div class="container">
        <div class="row my-5">
          <div class="col-sm-12">
            <h3 class="display-4">
              <?php echo $fullname; ?>
            </h3>
          </div>
        </div>
      </div>
<?php
      exit();
    }
  }
}

if (isset($_POST['submit'])) {
  $nameVal = new NameValidation();
  $nameVal->validateNames();
}


?>
