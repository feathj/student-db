<?php
require('main_include.php');

$q = intval($_GET['id']);

$stmt = $db->prepare("SELECT first_name, last_name, tenure FROM teacher WHERE id = '".$q."'");
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $tenure);
$stmt->fetch();
$stmt->close();

if ($tenure) {
	$tenure = "Yes";
} else {
	$tenure = "No";
}

echo "<html><ul><li>Name: ".$first_name." ".$last_name."</li>";
echo "<li>Tenure: ".$tenure."</li></ul></html>";
?>
<a href="teachers.php">Back to All Teachers</a>
