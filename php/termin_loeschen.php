<?php
if(isset($_POST["termin_loeschen_ja"]))
{
    #var_dump($termin_pk);
	mysqli_query($link, "delete from termine where termin_pk = $termin_pk");
	
	# Umleitung
	header("Location: ?seite=verwaltung&unterseite=termin_anzeige");
	#exit;	
}
else if(isset($_POST["termin_loeschen_nein"]))
{
	# Umleitung
	header("Location: ?seite=verwaltung&unterseite=termin_anzeige");
	#exit;	
}
/* else
{
	echo "<h2>Produkt Löschen</h2><br /><hr /><br />";
	
	include("alte_produkt_daten_laden.php");
	include("produkt_loeschbestaetigung.php");
} */