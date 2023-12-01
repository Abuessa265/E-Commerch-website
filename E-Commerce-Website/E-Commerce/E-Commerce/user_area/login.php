<?php
session_start();

include('../common_function.php');

if (isset($_POST['Login'])) {
   $ip = getIpaddress();
   $username = $_POST['username'];
   $password = $_POST['password'];

   $check_username = "select * from user_info where username='$username'";
   $check_res = mysqli_query($con, $check_username);
   $row_count = mysqli_num_rows($check_res);
   if ($row_count == 1) {
      $row = mysqli_fetch_array($check_res);
      $pass = $row['user_password'];
      $check_pass = password_verify($password, $pass);
      if ($check_pass) {
         $_SESSION['username'] = $username;
         echo "<script>alert('Login Successful')</script>";
         echo "<script>window.open('../index.php','_self')</script>";
      }else {
      echo "<script>alert('Invalid Password. Try Again')</script>";
      echo "<script>window.open('../account.php','_self')</script>";
   }
   } else {
      echo "<script>alert('Invalid Username. Try Again')</script>";
      echo "<script>window.open('../account.php','_self')</script>";
   }
}
