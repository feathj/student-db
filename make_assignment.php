<?php
require('main_include.php');

$assignment = $_POST['title'];
$class_id = $_GET['class_id'];

mysqli_query($db,"INSERT INTO assignment (name, class_id) VALUES ('$assignment', '$class_id')");

mysqli_close($db);

header("Location: class.php?id=$class_id");

?>