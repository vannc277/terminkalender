<?php
if (isset($_POST["suchbutton"])) {
    $_SESSION["suche"] = $_POST["suche"];
    include("gesuchten_Termin_laden.php");
}
?>
<form method="POST">
    Suche: <input type="text" name="suche" value="<?= @$_SESSION["suche"]; ?>">
    <input type="submit" name="suchbutton" value="Suchen"> Filtern nach Status:

<?php
$status_array = array("unerledigt","abgeschlossen","abgesagt");
foreach ($status_array as $status) {
    $klasse = "button_inaktiv";

    # Wenn der Button gedrückt wurde
	if(isset($_POST["button_$status"]))
	{
		if(!isset($_SESSION["filter_status"]["$status"]))
		{
			# Dann den Button speichern (aktivieren)
			$_SESSION["filter_status"]["$status"]= true;			
		}
		else
		{
			# Dann den Button rausschmeissen (deaktivieren)
			unset($_SESSION["filter_status"]["$status"]);			
		}
	}	
    if(isset($_SESSION["filter_status"]["$status"]))
	{
		$klasse = "button_aktiv";
	}
	
	echo "<input type='submit' value='$status' 
			name='button_$status' class='$klasse' />";
}
?>

</form>

