<?php
require('main_include.php');
require('main-nav.php');
?>

<?php
$class_id = intval($_GET['id']);

$stmt = $db->prepare("SELECT title, credit_hours FROM class WHERE id = '".$class_id."'");
$stmt->execute();
$stmt->bind_result($title, $credit_hours);
$stmt->fetch();
$stmt->close();

echo "<html><div class='container'><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$title."</li>";
echo "<li class='list-group-item'>Credit Hours: ".$credit_hours."</li></ul>";
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
											$stmtI = $db->prepare('SELECT id, first_name, last_name FROM teacher');
											$stmtI->execute();
											$stmtI->bind_result($id, $first_name, $last_name);
											while ($stmtI->fetch()) {
												echo '<option value="' . $id . '">' . $first_name . ' ' . $last_name . '</option>';
											}
											$stmtI->close();
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
										$stmtII = $db->prepare('SELECT id, first_name, last_name FROM student');
										$stmtII->execute();
										$stmtII->bind_result($sid, $sfirst_name, $slast_name);
										while ($stmtII->fetch()) {
											echo '<input type="checkbox" name="students[]" value="'.$sid.'">'.$sfirst_name.' '.$slast_name.'<br>';
										}
										$stmtII->close();
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