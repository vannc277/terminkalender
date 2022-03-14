<?php
if(isset($_GET["unterseite"]))
{
	switch($_GET["unterseite"])
	{
		case "termin_eintrage": 		include("termin_eintrage.php"); 		break;
		case "termin_anzeige": 	    	include("termin_anzeige.php"); 	    	break;
		case "termin_bearbeiten": 	    include("termin_bearbeiten.php"); 	    break;
		case "termin_suche":			include("termin_suche.php");			break;
		
	}
}
else
{
	include("verwaltungsuebersicht.php");
}