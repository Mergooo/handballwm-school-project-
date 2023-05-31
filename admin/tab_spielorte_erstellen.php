<p>hier wird die Tabelle spielorte erstellt</p>
<?php
include "./../inc/functions/connection.php";

$sql = "CREATE TABLE spielorte (
    id_spielort INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    arena VARCHAR(100),
    country VARCHAR (50),
    capacity int (11)
)";

if ($stmt = $pdo->query($sql)) {
    echo "Die Tabelle wurde erfolgreich angelegt.<br>";
    $sql = "INSERT INTO spielorte (arena, country, capacity)
            VALUES ('Spodek, Katowice', 'Polen', '11.036')";
    $stmt = $pdo->query($sql);
    $sql = "INSERT INTO spielorte (arena, country, capacity)
            VALUES ('Tauron Arena Kraków, Krakau', 'Polen', '15.030')";
    $stmt = $pdo->query($sql);
    $sql = "INSERT INTO spielorte (arena, country, capacity)
            VALUES ('Scandinavium, Göteborg', 'Schweden', '12.000')";
    $stmt = $pdo->query($sql);
    
};


?>
