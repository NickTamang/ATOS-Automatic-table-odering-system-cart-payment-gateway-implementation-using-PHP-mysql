<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "menu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];

    // Ensure that an image file was selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "./uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert image file path into database
                $insert = $conn->query("INSERT INTO food (name, image_path) VALUES ('$name', '$target_file')");

                if ($insert) {
                    echo "Image uploaded successfully.";
                } else {
                    echo "Error uploading image. Please try again.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Please select an image file.";
    }
}

$conn->close();
?>
