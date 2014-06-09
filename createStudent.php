<?php
require('main_include.php');

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$year = $_POST["year"];

mysqli_query($db,"INSERT INTO student (first_name, last_name, year) VALUES ('$firstname', '$lastname', '$year')");
mysqli_close($db);

header("Location: thankyou.php");

?>