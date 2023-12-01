<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
            /* height: 280px; */
        }

        /* The popup form - hidden by default */
        .form-popup {
            /* display: none; */
            display: flex;
            justify-content: center;
            align-items: center;
            /* position: fixed; */
            bottom: 0;
            right: 15px;
            /* border: 3px solid #f1f1f1; */
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            margin-top: 80px;
            margin-bottom: 80px;
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=password] {
            width: 100%;
            height: 50px;
            padding: 15px;
            margin: 10px 0 10px 0;
            border: 3px solid white;
            border-radius: 10px;
            background: #f1f1f1;
        }

        .form-container input[placeholder="Username"],
        .form-container input[placeholder="Password"] {
            font-size: small;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            height: 50px;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }

        .row h3 {
            font-size: medium;
        }
    </style>

    <title>Document</title>
</head>

<body>

    <div class="container" style="margin-top:80px">
        <div class="form-popup" id="myForm" style="background: #E4E9F7 !important">
            <form action="login.php" class="form-container" method="post">
                <h1>Login</h1>

                <input type="text" placeholder="Username" name="username" required>

                <input type="password" placeholder="Password" name="password" required>

                <button type="submit" class="btn" name="Login">Login</button>
                <a href="">Forgot password?</a>
            </form>
        </div>
    </div>
</body>

</html>