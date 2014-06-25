<?php
require('main_include.php');
require('main-nav.php');

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

	echo "<html><div class='container'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
	echo "<li class='list-group-item'>Graduation Year: ".$year."</li>";
	echo "<li class='list-group-item'>Credit Hours: ".$credit_hours."</li></ul>";
} else {
	$stmt = $db->prepare("SELECT first_name, last_name, year, credit_hours FROM student WHERE id = '".$q."'");
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $year, $credit_hours);
	$stmt->fetch();
	$stmt->close();

	echo "<html><div class='container'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
	echo "<li class='list-group-item'>Graduation Year: ".$year."</li>";
	echo "<li class='list-group-item'>Credit Hours: ".$credit_hours."</li></ul>";
}
?>
<a href="students.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to All Students</a>
		</div>
		<div class="col-md-4 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit this Student's Information</h2>
				</div>
				<div class="panel-body">
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
				</div>
			</div>
		</div>
	</div>
</html>