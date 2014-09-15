<?php
require('main_include.php');

$class_id = $_GET['class_id'];
$tid = $_POST['teachers'];
$student_count = $_GET['student_count'];

mysqli_query($db,"UPDATE class SET teacher_id = $tid WHERE id=$class_id");

if (isset($_POST['students'])) {
	$students = $_POST['students'];
	foreach ($students as $student_id) {
		//if the amount of students originally on the form is less than the amount of students selected when submitting the form
		if (count($students) < $student_count) {
			$checkedStudents = array();
			foreach ($students as $student_id) {
				$checkedStudents[] = $student_id; //store students from submitted form in variable
			}
			$inStr = "(" . implode(", ", $checkedStudents) . ")";
			mysqli_query($db, "DELETE FROM student_class WHERE class_id = $class_id AND student_id NOT IN ".$inStr);
		break;
		} else {
			mysqli_query($db,"INSERT INTO student_class (student_id, class_id) VALUES ('$student_id', '$class_id')");
		}
	}
}

mysqli_close($db);

header("Location: thankyou.php");

?>