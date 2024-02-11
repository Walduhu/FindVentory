<?php

$conn = new mysqli("localhost", "root", "", "FindVentory");


if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}


$such = $_POST['sucheingabe'];


$such = $conn->real_escape_string($_POST['sucheingabe']);


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
    <title>MySQL Database Access</title>
    <link rel="stylesheet" href="../CSS/fvstyles_edit_search.css">
</head>
<body>

    <div class="container">
        <div class="tabelle">
            <h1>Search results</h1>

      <table>
        <tr>
          <th>ID</th>
          <th>Manufacturer</th>
          <th>Serial No.</th>
          <th>Price in €</th>
          <th>Date of purchase</th>
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
</html>

<?php
// Verbindung schließen
$conn->close();
?>
