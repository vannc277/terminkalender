<?php
include("termin_daten_laden.php");
?>
<ul>
    <li>
        Termin: <?= @$beschreibung?>
    </li>
    <li>
        Datum: <?= @$datum?>
    </li>
    <li>
        Uhrzeit: <?= @$zeit?>
    </li>
    <li>
        Status: <?= @$status?>
    </li>
</ul>

<h1>Wollen Sie wirklich löschen?</h1>
<form method="POST">
    <input type="submit" value="JA" name="termin_loeschen_ja" />
    <input type="submit" value="NEIN" name="termin_loeschen_nein" />
</form>