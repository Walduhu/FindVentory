<?php

$conn = new mysqli("localhost", "root", "", "FindVentory");

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}


// Daten aus dem Formular erhalten
$idB = $_POST['geraeteID'];

// SQL-Abfrage für das Löschen von Daten
$conn->query("DELETE FROM geraete WHERE GeraeteID = $idB");

// Verbindung schließen
$conn->close();
header("location:../HTML/Loeschen_HTML.php");
?>
