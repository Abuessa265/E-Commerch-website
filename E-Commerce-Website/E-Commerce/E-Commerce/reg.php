<?php
include('common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration - RedHut | E-Commerce</title>
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- js for fontawesome kit  -->
  <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .row h3 {
      font-size: medium;
    }
  </style>
</head>

<body>
  <?php include('const/header.php'); ?>

  <!-- Account page  -->
  <div class="account-page">
    <div class="container">
      <div class="row">
        <div class="col-2">
          <img src="images/cvr_img.png" width="100%" />
          <div class="card text-center" style="margin-top: -550px">
            <div class="card-header">
              <strong>CREATE AN ACCOUNT</strong>
            </div>
            <form action="registration.php" method="post">
              <div class="card-body">

                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Name" name="name" required>
                  <span class="input-group-text">@</span>
                  <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="addon-wrapping"><i class='bx bx-envelope' style='color:#545151'></i></span>
                  <input type="text" class="form-control" placeholder="Your Email" name="email" required>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="addon-wrapping"><i class='bx bx-dialpad-alt' style='color:#545151'></i></span>
                  <input type="text" class="form-control" placeholder="Your Phone Number" name="number" required>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="addon-wrapping"><i class='bx bx-home' style='color:#545151'></i></span>
                  <input type="text" class="form-control" placeholder="Primary Address" name="address" required>
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="addon-wrapping"><i class='bx bxs-home'></i></span>
                  <input type="text" class="form-control" placeholder="Secondary Address" name="address2" required>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text" id="addon-wrapping"><i class='bx bxs-key'></i></span>
                  <input type="password" class="form-control" placeholder="Password" name="password" required>
                  <span class="input-group-text"><i class='bx bxs-key bx-rotate-180' style='color:#3a3939'></i></span>
                  <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" required>
                </div>

                <a href="registration.php"><button type="submit" class="btn" style="border-radius:5px; width:150px" name="Register">Register</button></a>
              </div>
            </form>
            <div class="card-footer text-muted">
              Already have an account? <a href="">
                <strong>Login</strong>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>

</html>