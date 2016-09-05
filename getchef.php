<?php
require_once 'db.php';
$mysqli = new mysqli("localhost", $user, $password, "chefs");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (isset($_GET["profile"])) {
	if ($stmt = $mysqli->prepare("SELECT * FROM chefs WHERE chefid=?")) {
		$stmt->bind_param("i", $_GET["profile"]);
		$stmt->execute();
		$res = $stmt->get_result();
		$profile = $res->fetch_array();
		//var_dump($profile);
		$mysqli->close();
	}
}

$arr = array(	'chefid' => $profile["chefid"],
		'name' => $profile["name"],
		'notes' => $profile["notes"],
		'business' => $profile["business"],
		'twitter' => $profile["twitter"],
		'insta' => $profile["insta"],
		'phone' => $profile["phone"],
		'website' => $profile["website"],
		'image' => $profile["image"],
                'linkedin' => $profile["linkedin"],
		'fb' => $profile["fb"],
		'story' => $profile["story"],
		'snapchat' => $profile["snapchat"]);
header('Content-Type: application/json');
echo json_encode($arr);
?>
