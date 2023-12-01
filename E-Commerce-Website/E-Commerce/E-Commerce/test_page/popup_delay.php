<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/popup_delay.css">
    <title>Document</title>
    <!-- <style>
        [tabindex="-1"]:focus:not(:focus-visible) {
            outline: 0 !important;
        }

        #overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.8);
            left: 0;
            right: 0;
            z-index: 99999;
            display: none;
        }

        #popup {
            background: #fff;
            padding: 20px;
            max-width: 520px;
            margin: 10% auto;
            position: relative;
            color: #0e0e0e;
        }

        .close {
            position: absolute;
            top: 4px;
            right: 8px;
            font-size: 20px;
            cursor: pointer;
            z-index: 5;
        }
    </style> -->
</head>

<body>
    <div id="overlay">
        <div id="popup">
            <span class="close" onclick="document.getElementById('overlay').style.display='none'"><i class='bx bxs-x-circle' style='color:rgba(205,7,7,0.88)'></i></span>
            <div class="form-container">
                <div class="form-btn">
                    <span>Login</span>
                    <hr id="Indicator" />
                </div>
                <form id="LoginForm" action="user_area/login.php" method="post">
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <br />
                    <button type="submit" class="btn" name="Login">Login</button>
                    <a class="forgot" href="">Forgot Password?</a>
                    <div style="margin-top: 30px">
                        <p style="font-size: 16px">Don't have an account? <a href="reg.php" style="color: Green">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var delay_popup = 2000;
        setTimeout("document.getElementById('overlay').style.display='block'", delay_popup)
    </script>
</body>

</html>