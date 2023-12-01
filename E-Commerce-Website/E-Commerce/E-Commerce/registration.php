<?php
session_start();
include('common_function.php');

if (isset($_POST['Register'])) {
    $ip = getIPAddress();
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $address2 = $_POST["address2"];
    $number = $_POST["number"];
    $encrypt_password = "";
    if ($password == $cpassword) {
        $encrypt_pass = password_hash($password, PASSWORD_BCRYPT);

        // $check_pass = password_verify($pass,$encrypt_pass);
    }
    date_default_timezone_set("Asia/Dhaka");
    $today = date("d-m-Y");
    $sql = "insert into user_info (name,username,user_email,user_password,user_ip,user_address,user_address2,user_mobile,user_img,buy_product,get_discount,discount,last_mail) values('$name','$username','$email','$encrypt_pass','$ip','$address','$address2','$number','NULL','0','0','0','$today')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Registration Successful')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        die(mysqli_error($con));
    }
} else {
    echo "<script>alert('Registration Failed! Try Again')</script>";
    echo "<script>window.open('reg.php','_self')</script>";
}
