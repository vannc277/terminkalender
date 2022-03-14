<?php
$sql_query = "SELECT t.termin_pk, t.beschreibung, t.datum, t.zeit, t.status_fk, s.bezeichnung as status
FROM termine as t, statusmoeglichkeiten as s 
WHERE t.status_fk = s.status_pk AND t.termin_pk = " . $termin_pk . " ORDER BY t.datum ASC, status";

#var_dump($sql_query);
$antwort = mysqli_query($link, $sql_query);


if ($antwort->num_rows == 1) {
$datensatz = mysqli_fetch_array($antwort);
$beschreibung = $datensatz["beschreibung"];
$datum = $datensatz["datum"];
$zeit = $datensatz["zeit"];
$status = $datensatz["status"];
$status_fk = $datensatz["status_fk"];
$benutzer_fk = $_SESSION["benutzer_pk"];
} else {
echo "<div style='color:red'>Fehler Anzahl der Termine für id " . $termin_pk . " größer als 1.</div>";
}