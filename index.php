<?php
# Datenverbindung
$link = mysqli_connect ("localhost", "root", "", "terminkalender");
mysqli_query($link, "SET names utf8");

if(isset($_GET["seite"]) && $_GET["seite"] == "logout")
{
	session_destroy();
	unset($_SESSION);
	setcookie("login_merken", "", time() -1); # cookie entfernen beim Client
	unset($_COOKIE["login_merken"]); # cookie aus dem Server RAM löschen
}


if(isset($_POST["benutzer"]) && isset($_POST["kennwort"]))
{
	if($_POST["benutzer"] == "van" && $_POST["kennwort"] == "nguyen")
	{
		#echo "klappt";
		$_SESSION["eingeloggt"] = true;
		$_SESSION["benutzer"] = "Van Nguyen";
		$_SESSION["mitteilung"] = "<div style='color:lightgreen'>Erfolgreich eingeloggt</div>";
		if(isset($_POST["merken"]))
		{
			setcookie("login_merken", "Van Nguyen", time() + 60*60*24*365);
		}
		# Kopfzeilen ändern
		header("Location: ?seite=verwaltung"); # Weiterleiten zur Verwaltung
		exit; # PHP - Programm Ende
	}
	else
	{
		#echo "falsch";
		$_SESSION["mitteilung"] = "<div style='color:red'>Falsche Eingabe</div>";
	}	
}

# wenn der cookie da ist
if(isset($_COOKIE["login_merken"]))
{
	# automatisch einloggen
	$_SESSION["eingeloggt"] = true;
	$_SESSION["benutzer"] = "Van Nguyen";	
}

# Neue Termine in Datenbeank eintragen
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
}


 #$antwort = mysqli_query($link, "select * from termine order by datum");
$antwort = mysqli_query($link, "SELECT t.beschreibung, t.datum, t.zeit, s.beschreibung as status
                                    FROM termine as t, statusmoeglichkeiten as s 
                                    WHERE t.status_fk = s.status_pk ORDER BY t.datum ASC, status");
 /* $unerledigte = array();
 $abgeschlossen = array();
 $abgesagte = array();

 while ($datensatz = mysqli_fetch_array($antwort)) {
     if ($datensatz["status"] == 1) {
         $unerledigte[] = $datensatz;
    }
    if ($datensatz["status"] == 2) {
        $abgeschlossen[] = $datensatz;
     }
     if ($datensatz["status"] == 3) {
        $abgesagte[] = $datensatz;
     }
}*/

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>terminkalender</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <a href="?seite=start">Startseite</a>
        <?php
	    if(isset($_SESSION["eingeloggt"]))
	    {
            echo '<a href="?seite=Verwaltung">Verwaltung</a>';
            echo '<a href="?seite=logout">Logout</a>';
            echo "Hallo ".$_SESSION["benutzer"];		
	    }
	else
	{
		echo '<a href="?seite=login">Login</a>';
	}	

    switch($_GET["seite"])
{
	case "start":
		include("php/startseite.php"); # externe Datei einbinden
	break;
	case "login":
		include("php/login.php"); # externe Datei einbinden	
	break;
	case "logout":
		include("php/logout.php"); # externe Datei einbinden	
	break;	
	case "verwaltung":
		if(isset($_SESSION["eingeloggt"]))
		{
			include("php/verwaltung.php"); # externe Datei einbinden
		}
		else
		{
			header("Location: ?seite=login"); # Weiterleitung zum Login
			exit; # Programm verlassen / beenden
		}	
	break;	
	default:
		include("php/404.php"); # externe Datei einbinden
}

	?>
    </header>

   

</body>
</html>


