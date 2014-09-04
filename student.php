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
	$stmt = $db->prepare("SELECT first_name, last_name, year FROM student WHERE id = ?");
	$stmt->bind_param('i', $q);
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $year);
	$stmt->fetch();
	$stmt->close();

	$stmtI = $db->prepare("SELECT SUM(class.credit_hours)
							FROM class
							INNER JOIN student_class
							ON class.id=student_class.class_id
							WHERE student_class.student_id=?");
	$stmtI->bind_param('i', $q);
	$stmtI->execute();
	$stmtI->bind_result($credit_hours);
	$stmtI->fetch();
	$stmtI->close();

	echo "<html><div class='container'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
	echo "<li class='list-group-item'>Graduation Year: ".$year."</li>";
	echo "<li class='list-group-item'>Credit Hours: ".$credit_hours."</li></ul>";
} else {
	$stmt = $db->prepare("SELECT first_name, last_name, year FROM student WHERE id = ?");
	$stmt->bind_param('i', $q);
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $year);
	$stmt->fetch();
	$stmt->close();

	$stmtI = $db->prepare("SELECT SUM(class.credit_hours)
							FROM class
							INNER JOIN student_class
							ON class.id=student_class.class_id
							WHERE student_class.student_id=?");
	$stmtI->bind_param('i', $q);
	$stmtI->execute();
	$stmtI->bind_result($credit_hours);
	$stmtI->fetch();
	$stmtI->close();

	echo "<html><div class='container'><h1>Student</h1><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
	echo "<li class='list-group-item'>Graduation Year: ".$year."</li>";
	echo "<li class='list-group-item'>Credit Hours: ".$credit_hours."</li></ul>";
}
?>
<a href="students.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to All Students</a>
		</div>
		<div class="col-md-4 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title"><button id="edit" class="btn btn-default btn-sm" type="button"><span class="h4">Edit</span></button> this Student's Information</h2>
				</div>
				<div class="panel-body">
					<form name="updateStudent" action="" method="post">
						<table class="table">
							<tr>
								<th>
									<label for="firstname">First Name:</label>
								</th>
								<td>
									<input type="text" name="firstname" id="firstname" value="<?php echo $first_name ?>" disabled>
								</td>
							</tr>
							<tr>
								<th>
									<label for="lastname">Last Name:</label>
								</th>
								<td>
									<input type="text" name="lastname" id="lastname" value="<?php echo $last_name ?>" disabled>
								</td>
							</tr>
							<tr>
								<th>
									<label for="year">Year:</label>
								</th>
								<td>
									<input type="number" name="year" id="year" value="<? echo $year ?>" disabled>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input class="btn btn-lg btn-success btn-block" style="margin-top:10px" type="submit" value="Submit" disabled>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="lib/jquery/dist/jquery.js"></script>
	<script>
		$('#edit').click(function () {
			$('input').removeAttr('disabled').attr('required', true);
		});
	</script>
</html>