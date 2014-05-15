<?php
require('main_include.php');

$cfirstname = $_POST["cfirstname"];
$clastname = $_POST["clastname"];
$cemail = $_POST["cemail"];
$cpassword = $_POST["cpassword"];

mysqli_query($db,"INSERT INTO user (email, first_name, last_name) VALUES ('$cemail', '$cfirstname', '$clastname')");
mysqli_close($db);

header("Location: thankyou.php");

?>