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
  <?php if (isset($_GET['forgoterror'])) : ?>
    <div class="alert alert-danger" role="alert">
      <div class="container">
        <strong>
          <?php echo htmlspecialchars($_GET['forgoterror']) ?? ''; ?>
        </strong>
      </div>
    </div>
  <?php endif; ?>
  <form class="row g-3 my-4" action="class/ForgotPassword.php" method="post" id="forgotform">
    <div class="mx-auto col-10 col-md-8 col-lg-6">
      <div class="col-md-12 my-3">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Enter Your Email" name="email">
      </div>
      <div class="col-12 mt-4 text-center">
        <button type="submit" class="btn btn-dark" name="submit">Reset Password</button>
      </div>
    </div>
  </form>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
