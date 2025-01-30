<?php
session_start();
include("../db/db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $desc = trim($_POST['description']);

   
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $photo_path = "uploads/" . $_FILES["photo"]["name"];

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO candidates (name, photo, description) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $photo_path, $desc);
        
        if ($stmt->execute()) {
            $message = "Candidate added successfully!";
        } else {
            $message = "Error adding candidate!";
        }
    } else {
        $message = "Error uploading photo!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Candidates</title>

   
    <link rel="stylesheet" href="assets/style.css">

  
    <script src="assets/script.js" defer></script>
</head>
<body>

    <div class="container">
        <h2>Add Candidate</h2>

        <?php if (!empty($message)) { echo "<p class='status-msg'>$message</p>"; } ?>

        <form method="post" enctype="multipart/form-data" class="form-container">
            <input type="text" name="name" placeholder="Candidate Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="file" name="photo" required>
            <button type="submit" class="submit-btn">Add Candidate</button>
          
        </form>
        <a href="edit_candidate.php" class="back-btn">EDIT/DELETE</a>

        <a href="index.php" class="back-btn">Back to Dashboard</a>
    </div>

</body>
</html>
