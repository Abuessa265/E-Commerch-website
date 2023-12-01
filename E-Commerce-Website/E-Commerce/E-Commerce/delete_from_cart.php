<?php
include('common_function.php');
if (isset($_GET['product_id'])) {
   $ip = getIpaddress();
   $product_id = $_GET['product_id'];
   $sql = "delete from cart_details where ip_address='$ip' and product_id='$product_id'";
   $res = mysqli_query($con, $sql);

   echo '<script>alert("Item removed from cart")</script>';
   echo '<script>window.open("cart.php","_self")</script>';
}
