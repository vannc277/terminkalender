<?php
if (isset($_POST["termin_eintragen"])) {
    $beschreibung = $_POST["beschreibung"];
    $datum = $_POST["datum"];
	$zeit = $_POST["zeit"];
    $status = $_POST["status"];
    mysqli_query($link, "insert into termine
                (beschreibung, datum, zeit, status_fk)
                values
                ('$beschreibung', '$datum', '$zeit', '$status')
                ");

    $termin_pk = $link->insert_id; # primärschlüssel

	echo "Es wurde einen neuen Termin gespeichert unter: ". $termin_pk;
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
	echo "<a href='php/termin_formular.php'>Weiteren Termin eintragen</a>";						
}
else
{
	include("termin_formular.php");
}
?>

