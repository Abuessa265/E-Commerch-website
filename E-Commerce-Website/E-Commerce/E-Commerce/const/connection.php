<?php
define("CURRENCY", "৳");

$server = "localhost";
$username = "root";
$password = "";
$db = "e-commerce";

$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
   die("Connection Failed" . mysqli_connect_error());
}
