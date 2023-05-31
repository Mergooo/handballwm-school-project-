<?php
$title = "Mannschaften der Handball WM 2023";
include "header.php";
// include ...header.php (enthält den HTML-Rumpf bis zum <body>)
// ebenfalls simple.css
// echo "ich bin die view, die vom Controller eingebunden ist.<br>"
?>
<h2><?php echo $title ?></h2>

<?php
    if(!empty($meldung_speichern)) {
        echo "<p class=\"success\">$meldung_speichern</p>";
    }
    if(!empty($meldung_gelöscht)) {
        echo "<p class=\"success\">$meldung_gelöscht</p>";
    }
    if(!empty($err)){
    foreach($err as $errausgabe){
        echo "<p class=\"error\">$errausgabe</p>";
    }
    }

?>

<form action="./../controller/mannschaften.php" method="POST">
    Mannschaft: <input type="text" name="mannschaft">
    Gruppe: <input type="text" name="gruppe">
    Reihenfolge: <input type="number" name="reihenfolge">
    <input type="submit" name="speichern" value="Mannschaften speichern">
</form>

<?php 
if(!empty($mannschaften)) {
?>
<table>
    <tr>
        <th><a href="./../controller/mannschaften.php?sorta=<?php if(!empty($sorta)) {echo $sorta;}; ?>">Mannschaft</a></th>
        <th><a href="./../controller/mannschaften.php?sortc=<?php if(!empty($sortc)) {echo $sortc;}; ?>">Gruppe</a></th>
        <th><a href="./../controller/mannschaften.php?sortr=<?php if(!empty($sortr)) {echo $sortr;}; ?>">Reihenfolge</a></th>
    </tr>
    <?php 

    foreach($mannschaften as $mannschaft) {
    ?>
    <tr>
        <td><?php echo $mannschaft['mannschaft']; ?></td>
        <td><?php echo $mannschaft['gruppe']; ?></td>
        <td><?php echo $mannschaft['reihenfolge']; ?></td>
        <td><a href="./../controller/mannschaften.php?del=<?php echo $mannschaft['id_mannschaft']; ?>"><img src="./../inc/pics/del.png" alt="löschen"></a></td>
    </tr>
    <?php } ?>
</table>

<?php
} else {
    echo "Es sind noch keine Mannschaften vorhanden!";
}

// Siegi: Hinweis - Aufgabe 3 Stelle 1/3
// Hier kommen das Kombinationsfeld und die beiden Button hin.
// Allgemeiner Hinweis: Das gesamte "Handling" könnte etwas einfacher werden, wenn man das Erstellen (schon vorhanden) und 
// das Löschen (muss in Aufgabe 3 erledigt werden) der Vorrundenspiele vom Controller spiele.php auf den Controller mannschaften.php verlagert.


?>
<form action="./../controller/mannschaften.php" method="POST">

<select name="gruppe">
    <option value="A">Gruppe A</option>
    <option value="B">Gruppe B</option>
    <option value="C">Gruppe C</option>
    <option value="D">Gruppe D</option>
    <option value="E">Gruppe E</option>
    <option value="F">Gruppe F</option>
    <option value="G">Gruppe G</option>
    <option value="H">Gruppe H</option>
</select>

<input type="submit" name="spiele_erstellen" value="Spiele erstellen">
<!-- <input type="submit" name="spiele_löschen" value="Spiele löschen"> -->


</form>
<a href="./../controller/spiele.php">Zu den Spielen wechseln</a>

<?php

// include ...footer.php (enthält den HTML-Rumpf </body></html>)
include "footer.php";
?>