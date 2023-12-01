<?php
include('const/connection.php');
date_default_timezone_set("Asia/Dhaka");

$sql = "select * from user_info";
$res = mysqli_query($con, $sql);
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $user_id = $row['user_id'];
        $email = $row['user_email'];
        $lst_dt = $row['last_mail'];

        $date2 = date("d-m-Y");
        $d1 = date_create($lst_dt);
        $d2 = date_create($date2);
        $diff = date_diff($d1, $d2);
        // $diff = date_diff($d1, $d2)->format("%a");
        // echo $diff;
        $res = $diff->format("%a");
        echo $res;
        echo "<br>" . $email;
        sleep(10);
        if ($res >= 7) {
            echo "<script>window.open('mail_area/mail2.php?to_id=$user_id','_self')</script>";
        }
    }
} else {
    die(mysqli_error($con));
}
