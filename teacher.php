<?php
require('main_include.php');
require('main-nav.php');

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

echo "<html><div class='container'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
echo "<li class='list-group-item'>Tenure: ".$tenure."</li></ul>";
?>
<a href="teachers.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to All Teachers</a>
		</div>
	</div>
</html>