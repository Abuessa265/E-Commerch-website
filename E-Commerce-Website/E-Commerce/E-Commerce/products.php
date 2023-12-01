<?php
// include('const/connection.php');
include('common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Products - RedHut | E-Commerce</title>
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />

  <!-- js for fontawesome kit  -->
  <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>

  <style>
    body{
      background: radial-gradient(#fff, #ffb006);
    }
  </style>
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
      // getAllProduct();
      if (isset($_GET['section'])) {
        $section = $_GET['section'];
        $sql = "select * from `product` where section = '$section' order by rand() limit 12 ";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {
          $id = $row['p_id'];
          $product_name = $row['p_name'];
          $product_image = $row['p_img1'];
          $product_details = $row['p_details'];
          $product_price = $row['p_price'];
          echo '<div class="col-4" style="background:#F1F1F1; border-radius:10px">
                      <center><a href="product_details.php?p_id=' . $id . '"><img class="img-thumbnail" style="background:#F1F1F1;width: 200px;height: 200px;object-fit:contain; margin: 10px 10px !important" src=product_img/' . $product_image . ' /></a></center>
                      <div class="p-info">
                      <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase">' . $product_name . '</h4>
                      <div class=""> 
                        <h6 style="font-weight:lighter;margin-top:10px">' . $product_details . '</h6>
                      </div>
                      <p>' . CURRENCY . '.' . $product_price . '</p>
                      </div>
                      
                      <center><a href="add_to_cart.php?add_to_cart=' . $id . '" class="btn" style="margin-top:10px">Add to cart</a></center>
                    
                    </div>';
        }
      } else {
        echo "<script>window.open('products.php?section=1','_self')</script>";
      }
      ?>
    </div>

    <?php AddtoCart(); ?>


    <?php
    $product_count = count_all_product();
    echo '<div class="page-btn">';
    for ($i = 1; $i <= $product_count; $i++) {
      if ($i > 4) {
        echo '<span>&#8594;</span>';
      } else {
        if ($i == $section) {
          echo '<a href="products.php?section=' . $i . '"><span class="active">' . $i . '</span></a>';
        } else {
          echo '<a href="products.php?section=' . $i . '"><span>' . $i . '</span></a>';
        }
      }
    }
    echo '</div>';
    ?>
    <!-- <div class="page-btn">
      <span class="active">1</span>
      <span>2</span>
      <span>3</span>
      <span>4</span>
      <span>&#8594;</span>
    </div> -->
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