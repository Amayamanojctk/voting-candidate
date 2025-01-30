<?php
session_start();
include("../db/db_connect.php");

if (!isset($_SESSION['admin'])) {
    header("Location: manage_candidates.php");
    exit();
}

$message = "";

// Delete Candidate
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $fetch = $conn->query("SELECT photo FROM candidates WHERE id='$id'");
    if ($fetch->num_rows > 0) {
        $row = $fetch->fetch_assoc();
        if (file_exists("../" . $row['photo'])) {
            unlink("../" . $row['photo']);
        }
    }

    $sql = "DELETE FROM candidates WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Candidate deleted successfully!";
    } else {
        $message = "Error deleting candidate!";
    }
}

// Update Candidate
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_candidate'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $desc = trim($_POST['description']);

    if (!empty($_FILES["photo"]["name"])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $photo_path = "uploads/" . $_FILES["photo"]["name"];
        
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

        $sql = "UPDATE candidates SET name=?, photo=?, description=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $photo_path, $desc, $id);
    } else {
        $sql = "UPDATE candidates SET name=?, description=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $desc, $id);
    }
    
    if ($stmt->execute()) {
        $message = "Candidate updated successfully!";
    } else {
        $message = "Error updating candidate!";
    }
}

// Fetch Candidates
$candidates = $conn->query("SELECT * FROM candidates");
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
        <h2>Candidate Management</h2>
        <?php if (!empty($message)) { echo "<p class='status-msg'>$message</p>"; } ?>

        <table class="candidate-table">
            <tr>
                <th>Name</th>
                <th>Photo</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = $candidates->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><img src="../<?= $row['photo']; ?>" class="candidate-img"></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="?edit=<?= $row['id']; ?>" class="btn edit-btn">Edit</a>
                        <a href="?delete=<?= $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <?php if (isset($_GET['edit'])): 
            $edit_id = $_GET['edit'];
            $edit_result = $conn->query("SELECT * FROM candidates WHERE id='$edit_id'");
            $edit_data = $edit_result->fetch_assoc();
        ?>
            <h3>Edit Candidate</h3>
            <form method="post" enctype="multipart/form-data" class="form-container">
                <input type="hidden" name="id" value="<?= $edit_data['id']; ?>">
                <label>Candidate Name:</label>
                <input type="text" name="name" value="<?= $edit_data['name']; ?>" required>

                <label>Description:</label>
                <textarea name="description" required><?= $edit_data['description']; ?></textarea>

                <label>Upload Photo (Optional):</label>
                <input type="file" name="photo">
                
                <button type="submit" name="update_candidate" class="btn submit-btn">Update Candidate</button>
            </form>
        <?php endif; ?>

        <a href="index.php" class="btn back-btn">Back to Dashboard</a>
    </div>

</body>
</html>
