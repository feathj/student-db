<?php
require('main_include.php');

$result = mysqli_query($db, "SELECT id, title, credit_hours FROM class");

$json = array();

if (mysqli_num_rows($result)) {
	while ($row = mysqli_fetch_row($result)) {
		$json['courses'][] = $row;
	}
}

mysqli_close($db);

echo json_encode($json);

?>