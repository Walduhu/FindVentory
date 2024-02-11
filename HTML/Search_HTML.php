<?php

$conn = new mysqli("localhost", "root", "");

$result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'findventory'");
if ($result->num_rows == 1) {
  
  $conn->select_db("findventory");
}
else{ 
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

    <body>
    <div class="container">
        <div class = "tabelle">
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
            <h1>Search for a device here</h1>
            <form action="../HTML/SearchResults_HTML.php" method="post">
                <p>
                    <label for="ID">Search input field</label><br>
                    <input id="ID" type="text" name="sucheingabe">
                </p>

                <input class="button-uebergabe" type="submit" value="Find device"><br>
                <a class="button-uebergabe" id="link" href="http://localhost/HTML/Index.html">Main menu</a>
            </form>
          </div>

          </div>
        <span class="watermark">
            © 2024 Benjamin Schwarz
        </span>

    </body>



</body>

</html>