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
  <?php if (isset($_GET['loginerror'])) : ?>
    <div class="alert alert-danger" role="alert">
      <div class="container">
        <strong>
          <?php echo htmlspecialchars($_GET['loginerror']) ?? ''; ?>
        </strong>
      </div>
    </div>
  <?php endif; ?>
  <form class="row g-3 my-5" action="a7/LoginValidation.php" method="post" id="loginform">
    <div class="mx-auto col-10 col-md-8 col-lg-6">
      <div class="col-auto">
        <label class="form-label" for="autoSizingInputGroup">Username</label>
        <div class="input-group">
          <div class="input-group-text">@</div>
          <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Enter Your Username" name="username">
        </div>
      </div>
      <div class="col-md-12 my-3">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Enter Your Email" name="email">
      </div>
      <div class="col-md-12 my-3">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Enter Your Password" name="pass">
      </div>
      <div class="col-12 mt-4 text-center">
        <button type="submit" class="btn btn-dark" name="submit">Login</button>
      </div>
      <div class="col-12 my-3 text-center">
        <a href="forgotpass.php" class="link-light link-offset-2 link-underline link-underline-opacity-0">
        <button type="button" class="btn btn-dark" name="forgot">
            Forgot Password
          </button>
        </a>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
