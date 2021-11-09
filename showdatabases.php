<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

$conn = new MySQLi("localhost","root","");
if($conn->connect_errno>0) {
    die("Fehler im Verbindungsaufbau: " . $conn->error);
}
$conn->set_charset("UTF8");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>SHOW DATABASES</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body>
	<form method="get" action="showtables.php">
		<?php
		$sql = "
			SHOW DATABASES
		";
		$dbs = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
		while($db = $dbs->fetch_object()) {
			echo('<input type="submit" name="datenbankname" value="' . $db->Database . '">');
		}
		?>
	</form>
</body>
</html>