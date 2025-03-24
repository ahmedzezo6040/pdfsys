<?PHP
include '../includes/db.php';
// Fetch all files from the database
$sql = "SELECT * FROM pdf_files ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uploaded_files</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</head>

<body>
    <button class="toggle-button" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i> <!-- Hamburger icon -->
    </button>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Uploaded Files</h2>
        <div class="files-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="file-item">
                        <a href="../<?= $row['file_path'] ?>" target="_blank"><?= $row['file_name'] ?></a>
                        <p class="comment"><?= $row['comment'] ?></p>
                        <!-- Delete Form -->
                        <form action="delete_file.php" method="POST" style="display: inline;">
                            <input type="hidden" name="file_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="file_path" value="<?= $row['file_path'] ?>">
                            <button type="submit" class="button delete-button">Delete</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No files uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>