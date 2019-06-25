<?php

require_once("connectionController.php");

$userName = stripcslashes($_POST["userName"]);
$userEmail = stripcslashes($_POST["userEmail"]);
$userPassword1 = md5($_POST["userPassword1"]);
$userPassword2 = md5($_POST["userPassword2"]);
if ($userPassword1 != $userPassword2) {
	return "password doesn't match";
	die();
}

$file = $_FILES["userPhoto"];
$targetDir = "uploads/";
$targetFile = $targetDir.basename($file["name"]);

if (move_uploaded_file($file["tmp_name"], $targetFile)) {
	echo "file uploaded";
} else {
	return "Error when uploading file";
	die();
}

$sql = "insert into user ('name', 'email', 'password', 'profile_photo') values (?, ?, ?, ?)";

$conn = new mysqlConnection();
$dbh = $conn->setConnection();
$dbh->prepare($sql);

$dbh->exec([$userName, $userEmail, $userPassword1, $targetFile]);