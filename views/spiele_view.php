<?php
$title = "Spiele der Handball WM";
include "header.php";
?>
<h2><?php echo $title; ?></h2>

<form action="./../controller/spiele.php" method="POST">
    <label for="gruppeauswahl"> Gruppe auswahl</label>
    Gruppe : <SELECT name="gruppeauswahl" id="gruppeauswahl" placeholder="Gruppe Auswählen">
        <option value="0">Alle GRUPPEN Auswählen</option>
        <option value="A" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "A") {
                                echo "selected";
                            } ?>>GRUPE A</option>
        <option value="B" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "B") {
                                echo "selected";
                            } ?>>GRUPE B</option>
        <option value="C" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "C") {
                                echo "selected";
                            } ?>>GRUPE C</option>
        <option value="D" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "D") {
                                echo "selected";
                            } ?>>GRUPE D</option>
        <option value="E" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "E") {
                                echo "selected";
                            } ?>>GRUPE E</option>
        <option value="F" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "F") {
                                echo "selected";
                            } ?>>GRUPE F</option>
        <option value="G" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "G") {
                                echo "selected";
                            } ?>>GRUPE G</option>
        <option value="H" <?php if (isset($gruppeauswahl) && $gruppeauswahl == "H") {
                                echo "selected";
                            } ?>>GRUPE H</option>
    </select>
    <input type="submit" name="anzeigen" value="manschaft anzeigen">

</form>

<?php

// if (isset($_GET['edit'])) {
//     echo "Du hast gerade Edit gedrückt";
// }

if (!empty($spieledit)) {
    //  echo "Du hast gerade Edit gedrückt";
?>
    <form action="./../controller/spiele.php" method="POST">
        <table>
            <tr>
                <th>Heimmannschaft</th>
                <th>Gastmannschaft</th>
                <th>Gruppe</th>
                <th>Spieltag</th>
                <th>Spielort</th>
                <th>Datum</th>
                <th>Uhrzeit</th>

            </tr>
            <tr>
                <td><?php echo $spieledit['heimmannschaft']; ?></td>
                <td><?php echo $spieledit['gastmannschaft']; ?></td>
                <td><?php echo $spieledit['gruppe']; ?></td>
                <td><?php echo $spieledit['spieltag']; ?></td>
                <td>

                    <select name="spielort" id="spielort">
                        <?php
                        foreach ($spielorte as $spielort) {
                        ?>
                            <option value="<?php echo $spielort['id_spielort']; ?>"><?php echo $spielort['arena']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="datum" id="datum">
                        <option value="2023-01-11">11.01.</option>
                        <option value="2023-01-12">12.01.</option>
                        <option value="2023-01-13">13.01.</option>
                        <option value="2023-01-14">14.01.</option>
                        <option value="2023-01-15">15.01.</option>
                        <option value="2023-01-16">16.01.</option>
                        <option value="2023-01-17">17.01.</option>
                    </select>
                </td>
                <td>
                    <select name="uhrzeit" id="uhrzeit">
                        <option value="18:00:00">18:00:00</option>
                        <option value="20:30:00">20:30:00</option>
                    </select>
                </td>

            </tr>
            <tr>
                <td class="center" colspan='7'><input type="hidden" name="idspiel" value="<?php echo $spieledit['id_spiele'];  ?>"><input type="submit" name="update" value="UPDATE"></td>
            </tr>
        </table>
    </form>
<?php

}


// if ($showEditForm == 1) {
//     echo "Du hast gerade Edit gedrückt";
// }


// Siegi: Hinweis - Aufgabe 1 Stelle 3/3
// Diese Tabelle muss um weitere drei Spalten ergänzt werden für datum, uhrzeit und spielort (oder wenigstens spielort_id ;-)
// Hinweis: sowohl die Überschriften als auch die Inhalte müssen ergänzt werden.
if (!empty($spiele)) {
?>
    <table>
        <tr>
            <th>Heimmannschaft</th>
            <th>Gastmannschaft</th>
            <th>Gruppe</th>
            <th>Spieltag</th>
            <th>Datum</th>
            <th>Uhrzeit</th>
            <th>Spielort</th>
            <th>Update</th>
           
        </tr>
        <?php

        foreach ($spiele as $spiel) {
        ?>
            <tr>
                <td><?php echo $spiel['heimmannschaft']; ?></td>
                <td><?php echo $spiel['gastmannschaft']; ?></td>
                <td><?php echo $spiel['gruppe']; ?></td>
                <td><?php echo $spiel['spieltag']; ?></td>
                <td><?php echo $spiel['datum']; ?></td>
                <td><?php echo $spiel['uhrzeit']; ?></td>
                <td><?php echo $spiel['arena']; ?></td>
                <td><a href="./../controller/spiele.php?edit=<?php echo $spiel['id_spiele']; ?>"><img src="./../inc/pics/edit.png" alt="editieren"></a></td>
            </tr>
        <?php } ?>
    </table>

<?php
} else {
    // echo "Es sind noch keine Mannschaften vorhanden!";
}

?>