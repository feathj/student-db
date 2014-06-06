<h1>Thanks!</h1>

<?php

$ref = $_SERVER['HTTP_REFERER'];

if ($ref == 'http://localhost/~tylerppp/student-db/students.php') {
	echo '<a href="students.php">Create Another Student</a>';
} else {
	echo '<a href="admin.php">Create or Update Another User</a>';
}

?>
