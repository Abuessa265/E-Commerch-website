<?php
session_start();
include('common_function.php');
$discount = 0;
$total_buy_amount=0;
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  $sql = "select * from user_info where username='$username'";
  $res = mysqli_query($con, $sql);
  if ($res) {
    $row = mysqli_fetch_array($res);
    $buy_product = $row['buy_product'];
    // $discount = $row['discount'];
    $total_buy_amount = getTotalAmount($row['user_id']);
    $get_discount = $row['get_discount'];
  } else {
    die(mysqli_error($con));
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart - RedHut | E-Commerce</title>
  <link rel="stylesheet" href="CSS/style.css" />
  <link rel="stylesheet" href="CSS/popup_delay.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Ubuntu:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />



</style>
  <!-- js for fontawesome kit  -->
  <script src="https://kit.fontawesome.com/f4edef5943.js" crossorigin="anonymous"></script>

  <!--  -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <!--  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    body{
      background: radial-gradient(#fff, #ffb006);
    }
  </style>

</head>

<body>
  <?php include('const/header.php'); ?>



  <!-- Cart items details -->
  <div class="small-container cart-page">
    <!-- 
    <?php
    if (isset($_SESSION['username'])) {
      echo "<div style='display: flex'>
      <p style='font-size:14px'>Discount:</p>
      <i class='bx bxs-discount' style='color:#d7dd40;margin-right: -28px;z-index: 9;margin-left: 5px;'></i>
      <input type='text' readonly style='width: 80px;height: 25px;margin-left: 5px;margin-top: -3px;border: 1px solid gray;border-radius: 13px; font-size: 10px' value='           " . CURRENCY . ". " . $buy_product * 10 . "'>
    </div>";
    }
    ?>
 -->
    <table>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>


      <?php
      $ip = getIpaddress();
      $sql = "select * from cart_details where ip_address = '$ip'";
      $res = mysqli_query($con, $sql);
      $item_in_cart = mysqli_num_rows($res);
      if (mysqli_num_rows($res) > 0) {
        if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $product_sql = "select * from product where p_id='$product_id'";
            $result = mysqli_query($con, $product_sql);
            while ($product_row = mysqli_fetch_assoc($result)) {
              $image = $product_row['p_img1'];
              $name = $product_row['p_name'];
              $price = $product_row['p_price'];
              $total = $price * $quantity;
              echo '<tr>
          <td>
            <div class="cart-info">
            <a href="delete_from_cart.php?product_id=' . $product_id . '"><img style="height: 20px; width:20px; margin-top: 25px" src="images/cancel.png"/></a>
            
              <img style="object-fit:contain" src=product_img/' . $image . ' />
              <div>
                <p style="text-transform: uppercase">' . $name . '</p>
                <small>Price: ' . CURRENCY . '.' . $price . '</small>
                <br />
                
              </div>
            </div>
          </td>';
              if ($quantity > 1) {
                echo '<td><a href="update_quantity.php?value=minus/' . $product_id . '" style="margin-right: 8px; text-decoration:none; color: black;"><i class="fa-solid fa-minus"></i></a><input name="cart_update" type="text" id="pro_quantity" style="font-size: 15px; width:30px; text-align:center !important" value=' . $quantity . ' onchange="update_quantity()"><a href="update_quantity.php?value=plus/' . $product_id . '" style="margin-left: 8px; text-decoration:none; color: black;"><i class="fa-solid fa-plus"></i></a><input type="text" id="pq" value=' . $product_id . ' style="border:none;outline:none;color:white;cursor:default" readonly></td>
          <td>' . CURRENCY . '.' . $total . '</td>
        </tr>';
              } else {
                echo '<td><a href="update_quantity.php?value=minus/' . $product_id . '" style="margin-right: 8px; text-decoration:none; color: black; pointer-events:none;"><i class="fa-solid fa-minus"></i></a><input name="cart_update" type="text" id="pro_quantity" style="font-size: 15px; width:30px; text-align:center !important" value=' . $quantity . ' onchange="update_quantity()"><a href="update_quantity.php?value=plus/' . $product_id . '" style="margin-left: 8px; text-decoration:none; color: black;"><i class="fa-solid fa-plus"></i></a><input type="text" id="pq" value=' . $product_id . ' style="border:none;outline:none;color:white;cursor:default" readonly></td>
            <td>' . CURRENCY . '.' . $total . '</td>
          </tr>';
              }
              // echo '<hr>';
              // <i class="fa-duotone fa-minus"></i>
              // <i class="fa-duotone fa-plus"></i>
            }
          }
        } else {
          die(mysqli_error($con));
        }
      } else {
        echo '<td><div class="alert alert-warning" role="alert">
                          <h3>Oops! Your Cart is empty add some product to your cart   </h3>
                        </div></td>';
      }
      ?>


    </table>
    <script>
      function update_quantity() {
        var quantity = document.getElementById("pro_quantity").value;
        var id = document.getElementById("pq").value;
        var httpr = new XMLHttpRequest();
        httpr.open("POST", "update_product_quantity.php", true);
        httpr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        httpr.onreadystatechange = function() {
          if (httpr.readyState == 4 && httpr.status == 200) {
            window.location.reload();
          }

        }
        if (quantity > 0 && quantity <= 15) {
          // alert("quantity=" + quantity + "&pid=" + id);
          httpr.send("quantity=" + quantity + "&pid=" + id);
        } else if (quantity <= 0) {
          alert("Your minimum quantity must be 1");
        } else if (quantity > 15) {
          alert("You can set maximum quantity 15");
        }
      }
    </script>
    <?php
    $ip = getIpaddress();
    $sql = "select * from cart_details where ip_address = '$ip'";
    $res = mysqli_query($con, $sql);
    $count_row = mysqli_num_rows($res);
    $stotal = 0;
    // $tax = $count_row * 10;
    $tax = 0;
    $subtotal = 0;
    $total_quantity = 0;
    if ($res) {
      while ($row = mysqli_fetch_assoc($res)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $total_quantity += $quantity;
        $product_sql = "select * from product where p_id='$product_id'";
        $result = mysqli_query($con, $product_sql);
        while ($product_row = mysqli_fetch_assoc($result)) {
          $image = $product_row['p_img1'];
          $name = $product_row['p_name'];
          $price = $product_row['p_price'];
          $total = $price * $quantity;
          $stotal += $total;
        }
      }
      $tax = $total_quantity * 10;
      $subtotal = $stotal + $tax;
    } else {
      die(mysqli_error($con));
    }
    ?>
    <div class="total-price">
      <table>
        <tr>
          <td>Total</td>
          <td>
            <?php
              echo '' . CURRENCY . '. ' . $stotal . '';
            ?>
          </td>
        </tr>
        <tr>
          <td>Tax</td>
          <td><?php echo '' . CURRENCY . '. ' . $tax . ''; ?></td>
        </tr>
        <tr>
          <td>
            Applied Discount
          </td>
          <td>
            <?php
              $discount = getDiscount($total_buy_amount,($stotal+$tax));
              echo  CURRENCY . '. '.$discount;
            ?>
          </td>
        </tr>
        <tr>
          <td>SubTotal <span class="h6">(Round)</span></td>
          <td>
            <?php
            if (isset($_SESSION['username'])) {
              if ($discount < $subtotal and $get_discount == 0) {
                $subtotal = round($subtotal - $discount);
                echo '' . CURRENCY . '. ' . $subtotal . '';
              } else {
                echo '' . CURRENCY . '. ' . $subtotal . '';
              }
            } else {
              echo '' . CURRENCY . '. ' . $subtotal . '';
            }
            
            ?>
          </td>
        </tr>


        <tr>

          <?php
          $session = false;
          if (isset($_SESSION['username'])) {
            $session = true;
          }
          $cart_item = ItemInCart();

          if ($cart_item > 0) {

            if (!isset($_SESSION['username'])) {
              //   echo '<td><a href="products.php" class="btn">Shopping</a></td>
              // <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="border:none; !important">Checkout</button></td>';
              echo '<td><a href="products.php" class="btn">Shopping</a></td>
            <td><button type="button" class="btn btn-primary" onclick="show_popup()" style="border:none; !important">Checkout</button></td>';
            } else {
              echo '<td><a href="products.php" class="btn">Shopping</a></td>
             <td><button type="button" class="btn btn-primary" onclick="show_payment_popup()" style="border:none; !important">Checkout</button></td>';
            }

            // echo '<td><a href="products.php" class="btn">Shopping</a></td>
            // <td><a href="checkout.php" class="btn">Checkout</a></td>';
          } else {

            echo '<td><a href="products.php" class="btn">Shopping</a></td>';
          }
          ?>
          <!-- <td><a href="products.php" class="btn">Shopping</a></td>
          <td><a href="checkout.php" class="btn">Checkout</a></td> -->
        </tr>
      </table>
    </div>
  </div>




  <div id='overlay'>
    <div id='popup'>
      <h4 style='line-height:50px; font-weight:bold; text-align: center; margin-top: 5px; margin-bottom:5px; color: green;'>Please Login To Checkout</h4>
      <span class='close' onclick='cancel_popup()'><i class='bx bxs-x-circle' style='color:rgba(205,7,7,0.88)'></i></span>
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
  </div>

  <div id='overlay_2'>
    <div id='popup'>
      <h4 style='line-height:50px; font-weight:bold; text-align: center; margin-top: 5px; margin-bottom:5px; color: green;'>Select a payment method</h4>
      <span class='close' onclick='cancel_popup_2()'><i class='bx bxs-x-circle' style='color:rgba(205,7,7,0.88)'></i></span>
      <div class='form-container'>
        <div>
          <h5 style="color: #d42c2c;margin-bottom:42px" id="msg">Currently Not available</h5>
        </div>
        <div style="margin-bottom: 120px">
          <label class="radio_img" onclick="done()">
            <input type="radio" name="test" value="small" checked>
            <img src="images/cod.png" alt="" style="height:70px;width:70px;object-fit:contain">
          </label>

          <label onclick="showmsg()">
            <input type="radio" name="test" value="big">
            <img src="images/bkash.png" alt="" style="height:70px;width:70px;object-fit:contain">
          </label>
          <label onclick="showmsg()">
            <input type="radio" name="test" value="big">
            <img src="images/nagad.png" alt="" style="height:70px;width:70px;object-fit:contain">
          </label>
        </div>
        <br>
        <center><a href="confirm_order.php?data=<?php echo $subtotal; ?>/<?php echo $item_in_cart; ?>" class="btn btn-primary" role="button" aria-disabled="true" style="margin-bottom:-5px; border:none" id="btn">Confirm Order</a></center>

      </div>
    </div>
  </div>


  <script>
    function showmsg() {
      let x = document.getElementById("msg");
      let y = document.getElementById("btn");
      x.style.display = "block";
      y.style.display = "none";
    }

    function done() {
      let x = document.getElementById("msg");
      let y = document.getElementById("btn");
      y.style.display = "block";
      x.style.display = "none";
    }
  </script>



  <script>
    function show_popup() {
      document.getElementById('overlay').style.display = 'block';
    }

    function show_payment_popup() {
      document.getElementById('overlay_2').style.display = 'block';
    }
    // var delay_popup = 5000;
    // setTimeout("document.getElementById('overlay').style.display='block'", delay_popup)

    function cancel_popup() {
      setTimeout("document.getElementById('overlay').style.display='none'")
      <?php
      $_SESSION['popup'] = "done";
      ?>
    }

    function cancel_popup_2() {
      setTimeout("document.getElementById('overlay_2').style.display='none'")
      <?php
      $_SESSION['popup'] = "done";
      ?>
    }
  </script>

  <!--  -->
  <!--  -->
  <!--  -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- <div class="modal-dialog"> -->
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class='form-container'>
            <div class='form-btn'>
              <span>Login</span>
              <hr id='Indicator' />
            </div>
            <form id='LoginForm' action='user_area/login.php' method='post'>
              <input style='font-size: 15px; margin-top:-8px !important' type='text' name='username' placeholder='Username' required />
              <input style='font-size: 15px; margin-top:-8px !important' type='password' name='password' placeholder='Password' required />
              <br />
              <button type='submit' class='btn' name='Login' style='margin-top:5px; background: #ff1e00; height:40px; line-height:10px !important'>Login</button>
              <a class='forgot' href=''>Forgot Password?</a>
              <div style='margin-top: 30px'>
                <p style='font-size: 16px'>Don't have an account? <a href='reg.php' style='color: Green'>Register</a></p>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


  <script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
    })
  </script>
  <!--  -->
  <!--  -->
  <!--  -->



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

  <!-- footer  -->
  <?php
  include('const/footer.php');
  include('const/back_to_top.php');
  ?>

</body>

</html>