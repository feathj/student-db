<?php
	// main include
	require('main_include.php');
	require('main-nav.php');
	?>

	<script type="text/javascript">
		function getUserID() {
			var x=document.getElementById("users");
			var id=x.value;
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var string=xmlhttp.responseText;
					var array=string.split(',');
					document.getElementById('firstname').value=array[0];
					document.getElementById('lastname').value=array[1];
					document.getElementById('email').value=array[2];
					document.getElementById('radio1').checked=false;
					document.getElementById('radio2').checked=true;
					if (array[3] == 1) {
						document.getElementById('radio1').checked=true;
					} else if (array[3] == "") {
						document.getElementById('radio1').checked=false;
						document.getElementById('radio2').checked=true;
					} else {
						document.getElementById('radio2').checked=true;
					}
				}
			}
			xmlhttp.open("GET","ajax.php?q="+id,true);
			xmlhttp.send();
		}
	</script>

	<?php
	//store the value of the "is_admin" field from the "user" table for the user in a variable
	$stmt = $db->prepare('SELECT is_admin FROM user WHERE id = ?');
	$stmt->bind_param('i', $_SESSION["user_id"]);
	$stmt->execute();
	$stmt->bind_result($is_admin);
	$stmt->fetch();
	$stmt->close();
	//check to see if the variable is true
	if ($is_admin) {
		//display the page
		?>
		<html>
			<header>
				<link href="./lib/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
				<link href="css/tyler.css" rel="stylesheet">
			</header>
			<body>

				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 class="panel-title">Create New or Update an Existing User</h2>
								</div>
								<div class="panel-body">
									<form name="cu_user" action="form-info.php" method="post">
										<table class="table">
											<tr>
												<th>
													<label for="select">Select a user:</label>
												</th>
												<td>
													<select name="users" id="users" onchange="getUserID()">
														<option value="new_user">New User</option>
														<?php
															//fetch possible list of users from db and display in dropdown menu
															$stmt = $db->prepare('SELECT id, first_name, last_name FROM user');
															$stmt->execute();
															$stmt->bind_result($id, $first_name, $last_name);
															while ($stmt->fetch()) {
																echo '<option value="' . $id . '">' . $first_name . ' ' . $last_name . '</option>';
															}
															$stmt->close();
														?>
													</select>
												</td>
											</tr>
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
													<label for="email">E-mail:</label>
												</th>
												<td>
													<input type="email" name="email" id="email" required>
												</td>
											</tr>
											<tr>
												<th>
													<label for="password">Password:</label>
												</th>
												<td>
													<input type="password" name="password" id="password" required>
												</td>
											</tr>
											<tr>
												<th>
													<label>Admin Access?</label>
												</th>
												<td class="radio">
													<input type="radio" name="radio" id="radio1" value="1"><label for="radio1">Yes</label><br>
													<input type="radio" name="radio" id="radio2" value="0" checked><label for="radio2">No</label>
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
				</div>

			</body>
		</html>
		<?php
	}
	else {
		//display error message
		?>
		<p>You are not allowed to see this page.</p>
		<?php
	}
?>