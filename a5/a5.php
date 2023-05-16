<?php

include_once('../anav.php');

$error = $_GET['error'] ?? [];
$imgerror = $_GET['imgerror'] ?? [];
$markserror = $_GET['markserror'] ?? [];
$phoneerror = $_GET['phoneerror'] ?? [];
$emailerror = $_GET['emailerror'] ?? [];

$fnameError = $error['fname'] ?? '';
$lnameError = $error['lname'] ?? '';
$imageError = $imgerror['image'] ?? '';
$marksError = $markserror['marks'] ?? '';
$phoneError = $phoneerror['phone'] ?? '';
$emailError = $emailerror['email'] ?? '';

?>

<head>
  <link rel="stylesheet" href="../css/style.css">
</head>

<form class="row g-3 my-2" action="class/EmailValidation.php" enctype="multipart/form-data" method="post" id="form">
  <div class="mx-auto col-10 col-md-8 col-lg-6">
    <div class="row g-3 my-1">
      <div class="col-sm-6">
        <label class="form-label" for="specificSizeInputName">First Name</label>
        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
        <?php if (!empty($fnameError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $fnameError ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-sm-6">
        <label class="form-label" for="specificSizeInputName">Last Name</label>
        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
        <?php if (!empty($lnameError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $lnameError ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-sm-12">
        <label class="form-label" for="specificSizeInputName">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" disabled>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-sm-12">
        <label class="form-label" for="customFile">Upload Profile Picture</label>
        <input type="file" class="form-control" id="image" class="image" name="image">
        <?php if (!empty($imageError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $imageError ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-sm-12">
        <label class="form-label" for="exampleFormControlTextarea1">Subject | Marks</label>
        <textarea class="form-control" name="marks" id="marks" rows="3" placeholder="Enter Subject|Marks"></textarea>
        <?php if (!empty($marksError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $marksError ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-sm-12">
        <label class="form-label" for="autoSizingInputGroup">Phone Number</label>
        <div class="input-group">
          <div class="input-group-text">+91</div>
          <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone Number" name="phone">
        </div>
        <?php if (!empty($phoneError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $phoneError ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-sm-12">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="Enter Your Email" name="email" id="email">
        <?php if (!empty($emailError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $emailError ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="col-12 my-4 text-center">
    <button type="submit" class="btn btn-dark" name="submit">Enter Details</button>
  </div>
</form>

<script src="../js/script.js"></script>
