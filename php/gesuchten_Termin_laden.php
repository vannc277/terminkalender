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


$bedingungen = "";
if(count($bedingungen_array) > 0)
{
    $bedingungen = " WHERE ";
	$bedingungen .= implode(" AND ", $bedingungen_array);
}

$sql_befehl = "
select * from termine as t INNER JOIN statusmoeglichkeiten as s ON t.status_fk = s.status_pk " .$bedingungen. "order by datum";

#var_dump($sql_befehl);

$antwort = mysqli_query($link, $sql_befehl);

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
    echo "<td><a href='?seite=verwaltung&unterseite=termin_bearbeiten&termin=".$datensatz["termin_pk"]."'>Bearbeiten</a><td>";
    echo "</tr>";
}
echo "</table>";