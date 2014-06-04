<?php
require('main_include.php');

$q = intval($_GET['id']);

$stmt = $db->prepare("SELECT first_name, last_name, year, credit_hours FROM student WHERE id = '".$q."'");
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $year, $credit_hours);
$stmt->fetch();
$stmt->close();

echo "<html><ul><li>Name: ".$first_name." ".$last_name."</li>";
echo "<li>Graduation Year: ".$year."</li>";
echo "<li>Credit Hours: ".$credit_hours."</li></ul></html>";
?>