<?php
require('main_include.php');

$assignment_id = $_GET['assignment_id'];

foreach ($_POST as $student_id => $letter_grade) {
	//echo " " . htmlspecialchars($student_id) . " : " . htmlspecialchars($letter_grade) ."<br>";

	mysqli_query($db, "INSERT INTO student_assignment (student_id, assignment_id, letter_grade) VALUES ('$student_id','$assignment_id','$letter_grade')");
}

mysqli_close($db);


header("Location: thankyou.php");

?>