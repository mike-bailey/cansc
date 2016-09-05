<?php
session_start();
require_once 'db.php';
if (isset($_SESSION["user"])) {
	echo "";
} else {
	die("Login first please.<script>document.location = 'index.php';</script>");
}
$mysqli = new mysqli($host, $user, $password, "chefs");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = "SELECT * FROM chefs";
$result = $mysqli->query($query);



?>
<html>
	<head>
	</head>
<body>

<?php
$params="";
while($row = $result->fetch_array())
{
$rows[] = $row;
}
foreach($rows as $row)
{
$params .= $row['chefid'] . " ";
}
if (isset($_GET["nonotes"])) {
$cmdresult = shell_exec("./generate_nonotes.sh " . $params);
} else {
$cmdresult = shell_exec("./generate.sh " . $params);
}
echo "<a href='pdfs/".$cmdresult."'>Download Link Here</a>";
/* free result set */
$result->close();

/* close connection */
$mysqli->close();

?>
</body>
</html>
