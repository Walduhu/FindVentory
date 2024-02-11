<?php

$conn = new mysqli("localhost", "root", "");

$result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'findventory'");
if ($result->num_rows == 1) {

  $conn->select_db("findventory");
} else { 
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
  <title>MySQL Database Access</title>
  <link rel="stylesheet" href="../CSS/fvstyles_edit_search.css">
</head>

<body>
  <div class="container">
    <div class="tabelle">
<h1>Device list</h1>

      <table>
        <tr>
          <th>ID</th>
          <th>Manufacturer</th>
          <th>Serial No.</th>
          <th>Price in €</th>
          <th>Date of purchase</th>
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
      <h1>Edit a listed device here</h1>
      <form action="../PHP/Edit.php" method="post">
        <p>
          <label for="ID">ID</label><br>
          <input id="ID" type="number" name="geraeteID" required>
        </p>
        <p>
          <label for="Hersteller">Manufacturer</label><br>
          <input id="Hersteller" type="text" name="hersteller">
        </p>
        <p>
          <label for="SNR">Serial No.</label><br>
          <input id="SNR" type="text" name="modelNr">
        </p>
        <p>
          <label for="PiE">Price in €</label><br>
          <input id="PiE" type="number" step="0.01" name="preis">
        </p>
        <p>
          <label for="KD">Date of purchase</label><br>
          <input id="KD" type="date" name="kaufdatum">
        </p>
        <input class="button-uebergabe" type="submit" value="Edit device"><br>
        <a class="button-uebergabe" id="link" href="http://localhost/HTML/Index.html">Main menu</a>
      </form>
    </div>

  </div>
  <span class="watermark">
    © 2024 Benjamin Schwarz
  </span>

</body>





</html>
