<?php
session_start();
if (isset($_SESSION["user"])) {
	header("Location: form.php");
}
require_once 'db.php';
if (isset($_POST["login1"])) {
	$mysqli = new mysqli("localhost", $user, $password, "login");
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		};
	if ($stmt = $mysqli->prepare("SELECT password FROM users WHERE user=?")) {
		$stmt->bind_param("s", $_POST["login1"]);
		$stmt->execute();
		$pw = $stmt->get_result();
		$passwd = $pw->fetch_array();
		$desiredpw = password_hash($_POST["password1"],PASSWORD_DEFAULT);
		if (password_verify($_POST["password1"],$passwd["password"])) {
			echo "Valid, logged in. Redirecting.";
			$_SESSION["user"] = true;
			echo "<script>document.location = 'form.php'</script>";
		} else {
		$error = "Invalid password";
		}
		$stmt->close();
		$error = "Invalid password.";
	} else {
		$error = "No user found with that name";
	}
	$mysqli->close();
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
		<style>
		form {
			vertical-align: center;
			text-align: center;
		}
		</style>
	</head>
<body>
<form class="form-inline" method="post" style="vertical-align: middle; padding-top: 25%; padding-left: 5%; padding-right: 5%;">
<h2>CAN SC Login</h2>
  <div class="form-group">
    <label class="sr-only" for="login1">Login</label>
    <input type="text" class="form-control" id="login1" name="login1" placeholder="Username">
  </div>
  <div class="form-group">
    <label class="sr-only" for="password1">Password</label>
    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-default">Sign in</button>
<?php echo "<br><font color='red'>" .  $error  .  "</font>" ?>
</form>
</body>
</html>
