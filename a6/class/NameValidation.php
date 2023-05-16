<?php

include_once('../../anav.php');

class NameValidation
{
  private $fname;
  private $lname;
  private $error = [];

  public function __construct()
  {
    $this->fname = $_POST['fname'];
    $this->lname = $_POST['lname'];
    $this->validateNames();
  }

  public function validateNames() {
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
      header("Location: ../a6.php?" . $query_params);
      exit();
    } else {
      return TRUE;
      // return $this->getFullName();
    }
  }

  public function getFullName()
  {
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
  }
}

?>
