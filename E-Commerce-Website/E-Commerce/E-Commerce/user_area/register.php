<?php
include('../common_function.php');

if (isset($_POST['Register'])) {
   $ip = getIpaddress();
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];

   $check_username = "select * from user_info where username='$username'";
   $check_res = mysqli_query($con, $check_username);
   $row_count = mysqli_num_rows($check_res);
   if ($row_count > 0) {
      echo "<script>alert('Username already exists. Try again')</script>";
      echo "<script>window.open('../account.php','_self')</script>";
   } else {
      $hashing_password = password_hash($password, PASSWORD_BCRYPT);

      $sql = "insert into user_info(username,user_email,user_password,user_ip,user_address,user_mobile) values('$username','$email','$hashing_password','$ip','','')";
      $res = mysqli_query($con, $sql);
      if ($res) {
         //    echo '<div class="alert alert-success" role="alert">
         //    Registration Successful
         //  </div>';
         echo "<script>alert('Registration Successful')</script>";
         echo "<script>window.open('../account.php','_self')</script>";
      } else {
         echo '<div class="alert alert-danger" role="alert">
      Registration Failed
    </div>';
         die(mysqli_error($con));
      }
   }
}
