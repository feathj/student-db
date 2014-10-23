<?php
require('main_include.php');

$assignment_id = $_GET['assignment_id'];
$class_id = $_GET['id'];

foreach ($_POST as $student_id => $letter_grade) {

	mysqli_query($db, "INSERT INTO student_assignment (student_id, assignment_id, letter_grade) VALUES ('$student_id','$assignment_id','$letter_grade')");
}

mysqli_close($db);

header("Location: assignments.php?assignment_id=$assignment_id&id=$class_id");

?>