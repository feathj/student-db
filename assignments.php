<?php
require('main_include.php');
require('main-nav.php');

$q = intval($_GET['assignment_id']);
$r = intval($_GET['id']);
$grades = mysqli_query($db, "SELECT letter_grade, COUNT(letter_grade) AS 'count' FROM student_assignment WHERE assignment_id = $q GROUP BY letter_grade;");
$data = [];
while ($row = mysqli_fetch_array($grades, MYSQL_ASSOC)) {
	$data[$row['letter_grade']] = $row['count'];
}

$possibleGrades = ['A', 'B', 'C', 'D', 'F'];
foreach ($possibleGrades as $possibleGrade) {
	if (!isset($data[$possibleGrade])) {
		$data[$possibleGrade] = 0;
	}
}

?>

<script src="lib/jquery/dist/jquery.js"></script>
<script src="lib/highcharts/highcharts.js"></script>

<script type="text/javascript">
	$(function () { 
	    $('#chart').highcharts({
	        chart: {
	            type: 'bar',
	            color: '#333',
	            borderRadius: 4,
	            borderWidth: 1,
	            borderColor: '#ddd',
	            style: {
	            	fontFamily: '"Helvetica Neue", Helvetica, Arial, sans-serif;'
	            }
	        },
	        credits: {
	        	enabled: false
	        },
	        title: {
	            text: 'Grade Distribution'
	        },
	        xAxis: {
	            categories: ['A', 'B', 'C', 'D', 'F']
	        },
	        yAxis: {
	            title: {
	                text: '# of Grades Earned'
	            },
	            labels: {
	                step: 4
	            }
	        },
	        series: [{
	            name: 'Students',
	            color: 'rgb(70, 122, 123)',
	            data: [<?php echo $data['A']; ?>, <?php echo $data['B']; ?>, <?php echo $data['C']; ?>, <?php echo $data['D']; ?>, <?php echo $data['F']; ?>]
	        }]
	    });
	});
</script>

<?php

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
			<div id="chart" style="width:100%; height:300px; margin-top:20px;"></div>
		</div>
		<div class="col-md-4 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Give Students their Grades</h2>
				</div>
				<div class="panel-body">
					<form name="give_grades" action="give_grades.php?assignment_id=<?php echo $q; ?>&amp;id=<?php echo $r; ?>" method="post">
						<table class="table">
							<?php
								$a = 0;
								$stmtII = $db->prepare('SELECT student.id, student.first_name, student.last_name, student_assignment.letter_grade, student_class.class_id
														FROM student
														JOIN student_class
														ON student.id = student_class.student_id
														AND student_class.class_id = ?
														LEFT JOIN student_assignment
														ON student.id = student_assignment.student_id
														AND student_assignment.assignment_id = ?;');
								$stmtII->bind_param('ii', $r, $q);
								$stmtII->execute();
								$stmtII->bind_result($sid, $sfirst_name, $slast_name, $letter_grade, $sclass_id);
								while ($stmtII->fetch()) {
									if (in_array($sid, $data)) {
										$select_name_id = "grade_".$a++;
										if (isset($letter_grade)) {
											echo "
												<tr>
													<td>
														<label for='$select_name_id' style='display:inline; font-weight:normal; cursor:pointer; margin-right:20px;'>$sfirst_name $slast_name</label>
													</td>
													<td>
														<select name='$sid' id='$select_name_id'>
															<option value='".$letter_grade."'>".$letter_grade."</option>
														</select>
													</td>
												</tr>
											";
										} else {
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