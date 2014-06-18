<?php 
require('main-nav.php');
?>
<script src="bower_components/jquery/dist/jquery.js"></script>

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
				<div class="row">
					<div class="col-lg-4 col-lg-offset-0">
						<h1>Classes</h1>
						<div id="course_info"></div>
					</div>
				</div>
			</div>
		</body>
	</html>