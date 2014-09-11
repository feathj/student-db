<?php 
require('main-nav.php');
?>
<script src="lib/jquery/dist/jquery.js"></script>

<script>

	$(document).ready(function() {
		$.getJSON("teacher_api.php", function(data) {
			var tableHTML = "<table class='table'>";
			$.each(data.teachers, function(x) {
				tableHTML += "<tr>";
				$.each(data.teachers[x], function(y) {
					tableHTML += "<td><a href='teacher.php?id="+data.teachers[x][0]+"'>" + data.teachers[x][y] + "</a></td>";
				});
				tableHTML += "</tr>";
			});
			tableHTML += "</table>";
			$('#teacher_info').html(tableHTML);
		});
	});

</script>

	<html>
		<body>
			<div class="container">
			<div class="col-lg-3 col-lg-offset-0">
				<h1>Teachers</h1>
				<div id="teacher_info"></div>
			</div>
			<div class="col-md-4 col-md-offset-1">
				<div class="panel panel-default" style="margin-top:67px;">
					<div class="panel-heading">
						<h2 class="panel-title">Create a New Teacher</h2>
					</div>
					<div class="panel-body">
						<form name="createTeacher" action="createTeacher.php" method="post">
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
										<label>Tenure:</label>
									</th>
									<td>
										<input type="radio" name="tenure" id="tenure1" value="1" required><label for="tenure1" style="font-weight:normal">Yes</label>
										<input type="radio" name="tenure" id="tenure0" value="0" required><label for="tenure0" style="font-weight:normal">No</label>
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