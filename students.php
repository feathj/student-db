<?php 
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

	$(document).ready(function() {
		$.getJSON("student_api.php", function(data) {
			console.log(data);
			var tableHTML = "<table>";
			$.each(data.students, function(x) {
				tableHTML += "<tr>";
				$.each(data.students[x], function(y) {
					tableHTML += "<td>" + data.students[x][y] + "</td>";
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
			<div id="student_info"></div>
		</body>
	</html>

<?php ?>
