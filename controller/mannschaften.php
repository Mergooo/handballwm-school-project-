<?php

include "./../inc/functions/connection.php";
// Das ist der Controller für die Seite mannschaften

// Es soll geprüft werden, ob gerade eine mannschaften gelöscht wurde
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM mannschaften WHERE id_mannschaft = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $meldung_gelöscht = "Die Mannschaft wurde erfolgreich gelöscht.";
}
// $meldung_löschen = "";



// Es soll geprüft werden, ob gerade eine Mannschaft eingegeben wurde.
// Diese soll dann gespeichert werden.
// $err speichert alle Fehler im Formular
$err = [];
if (isset($_POST['speichern'])) {
    If (!empty($_POST['mannschaft'])) {
        $mannschaft = $_POST['mannschaft'];
    } else {
        $err[] = "Der Name der Mannschaft muss angegeben werden.";
    }
    If (!empty($_POST['gruppe'])) {
        $gruppe = $_POST['gruppe'];
    } else {
        $err[] = "Die Gruppe muss angegeben werden.";
    }

    If (!empty($_POST['reihenfolge'])) {
        $reihenfolge = $_POST['reihenfolge'];
    } else {
        $err[] = "Die Reihenfolge muss angegeben werden.";
    }

    if(!empty($_POST['mannschaft']) and !empty($_POST['gruppe']) and !empty($_POST['reihenfolge']) ) {
        $sql = "INSERT INTO mannschaften (mannschaft, gruppe, reihenfolge) VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mannschaft, $gruppe, $reihenfolge]);
        $meldung_speichern = "Die Mannschaft $mannschaft wurde erfolgreich gespeichert";
    } else {
        $err[] = "Bei der Speicherung ist etwas schief gegangen.";
    }        
}
// $error = [];
// Speichert in $error die Fehler


// das GET-Attribut sorta erhält einen Wert für die Sortierung der Mannschaft
// 1 für Mannschaft asc
// 2 für Mannschaft desc
// das GET-Attribut sortc erhält einen Wert für die Sortierung der Gruppe
// 1 für gruppe asc
// 2 für gruppe desc
// das GET-Attribut sortr erhält einen Wert für die Sortierung der Reihenfolge
// 1 für Reihenfolge asc
// 2 für Reihenfolge desc
// default oder ein anderer Wert: Mannschaft asc

if (isset($_GET['sorta'])) {
    $sorta = $_GET['sorta'];    
    if ($sorta == 1) {
        $order = " ORDER BY mannschaft ASC";
        $sorta = 2;
    } else {
        $order = " ORDER BY mannschaft DESC";
        $sorta = 1;
    }
} else {
    $sorta = 1;
    $order = " ORDER BY mannschaft ASC";
}
if (isset($_GET['sortc'])) {
    $sortc = $_GET['sortc'];    
    if ($sortc == 1) {
        $order = " ORDER BY gruppe ASC";
        $sortc = 2;
    } else {
        $order = " ORDER BY gruppe DESC";
        $sortc = 1;
    }
} else {
    $sortc = 1;
}

if (isset($_GET['sortr'])) {
    $sortr = $_GET['sortr'];    
    if ($sortr == 1) {
        $order = " ORDER BY reihenfolge ASC";
        $sortr = 2;
    } else {
        $order = " ORDER BY reihenfolge DESC";
        $sortr = 1;
    }
} else {
    $sortr = 1;
}



// Wir wollen eine Ausgabevariable erstellen, die alle Mannschaften enthält.

$table = "mannschaften";
$sql = "SELECT * FROM $table" . $order;
if ($stmt = $pdo->query($sql)) {
    $mannschaften = $stmt->fetchAll(PDO::FETCH_ASSOC);
};

// Beginn: Anlegen aller Spiele einer Gruppe
// Siegi: Hinweis - Aufgabe 3 Stelle 2/3
// Hier muss die Gruppe in Empfang genommen werden.
if (isset($_POST['spiele_erstellen'])){
    $gruppe = $_POST['gruppe'];
    $sql = "SELECT * FROM mannschaften WHERE gruppe = :gruppe";
    // $sql = "SELECT count(*) FROM mannschaften WHERE gruppe = :gruppe";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':gruppe', $gruppe);
    $stmt->execute();
    $anzahl = $stmt->rowCount();
    // $anzahl = $stmt->fetch(PDO::FETCH_NUM);
            //  echo $anzahl[0];
    
            

    if($anzahl != 4 ){

        $error = "Es müssen genau vier Mannschaften in der Gruppe angegeben sein";
        echo $error;
    }

    $sql = "SELECT * FROM spiele, mannschaften WHERE id_mannschaft = heim_id AND gruppe = :gruppe ";
    // $sql = "SELECT count(*) FROM mannschaften WHERE gruppe = :gruppe";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':gruppe', $gruppe);
    $stmt->execute();
    $anzahl_spiele = $stmt->rowCount();

    if($anzahl_spiele > 0){
        $error ="Die Spiele wurden bereits erstellt";
        echo $error;
    }

    if(!empty($gruppe) && $anzahl == 4 && $anzahl_spiele == 0){

    // in $gruppenresult sind die Mannnschaften einer Gruppe in der korrekten Reihenfolge enthalten
    $table = "mannschaften";


    $sql = "SELECT * FROM $table 
            WHERE gruppe = '{$gruppe}'
            ORDER BY reihenfolge";

    if ($stmt = $pdo->query($sql)) {
        $gruppenresult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    };

    // print_r($gruppenresult);

    $table = "spiele";

    $sql = "INSERT INTO $table (heim_id, gast_id, spielort_id, spieltag) values 
            ({$gruppenresult[0]['id_mannschaft']}, {$gruppenresult[1]['id_mannschaft']}, 1,1),
            ({$gruppenresult[2]['id_mannschaft']}, {$gruppenresult[3]['id_mannschaft']}, 1,1),
            ({$gruppenresult[1]['id_mannschaft']}, {$gruppenresult[3]['id_mannschaft']}, 1,2),
            ({$gruppenresult[0]['id_mannschaft']}, {$gruppenresult[2]['id_mannschaft']}, 1,2),
            ({$gruppenresult[1]['id_mannschaft']}, {$gruppenresult[2]['id_mannschaft']}, 1,3),
            ({$gruppenresult[3]['id_mannschaft']}, {$gruppenresult[0]['id_mannschaft']}, 1,3)
            ";
            

    if ($stmt = $pdo->query($sql)) {
        echo "Die Spile der Gruppe $gruppe werden erstellet";
    };

    }
}
// Ende: Anlegen aller Spiele einer Gruppe


// Siegi: Hinweis - Aufgabe 3 Stelle 3/3
// Hier muss die zu löschende Gruppe in Empfang genommen und gelöscht werden
// if (isset($_POST['spiele_löschen'])){
//     $gruppe =  $_POST['gruppe'];
//     $sql = "DELETE FROM spiele, mannschaften WHERE gruppe = :gruppe AND heim_id = id_mannschaft";
    
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':gruppe', $gruppe);
//     $stmt->execute();
// }


// Hier wird die view, d.h. die gesamte Ausgabe eingebunden
include "./../views/mannschaften_view.php";
// und nutze in der mannschaften_view.php alle 
// Variablen zur Ausgabe, die der Controller zur 
// Verfügung gestellt hat.



?>