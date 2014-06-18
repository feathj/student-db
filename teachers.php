<?php 
require('main-nav.php');
?>
<script src="bower_components/jquery/dist/jquery.js"></script>

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
				<h1>Teachers</h1>
				<div id="teacher_info"></div>
			</div>
		</body>
	</html>