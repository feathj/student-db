<?php 
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

	$(document).ready(function() {
		$.getJSON("class_api.php", function(data) {
			var tableHTML = "<table>";
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
			<h1>Classes</h1>
			<div id="course_info"></div>
		</body>
	</html>