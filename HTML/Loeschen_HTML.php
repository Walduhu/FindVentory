<?php

$conn = new mysqli("localhost", "root", "");

// Prüfen ob die Datenbank existiert
$result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'findventory'");
if ($result->num_rows == 1) {
  // Datenbank auswählen wenn sie existiert
  $conn->select_db("findventory");
}
else{ // Datenbank und Tabelle erstellen wenn sie nicht existieren
  $sql = "CREATE DATABASE findventory;";
  $conn->query($sql);
  $conn->select_db("findventory");
  $sql = "CREATE TABLE geraete (
    GeraeteID int auto_increment primary key,
    Hersteller varchar(30) not null,
    Seriennummer varchar(50) not null,
    Preis double(7,2) not null,
    Kaufdatum date
    )";
    $conn->query($sql);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Datenbankzugriff</title>
    <link rel="stylesheet" href="../CSS/fvstyles_delete.css">
</head>

<body>

    <body>
    <div class="container">
        <div class = "tabelle">
        <h1>Geräteliste</h1>
        <table>
          <tr>
          <th>ID</th>
          <th>Hersteller</th>
          <th>Seriennummer</th>
          <th>Preis</th>
          <th>Kaufdatum</th>
          </tr>

          <?php
            $result = $conn->query("SELECT * FROM geraete");
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
            <h1>Hier können Sie Geräte entfernen</h1>
			<h2 style="color:red;">Achtung: Ausgewählte Geräte werden permanent gelöscht!</h2>
            <form action="../PHP/Loeschen.php" method="post">
                <p>
                    <label for="ID">Identifikationsnummer</label><br>
                    <input id="ID" type="number" name="geraeteID" required>
                </p>

                <input class="button-uebergabe" type="submit" value="Gerät löschen"><br>
                <a class="button-uebergabe" id="link" href="http://localhost/HTML/Index.html">Hauptmenü</a>
            </form>
          </div>

          </div>
        <span class="watermark">
            © 2024 Benjamin Schwarz
        </span>

    </body>



</body>

</html>