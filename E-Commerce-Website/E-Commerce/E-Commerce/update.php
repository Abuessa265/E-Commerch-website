<?php
include('common_function.php');
if (isset($_GET['product_id'])) {
   $ip = getIpaddress();
   $product_id = $_GET['product_id'];
   $quantity = $_COOKIE['quantity'];

   $sql = "update cart_details set quantity='$quantity' where ip_address='$ip' and product_id='$product_id'";
   $res = mysqli_query($con, $sql);

   //echo "<script>createCookie(cookie_name, "", -1)</script>";
   echo '<script>window.open("cart.php","_self")</script>';
}
