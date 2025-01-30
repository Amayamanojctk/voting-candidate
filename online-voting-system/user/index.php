<?php
include("../db/db_connect.php");

$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<img src='../" . $row['photo'] . "' style='width: 100%; height: auto; max-width: 500px; max-height: 300px;'>";

    echo "<h1 style='color: black;'>" . $row['name'] . "</h1>";
    echo "<h2 style='color: blue;'>" . $row['description'] . "</h2>";
    
    echo "<a href='vote.php?id=" . $row['id'] . "' style='display: inline-block; padding: 5px 20px; background-color: black; color: white; text-decoration: none; border-radius: 8px; font-size: 16px; font-weight: bold; transition: background 0.3s;'>Vote</a>";

    echo "</div>";
}