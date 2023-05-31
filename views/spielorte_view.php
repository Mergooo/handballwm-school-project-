<?php
$title = "Spielorte der Handball WM 2023";
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

<form action="./../controller/spielorte.php" method="POST">
    Spielort: <input type="text" name="arena">
    Land: <input type="text" name="country">
    <input type="submit" name="speichern" value="Spielort speichern">
</form>

<?php 
if(!empty($spielorte)) {
?>
<table>
    <tr>
        <th><a href="./../controller/spielorte.php?sorta=<?php if(!empty($sorta)) {echo $sorta;}; ?>">Arena</a></th>
        <th><a href="./../controller/spielorte.php?sortc=<?php if(!empty($sortc)) {echo $sortc;}; ?>">Land</a></th>
    </tr>
    <?php 

    foreach($spielorte as $spielort) {
    ?>
    <tr>
        <td><?php echo $spielort['arena']; ?></td>
        <td><?php echo $spielort['country']; ?></td>
        <td><a href="./../controller/spielorte.php?del=<?php echo $spielort['id_spielort']; ?>"><img src="./../inc/pics/del.png" alt="löschen"></a></td>
    </tr>
    <?php } ?>
</table>

<?php
} else {
    echo "Es sind noch keine Spielorte vorhanden!";
}
// echo "jetzt verlasse ich die view wieder.<br>";

// include ...footer.php (enthält den HTML-Rumpf </body></html>)
include "footer.php";
?>