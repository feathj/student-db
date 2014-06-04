<?php
require('main_include.php');

$result = mysqli_query($db, "SELECT id, first_name, last_name FROM student");

$json = array();

if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_row($result)) {
		$json['students'][] = $row;
	}
}

mysqli_close($db);

echo json_encode($json);

?>