<p>Hier wird eine Tabelle geleert.</p>
<?php
include "./../inc/functions/connection.php";

$table = $_GET['table'];

$sql = "DELETE FROM $table";

if ($stmt = $pdo->query($sql)) {
    echo "Die Tabelle wurde erfolgreich geleert.";
};