<?php
require('main_include.php');

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$tenure = $_POST["tenure"];

mysqli_query($db,"INSERT INTO teacher (first_name, last_name, tenure) VALUES ('$firstname', '$lastname', '$tenure')");
mysqli_close($db);

header("Location: thankyou.php");

?>