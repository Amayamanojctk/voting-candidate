<?php
session_start();
include("../db/db_connect.php");

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Secure query to prevent SQL Injection
    $sql = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    
    <link rel="stylesheet" href="assets/style.css">

  
    <script src="assets/script.js" defer></script>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>

       
        <?php if (!empty($error)) { echo "<p class='error-msg'>$error</p>"; } ?>

        <form method="post" class="login-form">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <a href="../index.html" class="back-btn">Go Back</a>
       
    </div>

</body>
</html>
