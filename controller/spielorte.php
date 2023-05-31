<?php

include "./../inc/functions/connection.php";

// Das ist der Controller für die Seite spielorte

// Es soll geprüft werden, ob gerade ein Spielort gelöscht wurde
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM spielorte WHERE id_spielort = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $meldung_gelöscht = "Der Spielort wurde erfolgreich gelöscht.";
}
// $meldung_löschen = "";



// Es soll geprüft werden, ob gerade ein Spielort eingegeben wurde.
// Dieser soll dann gespeichert werden.
// $err speichert alle Fehler im Formular
$err = [];
if (isset($_POST['speichern'])) {
    If (!empty($_POST['arena'])) {
        $arena = $_POST['arena'];
    } else {
        $err[] = "Der Name der Sportstätte muss angegeben werden.";
    }
    If (!empty($_POST['country'])) {
        $country = $_POST['country'];
    } else {
        $err[] = "Der Name des Landes muss angegeben werden.";
    }
    if(!empty($_POST['arena']) and !empty($_POST['country'])) {
        $sql = "INSERT INTO spielorte (arena, country) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$arena, $country]);
        $meldung_speichern = "Der Spielort $arena in $country wurde erfolgreich gespeichert";
    } else {
        $err[] = "Bei der Speicherung ist etwas schief gegangen.";
    }        
}
// $error = [];
// Speichert in $error die Fehler

// Wir wollen eine Ausgabevariable erstellen, die alle Spielorte enthält.

// das GET-Attribut sorta erhält einen Wert für die Sortierung der arena
// 1 für arena asc
// 2 für arena desc
// das GET-Attribut sortc erhält einen Wert für die Sortierung der country
// 1 für country asc
// 2 für country desc
// default oder ein anderer Wert: arena asc
if (isset($_GET['sorta'])) {
    $sorta = $_GET['sorta'];    
    if ($sorta == 1) {
        $order = " ORDER BY arena ASC";
        $sorta = 2;
    } else {
        $order = " ORDER BY arena DESC";
        $sorta = 1;
    }
} else {
    $sorta = 1;
    $order = " ORDER BY arena ASC";
}
if (isset($_GET['sortc'])) {
    $sortc = $_GET['sortc'];    
    if ($sortc == 1) {
        $order = " ORDER BY country ASC";
        $sortc = 2;
    } else {
        $order = " ORDER BY country DESC";
        $sortc = 1;
    }
} else {
    $sortc = 1;
}


$table = "spielorte";
$sql = "SELECT * FROM $table" . $order;
if ($stmt = $pdo->query($sql)) {
    $spielorte = $stmt->fetchAll(PDO::FETCH_ASSOC);
};

// $stmt = $pdo->query($sql);
// $spielorte = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $spielorte soll ein array sein, welches alle Spielorte enthält

// Hier wird die view, d.h. die gesamte Ausgabe eingebunden
include "./../views/spielorte_view.php";
// und nutze in der spielorte_view.php alle 
// Variablen zur Ausgabe, die der Controller zur 
// Verfügung gestellt hat.


?>