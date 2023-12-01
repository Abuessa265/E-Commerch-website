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
</head>

<body>
  <?php include('const/header.php'); ?>

  <!-- single product details -->
  <?php
  if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    $sql = "select * from `product` where p_id='$p_id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $p_name = $row['p_name'];
    $p_details = $row['p_details'];
    $p_price = $row['p_price'];
    $p_img1 = $row['p_img1'];
    $p_img2 = $row['p_img2'];
    $p_img3 = $row['p_img3'];
    $p_img4 = $row['p_img4'];
    $p_keyword = $row['p_keyword'];
  }
  ?>
  <div class="small-container single-product">
    <div class="row">
      <div class="col-2">
        <?php echo '<img src="product_img/' . $p_img1 . '" width="100%" id="ProductImg" style="height:220px; object-fit:contain"/>'; ?>


        <div class="small-img-row">
          <div class="small-img-col">
            <?php echo '<img src="product_img/' . $p_img2 . '" width="100%" class="SmallImg" style="height:80px; object-fit:cover" />'; ?>
            <!-- <img src="images/gallery-1.jpg" width="100%" class="SmallImg" /> -->
          </div>
          <div class="small-img-col">
            <?php echo '<img src="product_img/' . $p_img3 . '" width="100%" class="SmallImg" style="height:80px; object-fit:cover" />'; ?>
            <!-- <img src="images/gallery-2.jpg" width="100%" class="SmallImg" /> -->
          </div>
          <div class="small-img-col">
            <?php echo '<img src="product_img/' . $p_img4 . '" width="100%" class="SmallImg" style="height:80px; object-fit:cover" />'; ?>
            <!-- <img src="images/gallery-3.jpg" width="100%" class="SmallImg" /> -->
          </div>
          <div class="small-img-col">
            <?php echo '<img src="product_img/' . $p_img1 . '" width="100%" class="SmallImg" style="height:80px; object-fit:cover" />'; ?>
            <!-- <img src="images/gallery-3.jpg" width="100%" class="SmallImg" /> -->
          </div>
        </div>
      </div>
      <div class="col-2">
        <p style="margin-bottom: 15px"><a href="index.php">Home</a> / Product-Details</p>
        <h3><?php echo $p_name; ?></h3>
        <h3 style="margin-top: 25px">Product Details <i class="fa fa-indent"></i></h3>
        <br />
        <p><?php echo $p_details; ?></p>
        <h4><?php echo CURRENCY . $p_price; ?></h4>
        <!-- <select>
          <option>Select Size</option>
          <option>XXL</option>
          <option>XL</option>
          <option>L</option>
          <option>M</option>
          <option>S</option>
        </select> -->
        <?php echo '<a href="add_to_cart.php?add_to_cart=' . $p_id . '" class="btn">Add to Cart</a>'; ?>

      </div>
    </div>
  </div>

  <!-- Title  -->
  <div class="small-container">
    <div class="row row-2">
      <h2>Related Products</h2>
      <a href="products.php?section=1">
        <p>View More &#8594;</p>
      </a>
    </div>
  </div>
  <!-- Products -->

  <div class="small-container">
    <div class="row">
      <?php
      $keyword = explode(",", $p_keyword);
      $size = sizeof($keyword);
      // for ($i = 0; $i < $size; $i++) {
      $sql = "select * from `product` where p_keyword like '%$keyword[0]%' and p_id != '$p_id' limit 4";
      $res = mysqli_query($con, $sql);
      $count = mysqli_num_rows($res);
      if ($count > 0) {
        while ($row = mysqli_fetch_array($res)) {
          $p_id = $row['p_id'];
          $p_name = $row['p_name'];
          $p_price = $row['p_price'];
          $p_img1 = $row['p_img1'];
          //     echo '<div class="col-4">
          //   <img src="product_img/' . $p_img1 . '" />
          //   <h4>' . $p_name . '</h4>
          //   <div class="rating">
          //     <i class="fa fa-star"></i>
          //     <i class="fa fa-star"></i>
          //     <i class="fa fa-star"></i>
          //     <i class="fa fa-star"></i>
          //     <i class="fa fa-star-o"></i>
          //   </div>
          //   <p>' . CURRENCY . $p_price . '</p>
          // </div>';
          echo '<div class="col-4" style="background:#F1F1F1; border-radius:10px">
      <center><a href="product_details.php?p_id=' . $p_id . '"><img class="img-thumbnail" style="background:#F1F1F1;width: 200px;height: 200px;object-fit:contain; margin: 10px 10px !important" src=product_img/' . $p_img1 . ' /></a></center>
      <div class="p-info">
      <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase">' . $p_name . '</h4>
      <div class="rating">
           <i class="fa fa-star"></i>
           <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
           <i class="fa fa-star-o"></i>
         </div>
         <p>' . CURRENCY . '.' . $p_price . '</p>
                      </div>
                      
                      <center><a href="add_to_cart.php?add_to_cart=' . $p_id . '" class="btn" style="margin-top:10px">Add to cart</a></center>
                    
                    </div>';
        }
      } else {
        echo '<center><h2 style="margin: 30px 30px; color: #acad24">Sorry! We don\'t have any related product</h2></center>';
      }
      // }
      ?>
    </div>
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

  <!-- js for toggle gallery -->
  <script>
    var ProductImg = document.getElementById("ProductImg");
    var SmallImg = document.getElementsByClassName("SmallImg");

    SmallImg[0].onclick = function() {
      ProductImg.src = SmallImg[0].src;
    };
    SmallImg[1].onclick = function() {
      ProductImg.src = SmallImg[1].src;
    };
    SmallImg[2].onclick = function() {
      ProductImg.src = SmallImg[2].src;
    };
    SmallImg[3].onclick = function() {
      ProductImg.src = SmallImg[3].src;
    };
  </script>
</body>

</html>