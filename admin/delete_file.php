<?php
include '../includes/auth.php';
include '../includes/db.php';



if (isset($_POST['file_id']) && isset($_POST['file_path'])) {
    $file_id = $_POST['file_id'];
    $file_path = $_POST['file_path'];

    if (file_exists($file_path)) {
        unlink($file_path); // Delete the file
    }

    $sql = "DELETE FROM pdf_files WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $file_id);
    $stmt->execute();

    header("Location: uploaded_files.php");
    exit();
} else {
    header("Location: dashboard.php");
    exit();
}
