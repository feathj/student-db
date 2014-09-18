<?php
require('main_include.php');
require('main-nav.php');
?>

<script src="lib/jquery/dist/jquery.js"></script>
<script src="lib/bootstrap/dist/js/bootstrap.js"></script>

<?php
$class_id = intval($_GET['id']);

$stmt = $db->prepare("SELECT title, credit_hours, teacher_id FROM class WHERE id = ?");
$stmt->bind_param('i', $class_id);
$stmt->execute();
$stmt->bind_result($title, $credit_hours, $teacher_id);
$stmt->fetch();
$stmt->close();

$data = array();
$result = mysqli_query($db, "SELECT student_id FROM student_class WHERE class_id='.$class_id.'");

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	$data[] = $row["student_id"];
}

$student_count = count($data);

echo "<html><div class='container'><h1>Class</h1><div class='row'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$title."</li>";
echo "<li class='list-group-item'>Credit Hours: ".$credit_hours.'.0'."</li></ul>";
?>
<a href="classes.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to All Classes</a>
				<h3>Grade Assignments</h3>
				<ul class="list-group">
					<?php
						$stmtIII = $db->prepare('SELECT id, name FROM assignment WHERE class_id = ?');
						$stmtIII->bind_param('i', $class_id);
						$stmtIII->execute();
						$stmtIII->bind_result($assignment_id, $assignments);
						while ($stmtIII->fetch()) {
							echo "<a href='assignments.php?assignment_id=".$assignment_id."&amp;id=".$class_id."'><li class='list-group-item'>$assignments</li></a>";
						}
						$stmtIII->close();
					?>
				</ul>
				<span class='btn btn-primary btn-md btn-success glyphicon glyphicon-plus' data-toggle='modal' data-target='#myModal' title='Create a New Assignment'></span>
			</div>
			<div class="col-md-4 col-md-offset-0">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Give this Class a Teacher and Students</h2>
					</div>
					<div class="panel-body">
						<form name="assign_teacher_student" action="assignTandS.php?class_id=<?php echo $class_id; ?>&amp;student_count=<?php echo $student_count; ?>" method="post">
							<table class="table">
								<tr>
									<th>
										<label for="teachers">Select a teacher:</label>
									</th>
									<td>
										<select name="teachers" id="teachers">
											<?php
												//fetch possible list of teachers from db and display in dropdown menu
												$stmtI = $db->prepare('SELECT id, first_name, last_name FROM teacher');
												$stmtI->execute();
												$stmtI->bind_result($id, $first_name, $last_name);
												while ($stmtI->fetch()) {
													if ($id == $teacher_id) {
														echo '<option value="' . $id . '" selected>' . $first_name . ' ' . $last_name . '</option>';
													} else {
														echo '<option value="' . $id . '">' . $first_name . ' ' . $last_name . '</option>';													
													}
												}	
												$stmtI->close();
											?>
										</select>
									</td>
								</tr>
								<tr>
									<th>
										<label>Select some <br>students:</label>
									</th>
									<td class="checkbox" style="padding-left:18">
										<?php
											$stmtII = $db->prepare('SELECT id, first_name, last_name FROM student');
											$stmtII->execute();
											$stmtII->bind_result($sid, $sfirst_name, $slast_name);
											while ($stmtII->fetch()) {
												if (in_array($sid, $data)) {
													echo '<input type="checkbox" checked="true" name="students[]" id="'.$sid.'" value="'.$sid.'"><label for="'.$sid.'">'.$sfirst_name.' '.$slast_name.'</label><br>';
												} else {
													echo '<input type="checkbox" name="students[]" id="'.$sid.'" value="'.$sid.'"><label for="'.$sid.'">'.$sfirst_name.' '.$slast_name.'</label><br>';												
												}
											}
											$stmtII->close();
										?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input class="btn btn-lg btn-success btn-block" style="margin-top:10px" type="submit" value="Submit">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="myModalLabel">Create a New Assignment</h4>
						</div>
						<div class="modal-body">

							<form name="create_assignment" action="make_assignment.php?class_id=<?php echo $class_id; ?>" method="post">
								<table class="table">
									<tr>
										<th>
											<label for="title">Name:</label>
										</th>
										<td>
											<input type="text" id="title" name="title">
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input class="btn btn-lg btn-success btn-block" style="margin-top:10px" type="submit" value="Submit">
										</td>
									</tr>
								</table>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</html>