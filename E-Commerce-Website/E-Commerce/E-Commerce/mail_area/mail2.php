<?php
// include('../const/connection.php');
date_default_timezone_set("Asia/Dhaka");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');
?>
<?php
$sql = "select * from `user_info`";
$res = mysqli_query($con, $sql);
if ($res) {
    while ($row = mysqli_fetch_array($res)) {
        $user_id = $row['user_id'];
        $user_email = $row['user_email'];
        $lst_dt = $row['last_mail'];

        $date2 = date("d-m-Y");
        $d1 = date_create($lst_dt);
        $d2 = date_create($date2);
        $diff = date_diff($d1, $d2);
        // $diff = date_diff($d1, $d2)->format("%a");
        // echo $diff;
        $result = $diff->format("%a");
        if ($result >= 7) {
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
                //$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('19202103242@cse.bubt.edu.bd', 'Administrator');
                $mail->addAddress($user_email);     //Add a recipient


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Don\'t forget to Add to cart your favorite Hot deals and Mega Deals items And Get amazing discounts, vouchers and many more';
                $mail->Body    = file_get_contents('C:\Users\aryan\Desktop\PROJECT\Web Project-3-modify\mail_area\promotion_mail.php');

                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if ($mail->send()) {
                    $sql2 = "update user_info set last_mail='$date2' where user_id='$user_id'";
                    $res2 = mysqli_query($con, $sql2);
                    // echo '<script>alert("Message has been sent to ' . $user_email . '")</script>';
                } else {
                    echo '<script>alert("Message could not be sent")</script>';
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
    //echo '<script>window.open("../index.php","_self")</script>';
} else {
    die(mysqli_error($con));
}
