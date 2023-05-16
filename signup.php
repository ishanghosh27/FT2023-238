<?php

include_once('nav.php');

session_start();
if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['pass'])) {
  $loginError = "User Is Already Logged In. Please Log Out In Order To Sign In New User";
  header("location: login.php?loginerror=" . urlencode($loginError));
  exit();
}

$uiderror = $_GET['uiderror'] ?? [];
$fnameerror = $_GET['nameerror'] ?? [];
$lnameerror = $_GET['nameerror'] ?? [];
$phoneerror = $_GET['phoneerror'] ?? [];
$emailerror = $_GET['emailerror'] ?? [];
$passerror = $_GET['passerror'] ?? [];
$signup = $_GET['signedup'] ?? [];

$uidError = $uiderror['username'] ?? '';
$fnameError = $fnameerror['fname'] ?? '';
$lnameError = $lnameerror['lname'] ?? '';
$phoneError = $phoneerror['phone'] ?? '';
$emailError = $emailerror['email'] ?? '';
$passError = $passerror['pass'] ?? '';
$signupSuccess = $signup['submit'] ?? '';

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body onload="populateForm()">
  <form class="row g-3 my-5" enctype="multipart/form-data" action="class/ValidateData.php" method="post" id="form" onsubmit="storeFormData()">
    <div class="mx-auto col-10 col-md-8 col-lg-6">
      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
        <div class="input-group">
          <div class="input-group-text">@</div>
          <input type="text" class="form-control" id="username" placeholder="Enter Your Username" name="username">
        </div>
        <?php if (!empty($uidError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $uidError ?>
          </div>
        <?php endif; ?>
      </div>
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
      <div class="col-md-12 my-3">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email">
        <?php if (!empty($emailError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $emailError ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-md-12 my-3">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Enter Your Password" name="pass">
        <input type="password" class="form-control my-2" id="inputPassword4" placeholder="Re-Enter Your Password" name="repass">
        <?php if (!empty($passError)) : ?>
          <div class="alert alert-danger my-1 text-danger" role="alert">
            <?php echo $passError ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-12 my-4 text-center">
        <button type="submit" class="btn btn-dark" name="submit" id="submit">Sign Up</button>
        <?php if (!empty($signupSuccess)) : ?>
          <div class="alert alert-success my-2 text-success" role="alert">
            <strong>
              <?php echo $signupSuccess ?>
            </strong>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>

</html>
