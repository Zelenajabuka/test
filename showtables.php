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
<title>SHOW TABLES</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body>
	<form method="get" action="showcolumns.php">
		<input type="hidden" name="datenbankname" value="<?php echo($_GET["datenbankname"]); ?>">
		<?php
		if(count($_GET)>0) {
			ta($_GET);
			$sql = "
				SHOW TABLES FROM " . $_GET["datenbankname"] . "
			";
			$tables = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
			while($table = $tables->fetch_object()) {
				ta($table);
				$tab = "Tables_in_" . $_GET["datenbankname"];
				echo('<input type="submit" name="tabellenname" value="' . $table->$tab . '">');
			}
		}
		else {
			echo('<p class="error">Es wurde keine Datenbank ausgewählt.</p>');
		}
		?>
	</form>
</body>
</html>