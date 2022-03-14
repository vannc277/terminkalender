<?php
$bedingungen_array = array();
# Suche
$search_input = explode(" ", $_SESSION["suche"]);
#if(isset($_SESSION["suche"]) && $_SESSION["suche"] != "")
# Geb März unerl, Geb unerl, März unerl
# Januar .... Dezember -> März => -03-
# unerledigt, abgeschlossen .... -> starts with unerl
# 10:00
if(isset($search_input[0]) && $search_input[0] != "")
{
    #$_bedingung = $_SESSION["suche"];
    $_bedingung = $search_input[0];
	$bedingungen_array[] = "(
        beschreibung LIKE '%".$_bedingung."%'
        OR
        datum LIKE '%".$_bedingung."%'
        OR
        zeit LIKE '%".$_bedingung."%'
        )";
        #s.bezeichnung LIKE '%".$_bedingung."%'
    }
    
    if(isset($search_input[1]) && $search_input[1] != "") {
        $_filter = $search_input[1];
        
        $bedingungen_array[] = "s.bezeichnung LIKE '%".$_filter."%'";
    }
    
    
    $bedingungen = "";
    if(count($bedingungen_array) > 0)
    {
        $bedingungen = " WHERE ";
        $bedingungen .= implode(" AND ", $bedingungen_array);
    }
    
    $sql_befehl = "
    select * from termine as t INNER JOIN statusmoeglichkeiten as s ON t.status_fk = s.status_pk " .$bedingungen. "order by datum";
    
//var_dump($sql_befehl);

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