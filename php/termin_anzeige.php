
    
    <?php

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
        echo "<h1>Terminkalender</h1>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Termin</th>";
        echo "<th>Datum</th>";
		echo "<th>Uhrzeit</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        
        
        while ($termin = mysqli_fetch_array($antwort)) {
            echo "<tr>";
            echo "<td>".$termin["beschreibung"]."</td>";
            echo "<td>".$termin["datum"]."</td>";
			echo "<td>".$termin["zeit"]."</td>";
            echo "<td>".$termin["status"]."</td>";
            echo "</tr>";
        }
        echo"</table>";
   ?>