<?php

include "./../inc/functions/connection.php";
// Das ist der Controller zur Erstellung der Gruppenspiele

if(isset($_POST['update'])) {
    $spielort = $_POST['spielort'];
    $datum = $_POST['datum'];
    $uhrzeit = $_POST['uhrzeit'];
    $idspiel = $_POST['idspiel'];
    // echo $spielort . " " . $datum . " " . $uhrzeit . " " . $idspiel ;
    // Siegi: Hinweis - Aufgabe 1 Stelle 1/1
    // An dieser Stelle ist die Aufgabe 1 komplett zu erledigen. 
    // Eine weitere Prüfung auf Fehler dürft ihr euch hier ersparen, da durch die Pulldowns im Formular auch 
    // wirklich jede Variable gesetzt sein sollte. In einer Live-Version wäre eine Prüfung trotzdem notwendig, um Manipulationen zu vermeiden.
    $sql = "UPDATE spiele 
            SET  spielort_id = :spielort, datum = :datum, uhrzeit = :uhrzeit
            WHERE id_spiele = :id_spiele";

    $stmt = $pdo->prepare($sql);
    $stmt -> bindValue(':spielort',$spielort);
    $stmt -> bindValue(':datum',$datum);
    $stmt -> bindValue(':uhrzeit',$uhrzeit);
    $stmt -> bindValue(':id_spiele',$idspiel);

    $stmt->execute();


}

if(isset($_POST['anzeigen'])){
    $gruppeauswahl = $_POST['gruppeauswahl'];
}else{
    $gruppeauswahl = 0;
}

// $showEditForm = 0;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT id_spiele, heim.mannschaft AS heimmannschaft, gast.mannschaft AS gastmannschaft,  heim.gruppe, spieltag
        FROM spiele, mannschaften AS heim, mannschaften AS gast
        WHERE heim_id = heim.id_mannschaft AND gast_id = gast.id_mannschaft AND id_spiele = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $spieledit = $stmt->fetch(PDO::FETCH_ASSOC);
    // if(!empty($spieledit)) {
    //     //$showEditForm = 1;
    // }
}

// print_r($spieledit);






// $spiele soll die Spielpaarrungen enthalten mit den namen der Heim- und gastmanschaft
// die Gruppe und den spieltag- sortiert nach gruppe und spieltag

if(!empty($gruppeauswahl)){
    // Siegi: Hinweis - Aufgabe 1 Stelle 1/3 
    // Hier muss die Abfrage ergänzt werden:
    // 1. man benötigt die Attribute datum und Uhrzeit
    // 2. man benötigt den Spielort - da hier (in der Tabelle spiele) aber nur die spielort_id erfasst ist und nicht der Name
    // des Spielortes muss noch eine Relation zur Tabelle spielorte gesetzt werden.
    // Wenn 2. nicht funktioniert, dann bitte nicht verzweifeln, sondern benutzt dann erstmal nur die spielort_id, die Mannschaft
    // holen wir uns dann gemeinsam 
    $sql = "SELECT id_spiele, heim.mannschaft AS heimmannschaft, gast.mannschaft AS gastmannschaft,  heim.gruppe, 
            spieltag, datum, uhrzeit, spielort_id, arena
            FROM spiele, mannschaften AS heim, mannschaften AS gast, spielorte 
       
            WHERE id_spielort = spielort_id AND heim_id = heim.id_mannschaft AND gast_id = gast.id_mannschaft AND heim.gruppe = '$gruppeauswahl' ";
        


}else{
    // Siegi: Hinweis - Aufgabe 1 Stelle 2/3
    // Hier gilt das gleiche wie an Stelle 1/3
    $sql = "SELECT id_spiele, heim.mannschaft AS heimmannschaft, gast.mannschaft AS gastmannschaft,  heim.gruppe, 
            spieltag, datum, uhrzeit, spielort_id, arena
            FROM spiele, mannschaften AS heim, mannschaften AS gast,  spielorte 
        
            WHERE  id_spielort = spielort_id AND heim_id = heim.id_mannschaft AND gast_id = gast.id_mannschaft
            ORDER BY heim.gruppe, spieltag";
}
if ($stmt = $pdo->query($sql)){
    $spiele = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$sql ="SELECT * FROM spielorte
    ORDER BY country, arena;
";
if ($stmt = $pdo->query($sql)){
    $spielorte = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// print_r($spielorte);

// echo "<pre>";
// print_r($spiele);
// echo "</pre>";


// Hier wird die view, d.h. die gesamte Ausgabe eingebunden
include "./../views/spiele_view.php";