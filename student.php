<?php
require('main_include.php');

$q = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$year = $_POST['year'];

	mysqli_query($db,"UPDATE student SET first_name='$first_name', last_name='$last_name', year='$year' WHERE id=$q");

	echo '<h3>Student Updated!</h3>';
	$stmt = $db->prepare("SELECT first_name, last_name, year, credit_hours FROM student WHERE id = '".$q."'");
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $year, $credit_hours);
	$stmt->fetch();
	$stmt->close();

	echo "<html><ul><li>Name: ".$first_name." ".$last_name."</li>";
	echo "<li>Graduation Year: ".$year."</li>";
	echo "<li>Credit Hours: ".$credit_hours."</li></ul></html>";
} else {
	$stmt = $db->prepare("SELECT first_name, last_name, year, credit_hours FROM student WHERE id = '".$q."'");
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $year, $credit_hours);
	$stmt->fetch();
	$stmt->close();

	echo "<html><ul><li>Name: ".$first_name." ".$last_name."</li>";
	echo "<li>Graduation Year: ".$year."</li>";
	echo "<li>Credit Hours: ".$credit_hours."</li></ul></html>";
}
?>
<h3>Edit this student's information</h3>
<form name="updateStudent" action="" method="post">
	<table>
		<tr>
			<th>
				<label for="firstname">First Name:</label>
			</th>
			<td>
				<input type="text" name="firstname" id="firstname" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="lastname">Last Name:</label>
			</th>
			<td>
				<input type="text" name="lastname" id="lastname" required>
			</td>
		</tr>
		<tr>
			<th>
				<label for="year">Year:</label>
			</th>
			<td>
				<input type="number" name="year" id="year" value="2014" required>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Submit">
			</td>
		</tr>
	</table>
</form>
<a href="students.php">Back to All Students</a>


