<p>Hier wird eine Tabelle gelöscht</p>
<?php
include "./../inc/functions/connection.php";

$table = $_GET['table'];

$sql = "DROP TABLE $table";

if ($stmt = $pdo->query($sql)) {
    echo "Die Tabelle wurde erfolgreich gelöscht.";
};


?>