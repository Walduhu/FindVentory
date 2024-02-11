<?php
$conn = new mysqli("localhost", "root", "");

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Daten aus dem Formular erhalten
$herstellerA = $_POST['hersteller'];
$snrA = $_POST['modelNr'];
$preisA = $_POST['preis'];
$kaufDatA = $_POST['kaufdatum'];

// Datenbank erstellen wenn sie nicht bereits existiert
$sql = "CREATE DATABASE IF NOT EXISTS findventory";
$conn->query($sql);

// Datenbank verwenden
$conn->select_db("findventory");

// Tabelle erstellen wenn sie nicht bereits existiert
$sql = "CREATE TABLE IF NOT EXISTS geraete (
    GeraeteID int auto_increment primary key,
    Hersteller varchar(30) not null,
    Seriennummer varchar(50) not null,
    Preis double(7,2) not null,
    Kaufdatum date
)";
$conn->query($sql);

// SQL-Abfrage für das Einfügen von Daten
$sql = "INSERT INTO geraete (Hersteller, Seriennummer, Preis, Kaufdatum) VALUES ('$herstellerA', '$snrA', '$preisA', '$kaufDatA')";

// Überprüfen, ob die Abfrage erfolgreich war
if ($conn->query($sql) === TRUE) {
    echo "Eintrag erfolgreich hinzugefügt";
} else {
    echo "Fehler beim Hinzufügen des Eintrags: " . $conn->error;
}

// Verbindung schließen
$conn->close();
header("location:../HTML/Eingabe_HTML.php");
?>



