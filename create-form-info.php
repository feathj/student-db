<?php
require('main_include.php');

$cfirstname = $_POST["cfirstname"];
$clastname = $_POST["clastname"];
$cemail = $_POST["cemail"];
$cpassword = sha1($_POST["cpassword"]);

mysqli_query($db,"INSERT INTO user (email, first_name, last_name, encrypted_password) VALUES ('$cemail', '$cfirstname', '$clastname', '$cpassword')");
mysqli_close($db);

header("Location: thankyou.php");

?>