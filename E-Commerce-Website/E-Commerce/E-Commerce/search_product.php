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
   <title>Searched Products - RedHut | E-Commerce</title>
   <link rel="stylesheet" href="CSS/style.css" />
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />
   <!-- js for fontawesome kit  -->
   <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>
</head>

<body>
   <?php include('const/header.php'); ?>


   <!-- Featured Products -->

   <div class="small-container">
      <div class="row row-2">
         <h2>All Products</h2>
         <div class="search-container">
            <form action="search_product.php" method="get" style="width: 85% !important">
               <input class="search" type="text" placeholder="Search.." name="search">
               <button class="search_btn" type="submit" name="submit"><i class="fa fa-search"></i></button>
            </form>
         </div>
      </div>
      <div class="row">
         <?php
         searchItem();
         ?>
      </div>

      <?php AddtoCart(); ?>


   </div>

   <!-- footer  -->
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