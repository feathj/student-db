<?php
require('main_include.php');

$id = $_POST["users"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = sha1($_POST["password"]);

mysqli_query($db,"UPDATE user SET email='$email', first_name='$firstname', last_name='$lastname', encrypted_password='$password' WHERE id=$id");
mysqli_close($db);

header("Location: thankyou.php");

?>