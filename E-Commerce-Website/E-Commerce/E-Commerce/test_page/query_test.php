<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include('../common_function.php');
    $sql = "select * from user_info";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $count = 0;
        while ($row = mysqli_fetch_array($res)) {
            $lst_dt = $row['last_mail'];
            $date2 = date("d-m-Y");
            $d1 = date_create($lst_dt);
            $d2 = date_create($date2);
            $diff = date_diff($d1, $d2);
            $res = $diff->format("%a");
            if ($res >= 7) {
                $count++;
            }
        }
        if ($count > 0) {
            echo "<script>window.open('mail_area/mail2.php')</script>";
        }
    }
    ?>
</body>

</html>