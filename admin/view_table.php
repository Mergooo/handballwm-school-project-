<p>Hier wird der Inhalt einer Tabelle angezeigt.</p>
<?php
include "./../inc/functions/connection.php";

$table = $_GET['table'];

$sql = "SELECT * FROM $table";

if ($stmt = $pdo->query($sql)) {
    $spielorte = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($spielorte);
    echo "</pre>";
};


?>