<?php 
require('main-nav.php');
?>
<script src="lib/jquery/dist/jquery.js"></script>

<script>

	$(document).ready(function() {
		$.getJSON("class_api.php", function(data) {
			var tableHTML = "<table class='table'>";
			$.each(data.courses, function(x) {
				tableHTML += "<tr>";
				$.each(data.courses[x], function(y) {
					tableHTML += "<td><a href='class.php?id="+data.courses[x][0]+"'>" + data.courses[x][y] + "</a></td>";
				});
				tableHTML += "</tr>";
			});
			tableHTML += "</table>";
			$('#course_info').html(tableHTML);
		});
	});

</script>

	<html>
		<body>
			<div class="container">
				<div class="col-lg-4 col-lg-offset-0">
					<h1>Classes</h1>
					<div id="course_info"></div>
				</div>
				<div class="col-md-4 col-md-offset-0">
					<div class="panel panel-default" style="margin-top:67px;">
						<div class="panel-heading">
							<h2 class="panel-title">Create a New Class</h2>
						</div>
						<div class="panel-body">
							<form name="createClass" action="createClass.php" method="post">
								<table class="table">
									<tr>
										<th>
											<label for="title">Title:</label>
										</th>
										<td>
											<input type="text" name="title" id="title" required>
										</td>
									</tr>
									<tr>
										<th>
											<label for="credit_hours">Credit Hours:</label>
										</th>
										<td>
											<input type="number" name="credit_hours" id="credit_hours" min="1" max="6" value="3" required>
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