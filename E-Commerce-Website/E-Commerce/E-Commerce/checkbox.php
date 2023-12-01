<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="checkbox" name="items[]" value="1">
        <input type="checkbox" name="items[]" value="2">
        <input type="checkbox" name="items[]" value="3">
        <input type="checkbox" name="items[]" value="4">
        <input type="checkbox" name="items[]" value="5">
        <button type="submit" name="submit">Okay</button>
    </form>


    <?php
    $str = "";
    if (isset($_POST['submit'])) {
        if (!empty($_POST['items'])) {
            foreach ($_POST['items'] as $checked) {
                $str = $str . $checked . ",";
                // $str = $str . ",";
            }
        }

        $data = explode(",", $str);
        $size = sizeof($data);
        for ($i = 0; $i < $size - 1; $i++) {
            echo $data[$i] . " = ";
        }
    }
    ?>
</body>

</html>