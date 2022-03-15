<h1><?= @$titel;?></h1>
<form action="" method="post">
    Termin: <textarea type="text" name="beschreibung" ><?= @$beschreibung?></textarea> <br /><br />
    Datum: <input type="date" name="datum" value="<?= @$datum?>"><br /><br />
    Uhrzeit: <input type="time" name="zeit" value="<?= @$zeit?>"><br /><br />
    Status: <select name="status">
        <?php
             $options = array("Unerledigt", "Abgeschlossen", "Abgesagt");
             $antwort = mysqli_query($link, "SELECT * FROM statusmoeglichkeiten");
             while ($status =  mysqli_fetch_array($antwort)) {
                $selected = "";
                $value = $status["status_pk"];
                if (isset($status_fk) && $value == $status_fk) {
                    $selected = "selected";
                }
                echo "<option value='".$value."' ".$selected.">".$status["bezeichnung"]."</option>";
             }
        ?>
    </select>
    <br /><br />
    <button type="submit" name="termin_speichern"><?= @$button;?></button>
    <?php
        if (isset($_GET["unterseite"]) && $_GET["unterseite"] = "termin_bearbeiten") {
             echo "<button type='submit' name='termin_loeschen'>Termin löschen</button>";
        }
    ?>
</form> 
