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
if (isset($_GET["pdf"])) {
	if (ctype_digit($_GET["profile"])) {
		$randkek = rand(10000000,1000000000);
		shell_exec("/opt/wk/wkhtmltox/bin/wkhtmltopdf https://cansc.michaelbailey.co/genprofile.php?profile=".$_GET["profile"]." pdfs/out_".$randkek.".pdf");
		echo "<script>document.location = 'https://cansc.michaelbailey.co/pdfs/out_".$randkek.".pdf'</script>";
	}
}
?>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</head>
<body>
<div class="container" style="padding-top: 10px;">
	<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-4"><center><img width=200px src=" <?php echo $profile['image']; ?> " /></center></div>
	<div class="col-md-4"><center><h2><?php echo $profile["name"]; ?></h2><h3><?php echo $profile["business"] ?></h3><br><p><?php echo $profile['phone'] ?><br><?php echo $profile['website'] ?></center></div>
	<div class="col-md-2"></div>
	</div><br>
<?php
if (isset($_GET["nonotes"])) {
	echo "<div class='row' id='notes' style='display: none; word-wrap: break-word;'>";
} else {
        echo "<div class='row' id='notes' style='word-wrap: break-word;'>";
}
?>
	<div class="col-md-2"></div>
	<div class="col-md-8" style="padding-left: 1%; padding-top: 1%; padding-bottom: 1%; border-style: solid; border-width: 1px"><b>Notes</b><br><br><?php echo nl2br($profile["notes"]); ?></div>
	<div class="col-md-2"></div>
	</div>
	<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8" style="padding-left: 1%; padding-top: 1%; padding-bottom: 1%; border-style: solid; border-width: 1px; word-wrap: break-word;"><b>Story</b><br><br><p><?php echo nl2br($profile["story"]); ?></p></div>
	<div class="col-md-2"></div>
	</div>
        <div class="row">
        <div class="col-md-2"></div>
	<div class="col-md-8"><center><br>
	<?php
	if ($profile["twitter"] != "" ) {
		echo "<a href='https://www.twitter.com/" . $profile["twitter"] . "'><img width=3% src='img/twitter.png' /></a>  On Twitter as @" . $profile["twitter"] . "<br><br>";
	}
        if ($profile["insta"] != "" ) {
                echo "<a href='https://www.instagram.com/" . $profile["insta"] . "'><img width=3% src='img/insta.png' /></a>  On Instagram as @" . $profile["insta"] . "<br><br>";
        }
	if ($profile["fb"] != "" ) {
                echo "<a href='https://www.facebook.com/" . $profile["fb"] . "'><img width=3% src='img/fb.png' /></a>  On Facebook as " . $profile["fb"] . "<br><br>";
        }
	if ($profile["linkedin"] != "" ) {
                echo "<a href='https://www.linkedin.com/in/" . $profile["linkedin"] . "'><img width=3% src='img/linkedin.png' /></a>  On Linkedin as " . $profile["linkedin"] . "<br><br>";
        }
        if ($profile["snapchat"] != "" ) {
                echo "<img width=3% src='img/snapchat.png' />  On Snapchat as " . $profile["snapchat"] . "<br><br>";
        }
        ?>
	</center></div>
        <div class="col-md-2"></div>
        </div>

</div>
</body>
</html>
