<?php

require_once('NameValidation.php');

class ImageUpload extends NameValidation {
  private $imageName;
  private $imageSize;
  private $imageType;
  private $imageTempLoc;
  private $error = [];

  public function __construct() {
    parent::__construct();
    $this->imageName = $_FILES['image']['name'];
    $this->imageSize = $_FILES['image']['size'];
    $this->imageType = $_FILES['image']['type'];
    $this->imageTempLoc = $_FILES['image']['tmp_name'];
    $this->validateImage();
  }

  public function validateImage() {
    if ($this->imageSize > 200000) {
      $this->error['image'] = "Please Upload Image Less Than 200 KB";
    }
    if (!in_array($this->imageType, ["image/jpeg", "image/jpg", "image/png", "image/gif"])) {
      $this->error['image'] = "Please Upload Images with jpeg, jpg, png or gif extension";
    }
    if (!empty($this->error)) {
      $query_params_1 = http_build_query(['imgerror' => $this->error]);
      header("Location: ../a2.php?" . $query_params_1);
      exit();
    } else {
      return $this->displayImage();
    }
  }

  public function displayImage() {
    $target_dir = "../../imguploads/";
    $target_file = $target_dir . basename($this->imageName);
    if (move_uploaded_file($this->imageTempLoc, $target_file)) {
?>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <img src="<?php echo $target_file ?>" class="img-fluid rounded" alt="Uploaded_Image">
          </div>
        </div>
      </div>
<?php
    } else {
      $this->error['image'] = "Error Uploading Image";
      if (!empty($this->error)) {
        $query_params = http_build_query(['error' => $this->error]);
        header("Location: ../a2.php?" . $query_params);
        exit();
      }
    }
  }
}

if (isset($_POST['submit'])) {
  $image = new ImageUpload();
}


?>
