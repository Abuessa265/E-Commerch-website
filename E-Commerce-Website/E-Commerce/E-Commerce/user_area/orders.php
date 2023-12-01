<?php
session_start();
include('../common_function.php');
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font awesome link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css bootstrap link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="side-bar">
        <div class="logo-details">
            <i class="bx fa-user"></i>
            <div class="logo_name">Profile</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">

            <li>
                <a href="../index.php" class="aa">
                    <i class='bx bx-home' name="profile"></i>
                    <span class="links_name" name="profile">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li>
            <li>
                <form action="profile.php" method="post">
                    <a href="profile.php" class="aa">
                        <i class='bx bx-user' name="profile"></i>
                        <!-- <span class="links_name" name="profile">Profile</span> -->
                        <input type="submit" class="links_name" name="Profile" value="Profile"></input>
                    </a>
                </form>
                <span class="tooltip">Profile</span>
            </li>
            <li>
                <form action="orders.php" method="get">
                    <a href="orders.php?value=my_order" class="aa">
                        <!-- <i class='bx bx-chat'></i> -->
                        <i class='bx bx-cart-alt' name="my_orders"></i>
                        <!-- <span class="links_name" name="my_orders">My Orders</span> -->
                        <input type="submit" class="links_name" name="value" value="My Orders"></input>
                    </a>
                </form>
                <span class="tooltip">My Orders</span>
            </li>
            <li>
                <form action="orders.php" method="get">
                    <a href="orders.php?value=pending_orders" class="aa">
                        <i class='bx bx-cart' name="pending_orders"></i>
                        <input type="submit" class="links_name" name="value" value="Pending Orders"></input>
                    </a>
                </form>
                <span class="tooltip">Pending Orders</span>
            </li>
            <li>
                <form action="" method="post">
                    <a href="#" class="aa">
                        <i class='bx bx-key'></i>
                        <span class="links_name">Change Password</span>
                    </a>
                </form>
                <span class="tooltip">Change Password</span>
            </li>
            <li>
                <form action="" method="post">
                    <a href="#" class="aa">
                        <!-- <i class='bx bx-message-square-x'></i> -->
                        <i class='bx bx-trash'></i>
                        <span class="links_name">Delete Account</span>
                    </a>
                </form>
                <span class="tooltip">Delete Account</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <a href="profile.php" class="">
                        <div class="name"><?php echo $username; ?></div>
                    </a>
                </div>
                <a href="logout.php" class=""><i class='bx bx-log-out' id="log_out"></i></a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="text">Order Details</div>
        <div class="show-data">
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".side-bar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
            sidebar.classList.toggle("open");
            menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
            }
        }
    </script>
</body>

</html>