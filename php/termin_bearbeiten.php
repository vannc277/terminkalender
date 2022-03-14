<?php
$titel = "Termin bearbeiten";
$button = "Termin ändern";
if (isset($_GET["termin"])) {
    $termin_pk = $_GET["termin"];
} else {
    echo "<div style='color:red'>Fehler kein Termin id gefunden.</div>";
    die();
}
include("termin_loeschen.php");
if (isset($_POST["termin_speichern"])) {

    $beschreibung = $_POST["beschreibung"];
    $datum = $_POST["datum"];
    if ($_POST["zeit"] == "") {
        $zeit = "NULL";
    } else {
        $zeit = "'".$_POST["zeit"]."'";
    }

    $status = $_POST["status"];
    $benutzer_fk = $_SESSION["benutzer_pk"];
    $sql_query = "update termine set
    beschreibung = '$beschreibung',
    datum = '$datum',
    zeit = $zeit,
    status_fk = '$status',
    benutzer_fk = '$benutzer_fk'
where termin_pk = $termin_pk ";
    mysqli_query($link, $sql_query);

    echo "</br>";
    echo "Der Termin wurde erfolgreich geändert.";
    echo "<table>";
    echo "<tr>";
    echo "<th>Termin</th>";
    echo "<th>Datum</th>";
    echo "<th>Uhrzeit</th>";
    echo "<th>Status</th>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>" . $beschreibung . "</td>";
    echo "<td>" . $datum . "</td>";
    echo "<td>" . $zeit . "</td>";

    switch ($status) {
        case '1':
            echo "<td>Unerledigt</td>";
            break;
        case '2':
            echo "<td>Abgeschlossen</td>";
            break;
        case '3':
            echo "<td>Abgesagt</td>";
            break;
    }
    echo "</tr>";
    echo "</table>";
    echo "<br />";
    echo "<a href='?seite=verwaltung&unterseite=termin_anzeige'>Alle Termine anzeigen</a>";
} else if (isset($_POST["termin_loeschen"])) {
    include ("php/termin_loeschenbestaetigung.php");
} else {
    include("termin_daten_laden.php");
    include("termin_formular.php");
}


