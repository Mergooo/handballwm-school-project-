<p>hier wird die Tabelle Spiele erstellt</p>
<?php
include "./../inc/functions/connection.php";

$sql = "CREATE TABLE spiele (
    id_spiele INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    heim_id INTEGER(11), 
    gast_id INTEGER (11),
    heimtore INTEGER (11),
    gasttore INTEGER (11),
    datum DATE,
    uhrzeit TIME,
    zuschauer INTEGER(11),
    spielort_id INTEGER (11),
    spieltag INTEGER(11),
    FOREIGN KEY (heim_id) REFERENCES mannschaften(id_mannschaft),
    FOREIGN KEY (gast_id) REFERENCES mannschaften(id_mannschaft),
    FOREIGN KEY (spielort_id) REFERENCES spielorte(id_spielort)

)";

if ($stmt = $pdo->query($sql)) {
    echo "Die Tabelle wurde erfolgreich angelegt.<br>";
   

};