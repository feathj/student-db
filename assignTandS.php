<?php
require('main_include.php');

$class_id = $_GET['class_id'];
$tid = $_POST['teachers'];
$students = $_POST['students'];

mysqli_query($db,"UPDATE class SET teacher_id = $tid WHERE id=$class_id");

foreach ($students as $student_id) {
	mysqli_query($db,"INSERT INTO student_class (student_id, class_id) VALUES ($student_id, $class_id)");
}

mysqli_close($db);

header("Location: thankyou.php");

?>