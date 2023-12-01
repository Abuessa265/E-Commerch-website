<?php
include('common_function.php');
$sql = "select * from user_info";
$res = mysqli_query($con, $sql);
if ($res) {
  $count = 0;
  while ($row = mysqli_fetch_array($res)) {
    $lst_dt = $row['last_mail'];
    $date2 = date("d-m-Y");
    $d1 = date_create($lst_dt);
    $d2 = date_create($date2);
    $diff = date_diff($d1, $d2);
    $result = $diff->format("%a");
    if ($result >= 7) {
      $count++;
    }
  }
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RedHut | E-Commerce</title>
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="stylesheet" href="CSS/popup_delay.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- js for fontawesome kit  -->
  <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>

  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

  <?php
  if (!isset($_SESSION['username'])) {
    echo "<div id='overlay'>
   <div id='popup'>
   <h4 style='line-height:50px; font-weight:bold; text-align: center; margin-top: 5px; margin-bottom:5px; color: green;'>Please Login To Continue</h4>
       <span class='close' onclick='popup()'><i class='bx bxs-x-circle' style='color:rgba(205,7,7,0.88)'></i></span>
       <div class='form-container'>
           <div class='form-btn'>
               <span>Login</span>
               <hr id='Indicator' />
           </div>
           <form id='LoginForm' action='user_area/login.php' method='post'>
               <input style='font-size: 15px' type='text' name='username' placeholder='Username' required />
               <input style='font-size: 15px' type='password' name='password' placeholder='Password' required />
               <br />
               <button type='submit' class='btn' name='Login'>Login</button>
               <a class='forgot' href='forgot_password.php'>Forgot Password?</a>
               <div style='margin-top: 30px'>
                   <p style='font-size: 16px'>Don't have an account? <a href='reg.php' style='color: Green'>Register</a></p>
               </div>
           </form>
       </div>
   </div>
</div>";
  }

  ?>
  <script>
    var delay_popup = 5000;
    setTimeout("document.getElementById('overlay').style.display='block'", delay_popup)

    function popup() {
      setTimeout("document.getElementById('overlay').style.display='none'")
      <?php
      $_SESSION['popup'] = "done";
      ?>
    }
  </script>


  <div class="header">
    <div class="container">
      <?php include('const/header.php') ?>
      <?php include('const/loading.php') ?>
      <div class="row">
        <div class="col-2">
          <h1>
            Browse Our New <br />
            Products
          </h1>
          <p>
            <?php echo 'Buy all our excellent products and avail discount.<br> So, why the delay?' ?>
          </p>
          <a href="products.php?section=1" class="btn">Explore Now &#8594;</a>
        </div>
        <div class="col-2">
          <img src="images/Logo_profile.png" />
        </div>
      </div>
    </div>
  </div>

  <?php AddtoCart(); ?>

  <!-- Featured Products -->
  <div class="small-container">
    <h2 class="title">Latest Products</h2>
    <div class="row">
      <?php getFeaturedProduct(); ?>
    </div>

    <!-- Latest Products -->
    <?php
    $count = IteminLatestProduct();
    if ($count > 0) {
      echo '<h2 class="title">Latest Products</h2>';
    }
    ?>
    <div class="row">
      <?php getLatestProduct(); ?>
    </div>

  </div>

  <!-- Offer Products -->
  <div class="offer">
    <div class="small-container">
      <div class="row">
        <div class="col-2">
          <a href=""><img src="product_img/smartwatch.png" class="offer-img" /></a>
        </div>
        <div class="col-2">
          <p>Exclusively Available on RedStore</p>
          <h1>Smart Watch Havit M90</h1>
          <small>The Havit M90 sports smartwatch is amazing to look and it feels comfortable with the hand. It is a colorful transparent trend watch. This Smartwatch has a 1.14inches HD color display. The Havit M90 sports smartwatch has a colorful band that you can change as you like.</small>
          <a href="index.php?add_to_cart=16" class="btn">Buy Now &#8594;</a>
        </div>
      </div>
    </div>
  </div>

  <?php AddtoCart(); ?>


  <!-- Brands -->
  <div class="brands">
    <div class="small-container">
      <div class="row">
        <div class="col-5">
          <img src="images/logo-godrej.png" />
        </div>
        <div class="col-5">
          <img src="images/logo-oppo.png" />
        </div>
        <div class="col-5">
          <img src="images/logo-coca-cola.png" />
        </div>
        <div class="col-5">
          <img src="images/logo-paypal.png" />
        </div>
        <div class="col-5">
          <img src="images/logo-philips.png" />
        </div>
      </div>
    </div>
  </div>

  <?php
  include('const/footer.php');
  include('const/back_to_top.php');
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
</body>

</html>