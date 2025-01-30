<?php
include("../db/db_connect.php");

$candidate_id = $_GET['id'];

$sql = "UPDATE candidates SET votes = votes + 1 WHERE id = '$candidate_id'";
$conn->query($sql);

echo "Vote casted successfully!";
?>
