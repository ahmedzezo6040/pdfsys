<?php
include '../includes/auth.php';
include '../includes/db.php';

if (!isLoggedIn()) {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM pdf_files ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        function openFileInNewWindow(filePath) {
            console.log("Opening file in new window:", filePath);
            window.open(filePath, '_blank');
        }
    </script>
    <style>
        .file-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .file-actions a {
            color: white;
        }

        .btn-open,
        .btn-download {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-download {
            background-color: #28a745;
            color: white;
        }

        .btn-open:hover,
        .btn-download:hover {
            opacity: 0.8;
        }

        #file-viewer-container {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <button class="toggle-button" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i> <!-- Hamburger icon -->
    </button>

    <div class="sidebar">
        <h2>User Panel</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Welcome, User</h1>
        </header>

        <h2>Available Files</h2>
        <div class="files-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="file-item">
                        <p><?= $row['file_name'] ?></p>
                        <p class="comment"><?= $row['comment'] ?></p>
                        <div class="file-actions">
                            <button onclick="openFileInNewWindow('../<?= $row['file_path'] ?>')" class="btn-open">Open</button>
                            <a href="../<?= $row['file_path'] ?>" download class="btn-download">Download</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No files available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>