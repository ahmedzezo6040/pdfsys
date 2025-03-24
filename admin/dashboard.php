<?php
include '../includes/auth.php';
include '../includes/db.php';




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function handleUpload(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            fetch('../upload.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('success-message').innerText = data;
                    document.getElementById('success-message').style.display = 'block';

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
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
            <li><a href="uploaded_files.php"><i class="fas fa-upload"></i> <span>Upload Files</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>


    <div class="main-content">
        <header>
            <h1>Welcome, Admin</h1>
        </header>

        <form action="../upload.php" method="POST" enctype="multipart/form-data" onsubmit="handleUpload(event)">
            <label for="pdf_file">Choose PDF File:</label>
            <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" required>

            <label for="comment">Add a Comment:</label>
            <textarea name="comment" id="comment" rows="4" placeholder="Enter a comment here..."></textarea>

            <button type="submit">Upload File</button>

            <div id="success-message" style="display: none; color: green; margin-top: 10px;"></div>
        </form>
    </div>
</body>

</html>