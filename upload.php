    <?php
    include 'includes/auth.php';
    include 'includes/db.php';
    include 'includes/functions.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = sanitizeInput($_POST['comment']);

        $target_dir = "uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($_FILES["pdf_file"]["name"]);
        $file_name = basename($_FILES["pdf_file"]["name"]);

        // Validate file type
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($file_type != "pdf") {
            echo "Only PDF files are allowed!";
            exit();
        }

        if (move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO pdf_files (file_name, file_path, comment) VALUES ('$file_name', '$target_file', '$comment')";
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading file!";
        }
    }
