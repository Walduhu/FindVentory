<?php

$conn = new mysqli("localhost", "root", "", "FindVentory");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$idB = $_POST['geraeteID'];
$herstellerB = $_POST['hersteller'];
$snrB = $_POST['modelNr'];
$preisB = $_POST['preis'];
$kaufDatB = $_POST['kaufdatum'];

$sql = "UPDATE geraete SET Hersteller = '$herstellerB', Seriennummer = '$snrB', Preis = '$preisB', Kaufdatum = '$kaufDatB' WHERE GeraeteID = $idB";
$conn->query($sql);

if ($conn->query($sql) === TRUE) {
    echo "Eintrag erfolgreich geändert";
} else {
    echo "Fehler beim Ändern des Eintrags: " . $conn->error;
}

$conn->close();
header("location:../HTML/Edit_HTML.php");
?>
