<?php
include 'includes/db.php';

$files_per_page = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $files_per_page;

// Fetch files for the current page
$sql = "SELECT * FROM pdf_files ORDER BY uploaded_at DESC LIMIT $files_per_page OFFSET $offset";
$result = $conn->query($sql);

// Fetch total number of files
$total_files_sql = "SELECT COUNT(id) AS total FROM pdf_files";
$total_files_result = $conn->query($total_files_sql);
$total_files = $total_files_result->fetch_assoc()['total'];
$total_pages = ceil($total_files / $files_per_page);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="file-item">';
        echo '<p>' . $row['file_name'] . '</p>';
        echo '<p class="comment">' . $row['comment'] . '</p>';
        echo '<div class="file-actions">';
        echo '<a href="' . $row['file_path'] . '" target="_blank" class="btn-open">Open</a>';
        echo '<a href="' . $row['file_path'] . '" download class="btn-download">Download</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No files available.";
}

echo '<div class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
}
echo '</div>';
