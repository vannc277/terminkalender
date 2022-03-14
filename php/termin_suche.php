<?php
if (isset($_POST["suchbutton"])) {
    $_SESSION["suche"] = $_POST["suche"];
}
?>
<form method="POST">
    Suche: <input type="text" name="suche" value="<?= @$_SESSION["suche"]; ?>">
    <input type="submit" name="suchbutton" value="Suchen">
</form>

<?php
if (isset($_SESSION["suche"]) && $_SESSION["suche"] != "") {
    #var_dump($_SESSION["suche"]);
    include("gesuchten_Termin_laden.php");
}
?>






