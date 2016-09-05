<script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
<script>
function deleteChart(id) {
$.get( "delete.php?profile="+id, function( data ) {
  refreshChart();
});
}
</script>
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
		<script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
<body>

<?php
while($row = $result->fetch_array())
{
$rows[] = $row;
}
echo "<center><br><div class='table-responsive'><table style='width: 80%;' class='table'><tr><th>Name</th>";
echo "<th>Website</th>";
echo "<th>Phone</th>";
echo "</tr>";
foreach($rows as $row)
{
echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['website'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
	if (isset($_GET["interactive"])) {
		echo "<td><a href='genprofile.php?profile=" . $row['chefid'] . "'>HTML</a></td>";
                echo "<td><a href='genprofile.php?profile=" . $row['chefid'] . "&pdf'>PDF</a></td>";
		echo "<td><img src='img/trash.png' width=5% onclick='deleteChart(" . $row['chefid'] . ")'></td>";
		echo "<td><a href='javascript:updateForm(" . $row['chefid'] . ")'>Update</a></td>";
	}
echo "</tr>";
}
echo "</table></div></center>";
/* free result set */
$result->close();

/* close connection */
$mysqli->close();

?>
</body>
</html>
