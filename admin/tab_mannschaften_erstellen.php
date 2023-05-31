<p>hier wird die Tabelle mannschaften erstellt</p>
<?php
include "./../inc/functions/connection.php";

$sql = "CREATE TABLE mannschaften (
    id_mannschaft INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    mannschaft VARCHAR(100),
    gruppe VARCHAR (1),
    reihenfolge INTEGER (1)
)";

if ($stmt = $pdo->query($sql)) {
    echo "Die Tabelle wurde erfolgreich angelegt.<br>";
    $sql = "INSERT INTO mannschaften (mannschaft, gruppe, reihenfolge)
            VALUES ('Spanien', 'A', '1')";
            $stmt = $pdo->query($sql);
    $sql = "INSERT INTO mannschaften (mannschaft, gruppe, reihenfolge)
            VALUES ('Montenegro', 'A', '2')";
            $stmt = $pdo->query($sql);
    $sql = "INSERT INTO mannschaften (mannschaft, gruppe, reihenfolge)
            VALUES ('Chile', 'A', '3')";
            $stmt = $pdo->query($sql);
    $sql = "INSERT INTO mannschaften (mannschaft, gruppe, reihenfolge)
            VALUES ('Iran', 'A', '4')";
            $stmt = $pdo->query($sql);

};


?>
