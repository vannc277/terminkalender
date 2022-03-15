<?php
session_start();

# Datenverbindung
$link = mysqli_connect("localhost", "root", "", "terminkalender");
mysqli_query($link, "SET names utf8");

if (isset($_GET["seite"]) && $_GET["seite"] == "logout") {
	unset($_SESSION["eingeloggt"]);		
	unset($_SESSION["benutzer_pk"]);
	unset($_SESSION["benutzer"]);
	unset($_SESSION["login_merken"]);
	setcookie("login_merken", "", time() -1); # cookie entfernen beim Client
	unset($_COOKIE["login_merken"]); # cookie aus dem Server RAM löschen
	$_SESSION["mitteilung"] = "<div style='color:red; margin-bottom: 20px'>Sie haben sich ausgeloggt</div>";	
}

if(isset($_POST["benutzer"]) && isset($_POST["kennwort"])) {
	# SQL-Injection unschädlich machen (' wird zu \'  ,  " wird zu \") 
	$_POST["benutzer"] = mysqli_real_escape_string($link, $_POST["benutzer"]);
	
	# Überprüfen mit der Datenbank
	$sql =  " select * from benutzer "; 
	$sql .= " where benutzer_name='".$_POST["benutzer"]."' "; 

	$antwort = mysqli_query($link, $sql);
	
	# Wird genau eine Zeile geliefert?
	if($antwort->num_rows == 1) {
		# Datensatz aus der Datenbank rausholen
		$datensatz = mysqli_fetch_array($antwort);
		
		# Fingerabdruck vergleichen
		if(password_verify($_POST["kennwort"], $datensatz["passwort"])) {
			#echo "klappt";
			$_SESSION["eingeloggt"] = true;
			$_SESSION["benutzer_pk"] = $datensatz["benutzer_pk"];
			$_SESSION["benutzer"] = $datensatz["benutzer_name"];
			$_SESSION["mitteilung"] = "<div style='color:lightgreen; margin-bottom: 20px'>Erfolgreich eingeloggt</div>";
			if(isset($_POST["merken"]))
			{
				setcookie("login_merken", "Benutzer", time() + 60*60*24*365);
			}
			# Kopfzeilen ändern
			header("Location: ?seite=verwaltung"); # Weiterleiten zur Verwaltung
			exit; # PHP - Programm Ende
		} 
		else {
			$_SESSION["mitteilung"] = "<div style='color:red; margin-bottom: 20px'>Eingabe ist nicht richtig!</div>";
		}
	} else {
		#echo "falsch";
		$_SESSION["mitteilung"] = "<div style='color:red; margin-bottom: 20px'>Eingabe ist nicht richtig!</div>";
	}
}

# wenn der cookie da ist
if (isset($_COOKIE["login_merken"])) {
	# automatisch einloggen
	$_SESSION["eingeloggt"] = true;
	$_SESSION["benutzer"] = "Benutzer";
}
 
?>

<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>terminkalender</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
	<header>
		<div>
			<img src="kalender.jpg" style="width: 50; height: 50">
		</div>
		<div>
		<a href="?seite=start">Startseite</a>
		<?php
		if (isset($_SESSION["eingeloggt"])) {
			echo '<a href="?seite=verwaltung">Verwaltung</a>';
			echo '<a href="?seite=logout">Logout</a>';
			echo "<span style='color: lightsalmon'>" . "Hallo " . $_SESSION["benutzer"] ."</span><br />";
		} else {
			echo '<a href="?seite=login">Login</a>';
		}
		?>
		</div>
	</header>

	<main>
	<?php
		if(isset($_SESSION["mitteilung"])) {
			echo $_SESSION["mitteilung"]; # Anzeigen
			unset($_SESSION["mitteilung"]); # Entfernen / Löschen
		}

		if (!isset($_GET["seite"])) {
			$_GET["seite"] = "start";
		}

		switch ($_GET["seite"]) {
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
				if (isset($_SESSION["eingeloggt"])) {
					include("php/verwaltung.php"); # externe Datei einbinden
				} 
				else {
					header("Location: ?seite=login"); # Weiterleitung zum Login
					exit; # Programm verlassen / beenden
				}
				break;
			default:
				include("php/404.php"); # externe Datei einbinden
		}
	?>
	</main>

	<footer>
		&copy; Copyright <?= date("Y"); ?>
	</footer>
	
</body>

</html>