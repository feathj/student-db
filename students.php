<?php 
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

	$(document).ready(function() {
		$.getJSON("student_api.php", function(data) {
			var tableHTML = "<table>";
			$.each(data.students, function(x) {
				tableHTML += "<tr>";
				$.each(data.students[x], function(y) {
					tableHTML += "<td><a href='student.php?id="+data.students[x][0]+"'>" + data.students[x][y] + "</a></td>";
				});
				tableHTML += "</tr>";
			});
			tableHTML += "</table>";
			$('#student_info').html(tableHTML);
		});
	});

</script>

	<html>
		<body>
			<h1>Students</h1>
			<div id="student_info"></div>
			<div class="panel-body">
				<h3>Create a New Student</h3>
				<form name="createStudent" action="createStudent.php" method="post">
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
		</body>
	</html>