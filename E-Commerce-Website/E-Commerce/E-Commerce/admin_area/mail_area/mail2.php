<?php
include('../../const/connection.php');
session_start();
if (isset($_GET['id'])) {
    $data = $_GET['id'];
    $split = explode("/", $data);
    $order_id = $split[0];
    $product_id = $split[1];
    $quantity = $split[2];
    $invoice = $split[3];

    $sql = "select * from pending_orders where order_id = '$order_id' and invoice_number='$invoice'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $row = mysqli_fetch_array($res);
        $user_id = $row['user_id'];
        $user = "select * from user_info where user_id='$user_id'";
        $result = mysqli_query($con, $user);
        if ($result) {
            $row = mysqli_fetch_array($result);
            $username = $row['username'];
            $user_email = $row['user_email'];
            $buy_product = $row['buy_product'];

            $query = "select * from product where p_id  = '$product_id'";
            $result2 = mysqli_query($con, $query);
            if ($result2) {
                $row = mysqli_fetch_array($result2);
                $old_quantity = $row['p_quantity'];
                $new_quantity = $old_quantity - $quantity;


                $sql = "update pending_orders set order_status = 'accepted' where order_id = '$order_id' and invoice_number='$invoice'";
                $res = mysqli_query($con, $sql);
                if ($res) {
                    $sql2 = "update user_orders set order_status = 'accepted' where order_id = '$order_id' and invoice_number='$invoice'";
                    $res2 = mysqli_query($con, $sql2);
                    if ($res2) {
                        $sql3 = "update product set p_quantity = '$new_quantity' where p_id = '$product_id'";
                        $res3 = mysqli_query($con, $sql3);
                        if ($res3) {
                            $sql4 = "delete from pending_orders where product_id = '$product_id' and invoice_number='$invoice'";
                            $res4 = mysqli_query($con, $sql4);
                            if (!$res4) {
                                die(mysqli_error($con));
                                // echo "<script>alert('Order Confirmed')</script>";
                                // echo '<script>window.open("view_orders.php","_self")</script>';
                            }
                        } else {
                            die(mysqli_error($con));
                        }
                    } else {
                        die(mysqli_error($con));
                    }
                } else {
                    die(mysqli_error($con));
                }
            } else {
                die(mysqli_error($con));
            }
        } else {
            die(mysqli_error($con));
        }
    } else {
        die(mysqli_error($con));
    }
}
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-pulse.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alemamsuvo@gmail.com';
    $mail->Password   = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    //$mail->Port       = 587;                                    //TCP port to conect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port       = 465;                                    //TCP port to conect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('19202103242@cse.bubt.edu.bd', 'Administrator');
    $mail->addAddress($user_email);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Order Confirmation';
    // $mail->Body    = file_get_contents("mail_template.php");
    $mail->Body    = ('Hello ' . $username . ',<br>Your order has been confirmed.<br><br>Invoice number of your product is: ' . $invoice . '<strong></strong> <br>Visit your profile for view your product status & details.<br><br>Stay with us. Take Care<br><br><hr>Thanks,<br>The REDHUT-store Team');
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (true) {
        $buy_product = $buy_product + 1;
        $update = "update user_info set buy_product='$buy_product' where username='$username'";
        $update_res = mysqli_query($con, $update);
        if ($update_res) {
            echo '<script>alert("Order Confirmed")</script>';
            echo '<script>window.open("../view_orders.php","_self")</script>';
        } else {
            die(mysqli_error($con));
        }
    } else {
        echo "Email could not be sent.";
    }
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
