<?php
require('main_include.php');
require('main-nav.php');

$q = intval($_GET['assignment_id']);
$r = intval($_GET['id']);

$stmt = $db->prepare("SELECT name FROM assignment WHERE id = ?");
$stmt->bind_param('i', $q);
$stmt->execute();
$stmt->bind_result($assignment);
$stmt->fetch();
$stmt->close();

$stmtI = $db->prepare("SELECT title FROM class WHERE id = ?");
$stmtI->bind_param('i', $r);
$stmtI->execute();
$stmtI->bind_result($class);
$stmtI->fetch();
$stmtI->close();

$data = array();
$result = mysqli_query($db, "SELECT student_id FROM student_class WHERE class_id='.$r.'");

while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
	$data[] = $row["student_id"];
}

echo "<html><div class='container'><h1>Assignment <span class='small'>for $class</span></h1><div class='col-md-4 col-md-offset-0'><ul class='list-group details'><li class='list-group-item'>".$assignment."</li></ul>";

?>
<a href="class.php?id=<?php echo $r; ?>"><div class="glyphicon glyphicon-arrow-left"></div>&nbsp;Back to Class Assignments</a>
		</div>
		<div class="col-md-4 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Give Students their Grades</h2>
				</div>
				<div class="panel-body">
					<form name="give_grades" action="give_grades.php?assignment_id=<?php echo $q; ?>" method="post">
						<table class="table">
							<?php
								$a = 0;
								$stmtII = $db->prepare('SELECT id, first_name, last_name FROM student');
								$stmtII->execute();
								$stmtII->bind_result($sid, $sfirst_name, $slast_name);
								while ($stmtII->fetch()) {
									if (in_array($sid, $data)) {
										$select_name_id = "grade_".$a++;
										echo "
											<tr>
												<td>
													<label for='$select_name_id' style='display:inline; font-weight:normal; cursor:pointer; margin-right:20px;'>$sfirst_name $slast_name</label>
												</td>
												<td>
													<select name='$sid' id='$select_name_id'>
														<option value='A'>A</option>
														<option value='B'>B</option>
														<option value='C'>C</option>
														<option value='D'>D</option>
														<option value='F'>F</option>
													</select>
												</td>
											</tr>
										";
									}
								}
								$stmtII->close();
							?>
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
</html>