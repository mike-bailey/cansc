<?php
session_start();
if (! isset($_SESSION["user"])) {
        die("Unauthorized.");
}
if ($_SESSION["user"] != true) {
	die("Unauthorized.");
}

require_once 'db.php';

$mysqli = new mysqli($host, $user, $password, "chefs");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_POST["updateid"] == "") {
	echo "";
} else {
if ($stmt = $mysqli->prepare("DELETE FROM chefs WHERE chefid=?")) {
$stmt->bind_param("i",$_POST["updateid"]);
var_dump($stmt->execute());
$mysqli->error;
}
}
if ($stmt = $mysqli->prepare("INSERT INTO chefs (chefid, name, business, phone, website, image, fb, twitter, linkedin, insta, story, snapchat, notes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)")) { 
		$chefid = rand(100000000,100000000000);
                $name = $_POST["name"];
                $business = $_POST["business"];
                $phone = $_POST["phone"];
                $website = $_POST["website"];
                $image = $_POST["image"];
                $fb = $_POST["fb"];
                $notes = $_POST["notes"];
                $twitter = $_POST["twitter"];
                $linkedin = $_POST["linkedin"];
                $insta = $_POST["insta"];
                $story = $_POST["story"];
                $snapchat = $_POST["snapchat"];
		$stmt->bind_param("issssssssssss", $chefid, $name, $business, $phone, $website, $image, $fb, $twitter, $linkedin, $insta, $story, $snapchat, $notes);
                var_dump($stmt->execute());
                $mysqli->error;
                $mysqli->close();
}
var_dump($_POST)
?>
