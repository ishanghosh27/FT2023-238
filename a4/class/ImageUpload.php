<?php

require_once('NameValidation.php');

/**
 *     Class to validate input image. If there are any errorsm user will be
 *     redirected back to the main form and errors will be shown in an alert box.
 *     If all validations are successful, input image will be displayed in this
 *     page. This class also inherits data and function from NameValidation class.
 */
class ImageUpload extends NameValidation
{

  /**
   *   imageName
   *
   *   @var mixed
   *     This variable initializes the input name.
   */
  private $imageName;

  /**
   *   imageSize
   *
   *   @var mixed
   *     This variable initializes the input image's size.
   *
   */
  private $imageSize;

  /**
   *   imageType
   *
   *   @var mixed
   *     This variable initializes the input image's type.
   *
   */
  private $imageType;

  /**
   *   imageTempLoc
   *
   *   @var mixed
   *     This variable initializes the temporary image file.
   *
   */
  private $imageTempLoc;

  /**
   *   error
   *
   *   @var array
   *     This variable stores all the error messages and displays in the main
   *     form in an alert box.
   *
   */
  private $error = [];

  /**
   *   Initializes input image. And calls validateImage function.
   *
   *   @return void
   *     Input data from Image field. And function 'validateImage()'is called.
   */
  public function __construct()
  {
    parent::__construct();
    $this->imageName = $_FILES['image']['name'];
    $this->imageSize = $_FILES['image']['size'];
    $this->imageType = $_FILES['image']['type'];
    $this->imageTempLoc = $_FILES['image']['tmp_name'];
    $this->validateImage();
  }

  /**
   *   Validates whether the size of the input image is less than 200 KB and type
   *   is either 'jpeg', 'jpg', 'png', or 'gif', and redirects back to the main
   *   form if there are any errors. And if all checks out, image is displayed
   *   in this page itself along with the Full Name from NameValidation class.
   *
   *   @return mixed
   *     This function checks whether input field the input image are empty or
   *     not. If it is not empty, it checks whether the size of the image is less
   *     than 200 KB, and if the file type is either 'jpeg', 'jpg', 'png', or
   *     'gif'. If there are any errors, user is redirected to the main page with
   *     errors displayed in an alert box right under the input field. If there
   *     are no errors, and all validation checks out, function 'displayImage()'
   *     is called.
   *
   */
  public function validateImage()
  {
    if ($this->imageSize > 200000) {
      $this->error['image'] = "Please Upload Image Less Than 200 KB";
    }
    if (!in_array($this->imageType, ["image/jpeg", "image/jpg", "image/png", "image/gif"])) {
      $this->error['image'] = "Please Upload Images with jpeg, jpg, png or gif extension";
    }
    if (!empty($this->error)) {
      $query_params_1 = http_build_query(['imgerror' => $this->error]);
      header("Location: ../a4.php?" . $query_params_1);
      exit();
    } else {
      return $this->displayImage();
    }
  }

  /**
   *   Stores input image after it has been validated in a folder. And then fetches
   *   input image from folder and displays it in this page itself.
   *
   *   @return void
   *     This function stores the input image in a folder after it has been
   *     validated. Then it displays the input image in this page itself right
   *     under the Full Name.
   */
  public function displayImage()
  {
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
        header("Location: ../a4.php?" . $query_params);
        exit();
      }
    }
  }
}

if (isset($_POST['submit'])) {
  $image = new ImageUpload();
}


?>
