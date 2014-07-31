<?php 
require('main-nav.php');
?>
<script src="lib/jquery/dist/jquery.js"></script>

<script>

	$(document).ready(function() {
		$.getJSON("student_api.php", function(data) {
			var tableHTML = "<table class='table'>";
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
		<div class="container">
			<div class="col-lg-3 col-lg-offset-0">
				<h1>Students</h1>
				<div id="student_info"></div>
			</div>
			<div class="col-md-4 col-md-offset-1">
				<div class="panel panel-default" style="margin-top:67px;">
					<div class="panel-heading">
						<h2 class="panel-title">Create a New Student</h2>
					</div>
					<div class="panel-body">
						<form name="createStudent" action="createStudent.php" method="post">
							<table class="table">
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
	</body>
</html>