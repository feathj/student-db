<?php
require('main-nav.php');
?>
<div class="container">
	<h1>Thanks!</h1>

	<?php

	$ref = $_SERVER['HTTP_REFERER'];

	if ($ref == 'http://localhost/~tylerppp/student-db/students.php') {
		echo '<a href="students.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Create Another Student</a>';
	} elseif ($ref == 'http://localhost/~tylerppp/student-db/admin.php') {
		echo '<a href="admin.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Create or Update Another User</a>';
	} else {
		echo '<a href="classes.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Go Back to All Classes</a>';
	}

	?>
</div>