<?php
require('main_include.php');
require('main-nav.php');
?>

<?php
$class_id = intval($_GET['id']);

$stmt = $db->prepare("SELECT title, credit_hours, teacher_id FROM class WHERE id = ?");
$stmt->bind_param('i', $class_id);
$stmt->execute();
$stmt->bind_result($title, $credit_hours, $teacher_id);
$stmt->fetch();
$stmt->close();

$stmtI = $db->prepare('SELECT student_id FROM student_class WHERE class_id=?');
$stmtI->bind_param('i', $class_id);
$stmtI->execute();
$stmtI->bind_result($sc_id);
$stmtI->fetch();
$stmtI->close();

echo "<html><div class='container'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$title."</li>";
echo "<li class='list-group-item'>Credit Hours: ".$credit_hours.'.0'."</li></ul>";
?>
<a href="classes.php"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to All Classes</a>
		</div>
		<div class="col-md-4 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Give this Class a Teacher and Students</h2>
				</div>
				<div class="panel-body">
					<form name="assign_teacher_student" action="assignTandS.php?class_id=<?php echo $class_id; ?>" method="post">
						<table>
							<tr>
								<th>
									<label for="teachers">Select a teacher:</label>
								</th>
								<td>
									<select name="teachers" id="teachers">
										<?php
											//fetch possible list of teachers from db and display in dropdown menu
											$stmtII = $db->prepare('SELECT id, first_name, last_name FROM teacher');
											$stmtII->execute();
											$stmtII->bind_result($id, $first_name, $last_name);
											while ($stmtII->fetch()) {
												if ($id == $teacher_id) {
													echo '<option value="' . $id . '" selected>' . $first_name . ' ' . $last_name . '</option>';
												} else {
													echo '<option value="' . $id . '">' . $first_name . ' ' . $last_name . '</option>';													
												}
											}	
											$stmtII->close();
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th>
									<label for="students">Select some students:</label>
								</th>
								<td>
									<?php
										$stmtIII = $db->prepare('SELECT id, first_name, last_name FROM student');
										$stmtIII->execute();
										$stmtIII->bind_result($sid, $sfirst_name, $slast_name);
										while ($stmtIII->fetch()) {
											if ($sid == $sc_id) {
												echo '<input type="checkbox" checked="true" name="students[]" value="'.$sid.'">'.$sfirst_name.' '.$slast_name.'<br>';
											} else {
												echo '<input type="checkbox" name="students[]" value="'.$sid.'">'.$sfirst_name.' '.$slast_name.'<br>';												
											}
										}
										$stmtIII->close();
									?>
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