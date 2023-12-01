<?php
// session_start();
$link = $_SERVER['PHP_SELF'];
$status = session_status();
if ($status == PHP_SESSION_NONE) {
   //There is no active session
   session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width,initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="../CSS/style.css" />
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />


   <!-- js for fontawesome kit  -->
   <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>

   <title>RedHut | E-Commerce</title>

   <!--  -->
   <!--  -->

   <!--  -->
   <!--  -->
</head>

<body>
   <div class="container">
      <div class="navbar">
         <div class="logo" style="margin-left: -80px !important">
            <a href="index.php"><img src="images/logo.png" width="125px" /></a>
         </div>
         <nav>
            <ul id="MenuItems" style="font-size:15px; font-family: Arial !important">
               <li><a href="index.php">Home</a></li>
               <li><a href="products.php?section=1">Products</a></li>
               <li><a href="#contact_us">About</a></li>
               <li><a href="#contact_us">Contact</a></li>
               <!-- <li><a href="account.php">Account</a></li> -->
               <?php
               if (isset($_SESSION['username'])) {

                  $username = $_SESSION['username'];
                  echo '<li><a href="../user_area/profile.php">Hi, ' . $username . '</a></li>';
               } else {
                  // echo $link;
                  echo '<li><a href="account.php">Account</a></li>';
               }
               ?>
               <?php
               if ($link != '/products.php' and $link != '/search_product.php') {
                  echo '<li>
                  <div class="search-container">
                     <form action="search_product.php" method="get" style="width: 85% !important">
                        <input class="search" type="text" placeholder="Search.." name="search" style="background:none;height:25px">
                        <button class="search_btn" type="submit" name="submit"><i class="fa fa-search"></i></button>
                     </form>
                  </div>
               </li>';
               }
               ?>

            </ul>
         </nav>
         <a href="cart.php"><img src="images/cart.png" width="30px" height="30px" /><sup><?php echo ItemInCart(); ?></sup></a>
         <img src="images/menu.png" class="menu-icon" onclick="menutoggle()" />
      </div>
   </div>
</body>

</html>