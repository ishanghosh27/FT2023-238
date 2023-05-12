<?php

include_once('nav.php');

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <form class="row g-3 my-5" enctype="multipart/form-data" action="#" method="post" id="signupform">
    <div class="mx-auto col-10 col-md-8 col-lg-6">
      <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
        <div class="input-group">
          <div class="input-group-text">@</div>
          <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Enter Your Username" name="username">
        </div>
        <div class="error my-1 text-danger">
          <?php echo $_GET['username'] ?? ''; ?>
        </div>
      </div>
      <div class="row g-3 my-1">
        <div class="col-sm-6">
          <label class="form-label" for="specificSizeInputName">First Name</label>
          <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
          <div class="error my-1 text-danger">
            <?php echo $_GET['name'] ?? $_GET['fname'] ?? ''; ?>
          </div>
        </div>
        <div class="col-sm-6">
          <label class="form-label" for="specificSizeInputName">Last Name</label>
          <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
          <div class="error my-1 text-danger">
            <?php echo $_GET['name'] ?? $_GET['lname'] ?? ''; ?>
          </div>
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
          <input type="file" class="form-control" id="img" class="img">
        </div>
      </div>
      <div class="row my-3">
        <div class="form-group">
          <label class="form-label" for="exampleFormControlTextarea1">Subject | Marks</label>
          <textarea class="form-control" name="marks" id="marks" rows="3" placeholder="Enter Subject|Marks"></textarea>
        </div>
      </div>
      <div class="row my-3">
        <div class="col-sm-12">
          <label class="form-label" for="autoSizingInputGroup">Phone Number</label>
          <div class="input-group">
            <div class="input-group-text">+91</div>
            <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone Number" name="phone">
          </div>
        </div>
      </div>
      <div class="col-md-12 my-3">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Enter Your Email" name="email">
        <div class="error my-1 text-danger">
          <?php echo $_GET['email'] ?? ''; ?>
        </div>
      </div>
      <div class="col-md-12 my-3">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Enter Your Password" name="pass">
        <input type="password" class="form-control my-2" id="inputPassword4" placeholder="Re-Enter Your Password" name="repass">
        <div class="error my-1 text-danger">
          <?php echo $_GET['pass'] ?? ''; ?>
        </div>
      </div>
      <div class="col-12 my-4 text-center">
        <button type="submit" class="btn btn-dark" name="submit">Sign Up</button>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
</body>

</html>
