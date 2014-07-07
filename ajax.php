<?php
require('main_include.php');

$q = intval($_GET['q']);

$stmt = $db->prepare("SELECT first_name, last_name, email, is_admin FROM user WHERE id = ?");
$stmt->bind_param('i', $q);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $is_admin);
$stmt->fetch();
$stmt->close();

echo $first_name;
echo ",";
echo $last_name;
echo ",";
echo $email;
echo ",";
echo $is_admin;
?>