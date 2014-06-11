<?php
require('main_include.php');
?>

<?php
$class_id = intval($_GET['id']);

$stmt = $db->prepare("SELECT title, credit_hours FROM class WHERE id = '".$class_id."'");
$stmt->execute();
$stmt->bind_result($title, $credit_hours);
$stmt->fetch();
$stmt->close();

echo "<html><ul><li>Title: ".$title."</li>";
echo "<li>Credit Hours: ".$credit_hours."</li></ul></html>";
?>
<a href="classes.php">Back to All Classes</a>
<h3>Give this Class a Teacher and Students</h3>
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