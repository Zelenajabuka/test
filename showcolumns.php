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
<title>SHOW COLUMNS</title>
    <link rel="stylesheet" href="css/common.css">
</head>

<body>
	<ul>
		<?php
		if(count($_GET)>0) {
			ta($_GET);
			$sql = "
				SHOW COLUMNS FROM " . $_GET["datenbankname"] . "." . $_GET["tabellenname"] . "
			";
			$columns = $conn->query($sql) or die("Fehler in der Query: " . $conn->error);
			while($column = $columns->fetch_object()) {
				ta($column);
				echo('
					<li>Spalte ' . $column->Field . ':
						<ul>
							<li>Typ, Länge: ' .$column->Type . '</li>
							<li>Null erlaubt: ' . $column->Null . '</li>
							<li>Schlüssel: ' . $column->Key . '</li>
						</ul>
					</li>
				');
			}
		}
		else {
			echo('<p class="error">Es wurde keine Tabelle ausgewählt.</p>');
		}
		?>
	</ul>
</body>
</html>