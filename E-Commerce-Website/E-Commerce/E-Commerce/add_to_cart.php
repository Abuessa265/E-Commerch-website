<?php
include('common_function.php');
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $ip = getIpaddress();
    $quantity = 1;
    $sql = "select * from product where p_id='$product_id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $price = $row['p_price'];
    $check_sql = "select * from cart_details where product_id='$product_id' and ip_address='$ip'";
    $result = mysqli_query($con, $check_sql);
    $count_row = mysqli_num_rows($result);
    if ($count_row == 0) {

        $sql = "insert into cart_details (product_id,price,ip_address,quantity) values('$product_id','$price','$ip','$quantity')";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "<script>alert('Item added to cart')</script>";
            // echo "<script>window.open('products.php?section=1','_self')</script>";
            echo "<script>window.history.go(-1);</script>";
            //         echo '<div class="alert alert-success" role="alert">
            //         <strong>Success..<br></strong> Item added to cart
            //  </div>';
        } else {
            die(mysqli_error($con));
        }
    } else {
        echo "<script>alert('This item  is already present inside cart')</script>";
        // echo "<script>window.open('products.php?section=1','_self')</script>";
        echo "<script>window.history.go(-1);</script>";
        //       echo '<div class="alert alert-warning" role="alert">
        //    <strong>Success..<br></strong> This item  is already present inside cart
        //  </div>';
    }
}
