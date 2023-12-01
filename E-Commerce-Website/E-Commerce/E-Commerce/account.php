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
  <title>Account - RedHut | E-Commerce</title>
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- js for fontawesome kit  -->
  <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>
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
          <img src="images/Logo_profile.png" width="100%" />
        </div>
        <div class="col-2">
          <div class="form-container">
            <div class="form-btn">
              <span>Login</span>
              <hr id="Indicator" />
            </div>
            <form id="LoginForm" action="user_area/login.php" method="post">
              <input type="text" name="username" placeholder="Username" required />
              <input type="password" name="password" placeholder="Password" required />
              <!-- <input type="checkbox" value="Show Password" /> -->
              <br />
              <button type="submit" class="btn" name="Login">Login</button>
              <a class="forgot" href="forgot_password.php">Forgot Password?</a>
              <div style="margin-top: 30px">
                <p style="font-size: 16px">Don't have an account? <a href="reg.php" style="color: Green">Register</a></p>
              </div>
            </form>

            <form id="RegForm" action="user_area/register.php" method="post">
              <input type="text" name="username" placeholder="Username" required />
              <input type="email" name="email" placeholder="Email" required />
              <input type="password" name="password" placeholder="Password" required />
              <button type="submit" class="btn" name="Register">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- footer  -->
  <?php
  include('const/footer.php');
  ?>
  <!-- js for toggle menu -->
  <script>
    var MenuItems = document.getElementById("MenuItems");
    MenuItems.style.maxHeight = "0px";

    function menutoggle() {
      if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px";
      } else {
        MenuItems.style.maxHeight = "0px";
      }
    }
  </script>

  <!-- js for toggle form -->
  <script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");

    // function register() {
    //   RegFrom.style.transform = "translateX(0px)";
    //   LoginFrom.style.transform = "translateX(0px)";
    //   Indicator.style.transform = "translateX(100px)";
    // }
    // function login() {
    //   RegFrom.style.transform = "translateX(300px)";
    //   LoginFrom.style.transform = "translateX(300px)";
    //   Indicator.style.transform = "translateX(0px)";
    // }
    function register() {
      LoginForm.style.left = "-400px";
      RegForm.style.left = "0px";
      //   Indicator.style.left = "100px";
      Indicator.style.transform = "translateX(100px)";
    }

    function login() {
      LoginForm.style.left = "0px";
      RegForm.style.left = "400px";
      //   Indicator.style.left = "0px";
      Indicator.style.transform = "translateX(0px)";
    }
  </script>
</body>

</html>