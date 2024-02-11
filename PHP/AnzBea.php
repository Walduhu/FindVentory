<?php

$conn = new mysqli("localhost", "root", "", "FindVentory");

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Daten aus dem Formular erhalten
$idB = $_POST['geraeteID'];
$herstellerB = $_POST['hersteller'];
$snrB = $_POST['modelNr'];
$preisB = $_POST['preis'];
$kaufDatB = $_POST['kaufdatum'];

// SQL-Abfrage für das Einfügen von Daten
$sql = "UPDATE geraete SET Hersteller = '$herstellerB', Seriennummer = '$snrB', Preis = '$preisB', Kaufdatum = '$kaufDatB' WHERE GeraeteID = $idB";
$conn->query($sql);

// Überprüfen, ob die Abfrage erfolgreich war
if ($conn->query($sql) === TRUE) {
    echo "Eintrag erfolgreich geändert";
} else {
    echo "Fehler beim Ändern des Eintrags: " . $conn->error;
}

// Verbindung schließen
$conn->close();
header("location:../HTML/Bearbeiten_HTML.php");
?>
