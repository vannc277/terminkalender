<?php
if(isset($_GET["unterseite"]))
{
	switch($_GET["unterseite"])
	{
		case "termin_eintrage": 	include("termin_eintrage.php"); 	break;
		case "termin_anzeige": 	    include("termin_anzeige.php"); 	    break;
	}
}
else
{
	include("verwaltungsuebersicht.php");
}