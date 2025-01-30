<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

   
    <link rel="stylesheet" href="assets/style.css">

  
    <script src="assets/script.js" defer></script>

</head>
<body>

    <div class="container">
        <h2>Welcome, Admin</h2>
        
        <div class="menu">
            <a href="manage_candidates.php" class="btn">Manage Candidates</a>
            <a href="results.php" class="btn">View Results</a>
            <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>
    </div>

</body>
</html>
