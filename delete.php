<?php
session_start();
require_once 'db.php';

if ( $_SESSION["user"] == true) {
	echo "";
} else {
	die("Unauthorized. Please log in.");
}

$mysqli = new mysqli($host, $user, $password, "chefs");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (isset($_GET["profile"])) {
	if ($stmt = $mysqli->prepare("DELETE FROM chefs WHERE chefid=?")) {
		$stmt->bind_param("i", $_GET["profile"]);
		$stmt->execute();
		$mysqli->close();
	}
}

?>
