<?php
$titel = "Termin eintragen";
$button = $titel;
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

    mysqli_query($link, "insert into termine
                (beschreibung, datum, zeit, status_fk, benutzer_fk)
                values
                ('$beschreibung', '$datum', $zeit, '$status', '$benutzer_fk')
                ");

    $termin_pk = $link->insert_id; # primärschlüssel

	echo "<div style='color:lightgreen; margin-bottom: 20px'>Es wurde einen neuen Termin gespeichert unter: ". $termin_pk ."</div>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Termin</th>";
    echo "<th>Datum</th>";
    echo "<th>Uhrzeit</th>";
    echo "<th>Status</th>";
    echo "</tr>";
        
    echo "<tr>";
    echo "<td>".$beschreibung."</td>";
    echo "<td>".$datum."</td>";
    echo "<td>".$zeit."</td>";

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
    echo"</table>";
    echo "<br />";
	echo "<a href='?seite=verwaltung&unterseite=termin_eintrage'>Weiteren Termin eintragen</a>";
	echo "<a href='?seite=verwaltung&unterseite=termin_anzeige'>Alle Termine anzeigen</a>";						
}
else
{
	include("termin_formular.php");
}
?>

