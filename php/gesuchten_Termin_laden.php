<?php
$bedingungen_array = array();
# Suche
if(isset($_SESSION["suche"]) && $_SESSION["suche"] != "")
{
	$bedingungen_array[] = "(
	beschreibung LIKE '%".$_SESSION["suche"]."%'
	OR
	datum LIKE '%".$_SESSION["suche"]."%'
	OR
	zeit LIKE '%".$_SESSION["suche"]."%'
    OR
    s.bezeichnung LIKE '%".$_SESSION["suche"]."%'
	)";
}

#Filter
$status_array = array("unerledigt","abgeschlossen","abgesagt");
$filter_array = array();

foreach ($status_array as $status) {
    if(isset($_SESSION["filter_status"][$status]))
	{
		$filter_array[] = "s.bezeichnung = '$status'";
	}
}

if(count($filter_array) > 0)
{
	$bedingungen_array[] = "(".implode(" OR ", $filter_array).")";
}

$bedingungen = "";
if(count($bedingungen_array) > 0)
{
    $bedingungen = " WHERE ";
	$bedingungen .= implode(" AND ", $bedingungen_array);
}

$sql_befehl = "
select * from termine as t 
INNER JOIN statusmoeglichkeiten as s 
ON t.status_fk = s.status_pk " .$bedingungen. "order by datum";
var_dump($sql_befehl);

$antwort = mysqli_query($link, $sql_befehl);

if($antwort->num_rows > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Termin</th>";
    echo "<th>Datum</th>";
    echo "<th>Uhrzeit</th>";
    echo "<th>Status</th>";
    echo "<th>Bearbeiten</th>";
    echo "</tr>";

    while($datensatz = mysqli_fetch_array($antwort))
    {   
        echo "<tr>";
        echo "<td>" . $datensatz["beschreibung"] . "</td>";
        echo "<td>" . $datensatz["datum"] . "</td>";
        echo "<td>" . $datensatz["zeit"] . "</td>";
        echo "<td>" . $datensatz["bezeichnung"] . "</td>";
        echo "<td><a style='background-color: transparent' href='?seite=verwaltung&unterseite=termin_bearbeiten&termin=".$datensatz["termin_pk"]."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "<div style='color: red; margin-bottom: 20px'>Kein Treffer für die Suche!</div>";
}