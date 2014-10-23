<?php
require('main_include.php');

$title = $_POST["title"];
$credit_hours = $_POST["credit_hours"];

mysqli_query($db,"INSERT INTO class (title, credit_hours) VALUES ('$title', '$credit_hours')");
mysqli_close($db);

header("Location: classes.php");

?>