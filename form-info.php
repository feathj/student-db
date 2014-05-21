<?php
require('main_include.php');

$id = $_POST["users"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = sha1($_POST["password"]);
if (isset($_POST["radio1"])) {
	$admin = $_POST["radio1"];
} else {
	$admin = $_POST["radio2"];
}

if ($id !== "new_user") {
	mysqli_query($db,"UPDATE user SET email='$email', first_name='$firstname', last_name='$lastname', encrypted_password='$password', is_admin=$admin WHERE id=$id");
	mysqli_close($db);
} else {
	mysqli_query($db,"INSERT INTO user (email, first_name, last_name, encrypted_password, is_admin) VALUES ('$email', '$firstname', '$lastname', '$password', $admin)");
	mysqli_close($db);
}

header("Location: thankyou.php");

?>