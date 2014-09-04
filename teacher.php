<?php
require('main_include.php');
require('main-nav.php');

$q = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$first_name = $_POST['firstname'];
	$last_name = $_POST['lastname'];
	$tenure = $_POST['tenure'];

	mysqli_query($db,"UPDATE teacher SET first_name='$first_name', last_name='$last_name', tenure='$tenure' WHERE id=$q");

	$stmt = $db->prepare("SELECT first_name, last_name, tenure FROM teacher WHERE id = ?");
	$stmt->bind_param('i', $q);
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $tenure);
	$stmt->fetch();
	$stmt->close();

	if ($tenure) {
		$tenure = "Yes";
	} else {
		$tenure = "No";
	}

	echo "<html><div class='container'><h1>Teacher Updated!</h1><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
	echo "<li class='list-group-item'>Tenure: ".$tenure."</li></ul>";
} else {
	$stmt = $db->prepare("SELECT first_name, last_name, tenure FROM teacher WHERE id = ?");
	$stmt->bind_param('i', $q);
	$stmt->execute();
	$stmt->bind_result($first_name, $last_name, $tenure);
	$stmt->fetch();
	$stmt->close();

	if ($tenure) {
		$tenure = "Yes";
	} else {
		$tenure = "No";
	}

	echo "<html><div class='container'><h1>Teacher</h1><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$first_name." ".$last_name."</li>";
	echo "<li class='list-group-item'>Tenure: ".$tenure."</li></ul>";
}
?>
<a href="teachers.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to All Teachers</a>
		</div>
		<div class="col-md-4 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title"><button id="edit" class="btn btn-default btn-sm" type="button"><span class="h4">Edit</span></button> this Teacher's Information</h2>
				</div>
				<div class="panel-body">
					<form name="updateTeacher" action="" method="post">
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
									<label for="tenure">Tenure:</label>
								</th>
								<td>
									<input type="radio" name="tenure" id="tenure" value="1" disabled <?php if ($tenure == "Yes") {?>checked<?php } ?>>Yes
									<input type="radio" name="tenure" id="tenure" value="0" disabled <?php if ($tenure == "No") {?>checked<?php } ?>>No
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