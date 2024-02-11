<?php

$conn = new mysqli("localhost", "root", "", "FindVentory");

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Daten aus dem Formular erhalten
$such = $_POST['sucheingabe'];

// Suchstring aus Sucheingabe holen
$such = $conn->real_escape_string($_POST['sucheingabe']);

// SQL-Abfrage für das Finden eines Matches in der Tabelle
$sql = "SELECT * FROM geraete WHERE 
        GeraeteID LIKE '%$such%' OR
        Hersteller LIKE '%$such%' OR
        Seriennummer LIKE '%$such%' OR
        Preis LIKE '%$such%' OR
        Kaufdatum LIKE '%$such%'";

$result = $conn->query($sql);

?>

<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Datenbankzugriff</title>
    <link rel="stylesheet" href="../CSS/fvstyles_edit_search.css">
</head>
<body>

    <div class="container">
        <div class="tabelle">
            <h1>Suchergebnisse</h1>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Hersteller</th>
                    <th>Seriennummer</th>
                    <th>Preis</th>
                    <th>Kaufdatum</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['GeraeteID'] . "</td>";
                    echo "<td>" . $row['Hersteller'] . "</td>";
                    echo "<td>" . $row['Seriennummer'] . "</td>";
                    echo "<td>" . $row['Preis'] . "</td>";
                    echo "<td>" . $row['Kaufdatum'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div class="rightflexbox">
            <h1>Hier können Sie ein Gerät suchen</h1>
            <form action="../HTML/Suchergebnisse_HTML.php" method="post">
                <p>
                    <label for="ID">Sucheingabe</label><br>
                    <input id="ID" type="text" name="sucheingabe">
                </p>
                <input class="button-uebergabe" type="submit" value="Gerät finden"><br>
                <a class="button-uebergabe" id="link" href="http://localhost/HTML/Index.html">Hauptmenü</a>
            </form>
        </div>
    </div>
    <span class="watermark">
            © 2024 Benjamin Schwarz
    </span>

</body>
</html>

<?php
// Verbindung schließen
$conn->close();
?>
