<?php
include('common_function.php');
if (isset($_POST['quantity'])) {
    $ip = getIPAddress();
    $pro_quantity = $_POST['quantity'];
    $p_id = $_POST['pid'];

    $query = "update cart_details set quantity='$pro_quantity' where ip_address='$ip' and product_id='$p_id'";
    $result = mysqli_query($con, $query);
    if (!$result) {
        die(mysqli_error($con));
    } else {
        die(mysqli_error($con));
    }
}
